<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();

        $this->load->model('AuthModel');
        $this->AuthModel->auth();

		$this->load->library('template');
    }

    public function index() {
        $data['title'] = 'DASHBOARD';
        $data['auth']  = $this->AuthModel->auth();
        $this->template->app('dashboard', $data);
        // echo json_encode($data['auth']);
    }

}