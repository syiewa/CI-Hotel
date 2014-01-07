<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of slide
 *
 * @author Syiewa
 */
class M_slide extends MY_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
        parent::set_tabel('slides', 'slide_id');
    }

    public function get_all() {
        $this->db->order_by('slide_order');
        return parent::get_all();
    }

    public function save_order($slides) {
        if (count($slides)) {
            foreach ($slides as $order => $slide) {
                if ($slide['item_id'] != '') {
                    $data = array(
                        'slide_order' => $order
                    );
                    $this->db->set($data)->where('slide_id', $slide['item_id'])->update('slides');
                }
            }
        }
    }

    public function hapus_slide($id = 0) {
        $data = parent::get($id);
        if (file_exists($data->slide_image)) {
            unlink($data->slide_image);
        }
        if (file_exists($data->slide_thumb)) {
            unlink($data->slide_thumb);
        }
        parent::delete($id);
    }

}

?>
