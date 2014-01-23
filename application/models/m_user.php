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

    private $tabel_users = 'users';

    //put your code here
    public function __construct() {
        parent::__construct();
        parent::set_tabel('guest', 'id');
    }

    public function getid_users($identity = null) {
        $this->db->where(array('email' => $identity));
        $id = $this->db->get($this->tabel_users)->row_array();
        if ($this->db->get($this->tabel_users)->num_rows > 0) {
            return $id['id'];
        } else {
            return FALSE;
        }
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
