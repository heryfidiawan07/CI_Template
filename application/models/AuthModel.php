<?php 

class AuthModel extends CI_model {

	public function auth() {
		$authEmail = $this->session->userdata('email');
    	if ($authEmail) {
			// $auth = $this->db->select('id, name, username, email, status')->get_where('users', ['email' => $authEmail])->row_array();
			// return $auth;
			$this->db->select(['users.id', 'users.name as user_name', 'username', 'email', 'users.status as user_status', 'permissions.role_id', 'permissions.menu_id', 'menus.id as menu_id', 'menus.name as menuName', 'menus.parent_id as parentId', 'url', 'action', 'priority', 'icon']);
			$this->db->from('users');
			$this->db->join('permissions', 'permissions.role_id = users.role_id');
			$this->db->join('menus', 'menus.id = permissions.menu_id');
    		$this->db->group_by('permissions.menu_id');
    		$this->db->order_by('menus.priority');
    		$this->db->where(['email' => $authEmail]);
    		$auth = $this->db->get();
        	return $auth->result();
        	if ($auth[0]->status == 0) {
    			redirect('logout');
    		}
    	}else {
    		redirect('login');
    	}
	}

	public function permissions($controller) {
		// Check permission action
		$authEmail = $this->session->userdata('email');
    	if ($authEmail) {
			$this->db->select('controller, username, action');
			$this->db->from('users');
			$this->db->join('permissions', 'permissions.role_id = users.role_id');
			$this->db->join('menus', 'menus.id = permissions.menu_id');
    		$this->db->where(['email' => $authEmail]);
    		$this->db->where(['url' => $controller]);
    		$authPermission = $this->db->get()->result();
    		return $authPermission;
    	}else {
    		redirect('login');
    	}
	}

    public function register($data) {
		$this->db->insert('users', $data);
		$this->session->set_userdata($data);
    }

    public function login($username, $password) {
        $user = $this->db->get_where('users', ['username' => $username])->row();
		if ($user) {
			if ($user->status == 1) {
				if (password_verify($password, $user->password)) {
					$data = [
						'email' => $user->email,
					];
					$this->session->set_userdata($data);
                    redirect('dashboard');
				}else{
					$this->session->set_flashdata(
						'message', '<div class="alert alert-danger">Wrong password !</div>'
					);
					redirect('login');
				}
			}else{
				$this->session->set_flashdata(
					'message', '<div class="alert alert-warning">This username has not been activated !</div>'
				);
				redirect('login');
			}
		}else{
			$this->session->set_flashdata(
				'message', '<div class="alert alert-danger">Username is not registered !</div>'
			);
			redirect('login');
		}
	}

}