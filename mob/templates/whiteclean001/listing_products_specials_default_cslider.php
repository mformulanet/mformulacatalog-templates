<?php
//// row ////
if ($type_listings == "row") {

// expire date and time
	  if ( ($random_product['products_quantity'] > 0) && (DISPLAY_EXPIRE_DATE_SPECIALS == 'true') ) {
		  if ( (tep_not_null($random_product['expires_date'])) && ($random_product['expires_date'] != '0000-00-00 00:00:00')) {
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
			  
			  $date_expire_replace = str_replace(array_keys($replacements), $replacements, calculate_date_between(date("Ymd H:i:s"), str_replace($replace_date_expire, "", $random_product['expires_date'])));
			  
			  $default_specials_expiredate = TEXT_SPECIALS_EXPIREDATE . ' ' . tep_date_short($random_product['expires_date']) . '<br>' . TEXT_SPECIALS_EXPIREDATE_FALTA . ' ' . $date_expire_replace;
		  }else{
			  $default_specials_expiredate = '';
		  }
	  }
// expire date and time eof

// button free shipping
	  if ($random_product['products_free_shipping'] == '1') {
	  	if ( (DEFAULT_CURRENCY == $currency) && (FREE_SHIPPING_TO_ALL_COUNTRIES == "national") ) {

			if (FREE_SHIPPING_TO_ALL_COUNTRIES_ESTADOS != '') {
			$text_free_shipping_estados = ' ' . str_replace(",", ", ", FREE_SHIPPING_TO_ALL_COUNTRIES_ESTADOS);
			}
			$button_free_shipping = '<br>' . tep_image_button('button_free_shipping.gif', FREE_SHIPPING_FOR_THIS_PRODUCT . $text_free_shipping_estados);
			if (FREE_SHIPPING_TO_ALL_COUNTRIES_ESTADOS != '') {
			$button_free_shipping .= str_replace(",", ", ", FREE_SHIPPING_TO_ALL_COUNTRIES_ESTADOS);
			}

		}elseif (FREE_SHIPPING_TO_ALL_COUNTRIES == "both") {
		$button_free_shipping = '<br>' . tep_image_button('button_free_shipping.gif', FREE_SHIPPING_FOR_THIS_PRODUCT);
		}elseif ( (DEFAULT_CURRENCY == $currency) && (FREE_SHIPPING_TO_ALL_COUNTRIES == "international") ) {
		$button_free_shipping = '<br>' . tep_image_button('button_free_shipping.gif', FREE_SHIPPING_FOR_THIS_PRODUCT);
		}
	  }else{
	  $button_free_shipping = '';
	  }
// button free shipping eof

// price and parcel
		$newprice = $random_product['specials_new_products_price'];

		if ($discount > 0) {
			if (CUSTOMER_GROUP_DISCOUNT_CHOOSE_PRODUCT_PRICE == "price") {
			$newprice = $random_product['products_price'];
			}
		}

		if ($discount > 0) $newprice = $newprice - ($newprice/100)*$discount;

		if ($discount > 0) {
		$price = $random_product['specials_new_products_price'];
		}else{
		$price = $random_product['products_price'];
		}

		if ($discount > 0) {
			if (CUSTOMER_GROUP_DISCOUNT_CHOOSE_PRODUCT_PRICE == "price") {
			$price = $random_product['products_price'];
			}
		}
		//if ($discount > 0) $price = $price - ($price/100)*$discount;

			if (VIEW_PLOTS_JUROS == 'true') {
			
				if ( (NUMBER_PLOTS_VISA > NUMBER_PLOTS_JUROS) && (VIEW_PLOTS_JUROS == 'true') ) {
				$newpriceplots = $newprice * pow((1 + TAXA_PLOTS_JUROS/100),NUMBER_PLOTS_VISA);
				$newprice = $newprice;
				}else{
				$newprice = $newprice;
				}
			
			}else{
			
				$newprice = $newprice;
			
			}
	
		if (VIEW_PLOTS_JUROS == 'true') {
		
			if ( (NUMBER_PLOTS_VISA > NUMBER_PLOTS_JUROS) && (VIEW_PLOTS_JUROS == 'true') ) {
			
			$price_divide = $currencies->format($newpriceplots / NUMBER_PLOTS_VISA);
			
			}else{
			
			$price_divide = $currencies->format($newprice / NUMBER_PLOTS_VISA);
			
			}
		
		}else{
		
		$price_divide = $currencies->format($newprice / NUMBER_PLOTS_VISA);
		
		}

		if ( ($CUSTOMER_CREATE_ACCOUNT_VIEW_PRICE == 'true') || ($random_product['view_price'] == 1) || ($registry_mode_id != 0) || ( (CUSTOMER_VIEW_PRODUCT_LOGIN_OR_CREATE_ACCOUNT_VIEW_PRICE == 'true') && (!tep_session_is_registered('customer_id')) ) || ( ($random_product['products_quantity'] < 1) &&  ($random_product['products_qtd_stock_status'] == '0') ) || ( ($random_product['products_quantity'] < 1) &&  ($random_product['products_qtd_stock_status'] == '') ) || ( ($random_product['products_quantity'] < 1) &&  ($random_product['products_qtd_stock_status'] == '2') ) || ( ($random_product['products_quantity'] < 1) &&  ($random_product['products_qtd_stock_status'] == '3') ) ) {
		
			$price_product = '';
		
		}elseif ( ($random_product['products_quantity'] > 0) || ( ($random_product['products_quantity'] <= 0) && ($random_product['products_qtd_stock_status'] == '1') ) ) {
	
			if (($random_product['parcel_window'] == 1) && ($language == 'portugues') && ($currency == 'BRL')) {

				if (TYPE_PRODUCT_PRICE_VIEW == 'COM-AVISTAPARCELA') {
				
				$price_product = '<br>'.TEXT_PRICE_PRODUCT_FROM.'<s>' . $currencies->display_price($price, tep_get_tax_rate($random_product['products_tax_class_id'])) . '</s>';
				
				$price_product .= '<br><span class="pl_product_special_price"><b>' . TEXT_PRICE_PRODUCT_TO . $currencies->display_price($newprice, tep_get_tax_rate($random_product['products_tax_class_id'])) . '</b></span>';
				
					if (MODULE_PAYMENT_DISC_STATUS == 'true') {
		
					$price1 = $newprice*MODULE_PAYMENT_DISC_PERCENTAGE;
					$price_desc = $price1/100;
					$new_products_price_ok = $newprice-$price_desc;
					
					$price_product .= '<br>'.TEXT_PRICE_PRODUCT_OR.'<span class="pl_product_special_price"><b>' . $currencies->display_price($new_products_price_ok, tep_get_tax_rate($random_product['products_tax_class_id'])) . '</b></span>' . ' ' . MODULE_PAYMENT_DISC_PERCENTAGE . '% ' . TEXT_OF_DISCOUNT . TEXT_PRICE_PRODUCT_AVISTA;
					
					}elseif (MODULE_PAYMENT_DISC1_STATUS == 'true') {
					
					$price1 = $newprice*MODULE_PAYMENT_DISC1_PERCENTAGE;
					$price_desc = $price1/100;
					$new_products_price_ok = $newprice-$price_desc;
					
					$price_product .= '<br>'.TEXT_PRICE_PRODUCT_OR.'<span class="pl_product_special_price"><b>' . $currencies->display_price($new_products_price_ok, tep_get_tax_rate($random_product['products_tax_class_id'])) . '</b></span>' . ' ' . MODULE_PAYMENT_DISC1_PERCENTAGE . '% ' . TEXT_OF_DISCOUNT . TEXT_PRICE_PRODUCT_AVISTA;
		
					}
				
					if ( (NUMBER_PLOTS_VISA > NUMBER_PLOTS_JUROS) && (VIEW_PLOTS_JUROS == 'true') ) {
					
					$price_product .= '<br>'.TEXT_PRICE_PRODUCT_OR.'<span class="pl_product_plots_price"><b>'.NUMBER_PLOTS_VISA.'x ' . $price_divide . '</b></span>' . ' ' . TEXT_COMJUROS . ' ' . TAXA_PLOTS_JUROS . '% a.m.';
					
					}else{
					
					$price_product .= '<br>'.TEXT_PRICE_PRODUCT_OR.'<span class="pl_product_plots_price"><b>'.NUMBER_PLOTS_VISA.'x ' . $price_divide . '</b></span>' . ' ' . TEXT_SEMJUROS;
					
					}
				
				$price_product .= '<br><br>';
				
				}else{
				
				$price_product = '<br><s>' . $currencies->display_price($price, tep_get_tax_rate($random_product['products_tax_class_id'])) . '</s><br><span class="pl_product_special_price"><b>' . $currencies->display_price($newprice, tep_get_tax_rate($random_product['products_tax_class_id'])) . '</b></span><br><span class="pl_product_plots_price"><strong>'.NUMBER_PLOTS_VISA.'x ' . $price_divide . '</strong></span>';
				
				}
			
			}else{
			
			$price_product = '<br><s>' . $currencies->display_price($price, tep_get_tax_rate($random_product['products_tax_class_id'])) . '</s><br><span class="pl_product_special_price"><b>' . $currencies->display_price($newprice, tep_get_tax_rate($random_product['products_tax_class_id'])) . '</b></span>';
			
			}
		}
// price and parcel eof

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
		
	} elseif ( ($registry_mode_id != 0) || (PRODUCT_LIST_BUY_NOW != 'true') || ( (CUSTOMER_VIEW_PRODUCT_LOGIN_OR_CREATE_ACCOUNT_VIEW_PRICE == 'true') && (!tep_session_is_registered('customer_id')) ) ) {
	
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

// products image
	  if (ENABLE_SLIDESHOW_PRODUCTS_IMAGES == 'true') {
	  	$add_style_slideshow_products_images = ' style="position: relative;" ';
		$add_style_slideshow_products_images_img = ' class="fadelistings" ';
	  }

	  if ($random_product['products_image_xl_1'] && ENABLE_SLIDESHOW_PRODUCTS_IMAGES == 'true' && file_exists(DIR_WS_IMAGES . $random_product['products_image_xl_1'])) {
		$products_image_list = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '" '.$add_style_slideshow_products_images.' itemprop="url">' . tep_image(DIR_WS_IMAGES . $random_product['products_image_lrg'], $random_product['products_name'], LARGE_IMAGE_WIDTH, LARGE_IMAGE_HEIGHT, $add_style_slideshow_products_images_img) . tep_image(DIR_WS_IMAGES . $random_product['products_image_xl_1'], $random_product['products_name'], LARGE_IMAGE_WIDTH, LARGE_IMAGE_HEIGHT) . '</a>';
	  }else{
		$products_image_list = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '"  itemprop="url">' . tep_image(DIR_WS_IMAGES . $random_product['products_image_lrg'], $random_product['products_name'], LARGE_IMAGE_WIDTH, LARGE_IMAGE_HEIGHT) . '</a>';
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
		$button_youtube = '<a href="'.$link_watch_youtube.'" class="fancybox fancybox.iframe">'.tep_image(DIR_WS_IMAGES . 'icon_youtube_play.png', '', '', '', ' align="middle" ').'</a><br>';
	  }elseif (strstr($random_product['products_youtube'], "<object")) {
		$youtube_array2 = explode('src="', $random_product['products_youtube']);
		$youtube_array3 = explode('"', $youtube_array2[1]);
		$link_watch_youtube = str_replace("v/", "embed/", $youtube_array3[0]);
		$button_youtube = '<a href="'.$link_watch_youtube.'" class="fancybox fancybox.iframe">'.tep_image(DIR_WS_IMAGES . 'icon_youtube_play.png', '', '', '', ' align="middle" ').'</a><br>';
	  }elseif (strstr($random_product['products_youtube'], "watch?v=")) {
		$button_youtube = '<a href="'.str_replace("watch?v=", "embed/", $random_product['products_youtube']).'" class="fancybox fancybox.iframe">'.tep_image(DIR_WS_IMAGES . 'icon_youtube_play.png', '', '', '', ' align="middle" ').'</a><br>';
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
	
	$info_box_contents[$row][$col] = array('align' => 'center',
                                          'params' => 'class="smallText" width="33%" valign="top"',
                                          'text' => '<div class="pl_style_border_div">

										   <table width="100%" border="0" cellspacing="0" cellpadding="0">
										   <tr>
										   <td width="30%" align="center" style="padding-right:10px;">
										   '.$products_image_list.'
										   </td>
										   <td valign="default" width="50%" class="smallText">
										   
										   '.$add_categories_subcategories.'
										   <span class="pl_expire_date">'.$default_specials_expiredate.'</span>
										   <br>'.$button_youtube.'<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '">' . $manufacturers_name . '<span class="pl_product_name">' . $random_product['products_name'] . '</span></a>'.$unidade_venda.'<br>'.$price_product.'
										   
										   </td>
										   <td align="center" width="20%">
										   '.$add_likes_box.'
										   '.$button_buynow.$button_free_shipping.'
										   </td>
										   </tr>
										   </table>										  
										  
										  </div>');

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//// gallery ////
}else{

// expire date and time
	  if ( ($random_product['products_quantity'] > 0) && (DISPLAY_EXPIRE_DATE_SPECIALS == 'true') ) {
		  if ( (tep_not_null($random_product['expires_date'])) && ($random_product['expires_date'] != '0000-00-00 00:00:00')) {
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
			  
			  $date_expire_replace = str_replace(array_keys($replacements), $replacements, calculate_date_between(date("Ymd H:i:s"), str_replace($replace_date_expire, "", $random_product['expires_date'])));
			  
			  $default_specials_expiredate = TEXT_SPECIALS_EXPIREDATE . ' ' . tep_date_short($random_product['expires_date']) . '<br>' . TEXT_SPECIALS_EXPIREDATE_FALTA . ' ' . $date_expire_replace . '<br><br>';
		  }else{
			  $default_specials_expiredate = '';
		  }
	  }
// expire date and time eof

// button free shipping
	  if ($random_product['products_free_shipping'] == '1') {
	  	if ( (DEFAULT_CURRENCY == $currency) && (FREE_SHIPPING_TO_ALL_COUNTRIES == "national") ) {

			if (FREE_SHIPPING_TO_ALL_COUNTRIES_ESTADOS != '') {
			$text_free_shipping_estados = ' ' . str_replace(",", ", ", FREE_SHIPPING_TO_ALL_COUNTRIES_ESTADOS);
			}
			$button_free_shipping = '<br><center>' . tep_image_button('button_free_shipping.gif', FREE_SHIPPING_FOR_THIS_PRODUCT . $text_free_shipping_estados) . '</center>';
			if (FREE_SHIPPING_TO_ALL_COUNTRIES_ESTADOS != '') {
			$button_free_shipping .= '<small><center>' . str_replace(",", ", ", FREE_SHIPPING_TO_ALL_COUNTRIES_ESTADOS) . '</center></small>';
			}

		}elseif (FREE_SHIPPING_TO_ALL_COUNTRIES == "both") {
		$button_free_shipping = '<br><center>' . tep_image_button('button_free_shipping.gif', FREE_SHIPPING_FOR_THIS_PRODUCT) . '</center>';
		}elseif ( (DEFAULT_CURRENCY == $currency) && (FREE_SHIPPING_TO_ALL_COUNTRIES == "international") ) {
		$button_free_shipping = '<br><center>' . tep_image_button('button_free_shipping.gif', FREE_SHIPPING_FOR_THIS_PRODUCT) . '</center>';
		}
	  }else{
	  $button_free_shipping = '';
	  }
// button free shipping eof

// price and parcel
		$newprice = $random_product['specials_new_products_price'];

		if ($discount > 0) {
			if (CUSTOMER_GROUP_DISCOUNT_CHOOSE_PRODUCT_PRICE == "price") {
			$newprice = $random_product['products_price'];
			}
		}

		if ($discount > 0) $newprice = $newprice - ($newprice/100)*$discount;

		if ($discount > 0) {
		$price = $random_product['specials_new_products_price'];
		}else{
		$price = $random_product['products_price'];
		}

		if ($discount > 0) {
			if (CUSTOMER_GROUP_DISCOUNT_CHOOSE_PRODUCT_PRICE == "price") {
			$price = $random_product['products_price'];
			}
		}
		//if ($discount > 0) $price = $price - ($price/100)*$discount;

			if (VIEW_PLOTS_JUROS == 'true') {
			
				if ( (NUMBER_PLOTS_VISA > NUMBER_PLOTS_JUROS) && (VIEW_PLOTS_JUROS == 'true') ) {
				$newpriceplots = $newprice * pow((1 + TAXA_PLOTS_JUROS/100),NUMBER_PLOTS_VISA);
				$newprice = $newprice;
				}else{
				$newprice = $newprice;
				}
			
			}else{
			
				$newprice = $newprice;
			
			}
	
		if (VIEW_PLOTS_JUROS == 'true') {
		
			if ( (NUMBER_PLOTS_VISA > NUMBER_PLOTS_JUROS) && (VIEW_PLOTS_JUROS == 'true') ) {
			
			$price_divide = $currencies->format($newpriceplots / NUMBER_PLOTS_VISA);
			
			}else{
			
			$price_divide = $currencies->format($newprice / NUMBER_PLOTS_VISA);
			
			}
		
		}else{
		
		$price_divide = $currencies->format($newprice / NUMBER_PLOTS_VISA);
		
		}

		if ( ($CUSTOMER_CREATE_ACCOUNT_VIEW_PRICE == 'true') || ($random_product['view_price'] == 1) || ($registry_mode_id != 0) || ( (CUSTOMER_VIEW_PRODUCT_LOGIN_OR_CREATE_ACCOUNT_VIEW_PRICE == 'true') && (!tep_session_is_registered('customer_id')) ) || ( ($random_product['products_quantity'] < 1) &&  ($random_product['products_qtd_stock_status'] == '0') ) || ( ($random_product['products_quantity'] < 1) &&  ($random_product['products_qtd_stock_status'] == '') ) || ( ($random_product['products_quantity'] < 1) &&  ($random_product['products_qtd_stock_status'] == '2') ) || ( ($random_product['products_quantity'] < 1) &&  ($random_product['products_qtd_stock_status'] == '3') ) ) {
		
			$price_product = '';
		
		}elseif ( ($random_product['products_quantity'] > 0) || ( ($random_product['products_quantity'] <= 0) && ($random_product['products_qtd_stock_status'] == '1') ) ) {
	
			if (($random_product['parcel_window'] == 1) && ($language == 'portugues') && ($currency == 'BRL')) {
			
				if (TYPE_PRODUCT_PRICE_VIEW == 'COM-AVISTAPARCELA') {
				
				$price_product = '<br>'.TEXT_PRICE_PRODUCT_FROM.'<s>' . $currencies->display_price($price, tep_get_tax_rate($random_product['products_tax_class_id'])) . '</s>';
				
				$price_product .= '<br><span class="pl_product_special_price"><b>' . TEXT_PRICE_PRODUCT_TO . $currencies->display_price($newprice, tep_get_tax_rate($random_product['products_tax_class_id'])) . '</b></span>';
				
					if (MODULE_PAYMENT_DISC_STATUS == 'true') {
		
					$price1 = $newprice*MODULE_PAYMENT_DISC_PERCENTAGE;
					$price_desc = $price1/100;
					$new_products_price_ok = $newprice-$price_desc;
					
					$price_product .= '<br>'.TEXT_PRICE_PRODUCT_OR.'<span class="pl_product_special_price"><b>' . $currencies->display_price($new_products_price_ok, tep_get_tax_rate($random_product['products_tax_class_id'])) . '</b></span>' . ' ' . MODULE_PAYMENT_DISC_PERCENTAGE . '% ' . TEXT_OF_DISCOUNT . TEXT_PRICE_PRODUCT_AVISTA;
					
					}elseif (MODULE_PAYMENT_DISC1_STATUS == 'true') {
					
					$price1 = $newprice*MODULE_PAYMENT_DISC1_PERCENTAGE;
					$price_desc = $price1/100;
					$new_products_price_ok = $newprice-$price_desc;
					
					$price_product .= '<br>'.TEXT_PRICE_PRODUCT_OR.'<span class="pl_product_special_price"><b>' . $currencies->display_price($new_products_price_ok, tep_get_tax_rate($random_product['products_tax_class_id'])) . '</b></span>' . ' ' . MODULE_PAYMENT_DISC1_PERCENTAGE . '% ' . TEXT_OF_DISCOUNT . TEXT_PRICE_PRODUCT_AVISTA;
		
					}
				
					if ( (NUMBER_PLOTS_VISA > NUMBER_PLOTS_JUROS) && (VIEW_PLOTS_JUROS == 'true') ) {
					
					$price_product .= '<br>'.TEXT_PRICE_PRODUCT_OR.'<span class="pl_product_plots_price"><b>'.NUMBER_PLOTS_VISA.'x ' . $price_divide . '</b></span>' . ' ' . TEXT_COMJUROS . ' ' . TAXA_PLOTS_JUROS . '% a.m.';
					
					}else{
					
					$price_product .= '<br>'.TEXT_PRICE_PRODUCT_OR.'<span class="pl_product_plots_price"><b>'.NUMBER_PLOTS_VISA.'x ' . $price_divide . '</b></span>' . ' ' . TEXT_SEMJUROS;
					
					}
				
				$price_product .= '<br><br>';
				
				}else{
				
				$price_product = '<br><s>' . $currencies->display_price($price, tep_get_tax_rate($random_product['products_tax_class_id'])) . '</s><br><span class="pl_product_special_price"><b>' . $currencies->display_price($newprice, tep_get_tax_rate($random_product['products_tax_class_id'])) . '</b></span><br><span class="pl_product_plots_price"><strong>'.NUMBER_PLOTS_VISA.'x ' . $price_divide . '</strong></span>';
				
				}
			
			}else{
			
			$price_product = '<br><s>' . $currencies->display_price($price, tep_get_tax_rate($random_product['products_tax_class_id'])) . '</s><br><span class="pl_product_special_price"><b>' . $currencies->display_price($newprice, tep_get_tax_rate($random_product['products_tax_class_id'])) . '</b></span>';
			
			}
		}
// price and parcel eof

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
		
	} elseif ( ($registry_mode_id != 0) || (PRODUCT_LIST_BUY_NOW != 'true') || ( (CUSTOMER_VIEW_PRODUCT_LOGIN_OR_CREATE_ACCOUNT_VIEW_PRICE == 'true') && (!tep_session_is_registered('customer_id')) ) ) {
	
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

// products image
	  if (ENABLE_SLIDESHOW_PRODUCTS_IMAGES == 'true') {
	  	$add_style_slideshow_products_images = ' style="position: relative;" ';
		$add_style_slideshow_products_images_img = ' class="fadelistings" ';
	  }

	  if ($random_product['products_image_xl_1'] && ENABLE_SLIDESHOW_PRODUCTS_IMAGES == 'true' && file_exists(DIR_WS_IMAGES . $random_product['products_image_xl_1'])) {
		$products_image_list = '<center><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '" '.$add_style_slideshow_products_images.' itemprop="url">' . tep_image(DIR_WS_IMAGES . $random_product['products_image_lrg'], $random_product['products_name'], LARGE_IMAGE_WIDTH, LARGE_IMAGE_HEIGHT, $add_style_slideshow_products_images_img) . tep_image(DIR_WS_IMAGES . $random_product['products_image_xl_1'], $random_product['products_name'], LARGE_IMAGE_WIDTH, LARGE_IMAGE_HEIGHT) . '</a></center>';
	  }else{
		$products_image_list = '<center><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '"  itemprop="url">' . tep_image(DIR_WS_IMAGES . $random_product['products_image_lrg'], $random_product['products_name'], LARGE_IMAGE_WIDTH, LARGE_IMAGE_HEIGHT) . '</a></center>';
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
		$button_youtube = '<a href="'.$link_watch_youtube.'" class="fancybox fancybox.iframe">'.tep_image(DIR_WS_IMAGES . 'icon_youtube_play.png', '', '', '', ' align="middle" ').'</a><br>';
	  }elseif (strstr($random_product['products_youtube'], "<object")) {
		$youtube_array2 = explode('src="', $random_product['products_youtube']);
		$youtube_array3 = explode('"', $youtube_array2[1]);
		$link_watch_youtube = str_replace("v/", "embed/", $youtube_array3[0]);
		$button_youtube = '<a href="'.$link_watch_youtube.'" class="fancybox fancybox.iframe">'.tep_image(DIR_WS_IMAGES . 'icon_youtube_play.png', '', '', '', ' align="middle" ').'</a><br>';
	  }elseif (strstr($random_product['products_youtube'], "watch?v=")) {
		$button_youtube = '<a href="'.str_replace("watch?v=", "embed/", $random_product['products_youtube']).'" class="fancybox fancybox.iframe">'.tep_image(DIR_WS_IMAGES . 'icon_youtube_play.png', '', '', '', ' align="middle" ').'</a><br>';
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

	  $info_box_contents[$row][$col] = array('align' => 'left',
                                          'params' => 'class="smallText" width="25%" valign="top"',
                                          'text' => '<div class="pl_style_border_div" onmouseover="document.getElementById(\'div_name'.$random_product['products_id'].'\').style.display=\'\';" 
onmouseout="document.getElementById(\'div_name'.$random_product['products_id'].'\').style.display=\'none\';">'.$add_categories_subcategories.'<span class="pl_expire_date">'.$default_specials_expiredate.'</span>'.$products_image_list.$add_likes_box.''.$button_free_shipping.'<br><br>'.$button_youtube.'<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '">' . $manufacturers_name . '<span class="pl_product_name">' . $random_product['products_name'] . '</span></a>'.$unidade_venda.'<br>'.$price_product.'<br>'.$button_buynow.'</div>');


}
//// end row and gallery ////
?>