<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of rooms
 *
 * @author Syiewa
 */
class Rooms extends Admin_Controller {

    //put your code here
    var $template = 'admin/template';

    public function __construct() {
        parent::__construct();
        $this->load->model('m_room');
        $this->load->model('m_kelas');
    }

    public function index() {
        $this->data['kelas'] = $this->m_kelas->get_all();
        if (isset($_GET['id'])) {
            $this->data['kelasget'] = $this->m_kelas->get($_GET['id']);
            $this->data['room'] = $this->m_room->get_by(array('idclass' => $_GET['id']));
            $this->data['rooms'] = $this->m_room->get_many_by(array('idclass' => $_GET['id']));
            $this->data['jumlah'] = count($this->data['rooms']);
        }

        if ($this->input->post('update')) {
            $data = $this->m_room->array_from_post(array('idclass', 'namespace'));
            $data['status'] = 0;
            $jumlah = $this->input->post('jumlah');
            $jum_kamar = count($this->m_room->get_many_by(array('idclass' => $data['idclass']))) + 1;
            for ($i = $jum_kamar; $i <= $jumlah; $i++) {
                $data['numbers'] = $data['namespace'] . '-' . $i;
                $this->m_room->save($data);
            }
            $this->session->set_flashdata('success', 'Kamar Terupdated');
            redirect('admin/rooms');
        }
        $this->data['content'] = 'admin/rooms/index';
        $this->load->view($this->template, $this->data);
    }

    public function aktif($id = 0, $aktif = 0) {
        $id OR redirect(site_url('admin/rooms'));
        $this->m_room->update(array('status' => $aktif), $id);
        redirect(site_url('admin/rooms'));
    }

}

?>
