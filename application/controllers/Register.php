<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		if ($this->auth()) {
			redirect('dashboard');
		}

		$this->load->model('AuthModel');
		$this->load->model('UserModel');
		$this->load->model('RoleModel');
        $this->load->model('MenuModel');
        $this->load->model('PermissionModel');

		$this->load->library('template');
		$this->load->library('form_validation');
	}

	public function auth() {
		$authEmail = $this->session->userdata('email');
    	if ($authEmail) {
    		$auth = $this->db->select('id, name, username, email, status')->get_where('users', ['email' => $authEmail])->row_array();
			return $auth;
    	}else {
    		return false;
    	}
	}

	public function index() {
		$data['title'] = 'REGISTER';
		$data['auth']  = $this->auth();
		$this->template->app('auth/register', $data);
	}

	public function register() {
		$this->form_validation->set_rules(
			'name', 'name', 'trim|required|min_length[3]|max_length[25]'
		);
		$this->form_validation->set_rules(
			'username', 'username', 'trim|required|min_length[3]|max_length[25]|is_unique[users.username]', [
				'is_unique' => 'This username has already registered !'
			]
		);
		$this->form_validation->set_rules(
			'email', 'email', 'trim|required|valid_email|is_unique[users.email]|min_length[3]|max_length[25]', [
				'is_unique' => 'This email has already registered !'
			]
		);
		$this->form_validation->set_rules(
			'password', 'password', 'trim|required|min_length[6]|matches[repeat_password]', [
				'matches' => 'Password dont match !',
				'min_length' => 'Password too short !'
			]
		);
		$this->form_validation->set_rules(
			'repeat_password', 'repeat password', 'trim|required|matches[password]'
		);
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'REGISTER';
			$data['auth']  = $this->auth();
			$this->template->app('auth/register', $data);
		} else {
			$users	  = $this->UserModel->all();
			if ($users) {
				$data['title'] = 'REGISTER';
				$data['auth']  = $this->auth();
				$this->session->set_flashdata(
					'message', '<div class="alert alert-danger">Super Admin Already Exist !</div>'
				);
				$this->template->app('auth/register', $data);
			}else {
				$data_menu = [
				        	[
				                'name' => 'Role',
								'url'  => 'role',
								'icon' => 'fas fa-user-cog',
								'parent_id' => 1,
								'priority' => 0,
					    	],
					        [
				                'name' => 'User',
								'url'  => 'user',
								'icon' => 'fas fa-user',
								'parent_id' => 1,
								'priority' => 0,
					        ],
						];
				$this->MenuModel->create_batch($data_menu);

				$this->RoleModel->create([
                        'name' => 'Super Admin',
                        'status' => 1,
                        'user_id' => 1,
                        'created_at' => time(),
                        'updated_at' => time(),
                    ]);
				
				$data_permission = [
					[
						'role_id' => 1,
                        'menu_id' => 1,
                        'action'  => 'create',
                        'created_at' => time(),
                        'updated_at' => time(),
					],
					[
						'role_id' => 1,
                        'menu_id' => 1,
                        'action'  => 'update',
                        'created_at' => time(),
                        'updated_at' => time(),
					],
					[
						'role_id' => 1,
                        'menu_id' => 1,
                        'action'  => 'delete',
                        'created_at' => time(),
                        'updated_at' => time(),
					],
					[
						'role_id' => 1,
                        'menu_id' => 2,
                        'action'  => 'create',
                        'created_at' => time(),
                        'updated_at' => time(),
					],
					[
						'role_id' => 1,
                        'menu_id' => 2,
                        'action'  => 'update',
                        'created_at' => time(),
                        'updated_at' => time(),
					],
					[
						'role_id' => 1,
                        'menu_id' => 2,
                        'action'  => 'delete',
                        'created_at' => time(),
                        'updated_at' => time(),
					]

				];
				$this->PermissionModel->create_batch($data_permission);

				$name     = htmlspecialchars($this->input->post('name', true));
				$username = htmlspecialchars($this->input->post('username', true)); // Buat tanpa spasi via JS
				$data = [
						'name' => $name,
						'username' => $username,
						'email' => htmlspecialchars($this->input->post('email', true)),
						'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
						'role_id' => 1,
						'status' => 1,
						'token' => base64_encode(random_bytes(100)),
						'created_at' => time(),
						'updated_at' => time(),
					];
				$this->AuthModel->register($data);
				$this->session->set_flashdata(
					'message', '<div class="alert alert-success">Registration successful, please login !</div>'
				);
				redirect('login');
			}
		}
	}

}
