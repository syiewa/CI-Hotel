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
        $this->load->model('m_page');
        $this->load->model('m_promo');
        $this->load->model('m_room');
        $this->load->model('m_order');
    }

    public function index() {
//        $this->session->sess_destroy();
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
        $from = $this->input->post('from',TRUE);
        $to = $this->input->post('to',TRUE);
        $id = $this->input->post('idclass') == '' ? $this->session->userdata('idclass') : $this->input->post('idclass');
        if ($from == '' AND $to == '') {
            $this->session->set_flashdata('error', 'Silahkan pilih tgl');
            redirect('booking');
        }
        $tgl = array(
            'from' => $from,
            'to' => $to,
            'idclass' => $id,
        );
        $this->session->set_userdata($tgl);
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
        $from = date('Y/m/d', strtotime($this->session->userdata('from')));
        $to = date('Y/m/d', strtotime($this->session->userdata('to')));
        if ($this->input->post('submit')) {
            $data = $this->m_order->array_from_post(array(
                'idclass', 'prefix_nama', 'nama_depan', 'nama_belakang', 'email', 'telepon', 'alamat', 'zip', 'kota', 'provinsi', 'negara'
            ));
            $this->session->set_userdata($data);
            $this->data['rooms'] = $this->m_room->get_room($data['idclass']);
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
        $this->data['content'] = 'web/booking/payment';
        $this->load->view($this->template, $this->data);
    }

    public function complete() {
        $data_user = array(
            'prefix_nama' => $this->session->userdata('prefix_nama'),
            'prefix_nama' => $this->session->userdata('nama_depan'),
            'nama_depan' => $this->session->userdata('prefix_nama'),
            'nama_belakang' => $this->session->userdata('nama_belakang'),
            'email' => $this->session->userdata('email'),
            'telepon' => $this->session->userdata('telepon'),
            'alamat' => $this->session->userdata('alamat'),
            'kota' => $this->session->userdata('kota'),
            'provinsi' => $this->session->userdata('provinsi'),
            'negara' => $this->session->userdata('negara'),
            'zip' => $this->session->userdata('zip'),
        );
        if ($this->m_order->insert_guest($data_user)) {
            $iduser = $this->db->insert_id();
            $data_cc = $this->m_order->array_from_post(array(
                'cc_type', 'cc_number', 'cvv', 'cc_name'
            ));
            $data_cc['cc_date'] = date('Y-m-d', strtotime($date = '01-' . implode('-', $this->input->post('date',TRUE))));
            $data_cc['cc_userid'] = $iduser;
            if ($this->m_order->insert_cc($data_cc)) {
                $data_order = array(
                    'guest_id' => $iduser,
                    'class_id' => $this->session->userdata('idclass'),
                    'tgl_order' => date('Y-m-d'),
                    'payment_id' => '1',
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
    }

    private function IntervalDays($CheckIn, $CheckOut) {
        $CheckInX = explode("/", $CheckIn);
        $CheckOutX = explode("/", $CheckOut);
        $date1 = mktime(0, 0, 0, $CheckInX[0], $CheckInX[1], $CheckInX[2]);
        $date2 = mktime(0, 0, 0, $CheckOutX[0], $CheckOutX[1], $CheckOutX[2]);
        $interval = ($date2 - $date1) / (3600 * 24);

// returns numberofdays
        return $interval;
    }

}

?>
