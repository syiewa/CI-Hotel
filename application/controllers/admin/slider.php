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
    var $gallerypath;
    var $gallery_path_url;

//put your code here
    public function __construct() {
        parent::__construct();
        $this->gallerypath = realpath(APPPATH . '../assets/img');
        $this->gallery_path_url = base_url() . 'assets/img/';
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

    public function add() {
        if ($this->input->post('submit')) {
            $data = $this->m_slide->array_from_post(array('slide_title', 'slide_desc'));
            $config = array(
                'allowed_types' => 'jpg|jpeg|gif|png',
                'upload_path' => $this->gallerypath,
                'max_size' => 2000,
                'file_name' => strtolower($data['slide_title'])
            );
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('slide_image')) {
                $file1 = $this->upload->data();
                $konfigurasi = array(
                    'source_image' => $file1['full_path'],
                    'new_image' => $this->gallerypath . '/thumbnails',
                    'maintain_ration' => true,
                    'width' => 100,
                    'height' => 120
                );
                $this->load->library('image_lib', $konfigurasi);
                $this->image_lib->resize();
                $data['slide_image'] = 'assets/img/' . $file1['file_name'];
                $data['slide_thumb'] = 'assets/img/thumbnails/' . $file1['file_name'];
                $this->m_slide->insert($data);
                $this->session->set_flashdata('success', 'Slide saved');
                redirect('admin/slider');
            }
        }
        echo 2;
        $this->data['content'] = 'admin/slider/add';
        $this->load->view('admin/modal', $this->data);
    }

    public function edit($id) {
        $this->data['slide'] = $this->m_slide->get($id);
        $this->data['content'] = 'admin/slider/edit';
        $this->load->view('admin/modal', $this->data);
    }

    public function delete_slide($id) {
        $this->m_slide->hapus_slide($id);
        $this->session->set_flashdata('success', 'Slide deleted');
        redirect('admin/slider');
    }

}

?>
