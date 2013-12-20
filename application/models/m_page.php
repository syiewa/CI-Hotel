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
class M_page extends MY_Model {

    var $status = array(
        0 => 'draft',
        1 => 'published'
    );

    //put your code here
    public function __construct() {
        parent::__construct();
        parent::set_tabel('pages', 'id');
    }

    function get_with_parent($id = NULL, $single = FALSE) {
        $this->db->select('pages.*, p.slug as parent_slug, p.title as parent_title');
        $this->db->join('pages as p', 'pages.parent=p.id', 'left');
        $query = $this->db->get('pages');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function save_order($pages) {
        if (count($pages)) {
            foreach ($pages as $order => $page) {
                if ($page['item_id'] != '') {
                    $data = array(
                        'parent' => (int) $page['parent_id'],
                        'order' => $order
                    );
                    $this->db->set($data)->where('id', $page['item_id'])->update('pages');
                }
            }
        }
    }

    function get_nested() {
        $this->db->order_by('order');
        $pages = parent::get_array();

        $array = array();
        if ($pages) {
            foreach ($pages as $page) {
                if (!$page['parent']) {
                    // This page has no parent
                    $array[$page['id']] = $page;
                } else {
                    // This is a child page
                    $array[$page['parent']]['children'][] = $page;
                }
            }
        }
        return $array;
    }

}

?>
