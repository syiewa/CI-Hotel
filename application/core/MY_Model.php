<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MY_Model
 *
 * @author Syiewa
 */
class MY_Model extends CI_Model {

    private $tabel;
    private $pk;

    //put your code here

    public function __construct() {
        parent::__construct();
    }

    public function set_tabel($tabel = '', $pk = '') {
        $this->tabel = $tabel;
        $this->pk = $pk;
        return $this;
    }

    public function array_from_post($fields) {
        $data = array();
        foreach ($fields as $field) {
            $data[$field] = $this->input->post($field, TRUE);
        }
        return $data;
    }

    public function get_all() {
        return $this->_get()->result();
    }

    public function get_array() {
        return $this->_get()->result_array();
    }

    public function get($id = '0') {
        $this->db->where($this->pk, $id);
        return $this->_get()->row();
    }

    public function get_by($param) {
        if (is_array($param)) {
            $this->db->where($param);
            return $this->_get()->row();
        }
        return FALSE;
    }

    public function get_many_by($param) {
        if (is_array($param)) {
            $this->db->where($param);
            return $this->get_all();
        }
        return FALSE;
    }

    public function get_many_by_array($param) {
        if (is_array($param)) {
            $this->db->where($param);
            return $this->get_array();
        }
        return FALSE;
    }

    public function save($data, $id = NULL) {
        //insert
        if ($id == NULL) {
            !isset($data[$this->pk]) || $data[$this->pk = NULL];
            $this->db->set($data);
            $this->db->insert($this->tabel);
            $id = $this->db->insert_id();
        }
        //update
        else {
            $this->db->set($data);
            $this->db->where($this->pk, $id);
            $this->db->update($this->tabel);
        }

        return $id;
    }

    public function insert($data = array()) {
        if ($this->db->insert($this->tabel, $data)) {
            return $this->db->insert_id();
        }
        return false;
    }

    public function update($data = array(), $id = 0) {
        $this->db->where(array($this->pk => $id));
        if ($this->db->update($this->tabel, $data)) {
            return true;
        }
        return false;
    }

    public function delete($id = 0) {
        if ($this->db->delete($this->tabel, array($this->pk => $id))) {
            return TRUE;
        }
        return FALSE;
    }

    public function delete_by($where = array()) {
        if ($this->db->delete($this->tabel, $where)) {
            return TRUE;
        }
        return FALSE;
    }

    public function update_by($where = array(), $data = array()) {
        $this->db->where($where);
        if ($this->db->update($this->tabel, $data)) {
            return TRUE;
        }
        return false;
    }

    protected function _get() {
        return $this->db->get($this->tabel);
    }

}

?>
