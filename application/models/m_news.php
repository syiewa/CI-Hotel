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
class M_news extends MY_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
        parent::set_tabel('post_article', 'post_id');
    }

    public function get_one() {
        $new = array();
        $this->db->limit(1);
        $this->db->order_by('create_date', 'desc');
        $new = parent::get_all();
        return $new[0];
    }

}

?>
