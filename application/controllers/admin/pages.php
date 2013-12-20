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

    var $template = 'admin/template';

    public function __construct() {
        parent::__construct();
        $this->load->model('m_page');
    }

    public function index() {
        $this->data['pages'] = $this->m_page->get_with_parent();
        $this->data['content'] = 'admin/pages/index';
        $this->load->view($this->template, $this->data);
    }

    function order_ajax() {
        // Save order from ajax call
        if (isset($_POST['sortable'])) {
            $this->m_page->save_order($_POST['sortable']);
        }

        // Fetch all pages
        $this->data['pages'] = $this->m_page->get_nested();
        $this->data['status'] = $this->m_page->status;

        // Load view
        $this->load->view('admin/pages/order_ajax', $this->data);
    }

}

?>
