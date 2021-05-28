<!-- banner header -->
<?php 
	include(DIR_WS_BOXES . 'column_banner_top.php');
?>
<!-- banner header eof -->
<table width="<?php echo WIDTH_STORE; ?>" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
<?php
// layout
if ($languages_id != ''){
	//$add_lng_id_qry = " and language_id = '".$languages_id."' ";
	$add_lng_id_qry = " and language_id IN('".$languages_id."','ALL') ";
}
if ($layout_template_folder != '') {
	$add_temp_fld_qry = " and template_folder = '".$layout_template_folder."' ";
}
if ($_GET['cPath']) {
		
	if (strstr($_GET['cPath'], '_')) {
	$get_cPath = explode("_", $_GET['cPath']);
	$cPath_ok = $get_cPath[0] . ',' . $get_cPath[1];
	}else{
	$cPath_ok = $_GET['cPath'];
	}
	
	$add_cPath_qry = " and cPath IN(0,".tep_db_input($cPath_ok).") ";

}

if($page_type && $_GET['cPath'] != "0") {
	$add_page_type_qry = " and page IN(0,1) ";
}elseif($page_type) {
	$add_page_type_qry = " and page IN(0,'".tep_db_input($page_type)."') ";
}else{
	$add_page_type_qry = " and page = '0' ";
}
	
if ($_GET['layout_id'] != '') {

$layout = tep_random_select("select background_menu_header, title, language_id, logo, background_header, background_header_right, background_footer, status, cPath, page, date_scheduled, expires_date, background_site, background_site_content from " . TABLE_LAYOUT . " WHERE id = '".$_GET['layout_id']."' ".$add_lng_id_qry.$add_temp_fld_qry.$add_cPath_qry.$add_page_type_qry);

}else{

$layout = tep_random_select("select background_menu_header, title, language_id, logo, background_header, background_header_right, background_footer, status, cPath, page, date_scheduled, expires_date, background_site, background_site_content from " . TABLE_LAYOUT . " WHERE status = '1' ".$add_lng_id_qry.$add_temp_fld_qry.$add_cPath_qry.$add_page_type_qry);

}
	
$logo = tep_image(DIR_WS_IMAGES . $layout["logo"], '');
if ($layout["background_header"] != ""){ $background_header = DIR_WS_IMAGES . $layout["background_header"]; }
if ($layout["background_header_right"] != ""){ $background_header_right = DIR_WS_IMAGES . $layout["background_header_right"]; }
if ($layout["background_footer"] != ""){ $background_footer = DIR_WS_IMAGES . $layout["background_footer"]; }
// layout eof
?>
<?php
if (STICK_HEADER == "true" && substr(basename($PHP_SELF), 0, 8) != 'checkout'){
?>
<div class="header">
<?php
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" cellpadding="0" cellspacing="0" <?php if ($background_header != ""){ echo ' background="' . $background_header. '"'; }elseif(HEADER_BACKGROUND != ""){ echo ' bgcolor="'.HEADER_BACKGROUND.'"'; } ?>>
  <tr>
    <td align="center"><table border="0" cellspacing="0" cellpadding="0" class="background_content_header">
      <tr>
        <td><table width="100%" border="0" cellpadding="0" cellspacing="5">
          <tr>
            <?php if (tep_session_is_registered('customer_id')) { ?>
            <td align="center" class="line_header_menu"><?php echo '<a href="'.tep_href_link(FILENAME_LOGOFF, '', 'SSL').'"><span class="line_header_menu">'.HEADER_TITLE_LOGOFF.'</span></a>'; ?></td>
            <td align="center" class="line_header_menu">&nbsp;|&nbsp;</td>
            <?php }else{ ?>
            <td align="center" class="line_header_menu"><?php echo '<a href="' . tep_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL') . '"><span class="line_header_menu">'.TEXT_SIGN_IN.'</span></a>'; ?></td>
            <td align="center" class="line_header_menu">&nbsp;|&nbsp;</td>
            <?php } ?>
            <td align="center" class="line_header_menu"><?php echo '<a href="'.tep_href_link(FILENAME_ACCOUNT, '', 'SSL').'"><span class="line_header_menu">'.HEADER_TITLE_MY_ACCOUNT.'</span></a>'; ?></td>
            <td align="center" class="line_header_menu">&nbsp;|&nbsp;</td>
            <td align="center" class="line_header_menu"><?php
				  include(DIR_WS_BOXES . 'extra_info_pages_header.php');
				  ?></td>
            <?php
if (PHONE_CALL != '') {
?>
            <td align="center" class="line_header_menu"><?php 
				  echo tep_image(DIR_WS_IMAGES . 'icon_phone_header.png', '', '', '', ' align="middle" ');
				  ?></td>
            <td align="center" class="line_header_menu"><?php 
				  echo ' <b>' . PHONE_CALL . '</b>'; 
				  ?></td>
            <?php
}
?>
          </tr>
        </table></td>
      </tr>
    </table></td>
    <td align="right"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" border="0" cellpadding="0" cellspacing="5">
          <tr>
              <?php
			  if (SHOW_HIDE_BOX_LANGUAGES == 'show') {
			  ?>
              <td align="right"><?php
                  //if (substr(basename($PHP_SELF), 0, 8) != 'checkout') {
                  include(DIR_WS_BOXES . 'languages.php');
                  //}
                  ?>
              </td>
              <?php
			  }
			  if (SHOW_HIDE_BOX_CURRENCY == 'show') {
			  ?>
              <td align="right"><?php
                //if (substr(basename($PHP_SELF), 0, 8) != 'checkout') {
                include(DIR_WS_BOXES . 'currencies.php');
                //}
                ?>
              </td>
              <?php
			  }
			  ?>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="background_header">
  <tr>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="right" class="background_header_right">&nbsp;</td>
  </tr>
  <tr>
    <td width="40%" align="center" valign="middle"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="350" border="0" cellpadding="0" cellspacing="5">
          <?php
			  require(DIR_WS_BOXES . 'search.php');
			  ?>
        </table></td>
      </tr>
    </table></td>
    <td width="20%" align="center" valign="middle">
	<?php
    if ($layout["logo"]) {
	echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . $logo . '</a>';
	}else{
	echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image(DIR_WS_IMAGES . STORE_LOGO, STORE_NAME) . '</a>';
	}
	?>    </td>
	<td width="0%" align="right" <?php if ($background_header_right != ""){ echo ' style="background-image:url('.$background_header_right.'); background-position:right; background-repeat:no-repeat;"'; } ?>>
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center">
              
<?php
if (substr(basename($PHP_SELF), 0, 8) != 'checkout') {
?>
              <table border="0" cellspacing="0" cellpadding="0" class="background_content_header_box_shopping_cart">
                  <tr>
                    <td>
                    
<script type="text/javascript" src="scripts/dropdowncontent.js"></script>
                    
                    <table width="100%" border="0" cellpadding="0" cellspacing="5">
                        <tr>
                          <td align="center" class="line_header_box_shopping_cart"><?php echo '<a href="'.tep_href_link(FILENAME_SHOPPING_CART).'">' . tep_image(DIR_WS_IMAGES . 'icon_carrinhocompras.png', '', '', '', ' align="middle" ') . '</a>'; ?> </td>
                          <td align="center"><?php 
				  if ($cart->count_contents() > 0) {
				  echo '<a href="'.tep_href_link(FILENAME_SHOPPING_CART).'" id="searchlink" rel="shopping_cart"><span class="line_header_box_shopping_cart"><font size="4">'.HEADER_TITLE_CART_CONTENTS . '</font> (' . $cart->count_contents() . ')' .'</span></a>'; 
				  }else{
				  echo '<a href="'.tep_href_link(FILENAME_SHOPPING_CART).'" id="searchlink" rel="shopping_cart"><span class="line_header_box_shopping_cart"><font size="4">'.HEADER_TITLE_CART_CONTENTS.'</font></span></a>'; 
				  }
				  ?>

<?php
if (substr(basename($PHP_SELF), 0, 8) != 'checkout') {
if (substr(basename($PHP_SELF), 0, 13) != 'shopping_cart') {
?>

                  <DIV id="shopping_cart" style="position:fixed; visibility: hidden; border: 1px solid <?php echo TABLE_BOX_BORDER_COLOR; ?>; background-color: #FFFFFF ; width: 300px; padding: 8px; z-index: 1050;">
                  
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php
    echo '<tr><td style="padding: 0"><script language="JavaScript" src="includes/ajax_sc.js"></script>';
	echo '<div id="divShoppingCard"><table border="0" width="100%" cellspacing="0" cellpadding="2">';
	require(DIR_WS_BOXES . 'shopping_cart.php');
	echo '</table></div></td></tr>';
?>
                  </table>
                  <br>
                  <div align="right"><a href="javascript:dropdowncontent.hidediv('shopping_cart')"><?php echo tep_image(DIR_WS_IMAGES . 'icon_close_24x24.png', '', '', '', ' align="middle" '); ?></a></div>
                  </DIV>

<?php
}
}
?>
<script type="text/javascript">
//Call dropdowncontent.init("anchorID", "positionString", glideduration, "revealBehavior") at the end of the page:

//dropdowncontent.init("searchlink", "right-bottom", 500, "mouseover")
dropdowncontent.init("searchlink", "left-bottom", 500, "mouseover")
//dropdowncontent.init("contentlink", "left-top", 300, "click")

</script>

                          </td>
<?php
if (STATUS_FINALIZAR_ACEITAR_CONTRATO == 'false') {
?>
                      <td align="center" class="line_header_menu">&nbsp;|&nbsp;</td>
                      <td align="center" class="line_header_menu"><?php echo '<a href="'.tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL').'"><span class="line_header_menu">'.HEADER_TITLE_CHECKOUT.'</span></a>'; ?></td>
<?php
}
?>
                          <td align="center" class="line_header_menu">&nbsp;&nbsp;</td>
                        </tr>
                    </table></td>
                  </tr>
              </table>
<?php
}
?>              
              
              </td>
            </tr>
        </table></td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="right" class="background_header_right">&nbsp;</td>
  </tr>
</table>
<?php
if (STICK_HEADER == "true" && substr(basename($PHP_SELF), 0, 8) != 'checkout'){
?>
</div>
<script type="text/javascript">//<![CDATA[

$(window).on('load scroll resize orientationchange', function () {
    if ($(window).scrollTop() < <?php (STICK_HEADER_HEIGHT != "" ? STICK_HEADER_HEIGHT : '100') ?>) { 
//        $('.header').css("background-color", "transparent");
    }
    else{
     
		<?php if (STICK_HEADER_BACKGROUND_COLOR != "") { ?>
        $('.header').css("background-color", "<?php echo STICK_HEADER_BACKGROUND_COLOR; ?>");
		<?php }else{ ?>
        $('.header').css("background-color", "<?php echo BACKGROUND_COLOR; ?>");
		<?php } ?>
        $('.header').css("-webkit-box-shadow", "0 1px 5px rgba(0, 0, 0, 0.25)");
        $('.header').css("-moz-box-shadow", "0 1px 5px rgba(0, 0, 0, 0.25)");
        $('.header').css("box-shadow", "0 1px 5px rgba(0, 0, 0, 0.25)");
    }
  });

//]]></script>
<?php
}
?>

<?php
if (substr(basename($PHP_SELF), 0, 8) != 'checkout') {
if (substr(basename($PHP_SELF), 0, 5) != 'login') {
if (substr(basename($PHP_SELF), 0, 14) != 'create_account') {
if (DISPLAY_CATEGORIES_PNFSBS == 'top') {
?>
<table border="0" width="100%" cellspacing="0" cellpadding="0" class="background_menu_header">
  <tr>
    <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="line_header_main_menu" align="center" valign="middle"><a href="<?php echo tep_href_link(FILENAME_SPECIALS); ?>"><span class="line_header_main_menu"><?php echo BOX_HEADING_SPECIALS; ?></span></a> </td>
        <td class="line_header_main_menu" align="center" valign="middle">|</td>
        <td class="line_header_main_menu" align="center" valign="middle"><a href="<?php echo tep_href_link(FILENAME_BEST_SELLERS); ?>"><span class="line_header_main_menu"><?php echo BOX_HEADING_BESTSELLERS; ?></span></a> </td>
        <?php
		$expected_query = tep_db_query("select p.products_id, pd.products_name, p.products_image, products_date_available as date_expected from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where to_days(products_date_available) >= to_days(now()) and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' order by " . EXPECTED_PRODUCTS_FIELD . " " . EXPECTED_PRODUCTS_SORT);
			if (tep_db_num_rows($expected_query) > 0) {
		?>
        <td class="line_header_main_menu" align="center" valign="middle">|</td>
        <td class="line_header_main_menu" align="center" valign="middle"><a href="<?php echo tep_href_link(FILENAME_PRODUCTS_UPCOMING); ?>"><span class="line_header_main_menu"><?php echo BOX_HEADING_PRODUCTS_UPCOMING; ?></span></a> </td>
        <?php
            }
        ?>
        <td class="line_header_main_menu" align="center" valign="middle">|</td>
        <td class="line_header_main_menu" align="center" valign="middle"><a href="<?php echo tep_href_link(FILENAME_PRODUCTS_NEW); ?>"><span class="line_header_main_menu"><?php echo BOX_HEADING_WHATS_NEW; ?></span></a> </td>
        <?php
		if( defined('FEATURED_PRODUCTS_DISPLAY') AND FEATURED_PRODUCTS_DISPLAY == 'true' ) {
		?>
        <td class="line_header_main_menu" align="center" valign="middle">|</td>
        <td class="line_header_main_menu" align="center" valign="middle"><a href="<?php echo tep_href_link(FILENAME_FEATURED_PRODUCTS); ?>"><span class="line_header_main_menu"><?php echo BOX_CATALOG_FEATURED_PRODUCTS; ?></span></a> </td>
        <?php
		}
		?>
        <?php
		if (ENABLE_WISHLIST_STORE == 'True'){
		?>
        <td class="line_header_main_menu" align="center" valign="middle">|</td>
        <td class="line_header_main_menu" align="center" valign="middle"><a href="<?php echo tep_href_link(FILENAME_WISHLIST); ?>"><span class="line_header_main_menu"><?php echo BOX_HEADING_CUSTOMER_WISHLIST; ?></span></a> </td>
        <?php
		}
		?>
        <td class="line_header_main_menu" align="center" valign="middle">|</td>
        <td class="line_header_main_menu" align="center" valign="middle"><a href="<?php echo tep_href_link(FILENAME_NEWSLETTER); ?>"><span class="line_header_main_menu"><?php echo BOX_INFORMATION_NEWSLETTER; ?></span></a> </td>
        <?php /*if (USE_DEFAULT_MOBILE_SITE == 'true') { ?>
        <td class="line_header_main_menu" align="center" valign="middle">|</td>
        <td class="line_header_main_menu" align="center" valign="middle"><a href="<?php echo tep_href_link(FILENAME_PAGES, 'pages_id=7', 'NONSSL'); ?>"><span class="line_header_main_menu"><?php echo BOX_HEADING_MOBILE; ?></span></a> </td>
        <?php }*/ ?>
      </tr>
    </table></td>
  </tr>
</table>
<?php
}
}
}
}
?>

<?php
if (substr(basename($PHP_SELF), 0, 8) != 'checkout') {
if (substr(basename($PHP_SELF), 0, 5) != 'login') {
if (substr(basename($PHP_SELF), 0, 14) != 'create_account') {
?>
<!-- categories and subcategories horizontal header -->
<?php 
if (DISPLAY_CATEGORIES_SUBCAT_HORIZONTAL_HEADER == 'true') {
	if (HORIZONTAL_CATEGORIES_SUBCAT_SCRIPT == 'CssMenu') {
	include(DIR_WS_BOXES . 'categories_horizontal.php'); 
	}elseif (HORIZONTAL_CATEGORIES_SUBCAT_SCRIPT == 'CssMegaMenu') {
	include(DIR_WS_BOXES . 'categories_horizontal_megamenu.php'); 
	}elseif (HORIZONTAL_CATEGORIES_SUBCAT_SCRIPT == 'CssMegaMenu1') {
	include(DIR_WS_BOXES . 'categories_horizontal_megamenu1.php'); 
	}elseif (HORIZONTAL_CATEGORIES_SUBCAT_SCRIPT == 'CssMegaMenu2') {
	include(DIR_WS_BOXES . 'categories_horizontal_megamenu2.php');  
	}
}
?>
<!-- categories and subcategories horizontal header eof -->
<?php
}
}
}
?>


<!-- banner header -->
<?php 
	include(DIR_WS_BOXES . 'column_banner_header.php');
?>
<!-- banner header eof -->

<!-- background site content -->
<?php if ($layout["background_site_content"] != '' || BACKGROUND_COLOR_CONTENT != '') { ?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="background_content_site">
  <tr>
    <td>
<?php } ?>