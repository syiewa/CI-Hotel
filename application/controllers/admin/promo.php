<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of promo
 *
 * @author Syiewa
 */
class Promo extends Admin_Controller {

    //put your code here
    var $template = 'admin/template';
    var $aktif = array(
        '0' => 'Non-Aktif',
        '1' => 'Aktif'
    );

    public function __construct() {
        parent::__construct();
        $this->load->model('m_promo');
        $this->load->model('m_kelas');
    }

    public function index() {
        $this->data['promo'] = $this->m_promo->get(1);
        $this->data['class'] = $this->m_kelas->get_dropdown();
        $this->data['content'] = 'admin/promo/index';
        $this->load->view($this->template, $this->data);
    }

    public function aktif($id = 0, $aktif = 0) {
        $id OR redirect(site_url('admin/promo'));
        $this->m_promo->update(array('status' => $aktif), $id);
        redirect(site_url('admin/promo'));
    }

    public function edit($id = 1) {
        $this->data['promo'] = $this->m_promo->get(1);
        $this->data['aktif'] = $this->aktif;
        $this->data['class'] = $this->m_kelas->get_dropdown();
        if ($this->input->post('update')){
            $data = $this->m_promo->array_from_post(array('idclass','title','discount','start_date','end_date','description','status'));
            $this->m_promo->update($data,$id);
            $this->session->set_flashdata('success', 'Promosi Updated');
            redirect('admin/promo');
        }
        
        
        $this->data['content'] = 'admin/promo/edit';
        $this->load->view('admin/modal', $this->data);
    }

}

?>
