<?php

class Frontend_Controller extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->data['meta_title'] = 'Admin Page';
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('ion_auth');
        $this->load->helper('url');

        // Load MongoDB library instead of native db driver if required
        $this->config->item('use_mongodb', 'ion_auth') ?
                        $this->load->library('mongo_db') :
                        $this->load->database();
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
        $this->load->helper('language');
        // Load stuff
        $this->load->model('m_option');
        $this->load->model('m_kelas');
        $this->load->model('m_page');

        // Fetch navigation
        $this->data['menu'] = $this->m_page->get_nested();
        $this->data['class'] = $this->m_kelas->get_dropdown();
        $this->data['meta_title'] = '';
    }

}