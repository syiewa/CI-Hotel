<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of order
 *
 * @author Syiewa
 */
class Order extends Admin_Controller {

    //put your code here
    var $template = 'admin/template';

    public function __construct() {
        parent::__construct();
        $this->load->model('m_order');
        $this->load->model('m_kelas');
        $this->load->model('m_user');
        $this->load->model('m_provinsi');
    }

    public function index() {

//        $this->data['status'] = $this->m_order->status;
//        $this->data['orders'] = $this->m_order->get_recents($offset, 1);
//        $this->data['pagination'] = $this->jquery_pagination->create_links();
//        $this->data['content'] = 'admin/orders/index';
//        $this->load->view($this->template, $this->data);
        $this->data['status'] = $this->m_order->status;
        $this->data['orders'] = $this->m_order->get_all();
        $this->data['content'] = 'admin/orders/index';
        $this->load->view($this->template, $this->data);
    }

    public function get_ajax($offset = 0) {
        $count = $this->m_order->get_all();
        $perpage = 5;
        if (count($count) > $perpage) {
            $this->load->library('pagination');
            $config['base_url'] = site_url('admin/order/get_ajax');
            $config['total_rows'] = count($count);
            $config['per_page'] = $perpage;
            $config['uri_segment'] = 4;
            $q = $this->pagination->initialize($config);
            $offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        } else {
            $this->data['pagination'] = '';
            $offset = 0;
        }
        $this->data['status'] = $this->m_order->status;
        $this->data['orders'] = $this->m_order->get_recents($offset, $perpage);
        $this->data['content'] = 'admin/orders/index';
        if ($this->input->post('ajax', FALSE)) {
            $data = array(
                'result' => $this->data["orders"],
                'status' => $this->data['status'],
                'pagination' => $this->pagination->create_links()
            );
            echo json_encode($data);
        }
    }

    public function details($id) {
        $this->load->model('m_room');
        $this->data['order'] = $this->m_order->get($id);
        $this->data['kelas'] = $this->m_kelas->get($this->data['order']->class_id);
        $this->data['room'] = $this->m_room->get_dropdown($this->data['order']->class_id);
        $this->data['guest'] = $this->m_user->get($this->data['order']->guest_id);
        $this->data['kota'] = $this->m_provinsi->get($this->data['guest']->kota);
        $this->data['provinsi'] = $this->m_provinsi->get_provinsi_id($this->data['guest']->provinsi);
        $this->data['cc'] = $this->m_order->get_cc($this->data['order']->cc_id);
        $this->data['status'] = $this->m_order->status[$this->data['order']->order_status];
        if ($this->input->post('submit')) {
            $status = $this->input->post('order_status');
            if ($status == 0) {
                $idroom = $this->input->post('room');
                if ($this->m_room->update(array('status' => 1, 'guest_id' => $this->data['order']->guest_id), $idroom)) {
                    if ($this->m_order->update(array('order_status' => 1), $id)) {
                        $this->session->set_flashdata('success', 'Order Approved');
                        redirect('admin/order/details/' . $id);
                    }
                }
            } elseif ($status == 1) {
                if ($this->m_order->update(array('order_status' => 2), $id)) {
                    $this->session->set_flashdata('success', 'Order Completed');
                    redirect('admin/order/details/' . $id);
                }
            }
        }
        if ($this->input->post('cancel')) {
            if ($this->m_order->update(array('order_status' => 3), $id)) {
                $this->session->set_flashdata('warning', 'Order Canceled');
                redirect('admin/order/details/' . $id);
            }
        }
        $this->data['content'] = 'admin/orders/details';
        $this->load->view($this->template, $this->data);
    }

    public function delete($id) {
        $id || show(404);
        if ($this->m_order->delete($id)) {
            $this->session->set_flashdata('warning', 'Order deleted');
            redirect('admin/order/');
        }
    }

//    public function ajax_page($offset = 0) {
//        $this->data['status'] = $this->m_order->status;
//        $this->data['orders'] = $this->m_order->get_recents($offset);
//        $this->data['pagination'] = $this->jquery_pagination->create_links();
//        $this->load->view('admin/orders/index', $this->data);
//    }
}

?>
