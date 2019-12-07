<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		if ($this->auth()) {
			redirect('dashboard');
		}

		$this->load->library('template');
		$this->load->library('form_validation');
	}

	public function auth() {
		$authEmail = $this->session->userdata('email');
    	if ($authEmail) {
    		$auth = $this->db->select('user_id, name, username, email, status')->get_where('users', ['email' => $authEmail])->row_array();
			return $auth;
    	}else {
    		return false;
    	}
	}

	public function index () {
		$data['title'] = 'LOGIN';
		$data['auth']  = $this->auth();
		$this->template->app('auth/login', $data);
	}

	public function login() {
		$this->load->model('AuthModel');

		$this->form_validation->set_rules(
			'username', 'username', 'trim|required|min_length[3]|max_length[25]'
		);
		$this->form_validation->set_rules(
			'password', 'password', 'trim|required'
		);
		$username = htmlspecialchars($this->input->post('username', true));
		$password = $this->input->post('password');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'LOGIN';
			$this->template->app('auth/login', $data);
		}else{
			$this->AuthModel->login($username, $password);
		}
	}
	
}
