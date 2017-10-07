<?php
class PvngenField {
	function __construct($params = array()){
		$this->ci =& get_instance();
		$this->ci->load->model('Pvngen_model');
		$this->model = $this->ci->Pvngen_model;
		
		$this->ci =& get_instance();
		$this->ci->load->config('pvngen');
		$this->field_wraps = isset($params['field_wraps'])?$params['field_wraps']:array();
	}
	
	public function set($field, $value){
		$this->$field = $value;
	}
	public function get($field){
		return isset($this->$field)?$this->$field:false;
	}
	
	function render($k, $f, $v = '', $a = ''){ 
		$field_html = '';
		switch($f['type']){
			case 'text':
			case 'password':
			case 'email':
			case 'number':
			case 'tel':
			case 'hidden':
			case 'url':
				$field_html = $this->textbox($k, $f, $v, $a);
				break;
			case 'textarea':
			case 'ckeditor':
				$field_html = $this->textarea($k, $f, $v, $a);
				break;
			case 'select':
			case 'select2':
				$field_html = $this->select($k, $f, $v, $a);
				break;
			case 'file':
				$field_html = $this->file($k, $f, $v, $a);
				break;
		}

		echo $field_html ;

	}

	function textbox($k, $f, $v = '', $a = ''){ 
		$required = (isset($f['required']) && $f['required'])?'required':'';
		$id = (isset($f['attributes']) && isset($f['attributes']['id']))?$f['attributes']['id']:'pvngen_'.$k;
		$id .= '_'.$a;
		if(!isset($f['attributes']) && !isset($f['attributes']['placeholder'])){
			$f['attributes']['placeholder'] = $f['label'];
		}
		$attr_str = '';
		if(isset($f['attributes']) && is_array($f['attributes'])){
			array_walk($f['attributes'], function($item, $index) use (&$attr_str){
				$attr_str .= ' '.$index.'="'.$item.'" ';
			});
		}
		$value = ($v)?$v:(isset($f['default'])?$f['default']:'');
		$field_wrap = ($f['type'] == 'hidden')?$this->field_wraps['hidden']:$this->field_wraps['simple'];
		
		$html = str_replace(
							array('{type}','{name}','{id}','{val}','{label}','{attributes}','{required}'),
							array($f['type'],$k,$id,$value,$f['label'],$attr_str,$required),
							$field_wrap
					);

		return $html;

	}
	function textarea($k, $f, $v = '', $a = ''){

		$required = (isset($f['required']) && $f['required'])?'required':'';

		$id = (isset($f['attributes']) && isset($f['attributes']['id']))?$f['attributes']['id']:'pvngen_'.$k;

		$id .= '_'.$a;

		$placeholder = (isset($f['attributes']) && isset($f['attributes']['placeholder']))?$f['attributes']['placeholder']:$f['label'];

		unset($f['attributes']['placeholder']);

		$attr_str = '';

		if(isset($f['attributes']) && is_array($f['attributes'])){

			array_walk($f['attributes'], function($item, $index) use (&$attr_str){

				$attr_str .= ' '.$index.'="'.$item.'" ';

			});

		}

		

		$value = ($v)?$v:(isset($f['default'])?$f['default']:'');

		$html = '<label for="'.$id.'" class="field prepend-icon">

						<textarea '.$required.' name="'.$k.'" id="'.$id.'" class="gui-textarea gen pvngen_'.$f["type"].'" value="'.$value.'"   placeholder="'.$placeholder.'" '.$attr_str.' >'.$value.'</textarea>';

		if($f['icon']){

			$html .= '<label for="'.$id.'" class="field-icon">

							<i class="fa '.$f['icon'].'"></i>

						</label>';

		}

		$html .= '</label>';

		return $html;

	}

	function select($k, $f, $v = '', $a = ''){ 
		$required = (isset($f['required']) && $f['required'])?'required':'';
		$id = (isset($f['attributes']) && isset($f['attributes']['id']))?$f['attributes']['id']:'pvngen_'.$k;
		$id .= '_'.$a;
		if(!isset($f['attributes']) && !isset($f['attributes']['placeholder'])){
			$f['attributes']['placeholder'] = $f['label'];
		}
		$attr_str = '';
		if(isset($f['attributes']) && is_array($f['attributes'])){
			array_walk($f['attributes'], function($item, $index) use (&$attr_str){
				$attr_str .= ' '.$index.'="'.$item.'" ';
			});
		}
		$value = ($v)?$v:(isset($f['default'])?$f['default']:'');
		$field_wrap = $this->field_wraps['select'];
		
	
		$options .= $this->get_source($k,$f, $v);
		$html = str_replace(
							array('{type}','{name}','{id}','{val}','{label}','{attributes}','{required}','{options}'),
							array($f['type'],$k,$id,$value,$f['label'],$attr_str,$required,$options),
							$field_wrap
					);
		
		return $html;

	}

	
	

	function file($k, $f, $v = '', $a = ''){ 

		$required = (isset($f['required']) && $f['required'])?'required':'';

		$id = (isset($f['attributes']) && isset($f['attributes']['id']))?$f['attributes']['id']:'pvngen_'.$k;

		$id .= '_'.$a;

		$placeholder = (isset($f['attributes']) && isset($f['attributes']['placeholder']))?$f['attributes']['placeholder']:$f['label'];

		unset($f['attributes']['placeholder']);

		$attr_str = '';

		if(isset($f['attributes']) && is_array($f['attributes'])){

			array_walk($f['attributes'], function($item, $index) use (&$attr_str){

				$attr_str .= ' '.$index.'="'.$item.'" ';

			});

		}

		$nam = $k;

		if(isset($f['attributes']['multiple']) && $f['attributes']['multiple'] ){

			$nam .= '[]';

		}

		

		$value = ($v)?$v:(isset($f['default'])?$f['default']:'');

		$textbox = '<label for="'.$id.'" class="field prepend-icon file pvngen">';

        $textbox .= '<span class="button btn-primary">Choose File</span>';

        $textbox .= '<input '.$required.' name="'.$nam.'"  id="'.$id.'" class="gui-file" name="file1" id="file1" type="file" '.$attr_str.' >';

        $textbox .= '<input  class="gui-input uploader"  placeholder="'.$placeholder.'" type="text">';

        $textbox .= '<label class="field-icon">';

        $textbox .= '<i class="fa fa-cloud-upload"></i>';

        $textbox .= '</label>';

        $textbox .= '</label>';

		return $textbox;

	}

	function get_source($k,$f, $v = ''){
		
		$source_type = array_keys($f['source'])[0];

		$source_list = array();

		$xpr = (isset($f['source']['expression']))?$f['source']['expression']:'';

		

		if($source_type == 'options'){

			$source_list = $f['source'][$source_type];

			$source_html = '';

			array_walk($source_list, function($item, $index) use(&$source_html,&$v,&$xpr,&$fields){

				$sel = ($v == $index)?'selected="selected"':'';

				$txt = ($xpr)?str_replace($fields,$item,$xpr):$item;

				$source_html .= '<option value="'.$index.'" '.$sel.'>'.$txt.'</option>';

			});

			return $source_html;

		} else {
				$vf = $f['source']['value_field'];

				$tf = $f['source']['text_field'];

				$tbl = $f['source'][$source_type];

				$fields = (is_array($tf))?$tf:explode(',',$tf);

				if(count($fields) > 1 && !$xpr){

					return '<option>Error - check expression or text-field names</option>';

				}
				
				$fields[] = $vf;

				switch($source_type){
					
					case 'table':
					
						$source_list = $this->model->get_db_source($tbl,$fields);
						
						break;

					case 'ajax':

						break;

					case 'json_file':

						break;

					case 'xml_file':

						break;

				}

				$source_html = '';

				array_walk($source_list, function($item) use(&$source_html,&$vf,&$tf,&$v,&$xpr,&$fields){

					$sel = ($v == $item[$vf])?'selected="selected"':'';

					$txt = ($xpr)?str_replace($fields,$item,$xpr):$item[$tf];

					$source_html .= '<option value="'.$item[$vf].'" '.$sel.'>'.$txt.'</option>';

				});

				return $source_html;

		}

	
	}

	
}
