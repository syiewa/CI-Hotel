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
    var $gallerypath;
    var $gallery_path_url;

    public function __construct() {
        parent::__construct();
        $this->load->model('m_news');
        $this->gallerypath = realpath(APPPATH . '../assets/img');
        $this->gallery_path_url = base_url() . 'assets/img/';
    }

    public function index() {
        $this->data['news'] = $this->m_news->get_all();
        $this->data['content'] = 'admin/berita/index';
        $this->load->view($this->template, $this->data);
    }

    public function add() {
        if ($this->input->post('submit')) {
            $data = $this->m_news->array_from_post(array('title', 'post_entry'));
            $config = array(
                'allowed_types' => 'jpg|jpeg|gif|png',
                'upload_path' => $this->gallerypath,
                'max_size' => 2000,
                'file_name' => strtolower($data['title'])
            );
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('featurephoto')) {
                $file1 = $this->upload->data();
                $konfigurasi = array(
                    'source_image' => $file1['full_path'],
                    'new_image' => $this->gallerypath . '/thumbnails',
                    'maintain_ratio' => false,
                    'width' => 300,
                    'height' => 100
                );
                $this->load->library('image_lib', $konfigurasi);
                $this->image_lib->resize();
                $data['featurephoto'] = $file1['file_name'];
                $data['create_date'] = date('Y-m-d', now());
                $data['create_by'] = 'admin';
                $this->m_news->insert($data);
                $this->session->set_flashdata('success', 'Berita/Artikel created');
                redirect('admin/news/index');
            }
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