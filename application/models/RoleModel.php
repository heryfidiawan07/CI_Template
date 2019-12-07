<?php 

class RoleModel extends CI_model {

    // DataTable ========================================================================================
    var $table         = 'roles';
    var $select_column = ['id', 'name', 'status', 'flag'];
    var $order_column  = [null, 'name', 'status', null, null];

    public function make_query($where = NULL, $flag = NULL) {
        $this->db->select($this->select_column);
        $this->db->from($this->table);
        if ($where != NULL) {
            $this->db->where($where);
        }elseif($flag != NULL) {
            $this->db->where($flag);
        }else {
            if (isset($_POST['search']['value'])) {
                $this->db->like('name', $_POST['search']['value']);
                $this->db->or_like('status', $_POST['search']['value']);
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

    public function get_all_role($status = NULL) {
        $this->db->select($this->select_column);
        $this->db->from($this->table);
        $this->db->where(['flag' => 1]);
        if (isset($status)) {
            $this->db->where('status',$status);
        }
        return $this->db->count_all_results();
    }

    // End DataTable ========================================================================================

    public function where($data) {
        $this->db->where(['flag' => 1]);
        return $this->db->get_where($this->table, $data);
    }

    public function all() {
        $this->db->where(['flag' => 1]);
        return $this->db->get($this->table)->result();
    }

    public function find($id) {
        $this->db->where(['flag' => 1]);
        return $this->db->get_where($this->table, ['id' => $id])->row();
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