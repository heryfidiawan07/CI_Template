<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Forgot_password extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('AuthModel');
		
		if ($this->session->userdata('email')) {
			redirect('dashboard');
		}
		
		$this->load->library('form_validation');
		$this->load->library('template');
        $this->load->library('email');
	}	
    
    public function index (){
        $data['title'] = 'Forgot Password';
		$this->load->view('auth/forgot_password', $data);
    }
    
    public function send_mail(){
		$this->form_validation->set_rules(
			'email', 'email', 'trim|required|valid_email'
		);
		$email = $this->input->post('email');
		$user  = $this->db->get_where('users', ['email' => $email])->row_array();
		if ($user['email'] == $email) {
			$subject = 'Test subject kedua';
			$message = 'Test message kedua';
            
			$this->sendMail($email, $subject, $message);
			
			$this->session->set_flashdata(
				'message', '<div class="alert alert-success">Email successfully sent</div>'
			);
			redirect('forgot_password');
		}else {
			$this->session->set_flashdata(
				'message', '<div class="alert alert-danger">This email is not registered !</div>'
			);
			redirect('forgot_password');
		}
    }
    
    public function sendMail($email, $subject, $message){
        $config = [
			'protocol'  => 'smtp',
			'smtp_host' => 'smtp.mailtrap.io',
			'smtp_port' => 2525,
			'smtp_user' => 'a109d17fba926e',
			'smtp_pass' => '7e5c32c9198765',
			'mailtype' 	=> 'html',
			'charset'   => 'utf-8',
			'newline' 	=> "\r\n"
		];
		$this->email->initialize($config);
		$this->email->from('no-reply@admin.com', 'Hery_Dev__');
		$this->email->to($email);
		$this->email->subject($subject);
		$this->email->message($message);
		// $this->email->attach('./asset/ContohAttachment.docx');
		if($this->email->send()) {
			return true;
		}else {
			$error = $this->email->print_debugger();
			echo $error;
			die;
		}
    }
    
}
