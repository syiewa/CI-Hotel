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

    public function cek_guest($userid) {
        $this->db->where(array('user_id' => $userid, 'user_id !=' => 0));
        if ($this->db->get('guest')->num_rows > 0) {
            return TRUE;
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
        } else {
            return FALSE;
        }
    }

}

?>
