<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pegawai_helper
 *
 * @author Syiewa
 */
function menu() {
    $CI = & get_instance();
    $CI->load->model('m_page');
    return $CI->m_page->get_nested();
}

function e($string) {
    return htmlentities($string);
}

function get_menu($array, $child = FALSE) {
    $CI = & get_instance();
    $str = '';

    if (count($array)) {
        $str .= $child == FALSE ? '<ul class="nav navbar-nav">' . PHP_EOL : '<ul class="dropdown-menu">' . PHP_EOL;

        foreach ($array as $item) {
            $active = $CI->uri->segment(1) == $item['slug'] ? TRUE : FALSE;
            if (isset($item['children']) && count($item['children'])) {
                $str .= $active ? '<li class="dropdown active">' : '<li class="dropdown">';
                $str .= '<a  class="dropdown-toggle" data-toggle="dropdown" href="' . site_url(e($item['slug'])) . '">' . e($item['title']);
                $str .= '<b class="caret"></b></a>' . PHP_EOL;
                $str .= get_menu($item['children'], TRUE);
            } else {
                $str .= $active ? '<li class="active">' : '<li>';
                $str .= '<a href="' . site_url($item['slug']) . '">' . e($item['title']) . '</a>';
            }
            $str .= '</li>' . PHP_EOL;
        }

        $str .= '</ul>' . PHP_EOL;
    }

    return $str;
}

function _replacenull($str, $str2) {
    if (empty($str) || $str == "" || $str == NULL) {
        return $str2;
    } else {
        return $str;
    }
}

function _toimg($str) {
    $im = "";
    if ($str == "0") {
        $im = '<span class="glyphicon glyphicon-remove"></span>';
    } elseif ($str == "1") {
        $im = '<span class="glyphicon glyphicon-ok"></span>';
    }
    return $im;
}

function _toaktif($url = null, $id = null, $str = 0) {
    $im = "";
    if ($str == "0") {
        $im = '<a href = ' . site_url($url . '' . $id . '/1') . ' class="btn btn-default btn-xs btn-warning">Non-Aktif</a>';
    } elseif ($str == "1") {
        $im = '<a href = ' . site_url($url . '' . $id . '/0') . ' class="btn btn-default btn-xs btn-success">Aktif</a>';
    }
    return $im;
}

function _tobooking($url = null, $id = null, $str = 0) {
    $im = "";
    if ($str == "0") {
        $im = '<a href = ' . site_url($url . '' . $id . '/1') . ' class="btn btn-default btn-xs btn-warning">Kosong</a>';
    } elseif ($str == "1") {
        $im = '<a href = ' . site_url($url . '' . $id . '/0') . ' class="btn btn-default btn-xs btn-success">Booked</a>';
    }
    return $im;
}

function getselectedfas($id = null, $str = null) {
    $CI = & get_instance();
    $q = $CI->db->query('Select * from facilities where idclass = ' . $id . ' and fac = "' . $str . '"');
    $r = $q->result_array();
    if ($r == NULL) {
        $str = "";
    } else {
        $str = $r[0]['status'];
    }
    $ck = "";
    if ($str == "" || empty($str) || $str == "0") {
        $ck = "";
    } elseif ($str == "1") {
        $ck = "checked";
    }
    return $ck;
}

function isLogin() {
    $CI = & get_instance();
    if ($CI->session->userdata('is_login') == TRUE) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function UserLogin() {
    $CI = & get_instance();
    if (isLogin() != TRUE) {
        echo "<script> alert('anda tidak mempunyai hak akses!!')</script>";
        redirect('login/login');
    }
}

function cekAdminLogin() {
    $CI = & get_instance();
    if (isLogin() == TRUE) {
        if ($CI->session->userdata('level_user') != 1) {
            $CI->session->set_flashdata('message', 'Anda tidak memiliki hak akses halaman Administrator');
            redirect('login/login');
        }
    } else {
        $CI->session->set_flashdata('message', 'Anda tidak memiliki hak akses halaman Administrator');
        redirect('login/login');
    }
}

function add_meta_title($string) {
    $CI = & get_instance();
    $CI->data['meta_title'] = e($string) . ' - ' . $CI->data['meta_title'];
}

function btn_edit($uri) {
    return anchor($uri, '<button class="btn btn-default btn-xs btn-primary" type="button"><span class="glyphicon glyphicon-edit"></span> Edit</button>');
}

function btn_delete($uri) {
    return anchor($uri, '<button class="btn btn-default btn-xs btn-danger" type="button"><span class="glyphicon glyphicon-trash"></span> Hapus</button>', array(
        'onclick' => "return confirm('You are about to delete a record. This cannot be undone. Are you sure?');"
    ));
}

function tgl_indo($tgl) {
    return date('Y-m-d', strtotime($tgl));
}

function attr($attributes = array()) {
    $data = array('class', 'id', 'name', 'data-validation', 'data-validation-length', 'data-validation-error-msg');
    $newarray = array_combine($data, $attributes);
    return $newarray;
}

?>
