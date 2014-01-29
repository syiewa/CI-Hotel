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
    }

    public function index() {
        $count = $this->m_order->get_all();
        $perpage = 1;
        if (count($count) > $perpage) {
            $this->load->library('pagination');
            $config['base_url'] = site_url('admin/order/index');
            $config['total_rows'] = count($count);
            $config['per_page'] = $perpage;
            $config['uri_segment'] = 4;
            $q = $this->pagination->initialize($config);
            $offset = $this->uri->segment(4);
        } else {
            $this->data['pagination'] = '';
            $offset = 0;
        }
        $this->data['status'] = $this->m_order->status;
        $this->data['orders'] = $this->m_order->get_recents($offset, $perpage);
        $this->data['pagination'] = $this->pagination->create_links();
        $this->data['content'] = 'admin/orders/index';
        $this->load->view($this->template, $this->data);
    }

}

?>
