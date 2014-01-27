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

    public function cek_email($email) {
        $this->db->where(array('email' => $email));
        if ($this->db->get($this->tabel_users)->num_rows > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}

?>
