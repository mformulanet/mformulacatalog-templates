<?php
//// row ////
if ($type_listings == "row") {

// expire date and time
	 if ( (tep_get_products_special_price($random_product['products_id'])) && (DISPLAY_EXPIRE_DATE_SPECIALS == 'true') ) {
	 
	 $specials_expires_date = tep_get_products_special_expire_date($random_product['products_id']);
	 
		  if ($random_product['products_quantity'] > 0) {
			  if ( (tep_not_null(tep_get_products_special_price($random_product['products_id']))) && (tep_not_null($specials_expires_date)) && ($specials_expires_date != '0000-00-00 00:00:00')) {
				  $replace_date_expire = array("-");
				  
				  $replacements = array(
				  'year' => TEXT_SPECIALS_DATE_YEAR,
				  'years' => TEXT_SPECIALS_DATE_YEARS,
				  'month' => TEXT_SPECIALS_DATE_MONTH,
				  'months' => TEXT_SPECIALS_DATE_MONTHS,
				  'day' => TEXT_SPECIALS_DATE_DAY,
				  'days' => TEXT_SPECIALS_DATE_DAYS,
				  'hour' => TEXT_SPECIALS_DATE_HOUR,
				  'hours' => TEXT_SPECIALS_DATE_HOURS,
				  'minute' => TEXT_SPECIALS_DATE_MINUTE,
				  'minutes' => TEXT_SPECIALS_DATE_MINUTES,
				  'second' => TEXT_SPECIALS_DATE_SECOND,
				  'seconds' => TEXT_SPECIALS_DATE_SECONDS);
				  
				  $date_expire_replace = str_replace(array_keys($replacements), $replacements, calculate_date_between(date("Ymd H:i:s"), str_replace($replace_date_expire, "", $specials_expires_date)));
				  
				  $specials_expiredate = TEXT_SPECIALS_EXPIREDATE . ' ' . tep_date_short($specials_expires_date) . '<br>' . TEXT_SPECIALS_EXPIREDATE_FALTA . ' ' . $date_expire_replace;
			  }else{
				  $specials_expiredate = '';
			  }
		  }
	 
	 }else{
				  $specials_expiredate = '';
	 } 
// expire date and time eof

// buttons
if (PRODUCT_LIST_HIDE_ALL_BUTTONS == 'false') {

	if (PRODUCT_LIST_DETAILS == 'true') {
	$button_details = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '">' . tep_image_button('small_details.gif', '') . '</a><br>';
	}
	
	if (PRODUCT_LIST_QUICKVIEW == 'true') {
	$button_quickview = '<a href="' . tep_href_link(FILENAME_PRODUCT_QUICKVIEW, 'products_id=' . $random_product['products_id']) . '" class="fancybox fancybox.iframe">' . tep_image_button('button_quickview.gif', '') . '</a><br>';
	}
	
	if (PRODUCT_LIST_BUY_NOW_FAST == 'true') {
	if (tep_has_product_attributes($random_product['products_id'])) {					
		$button_buy_now_fast_link = '<a href="' . tep_href_link(FILENAME_PRODUCT_QUICKVIEW, 'products_id=' . $random_product['products_id']) . '" class="fancybox fancybox.iframe">' . tep_image_button('button_buy_now_fast.gif', '') . '</a><br>';
	}else{
		$button_buy_now_fast_link = '<a href="' . tep_href_link_fast(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $random_product['products_id'], 'NONSSL') . '">' . tep_image_button('button_buy_now_fast.gif', '') . '</a><br>';
	}
	}
	
	if (PRODUCT_LIST_BUY_NOW == 'true') {
	$button_buy_now = '<a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $random_product['products_id'], 'NONSSL') . '">' . tep_image_button('button_buy_now.gif', '') . '</a><br>';
	}
	
	if (PRODUCT_LIST_CONTACT == 'true') {
	$button_contact = '<a href="'.tep_href_link(FILENAME_PRODUCT_CONTACT, 'products_id=' . $random_product['products_id']).'" class="fancybox fancybox.iframe">' . tep_image_button('button_contact.gif', $random_product['products_name']) . '</a><br>';
	}

	if ($CUSTOMER_CREATE_ACCOUNT_VIEW_PRICE == 'true') {
		
		$button_buynow = $button_details;
		
	} elseif ( ($registry_mode_id != 0) || (PRODUCT_LIST_BUY_NOW != 'true') || (CUSTOMER_VIEW_PRODUCT_LOGIN_OR_CREATE_ACCOUNT_VIEW_PRICE == 'true') ) {
	
		$button_buynow = $button_details.$button_quickview;
	
	} elseif ( ($random_product['view_price'] == 1) || ($random_product['products_quantity'] <= 0) ) {
	
		$button_buynow = $button_contact.$button_quickview.$button_details;
	
	}elseif ( ($random_product['view_price'] == 1) || ( ($random_product['products_quantity'] <= 0) && ($random_product['products_qtd_stock_status'] == '0') ) || ( ($random_product['products_quantity'] <= 0) && ($random_product['products_qtd_stock_status'] == '') ) || ( ($random_product['products_quantity'] <= 0) && ($random_product['products_qtd_stock_status'] == '2') ) || ( ($random_product['products_quantity'] <= 0) && ($random_product['products_qtd_stock_status'] == '3') ) ) {
	
		$button_buynow = $button_contact.$button_quickview.$button_details;
	
	}else{
	
		$button_buynow = $button_buy_now.$button_buy_now_fast_link.$button_details.$button_quickview;
		
	}

}
// buttons eof

// products model
if ( (VIEW_REFERENCE == 'true') ||(VIEW_REFERENCE == 'True') ) {

	if ($random_product['products_model']) {
	$products_model =  '<span class="pl_product_name">' . $random_product['products_model'] . '</span><br>';
	}

}
// products model eof

// products image
	  if (ENABLE_SLIDESHOW_PRODUCTS_IMAGES == 'true') {
	  	$add_style_slideshow_products_images = ' style="position: relative;" ';
		$add_style_slideshow_products_images_img = ' class="fadelistings" ';
	  }

	  if ($random_product['products_image_sm_1'] && ENABLE_SLIDESHOW_PRODUCTS_IMAGES == 'true' && file_exists(DIR_WS_IMAGES . $random_product['products_image_sm_1']) && CAROUSEL_DEFAULT_STYLE != 'style3') {
		$products_image_list = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '" '.$add_style_slideshow_products_images.' itemprop="url">' . tep_image(DIR_WS_IMAGES . $random_product['products_image'], $random_product['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, $add_style_slideshow_products_images_img) . tep_image(DIR_WS_IMAGES . $random_product['products_image_sm_1'], $random_product['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>';
	  }else{
		$products_image_list = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '"  itemprop="url">' . tep_image(DIR_WS_IMAGES . $random_product['products_image'], $random_product['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>';
	  }
// products image eof

// categories and sub-categories
if (DISPLAY_CATEGORIES_SUBCATEGORIES_PRODUCT_LIST == "true") {
	$add_categories_subcategories = '<span class="pl_categories_name">' . $subcategories['categories_name'] . ' - ' . $categories['categories_name'] . '</span><br>';
}
// categories and sub-categories eof   

// button youtube play
if (ENABLE_YOUTUBE_PRODUCTLISTING == 'true') {
	if (!empty($random_product['products_youtube'])) {
	  if (strstr($random_product['products_youtube'], "<iframe")) {
		$youtube_array = explode('src="', $random_product['products_youtube']);
		$youtube_array1 = explode('"', $youtube_array[1]);
		$link_watch_youtube = str_replace("embed/", "watch?v=", $youtube_array1[0]);
		$button_youtube = '<a href="'.$link_watch_youtube.'" class="fancybox fancybox.iframe">'.tep_image(DIR_WS_IMAGES . 'icon_youtube_play.png', '', '', '', ' align="middle" ').'</a>';
	  }elseif (strstr($random_product['products_youtube'], "<object")) {
		$youtube_array2 = explode('src="', $random_product['products_youtube']);
		$youtube_array3 = explode('"', $youtube_array2[1]);
		$link_watch_youtube = str_replace("v/", "embed/", $youtube_array3[0]);
		$button_youtube = '<a href="'.$link_watch_youtube.'" class="fancybox fancybox.iframe">'.tep_image(DIR_WS_IMAGES . 'icon_youtube_play.png', '', '', '', ' align="middle" ').'</a>';
	  }elseif (strstr($random_product['products_youtube'], "watch?v=")) {
		$button_youtube = '<a href="'.str_replace("watch?v=", "embed/", $random_product['products_youtube']).'" class="fancybox fancybox.iframe">'.tep_image(DIR_WS_IMAGES . 'icon_youtube_play.png', '', '', '', ' align="middle" ').'</a>';
	  }
	}else{
		$button_youtube = '';
	}
}
// button youtube play eof 
	
// likes
if (ENABLE_PRODUCTS_LIKES == "true"){
if (tep_session_is_registered('customer_id')) {
	$check_add_like_query = tep_db_query("select * from " . TABLE_PRODUCTS_LIKE_TRACK . " where products_id = '" . (int)$random_product["products_id"] . "' and customer_id = '" . (int)$customer_id . "' ");
	$str_like = "like";
	if (tep_db_num_rows($check_add_like_query) > 0) {
	$str_like = "unlike";
	}
	$add_likes_box = '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="demo-table">
	<tbody>
	<tr>
	<td align="default" width="100%" valign="top">
	<div id="prod-'.$random_product["products_id"].'">
	<input type="hidden" id="likes-'.$random_product["products_id"].'" value="'.$random_product["likes"].'">
	<div class="btn-likes"><input type="button" title="'.ucwords(ENTRY_TEXT_ILIKE).'" class="'.$str_like.'" onClick="addLikes('.$random_product["products_id"].',\''.$str_like.'\')" /></div>
	<div class="label-likes">'.($random_product["likes"] > 0 ? $random_product["likes"] . ' ' . ENTRY_TEXT_LIKES : '').'</div>
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
	<div id="prod-'.$random_product["products_id"].'">
	<input type="hidden" id="likes-'.$random_product["products_id"].'" value="'.$random_product["likes"].'">
	<div class="btn-likes"><input type="button" title="'.ucwords(ENTRY_TEXT_HOW_TO_LIKE).'" class="'.$str_like.'" /></div>
	<div class="label-likes">'.($random_product["likes"] > 0 ? $random_product["likes"] . ' ' . ENTRY_TEXT_LIKES : '').'</div>
	</div>
	</td>
	</tr>
	</tbody>
	</table>
	';
}
}
// likes eof

if ( (CAROUSEL_DEFAULT == true) && ($carousel_listings == "true") ) {

if (CAROUSEL_DEFAULT_STYLE == 'style1' || CAROUSEL_DEFAULT_STYLE == 'style2') {
$add_cs = '<li>';
$add_ce = '</li>';
}elseif (CAROUSEL_DEFAULT_STYLE == 'style3') {
$add_cs = '<div class="item">';
$add_ce = '</div>';
}

	  $info_box_contents = $add_cs.'<span class="smallText"><div class="pl_style_border_div">

										   <table width="100%" border="0" cellspacing="0" cellpadding="0">
										   <tr>
										   <td width="30%" align="center" style="padding-right:10px;">
										   '.$products_image_list.'
										   </td>
										   <td valign="default" width="50%" class="smallText">
										   
										   '.$add_categories_subcategories.'
										   <span class="pl_expire_date">'.$specials_expiredate.'</span>
										   <br>'.$button_youtube.'<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '">' . $manufacturers_name . $products_model . '<span class="pl_product_name">' . $random_product['products_name'] . '</span></a>'.$unidade_venda.'
										   
										   </td>
										   <td align="center" width="20%">
										   '.$add_likes_box.'
										   '.$button_buynow.'
										   </td>
										   </tr>
										   </table>										  
										  
										  </div></span>'.$add_ce;

}else{

	  
	  $info_box_contents[$row][$col] = array('align' => 'center',
                                          'params' => 'class="smallText" width="33%" valign="top"',
                                          'text' => '<div class="pl_style_border_div">

										   <table width="100%" border="0" cellspacing="0" cellpadding="0">
										   <tr>
										   <td width="30%" align="center" style="padding-right:10px;">
										   '.$products_image_list.'
										   </td>
										   <td valign="default" width="50%" class="smallText">
										   
										   <span class="pl_categories_name">' . $subcategories['categories_name'] . ' - ' . $categories['categories_name'] . '</span>
										   <br><span class="pl_expire_date">'.$specials_expiredate.'</span>
										   <br>'.$button_youtube.'<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '">' . $manufacturers_name . $products_model . '<span class="pl_product_name">' . $random_product['products_name'] . '</span></a>'.$unidade_venda.'
										   
										   </td>
										   <td align="center" width="20%">
										   '.$add_likes_box.'
										   '.$button_buynow.'
										   </td>
										   </tr>
										   </table>										  
										  
										  </div>');

}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//// gallery ////
}else{

// expire date and time
	 if ( (tep_get_products_special_price($random_product['products_id'])) && (DISPLAY_EXPIRE_DATE_SPECIALS == 'true') ) {
	 
	 $specials_expires_date = tep_get_products_special_expire_date($random_product['products_id']);
	 
		  if ($random_product['products_quantity'] > 0) {
			  if ( (tep_not_null(tep_get_products_special_price($random_product['products_id']))) && (tep_not_null($specials_expires_date)) && ($specials_expires_date != '0000-00-00 00:00:00')) {
				  $replace_date_expire = array("-");
				  
				  $replacements = array(
				  'year' => TEXT_SPECIALS_DATE_YEAR,
				  'years' => TEXT_SPECIALS_DATE_YEARS,
				  'month' => TEXT_SPECIALS_DATE_MONTH,
				  'months' => TEXT_SPECIALS_DATE_MONTHS,
				  'day' => TEXT_SPECIALS_DATE_DAY,
				  'days' => TEXT_SPECIALS_DATE_DAYS,
				  'hour' => TEXT_SPECIALS_DATE_HOUR,
				  'hours' => TEXT_SPECIALS_DATE_HOURS,
				  'minute' => TEXT_SPECIALS_DATE_MINUTE,
				  'minutes' => TEXT_SPECIALS_DATE_MINUTES,
				  'second' => TEXT_SPECIALS_DATE_SECOND,
				  'seconds' => TEXT_SPECIALS_DATE_SECONDS);
				  
				  $date_expire_replace = str_replace(array_keys($replacements), $replacements, calculate_date_between(date("Ymd H:i:s"), str_replace($replace_date_expire, "", $specials_expires_date)));
				  
				  $specials_expiredate = '<br>' . TEXT_SPECIALS_EXPIREDATE . ' ' . tep_date_short($specials_expires_date) . '<br>' . TEXT_SPECIALS_EXPIREDATE_FALTA . ' ' . $date_expire_replace;
			  }else{
				  $specials_expiredate = '';
			  }
		  }
	 
	 }else{
				  $specials_expiredate = '';
	 } 
// expire date and time eof

// buttons
if (PRODUCT_LIST_HIDE_ALL_BUTTONS == 'false') {

	if (PRODUCT_LIST_DETAILS == 'true') {
	$button_details = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '">' . tep_image_button('small_details.gif', '') . '</a>';
	}
	
	if (PRODUCT_LIST_QUICKVIEW == 'true') {
	$button_quickview = '<a href="' . tep_href_link(FILENAME_PRODUCT_QUICKVIEW, 'products_id=' . $random_product['products_id']) . '" class="fancybox fancybox.iframe">' . tep_image_button('button_quickview.gif', '') . '</a>';
	}
	
	if (PRODUCT_LIST_BUY_NOW_FAST == 'true') {
	if (tep_has_product_attributes($random_product['products_id'])) {					
		$button_buy_now_fast_link = '<a href="' . tep_href_link(FILENAME_PRODUCT_QUICKVIEW, 'products_id=' . $random_product['products_id']) . '" class="fancybox fancybox.iframe">' . tep_image_button('button_buy_now_fast.gif', '') . '</a>';
	}else{
		$button_buy_now_fast_link = '<a href="' . tep_href_link_fast(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $random_product['products_id'], 'NONSSL') . '">' . tep_image_button('button_buy_now_fast.gif', '') . '</a>';
	}
	}
	
	if (PRODUCT_LIST_BUY_NOW == 'true') {
	$button_buy_now = '<a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $random_product['products_id'], 'NONSSL') . '">' . tep_image_button('button_buy_now.gif', '') . '</a>';
	}
	
	if (PRODUCT_LIST_CONTACT == 'true') {
	$button_contact = '<a href="'.tep_href_link(FILENAME_PRODUCT_CONTACT, 'products_id=' . $random_product['products_id']).'" class="fancybox fancybox.iframe">' . tep_image_button('button_contact.gif', $random_product['products_name']) . '</a>';
	}

	if ($CUSTOMER_CREATE_ACCOUNT_VIEW_PRICE == 'true') {
		
		$button_buynow = $button_details;
		
	} elseif ( ($registry_mode_id != 0) || (PRODUCT_LIST_BUY_NOW != 'true') || (CUSTOMER_VIEW_PRODUCT_LOGIN_OR_CREATE_ACCOUNT_VIEW_PRICE == 'true') ) {
	
		$button_buynow = '
	<table width="98% border="0" cellspacing="5" cellpadding="0" align="center">
	  <tr>    
		<td align="center">'.$button_details.'</td>
		<td align="center">'.$button_quickview.'</td>
	  </tr>
	</table>
	';
	
	} elseif ( ($random_product['view_price'] == 1) || ($random_product['products_quantity'] <= 0) ) {
	
		$button_buynow = '
	<table width="98%" border="0" cellspacing="5" cellpadding="0" align="center">
	  <tr>    
		<td align="center">'.$button_contact.'</td>
		<td align="center">'.$button_quickview.'</td>
	  </tr>
	  <tr>    
		<td align="center" rowspan="2">'.$button_details.'</td>
	  </tr>
	</table>
	';
	
	}elseif ( ($random_product['view_price'] == 1) || ( ($random_product['products_quantity'] <= 0) && ($random_product['products_qtd_stock_status'] == '0') ) || ( ($random_product['products_quantity'] <= 0) && ($random_product['products_qtd_stock_status'] == '') ) || ( ($random_product['products_quantity'] <= 0) && ($random_product['products_qtd_stock_status'] == '2') ) || ( ($random_product['products_quantity'] <= 0) && ($random_product['products_qtd_stock_status'] == '3') ) ) {
	
		$button_buynow = '
	<table width="98% border="0" cellspacing="5" cellpadding="0" align="center">
	  <tr>    
		<td align="center">'.$button_contact.'</td>
		<td align="center">'.$button_quickview.'</td>
	  </tr>
	  <tr>    
		<td align="center" rowspan="2">'.$button_details.'</td>
	  </tr>
	</table>
	';
	
	}else{
	
		$button_buynow = '
	<table width="98% border="0" cellspacing="5" cellpadding="0" align="center">
	  <tr>    
		<td align="center">'.$button_buy_now.'</td>
		<td align="center">'.$button_buy_now_fast_link.'</td>
	  </tr>
	  <tr>    
		<td align="center">'.$button_details.'</td>
		<td align="center">'.$button_quickview.'</td>
	  </tr>
	</table>
	';
		
	}

}
// buttons eof

// products model
if ( (VIEW_REFERENCE == 'true') ||(VIEW_REFERENCE == 'True') ) {

	if ($random_product['products_model']) {
	$products_model =  '<span class="pl_product_name">' . $random_product['products_model'] . '</span><br>';
	}

}
// products model eof

// products image
	  if (ENABLE_SLIDESHOW_PRODUCTS_IMAGES == 'true') {
	  	$add_style_slideshow_products_images = ' style="position: relative;" ';
		$add_style_slideshow_products_images_img = ' class="fadelistings" ';
	  }

	  if ($random_product['products_image_sm_1'] && ENABLE_SLIDESHOW_PRODUCTS_IMAGES == 'true' && file_exists(DIR_WS_IMAGES . $random_product['products_image_sm_1']) && CAROUSEL_DEFAULT_STYLE != 'style3') {
		$products_image_list = '<center><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '" '.$add_style_slideshow_products_images.' itemprop="url">' . tep_image(DIR_WS_IMAGES . $random_product['products_image'], $random_product['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, $add_style_slideshow_products_images_img) . tep_image(DIR_WS_IMAGES . $random_product['products_image_sm_1'], $random_product['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a></center>';
	  }else{
		$products_image_list = '<center><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '"  itemprop="url">' . tep_image(DIR_WS_IMAGES . $random_product['products_image'], $random_product['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a></center>';
	  }
// products image eof

// categories and sub-categories
if (DISPLAY_CATEGORIES_SUBCATEGORIES_PRODUCT_LIST == "true") {
	$add_categories_subcategories = '<span class="pl_categories_name">' . $subcategories['categories_name'] . ' - ' . $categories['categories_name'] . '</span><br><br>';
}
// categories and sub-categories eof

// button youtube play
if (ENABLE_YOUTUBE_PRODUCTLISTING == 'true') {
	if (!empty($random_product['products_youtube'])) {
	  if (strstr($random_product['products_youtube'], "<iframe")) {
		$youtube_array = explode('src="', $random_product['products_youtube']);
		$youtube_array1 = explode('"', $youtube_array[1]);
		$link_watch_youtube = str_replace("embed/", "watch?v=", $youtube_array1[0]);
		$button_youtube = '<a href="'.$link_watch_youtube.'" class="fancybox fancybox.iframe">'.tep_image(DIR_WS_IMAGES . 'icon_youtube_play.png', '', '', '', ' align="middle" ').'</a>';
	  }elseif (strstr($random_product['products_youtube'], "<object")) {
		$youtube_array2 = explode('src="', $random_product['products_youtube']);
		$youtube_array3 = explode('"', $youtube_array2[1]);
		$link_watch_youtube = str_replace("v/", "embed/", $youtube_array3[0]);
		$button_youtube = '<a href="'.$link_watch_youtube.'" class="fancybox fancybox.iframe">'.tep_image(DIR_WS_IMAGES . 'icon_youtube_play.png', '', '', '', ' align="middle" ').'</a>';
	  }elseif (strstr($random_product['products_youtube'], "watch?v=")) {
		$button_youtube = '<a href="'.str_replace("watch?v=", "embed/", $random_product['products_youtube']).'" class="fancybox fancybox.iframe">'.tep_image(DIR_WS_IMAGES . 'icon_youtube_play.png', '', '', '', ' align="middle" ').'</a>';
	  }
	}else{
		$button_youtube = '';
	}
}
// button youtube play eof
	
// likes
if (ENABLE_PRODUCTS_LIKES == "true"){
if (tep_session_is_registered('customer_id')) {
	$check_add_like_query = tep_db_query("select * from " . TABLE_PRODUCTS_LIKE_TRACK . " where products_id = '" . (int)$random_product["products_id"] . "' and customer_id = '" . (int)$customer_id . "' ");
	$str_like = "like";
	if (tep_db_num_rows($check_add_like_query) > 0) {
	$str_like = "unlike";
	}
	$add_likes_box = '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="demo-table">
	<tbody>
	<tr>
	<td align="default" width="100%" valign="top">
	<div id="prod-'.$random_product["products_id"].'">
	<input type="hidden" id="likes-'.$random_product["products_id"].'" value="'.$random_product["likes"].'">
	<div class="btn-likes"><input type="button" title="'.ucwords(ENTRY_TEXT_ILIKE).'" class="'.$str_like.'" onClick="addLikes('.$random_product["products_id"].',\''.$str_like.'\')" /></div>
	<div class="label-likes">'.($random_product["likes"] > 0 ? $random_product["likes"] . ' ' . ENTRY_TEXT_LIKES : '').'</div>
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
	<div id="prod-'.$random_product["products_id"].'">
	<input type="hidden" id="likes-'.$random_product["products_id"].'" value="'.$random_product["likes"].'">
	<div class="btn-likes"><input type="button" title="'.ucwords(ENTRY_TEXT_HOW_TO_LIKE).'" class="'.$str_like.'" /></div>
	<div class="label-likes">'.($random_product["likes"] > 0 ? $random_product["likes"] . ' ' . ENTRY_TEXT_LIKES : '').'</div>
	</div>
	</td>
	</tr>
	</tbody>
	</table>
	';
}
}
// likes eof

if ( (CAROUSEL_DEFAULT == true) && ($carousel_listings == "true") ) {

if (PRODUCT_LIST_ONMOUSEOVER_BUTTONS == "true") {
	$add_button_buynow = '<div class="div_hidden" id="div_name'.$random_product['products_id'].'"><br>'.$button_buynow.'</div>';
}else{
	$add_button_buynow = '<br>'.$button_buynow;
}

if (CAROUSEL_DEFAULT_STYLE == 'style1' || CAROUSEL_DEFAULT_STYLE == 'style2') {
$add_cs = '<li>';
$add_ce = '</li>';
}elseif (CAROUSEL_DEFAULT_STYLE == 'style3') {
$add_cs = '<div class="item">';
$add_ce = '</div>';
}

	  $info_box_contents = $add_cs.'<span class="smallText"><div class="pl_style_border_div">'.$add_categories_subcategories.$products_image_list.$add_likes_box.'<br><br>'.$button_youtube.'<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '">' . $manufacturers_name . $products_model . '<span class="pl_product_name">' . $random_product['products_name'] . '</span></a>'.$unidade_venda.'<br><span class="pl_expire_date">'.$specials_expiredate.'</span>'.$add_button_buynow.'</div></span></li>'.$add_ce;

}else{

if (PRODUCT_LIST_ONMOUSEOVER_BUTTONS == "true") {
	$add_button_buynow = '<div id="div_name'.$random_product['products_id'].'" style="display:none;"><br>'.$button_buynow.'</div>';
}else{
	$add_button_buynow = '<br>'.$button_buynow;
}
	  
	  $info_box_contents[$row][$col] = array('align' => 'left',
                                          'params' => 'class="smallText" width="25%" valign="top"',
                                          'text' => '<div class="pl_style_border_div" onmouseover="document.getElementById(\'div_name'.$random_product['products_id'].'\').style.display=\'\';" 
onmouseout="document.getElementById(\'div_name'.$random_product['products_id'].'\').style.display=\'none\';">'.$add_categories_subcategories.$products_image_list.$add_likes_box.'<br><br>'.$button_youtube.'<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '">' . $manufacturers_name . $products_model . '<span class="pl_product_name">' . $random_product['products_name'] . '</span></a>'.$unidade_venda.'<br><span class="pl_expire_date">'.$specials_expiredate.'</span>'.$add_button_buynow.'</div>');

}

}
//// end row and gallery ////
?>