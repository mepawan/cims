<?php 

defined('BASEPATH') OR exit('No direct script access allowed');


class Util_model extends CI_Model{

   
	public function __construct(){
		 parent::__construct();
		
	}
	public function custom_query($query, $return = true){
		if(!$query){return false;}
		$q = $this->db->query($query);
		if($return){
			return ($q->num_rows() > 0)?$q->result_array():array();
		} else {
			return $q;
		}
	}
	public function create($tbl,$data){
        $this->db->insert($tbl, $data);
		return $this->db->insert_id();
    }
	public function read($tbl, $params = array()){
		
		if(isset($params['where']) && $params['where']){
			foreach($params['where'] as $k => $v){
				if(is_numeric($k)){
					$this->db->where($v);
				} else {
					$this->db->where($k, $v);
				}
			}
		}
		if(isset($params['where_in']) && $params['where_in']){
			foreach($params['where_in'] as $k => $v){
				if(!is_array($v)){
					$v = explode(",",$v);
				}
				$this->db->where_in($k, $v);
			}
		}
		if(isset($params['orderby']) && $params['orderby']){
			if(isset($params['order']) && $params['order']){
				$this->db->order_by($params['orderby'], $params['order']);
			} else {
				$this->db->order_by($params['orderby']);
			}
		}
		if(isset($params['like']) && $params['like']){
			foreach($params['like'] as $k => $v){
				if(is_numeric($k)){
					$this->db->where($v);
				} else {
					$this->db->like($k, $v);
				}
				
			}
		}
		if(isset($params['limit']) && $params['limit']){
			$start = (isset($params['start']) && $params['start'])? $params['start']:0;
			$this->db->limit($params['limit'], $start);
		}

		$query = $this->db->get($tbl);
		if(isset($params['single_row']) && $params['single_row'] == 'yes'){
			return $query->num_rows()? $query->row_array():false;
		} else {
			return $query->num_rows()? $query->result_array():false;
		}
	}
	
	public function update($tbl, $data, $idx = 'id'){
       $id = $data[$idx];
	   if(!$id){ return false; }
       $this->db->where($idx, $id);
       return $this->db->update($tbl,$data);        
    }


	function delete($tbl, $data, $idx = 'id' ) {
		 $id = $data[$idx];
		if(!$id){ return false; }
		 $this->db->where($idx, $id);
		$this->db->delete($tbl);
		return $this->db->affected_rows() > 0;

	}
	
	
	function get_data_for_dt($filters){
		//$filters['custom_search_filter'] = $searchFields;
		//print_r($filters);
		$searchFields = isset($filters['custom_search_filter'])?$filters['custom_search_filter']:'';
		//print_r($filters['custom_search_filter']);

		$tbl = isset($filters['table']) && $filters['table'] ? $filters['table'] . "  tbl ":'';
		
		if(!$tbl){return false;}
		
		$joins = isset($filters['joins']) && $filters['joins'] ?  $filters['joins'] :'';

		$aSelectionColumns = isset($filters['aSelectionColumns']) && $filters['aSelectionColumns'] ? $filters['aSelectionColumns']:array();
		$aColumns = isset($filters['aColumns']) && $filters['aColumns'] ? $filters['aColumns']:array();
		
		$pk = isset($filters['index_column']) && $filters['index_column'] ? $filters['index_column'] :'tbl.id';
		
		
		$this->db->select($pk." as DT_RowId, ".implode(',',$aSelectionColumns), FALSE);
		$this->db->from($tbl, FALSE);
		if($joins){
			foreach($joins as $join){
				$jtype = isset($join['type']) && $join['type']? $join['type'] :'left';
				if(isset($join['alias']) && $join['alias']){
					$this->db->join($join['table'] . ' as ' . $join['alias'], $join['on'], $jtype);
				} else {
					$this->db->join($join['table'], $join['on'], $jtype);
				}
			}
		}
		/*
		 * Ordering
		 */
		if ( isset( $filters['order'] ) ){
			$sOrder = "";
			foreach ( $filters['order'] as $ok => $ov ){
					$sOrder .= " " . $aColumns[$ov['column']]." ". ( $ov['dir'] ) .",";
			}
			$sOrder = rtrim($sOrder,",");
			//echo $sOrder;
			$this->db->order_by($sOrder);
		}
		
		//print_r($filters);
		
		
		/* Individual column filtering */
		foreach($filters['columns'] as $indx => $clmn){
			if($clmn['searchable'] && $clmn['search']['value']){
				$this->db->where($aColumns[$indx], $clmn['search']['value']);
			} 
		}
		
		if(isset($searchFields['where']) && $searchFields['where'] ){
				foreach($searchFields['where'] as $k => $v){
					$this->db->where($k, $v);
				}
		}
		if(isset($searchFields['where_in']) && $searchFields['where_in'] ){
				foreach($searchFields['where_in'] as $k => $v){
					$this->db->where_in($k, $v);
				}
		}
		
		
		if($filters['search']['value']){
			$cnt = 0;
			foreach($filters['columns'] as $sk => $sv){
				if($sv['searchable'] == "true"){
					if($cnt == 0){
						$this->db->like($aColumns[$sk], $filters['search']['value']);
					} else {
						$this->db->or_like($aColumns[$sk], $filters['search']['value']);
					}
				}
				$cnt++;
			}
		}
		/* 
		 * Paging
		 */
		if ( isset( $filters['length'] ) && $filters['length'] ){
			$this->db->limit(intval( $filters['start'] ), intval( $filters['length'] ));
		}
		
		$query = $this->db->get();
		$iFilteredTotal = $query->num_rows();

		//echo $this->db->last_query();die;
		
		$iTotal = $this->db->count_all($filters['table']);
		$result =  $query->result_array();
		//echo "res:";
		//print_r($result);
		
		$foramated_result = array();
		
		$foramated_result =  $result;
		
		$output = array( 
			"draw" => intval($filters['draw']),
			"recordsTotal" => $iTotal,
			"recordsFiltered" => $iFilteredTotal,
			"data" => $foramated_result
		);
		return $output;	
	}
}
