<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of users
 *
 * @author Syiewa
 */
class Kelas extends Admin_Controller {

    //put your code here
    var $template = 'admin/template';

    public function __construct() {
        parent::__construct();
        $this->load->model('m_user');
    }

}

?>
