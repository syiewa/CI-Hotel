<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of m_kelas
 *
 * @author Syiewa
 */
class M_promo extends MY_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
        parent::set_tabel('promote', 'idpromo');
    }
    
    public function get_promokelas(){
        $this->db->select('promote.idpromo, class.title as "nmclass", class.price, promote.discount, promote.start_date, promote.end_date, promote.description as "desc", promote.title as "prom", class.photoclass');
        $this->db->join('class','promote.idclass = class.idclass');
        return parent::get_all();
    }

}

?>
