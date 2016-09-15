<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');
 class User_model extends CI_Model {
    public function __construct() {
    	parent::__construct();
    }

    function add_user($data){
        $userid = $data['id'];
    	  $query = $this->db->query("SELECT id from registered_users where id = '$userid'");

  	    $count = $query->num_rows(); //counting result from query

  	    if ($count == 0) {
  	      $this->db->insert('registered_users', $data);
  	    }	
    }
    function post_job_meta($data){
    	$this->db->insert('posted_job_meta', $data);
    }
    function user_job_map($data){
    	$this->db->insert('job_user_map', $data);
    }
    function job_count(){
    	$query = $this->db->query('SELECT * FROM job_user_map where status = 1');
  	  return $query->num_rows();
    }
    function add_otp($auth_key,$id){
      $auth_array = array('user_id'=>$id,
                          'auth_key'=>$auth_key);
      $this->db->insert('active_users', $auth_array);
    }
    function check_user($auth_key, $id){
      $query = $this->db->query("SELECT auth_key FROM active_users where user_id = '$id' ");
      foreach($query->result() as $otp){
        if(strcmp($otp->auth_key,$auth_key) == 0){
          return true;
        }else{
          return false;
        }
      }
    }
    function user_info($id){
      $query = $this->db->query("SELECT * FROM registered_users where id = '$id' ");
      $user_info = array();
      foreach($query->result() as $info){
        $user_info['user_id'] = $info->id;
        $user_info['display_name'] = $info->display_name;
        $user_info['photo_url'] = $info->photo_url;
      }
      return $user_info;
    }
    function company_exist($company_name, $company_meta){
      $query = $this->db->query("SELECT * FROM company_info where company_name = '$company_name' ");
      $count = $query->num_rows();
      if($count==0){
        $cmpname = array('company_name' => $company_name,
                         'company_meta' => $company_meta);
        $this->db->insert('company_info', $cmpname);
        $insert_id["company_id"] = $this->db->insert_id();
        return $insert_id;
      }else{
        foreach($query->result() as $info){
          $insert_id["company_id"] = $info->company_id; 
        }
        return $insert_id;
      }
    }

    function end_session($user_id){
      $query = $this->db->query("DELETE from active_users where user_id = '$user_id'");
      setcookie("user_identifier","",time()-3600,"/");
      setcookie("auth_key","",time()-3600,"/");
    }
}
 ?>
