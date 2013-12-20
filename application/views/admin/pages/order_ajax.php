<?php
echo get_ol($pages , $status);

function get_ol ($array, $status, $child = FALSE)
{
	$str = '';
	if (count($array)) {
		$str .= $child == FALSE ? '<ol class="sortable">' : '<ol>';
		
		foreach ($array as $item) {
			$str .= '<li id="list_' . $item['id'] .'" class="list-group-item" style="border:none;" >';
			$str .= '<div>' . $item['title'];
                        $str .= '<b class="pull-right">'. btn_delete('admin/pages/delete/' . $item['id']);
			$str .= '&nbsp'.btn_edit('admin/pages/add/' . $item['id']).'</b></div>' ;
			
			// Do we have any children?
			if (isset($item['children']) && count($item['children'])) {
				$str .= get_ol($item['children'],$status, TRUE);
			}
			
			$str .= '</li>' . PHP_EOL;
		}
		
		$str .= '</ol>' . PHP_EOL;
	}
	
	return $str;
}
?>

<script>
$(document).ready(function(){

    $('.sortable').nestedSortable({
        handle: 'div',
        items: 'li',
        toleranceElement: '> div',
        maxLevels: 2
    });

});
</script>