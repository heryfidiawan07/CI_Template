<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migrate extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('migration');
    }
    
    public function index() {
        $data = $this->migration->find_migrations();
        // var_dump($data);
        // echo json_encode($data);
        // $this->migration->version('007'); // 001, 002, 003 ....
        // if ($this->migration->current() === FALSE) {
        //         show_error($this->migration->error_string());
        // } else {
        //     // base_url/migration => to generate table
        //     $this->migration->version('008'); // 001, 002, 003 ....
        //     echo 'Migration created !';
        // }
        // foreach ($data as $key => $value) {
        //     if ($this->migration->current() === FALSE) {
        //         show_error($this->migration->error_string());
        //     } else {
        //     	// base_url/migration => to generate table
        //         $this->migration->version($key);
        //         echo 'Migration created !';
        //     }
        // }
    }

}