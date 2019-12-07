<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('AuthModel');
        $this->load->model('RoleModel');
        $this->load->model('MenuModel');
        $this->load->model('PermissionModel');

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
        $this->load->model('MenuModel');

        $data['title']    = "ROLE MANAGEMENT";
        $data['auth']     = $this->AuthModel->auth();
        $data['menus']    = $this->MenuModel->all();
        $data['all']      = $this->RoleModel->get_all_role();
        $data['inactive'] = $this->RoleModel->get_all_role(0);
        $data['active']   = $this->RoleModel->get_all_role(1);
        $this->template->app('role/index', $data);
    }

    public function datatables() {
        $status = $this->input->get('status');
        $where  = FALSE;
        if ($status) {
            $where = ['status' => $status];
        }
        $flag = ['roles.flag' => 1];

        $roles = $this->RoleModel->make_datatables($where, $flag);
        $data  = [];
        $prvls = [];
        $i     = 1;
        foreach ($roles as $role) {
            if ($role->status == 0) {
                $status = '<span class="text-danger">Inactive</span>';
            }else {
                $status = '<span class="text-active">Active</span>';
            }
            $this->db->group_by('menu_id');
            $permissions = $this->PermissionModel->where(['role_id' => $role->id])->result();
            $menus = [];
            foreach ($permissions as $key => $permission) {
                $menu = $this->MenuModel->where(['id' => $permissions[$key]->menu_id])->row();
                $menus[] = strtoupper($menu->name);
            }

            $sub    = [];
            $sub[]  = $i++;
            $sub[]  = $role->name;
            $sub[]  = $status;
            $sub[]  = $menus;
            $sub[]  = '<button type="button" class="badge badge-secondary pl-2 pr-2 pt-1 pb-1 details" data-toggle="modal" data-target="#role-details" id="'.$role->id.'"><i class="fas fa-info-circle"></i></button>';
            $sub[]  = '<button type="button" data-toggle="modal" data-target="#modal-edit" id="'.$role->id.'" class="badge badge-primary p-2 edit"><i class="fas fa-edit"></i></button>';
            $sub[]  = '<button type="button" data-toggle="modal" data-target="#modal-delete" id="'.$role->id.'" class="badge badge-danger p-2 delete"><i class="fas fa-trash"></i></button>';
            $data[] = $sub;
        }

        $output = [
            'draw'            => intval($_POST['draw']),
            'recordsTotal'    => $this->RoleModel->get_all_role(),
            'recordsFiltered' => $this->RoleModel->get_filtered_data($where, $flag),
            'data'            => $data
        ];
        // header('Content-Type: application/json');
        echo json_encode($output);
    }

    public function role_details($role_id) {
        $roles = $this->RoleModel->where(['id' => $role_id])->result();
        $data = [];
        foreach ($roles as $key => $role) {
            $data[] = $role->name;
            $this->db->select('menu_id');
            $this->db->where(['role_id' => $role->id]);
            $this->db->group_by('menu_id');
            $getMenus = $this->db->get('permissions')->result();
            foreach ($getMenus as $getMenu) {
                $menu = $this->MenuModel->where(['id' => $getMenu->menu_id])->result();
                $this->db->select(['action', 'menu_id']);
                $this->db->where(['role_id' => $role->id]);
                $this->db->where(['menu_id' => $menu[0]->id]);
                $permissions = $this->db->get('permissions')->result();
                $data[] = [ 
                        0 => [
                            'id' => $menu[0]->id,
                            'name' => $menu[0]->name,
                            'actions' => $permissions
                        ]
                    ];
            }
        }
        echo json_encode($data);
    }

    public function store() {
        if (! $this->userActions('create')) {
            $data = ['error' => 'Permission denied !'];
        }else {
            $name    = $this->input->post('name');
            $menu_id = $this->input->post('menu_id');
            $auth    = $this->AuthModel->auth();


            $actions = [];
            foreach ($menu_id as $menu) {
                $actions[] = $this->input->post($menu.'_action');
            }

            if ($menu_id && $name != '') {
                $this->RoleModel->create([
                        'name' => $name,
                        'status' => 1,
                        'user_id' => $auth[0]->id,
                        'created_at' => time(),
                        'updated_at' => time(),
                    ]);
                $role_id = $this->db->insert_id();

                $permissions = [];
                for ($i = 0; $i < count($menu_id); $i++) {
                    for ($a = 0; $a < count($actions[$i]); $a++) {
                        array_push($permissions, [
                            'role_id' => $role_id,
                            'menu_id' => $menu_id[$i],
                            'actions'  => $actions[$i][$a],
                            'created_at' => time(),
                            'updated_at' => time(),
                        ]);
                    }
                }
                $this->PermissionModel->create_batch($permissions);
                $data = ['success' => 'Role successfully added'];
            }else {
                $data = ['error' => 'Menu must be required !'];
            }
        }
        echo json_encode($data);
    }

    public function all() {
        $roles = $this->RoleModel->all();
        echo json_encode($roles);
    }

    public function find($id) {
        $role = $this->RoleModel->find($id);
        echo json_encode($role);
    }

    public function update($id) {
        if (! $this->userActions('update')) {
            $data = ['error' => 'Permission denied !'];
        }else {
            $name    = $this->input->post('name_edit');
            $menu_id = $this->input->post('menu_id');
            $auth    = $this->AuthModel->auth();

            $actions = [];
            foreach ($menu_id as $menu) {
                $actions[] = $this->input->post($menu.'_action');
            }

            if ($menu_id && $name != '') {
                $role = $this->RoleModel->find($id);
                if ($role) {

                    $this->RoleModel->update($role->id, [
                        'name' => $name,
                        'status' => 1,
                        'user_id' => $auth[0]->id,
                        'created_at' => time(),
                        'updated_at' => time(),
                    ]);

                    // Delete perission then create new permission
                    if ($this->PermissionModel->delete($role->id)) {
                        $permissions = [];
                        for ($i = 0; $i < count($menu_id); $i++) {
                            for ($a = 0; $a < count($actions[$i]); $a++) {
                                array_push($permissions, [
                                    'role_id' => $role->id,
                                    'menu_id' => $menu_id[$i],
                                    'actions'  => $actions[$i][$a],
                                    'created_at' => time(),
                                    'updated_at' => time(),
                                ]);
                            }
                        }
                        $this->PermissionModel->create_batch($permissions);
                    }
                    $data = ['success' => 'Role successfully update'];
                }else {
                    $data = ['error' => 'Role not found !'];
                }
            }else {
                $data = ['error' => 'Menu must be required !'];
            }
        }
        echo json_encode($data);
    }

    public function destroy($id) {
        if (! $this->userActions('delete')) {
            $data = ['error' => 'Permission denied !'];
        }else {
            $role = $this->RoleModel->find($id);
            if (! $role) {
                $data = ['error' => 'Role not found !'];
            }else {
                // Delete permission
                $this->PermissionModel->delete($role->id);
                // Delete Role
                $this->RoleModel->delete($role->id);
                $data = ['success' => 'Role successfully deleted'];
                $auth = $this->AuthModel->auth();
            }
        }
        echo json_encode($data);
    }

}