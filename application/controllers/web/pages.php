<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pages
 *
 * @author Syiewa
 */
Class Pages extends Admin_Controller {

    var $template = 'web/template';

    public function __construct() {
        parent::__construct();
//        $this->load->model('m_page');
    }
    
    public function index() {
        $this->data['content'] = 'web/pages/index';
        $this->load->view($this->template, $this->data);
    }
}

?>
