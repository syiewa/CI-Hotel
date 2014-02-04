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

    public function get_promokelas() {
        $this->db->select('promote.idpromo, class.title as "nmclass", class.price, promote.discount, promote.start_date, promote.end_date, promote.description as "desc", promote.title as "prom", foto_produk.thumb');
        $this->db->join('class', 'promote.idclass = class.idclass','left');
        $this->db->join('foto_produk', 'promote.idclass = foto_produk.idclass','left');
        $this->db->where('promote.end_date >=', date('Y-m-d'));
        $this->db->where('promote.status', 1);
        $this->db->group_by('promote.idpromo');
        return parent::get_all();
    }

}

?>
