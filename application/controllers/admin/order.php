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
//        $this->load->library('Jquery_pagination');
//        $config['base_url'] = site_url('admin/order/ajax_page');
//        /* Here i am indicating to the url from where the pagination links and the table section will be fetched */
//        $config['full_tag_open'] = '<ul class="pagination">';
//        $config['full_tag_close'] = '</ul>';
//        $config['last_tag_close'] = '</li>';
//        $config['next_tag_open'] = '<li>';
//        $config['next_tag_close'] = '</li>';
//        $config['prev_tag_open'] = '<li>';
//        $config['prev_tag_close'] = '</li>';
//        $config['cur_tag_open'] = '<li><a href="#">';
//        $config['cur_tag_close'] = '</a></li>';
//        $config['num_tag_open'] = '<li>';
//        $config['num_tag_close'] = '</li>';
//        $config['div'] = '#display-content';
//        /* CSS selector  for the AJAX content */
//
//        $config['total_rows'] = count($this->m_order->get_all());
//        $config['per_page'] = 1;
//        $this->jquery_pagination->initialize($config);
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

//    public function ajax_page($offset = 0) {
//        $this->data['status'] = $this->m_order->status;
//        $this->data['orders'] = $this->m_order->get_recents($offset);
//        $this->data['pagination'] = $this->jquery_pagination->create_links();
//        $this->load->view('admin/orders/index', $this->data);
//    }
}

?>
