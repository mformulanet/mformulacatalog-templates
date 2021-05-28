<table border="0" width="100%" cellspacing="0" cellpadding="0">
<?php
/*if (defined('USE_INDEX_BANNERSORNPORS') && USE_INDEX_BANNERSORNPORS == "OneBanner") {
?>
	<?php
	  if ($banner = tep_banner_exists('dynamic', BANNER_GROUP_468x200)) {
	?>
	  <tr>
	    <td align="center"><?php echo tep_display_banner('static', $banner); ?></td>
	  </tr>
	<?php
	  }
	?>
<?php
}elseif (defined('USE_INDEX_BANNERSORNPORS') && USE_INDEX_BANNERSORNPORS == "BannersEffects") {
?>
	  <tr>
	    <td align="center"><?php require(DIR_WS_BOXES . 'column_banner_index.php'); ?></td>
	  </tr>
<?php
}elseif (defined('USE_INDEX_BANNERSORNPORS') && USE_INDEX_BANNERSORNPORS == "BannersEffects1") {
?>
	  <tr>
	    <td align="center"><?php require(DIR_WS_BOXES . 'column_banner_index1.php'); ?></td>
	  </tr>
<?php
}elseif (defined('USE_INDEX_BANNERSORNPORS') && USE_INDEX_BANNERSORNPORS == "BannersEffects2") {
?>
	  <tr>
	    <td align="center"><?php require(DIR_WS_BOXES . 'column_banner_index2.php'); ?></td>
	  </tr>
<?php
}elseif (defined('USE_INDEX_BANNERSORNPORS') && USE_INDEX_BANNERSORNPORS == "BannersEffects3") {*/
?>
	  <tr>
	    <td align="center"><?php require(DIR_WS_BOXES . 'column_banner_index3.php'); ?></td>
	  </tr>
<?php
/*}elseif (defined('USE_INDEX_BANNERSORNPORS') && USE_INDEX_BANNERSORNPORS == "BannersEffects4") {
?>
	  <tr>
	    <td align="center"><?php require(DIR_WS_BOXES . 'column_banner_index4.php'); ?></td>
	  </tr>
<?php
}elseif (defined('USE_INDEX_BANNERSORNPORS') && USE_INDEX_BANNERSORNPORS == "NewsProducts") {
?>
	  <tr>
	    <td align="center"><?php include(DIR_WS_MODULES . 'banner_index_newspeoducts.php'); ?></td>
	  </tr>
<?php
}elseif (defined('USE_INDEX_BANNERSORNPORS') && USE_INDEX_BANNERSORNPORS == "Specials") {
?>
	  <tr>
	    <td align="center"><?php include(DIR_WS_MODULES . 'banner_index_specials.php'); ?></td>
	  </tr>
<?php
}*/
?>

<?php
if (defined('DISPLAY_BOX_CURRENCY_EXCHANGE_INDEX') && DISPLAY_BOX_CURRENCY_EXCHANGE_INDEX == 'show') {  
?>
    <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '60'); ?></td>
    </tr>
    <tr>
        <td>
        <?php 
		include(DIR_WS_BOXES . 'quote_currency_exchange.php');
        ?>
        </td>
    </tr>
<?php
	$filterlist1_sql= "select distinct p.products_id as id, m.filter1_name as name, m.filter1_text as text from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_FILTER1 . " m where p.products_status = '1' and p.filter1_id = m.filter1_id and p.products_id = p2c.products_id and p2c.categories_id = '5' order by m.filter1_name";
	$filterlist1_query = tep_db_query($filterlist1_sql);
	if (tep_db_num_rows($filterlist1_query) > 0) {
?>
    <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '60'); ?></td>
    </tr>
    <tr>
        <td>
        <?php 
		include(DIR_WS_BOXES . 'quote_currency_exchange_card.php');
        ?>
        </td>
    </tr>
<?php
	}
}
?>

<?php 
$page_index_top_query = tep_db_query("select p.pages_id, p.sort_order, p.status, s.pages_title, s.pages_html_text, s.intorext, s.externallink, s.link_target from " . TABLE_INFO_PAGES . " p LEFT JOIN " .TABLE_INFO_PAGES_DESCRIPTION . " s on p.pages_id = s.pages_id where p.status = 1 and p.page_type != 1 and s.language_id = '" . (int)$languages_id . "' and  s.pages_title = 'IndexTop' order by p.sort_order, s.pages_title");
$page_index_top = tep_db_fetch_array($page_index_top_query);
if ($page_index_top['pages_html_text'] != '') {
?> 
   <tr>
     <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '60'); ?></td>
   </tr>
   <tr>
     <td class="smallText">
		<?php 		
		echo tep_texts_replace_keywords($page_index_top['pages_html_text']);
        ?>     
     </td>
   </tr>
<?php 		
}
?>

<?php //require(DIR_WS_BOXES . 'categories_index_responsivegallery.php'); ?>

<?php
// DEFAULT SPECIALS START...
   if (defined('SHOW_DEFAULTSPECIALS') && SHOW_DEFAULTSPECIALS=="true") {
?>
    <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '60'); ?></td>
    </tr>
    <tr>
        <td>
        <?php 
//        if (defined('CAROUSEL_DEFAULT') && CAROUSEL_DEFAULT == 'true') {
//        include(DIR_WS_MODULES . 'default_specials_carousel.php');
//        }else{
        include(DIR_WS_MODULES . FILENAME_DEFAULT_SPECIALS);
//        }
        ?>
        </td>
    </tr>
<?
   }
// DEFAULT SPECIALS END...
?>

<?php
if( defined('FEATURED_PRODUCTS_DISPLAY') AND FEATURED_PRODUCTS_DISPLAY == 'true' ) {
?>
    <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '60'); ?></td>
    </tr>
    <tr>
        <td>
        <?php 
//            if (defined('CAROUSEL_DEFAULT') && CAROUSEL_DEFAULT == 'true') {
//            include(DIR_WS_MODULES . 'featured_carousel.php');
//            }else{
            include(DIR_WS_MODULES . FILENAME_FEATURED);
//            } 
        ?>
        </td>
    </tr>
<?php
}
?>
<?php
if (DISPLAY_NEWS_PRODUCTS_INDEX == 'show') {  
?>
    <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '60'); ?></td>
    </tr>

    <tr>
        <td>
        <?php 
//            if (defined('CAROUSEL_DEFAULT') && CAROUSEL_DEFAULT == 'true') {
//            include(DIR_WS_MODULES . 'new_products_carousel.php');
//            }else{
            include(DIR_WS_MODULES . FILENAME_NEW_PRODUCTS);
//            }
        ?>
        </td>
    </tr>
<?php
}
?>
<?php
if (DISPLAY_BESTSELLERS_INDEX == 'show') {  
?>
    <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
    </tr>

    <tr>
        <td>
        <?php 
//		if (defined('CAROUSEL_DEFAULT') && CAROUSEL_DEFAULT == 'true') {
//		include(DIR_WS_MODULES . 'best_sellers_index_carousel.php');
//		}else{
		include(DIR_WS_MODULES . 'best_sellers_index.php');
//		}
        ?>
        </td>
    </tr>
<?php
}
?>

<?php 
$page_index_bottom_query = tep_db_query("select p.pages_id, p.sort_order, p.status, s.pages_title, s.pages_html_text, s.intorext, s.externallink, s.link_target from " . TABLE_INFO_PAGES . " p LEFT JOIN " .TABLE_INFO_PAGES_DESCRIPTION . " s on p.pages_id = s.pages_id where p.status = 1 and p.page_type != 1 and s.language_id = '" . (int)$languages_id . "' and  s.pages_title = 'IndexBottom' order by p.sort_order, s.pages_title");
$page_index_bottom = tep_db_fetch_array($page_index_bottom_query);
if ($page_index_bottom['pages_html_text'] != '') {
?> 
   <tr>
     <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '60'); ?></td>
   </tr>
   <tr>
     <td class="smallText">
		<?php 		
		echo tep_texts_replace_keywords($page_index_bottom['pages_html_text']);
        ?>     
     </td>
   </tr>
<?php 		
}
?>

<?php 
if (defined('DISPLAY_CUSTOMERS_TESTIMONIALS_INDEX') && DISPLAY_CUSTOMERS_TESTIMONIALS_INDEX == "show") {
?> 
   <tr>
     <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
   </tr>
   <tr>
     <td class="smallText">
		<?php 		
		$full_testimonial = tep_db_query("select * FROM " . TABLE_CUSTOMER_TESTIMONIALS . " WHERE status = '1' order by rand()");
		//$full_testimonial = tep_db_query("select * FROM " . TABLE_CUSTOMER_TESTIMONIALS . " WHERE status = '1' order by date_added DESC");
		$num_check_testimonial = tep_db_num_rows($full_testimonial);
		if ($num_check_testimonial > 2) {

		$info_box_contents = array();
		$info_box_contents[] = array('align' => 'left',
									 'text'  => BOX_CUSTOMER_TESTIMONIAL
									);
		new infoBoxHeading($info_box_contents, false, false, tep_href_link(FILENAME_CUSTOMER_TESTIMONIALS, '', 'NONSSL'));

		//include(DIR_WS_BOXES . 'customer_testimonials_index.php');

		$info_box_contents = array();
		$info_box_contents[] = array('align' => 'center',
									 'text' => '<iframe src="'.tep_href_link('customer_testimonials_index.php').'" scrolling="no" frameborder="0" '.(WIDTH_CUSTOMER_TESTIMONIALS_INDEX != "" ? ' width="'.WIDTH_CUSTOMER_TESTIMONIALS_INDEX.'" ' : '').' '.(HEIGHT_CUSTOMER_TESTIMONIALS_INDEX != "" ? ' height="'.HEIGHT_CUSTOMER_TESTIMONIALS_INDEX.'" ' : '').'></iframe><br><br><table align="right" border="0" cellspacing="0" cellpadding="0"><tr align="right"><td align="right" style="padding-right:"5px";>' . '<a href="' . tep_href_link(FILENAME_CUSTOMER_TESTIMONIALS . '#customer_testimonial', '', 'NONSSL') . '">' . tep_image_button('button_customertestimonial.gif', '') . '</a>' . '</td></tr></table>');	
		new infoBox($info_box_contents);
		
		}
        ?>     
     </td>
   </tr>
<?php 		
}
?>

    <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '60'); ?></td>
    </tr>
    <tr>
        <td>
        <?php
        include(DIR_WS_MODULES . FILENAME_UPCOMING_PRODUCTS);
        ?>
        </td>
    </tr>
    
    <?php
    if (VIEW_TAG_CLOUD=="true") {
    ?>
    <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '60'); ?></td>
    </tr>
    <tr>
        <td align="center"><?php include(DIR_WS_BOXES . 'searchtagcloud.php'); ?></td>
    </tr>
    <?php
    }
    ?>
</table>