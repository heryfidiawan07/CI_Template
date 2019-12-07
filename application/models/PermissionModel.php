<?php 

class PermissionModel extends CI_model {

    var $table = 'permissions';
    
    public function create_batch($data) {
        return $this->db->insert_batch($this->table, $data);
    }

    public function where($data) {
    	return $this->db->get_where($this->table, $data);
    }

    public function delete($role_id) {
        return $this->db->delete($this->table, ['role_id' => $role_id]);
    }

}