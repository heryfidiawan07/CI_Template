<?php 

class UserModel extends CI_model {

    // DataTable ========================================================================================
    var $table         = 'users';
    var $select_column = ['users.id', 'users.name', 'username', 'email', 'roles.name as role_name', 'users.created_at', 'users.status', 'users.flag'];
    var $order_column  = [null, 'users.name', 'username', 'email', 'roles.name as role_name', 'users.created_at', 'users.status', null, null];

    public function make_query($where = NULL, $flag = NULL) {
        $this->db->select($this->select_column);
        $this->db->from($this->table);
        $this->db->join('roles', 'roles.id = users.role_id');
        
        if ($where != NULL) {
            $this->db->where($where);
        }elseif($flag != NULL) {
            $this->db->where($flag);
        }else {
            if (isset($_POST['search']['value'])) {
                $this->db->like('users.name', $_POST['search']['value']);
                $this->db->or_like('username', $_POST['search']['value']);
                $this->db->or_like('email', $_POST['search']['value']);
                $this->db->or_like('roles.name', $_POST['search']['value']);
            }
            if (isset($_POST['order'])) {
                $this->db->order_by(
                    $this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']
                );
            }else {
                $this->db->order_by('id', 'DESC');
            }
        }

    }

    public function make_datatables($where = NULL, $flag = NULL) {
        $this->make_query($where, $flag);
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function get_filtered_data($where = NULL, $flag = NULL) {
        $this->make_query($where, $flag);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_all_user($status = NULL) {
        $this->db->select($this->select_column);
        $this->db->from($this->table);
        $this->db->where(['users.flag' => 1]);
        if (isset($status)) {
            $this->db->where('users.status',$status);
        }
        return $this->db->count_all_results();
    }

    // End DataTable ========================================================================================

    public function all() {
        $this->db->where(['users.flag' => 1]);
        return $this->db->get($this->table)->result();
    }

    public function find($id) {
        $this->db->where(['users.flag' => 1]);
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function where($data) {
        $this->db->where(['users.flag' => 1]);
        return $this->db->get_where($this->table, $data);
    }
    
    public function create($data) {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data) {
        $this->db->where('id',$id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id) {
        $this->db->where('id',$id);
        return $this->db->update($this->table, ['flag' => 0]);
    }

    public function destroy($id) {
        $this->db->where('id',$id);
        return $this->db->where('id', $id)->delete($this->table);
    }

}