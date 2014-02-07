<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class M_provinsi extends MY_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
        parent::set_tabel('inf_lokasi', 'lokasi_ID');
    }

    public function get_provinsi() {
        $data = array();
        $this->db->order_by('lokasi_ID', 'esc');
        foreach (parent::get_many_by_array(array('lokasi_kabupatenkota' => 0, 'lokasi_kecamatan' => 0, 'lokasi_kelurahan' => 0)) as $row) {
            $data[$row['lokasi_propinsi']] = $row['lokasi_nama'];
        }
        return $data;
    }

    public function get_provinsi_id($id) {
        $data = array();
        $this->db->order_by('lokasi_ID', 'esc');
        $data = parent::get_by(array('lokasi_kabupatenkota' => 0, 'lokasi_kecamatan' => 0, 'lokasi_kelurahan' => 0, 'lokasi_propinsi' => $id));
        return $data;
    }

    public function get_allkota() {
        $data = array();
        $this->db->order_by('lokasi_ID', 'esc');
        foreach (parent::get_array() as $row) {
            $data[$row['lokasi_ID']] = $row['lokasi_nama'];
        }
        return $data;
    }

    public function get_kota($id) {
        return parent::get_many_by_array(array('lokasi_kabupatenkota !=' => 0, 'lokasi_propinsi' => $id, 'lokasi_kecamatan' => 0, 'lokasi_kelurahan' => 0));
    }

}

?>
