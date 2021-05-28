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
/*
if (defined('TAB_DEFAULT_STYLE') && TAB_DEFAULT_STYLE == "true" && defined('CAROUSEL_DEFAULT') && CAROUSEL_DEFAULT == 'true') {
?>
   <tr>
     <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td>
   </tr>
   <tr>
     <td>
		<div id="horizontalTab">
			<ul>
				<?php
				if (defined('NEW_PRPDUCTS_RANDOM_ALL') && NEW_PRPDUCTS_RANDOM_ALL == 'LastDays') {
				$new_products_ld = " and (p.products_date_added > date_sub(NOW(), interval ".NEW_PRODUCTS_INDEX_LAST_DAYS." day)) ";
				}
				$check_new_products_index = tep_db_query("select p.likes, p.products_model, p.products_youtube, p.products_qtd_stock_status, p.products_qtd_stock_status_avaliable_in, p.manufacturers_id, p.products_free_shipping, p.view_price, p.uv_id, p.products_quantity, p.parcel_window, p.products_id, p.products_price, p.products_tax_class_id, p.manufacturers_id, if(s.status, s.specials_new_products_price, p.products_price) as specials_new_products_price from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id where products_status = '1' ".$new_products_ld." AND p.products_quantity > '0' order by rand(), p.products_date_added desc limit " . MAX_RANDOM_SELECT_NEW);
				if (tep_db_num_rows($check_new_products_index) > 0 && DISPLAY_NEWS_PRODUCTS_INDEX == 'show') {
				?>
				<li><a href="#tab-1"><?php echo TABLE_HEADING_NEW_PRODUCTS; ?></a></li>
				<?php
				}
				?>
				<?php
				$check_specials_products_index = tep_db_query("select p.likes, p.products_model, p.products_youtube, p.products_qtd_stock_status, p.products_qtd_stock_status_avaliable_in, s.expires_date, p.manufacturers_id, p.products_free_shipping, p.view_price, p.uv_id, p.products_quantity, p.parcel_window, p.products_quantity, p.products_id, p.products_price, p.products_tax_class_id, s.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s where p.products_status = '1' and s.products_id = p.products_id and p.products_id = pd.products_id and pd.language_id = '" . $languages_id . "' and s.status = '1' AND p.products_quantity > '0' order by rand(), s.specials_date_added DESC limit " . MAX_DISPLAY_SPECIALS_PRODUCTS_MODULE);
				if (tep_db_num_rows($check_specials_products_index) > 0 && defined('SHOW_DEFAULTSPECIALS') && SHOW_DEFAULTSPECIALS=="true") {
				?>
				<li><a href="#tab-2"><?php echo TABLE_HEADING_DEFAULT_SPECIALS; ?></a></li>
				<?php
				}
				?>
				<?php
				$check_featured_products_index_raw = 'SELECT '.$add_products_image.$add_products_image_sm_1.' p.likes, p.products_model, p.products_youtube, p.products_qtd_stock_status, p.products_qtd_stock_status_avaliable_in, p.manufacturers_id, p.products_free_shipping, p.view_price, p.uv_id, p.manufacturers_id, p.products_quantity, p.parcel_window, p.products_id, p.products_tax_class_id, IF (s.status, s.specials_new_products_price, NULL) AS specials_new_products_price, p.products_price, pd.products_name ';
				if ( defined('FEATURED_PRODUCTS_SPECIALS_ONLY') AND FEATURED_PRODUCTS_SPECIALS_ONLY == 'true' ) {
				  $check_featured_products_index_raw .= 'FROM ' . TABLE_SPECIALS . ' s LEFT JOIN ' . TABLE_PRODUCTS . ' p ON s.products_id = p.products_id ';
				} else {
				  $check_featured_products_index_raw .= 'FROM ' . TABLE_PRODUCTS . ' p LEFT JOIN ' . TABLE_SPECIALS . ' s ON p.products_id = s.products_id ';
				}
				$check_featured_products_index_raw .= 'LEFT JOIN ' . TABLE_PRODUCTS_DESCRIPTION . " pd ON p.products_id = pd.products_id AND pd.language_id = '" . $languages_id . "'
				LEFT JOIN " . TABLE_FEATURED . " f ON p.products_id = f.products_id
				WHERE p.products_status = '1' AND f.status = '1' AND p.products_quantity > '0' order by rand($mtm) DESC limit " . MAX_DISPLAY_FEATURED_PRODUCTS;
				$check_featured_products_index = tep_db_query( $check_featured_products_index_raw );	
				if (tep_db_num_rows($check_featured_products_index) > 0 && FEATURED_PRODUCTS_DISPLAY == 'true') {
				?>
				<li><a href="#tab-3"><?php echo TABLE_HEADING_FEATURED_PRODUCTS_CATEGORY; ?></a></li>
				<?php
				}
				?>
				<?php
				$check_bestseller_products_index = tep_db_query("select distinct p.likes, p.products_model, p.products_youtube, p.products_qtd_stock_status, p.products_qtd_stock_status_avaliable_in, p.manufacturers_id, p.products_free_shipping, p.view_price, p.uv_id, p.parcel_window, p.products_quantity, p.parcel_window, p.manufacturers_id, p.products_price, p.products_id, pd.products_name, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_ORDERS . " o, " . TABLE_ORDERS_PRODUCTS . " op where (o.date_purchased > date_sub(NOW(), interval 60 day)) and o.orders_id = op.orders_id and p.products_id = op.products_id and p.products_status = '1' and p.products_ordered > 0 and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' AND p.products_quantity > '0' order by rand(), p.products_ordered desc, pd.products_name limit " . MAX_DISPLAY_BESTSELLERS_INDEX);
				if (tep_db_num_rows($check_bestseller_products_index) > 0 && DISPLAY_BESTSELLERS_INDEX == 'show') {
				?>
				<li><a href="#tab-4"><?php echo BOX_HEADING_BESTSELLERS; ?></a></li>
				<?php
				}
				?>
			</ul>

			<?php
			if (tep_db_num_rows($check_new_products_index) > 0 && DISPLAY_NEWS_PRODUCTS_INDEX == 'show') {
			?>
			<div id="tab-1">
			<?php 
			if (defined('ENABLE_XMLFRAMEWORK_MFORMULA') && ENABLE_XMLFRAMEWORK_MFORMULA == true) {
				include(DIR_WS_MODULES . 'new_products_index_xml_carousel.php');
			}else{
				include(DIR_WS_MODULES . 'new_products_carousel.php');
			}
			?>
			</div>
			<?php
			} //if (tep_db_num_rows($check_new_products_index) > 0) {
			?>
			<?php
			if (tep_db_num_rows($check_specials_products_index) > 0 && defined('SHOW_DEFAULTSPECIALS') && SHOW_DEFAULTSPECIALS=="true") {
			?>
			<div id="tab-2">
			<?php 
			 if (defined('ENABLE_XMLFRAMEWORK_MFORMULA') && ENABLE_XMLFRAMEWORK_MFORMULA == true) {
				include(DIR_WS_MODULES . 'specials_products_index_xml_carousel.php');
			 }else{
				include(DIR_WS_MODULES . 'default_specials_carousel.php');
			 }
			?>
			</div>
			<?php
			} //if (tep_db_num_rows($check_specials_products_index) > 0) {
			?>
			<?php
			if (tep_db_num_rows($check_featured_products_index) > 0 && FEATURED_PRODUCTS_DISPLAY == 'true') {
			?>
			<div id="tab-3">
			<?php 
			if (defined('ENABLE_XMLFRAMEWORK_MFORMULA') && ENABLE_XMLFRAMEWORK_MFORMULA == true) {
				include(DIR_WS_MODULES . 'featured_products_index_xml_carousel.php');
			}else{
				include(DIR_WS_MODULES . 'featured_carousel.php');
			}
			?>
			</div>
			<?php
			} //if (tep_db_num_rows($check_featured_products_index) > 0) {
			?>
			<?php
			if (tep_db_num_rows($check_bestseller_products_index) > 0 && DISPLAY_BESTSELLERS_INDEX == 'show') {
			?>
			<div id="tab-4">
			<?php 
			include(DIR_WS_MODULES . 'best_sellers_index_carousel.php');
			?>
			</div>
			<?php
			} //if (tep_db_num_rows($check_bestseller_products_index) > 0) {
			?>
		</div>
    <!-- Responsive Tabs JS -->
    <script src="scripts/responsive-tabs/js/jquery.responsiveTabs.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            var $tabs = $('#horizontalTab');
            $tabs.responsiveTabs({
                rotate: false,
                startCollapsed: 'accordion',
                collapsible: 'accordion',
                setHash: true,
//                disabled: [3,4],
                click: function(e, tab) {
                    $('.info').html('Tab <strong>' + tab.id + '</strong> clicked!');
                },
                activate: function(e, tab) {
                    $('.info').html('Tab <strong>' + tab.id + '</strong> activated!');
                },
                activateState: function(e, state) {
                    //console.log(state);
                    $('.info').html('Switched from <strong>' + state.oldState + '</strong> state to <strong>' + state.newState + '</strong> state!');
                }
            });

            $('#start-rotation').on('click', function() {
                $tabs.responsiveTabs('startRotation', 1000);
            });
            $('#stop-rotation').on('click', function() {
                $tabs.responsiveTabs('stopRotation');
            });
            $('#start-rotation').on('click', function() {
                $tabs.responsiveTabs('active');
            });
            $('#enable-tab').on('click', function() {
                $tabs.responsiveTabs('enable', 3);
            });
            $('#disable-tab').on('click', function() {
                $tabs.responsiveTabs('disable', 3);
            });
            $('.select-tab').on('click', function() {
                $tabs.responsiveTabs('activate', $(this).val());
            });

        });
    </script>
     </td>
   </tr>
<?php
} //if (TAB_DEFAULT_STYLE == "true") {
*/
?>

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
        if (defined('CAROUSEL_DEFAULT') && CAROUSEL_DEFAULT == 'true') {
        include(DIR_WS_MODULES . 'default_specials_carousel.php');
        }else{
        include(DIR_WS_MODULES . FILENAME_DEFAULT_SPECIALS);
        }
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
            if (defined('CAROUSEL_DEFAULT') && CAROUSEL_DEFAULT == 'true') {
            include(DIR_WS_MODULES . 'featured_carousel.php');
            }else{
            include(DIR_WS_MODULES . FILENAME_FEATURED);
            } 
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
            if (defined('CAROUSEL_DEFAULT') && CAROUSEL_DEFAULT == 'true') {
            include(DIR_WS_MODULES . 'new_products_carousel.php');
            }else{
            include(DIR_WS_MODULES . FILENAME_NEW_PRODUCTS);
            }
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
		if (defined('CAROUSEL_DEFAULT') && CAROUSEL_DEFAULT == 'true') {
		include(DIR_WS_MODULES . 'best_sellers_index_carousel.php');
		}else{
		include(DIR_WS_MODULES . 'best_sellers_index.php');
		}
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