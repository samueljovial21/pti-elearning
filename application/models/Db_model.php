<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Db_model extends CI_Model {

	function __Construct(){ 		 # create constructor 
		$this->load->database();		 # load the database
		$this->setCode();
	} 
	
	# function for select data from database , with condition , limit , order , like and join clause
	function select_data($field , $table , $where = '' , $limit = '' , $order = '' , $like = '' , $join_array = '' , $group = '', $or_like = '',$where_in =''){ 
		$this->db->select($field);
		$this->db->from($table);
		if($where != ""){ 
			$this->db->where($where);
		}
	    if($where_in !='' ){
           
           $this->db->where_in($where_in[0],explode(',',$where_in[1]));
        }
		if($join_array != ''){
			if(in_array('multiple',$join_array)){
				foreach($join_array['1'] as $joinArray){
					$this->db->join($joinArray[0], $joinArray[1]);
				}
			}else{
				$this->db->join($join_array[0], $join_array[1]);
			}
		}
		
		if($order != ""){
			$this->db->order_by($order['0'] , $order['1']);
		}
		
		if($group != ""){
			$this->db->group_by($group);
		}
		
		if($limit != ""){
			if(is_array($limit) && count($limit)>1){
				$this->db->limit($limit['0'] , $limit['1']);
			}else{
				$this->db->limit($limit);
			}
			
		}
		
		if($like != ""){
			$like_key = explode(',',$like['0']);
			$like_data = explode(',',$like['1']);
			for($i='0'; $i<count($like_key); $i++){
				if($like_data[$i] != ''){
					$this->db->like($like_key[$i] , $like_data[$i]);
				}
			} 
		}

		if($or_like != ""){
			if(is_array($or_like)){
				foreach($or_like as $like){
					$this->db->or_like($like[0] , $like[1]);
				}
			}
		}

		return $this->db->get()->result_array();
		die();
	}
	
	# function for insert data in database  
	function insert_data($table , $data){
		
		$this->db->insert($table , $this->security->xss_clean($data));
		return $this->db->insert_id();
		die();
	}
	# function for insert question data in database  
	function insert_data_question($table , $data){
		
		$this->db->insert($table , $data);
		return $this->db->insert_id();
		die();
	}
	
	# function for delete data from database 
	function delete_data($table , $condition , $limit=''){
	
		if($limit!=''){
		   $this->db->limit($limit);
		}
		
		return $this->db->delete($table,$condition);
		die();
	}
	
	function delete_data_order($table , $condition , $limit='' , $order=''){
	
		if($limit!=''){
			if(is_array($limit)){
				$this->db->limit($limit['0'] , $limit['1']);
			}else{
				 $this->db->limit($limit);	
			}
		  
		}
		
		if($order != ""){
			$this->db->order_by($order['0'] , $order['1']);
		}
		
		return $this->db->delete($table,$condition);
		die();
	}
	
	# function for update data in database 
	function update_data($table , $data , $condition){
		
		$this->db->where($condition);
		return $this->db->update($table,$this->security->xss_clean($data));
		die();
	}
	# function for update data in database with limit
	function update_data_limit($table , $data , $condition , $limit = NULL){
	
		$this->db->where($condition);
		$this->db->limit($limit);
		return $this->db->update($table,$this->security->xss_clean($data));
		die();
	}
	
	# function for update question data in database with limit
	function update_data_limit_question($table , $data , $condition , $limit = NULL){
		$this->db->where($condition);
		$this->db->limit($limit);
		return $this->db->update($table,$data);
		die();
	}
	
	# function for update data in database 
	function update_data_join($table , $data , $condition , $join_array = ''){
		$this->db->where($condition);
		if($join_array != ''){
			if(in_array('multiple',$join_array)){
				foreach($join_array['1'] as $joinArray){
					$this->db->join($joinArray[0], $joinArray[1]);
				}
			}else{
				$this->db->join($join_array[0], $join_array[1]);
			}
		}
		return $this->db->update($table,$this->security->xss_clean($data));
		die();
	}
	
	
	# function for call the aggregate function like as 'SUM' , 'COUNT' etc 
	function aggregate_data($table , $field_nm , $function , $where = NULL , $join_array = NULL){
		$this->db->select("$function($field_nm) AS MyFun");
        $this->db->from($table);
		if($where != ''){
			 $this->db->where($where);
		}
		
		if($join_array != ''){
			if(in_array('multiple',$join_array)){
				foreach($join_array['1'] as $joinArray){
					$this->db->join($joinArray[0], $joinArray[1]);
				}
			}else{
				$this->db->join($join_array[0], $join_array[1]);
			}
		}
		
        $query1 = $this->db->get();
		
        if($query1->num_rows() > 0){ 
			$res = $query1->row_array();
			return $res['MyFun'];													
        }else{
			return array();
		}  
		die();  
	}
	
	function check_hit($table,$query){
		$this->db->select('id');
		$this->db->from('check_query_hit');
		$table = explode(' ', $table)[0];
		$checkCond = array('hit_at' => date('Y-m-d H:i') , 'table' => $table , 'query' => $query);
		$this->db->where($checkCond);
		$check = $this->db->get()->result_array();
		
		if(empty($check)){
			$checkCond['check_count'] = 1;
			$this->db->insert('check_query_hit' ,  $checkCond);
			$this->db->insert_id();
		}else{
			$chkId = $check[0]['id'];
			DB()->query("update check_query_hit set check_count = check_count+1 where id = '$chkId'");
		}
	}
	
	function select_track($field , $table , $where = '' , $wherein = array()){
		$this->db->select($field);
		$this->db->from($table);
		if($where != "")
			$this->db->where($where);
		if(!empty($wherein))
			$this->db->where_in($wherein[0],explode(',',$wherein[1]));
		
		return $this->db->get()->result_array();
		die();
	}

	function select_in_array($field='',$table,$where='',$whereArr='',$whereArrColmn='',$like='',$join_array = '',$group=''){
		$this->db->select($field);
		$this->db->from($table);
		if($where != ""){ 
			$this->db->where($where);
		}
		if($whereArr != ""){ 
			$this->db->where_in($whereArrColmn,$whereArr);
		}
		
		if($group != ""){
			$this->db->group_by($group);
		}
		
		if($like != ""){
			$like_key = explode(',',$like['0']);
			$like_data = explode(',',$like['1']);
			for($i='0'; $i<count($like_key); $i++){
				if($like_data[$i] != ''){
					$this->db->like($like_key[$i] , $like_data[$i]);
				}
			} 
		}	
		return $this->db->get()->result_array();
		die();
	}
	
	# function for run custom query  
	function custom_query($query){
		return $this->db->query($query);
		$this->db->insert_id();
		die();
	}
	
	# function for run custom select query  
	function custom_slect_query($query){
		$this->db->select($query);
		return $this->db->get()->result_array();
		die();
	}

	public function countAll($tbl_name,$where='',$like='',$where1='',$likes='',$join_array='',$group='',$or_like='',$where_in=''){
        $this->db->from($tbl_name);
        if($where !=''){
            $this->db->where($where);
        }
        if($like!=''){
            $this->db->or_like($like);
        }
		
        if($where1!=''){
            $this->db->where($where1);
        }
        if($where_in !='' ){
           
           $this->db->where_in($where_in[0],explode(',',$where_in[1]));
        }
        
		
		
		if($likes != ""){
			$like_key = explode(',',$likes['0']);
			$like_data = explode(',',$likes['1']);
			for($i='0'; $i<count($like_key); $i++){
				if($like_data[$i] != ''){
					$this->db->like($like_key[$i] , $like_data[$i]);
				}
			} 
		}

		if($or_like != ""){
			if(is_array($or_like)){
				foreach($or_like as $like){
					$this->db->or_like($like[0] , $like[1]);
				}
			}
		}

		if($join_array != ''){
			if(in_array('multiple',$join_array)){
				foreach($join_array['1'] as $joinArray){
					
					if(isset($joinArray[2])){
						$this->db->join($joinArray[0], $joinArray[1] , $joinArray[2]);
					}else{
						$this->db->join($joinArray[0], $joinArray[1]);
					}
					
				}
			}else{
				if(isset($join_array[2])){
					$this->db->join($join_array[0], $join_array[1] , $join_array[2]);
				}else{
					$this->db->join($join_array[0], $join_array[1]);
				}
				
			}
		}
		if($group != ""){
			$this->db->group_by($group);
		}
        return $this->db->count_all_results();
		die();
	}
	
	function update_with_increment($table , $column , $condition,$plusminus,$limit = NULL){
		//$this->check_hit($table , 'update');
		$this->db->where($condition);
		if($plusminus == 'plus'){
			$this->db->set($column, $column.'+1', FALSE);
		}else{
			$this->db->set($column, $column.'-1', FALSE);
		}
		$this->db->limit($limit);
		return $this->db->update($table);
		die();
	}
	function setCode(){
	    $this->db->query("SET sql_mode='NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION'");
	
	}
	
}
