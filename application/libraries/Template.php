<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Template {
    
    var $ci;
    
    function __construct() {
        $this->ci =& get_instance();
    }
    
    function app($content, $data = NULL){
        $data['header']  = $this->ci->load->view('template/header', $data, TRUE);
        $data['content'] = $this->ci->load->view($content, $data, TRUE);
        $data['footer']  = $this->ci->load->view('template/footer', $data, TRUE);
        
        $this->ci->load->view('template/index', $data);
    }

}
