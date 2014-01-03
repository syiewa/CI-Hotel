<?php
if ($slides) :
    echo get_ol($slides);
else :
    echo 'No Data';
endif;

function get_ol($array, $child = FALSE) {
    $str = '';
    if (count($array)) {
        $str .= $child == FALSE ? '<ol class="sortableslide media-list">' : '<ol>';

        foreach ($array as $item) {
            $str .= '<li id="list_' . $item->slide_id . '" class="media list-group-item">';
            $media = '';
            if (!empty($media['path'])):
                $str .= '<a class="pull-left" href="'. base_url('index.php/admin/slides/add/' . $item->slide_id) . '"><img class="media-object" src="' . base_url() . $media['path'] . '" height="120" width="100"></a>';
            else :
                $str .= '<a class="pull-left" href="'. base_url('index.php/admin/slides/add/' . $item->slide_id) . '"><img alt="" src="http://placehold.it/100x120"></a>';
            endif;
            $str .= '<div class="media-body"><h4 class="media-heading">' . $item->slide_title . '<span class="pull-right">' .btn_delete('admin/slides/delete_slide/' . $item->slide_id) . '</span></h4>';
            $str .= '<p>' . $item->slide_desc . '</p>';
            $str .= '&nbsp' . btn_edit('admin/slides/add/' . $item->slide_id) . '</div>';

            $str .= '</li>';
        }

        $str .= '</ol><br>';
    }

    return $str;
}
?>

<script>
    $(document).ready(function() {
        $('.sortableslide').nestedSortable({
            handle: 'div',
            items: 'li',
            toleranceElement: '> div',
            maxLevels: 1
        });
//        $('.sortable').nestedSortable({
//            handle: 'div',
//            items: 'li',
//            toleranceElement: '> div',
//            maxLevels: 1
//        });

    });
</script>