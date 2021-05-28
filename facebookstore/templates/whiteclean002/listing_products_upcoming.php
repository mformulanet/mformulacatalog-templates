<?php
//// row ////
if ($type_listings == "row") {

// products model
if ( (VIEW_REFERENCE == 'true') ||(VIEW_REFERENCE == 'True') ) {

	if ($expected['products_model']) {
	$products_model =  '<span class="pl_product_name">' . $expected['products_model'] . '</span><br>';
	}

}
// products model eof

// categories and sub-categories
if (DISPLAY_CATEGORIES_SUBCATEGORIES_PRODUCT_LIST == "true") {
	$add_categories_subcategories = '<span class="pl_categories_name">' . $subcategories['categories_name'] . ' - ' . $categories['categories_name'] . '</span><br>';
}
// categories and sub-categories eof

// button youtube play
if (ENABLE_YOUTUBE_PRODUCTLISTING == 'true') {
	if (!empty($expected['products_youtube'])) {
	  if (strstr($expected['products_youtube'], "<iframe")) {
		$youtube_array = explode('src="', $expected['products_youtube']);
		$youtube_array1 = explode('"', $youtube_array[1]);
		$link_watch_youtube = str_replace("embed/", "watch?v=", $youtube_array1[0]);
		$button_youtube = '<a href="'.$link_watch_youtube.'" class="fancybox fancybox.iframe">'.tep_image(DIR_WS_IMAGES . 'icon_youtube_play.png', '', '', '', ' align="middle" ').'</a><br>';
	  }elseif (strstr($expected['products_youtube'], "<object")) {
		$youtube_array2 = explode('src="', $expected['products_youtube']);
		$youtube_array3 = explode('"', $youtube_array2[1]);
		$link_watch_youtube = str_replace("v/", "embed/", $youtube_array3[0]);
		$button_youtube = '<a href="'.$link_watch_youtube.'" class="fancybox fancybox.iframe">'.tep_image(DIR_WS_IMAGES . 'icon_youtube_play.png', '', '', '', ' align="middle" ').'</a><br>';
	  }elseif (strstr($expected['products_youtube'], "watch?v=")) {
		$button_youtube = '<a href="'.str_replace("watch?v=", "embed/", $expected['products_youtube']).'" class="fancybox fancybox.iframe">'.tep_image(DIR_WS_IMAGES . 'icon_youtube_play.png', '', '', '', ' align="middle" ').'</a><br>';
	  }
	}else{
		$button_youtube = '';
	}
}
// button youtube play eof
	
// likes
if (ENABLE_PRODUCTS_LIKES == "true"){
if (tep_session_is_registered('customer_id')) {
	$check_add_like_query = tep_db_query("select * from " . TABLE_PRODUCTS_LIKE_TRACK . " where products_id = '" . (int)$expected["products_id"] . "' and customer_id = '" . (int)$customer_id . "' ");
	$str_like = "like";
	if (tep_db_num_rows($check_add_like_query) > 0) {
	$str_like = "unlike";
	}
	$add_likes_box = '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="demo-table">
	<tbody>
	<tr>
	<td align="default" width="100%" valign="top">
	<div id="prod-'.$expected["products_id"].'">
	<input type="hidden" id="likes-'.$expected["products_id"].'" value="'.$expected["likes"].'">
	<div class="btn-likes"><input type="button" title="'.ucwords(ENTRY_TEXT_ILIKE).'" class="'.$str_like.'" onClick="addLikes('.$expected["products_id"].',\''.$str_like.'\')" /></div>
	<div class="label-likes">'.($expected["likes"] > 0 ? $expected["likes"] . ' ' . ENTRY_TEXT_LIKES : '').'</div>
	</div>
	</td>
	</tr>
	</tbody>
	</table>
	';
}else{
	$str_like = "like";
	$add_likes_box = '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="demo-table">
	<tbody>
	<tr>
	<td align="default" width="100%" valign="top">
	<div id="prod-'.$expected["products_id"].'">
	<input type="hidden" id="likes-'.$expected["products_id"].'" value="'.$expected["likes"].'">
	<div class="btn-likes"><input type="button" title="'.ucwords(ENTRY_TEXT_HOW_TO_LIKE).'" class="'.$str_like.'" /></div>
	<div class="label-likes">'.($expected["likes"] > 0 ? $expected["likes"] . ' ' . ENTRY_TEXT_LIKES : '').'</div>
	</div>
	</td>
	</tr>
	</tbody>
	</table>
	';
}
}
// likes eof

    $info_box_contents[$row][$col] = array('align' => 'center',
                                           'params' => 'class="smallText" width="25%" valign="top"',
                                           'text' => '<div class="pl_style_border_div">
										   
										   <table width="100%" border="0" cellspacing="0" cellpadding="0">
										   <tr>
										   <td width="20%">
										   <a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $expected['products_id']) . '" itemprop="url">' . tep_image(DIR_WS_IMAGES . $expected['products_image'], $expected['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>
										   '.$add_likes_box.'
										   </td>
										   <td valign="default" width="60%" class="smallText">
										   
										   '.$add_categories_subcategories.'
										   '.$button_youtube.'<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $expected['products_id']) . '" itemprop="url">'.$products_model . '<span class="pl_product_name">' . $expected['products_name'] . '</span></a><br><span class="pl_product_unidade_venda">'.$unidade_venda.'</span><b>' . TABLE_HEADING_DATE_EXPECTED . ' ' . tep_date_short($expected['date_expected']) . '</b>
										   
										   </td>
										   </tr>
										   </table>
										   
										   </div>');

//// gallery ////
}else{

// products model
if ( (VIEW_REFERENCE == 'true') ||(VIEW_REFERENCE == 'True') ) {

	if ($expected['products_model']) {
	$products_model =  '<span class="pl_product_name">' . $expected['products_model'] . '</span><br>';
	}

}
// products model eof

// categories and sub-categories
if (DISPLAY_CATEGORIES_SUBCATEGORIES_PRODUCT_LIST == "true") {
	$add_categories_subcategories = '<span class="pl_categories_name">' . $subcategories['categories_name'] . ' - ' . $categories['categories_name'] . '</span><br>';
}
// categories and sub-categories eof

// button youtube play
if (ENABLE_YOUTUBE_PRODUCTLISTING == 'true') {
	if (!empty($expected['products_youtube'])) {
	  if (strstr($expected['products_youtube'], "<iframe")) {
		$youtube_array = explode('src="', $expected['products_youtube']);
		$youtube_array1 = explode('"', $youtube_array[1]);
		$link_watch_youtube = str_replace("embed/", "watch?v=", $youtube_array1[0]);
		$button_youtube = '<a href="'.$link_watch_youtube.'" class="fancybox fancybox.iframe">'.tep_image(DIR_WS_IMAGES . 'icon_youtube_play.png', '', '', '', ' align="middle" ').'</a><br>';
	  }elseif (strstr($expected['products_youtube'], "<object")) {
		$youtube_array2 = explode('src="', $expected['products_youtube']);
		$youtube_array3 = explode('"', $youtube_array2[1]);
		$link_watch_youtube = str_replace("v/", "embed/", $youtube_array3[0]);
		$button_youtube = '<a href="'.$link_watch_youtube.'" class="fancybox fancybox.iframe">'.tep_image(DIR_WS_IMAGES . 'icon_youtube_play.png', '', '', '', ' align="middle" ').'</a><br>';
	  }elseif (strstr($expected['products_youtube'], "watch?v=")) {
		$button_youtube = '<a href="'.str_replace("watch?v=", "embed/", $expected['products_youtube']).'" class="fancybox fancybox.iframe">'.tep_image(DIR_WS_IMAGES . 'icon_youtube_play.png', '', '', '', ' align="middle" ').'</a><br>';
	  }
	}else{
		$button_youtube = '';
	}
}
// button youtube play eof
	
// likes
if (ENABLE_PRODUCTS_LIKES == "true"){
if (tep_session_is_registered('customer_id')) {
	$check_add_like_query = tep_db_query("select * from " . TABLE_PRODUCTS_LIKE_TRACK . " where products_id = '" . (int)$expected["products_id"] . "' and customer_id = '" . (int)$customer_id . "' ");
	$str_like = "like";
	if (tep_db_num_rows($check_add_like_query) > 0) {
	$str_like = "unlike";
	}
	$add_likes_box = '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="demo-table">
	<tbody>
	<tr>
	<td align="default" width="100%" valign="top">
	<div id="prod-'.$expected["products_id"].'">
	<input type="hidden" id="likes-'.$expected["products_id"].'" value="'.$expected["likes"].'">
	<div class="btn-likes"><input type="button" title="'.ucwords(ENTRY_TEXT_ILIKE).'" class="'.$str_like.'" onClick="addLikes('.$expected["products_id"].',\''.$str_like.'\')" /></div>
	<div class="label-likes">'.($expected["likes"] > 0 ? $expected["likes"] . ' ' . ENTRY_TEXT_LIKES : '').'</div>
	</div>
	</td>
	</tr>
	</tbody>
	</table>
	';
}else{
	$str_like = "like";
	$add_likes_box = '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="demo-table">
	<tbody>
	<tr>
	<td align="default" width="100%" valign="top">
	<div id="prod-'.$expected["products_id"].'">
	<input type="hidden" id="likes-'.$expected["products_id"].'" value="'.$expected["likes"].'">
	<div class="btn-likes"><input type="button" title="'.ucwords(ENTRY_TEXT_HOW_TO_LIKE).'" class="'.$str_like.'" /></div>
	<div class="label-likes">'.($expected["likes"] > 0 ? $expected["likes"] . ' ' . ENTRY_TEXT_LIKES : '').'</div>
	</div>
	</td>
	</tr>
	</tbody>
	</table>
	';
}
}
// likes eof

    $info_box_contents[$row][$col] = array('align' => 'center',
                                           'params' => 'class="smallText" width="25%" valign="top"',
                                           'text' => '<div class="pl_style_border_div">'.$add_categories_subcategories.'<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $expected['products_id']) . '" itemprop="url">' . tep_image(DIR_WS_IMAGES . $expected['products_image'], $expected['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>'.$add_likes_box.'<br><br>'.$button_youtube.'<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $expected['products_id']) . '" itemprop="url">'.$products_model . '<span class="pl_product_name">' . $expected['products_name'] . '</span></a><br><span class="pl_product_unidade_venda">'.$unidade_venda.'</span><b>' . TABLE_HEADING_DATE_EXPECTED . ' ' . tep_date_short($expected['date_expected']) . '</b></div>');

}
//// end row and gallery ////
?>