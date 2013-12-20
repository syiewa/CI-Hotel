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

    public function add() {
        if ($this->input->post('submit')) {
            $data = $this->m_page->array_from_post(array('title', 'parent', 'body'));
            $data['created'] = date('Y-m-d H:i:s');
            $data['slug'] = strtolower($data['title']);
            if ($this->m_page->insert($data)) {
                $this->session->set_flashdata('message', 'Halaman Baru berhasil ditambahkan');
                redirect('admin/pages');
            }
        }
        $this->data['pages_no_parents'] = $this->m_page->get_no_parents();
        $this->data['content'] = 'admin/pages/add';
        $this->load->view('admin/modal', $this->data);
    }

    public function edit($id = NULL) {
        $this->data['page'] = $this->m_page->get($id);
        if ($this->input->post('submit')) {
            $data = $this->m_page->array_from_post(array('title', 'parent', 'body'));
            $data['created'] = date('Y-m-d H:i:s');
            $data['slug'] = strtolower($data['title']);
            if ($this->m_page->insert($data)) {
                $this->session->set_flashdata('message', 'Halaman Baru berhasil ditambahkan');
                redirect('admin/pages');
            }
        }
        $this->data['pages_no_parents'] = $this->m_page->get_no_parents();
        $this->data['content'] = 'admin/pages/edit';
        $this->load->view('admin/modal', $this->data);
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
