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
    private $tabel_kelas = 'kelas';
    private $tabel_user = 'guest';
    //put your code here
    public function __construct() {
        parent::__construct();
        parent::set_tabel('order', 'order_id');
    }
    
    public function insert_guest($data = array()) {
        $this->db->insert($this->tabel_user,$data);
        $id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0){
            return TRUE;
        } else {
            return FALSE;
        }
    }
}

?>
