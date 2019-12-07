<?php

Class DummyData extends CI_Controller{

    $this->load->helper('url');
    
    public function users() {
        // base url /DummyData/users
        $data = 100;
        for ($i=1; $i <= $data; $i++){
            $data = [
                "name"       => $name = 'User ' . $i,
                "slug"       => url_title($name, 'dash', true),
                "email"      => strtolower(str_replace(" ", ".", $name)) . '@mail.com',
                'password'   => password_hash('password', PASSWORD_DEFAULT),
                'img'        => 'user.png',
                'role'       => 0,
                'status'     => 1,
                'token'      => base64_encode(random_bytes(100)),
                'created_at' => time(),
                'updated_at' => time(),
            ];
            $this->db->insert('users', $data); 
        }
        echo $i . ' User data successfully created';
    }

    public function company() {
        // base url /DummyData/company
        $data = 100;
        for ($i=1; $i <= $data; $i++){
            $data = [
                "name"       => $name = 'PT Company ' . $i,
                "npwp"       => '001122334400'.$i,
                "phone"      => '08221317314'.$i,
                'address'    => 'Jl Address lorem ipsum - '.$i,
                'created_at' => time(),
                'updated_at' => time(),
            ];
            $this->db->insert('company', $data); 
        }
        echo $i . ' User data successfully created';
    }
    
}
?>