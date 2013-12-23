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

    public function get_aktiffac($id = null) {
        $q = $this->db->query('select * from facilities where idclass = ' . $id . ' AND status = 1');
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

    public function get_gambardefault($id = 0) {
        $data = array();
        $i = 0;
        foreach ($this->get_all() as $item) {
            $data[$i] = $item;
            $this->db->where(array('idclass' => $item->idclass));
            if ($this->db->get('foto_produk')->num_rows() > 0) {
                $this->db->where(array('idclass' => $item->idclass, 'default' => 1));
                if ($this->db->get('foto_produk')->num_rows() > 0) {
                    $this->db->where(array('idclass' => $item->idclass, 'default' => 1));
                    $foto = $this->db->get('foto_produk')->result();
                    foreach ($foto as $pic) {
                        $data[$i]->image = $pic->image;
                        $data[$i]->thumb = $pic->thumb;
                    }
                } else {
                    $this->db->where(array('idclass' => $item->idclass));
                    $foto = $this->db->get('foto_produk')->result();
                    foreach ($foto as $pic) {
                        $data[$i]->image = $pic->image;
                        $data[$i]->thumb = $pic->thumb;
                    }
                }
            } else {
                $data[$i]->image = '';
                $data[$i]->thumb = '';
            }
            $i++;
        }
        return $data;
    }

    public function tambah_gambar($data = array()) {
        $this->db->insert($this->tabel_foto, $data);
        $id = $this->db->insert_id();
    }

    public function hapus_foto($id_foto = 0) {
        $this->db->where(array('id_foto_produk' => $id_foto));
        $data = $this->db->get($this->tabel_foto)->row();
        if ($this->db->delete($this->tabel_foto, array('id_foto_produk' => $id_foto))) {
            if (file_exists($data->image)) {
                unlink($data->image);
            }
            if (file_exists($data->thumb)) {
                unlink($data->thumb);
            }
        }
    }

    public function set_default($id = 0, $id_foto = 0) {
        $data1 = array('default' => '0');
        $this->db->where(array('idclass' => $id));
        if ($this->db->update($this->tabel_foto, $data1)) {
            $this->_set_to_default($id_foto);
            return true;
        }
        return false;
    }

    private function _set_to_default($id_foto = 0) {
        $data2 = array('default' => 1);
        $this->db->where(array('id_foto_produk' => $id_foto));
        $this->db->update($this->tabel_foto, $data2);
    }

}

?>
