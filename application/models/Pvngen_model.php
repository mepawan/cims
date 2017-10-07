<?php

class Pvngen_model extends CI_Model 
{
	public $conf = array();
	public $upload_path;
	function __construct($config = array())
	{
		parent::__construct();
		$this->upload_path = FCPATH . '/assets/uploads/';
		$this->conf['entity'] = isset($conf['entity'])?$conf['entity']:'user';
		$this->conf['table'] = isset($conf['table'])?$conf['table']:'users';
		$this->conf['icon'] = isset($conf['icon'])?$conf['icon']:'';
		$this->conf['label'] = isset($conf['label'])?$conf['label']:'';
		
		$this->conf['pk'] = 'id';
		$this->conf['form_style'] = isset($conf['form_style'])?$conf['form_style']:'popup'; // popup/new_window
		$this->conf['form_submit_style'] =  isset($conf['form_submit_style'])?$conf['form_submit_style']:'ajax'; // ajax/submit
		$this->conf['buttons'] = isset($conf['buttons'])?$conf['buttons']:array(
																					'add' => array('text' => '', 'class'=>' btn-success'),
																					'edit' => array('text' => '', 'class'=>' btn-primary'),
																					'delete' => array('text' => '', 'class'=>' btn-danger'),
																				);

		$this->conf['fields'] = isset($conf['fields'])?$conf['fields']:array(
																				'id' => array(
																						'pk'=>1,
																						'label' => 'Id',
																						'required' => true, 
																						'type' => 'hidden',
																						'show_in_form' => false,
																						'show_in_list' => false,
																						'not_editable' => true
																				),
																				/*'id_' => array(
																						'label' => 'ID',
																						'required' => true, 
																						'type' => 'hidden',
																						'show_in_form' => true,
																						'show_in_list' => true,
																						//'dependent' => array('expression' => "EDN[id{4}]"),
																				),*/
																				'title' => array(
																						'label' => 'Title',
																						'required' => true, 
																						'type' => 'text',
																						'show_in_form' => true,
																						'show_in_list' => true,
																						'icon'	=> 'fa-user',
																						'icon_position' => 'left',
																				)
																			);
		
	}

	function set_config($conf){
		$this->conf = array_merge($this->conf, $conf);
	}
	function get_config($key = ''){
		if($key){
			return isset($this->conf[$key])? $this->conf[$key]:false;
		}
		return $this->conf;
	}
	function init($config = array()){
		$this->set_config($config);
		$this->make_columns();
		return $this->conf;
	} 
	function get_entity_by_id($pk){
		$this->db->select("*", FALSE);
		$this->db->from($this->conf['table'], FALSE);
		$this->db->where($this->conf['pk'], $pk);
		$query = $this->db->get();
		return $query->row_array();
		
	}
	function get_all_entity(){
		$this->db->select("tbl.*", FALSE);
		$this->db->from($this->conf['table'], FALSE);
		$query = $this->db->get();
		return $query->result_array();
	}
	function save_entity($postdata){
		
		if(isset($postdata[$this->conf['pk']]) && $postdata[$this->conf['pk']]){
			$old_values = $this->get_entity_by_id($postdata[$this->conf['pk']]);
			$this->db->where($this->conf['pk'], $postdata[$this->conf['pk']]);

			array_walk($this->conf['encrypted_fields'], function($item) use(&$postdata){
				if(isset($postdata[$item])){
					$postdata[$item] = $this->conf['fields'][$item]['encryption']['encode']($postdata[$item]);
				}
			});
			array_walk($this->conf['dependent_fields'], function($item) use(&$postdata, &$old_values){
				$postdata[$item] = $this->calculate_depenndency($item, $postdata, $old_values);
			});
			array_walk($this->conf['not_editable_fields'], function($item) use(&$postdata){
				unset($postdata[$item]);
			});
			return $this->db->update($this->conf['table'], $postdata);
		} else {
			
			array_walk($this->conf['encrypted_fields'], function($item) use(&$postdata){
				if(isset($postdata[$item])){
					$postdata[$item] = $this->conf['fields'][$item]['encryption']['encode']($postdata[$item]);
				}
			});
			$to_update_fields = array();
			array_walk($this->conf['dependent_fields'], function($item) use(&$postdata,&$to_update_fields){
				$field = $this->conf['fields'][$item];
				if(isset($field['dependent']['expression'])){
					$parsed_expr = $this->parse_expression($field['dependent']['expression'], $postdata);
					if(in_array($this->conf['pk'], $parsed_expr['fields'])){
						$to_update_fields[] = $item;
					} else {
						$postdata[$item] = $parsed_expr['expr_value'];
					}
				} else if(isset($field['dependent']['file_info'])){
					$postdata[$item] = $this->calculate_depenndency($item, $postdata);
				}
				
			});
			unset($postdata[$this->conf['pk']]);
			$rs = $this->db->insert($this->conf['table'], $postdata);
			
			if(count($to_update_fields)){
				$insert_id = $this->db->insert_id();
				$postdata[$this->conf['pk']] = $insert_id;
				$update_data = array();
				foreach($to_update_fields as $tuf){
					$update_data[$tuf] = $this->calculate_depenndency($tuf, $postdata);
				}
				$this->db->where($this->conf['pk'], $postdata[$this->conf['pk']]);
				
				
				return $this->db->update($this->conf['table'], $update_data);
			} else {
				return $rs;
			}
		}
	}
	function calculate_depenndency($field_slug, $values, $old_values = array()){
		$field = $this->conf['fields'][$field_slug];
		if(isset($field['dependent']['expression'])){
			$parsed = $this->parse_expression($field['dependent']['expression'], $values);
			return $parsed['expr_value'];
		} else if(isset($field['dependent']['file_info'])){ // to do
			$dependent_field = $field['dependent']['file_info']['field'];
			$uploaded_file = $_FILES[$dependent_field];
			
			if(is_array($uploaded_file['name'])){
				$n = array_search($values[$dependent_field], $uploaded_file['name']);
				$uploaded_file_tmp['name'] = $uploaded_file['name'][$n];
				$uploaded_file_tmp['size'] = $uploaded_file['size'][$n];
				$uploaded_file_tmp['error'] = $uploaded_file['error'][$n];
				$uploaded_file_tmp['tmp_name'] = $uploaded_file['tmp_name'][$n];
				$uploaded_file = $uploaded_file_tmp;
			}
			
			if($uploaded_file && $uploaded_file['size'] > 0 && $uploaded_file['error'] == 0){
				switch($field['dependent']['file_info']['attribute']){
					case 'size':
						return readableFileSize($uploaded_file['size']);
						break;
					case 'length':
						$file_path = $uploaded_file['tmp_name'];
						if(!file_exists($file_path)){
							$file_path = $this->upload_path.$uploaded_file['name'] ;
						}
						$duration = getDuration($file_path);
						return $duration;
						break;
					case 'thumbnail':
						$file_path = $uploaded_file['tmp_name'];
						if(!file_exists($file_path)){
							$file_path = $this->upload_path .'/'.$uploaded_file['name'] ;
						}
						$thumbnail = getThumbnail($file_path);
						return $thumbnail;
						break;
				}
			}
		} else if(isset($field['dependent']['samefilename'])){
			$dependent_field = $field['dependent']['samefilename']['field'];
			if(!isset($values[$field_slug])){
				return isset($old_values[$field_slug])?$old_values[$field_slug]:'';
			}
			$oldname = $values[$field_slug];
			$ext = pathinfo($oldname, PATHINFO_EXTENSION);
			$newname = isset($values[$dependent_field])?$values[$dependent_field]:(isset($old_values[$dependent_field])?$old_values[$dependent_field]:'');
			if($newname){
				$newname = pathinfo($newname, PATHINFO_FILENAME) . '.' . $ext; 
				rename($this->upload_path.$oldname, $this->upload_path.$newname);
				//echo "newname:" . $newname;
				return $newname;
			}else{
				return false;
			}
			
		}
		
	}
	function parse_expression($expr, $values = array()){
		//$expr = $field['dependent']['expression'];
		$fields_in_expr = array();
		preg_match_all("/\[(.*?)\]/", $expr, $matches);
		$expr_arr = $matches[1];
		$expr_val = $expr;
		if($expr_arr && is_array($expr_arr)){
			array_walk($expr_arr, function($item) use(&$values, &$fields_in_expr,  &$expr_val) {
				preg_match_all("/\{(.*?)\}/", $item, $matches2);
				$cnt = 0;
				$field_name = $item;
				if(count(array_filter($matches2))){
					$cnt = $matches2[1][0];
					$field_name = str_replace('{'.$cnt.'}', '', $item);
				}
				$fields_in_expr['fields'][$field_name]  = $field_name;
				$fields_in_expr['cnt'][$field_name]  = $cnt;
				if($values){
					$vl = $values[$field_name];
					$fields_in_expr['value'][$field_name] = $vl;
					if($cnt > 0 && strlen($vl) < $cnt){
						$extr0 = str_repeat('0',($cnt - strlen($vl)));
						$vl = $extr0.$vl;
					}
					$expr_val = str_replace('['.$item.']', $vl, $expr_val);
					
				}
			});
			$fields_in_expr['expr_value'] = $expr_val;
		}
		return $fields_in_expr;
	}
	function delete_entity($ids){
		if($ids && is_array($ids) && count($ids)>0){
			$this->db->where_in($this->conf['pk'], $ids);
			return $this->db->delete($this->conf['table']); 
		} else {
			return false;
		}
	}
	function get_dt($filters = ''){
		if($filters){
			$filter = array_merge($_GET, $_POST);
		}
		$this->db->select("tbl.".$this->conf['pk']." as DT_RowId, ".implode(',',$this->conf['aSelectionColumns']).",".implode(',',$this->conf['joins_keys']), FALSE);
		$this->db->from($this->conf['table'] . '  AS tbl', FALSE);
		if(isset($this->conf['joins']) && is_array($this->conf['joins']) && count($this->conf['joins'])>0){
			foreach($this->conf['joins'] as $join){
				if(isset($join['alias']) && $join['alias']){
					$this->db->join($join['table'] . ' as ' . $join['alias'], $join['on'], 'left');
				} else {
					$this->db->join($join['table'], $join['on'], 'left');
				}
			}
		}
		
		/* Individual column filtering */
		foreach($filters['columns'] as $indx => $clmn){
			if($clmn['searchable'] && $clmn['search']['value']){
				$this->db->where($this->conf['aColumns'][$indx], $clmn['search']['value']);
			} 
		}
		if($filters['search']['value']){
			$cnt = 0;
			foreach($filters['columns'] as $sk => $sv){
				if($sv['searchable'] == "true"){
					if($cnt == 0){
						$this->db->like($this->conf['aColumns'][$sk], $filters['search']['value']);
					} else {
						$this->db->or_like($this->conf['aColumns'][$sk], $filters['search']['value']);
					}
				}
				$cnt++;
			}
		}
		
		$tempdb = clone $this->db;
		$iFilteredTotal = $tempdb->count_all_results();  

		//Ordering
		if ( isset( $filters['order'] ) ){
			$sOrder = "";
			foreach ( $filters['order'] as $ok => $ov ){
					$sOrder .= " " . $this->conf['aColumns'][$ov['column']]." ". ( $ov['dir'] ) .",";
			}
			$sOrder = rtrim($sOrder,",");
			$this->db->order_by($sOrder);
		}
		// Paging
		if ( isset( $filters['length'] ) && $filters['length'] ){
			$this->db->limit( intval( $filters['length'] ), intval( $filters['start'] ));
		}
		$query = $this->db->get();
		$result =  $query->result_array();
		
		$iTotal = $this->db->count_all($this->conf['table']);
		
		$foramated_result = array();
		if($this->conf['encrypted_fields']){
			array_walk($result, function($item,$index) use(&$foramated_result){
				foreach($this->conf['encrypted_fields'] as $field){
					$decodeMethod = $this->conf['fields'][$field]['encryption']['decode'];
					$item[$field] = ($decodeMethod)?$decodeMethod($item[$field]):$item[$field];
					//if(isset($this->conf['fields'][$field]['show_hide_pwd_chkbox']) && $this->conf['fields'][$field]['show_hide_pwd_chkbox']){
						//$item[$field] = '<span class="show-hide-pwd-view"><span class="text hide" >'.$item[$field].'</span><span class="star">******</span> <i class="fa fa-eye-slash" aria-hidden="true"></i></span>';
						//$item[$field] = "";
					//}
					
				}
				
				$foramated_result[$index] = $item;
			});
		} else {
			$foramated_result =  $result;
		}
		$output = array(
			"draw" => intval($filters['draw']),
			"recordsTotal" => $iTotal ,
			"recordsFiltered" => $iFilteredTotal,
			"data" => $foramated_result
		);
		return $output;	
	}
	
	function make_columns(){
		$this->conf['aColumns'] = array();
		$this->conf['aSelectionColumns'] = array();
		$this->conf['not_editable_fields'] = array();
		$this->conf['encrypted_fields'] = array();
		$this->conf['dependent_fields'] = array();
		$this->conf['joins'] = array();
		$this->conf['joins_keys'] = array();
		
		array_walk($this->conf['fields'], function($field,$index)  {
			$alias = '';
			if(isset($field['pk']) && ($field['pk'] == 1 || $field['pk'] == true) ){
				$this->conf['pk'] = $index;
			}
			if(($field['type'] == 'select' || $field['type'] == 'select2') && isset($field['source']['table'])){
				$alias = isset($field['source']['alias'])?$field['source']['alias']:'';
				$this->conf['joins'][$index] = array(
											'table' => $field['source']['table'], 
											'alias' => $alias,
											'on' => ($alias)?$alias.'.'.$field['source']['value_field'].'=tbl.'.$index:$field['source']['table'].'.'.$field['source']['value_field'].'=tbl.'.$index,
										);
				$this->conf['joins_keys'][$index.'_pk'] = ($alias)?$alias.'.'.$field['source']['value_field'].' as '.$index.'_pk':$field['source']['table'].'.'.$field['source']['value_field'] . ' as ' . $index .'_pk';
			}
			if(isset($field['show_in_list']) && ($field['show_in_list'] == 1 || $field['show_in_list'] == true )){
				$this->conf['aColumns'][] = $index;
				if(!$alias){ $alias = 'tbl';}
				$xpr = ( isset($field['expression']) && $field['expression'] )? $field['expression']:'';
				if(!$xpr && isset($field['source']['table'])){
					$tf = $field['source']['value_field'];
					$flds = (is_array($tf))?$tf:explode(',',$tf);
					if(count($flds) == 1){
						$xpr = $alias.'.'.$field['source']['text_field'];
					}
				}
				$this->conf['aSelectionColumns'][] = ( $xpr )? $xpr . ' as ' . $index : $alias.'.'.$index;
			}
			if(isset($field['not_editable']) && ($field['not_editable'] == true || $field['not_editable'] == 1)){
				$this->conf['not_editable_fields'][] = $index;
			}
			if(isset($field['encryption']) && $field['encryption']){
				$this->conf['encrypted_fields'][] = $index;
			}
			if(isset($field['dependent'])){
				$this->conf['dependent_fields'][] = $index;
			}

		});
		//print_r($this->conf);die;
	}
	function get_db_source($tbl,$fields = array()){
		
		if($fields && is_array($fields) && count($fields)){
			$field_str = implode(",", $fields);
		} else {
			$field_str = '*';
		}
		$this->db->select($field_str, FALSE);
		$this->db->from($tbl, FALSE);
		$query = $this->db->get();
		return $query->result_array();
	}
}

/**


buttons : text, class
array(
	'add' => array('text' => 'Add Entity', 'class'=>' btn-success'),
	'edit' => array('text' => 'Edit Entity', 'class'=>' btn-primary'),
	'delete' => array('text' => 'Delete Entity', 'class'=>' btn-danger'),
);

fields attributes: 

'pk' - true or 1 if primary key. false or empty if not primary key,
'dependent' => if this field will automaiticaly calculated:
				array('expression' => "EDN[id{4}]") // EDN0001, EDN0002 like output. where 1, 2 ... are value of 'id' field. {4} defines the length of number field. if field value is not satisfy the length, it adds 0 in start to satisfy
				array('expression' => "EDN[first_name] [last_name]") // pawan kumar, Sandeep singh like output. where first word comes from first_name field and 2nd word comes from last_name field
				array('callback' => array('js' => 'js_callback_name', 'php' => 'php_callback_name'))
				array('file_info' => array('field' => 'video','attribute' => 'length')),
				array('file_info' => array('field' => 'video','attribute' => 'size')),
				array('file_info' => array('field' => 'video','attribute' => 'thumbnail')),
'dt_render_func' => 'jQuery.fn.render_image', //in datatable view call custom render function		
'label' - string lable of field
'required' => true or 1 if its required field, 
'type' => type of form field like text/hidden/password, select, textarea etc,
'allowed_types' => list/array of extensions. if 'type' = file, then specify wich type of files accepted.  it can be array or comma separated string. ie. array('jpg','jpeg','png','gif') or 'jpg,jpeg,png,gif'
'allowed_size' => '' or false or array('max' => 20mb, 'min' => 200kb) or '20mb' - this will be max size. units can be 'b'-byte, 'kb' - killo byte, 'mb' -> mega byte, 'gb' -> giga byte. if unit is not there then assumed 'mb' 
'upload_folder' => 
'show_in_form' => true or 1 to show field in form
'show_in_list' => true or 1 to show field in list,
'show_hide_pwd_chkbox' => 1 or true - if true the there will be checkbox to view/hide password
'not_editable' => true or in. if true, it will not show in form in edit mode
'readonly' => 1 or true - valid for edit mode only - if true, value can't be modified in edit mode
'invisible' => in datatable view, this column will be in hidden mode
'attributes' => array('class' => '') , array of attributes list
'default' => '', default value of field
'icon'	=> 'fa-tags', icon for field
'encryption' = any encryption method like md5,json_incode,serialize, base64_encode, sh1 etc to save value of this field in encrypted form. like for password field 'md5'
				available options : md5, base64_encode, json_encode, serialize with their available decode methods
				like : array('encode'=>'md5', 'decode'=>''),
				array('encode'=>'json_encode', 'decode'=>'json_decode'),
				array('encode'=>'base64_encode', 'decode'=>'base64_decode'),
				array('encode'=>'serialize', 'decode'=>'unserialize'),
'icon_position' => 'left or right',show icon either in left or right position
'expression' => '' for list page only. expressin will be used in query to get modified/expression value like : CONCAT_WS("", emp.first_name," ",emp.last_name)
'source' => for 'select' field type only. options can be 'table,options,ajax,json_file,xml_file' 
			like :  array('table' => 'users','alias' => 'u' 'value_field' => 'id', 'text_field' => 'name' or 'first_name,last_name' or array('first_name','last_name'),'expression' => 'first_name last_name or first_name <br /> last_name')
					array('ajax' => 'ajax_url', 'value_field' => 'id', 'text_field' => 'title')
					array('options' => array('value'=>'text', 'value'=>'text'))
					array('json_file' => 'file_path', 'value_field' => 'id', 'text_field' => 'title')
					array('xml_file' => 'file_path', 'value_field' => 'id', 'text_field' => 'title')
			
			note: text_field - can be single field name or array of single field name, or comma separated multiple fields name or array of multiple fields. 
			      in case of multiple fields, 'expression' field will be must
			
			
**** type attribute of fields***
	text,password,select, textarea,email, tel, url, number,hidden,
**/
