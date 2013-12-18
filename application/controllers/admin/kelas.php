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
class Kelas extends Admin_Controller {

    //put your code here
    var $template = 'admin/template';

    public function __construct() {
        parent::__construct();
        $this->load->model('m_kelas');
    }

    public function index() {
        $this->data['kelas'] = $this->m_kelas->get_all();
        foreach ($this->data['kelas'] as $k => $v) {
            $fas = $this->m_kelas->get_fac($this->data['kelas'][$k]->idclass);
            $this->data['kelas'][$k]->fasilitas = $fas;
        }
        $this->data['content'] = 'admin/kelas/index';
        $this->load->view($this->template, $this->data);
    }

    public function edit($id) {
        $this->data['kelas'] = $this->m_kelas->get($id);
        if ($this->input->post('submit')) {
            $this->m_kelas->del_fac($id);
            $fasil = array('lcd', 'wifi', 'breakfast', 'safe', 'bath', 'dinner', 'parking', 'laundry');
            $fas_title = array('LCD', 'WiFi', 'Sarapan', 'Pelayanan Hotel Plus', 'Kamar Mandi', 'Makan Malam', 'Parkir', 'Laundry');
            for ($i = 0; $i < sizeof($fasil); $i++) {
                $fas = $this->input->post($fasil[$i]);
                if ($fas) {
                    $this->m_kelas->insert_fac(array('idclass' => $id, 'fac' => $fas, 'title' => $fas_title[$i], 'status' => 1));
                } else {
                    $this->m_kelas->insert_fac(array('idclass' => $id, 'fac' => $fasil[$i], 'title' => $fas_title[$i], 'status' => 0));
                }
            }
            $data = $this->m_kelas->array_from_post(array('title', 'price', 'description'));
            $this->m_kelas->save($data, $id);
            $this->session->set_flashdata('success', 'Room Edited');
            redirect('admin/kelas');
        }
        $this->data['content'] = 'admin/kelas/edit';
        $this->load->view('admin/modal',$this->data);
    }

    public function add() {
        if ($this->input->post('submit')) {
            $fasil = array('lcd', 'wifi', 'breakfast', 'safe', 'bath', 'dinner', 'parking', 'laundry');
            $fas_title = array('LCD', 'WiFi', 'Sarapan', 'Pelayanan Hotel Plus', 'Kamar Mandi', 'Makan Malam', 'Parkir', 'Laundry');
            $data = $this->m_kelas->array_from_post(array('title', 'price', 'description'));
            $this->m_kelas->save($data);
            $id = $this->db->insert_id();
            for ($i = 0; $i < sizeof($fasil); $i++) {
                $fas = $this->input->post($fasil[$i]);
                if ($fas) {
                    $this->m_kelas->insert_fac(array('idclass' => $id, 'fac' => $fas, 'title' => $fas_title[$i], 'status' => 1));
                } else {
                    $this->m_kelas->insert_fac(array('idclass' => $id, 'fac' => $fasil[$i], 'title' => $fas_title[$i], 'status' => 0));
                }
            }
            $this->session->set_flashdata('success', 'Room Saved');
            redirect('admin/kelas');
        }
        $this->data['content'] = 'admin/kelas/add';
        $this->load->view('admin/modal', $this->data);
    }

    public function delete($id) {
        if ($this->m_kelas->delete($id)) {
            $this->m_kelas->del_fac($id);
            $this->session->set_flashdata('success', 'Room deleted');
            redirect('admin/kelas');
        }
    }

}

?>
