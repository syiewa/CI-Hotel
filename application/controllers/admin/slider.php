<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of slider
 *
 * @author Syiewa
 */
class slider extends Admin_Controller {

    var $template = 'admin/template';

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('m_slide');
    }

    public function index() {
        $this->data['slides'] = $this->m_slide->get_all();
        $this->data['content'] = 'admin/slider/index';
        $this->load->view($this->template, $this->data);
    }

    public function order_ajax() {
        // Save order from ajax call
        if (isset($_POST['sortableslide'])) {
            $this->m_slide->save_order($_POST['sortableslide']);
        }

        // Fetch all pages
        $this->data['slides'] = $this->m_slide->get_all();

        // Load view
        $this->load->view('admin/slider/order_ajax', $this->data);
    }

}

?>
