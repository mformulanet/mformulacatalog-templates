<?php
//// row ////
if ($type_listings == "row") {

// expire date and time
	 if ( (tep_get_products_special_price($products_id)) && (DISPLAY_EXPIRE_DATE_SPECIALS == 'true') ) {
	 
	 $specials_expires_date = tep_get_products_special_expire_date($products_id);
	 
		  if ($products_quantity > 0) {
			  if ( (tep_not_null(tep_get_products_special_price($products_id))) && (tep_not_null($specials_expires_date)) && ($specials_expires_date != '0000-00-00 00:00:00')) {
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

// button free shipping
	  if ($products_free_shipping == '1') {
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

// new or update button
$days_to_add = DAY_BUTTON_NEW_UPDATED;
$current_date = date("Y-m-d");

if ( (VIEW_BUTTON_NEW == 'true') ||(VIEW_BUTTON_NEW == 'True') ) {
	$products_date_added = explode(" ", $products_date_added);	
	$date_added = fnc_date_calc($products_date_added[0],$days_to_add);		
	if ($date_added >= $current_date) {
	$button_free_shipping .= '<br><img src="'.DIR_WS_LANGUAGES . $language . '/images/buttons/small_new.gif" border="0">';
	}else{
	$button_free_shipping .= '';
	}
}

if ( (VIEW_BUTTON_UPDATED == 'true') ||(VIEW_BUTTON_UPDATED == 'True') ) {
	if (!empty($products_last_modified)) {
	$products_last_modified = explode(" ", $products_last_modified);
	$last_modified = fnc_date_calc($products_last_modified[0],$days_to_add);
		if ($last_modified >= $current_date) {
		$button_free_shipping .= '<br><img src="'.DIR_WS_LANGUAGES . $language . '/images/buttons/small_update.gif" border="0">';
		}else{
		$button_free_shipping .= '';
		}		
	}
}

// new or update button

// price and parcel
      $random_product['specials_new_products_price'] = tep_get_products_special_price($products_id);

if ( ($CUSTOMER_CREATE_ACCOUNT_VIEW_PRICE == 'true') || ($view_price == 1) || ($registry_mode_id != 0) || ( (CUSTOMER_VIEW_PRODUCT_LOGIN_OR_CREATE_ACCOUNT_VIEW_PRICE == 'true') && (!tep_session_is_registered('customer_id')) ) || ( ($products_quantity < 1) &&  ($random_product['products_qtd_stock_status'] == '0') ) || ( ($products_quantity < 1) &&  ($random_product['products_qtd_stock_status'] == '') ) || ( ($products_quantity < 1) &&  ($random_product['products_qtd_stock_status'] == '2') ) || ( ($products_quantity < 1) &&  ($random_product['products_qtd_stock_status'] == '3') ) ) {

$whats_new_price = '';

}else
if ( ($products_quantity > 0) || ( ($products_quantity <= 0) && ($random_product['products_qtd_stock_status'] == '1') ) ) {

    if (tep_not_null($random_product['specials_new_products_price'])) {
      
	  if (($parcel_window == 1) && ($language == 'portugues') && ($currency == 'BRL')) {

		$newprice = $random_product['specials_new_products_price'];

		if ($discount > 0) {
			if (CUSTOMER_GROUP_DISCOUNT_CHOOSE_PRODUCT_PRICE == "price") {
			$newprice = $products_price;
			}
		}

		if ($discount > 0) $newprice = $newprice - ($newprice/100)*$discount;

		if ($discount > 0) {
		$price = $random_product['specials_new_products_price'];
		}else{
		$price = $products_price;
		}

		if ($discount > 0) {
			if (CUSTOMER_GROUP_DISCOUNT_CHOOSE_PRODUCT_PRICE == "price") {
			$price = $products_price;
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

		if (TYPE_PRODUCT_PRICE_VIEW == 'COM-AVISTAPARCELA') {
		
		$whats_new_price = '<br>'.TEXT_PRICE_PRODUCT_FROM.'<s>' . $currencies->display_price($price, tep_get_tax_rate($products_tax_class_id)) . '</s>';
		
		$whats_new_price .= '<br><span class="pl_product_special_price"><b>' . TEXT_PRICE_PRODUCT_TO . $currencies->display_price($newprice, tep_get_tax_rate($products_tax_class_id)) . '</b></span>';
		
			if (MODULE_PAYMENT_DISC_STATUS == 'true') {
	
			$price1 = $newprice*MODULE_PAYMENT_DISC_PERCENTAGE;
			$price_desc = $price1/100;
			$new_products_price_ok = $newprice-$price_desc;
			
			$whats_new_price .= '<br>'.TEXT_PRICE_PRODUCT_OR.'<span class="pl_product_special_price"><b>' . $currencies->display_price($new_products_price_ok, tep_get_tax_rate($products_tax_class_id)) . '</b></span>' . ' ' . MODULE_PAYMENT_DISC_PERCENTAGE . '% ' . TEXT_OF_DISCOUNT . TEXT_PRICE_PRODUCT_AVISTA;
			
			}elseif (MODULE_PAYMENT_DISC1_STATUS == 'true') {
			
			$price1 = $newprice*MODULE_PAYMENT_DISC1_PERCENTAGE;
			$price_desc = $price1/100;
			$new_products_price_ok = $newprice-$price_desc;
			
			$whats_new_price .= '<br>'.TEXT_PRICE_PRODUCT_OR.'<span class="pl_product_special_price"><b>' . $currencies->display_price($new_products_price_ok, tep_get_tax_rate($products_tax_class_id)) . '</b></span>' . ' ' . MODULE_PAYMENT_DISC1_PERCENTAGE . '% ' . TEXT_OF_DISCOUNT . TEXT_PRICE_PRODUCT_AVISTA;
	
			}
		
			if ( (NUMBER_PLOTS_VISA > NUMBER_PLOTS_JUROS) && (VIEW_PLOTS_JUROS == 'true') ) {
			
			$whats_new_price .= '<br>'.TEXT_PRICE_PRODUCT_OR.'<span class="pl_product_plots_price"><b>'.NUMBER_PLOTS_VISA.'x ' . $price_divide . '</b></span>' . ' ' . TEXT_COMJUROS . ' ' . TAXA_PLOTS_JUROS . '% a.m.';
			
			}else{
			
			$whats_new_price .= '<br>'.TEXT_PRICE_PRODUCT_OR.'<span class="pl_product_plots_price"><b>'.NUMBER_PLOTS_VISA.'x ' . $price_divide . '</b></span>' . ' ' . TEXT_SEMJUROS;
			
			}
		
		$whats_new_price .= '<br>';
		
		}else{
		
		$whats_new_price = '<br><s>' . $currencies->display_price($price, tep_get_tax_rate($products_tax_class_id)) . '</s><br>';
		$whats_new_price .= '<strong><span class="pl_product_special_price">' . $currencies->display_price($newprice, tep_get_tax_rate($products_tax_class_id)) . '<br>'.NUMBER_PLOTS_VISA.'x ' . $price_divide . '</span></strong>';
		
		}
	  
	  } else {

		$newprice = $random_product['specials_new_products_price'];

		if ($discount > 0) {
			if (CUSTOMER_GROUP_DISCOUNT_CHOOSE_PRODUCT_PRICE == "price") {
			$newprice = $products_price;
			}
		}

		if ($discount > 0) $newprice = $newprice - ($newprice/100)*$discount;

		if ($discount > 0) {
		$newprice = $random_product['specials_new_products_price'];
		}else{
		$price = $products_price;
		}

		if ($discount > 0) {
			if (CUSTOMER_GROUP_DISCOUNT_CHOOSE_PRODUCT_PRICE == "price") {
			$price = $products_price;
			}
		}
		//if ($discount > 0) $price = $price - ($price/100)*$discount;
	  
	  $whats_new_price = '<br><s>' . $currencies->display_price($price, tep_get_tax_rate($products_tax_class_id)) . '</s><br>';
      $whats_new_price .= '<strong><span class="pl_product_special_price">' . $currencies->display_price($newprice, tep_get_tax_rate($products_tax_class_id)) . '</span></strong>';
	  
	  }
	  
    } else {

	  if (($parcel_window == 1) && ($language == 'portugues') && ($currency == 'BRL')) {

		$prod_price = $products_price;
		if ($discount > 0) $prod_price = $prod_price - ($prod_price/100)*$discount;
	  
			if (VIEW_PLOTS_JUROS == 'true') {
			
				if ( (NUMBER_PLOTS_VISA > NUMBER_PLOTS_JUROS) && (VIEW_PLOTS_JUROS == 'true') ) {
				$priceplots = $prod_price * pow((1 + TAXA_PLOTS_JUROS/100),NUMBER_PLOTS_VISA);
				$prod_price = $prod_price;
				}else{
				$prod_price = $prod_price;
				}
			
			}else{
			
				$prod_price = $prod_price;
			
			}

		if (VIEW_PLOTS_JUROS == 'true') {
		
			if ( (NUMBER_PLOTS_VISA > NUMBER_PLOTS_JUROS) && (VIEW_PLOTS_JUROS == 'true') ) {
			
			$price_divide = $currencies->format($priceplots / NUMBER_PLOTS_VISA);
			
			}else{
			
			$price_divide = $currencies->format($prod_price / NUMBER_PLOTS_VISA);
			
			}
		
		}else{
		
		$price_divide = $currencies->format($prod_price / NUMBER_PLOTS_VISA);
		
		}
	  
	  	$orig_price = $products_price;

		if (TYPE_PRODUCT_PRICE_VIEW == 'COM-AVISTAPARCELA') {
				
		$whats_new_price = '';

		// fake special price
		if (ENABLE_FAKE_SPECIAL_PRICE_ALL_PRODUCTS == 'true') {
		if (!tep_get_products_special_price($products_id)) {
		$percentage_add = PERCENTAGE_FAKE_SPECIAL_PRICE_ALL_PRODUCTS;
		$price_to_add = round( ($percentage_add/100)*$products_price, 0 );
		$new_price_add = $products_price + $price_to_add;
		$whats_new_price .= '<br>'.TEXT_PRICE_PRODUCT_FROM."<s>" . $currencies->display_price($new_price_add, tep_get_tax_rate($products_tax_class_id)) . "</s>";
		}
		}
		// fake special price

		if ($discount > 0) {
		$whats_new_price .= '<br>'.TEXT_PRICE_PRODUCT_FROM.'<s>' . $currencies->display_price($orig_price, tep_get_tax_rate($products_tax_class_id)) . '</s>';
		}
		
		$whats_new_price .= '<br><span class="pl_product_price"><b>' . TEXT_PRICE_PRODUCT_TO . $currencies->display_price($prod_price, tep_get_tax_rate($products_tax_class_id)) . '</b></span>';
		
			if (MODULE_PAYMENT_DISC_STATUS == 'true') {
	
			$price1 = $prod_price*MODULE_PAYMENT_DISC_PERCENTAGE;
			$price_desc = $price1/100;
			$new_products_price_ok = $prod_price-$price_desc;
			
			$whats_new_price .= '<br>'.TEXT_PRICE_PRODUCT_OR.'<span class="pl_product_special_price"><b>' . $currencies->display_price($new_products_price_ok, tep_get_tax_rate($products_tax_class_id)) . '</b></span>' . ' ' . MODULE_PAYMENT_DISC_PERCENTAGE . '% ' . TEXT_OF_DISCOUNT . TEXT_PRICE_PRODUCT_AVISTA;
			
			}elseif (MODULE_PAYMENT_DISC1_STATUS == 'true') {
			
			$price1 = $prod_price*MODULE_PAYMENT_DISC1_PERCENTAGE;
			$price_desc = $price1/100;
			$new_products_price_ok = $prod_price-$price_desc;
			
			$whats_new_price .= '<br>'.TEXT_PRICE_PRODUCT_OR.'<span class="pl_product_special_price"><b>' . $currencies->display_price($new_products_price_ok, tep_get_tax_rate($products_tax_class_id)) . '</b></span>' . ' ' . MODULE_PAYMENT_DISC1_PERCENTAGE . '% ' . TEXT_OF_DISCOUNT . TEXT_PRICE_PRODUCT_AVISTA;
	
			}
		
			if ( (NUMBER_PLOTS_VISA > NUMBER_PLOTS_JUROS) && (VIEW_PLOTS_JUROS == 'true') ) {
			
			$whats_new_price .= '<br>'.TEXT_PRICE_PRODUCT_OR.'<span class="pl_product_plots_price"><b>'.NUMBER_PLOTS_VISA.'x ' . $price_divide . '</b></span>' . ' ' . TEXT_COMJUROS . ' ' . TAXA_PLOTS_JUROS . '% a.m.';
			
			}else{
			
			$whats_new_price .= '<br>'.TEXT_PRICE_PRODUCT_OR.'<span class="pl_product_plots_price"><b>'.NUMBER_PLOTS_VISA.'x ' . $price_divide . '</b></span>' . ' ' . TEXT_SEMJUROS;
			
			}
		
		$whats_new_price .= '<br>';
		
		}else{
		
      	$whats_new_price = '';

		// fake special price
		if (ENABLE_FAKE_SPECIAL_PRICE_ALL_PRODUCTS == 'true') {
		if (!tep_get_products_special_price($products_id)) {
		$percentage_add = PERCENTAGE_FAKE_SPECIAL_PRICE_ALL_PRODUCTS;
		$price_to_add = round( ($percentage_add/100)*$products_price, 0 );
		$new_price_add = $products_price + $price_to_add;
		$whats_new_price .= '<br>'.TEXT_PRICE_PRODUCT_FROM."<s>" . $currencies->display_price($new_price_add, tep_get_tax_rate($products_tax_class_id)) . "</s>";
		}
		}
		// fake special price

		if ($discount > 0) {
		$whats_new_price .= '<br><s>'.$currencies->display_price($orig_price, tep_get_tax_rate($products_tax_class_id)) . '</s>';
		}
		
		$whats_new_price .= '<br><strong><span class="pl_product_price">'.$currencies->display_price($prod_price, tep_get_tax_rate($products_tax_class_id)) . '</span><br><span class="pl_product_plots_price"> '.NUMBER_PLOTS_VISA.'x ' . $price_divide . '</span></strong>';
		
		}

	  } else {

		$orig_price = $products_price;
		
		$price = $products_price;
		if ($discount > 0) $price = $price - ($price/100)*$discount;
	  
      	$whats_new_price = '';

		// fake special price
		if (ENABLE_FAKE_SPECIAL_PRICE_ALL_PRODUCTS == 'true') {
		if (!tep_get_products_special_price($products_id)) {
		$percentage_add = PERCENTAGE_FAKE_SPECIAL_PRICE_ALL_PRODUCTS;
		$price_to_add = round( ($percentage_add/100)*$products_price, 0 );
		$new_price_add = $products_price + $price_to_add;
		$whats_new_price .= '<br>'.TEXT_PRICE_PRODUCT_FROM."<s>" . $currencies->display_price($new_price_add, tep_get_tax_rate($products_tax_class_id)) . "</s>";
		}
		}
		// fake special price

		if ($discount > 0) {
		$whats_new_price .= '<br><s>'.$currencies->display_price($orig_price, tep_get_tax_rate($products_tax_class_id)) . '</s>';
		}
		
		$whats_new_price .= '<br><strong><span class="pl_product_price">'.$currencies->display_price($price, tep_get_tax_rate($products_tax_class_id)) . '</span></strong>'; 
	  
	  }

    }


}
// price and parcel eof

// buttons
if (PRODUCT_LIST_HIDE_ALL_BUTTONS == 'false') {

	if (PRODUCT_LIST_DETAILS == 'true') {
	$button_details = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products_id) . '">' . tep_image_button('small_details.gif', '') . '</a><br>';
	}
	
	if (PRODUCT_LIST_QUICKVIEW == 'true') {
	$button_quickview = '<a href="' . tep_href_link(FILENAME_PRODUCT_QUICKVIEW, 'products_id=' . $products_id) . '" class="fancybox fancybox.iframe">' . tep_image_button('button_quickview.gif', '') . '</a><br>';
	}
	
	if (PRODUCT_LIST_BUY_NOW_FAST == 'true') {
	if (tep_has_product_attributes($products_id)) {					
		$button_buy_now_fast_link = '<a href="' . tep_href_link(FILENAME_PRODUCT_QUICKVIEW, 'products_id=' . $products_id) . '" class="fancybox fancybox.iframe">' . tep_image_button('button_buy_now_fast.gif', '') . '</a><br>';
	}else{
		$button_buy_now_fast_link = '<a href="' . tep_href_link_fast(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $products_id, 'NONSSL') . '">' . tep_image_button('button_buy_now_fast.gif', '') . '</a><br>';
	}
	}
	
	if (PRODUCT_LIST_BUY_NOW == 'true') {
	$button_buy_now = '<a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $products_id, 'NONSSL') . '">' . tep_image_button('button_buy_now.gif', '') . '</a><br>';
	}
	
	if (PRODUCT_LIST_CONTACT == 'true') {
	$button_contact = '<a href="'.tep_href_link(FILENAME_PRODUCT_CONTACT, 'products_id=' . $products_id).'" class="fancybox fancybox.iframe">' . tep_image_button('button_contact.gif', $products_name) . '</a><br>';
	}

	if ($CUSTOMER_CREATE_ACCOUNT_VIEW_PRICE == 'true') {
		
		$button_buynow = $button_details;
		
	} elseif ( ($registry_mode_id != 0) || (PRODUCT_LIST_BUY_NOW != 'true') || ( (CUSTOMER_VIEW_PRODUCT_LOGIN_OR_CREATE_ACCOUNT_VIEW_PRICE == 'true') && (!tep_session_is_registered('customer_id')) ) ) {
	
		$button_buynow = $button_details.$button_quickview;
	
	} elseif ( ($view_price == 1) || ($products_quantity <= 0) ) {
	
		$button_buynow = $button_contact.$button_quickview.$button_details;
	
	}elseif ( ($view_price == 1) || ( ($products_quantity <= 0) && ($products_qtd_stock_status == '0') ) || ( ($products_quantity <= 0) && ($products_qtd_stock_status == '') ) || ( ($products_quantity <= 0) && ($products_qtd_stock_status == '2') ) || ( ($products_quantity <= 0) && ($products_qtd_stock_status == '3') ) ) {
	
		$button_buynow = $button_contact.$button_quickview.$button_details;
	
	}else{
	
		$button_buynow = $button_buy_now.$button_buy_now_fast_link.$button_details.$button_quickview;
		
	}

}
// buttons eof

// products model
if ( (VIEW_REFERENCE == 'true') ||(VIEW_REFERENCE == 'True') ) {

	if ($products_model) {
	$products_model =  '<span class="pl_product_name">' . $products_model . '</span><br>';
	}

}
// products model eof

// products image
	  if (ENABLE_SLIDESHOW_PRODUCTS_IMAGES == 'true') {
	  	$add_style_slideshow_products_images = ' style="position: relative;" ';
		$add_style_slideshow_products_images_img = ' class="fadelistings" ';
	  }

	  if ($random_product['products_image_sm_1'] && ENABLE_SLIDESHOW_PRODUCTS_IMAGES == 'true' && file_exists(DIR_WS_IMAGES . $random_product['products_image_sm_1'])) {
		$products_image_list = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products_id) . '" '.$add_style_slideshow_products_images.' itemprop="url">' . tep_image(DIR_WS_IMAGES . $random_product['products_image'], $products_name, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, $add_style_slideshow_products_images_img) . tep_image(DIR_WS_IMAGES . $random_product['products_image_sm_1'], $products_name, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>';
	  }else{
		$products_image_list = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products_id) . '"  itemprop="url">' . tep_image(DIR_WS_IMAGES . $random_product['products_image'], $products_name, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>';
	  }
// products image eof

// products options
if ( ( (CUSTOMER_VIEW_PRODUCT_LOGIN_OR_CREATE_ACCOUNT_VIEW_PRICE == 'true') && (tep_session_is_registered('customer_id')) ) || (CUSTOMER_VIEW_PRODUCT_LOGIN_OR_CREATE_ACCOUNT_VIEW_PRICE != 'true') ) {
if ( ($random_product['view_price'] == 1) || ( ($random_product['products_quantity'] <= 0) && ($random_product['products_qtd_stock_status'] == '0') ) || ( ($random_product['products_quantity'] <= 0) && ($random_product['products_qtd_stock_status'] == '') ) || ( ($random_product['products_quantity'] <= 0) && ($random_product['products_qtd_stock_status'] == '2') ) || ( ($random_product['products_quantity'] <= 0) && ($random_product['products_qtd_stock_status'] == '3') ) ) {
}else{
	
$add_products_options = '';

      $products_options_name_query = tep_db_query("select distinct popt.products_options_id, popt.products_options_name, popt.products_options_type, popt.products_options_length, popt.products_options_comment from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib where patrib.products_id='" . (int)$products_id . "' and patrib.options_id = popt.products_options_id and popt.language_id = '" . (int)$languages_id . "' order by popt.products_options_order, popt.products_options_name");
      while ($products_options_name = tep_db_fetch_array($products_options_name_query)) {

 // - Zappo - Option Types v2 - Use some easy shorter names for products_options_name values
	$Default = false;  // Set this value to true if current option is Default (drowpdown) (see below)
	$ProdOpt_ID = $products_options_name['products_options_id'];
  $ProdOpt_Name = $products_options_name['products_options_name'];
  $ProdOpt_Comment = $products_options_name['products_options_comment'];
  $ProdOpt_Length = $products_options_name['products_options_length'];
  $products_attribs_query = tep_db_query("select distinct options_values_id, options_values_price, price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id='" . (int)tep_db_input($product_info['products_id']) . "' and options_id = '" . $ProdOpt_ID . "' order by products_options_sort_order");
  $products_attribs_array = tep_db_fetch_array($products_attribs_query);
	// Get Price for Option Values (Except for Multi-Options (Like Dropdown and Radio))
  if ($products_attribs_array['options_values_price'] != '0') {
    $tmp_html_price = ' (' . $products_attribs_array['price_prefix'] . $currencies->display_price($products_attribs_array['options_values_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) .') ';
  } else {
	  $tmp_html_price = '';
	}
	
	switch ($products_options_name['products_options_type']) {
    case OPTIONS_TYPE_TEXT:
      $tmp_html = '<input type="text" name="id['.$products_id.'][' . TEXT_PREFIX . $ProdOpt_ID . ']" id="id['.$products_id.'][' . TEXT_PREFIX . $ProdOpt_ID . ']" style="width: 100%; font-size: 1.5em;" maxlength="' . $ProdOpt_Length . '"
                             value="' . $cart->contents[$products_id]['attributes_values'][$ProdOpt_ID] .'"';
      if ( defined('OPTIONS_TYPE_PROGRESS') &&  (OPTIONS_TYPE_PROGRESS == 'Text' || OPTIONS_TYPE_PROGRESS == 'Both') ) {
        $tmp_html .= 'onKeyDown="textCounter(this,\'progressbar_'. $ProdOpt_ID . '\',' . $ProdOpt_Length . ')"
                               onKeyUp="textCounter(this,\'progressbar_'. $ProdOpt_ID . '\',' . $ProdOpt_Length . ')"
                               onFocus="textCounter(this,\'progressbar_'. $ProdOpt_ID . '\',' . $ProdOpt_Length . ')"> &nbsp; ' . $ProdOpt_Comment . $tmp_html_price .
                              '<div id="counterbar_'. $ProdOpt_ID . '" class="bar"><div id="progressbar_'. $ProdOpt_ID . '" class="progress"></div></div>
                               <script>textCounter(document.getElementById("id['.$products_id.'][' . TEXT_PREFIX . $ProdOpt_ID . ']"),"progressbar_' . $ProdOpt_ID . '",' . $ProdOpt_Length . ',"counterbar_'. $ProdOpt_ID . '")</script>';
      } else {
        $tmp_html .= '>' . $ProdOpt_Comment . $tmp_html_price;
      }
	  
$add_products_options .= $ProdOpt_Name . ':';
$add_products_options .= $tmp_html;
$add_products_options .= "<br>";

    break;

    case OPTIONS_TYPE_TEXTAREA:
      $tmp_html = '<textarea name="id['.$products_id.'][' . TEXT_PREFIX . $ProdOpt_ID . ']" id="id['.$products_id.'][' . TEXT_PREFIX . $ProdOpt_ID . ']"  rows="3"';

        $tmp_html .= '>' . $cart->contents[$products_id]['attributes_values'][$ProdOpt_ID] . '</textarea>';

$add_products_options .= $ProdOpt_Name . ' :</b><br>' . $ProdOpt_Comment . ' ' . $tmp_html_price;
$add_products_options .= $tmp_html;
$add_products_options .= "<br>";

    break;

    case OPTIONS_TYPE_RADIO:
      $tmp_html = '<table>';
      $products_options_query = tep_db_query("select pov.products_options_values_id, pov.products_options_values_name, pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov where pa.products_id = '" . (int)$product_info['products_id'] . "' and pa.options_id = '" . $ProdOpt_ID . "' and pa.options_values_id = pov.products_options_values_id and pov.language_id = '" . $languages_id . "' order by pa.products_options_sort_order");
      while ($products_options_array = tep_db_fetch_array($products_options_query)) {
        if (isset($cart->contents[$products_id]['attributes'][$ProdOpt_ID]) && ($products_options_array['products_options_values_id'] == $cart->contents[$products_id]['attributes'][$ProdOpt_ID])) {
          $checked = true;
        } else {
          $checked = false;
        }
        $tmp_html .= '<tr><td class="main">';
        $tmp_html .= tep_draw_radio_field('id['.$products_id.'][' . $ProdOpt_ID . ']', $products_options_array['products_options_values_id'], $checked, ' style="width:2em; height:2em;" ');
        $tmp_html .= $products_options_array['products_options_values_name'];
        if ($products_options_array['options_values_price'] != '0') {
          $tmp_html .= ' (' . $products_options_array['price_prefix'] . $currencies->display_price($products_options_array['options_values_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) .')&nbsp';
        }
        $tmp_html .= '</tr></td>';
      }
      $tmp_html .= '</table>';

$add_products_options .= $ProdOpt_Name . ' :<br><small>' . $ProdOpt_Comment . '</small>';
$add_products_options .= $tmp_html;
$add_products_options .= "<br>";

    break;

    case OPTIONS_TYPE_CHECKBOX:
      if (isset($cart->contents[$products_id]['attributes'][$ProdOpt_ID])) {
        $checked = true;
      } else {
        $checked = false;
      }
      $tmp_html = tep_draw_checkbox_field('id['.$products_id.'][' . $ProdOpt_ID . ']', $products_attribs_array['options_values_id'], $checked, ' style="width:2em; height:2em;" ') . ' &nbsp; ';
      $tmp_html .= $ProdOpt_Comment ;
      $tmp_html .= $tmp_html_price;

$add_products_options .= $ProdOpt_Name . ' :';
$add_products_options .= $tmp_html;
$add_products_options .= "<br>";

    break;

    case OPTIONS_TYPE_FILE:
      $number_of_uploads++;
  		//BOF - Zappo - Option Types v2 - Added dropdown with previously uploaded files
			if ($old_uploads == true) unset($uploaded_array);
      $uploaded_array[] = array('id' => '', 'text' => TEXT_NONE);
      $uploaded_files_query = tep_db_query("select files_uploaded_name from " . TABLE_FILES_UPLOADED . " where sesskey = '" . tep_session_id() . "' or customers_id = '" . (int)$customer_id . "'");
      while ($uploaded_files = tep_db_fetch_array($uploaded_files_query)) {
        $uploaded_array[] = array('id' => $uploaded_files['files_uploaded_name'], 'text' => $uploaded_files['files_uploaded_name'] . ($tmp_html_price ? ' - ' . $tmp_html_price : ''));
				$old_uploads = true;
			}
      $tmp_html = '<input type="file" name="id['.$products_id.'][' . TEXT_PREFIX . $ProdOpt_ID . ']">' .         // File field with new upload
      tep_draw_hidden_field('['.$products_id.']'.UPLOAD_PREFIX . $number_of_uploads, $ProdOpt_ID);    // Hidden field with number of this upload (for this product)
			$tmp_html .= $tmp_html_price;
			if	($old_uploads == true) $tmp_html .= '<br>' . tep_draw_pull_down_menu('['.$products_id.']'.TEXT_PREFIX . UPLOAD_PREFIX . $number_of_uploads, $uploaded_array, $cart->contents[$products_id]['attributes_values'][$ProdOpt_ID]);
	    //EOF - Zappo - Option Types v2 - Added dropdown with previously uploaded files

$add_products_options .= $ProdOpt_Name . ' :' . (($old_uploads == true) ? '<br>' . TEXT_PREV_UPLOADS . ': ' : '');
$add_products_options .= $tmp_html;
$add_products_options .= "<br>";

$hide_products_multi = true;

    break;

//BOF - Zappo - Added Image Selector Option
    case OPTIONS_TYPE_IMAGE:
      $Image_Opticount_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id='" . (int)$product_info['products_id'] . "' and options_id ='" . (int)$ProdOpt_ID . "'");
      $Image_Opticount = tep_db_fetch_array($Image_Opticount_query);
      $Image_displayed = 0;
      $products_options_query = tep_db_query("select pov.products_options_values_id, pov.products_options_values_name, pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov where pa.products_id = '" . (int)$product_info['products_id'] . "' and pa.options_id = '" . (int)$ProdOpt_ID . "' and pa.options_values_id = pov.products_options_values_id and pov.language_id = '" . (int)$languages_id . "' order by pa.products_options_sort_order");
      while ($products_options = tep_db_fetch_array($products_options_query)) {
        $pOptValName = $products_options['products_options_values_name'];
        $Image_displayed++;
        if ($products_options['options_values_price'] != '0') {
          $option_price = ' (' . $products_options['price_prefix'] . ' ' . $currencies->display_price($products_options['options_values_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) .') ';
        } else {
          $option_price = '';
        }
        $Image_Dropdown_ID = 'id['.$products_id.'][' . $ProdOpt_ID . ']';
        $Image_Name = (OPTIONS_TYPE_IMAGENAME == 'Name') ? $products_options['products_options_values_name'] : $products_options['products_options_values_id'];
        $Real_Image_Name = OPTIONS_TYPE_IMAGEPREFIX . $Image_Name . ((OPTIONS_TYPE_IMAGELANG == 'Yes') ? '_'.$languages_id : '') . '.jpg';
        if (isset($cart->contents[$products_id]['attributes'][$ProdOpt_ID]) && ($cart->contents[$products_id]['attributes'][$ProdOpt_ID] == $products_options['products_options_values_id'])) {
          $Image_Dropdown[$product_info['products_id']] .= '<option value="' . $products_options['products_options_values_id'] . '" SELECTED>' . $pOptValName . $option_price . '</option>';
          $First_ImageText[$product_info['products_id']] = '<img src="' . OPTIONS_TYPE_IMAGEDIR . $Real_Image_Name . '" alt="'.$pOptValName.'" title="'.$pOptValName.'">';
          $ImageText[$product_info['products_id']] .= '"<img src=\"' . OPTIONS_TYPE_IMAGEDIR . $Real_Image_Name . '\" alt=\"'.$pOptValName.'\" title=\"'.$pOptValName.'\">"';
        } else {
          $Image_Dropdown[$product_info['products_id']] .= '<option value="' . $products_options['products_options_values_id'] . '">' . $pOptValName . $option_price . '</option>';
          $ImageText[$product_info['products_id']] .= '"<img src=\"' . OPTIONS_TYPE_IMAGEDIR . $Real_Image_Name . '\" alt=\"'.$pOptValName.'\" title=\"'.$pOptValName.'\">"';
          if ($First_ImageText[$product_info['products_id']] == '' && $Image_displayed == 1) $First_ImageText[$product_info['products_id']] = '<img src="' . OPTIONS_TYPE_IMAGEDIR . $Real_Image_Name . '" alt="'.$pOptValName.'" title="'.$pOptValName.'">';
        }
        // BOF - Zappo - PreLoad the Images
        if ($Image_displayed == 1) echo '<div id="ImagePreload">';
        echo '<img src="' . OPTIONS_TYPE_IMAGEDIR . $Real_Image_Name . '" alt="'.$pOptValName.'" title="'.$pOptValName.'">';
        if ($Image_displayed != $Image_Opticount['total']) {
          $ImageText[$product_info['products_id']] .= ',';
        } else { // - Zappo - PreLoad the Images - Close Div...
					echo '</div>'; 
				}
				// EOF - Zappo - PreLoad the Images
      }
      $ImageSelector_Name = $ProdOpt_Name . ': <script language="JavaScript" type="text/JavaScript">var ImageText'.$product_info['products_id'] . ' = new Array(' . $ImageText[$product_info['products_id']] . ')</script>';
      $ImageSelector_Dropdown = '<select name="' . $Image_Dropdown_ID . '" onChange="document.getElementById(\'ImageSelect' . $product_info['products_id'] . '\').innerHTML=ImageText'.$product_info['products_id'].'[this.selectedIndex];">' . $Image_Dropdown[$product_info['products_id']] . '</select> ' . $ProdOpt_Comment;

$add_products_options .= $ImageSelector_Name;
$add_products_options .= $ImageSelector_Dropdown;
$add_products_options .= "<br>";

$hide_products_multi = true;

    break;
//EOF - Zappo - Added Image Selector Option

    default:
    $Default = true;  // Set this value to check if current option is Default (drowpdown)
    // - Zappo - Option Types v2 - Default action is (standard) dropdown list. If something is not correctly set, we should always fall back to the standard.
  }

		if ($Default == true) {  // - Zappo - Option Types v2 - Default action is (standard) dropdown list. If something is not correctly set, we should always fall back to the standard.
		$products_options_array = array();
        $products_options_query = tep_db_query("select pov.products_options_values_id, pov.products_options_values_name, pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov where pa.products_id = '" . (int)$products_id . "' and pa.options_id = '" . (int)$ProdOpt_ID . "' and pa.options_values_id = pov.products_options_values_id and pov.language_id = '" . (int)$languages_id . "' order by pa.products_options_sort_order, pov.products_options_values_name asc");
        while ($products_options = tep_db_fetch_array($products_options_query)) {
          $products_options_array[] = array('id' => $products_options['products_options_values_id'], 'text' => $products_options['products_options_values_name']);
          if ($products_options['options_values_price'] != '0') {
            $products_options_array[sizeof($products_options_array)-1]['text'] .= ' (' . $products_options['price_prefix'] . $currencies->display_price($products_options['options_values_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) .') ';
          }
        }

        if (isset($cart->contents[$products_id]['attributes'][$products_options_name['products_options_id']])) {
          $selected_attribute = $cart->contents[$products_id]['attributes'][$products_options_name['products_options_id']];
        } else {
          $selected_attribute = false;
        }

$add_products_options .= $ProdOpt_Name . ':';
$add_products_options .= tep_draw_pull_down_menu('id['.$products_id.'][' . $ProdOpt_ID . ']', $products_options_array, $selected_attribute, ' style="width:100%; height:2em;" ') . ' &nbsp; ' . $ProdOpt_Comment;
$add_products_options .= "<br>";

	  } // End if Default=true
  }

$add_products_options .= tep_draw_hidden_field('number_of_uploads['.$products_id.']', $number_of_uploads);

}
}
// products options eof

// field quantity
if ( ( (CUSTOMER_VIEW_PRODUCT_LOGIN_OR_CREATE_ACCOUNT_VIEW_PRICE == 'true') && (tep_session_is_registered('customer_id')) ) || (CUSTOMER_VIEW_PRODUCT_LOGIN_OR_CREATE_ACCOUNT_VIEW_PRICE != 'true') ) {

if ( ($random_product['view_price'] == 1) || ( ($random_product['products_quantity'] <= 0) && ($random_product['products_qtd_stock_status'] == '0') ) || ( ($random_product['products_quantity'] <= 0) && ($random_product['products_qtd_stock_status'] == '') ) || ( ($random_product['products_quantity'] <= 0) && ($random_product['products_qtd_stock_status'] == '2') ) || ( ($random_product['products_quantity'] <= 0) && ($random_product['products_qtd_stock_status'] == '3') ) ) {
$add_quantity_field = '';
}else{
$add_quantity_field = ENTRY_HEADING_TEXT_PRODUCTS_QTD . "<br>" . tep_draw_input_field('cart_quantity['.$products_id.']', "", ' style="width:10%;" maxlength="5" ');
}
}

if ($hide_products_multi != true) {
$show_button_buy_products_multi = true;
}
// field quantity eof

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
	$check_add_like_query = tep_db_query("select * from " . TABLE_PRODUCTS_LIKE_TRACK . " where products_id = '" . (int)$products_id . "' and customer_id = '" . (int)$customer_id . "' ");
	$str_like = "like";
	if (tep_db_num_rows($check_add_like_query) > 0) {
	$str_like = "unlike";
	}
	$add_likes_box = '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="demo-table">
	<tbody>
	<tr>
	<td align="default" width="100%" valign="top">
	<div id="prod-'.$products_id.'">
	<input type="hidden" id="likes-'.$products_id.'" value="'.$random_product["likes"].'">
	<div class="btn-likes"><input type="button" title="'.ucwords(ENTRY_TEXT_ILIKE).'" class="'.$str_like.'" onClick="addLikes('.$products_id.',\''.$str_like.'\')" /></div>
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
	<div id="prod-'.$products_id.'">
	<input type="hidden" id="likes-'.$products_id.'" value="'.$random_product["likes"].'">
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
										   
										   <td align="center" style="padding-right:10px;">
										   '.($hide_products_multi != true ? $add_quantity_field : '').'
										   </td>
										   
										   <td width="30%" align="center" style="padding-right:10px;">
										   '.$products_image_list.'
										   </td>
										   <td valign="default" width="30%" class="smallText">
										   
										   <span class="pl_expire_date">'.$specials_expiredate.'</span>
										   <br>'.$button_youtube.'<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products_id) . '" itemprop="url">' . $manufacturers_name . $products_model.'<span class="pl_product_name">'.$products_name . '</span></a>'.$unidade_venda.'<br>'.$whats_new_price.'
										   
										   </td>
										   
										   <td align="center" width="20%">
										   '.($hide_products_multi != true ? $add_products_options : '').'
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
	 if ( (tep_get_products_special_price($products_id)) && (DISPLAY_EXPIRE_DATE_SPECIALS == 'true') ) {
	 
	 $specials_expires_date = tep_get_products_special_expire_date($products_id);
	 
		  if ($products_quantity > 0) {
			  if ( (tep_not_null(tep_get_products_special_price($products_id))) && (tep_not_null($specials_expires_date)) && ($specials_expires_date != '0000-00-00 00:00:00')) {
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

// button free shipping
	  if ($products_free_shipping == '1') {
	  	if ( (DEFAULT_CURRENCY == $currency) && (FREE_SHIPPING_TO_ALL_COUNTRIES == "national") ) {

			if (FREE_SHIPPING_TO_ALL_COUNTRIES_ESTADOS != '') {
			$text_free_shipping_estados = ' ' . str_replace(",", ", ", FREE_SHIPPING_TO_ALL_COUNTRIES_ESTADOS);
			}
			$button_free_shipping = '<br><br><center>' . tep_image_button('button_free_shipping.gif', FREE_SHIPPING_FOR_THIS_PRODUCT . $text_free_shipping_estados) . '</center>';
			if (FREE_SHIPPING_TO_ALL_COUNTRIES_ESTADOS != '') {
			$button_free_shipping .= '<small><center>' . str_replace(",", ", ", FREE_SHIPPING_TO_ALL_COUNTRIES_ESTADOS) . '</center></small>';
			}

		}elseif (FREE_SHIPPING_TO_ALL_COUNTRIES == "both") {
		$button_free_shipping = '<br><br><center>' . tep_image_button('button_free_shipping.gif', FREE_SHIPPING_FOR_THIS_PRODUCT) . '</center>';
		}elseif ( (DEFAULT_CURRENCY == $currency) && (FREE_SHIPPING_TO_ALL_COUNTRIES == "international") ) {
		$button_free_shipping = '<br><br><center>' . tep_image_button('button_free_shipping.gif', FREE_SHIPPING_FOR_THIS_PRODUCT) . '</center>';
		}
	  }else{
	  $button_free_shipping = '';
	  }
// button free shipping eof

// new or update button
$days_to_add = DAY_BUTTON_NEW_UPDATED;
$current_date = date("Y-m-d");

if ( (VIEW_BUTTON_NEW == 'true') ||(VIEW_BUTTON_NEW == 'True') ) {
	$products_date_added = explode(" ", $products_date_added);	
	$date_added = fnc_date_calc($products_date_added[0],$days_to_add);		
	if ($date_added >= $current_date) {
	$button_new = '<br><img src="'.DIR_WS_LANGUAGES . $language . '/images/buttons/small_new.gif" border="0">';
	}else{
	$button_new = '';
	}
}

if ( (VIEW_BUTTON_UPDATED == 'true') ||(VIEW_BUTTON_UPDATED == 'True') ) {
	if (!empty($products_last_modified)) {
	$products_last_modified = explode(" ", $products_last_modified);
	$last_modified = fnc_date_calc($products_last_modified[0],$days_to_add);
		if ($last_modified >= $current_date) {
		$button_update = '<br><img src="'.DIR_WS_LANGUAGES . $language . '/images/buttons/small_update.gif" border="0">';
		}else{
		$button_update = '';
		}		
	}
}

// new or update button

// price and parcel
      $random_product['specials_new_products_price'] = tep_get_products_special_price($products_id);

if ( ($CUSTOMER_CREATE_ACCOUNT_VIEW_PRICE == 'true') || ($view_price == 1) || ($registry_mode_id != 0) || ( (CUSTOMER_VIEW_PRODUCT_LOGIN_OR_CREATE_ACCOUNT_VIEW_PRICE == 'true') && (!tep_session_is_registered('customer_id')) ) || ( ($products_quantity < 1) &&  ($random_product['products_qtd_stock_status'] == '0') ) || ( ($products_quantity < 1) &&  ($random_product['products_qtd_stock_status'] == '') ) || ( ($products_quantity < 1) &&  ($random_product['products_qtd_stock_status'] == '2') ) || ( ($products_quantity < 1) &&  ($random_product['products_qtd_stock_status'] == '3') ) ) {

$whats_new_price = '';

}else
if ( ($products_quantity > 0) || ( ($products_quantity <= 0) && ($random_product['products_qtd_stock_status'] == '1') ) ) {

    if (tep_not_null($random_product['specials_new_products_price'])) {
      
	  if (($parcel_window == 1) && ($language == 'portugues') && ($currency == 'BRL')) {

		$newprice = $random_product['specials_new_products_price'];

		if ($discount > 0) {
			if (CUSTOMER_GROUP_DISCOUNT_CHOOSE_PRODUCT_PRICE == "price") {
			$newprice = $products_price;
			}
		}

		if ($discount > 0) $newprice = $newprice - ($newprice/100)*$discount;

		if ($discount > 0) {
		$price = $random_product['specials_new_products_price'];
		}else{
		$price = $products_price;
		}

		if ($discount > 0) {
			if (CUSTOMER_GROUP_DISCOUNT_CHOOSE_PRODUCT_PRICE == "price") {
			$price = $products_price;
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

		if (TYPE_PRODUCT_PRICE_VIEW == 'COM-AVISTAPARCELA') {
		
		$whats_new_price = '<br>'.TEXT_PRICE_PRODUCT_FROM.'<s>' . $currencies->display_price($price, tep_get_tax_rate($products_tax_class_id)) . '</s>';
		
		$whats_new_price .= '<br><span class="pl_product_special_price"><b>' . TEXT_PRICE_PRODUCT_TO . $currencies->display_price($newprice, tep_get_tax_rate($products_tax_class_id)) . '</b></span>';
		
			if (MODULE_PAYMENT_DISC_STATUS == 'true') {
	
			$price1 = $newprice*MODULE_PAYMENT_DISC_PERCENTAGE;
			$price_desc = $price1/100;
			$new_products_price_ok = $newprice-$price_desc;
			
			$whats_new_price .= '<br>'.TEXT_PRICE_PRODUCT_OR.'<span class="pl_product_special_price"><b>' . $currencies->display_price($new_products_price_ok, tep_get_tax_rate($products_tax_class_id)) . '</b></span>' . ' ' . MODULE_PAYMENT_DISC_PERCENTAGE . '% ' . TEXT_OF_DISCOUNT . TEXT_PRICE_PRODUCT_AVISTA;
			
			}elseif (MODULE_PAYMENT_DISC1_STATUS == 'true') {
			
			$price1 = $newprice*MODULE_PAYMENT_DISC1_PERCENTAGE;
			$price_desc = $price1/100;
			$new_products_price_ok = $newprice-$price_desc;
			
			$whats_new_price .= '<br>'.TEXT_PRICE_PRODUCT_OR.'<span class="pl_product_special_price"><b>' . $currencies->display_price($new_products_price_ok, tep_get_tax_rate($products_tax_class_id)) . '</b></span>' . ' ' . MODULE_PAYMENT_DISC1_PERCENTAGE . '% ' . TEXT_OF_DISCOUNT . TEXT_PRICE_PRODUCT_AVISTA;
	
			}
		
			if ( (NUMBER_PLOTS_VISA > NUMBER_PLOTS_JUROS) && (VIEW_PLOTS_JUROS == 'true') ) {
			
			$whats_new_price .= '<br>'.TEXT_PRICE_PRODUCT_OR.'<span class="pl_product_plots_price"><b>'.NUMBER_PLOTS_VISA.'x ' . $price_divide . '</b></span>' . ' ' . TEXT_COMJUROS . ' ' . TAXA_PLOTS_JUROS . '% a.m.';
			
			}else{
			
			$whats_new_price .= '<br>'.TEXT_PRICE_PRODUCT_OR.'<span class="pl_product_plots_price"><b>'.NUMBER_PLOTS_VISA.'x ' . $price_divide . '</b></span>' . ' ' . TEXT_SEMJUROS;
			
			}
		
		$whats_new_price .= '<br>';
		
		}else{
		
		$whats_new_price = '<br><s>' . $currencies->display_price($price, tep_get_tax_rate($products_tax_class_id)) . '</s><br>';
		$whats_new_price .= '<strong><span class="pl_product_special_price">' . $currencies->display_price($newprice, tep_get_tax_rate($products_tax_class_id)) . '<br>'.NUMBER_PLOTS_VISA.'x ' . $price_divide . '</span></strong>';
		
		}
	  
	  } else {

		$newprice = $random_product['specials_new_products_price'];

		if ($discount > 0) {
			if (CUSTOMER_GROUP_DISCOUNT_CHOOSE_PRODUCT_PRICE == "price") {
			$newprice = $products_price;
			}
		}

		if ($discount > 0) $newprice = $newprice - ($newprice/100)*$discount;

		if ($discount > 0) {
		$newprice = $random_product['specials_new_products_price'];
		}else{
		$price = $products_price;
		}

		if ($discount > 0) {
			if (CUSTOMER_GROUP_DISCOUNT_CHOOSE_PRODUCT_PRICE == "price") {
			$price = $products_price;
			}
		}
		//if ($discount > 0) $price = $price - ($price/100)*$discount;
	  
	  $whats_new_price = '<br><s>' . $currencies->display_price($price, tep_get_tax_rate($products_tax_class_id)) . '</s><br>';
      $whats_new_price .= '<strong><span class="pl_product_special_price">' . $currencies->display_price($newprice, tep_get_tax_rate($products_tax_class_id)) . '</span></strong>';
	  
	  }
	  
    } else {

	  if (($parcel_window == 1) && ($language == 'portugues') && ($currency == 'BRL')) {

		$prod_price = $products_price;
		if ($discount > 0) $prod_price = $prod_price - ($prod_price/100)*$discount;
	  
			if (VIEW_PLOTS_JUROS == 'true') {
			
				if ( (NUMBER_PLOTS_VISA > NUMBER_PLOTS_JUROS) && (VIEW_PLOTS_JUROS == 'true') ) {
				$priceplots = $prod_price * pow((1 + TAXA_PLOTS_JUROS/100),NUMBER_PLOTS_VISA);
				$prod_price = $prod_price;
				}else{
				$prod_price = $prod_price;
				}
			
			}else{
			
				$prod_price = $prod_price;
			
			}

		if (VIEW_PLOTS_JUROS == 'true') {
		
			if ( (NUMBER_PLOTS_VISA > NUMBER_PLOTS_JUROS) && (VIEW_PLOTS_JUROS == 'true') ) {
			
			$price_divide = $currencies->format($priceplots / NUMBER_PLOTS_VISA);
			
			}else{
			
			$price_divide = $currencies->format($prod_price / NUMBER_PLOTS_VISA);
			
			}
		
		}else{
		
		$price_divide = $currencies->format($prod_price / NUMBER_PLOTS_VISA);
		
		}
	  
	  	$orig_price = $products_price;

		if (TYPE_PRODUCT_PRICE_VIEW == 'COM-AVISTAPARCELA') {
				
		$whats_new_price = '';

		// fake special price
		if (ENABLE_FAKE_SPECIAL_PRICE_ALL_PRODUCTS == 'true') {
		if (!tep_get_products_special_price($products_id)) {
		$percentage_add = PERCENTAGE_FAKE_SPECIAL_PRICE_ALL_PRODUCTS;
		$price_to_add = round( ($percentage_add/100)*$products_price, 0 );
		$new_price_add = $products_price + $price_to_add;
		$whats_new_price .= '<br>'.TEXT_PRICE_PRODUCT_FROM."<s>" . $currencies->display_price($new_price_add, tep_get_tax_rate($products_tax_class_id)) . "</s>";
		}
		}
		// fake special price

		if ($discount > 0) {
		$whats_new_price .= '<br>'.TEXT_PRICE_PRODUCT_FROM.'<s>' . $currencies->display_price($orig_price, tep_get_tax_rate($products_tax_class_id)) . '</s>';
		}
		
		$whats_new_price .= '<br><span class="pl_product_price"><b>' . TEXT_PRICE_PRODUCT_TO . $currencies->display_price($prod_price, tep_get_tax_rate($products_tax_class_id)) . '</b></span>';
		
			if (MODULE_PAYMENT_DISC_STATUS == 'true') {
	
			$price1 = $prod_price*MODULE_PAYMENT_DISC_PERCENTAGE;
			$price_desc = $price1/100;
			$new_products_price_ok = $prod_price-$price_desc;
			
			$whats_new_price .= '<br>'.TEXT_PRICE_PRODUCT_OR.'<span class="pl_product_special_price"><b>' . $currencies->display_price($new_products_price_ok, tep_get_tax_rate($products_tax_class_id)) . '</b></span>' . ' ' . MODULE_PAYMENT_DISC_PERCENTAGE . '% ' . TEXT_OF_DISCOUNT . TEXT_PRICE_PRODUCT_AVISTA;
			
			}elseif (MODULE_PAYMENT_DISC1_STATUS == 'true') {
			
			$price1 = $prod_price*MODULE_PAYMENT_DISC1_PERCENTAGE;
			$price_desc = $price1/100;
			$new_products_price_ok = $prod_price-$price_desc;
			
			$whats_new_price .= '<br>'.TEXT_PRICE_PRODUCT_OR.'<span class="pl_product_special_price"><b>' . $currencies->display_price($new_products_price_ok, tep_get_tax_rate($products_tax_class_id)) . '</b></span>' . ' ' . MODULE_PAYMENT_DISC1_PERCENTAGE . '% ' . TEXT_OF_DISCOUNT . TEXT_PRICE_PRODUCT_AVISTA;
	
			}
		
			if ( (NUMBER_PLOTS_VISA > NUMBER_PLOTS_JUROS) && (VIEW_PLOTS_JUROS == 'true') ) {
			
			$whats_new_price .= '<br>'.TEXT_PRICE_PRODUCT_OR.'<span class="pl_product_plots_price"><b>'.NUMBER_PLOTS_VISA.'x ' . $price_divide . '</b></span>' . ' ' . TEXT_COMJUROS . ' ' . TAXA_PLOTS_JUROS . '% a.m.';
			
			}else{
			
			$whats_new_price .= '<br>'.TEXT_PRICE_PRODUCT_OR.'<span class="pl_product_plots_price"><b>'.NUMBER_PLOTS_VISA.'x ' . $price_divide . '</b></span>' . ' ' . TEXT_SEMJUROS;
			
			}
		
		$whats_new_price .= '<br>';
		
		}else{
		
      	$whats_new_price = '';

		// fake special price
		if (ENABLE_FAKE_SPECIAL_PRICE_ALL_PRODUCTS == 'true') {
		if (!tep_get_products_special_price($products_id)) {
		$percentage_add = PERCENTAGE_FAKE_SPECIAL_PRICE_ALL_PRODUCTS;
		$price_to_add = round( ($percentage_add/100)*$products_price, 0 );
		$new_price_add = $products_price + $price_to_add;
		$whats_new_price .= '<br>'.TEXT_PRICE_PRODUCT_FROM."<s>" . $currencies->display_price($new_price_add, tep_get_tax_rate($products_tax_class_id)) . "</s>";
		}
		}
		// fake special price

		if ($discount > 0) {
		$whats_new_price .= '<br><s>'.$currencies->display_price($orig_price, tep_get_tax_rate($products_tax_class_id)) . '</s>';
		}
		
		$whats_new_price .= '<br><strong><span class="pl_product_price">'.$currencies->display_price($prod_price, tep_get_tax_rate($products_tax_class_id)) . '</span><br><span class="pl_product_plots_price"> '.NUMBER_PLOTS_VISA.'x ' . $price_divide . '</span></strong>';
		
		}

	  } else {

		$orig_price = $products_price;
		
		$price = $products_price;
		if ($discount > 0) $price = $price - ($price/100)*$discount;
	  
      	$whats_new_price = '';

		// fake special price
		if (ENABLE_FAKE_SPECIAL_PRICE_ALL_PRODUCTS == 'true') {
		if (!tep_get_products_special_price($products_id)) {
		$percentage_add = PERCENTAGE_FAKE_SPECIAL_PRICE_ALL_PRODUCTS;
		$price_to_add = round( ($percentage_add/100)*$products_price, 0 );
		$new_price_add = $products_price + $price_to_add;
		$whats_new_price .= '<br>'.TEXT_PRICE_PRODUCT_FROM."<s>" . $currencies->display_price($new_price_add, tep_get_tax_rate($products_tax_class_id)) . "</s>";
		}
		}
		// fake special price

		if ($discount > 0) {
		$whats_new_price .= '<br><s>'.$currencies->display_price($orig_price, tep_get_tax_rate($products_tax_class_id)) . '</s>';
		}
		
		$whats_new_price .= '<br><strong><span class="pl_product_price">'.$currencies->display_price($price, tep_get_tax_rate($products_tax_class_id)) . '</span></strong>'; 
	  
	  }

    }


}
// price and parcel eof

// buttons
if (PRODUCT_LIST_HIDE_ALL_BUTTONS == 'false') {

	if (PRODUCT_LIST_DETAILS == 'true') {
	$button_details = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products_id) . '">' . tep_image_button('small_details.gif', '') . '</a>';
	}
	
	if (PRODUCT_LIST_QUICKVIEW == 'true') {
	$button_quickview = '<a href="' . tep_href_link(FILENAME_PRODUCT_QUICKVIEW, 'products_id=' . $products_id) . '" class="fancybox fancybox.iframe">' . tep_image_button('button_quickview.gif', '') . '</a>';
	}
	
	if (PRODUCT_LIST_BUY_NOW_FAST == 'true') {
	if (tep_has_product_attributes($products_id)) {					
		$button_buy_now_fast_link = '<a href="' . tep_href_link(FILENAME_PRODUCT_QUICKVIEW, 'products_id=' . $products_id) . '" class="fancybox fancybox.iframe">' . tep_image_button('button_buy_now_fast.gif', '') . '</a>';
	}else{
		$button_buy_now_fast_link = '<a href="' . tep_href_link_fast(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $products_id, 'NONSSL') . '">' . tep_image_button('button_buy_now_fast.gif', '') . '</a>';
	}
	}
	
	if (PRODUCT_LIST_BUY_NOW == 'true') {
	$button_buy_now = '<a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $products_id, 'NONSSL') . '">' . tep_image_button('button_buy_now.gif', '') . '</a>';
	}
	
	if (PRODUCT_LIST_CONTACT == 'true') {
	$button_contact = '<a href="'.tep_href_link(FILENAME_PRODUCT_CONTACT, 'products_id=' . $products_id).'" class="fancybox fancybox.iframe">' . tep_image_button('button_contact.gif', $products_name) . '</a>';
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
	
	} elseif ( ($view_price == 1) || ($products_quantity <= 0) ) {
	
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
	
	}elseif ( ($view_price == 1) || ( ($products_quantity <= 0) && ($products_qtd_stock_status == '0') ) || ( ($products_quantity <= 0) && ($products_qtd_stock_status == '') ) || ( ($products_quantity <= 0) && ($products_qtd_stock_status == '2') ) || ( ($products_quantity <= 0) && ($products_qtd_stock_status == '3') ) ) {
	
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

	if ($products_model) {
	$products_model =  '<span class="pl_product_name">' . $products_model . '</span><br>';
	}

}
// products model eof

// products image
	  if (ENABLE_SLIDESHOW_PRODUCTS_IMAGES == 'true') {
	  	$add_style_slideshow_products_images = ' style="position: relative;" ';
		$add_style_slideshow_products_images_img = ' class="fadelistings" ';
	  }

	  if ($random_product['products_image_sm_1'] && ENABLE_SLIDESHOW_PRODUCTS_IMAGES == 'true' && file_exists(DIR_WS_IMAGES . $random_product['products_image_sm_1'])) {
		$products_image_list = '<center><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products_id) . '" '.$add_style_slideshow_products_images.' itemprop="url">' . tep_image(DIR_WS_IMAGES . $random_product['products_image'], $products_name, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, $add_style_slideshow_products_images_img) . tep_image(DIR_WS_IMAGES . $random_product['products_image_sm_1'], $products_name, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a></center>';
	  }else{
		$products_image_list = '<center><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products_id) . '"  itemprop="url">' . tep_image(DIR_WS_IMAGES . $random_product['products_image'], $products_name, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a></center>';
	  }
// products image eof

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
	$check_add_like_query = tep_db_query("select * from " . TABLE_PRODUCTS_LIKE_TRACK . " where products_id = '" . (int)$products_id . "' and customer_id = '" . (int)$customer_id . "' ");
	$str_like = "like";
	if (tep_db_num_rows($check_add_like_query) > 0) {
	$str_like = "unlike";
	}
	$add_likes_box = '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="demo-table">
	<tbody>
	<tr>
	<td align="default" width="100%" valign="top">
	<div id="prod-'.$products_id.'">
	<input type="hidden" id="likes-'.$products_id.'" value="'.$random_product["likes"].'">
	<div class="btn-likes"><input type="button" title="'.ucwords(ENTRY_TEXT_ILIKE).'" class="'.$str_like.'" onClick="addLikes('.$products_id.',\''.$str_like.'\')" /></div>
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
	<div id="prod-'.$products_id.'">
	<input type="hidden" id="likes-'.$products_id.'" value="'.$random_product["likes"].'">
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

if (PRODUCT_LIST_ONMOUSEOVER_BUTTONS == "true") {
	$add_button_buynow = '<div id="div_name'.$products_id.'" style="display:none;"><br>'.$button_buynow.'</div>';
}else{
	$add_button_buynow = '<br>'.$button_buynow;
}

	  $info_box_contents[$row][$col] = array('align' => 'left',
                                          'params' => 'class="smallText" width="25%" valign="top"',
                                          'text' => '<div class="pl_style_border_div" onmouseover="document.getElementById(\'div_name'.$products_id.'\').style.display=\'\';" 
onmouseout="document.getElementById(\'div_name'.$products_id.'\').style.display=\'none\';">'.$products_image_list.$add_likes_box.''.$button_free_shipping.'<br><br>'.$button_youtube.'<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products_id) . '" itemprop="url">' . $manufacturers_name . $products_model.'<span class="pl_product_name">' . $products_name . '</span></a>'.$unidade_venda.'<br>'.$whats_new_price.$button_new.$button_update.'<span class="pl_expire_date">'.$specials_expiredate.'</span>'.$add_button_buynow.'</div>');

}
//// end row and gallery ////
?>