<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function _construct()
	{
		$this->load->model('user_model');
		$this->load->helper('url');
		$this->load->helper('cookie');
		parent::__construct();
	}
	public function index()
	{
		// if( $this->session->userdata('isLoggedIn')){
		// 	$username = $this->session->userdata('name');
		// 	$this->load->view('welcome_message', $username);
		// }else{
			
			$this->load->view('welcome_message');
		// }
	}

	public function generate_otp($length = 4, $chars = '1234567890')  
    {  
         $chars_length = (strlen($chars) - 1);  
         $string = $chars{rand(0, $chars_length)};  
         for ($i = 1; $i < $length; $i = strlen($string))  
         {  
            $r = $chars{rand(0, $chars_length)};  
            if ($r != $string{$i - 1}) $string .= $r;  
         }  
    	return $string;
    }  
	public function set_session(){
		$id = $this->input->post('id');
		// TODO @VISHAL CORRECT BELOW IF STATEMENT
		// if()
		$firstname = $this->input->post('firstname');
		$lastname = $this->input->post('lastname');
		$email = $this->input->post('email');
		$provider = $this->input->post('provider');
		$profile_url = $this->input->post('profile_url');
		$photo_url = $this->input->post('photo_url');
		$display_name = $firstname . ' ' . $lastname;
		$user_data = array(
						  'id' => $id,
						  'display_name' => $display_name,
						  'email' => $email,
						  'provider' => $provider,
						  'profile_url'=> $profile_url,
						  'photo_url' => $photo_url
						 );

		$usuario = $this->load->model('User_model');
		$result = $this->user_model->add_user($user_data);
		$otp  =  hash("md5", $this->generate_otp());
		$set_otp =  $this->user_model->add_otp($otp,$id);
		set_cookie("user_identifier",$id,7200);
		set_cookie("auth_key",$otp,7200);
	}
	public function post_job() {
    	$job_model = $this->load->model('user_model');
		if($this->user_model->check_user($this->input->post("otp"),$this->input->post("user_id"))){
			$company_name = $this->input->post("company_name");
			$company_meta = $this->input->post("company_meta");
			$job_meta = $this->input->post("job_meta");
			$user_id = $this->input->post("user_id");
			$tot_job = $this->user_model->job_count();
			$post_company = $this->user_model->company_exist($company_name, json_encode($company_meta));
	    	$job_info = array('job_id'=>$tot_job + 1,
	    					  'meta_array'=>json_encode($job_meta),
	    					  'company_id' => $post_company["company_id"]);
	    	$result = $this->user_model->post_job_meta($job_info);
			$mapping = array('user_id' => $user_id,
							 'job_id' => $tot_job + 1,
							 'company_id'=> $post_company["company_id"]);
			$result = $this->user_model->user_job_map($mapping);
			echo json_encode(array('msg' => "Your job has been posted"));
		}else{
			echo json_encode(array('msg' => "Your job has  not been posted. Authentication Failed"));
		}

	}

	public function get_userinfo(){
		$job_model = $this->load->model('user_model');
		if($this->user_model->check_user($this->input->post("auth_key"),$this->input->post("user_identifier"))){
			$user_id = $this->input->post("user_identifier");
			$user_info = $this->user_model->user_info($user_id);

			echo json_encode($user_info);
		}else{
			echo "failure";
		}

	}
	public function logout(){
		$job_model = $this->load->model('user_model');
		if($this->user_model->check_user($this->input->post("auth_key"),$this->input->post("user_identifier"))){
			$user_id = $this->input->post("user_identifier");
			$delete_user =  $this->user_model->end_session($user_id);
		}else{
			echo "user not permitted";
		}
	}
}
