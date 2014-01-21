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
class M_User extends MY_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
        parent::set_tabel('guest', 'id');
    }

    public function get_fac($id = null) {
        $q = $this->db->query('select * from facilities where idclass = ' . $id);
        return $q->result();
    }

    public function get_allfac() {
        $q = $this->db->query('select * from facilities');
        return $q->result();
    }

    public function insert_fac($data = array()) {
        if ($this->db->insert('facilities', $data)) {
            return TRUE;
        }
        return FALSE;
    }

    public function del_fac($id = null) {
        $q = $this->db->query('Delete from facilities where idclass = ' . $id);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }

    public function get_dropdown() {
        $data = array();
        foreach (parent::get_array() as $row) {
            $data[$row['idclass']] = $row['title'];
        }
        return $data;
    }

}

?>
