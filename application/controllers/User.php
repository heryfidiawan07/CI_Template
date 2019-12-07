<?php

class User extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('AuthModel');
        $this->load->model('UserModel');
        
        $this->AuthModel->auth();

        if (!$this->userMenu()) {
            redirect(base_url());
        }
        
        $this->load->library('template');
        $this->load->library('form_validation');
    }

    public function userMenu() {
        $auth = $this->AuthModel->auth();
        $url = [];
        foreach ($auth as $user) {
            $url[] = $user->url;
        }
        $controller =& get_instance();
        if (! in_array($controller->router->class, $url)) {
            return false;
        }else {
            return true;
        }
    }

    public function userActions($action) {
        $controller =& get_instance();

        $auth = $this->AuthModel->permissions($controller->router->class);
        $actions = [];
        foreach ($auth as $user) {
            $actions[] = $user->actions;
        }
        if (! in_array($action, $actions)) {
            return false;
        }else {
            return true;
        }
    }

    public function index() {
        $this->load->model('RoleModel');
        
        $data['title']    = 'USER MANAGEMENT';
        $data['auth']     = $this->AuthModel->auth();
        $data['roles']    = $this->RoleModel->all();
        $data['all']    = $this->UserModel->get_all_user();
        $data['inactive'] = $this->UserModel->get_all_user(0);
        $data['active']   = $this->UserModel->get_all_user(1);
        $this->template->app('user/index', $data);
    }

    public function datatables() {
        $status = $this->input->get('status');
        $where  = FALSE;
        if ($status) {
            $where = ['users.status' => $status];
        }
        $flag = ['users.flag' => 1];

        $users  = $this->UserModel->make_datatables($where, $flag);
        $data   = [];
        $i      = 1;
        foreach ($users as $user) {
            if ($user->status == 0) {
                $status = '<span class="text-danger">Inactive</span>';
            }else {
                $status = '<span class="text-active">Active</span>';
            }
            $sub    = [];
            $sub[]  = $i++;
            $sub[]  = $user->name;
            $sub[]  = $user->username;
            $sub[]  = $user->email;
            $sub[]  = '<span class="text-primary italic">'.$user->role_name.'</span>';
            $sub[]  = date('d M Y', strtotime($user->created_at));
            $sub[]  = $status;
            $sub[]  = '<button type="button" data-toggle="modal" data-target="#modal-edit" id="'.$user->id.'" class="badge badge-primary p-2 edit"><i class="fas fa-edit"></i></button>';
            $sub[]  = '<button type="button" data-toggle="modal" data-target="#modal-delete" id="'.$user->id.'" class="badge badge-danger p-2 delete"><i class="fas fa-trash"></i></button>';
            $data[] = $sub;
        }

        $output = [
            'draw'              => intval($_POST['draw']),
            'recordsTotal'      => $this->UserModel->get_all_user(),
            'recordsFiltered'   => $this->UserModel->get_filtered_data($where, $flag),
            'data'              => $data
        ];
        // header('Content-Type: application/json');
        echo json_encode($output);
    }

    public function store() {
        if (! $this->userActions('create')) {
            $data = ['error' => 'Permission denied !'];
        }else {    
            $name     = htmlspecialchars($this->input->post('name', true));
            $username = htmlspecialchars($this->input->post('username', true));
            $email    = htmlspecialchars($this->input->post('email', true));
            $role_id  = $this->input->post('role_id', true);
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

            if ($name != FALSE && $username != FALSE && $email != FALSE && $role_id != FALSE && $password != FALSE) {
                $this->UserModel->create([
                            'name'       => $name,
                            'username'   => $username,
                            'email'      => $email,
                            'role_id'    => $role_id,
                            'password'   => $password,
                            'status'     => 1,
                            'token'      => base64_encode(random_bytes(100)),
                            'created_at' => time(),
                            'updated_at' => time(),
                        ]);
                $data = ['success' => 'User successfully added'];
            } else {
                $data = ['error' => 'Error !'];
            }
        }
        echo json_encode($data);
    }

    public function show($id) {
        $user = $this->UserModel->find($id);
        echo json_encode($user);
    }

    public function update($id) {
        if (! $this->userActions('update')) {
            $data = ['error' => 'Permission denied !'];
        }else {
            $user = $this->UserModel->find($id);
            if ($user) {
                $name     = htmlspecialchars($this->input->post('name', true));
                $username = htmlspecialchars($this->input->post('username', true));
                $email    = htmlspecialchars($this->input->post('email', true));
                $role_id  = $this->input->post('role_id', true);
                $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                $status   = $this->input->post('status', true);

                if ($name != FALSE && $username != FALSE && $email != FALSE && $role_id != FALSE && $password != FALSE && $status < 2) {
                    $this->UserModel->update($user->id, [
                                    'name'       => $name,
                                    'username'   => $username,
                                    'email'      => $email,
                                    'role_id'    => $role_id,
                                    'password'   => $password,
                                    'status'     => $status,
                                    'updated_at' => time(),
                                ]);
                    $data = ['success' => 'User updated successfully'];
                    $auth = $this->AuthModel->auth();
                }else {
                    $data = ['error' => 'Input error !'];
                }
            }else {
                $data = ['error' => 'User not found !'];
            }
        }
        echo json_encode($data);
    }

    public function destroy($id) {
        if (! $this->userActions('delete')) {
            $data = ['error' => 'Permission denied !'];
        }else {
            $user = $this->UserModel->find($id);
            if ($user) {
                $this->UserModel->delete($user->id);
                $data = ['success' => 'User successfully deleted'];
                $auth = $this->AuthModel->auth();
            }else {
                $data = ['error' => 'User not found !'];
            }
        }
        echo json_encode($data);
    }

}