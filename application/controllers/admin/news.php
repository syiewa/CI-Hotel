<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of kelas
 *
 * @author Syiewa
 */
class News extends Admin_Controller {

    //put your code here
    var $template = 'admin/template';

    public function __construct() {
        parent::__construct();
        $this->load->model('m_news');
    }

    public function index() {
        $this->data['news'] = $this->m_news->get_all();
        $this->data['content'] = 'admin/berita/index';
        $this->load->view($this->template, $this->data);
    }

    public function add() {
        if ($this->input->post('submit')) {
            $data = $this->m_news->array_from_post(array('title', 'post_entry'));
            $data['create_date'] = date('Y-m-d', now());
            $data['create_by'] = 'admin';
            $this->m_news->insert($data);
            $this->session->set_flashdata('success', 'Berita/Artikel created');
            redirect('admin/news/index');
        }
        $this->data['news'] = $this->m_news->get_all();
        $this->data['content'] = 'admin/berita/add';
        $this->load->view('admin/modal', $this->data);
    }

    public function edit($id) {
        if ($this->input->post('update')) {
            $data = $this->m_news->array_from_post(array('title', 'post_entry'));
            $this->m_news->update($data, $id);
            $this->session->set_flashdata('success', 'Berita/Artikel updated');
            redirect('admin/news/index');
        }
        $this->data['news'] = $this->m_news->get($id);
        $this->data['content'] = 'admin/berita/edit';
        $this->load->view('admin/modal', $this->data);
    }

    public function delete($id) {
        if ($this->m_news->delete($id)) {
            $this->session->set_flashdata('success', 'News deleted');
            redirect('admin/news');
        }
    }

}

?>