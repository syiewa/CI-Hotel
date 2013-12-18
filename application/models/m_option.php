<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class M_option extends MY_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
        parent::set_tabel('options', 'idoptions');
    }
}
?>
