<?php

class Login extends CI_Controller {
	
	function index() {

		$this->session->sess_destroy();
		$this->load->view('LoginPage/login');
		
	}	
	function validate_credentials() 
	{
		$this->load->model('Membership_model');
		$query = $this->Membership_model->validate();

		if($query)
		{	

			$data = array(
       						 'username' => $this->input->post('username'),
       						 'is_logged_in'  => true
       						 
						 );
			
			$this->session->set_userdata($data);
			$a=$this->session->userdata('username');



			if($query == 'Admin')
			{
				redirect('Hms/admin');	
			}
			elseif ($query == 'Doctor') {
				redirect('Hms/doctor');
			}
			elseif ($query == 'Registration') {
				redirect('Hms/registration');
			}
			else
			{
				redirect('Hms/Pharmacy');
			}
		}

		else
		{
		$this->session->set_flashdata('loginFailed', '<div class="alert alert-danger">
		<strong>Failed!</strong> Invalid Details.</div>');
		redirect('login');
		//$this->load->view('LoginPage/login');
		}
	}

}