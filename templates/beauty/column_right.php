<?php
if (POSITION_BOX_ATTRIBUTES_FILTER == 'right') {
include(DIR_WS_BOXES . 'attributes_filter_box.php');
}

  if (USE_CATEGORIES_CHOOSE == 'Horizontal') {
  require(DIR_WS_BOXES . 'info_pages.php');
  }

/*if (substr(basename($PHP_SELF), 0, 8) != 'checkout') {
if (substr(basename($PHP_SELF), 0, 13) != 'shopping_cart') {
    echo '<tr><td style="padding: 0"><script language="JavaScript" src="includes/ajax_sc.js"></script>';
	echo '<div id="divShoppingCard"><table border="0" width="100%" cellspacing="0" cellpadding="2">';
	require(DIR_WS_BOXES . 'shopping_cart.php');
	echo '</table></div></td></tr>';
}
}*/

  
  require(DIR_WS_BOXES . 'login.php');

  if ($wishList->count_wishlist() != '0') {
  require(DIR_WS_BOXES . 'wishlist.php');
  }

if (substr(basename($PHP_SELF), 0, 8) != 'checkout') {
if (substr(basename($PHP_SELF), 0, 5) != 'login') {
if (substr(basename($PHP_SELF), 0, 13) != 'shopping_cart') {
if (substr(basename($PHP_SELF), 0, 14) != 'create_account') {
if (substr(basename($PHP_SELF), 0, 6) != 'logoff') {
if (substr(basename($PHP_SELF), 0, 7) != 'account') {
if (substr(basename($PHP_SELF), 0, 12) != 'address_book') {
if (substr(basename($PHP_SELF), 0, 10) != 'newsletter') {
if (substr(basename($PHP_SELF), 0, 10) != 'affiliate_') {

  if (isset($HTTP_GET_VARS['products_id'])) {
//    if (basename($PHP_SELF) != FILENAME_TELL_A_FRIEND) include(DIR_WS_BOXES . 'tell_a_friend.php');
  } else {
    include(DIR_WS_BOXES . 'specials.php');
  }

  //if (tep_session_is_registered('customer_id')) include(DIR_WS_BOXES . 'order_history.php');

// BOF: WebMakers.com Added: Banner Manager - Column Banner
    require(DIR_WS_BOXES . 'column_banner.php');
// EOF: WebMakers.com Added: Banner Manager - Column Banner

  if (isset($HTTP_GET_VARS['products_id'])) {
      $check_query = tep_db_query("select count(*) as count from " . TABLE_CUSTOMERS_INFO . " where customers_info_id = '" . (int)$customer_id . "' and global_product_notifications = '1'");
      $check = tep_db_fetch_array($check_query);
      if ($check['count'] > 0) {

        include(DIR_WS_BOXES . 'best_sellers.php');
		
		require(DIR_WS_BOXES . 'manufacturers_banners.php');

      }
  } else {

    include(DIR_WS_BOXES . 'best_sellers.php');
	
	require(DIR_WS_BOXES . 'manufacturers_banners.php');

  }


  // Article Manager

  if (AUTHOR_BOX_DISPLAY == 'true'){
    require(DIR_WS_BOXES . 'authors.php');
  }
  if (ARTICLE_BOX_DISPLAY == 'true'){
    require(DIR_WS_BOXES . 'articles.php');
  }

}
}
}
}
}
}
}
}
}

?>
