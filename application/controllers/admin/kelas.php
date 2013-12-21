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
        $this->load->view('admin/modal', $this->data);
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

    public function gambar($id = 0) {
        $id OR redirect(site_url('admin/kelas'));
        $this->data['kelas'] = $this->m_kelas->get($id);
        $this->data['gambar'] = $this->m_kelas->get_gambar($id);

        $this->load->library('jcrop');
//
        $prefix = md5($this->data['kelas']->idclass);
        $this->data['prefix'] = $prefix;
        $this->data['target_w'] = 180;
        $this->data['target_h'] = 150;
        $setdata = array(
            'prefix' => $prefix,
            'folder' => 'assets/img/',
            'thumb_folder' => 'assets/img/thumbnails/',
            'target_w' => $this->data['target_w'],
            'target_h' => $this->data['target_h'],
            'create_thumb' => TRUE
        );
        $this->jcrop->set_data($setdata);
        $action_form = site_url($this->uri->uri_string());


        //Upload Process
        if (isset($_POST[$prefix . 'submit'])) {
            $this->jcrop->uploading($status);
            $this->data['status'] = $status;
        }

        //Saving data
        if (isset($_POST[$prefix . 'save'])) {

            $this->jcrop->produce($pic_loc, $pic_path, $thumb_loc, $thumb_path);
            $input = array('idclass' => $this->data['kelas']->idclass,
                'image' => $pic_path,
                'thumb' => $thumb_path);

            $this->m_kelas->tambah_gambar($input);
            $this->session->set_flashdata('success', 'Gambar Saved');
            //$this->hotels->update($id,$input);
            redirect(site_url('admin/kelas/gambar/' . $id));
        }

        //Cancel uploading image
        if (isset($_POST[$prefix . 'cancel'])) {
            $this->jcrop->cancel();
        }

        //Cek if image has uploaded
        if ($this->jcrop->is_uploaded($thepicture, $orig_w, $orig_h, $ratio)) {
            $this->data['orig_w'] = $orig_w;
            $this->data['orig_h'] = $orig_h;
            $this->data['ratio'] = $ratio;
            $this->data['thepicture'] = $thepicture;
            $this->data['form'] = $this->jcrop->show_form($action_form, TRUE);
        } else {
            $this->data['form'] = $this->jcrop->show_form($action_form);
        }
        $this->data['content'] = 'admin/gambar/index';
        $this->load->view($this->template, $this->data);
    }

    public function hapus_foto($id = 0, $id_foto = 0) {
        $id OR redirect(site_url('admin/kelas/gambar'));

        $this->m_kelas->hapus_foto($id_foto);
        $this->session->set_flashdata('success', 'Gambar Deleted');
        redirect(site_url('admin/kelas/gambar/' . $id));
    }

    public function set_default($id = 0, $id_foto = 0) {
        $id OR redirect(site_url('admin/kelas/gambar'));

        $this->m_kelas->set_default($id, $id_foto);

        redirect(site_url('admin/kelas/gambar/' . $id));
    }

}

?>
