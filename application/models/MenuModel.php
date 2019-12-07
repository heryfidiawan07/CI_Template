<?php 

class MenuModel extends CI_model {

    var $table = 'menus';

    public function all() {
        return $this->db->get($this->table)->result();
    }

    public function where($data) {
    	return $this->db->get_where($this->table, $data);
    }
	
	public function create_batch($data) {
		return $this->db->insert_batch($this->table, $data);
	}
}