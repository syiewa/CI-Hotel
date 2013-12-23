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
class M_room extends MY_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
        parent::set_tabel('rooms', 'idrooms');
    }

    public function get_allroom() {
        $data = $this->db->query(
                'SELECT r.* , c.price , c.`title` , 
                IFNULL(p.discount,0) AS discount , 
                IFNULL((c.price - c.`price` * (p.discount / 100)) , c.price) AS net  FROM rooms r
                LEFT JOIN class c ON c.`idclass` = r.`idclass`
                LEFT JOIN promote p ON p.`idclass` = r.`idclass`
                WHERE r.status = 0 
                GROUP BY idclass');
        return $data->result();
    }

    public function get_room($id = null) {
        $data = $this->db->query(
                'SELECT r.* , c.price , c.`title` , 
                IFNULL(p.discount,0) AS discount , 
                IFNULL((c.price - c.`price` * (p.discount / 100)) , c.price) AS net  FROM rooms r
                LEFT JOIN class c ON c.`idclass` = r.`idclass`
                LEFT JOIN promote p ON p.`idclass` = r.`idclass`
                WHERE r.status = 0 AND r.idclass= ' . $id . '
                GROUP BY idclass');
        return $data->result();
    }

}

?>
