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
class Options extends Admin_Controller {

    //put your code here
    var $template = 'admin/template';

    public function __construct() {
        parent::__construct();
        $this->load->model('m_option');
    }

    public function index() {
        if ($this->input->post('submit')) {
            $i = 1;
            foreach ($this->input->post('config') as $c) {
                $this->m_option->update(array('value' => mysql_escape_string($c)), $i);
                $i++;
            }
            
            $this->session->set_flashdata('success', 'Data updated');
            redirect('admin/options');
        }
        $this->data['option'] = $this->m_option->get_all();
        $this->data['content'] = 'admin/options/index';
        $this->load->view($this->template, $this->data);
    }

}