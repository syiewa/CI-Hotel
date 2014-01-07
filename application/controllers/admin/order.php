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
    }
    
    public function index() {
        $this->data['orders'] = $this->m_order->get_all();
        var_dump($this->data['orders']);die();
        $this->data['content'] = 'orders/index';
        $this->load->view($this->template,  $this->data);
    }

}

?>
