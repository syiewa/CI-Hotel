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
class M_kelas extends MY_Model {

    private $tabel_foto = 'foto_produk';

    //put your code here
    public function __construct() {
        parent::__construct();
        parent::set_tabel('class', 'idclass');
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

    public function get_gambar($id = 0) {
        $this->db->where(array('idclass' => $id));
        return $this->db->get($this->tabel_foto)->result();
    }

    public function tambah_gambar($data = array()) {
        $this->db->insert($this->tabel_foto, $data);
        $id = $this->db->insert_id();
    }

}

?>
