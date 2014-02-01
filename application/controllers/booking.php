<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of booking
 *
 * @author Syiewa
 */
Class Booking extends Frontend_Controller {

    var $template = 'web/template';

    public function __construct() {
        parent::__construct();
        add_meta_title('Booking');
        $this->load->library('cart');
        $this->load->model('m_user');
        $this->load->model('m_page');
        $this->load->model('m_promo');
        $this->load->model('m_room');
        $this->load->model('m_order');
    }

    public function index() {
//        $this->session->sess_destroy();
        $from = $this->input->post('from', TRUE) == '' ? $this->session->userdata('from') : $this->input->post('from', TRUE);
        $to = $this->input->post('to', TRUE) == '' ? $this->session->userdata('to') : $this->input->post('to', TRUE);
        $tgl = array(
            'from' => $from,
            'to' => $to,
        );
        $this->session->set_userdata($tgl);
        if ($this->cart->contents()) {
            $this->cart->destroy();
        }
        $this->data['rooms'] = $this->m_room->get_allroom();
        foreach ($this->data['rooms'] as $k => $v) {
            $gmbr = $this->m_kelas->get_gambardefault();
            foreach ($gmbr as $g => $s) {
                if ($this->data['rooms'][$k]->idclass == $gmbr[$g]->idclass) {
                    $this->data['rooms'][$k]->thumb = $gmbr[$g]->thumb;
                    $this->data['rooms'][$k]->image = $gmbr[$g]->image;
                }
            }
        }
        $this->data['content'] = 'web/booking/index';
        $this->load->view($this->template, $this->data);
    }

    public function guest($id = null) {
        $this->load->model('m_provinsi');
        $from = $this->input->post('from', TRUE) == '' ? $this->session->userdata('from') : $this->input->post('from', TRUE);
        $to = $this->input->post('to', TRUE) == '' ? $this->session->userdata('to') : $this->input->post('to', TRUE);
        $id = $this->input->post('idclass') == '' ? $this->session->userdata('idclass') : $this->input->post('idclass');
        $tgl = array(
            'from' => $from,
            'to' => $to,
            'idclass' => $id,
        );
        $this->session->set_userdata($tgl);
        if ($this->ion_auth->logged_in()) {
            $iduser = $this->session->userdata('user_id');
            $this->data['address'] = $this->m_user->get_by(array('user_id' => $iduser));
            $this->data['user'] = $this->ion_auth->user($iduser)->row();
            $user = $this->ion_auth->user($iduser)->row();
        }
        $this->data['prefix_name'] = array(
            'name' => 'prefix_name',
            'id' => 'prefix_name',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('prefix_name', empty($user->prefix_name) ? '' : $user->prefix_name),
        );
        $this->data['first_name'] = array(
            'name' => 'first_name',
            'data-validation' => 'required',
            'id' => 'first_name',
            'class' => 'form-control',
            'type' => 'text',
            'value' => $this->form_validation->set_value('first_name', empty($user->first_name) ? '' : $user->first_name),
        );
        $this->data['last_name'] = array(
            'name' => 'last_name',
            'data-validation' => 'required',
            'id' => 'last_name',
            'class' => 'form-control',
            'type' => 'text',
            'value' => $this->form_validation->set_value('last_name', empty($user->last_name) ? '' : $user->last_name),
        );
        $this->data['email'] = array(
            'name' => $this->ion_auth->logged_in() ? 'email' : 'email_confirmation',
            'data-validation' => 'email',
            'id' => 'email',
            'class' => 'form-control',
            'type' => 'email',
            !$this->ion_auth->logged_in() ? ' ' : 'readonly' => 'readonly',
            'value' => $this->form_validation->set_value('email_confirmation', empty($user->email) ? '' : $user->email),
        );
        $this->data['phone'] = array(
            'name' => 'phone',
            'data-validation' => 'required number',
            'id' => 'phone',
            'class' => 'form-control',
            'type' => 'text',
            'value' => $this->form_validation->set_value('phone', empty($user->phone) ? '' : $user->phone),
        );
        $this->data['provinsi'] = $this->m_provinsi->get_provinsi();
        $this->data['rooms'] = $this->m_room->get_room($id);
        if (!empty($this->data['rooms'])) {
            $data = array(
                'id' => $id,
                'qty' => $this->IntervalDays($from, $to) + 1,
                'price' => $this->data['rooms'][0]->net,
                'name' => $this->data['rooms'][0]->title,
            );
            $this->cart->insert($data);
        }
        $this->data['content'] = 'web/booking/guest_summary';
        $this->load->view($this->template, $this->data);
    }

    public function payment($id = null) {
        $this->load->model('m_provinsi');
        $this->data['provinsi'] = $this->m_provinsi->get_provinsi();
        $this->data['kota'] = $this->m_provinsi->get_allkota();
        $from = date('Y/m/d', strtotime($this->session->userdata('from')));
        $to = date('Y/m/d', strtotime($this->session->userdata('to')));
        if ($this->input->post('submit')) {
            $data = $this->m_order->array_from_post(array(
                'idclass', 'prefix_name', 'first_name', 'last_name', 'email', 'phone', 'alamat', 'zip', 'kota', 'provinsi', 'negara'
            ));
            if ($this->ion_auth->logged_in()) {
                $user_id = $this->session->userdata('user_id');
                $this->ion_auth->update($user_id, $data);

                //check to see if we are creating the user
                //redirect them back to the admin page
                $this->session->set_flashdata('message', "User Updated");
            }
            if ($this->input->post('signup') != false) {
                $username = strtolower($data['first_name']) . ' ' . strtolower($data['last_name']);
                $email = strtolower($data['email']);
                $password = $this->input->post('pass');
                $additional_data = array(
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'prefix_name' => $data['prefix_nama'],
                    'phone' => $data['phone'],
                );
                if ($this->ion_auth->register($username, $password, $email, $additional_data)) {
                    $data['user_id'] = $this->m_user->getid_users($email);
                } else {
                    $this->session->set_flashdata('error', $this->ion_auth->errors());
                    redirect('booking/guest');
                }
            }
            $this->session->set_userdata($data);
            $this->data['rooms'] = $this->m_room->get_room($data['idclass']);
            $this->data['content'] = 'web/booking/payment';
            $this->load->view($this->template, $this->data);
        }
//        $id = $this->input->post('idclass');
//        foreach ($id as $i) {
//            if ($this->input->post('check' . $i)) {
//                $id = $i;
//            }
//        }
//        if ($from == '' AND $to == '') {
//            $this->session->set_flashdata('error', 'Silahkan pilih tgl');
//            redirect('booking');
//        }
//        $this->data['rooms'] = $this->m_room->get_room($id);
//        if (!empty($this->data['rooms'])) {
//            $data = array(
//                'id' => $id,
//                'qty' => $this->IntervalDays($from, $to) + 1,
//                'price' => $this->data['rooms'][0]->net,
//                'name' => $this->data['rooms'][0]->title,
//            );
//            $this->cart->insert($data);
//        }
    }

    public function complete() {

        $data_user = array(
            'prefix_nama' => $this->session->userdata('prefix_nama'),
            'nama_depan' => $this->session->userdata('first_name'),
            'nama_belakang' => $this->session->userdata('last_name'),
            'email' => $this->session->userdata('email'),
            'telepon' => $this->session->userdata('phone'),
            'alamat' => $this->session->userdata('alamat'),
            'kota' => $this->session->userdata('kota'),
            'provinsi' => $this->session->userdata('provinsi'),
            'negara' => $this->session->userdata('negara'),
            'zip' => $this->session->userdata('zip'),
            'user_id' => $this->session->userdata('user_id'),
        );
        if ($this->m_user->cek_guest($data_user['user_id'])) {
            $this->m_user->update_by(array('user_id' => $data_user['user_id']), $data_user);
            $idguest = $this->m_user->get_by(array('user_id'=> $data_user['user_id']))->id;
        } else {
            $this->m_user->insert($data_user);
            $idguest = $this->db->insert_id();
        }
        $data_cc = $this->m_order->array_from_post(array(
            'cc_type', 'cc_number', 'cvv', 'cc_name'
        ));
        $data_cc['cc_date'] = date('Y-m-d', strtotime($date = '01-' . implode('-', $this->input->post('date', TRUE))));
        $data_cc['cc_userid'] = $idguest;
        if ($this->m_order->insert_cc($data_cc)) {
            $idcc= $this->db->insert_id();
            $data_order = array(
                'guest_id' => $idguest,
                'class_id' => $this->session->userdata('idclass'),
                'tgl_order' => date('Y-m-d'),
                'cc_id' => $idcc,
                'payment_total' => $this->cart->total(),
                'order_status' => 0,
                'check_in' => date('Y-m-d', strtotime($this->session->userdata('from'))),
                'check_out' => date('Y-m-d', strtotime($this->session->userdata('to'))),
            );
            $this->m_order->insert($data_order);
            $idorder = $this->db->insert_id();
            $this->load->library('email');
            $config['protocol'] = 'mail';
            $config['mailtype'] = 'html';
            $this->email->initialize($config);
            $this->email->to($this->session->userdata('email'));
            $this->email->from('test@test.net');
            $this->email->subject('Invoice - Hotel Edan');
            $message = '';
            $email['order'] = $this->m_order->get($idorder);
            $email['kelas'] = $this->m_kelas->get($this->session->userdata('idclass'));
            $email['paymentMethods'] = $this->m_order->paymentMethods;
            $email['status'] = $this->m_order->status;
            $message .= $this->load->view('web/booking/email', $email, TRUE);

            $this->email->message($message);
            $this->email->send();
            $this->data['content'] = 'web/booking/complete';
            $this->load->view($this->template, $this->data);
        }
    }

    private function IntervalDays($CheckIn, $CheckOut) {
        $CheckInX = explode("/", $CheckIn);
        $CheckOutX = explode("/", $CheckOut);
        $date1 = mktime(0, 0, 0, $CheckInX[1], $CheckInX[2], $CheckInX[0]);
        $date2 = mktime(0, 0, 0, $CheckOutX[1], $CheckOutX[2], $CheckOutX[0]);
        $interval = ($date2 - $date1) / (3600 * 24);

// returns numberofdays
        return $interval;
    }

    public function list_dropdown() {
        $user_id = $this->session->userdata('user_id');
        $this->load->model('m_provinsi');
        $id = $this->input->post('tnmnt');
        $cct = $this->input->post('csrf_test_name');
        $this->data['kota'] = $this->m_provinsi->get_kota($id);
        $this->data['user'] = $this->m_user->get_by(array('user_id' => $user_id));
        $this->load->view('web/booking/kota', $this->data);
    }

}

?>
