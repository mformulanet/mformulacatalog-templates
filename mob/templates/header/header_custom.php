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
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
    
    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="background_header">
      <tr>
        <td>
    
        <?php
        if (SHOW_HIDE_BOX_LANGUAGES == 'show' || SHOW_HIDE_BOX_CURRENCY == 'show') {
        ?>
        <table width="100%" border="0" cellspacing="10" cellpadding="0">
          <tr>
            <td align="center">
            <table border="0" cellpadding="0" cellspacing="5">
              <tr>
                <td align="default">
				<?php
				if (CATEGORY_STYLE_MOBILE == 'Push') {
				?>
				<table border="0" cellpadding="0" cellspacing="0" align="center">
				  <tr>
					<td><?php require(DIR_WS_BOXES . 'categories_mobile_pushy.php'); ?></td>
				  </tr>
				</table>
				<?php
				}else{
				?>
				  <table border="0" cellpadding="0" cellspacing="5" class="background_content_header">
					<tr>
					  <?php if (tep_session_is_registered('customer_id')) { ?>
					  <td align="center" class="line_header_menu"><?php echo '<a href="'.tep_href_link(FILENAME_LOGOFF, '', 'SSL').'"><span class="line_header_menu">'.HEADER_TITLE_LOGOFF.'</span></a>'; ?></td>
					  <td align="center" class="line_header_menu">&nbsp;|&nbsp;</td>
					  <?php } else { ?>
<!--
					  <td align="center" class="line_header_menu"><?php //echo '<a href="' . tep_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL') . '"><span class="line_header_menu">'.TEXT_SIGN_IN.'</span></a>'; ?></td>
					  <td align="center" class="line_header_menu">&nbsp;|&nbsp;</td>
-->
					  <?php } ?>
					  <td align="center" class="line_header_menu"><?php echo '<a href="'.tep_href_link(FILENAME_ACCOUNT, '', 'SSL').'"><span class="line_header_menu">'.HEADER_TITLE_MY_ACCOUNT.'</span></a>'; ?></td>
					</tr>
				  </table>
				<?php
				}
				?>
                </td>
                <?php
                if (SHOW_HIDE_BOX_LANGUAGES == 'show') {
                ?>
                <td align="right"><?php include(DIR_WS_BOXES . 'languages.php'); ?>
                </td>
                <?php
                }
                if (SHOW_HIDE_BOX_CURRENCY == 'show') {
                ?>
                <td align="right"><?php include(DIR_WS_BOXES . 'currencies.php'); ?>
                </td>
                <?php
                }
                ?>
              </tr>
            </table>
            </td>
          </tr>
        </table>
        <?php
        }
        ?>
        <table width="100%" border="0" cellspacing="10" cellpadding="0">
          <tr>
            <td align="center" valign="middle">
            <?php
            // logo
            if ($layout["logo"]) {
            echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . $logo . '</a>';
            }else{
            echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image(DIR_WS_IMAGES . STORE_LOGO, STORE_NAME, '', '', '') . '</a>';
            }
            // logo eof
            ?>
            </td>
          </tr>
		</table>
        <table width="100%" border="0" cellspacing="10" cellpadding="0">
          <tr>
            <?php
            if (substr(basename($PHP_SELF), 0, 8) != 'checkout') {
            ?>
            <td align="center" class="background_content_header_box_shopping_cart">
            <script type="text/javascript" src="scripts/dropdowncontent.js"></script>
            <table border="0" cellpadding="0" cellspacing="5">
              <tr>
                <td align="center" class="line_header_menu"><?php echo '<a href="'.tep_href_link(FILENAME_SHOPPING_CART).'">' . tep_image(DIR_WS_IMAGES . 'icon_carrinhocompras.png', '', '', '', ' align="middle" ') . '</a>'; ?></td>
                <td align="center"><?php 
                if ($cart->count_contents() > 0) {
                echo '<a href="'.tep_href_link(FILENAME_SHOPPING_CART).'" id="searchlink" rel="shopping_cart"><span class="line_header_menu">'.HEADER_TITLE_CART_CONTENTS . ' (' . $cart->count_contents() . ')' .'</span></a>'; 
                }else{
                echo '<a href="'.tep_href_link(FILENAME_SHOPPING_CART).'" id="searchlink" rel="shopping_cart"><span class="line_header_menu">'.HEADER_TITLE_CART_CONTENTS.'</span></a>'; 
                }
                ?>
                <?php
                if (substr(basename($PHP_SELF), 0, 8) != 'checkout') {
                  if (substr(basename($PHP_SELF), 0, 13) != 'shopping_cart') {
                    if($registry_mode_id == 0){
                    ?>
                    <DIV id="shopping_cart" style="position:absolute; visibility: hidden; border: 1px solid <?php echo TABLE_BOX_BORDER_COLOR; ?>; background-color: #FFFFFF ; width: 300px; padding: 8px; z-index: 1050;">
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
  /*
              if (STATUS_FINALIZAR_ACEITAR_CONTRATO == 'false') {
              ?>
              <td align="center" class="line_header_menu">&nbsp;|&nbsp;</td>
              <td align="center" class="line_header_menu"><?php echo '<a href="'.tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL').'"><span class="line_header_menu">'.HEADER_TITLE_CHECKOUT.'</span></a>'; ?></td>
              <?php
              } 
  */
              ?>
                <td align="center" class="line_header_menu">
					<script>
					$(document).ready(function(){
						$('#show').click(function() {
						  $('.menu').toggle("slide");
						});
					});
					</script>					
					<?php echo '<div id="show">' . tep_image(HTTPS_SERVER . HTTPS_COOKIE_PATH . 'images/icon_finder.png', IMAGE_BUTTON_SEARCH, '', '', ' align="middle" ') . '</div>'; ?>
				</td>

              </tr>
            </table>
            </td>

              <?php
              } // if (substr(basename($PHP_SELF), 0, 8) != 'checkout') {
              ?>

          </tr>
        </table>
			
		<div class="menu" style="display: none;">
		<table width="100%" border="0" cellspacing="10" cellpadding="0">
		  <tr>
			<td align="center"><table width="90%" height="40" border="0" cellpadding="0" cellspacing="5">
					<?php
					  require(DIR_WS_BOXES . 'search.php');
					  ?>
				</table></td>
		  </tr>
		</table></td>
		  </tr>
		</table>
		</div>

<?php
if (CATEGORY_STYLE_MOBILE == 'DropDown') {
    if (substr(basename($PHP_SELF), 0, 8) != 'checkout') {
        if (substr(basename($PHP_SELF), 0, 5) != 'login') {
            if (substr(basename($PHP_SELF), 0, 14) != 'create_account') {
?>
            <table width="100%" border="0" cellspacing="10" cellpadding="0">
              <tr>
                <td>
                  <?php require(DIR_WS_BOXES . 'categories_mobile.php'); ?>
                </td>
              </tr>
            </table>
<?php
            }
        }
    }
}
?>
<!-- background site content -->
<?php if ($layout["background_site_content"] != '' || BACKGROUND_COLOR_CONTENT != '') { ?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="background_content_site">
  <tr>
    <td>
<?php } ?>