<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of m_order
 *
 * @author Syiewa
 */
class M_order extends MY_Model {

    private $tabel_cc = 'cc_detail';
    private $tabel_user = 'guest';
    var $status = array(
        0 => '<span class="label label-info">In Process</span>',
        1 => '<span class="label label-primary">Approved</span>',
        2 => '<span class="label label-success">Finish</span>',
        3 => '<span class="label label-danger">Cancelled</span>',
        4 => '<span class="label label-warning">Waiting Approval</span>'
    );
    var $paymentMethods = array(
        1 => 'Credit Card'
    );

    //put your code here
    public function __construct() {
        parent::__construct();
        parent::set_tabel('order', 'order_id');
    }

    public function get_recents($offset = 0, $limit = 5) {
        $offset = (int) $offset;
        $limit = (int) $limit;
        $q = $this->db->query('SELECT 
        `order_id`, 
        g.nama_depan AS first_name, 
        g.nama_belakang AS last_name, 
        c.title AS class_title, 
        g.cc_type,
        `tgl_order`,
        `cc_id`, 
        `payment_total`, 
        `order_status`, 
        `check_in`, 
        `check_out`
        FROM `order` o 
        LEFT JOIN ( 
            (SELECT idclass,title FROM `class`) AS c,
            (SELECT id,nama_depan,nama_belakang,cc_detail.* FROM guest
            LEFT JOIN `cc_detail` ON guest.id = cc_detail.`cc_userid` GROUP BY guest.`id`
            ) AS g )
	ON (c.`idclass`=o.`class_id` AND g.`id`=o.`guest_id`) LIMIT ' . $offset . ',' . $limit . ';');
        return $q->result();
    }

    public function insert_guest($data = array()) {
        $this->db->insert($this->tabel_user, $data);
        $id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function insert_cc($data = array()) {
        $this->db->insert($this->tabel_cc, $data);
        $id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_cc($id) {
        $q = $this->db->get_where($this->tabel_cc, array('id_cc' => $id));
        return $q->row();
    }

}

?>
