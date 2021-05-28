<!-- new page -->
<!-- product_name -->

<table width="100%" border="0" cellspacing="0" cellpadding="0">

	<tr>

		<td class="pp_product_name" valign="top" align="center">

			<span itemprop="name"><?php echo $products_name; ?></span>

			<?php if (VIEW_REFERENCE == 'true') { ?><br><br><span class="pp_product_model" itemprop="identifier"><?php echo $products_model; ?></span><?php } ?>

		</td>

		<!-- manufacturers -->

		<?php

		if (VIEW_MANUFACTURER == 'true') {

			$image_query = tep_db_query("select manufacturers_name, manufacturers_image from " . TABLE_MANUFACTURERS . " where manufacturers_id = '" . (int)$product_info['manufacturers_id'] . "'");

			$image_q = tep_db_fetch_array($image_query);

			$image_manufacturers = $image_q['manufacturers_image'];
			if (isset($product_info['manufacturers_id'])) {

				?>

				<td class="pp_product_manufacturer" valign="top" align="center">

					<?php

					if (empty($image_manufacturers)) {

						echo '<span itemprop="brand">' . $image_q['manufacturers_name'] . '</span>';
					} else {

						echo tep_image(DIR_WS_IMAGES . $image_manufacturers, $image_q['manufacturers_name'], '', '');
					}

					?>

				</td>

			<?php

		}
	}

	?>

		<!-- manufacturers eof -->

	</tr>

</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

	<tr>

		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>

	</tr>

</table>

<!-- product_name eof -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">

	<tr>

		<td width="10%" valign="middle">
			<!-- share rede sociais -->

			<table width="100%" border="0" cellspacing="0" cellpadding="0">

				<tr>

					<td class="smallText">
						<table border="0" cellpadding="0" cellspacing="5">

							<?php

							if ($mobile === true) {

								?>

								<tr>

									<td><a href="whatsapp://send?text=<?php echo $products_name; ?> http://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" data-action="share/whatsapp/share"><?php echo tep_image(DIR_WS_IMAGES . 'share_whatsapp.png', 'WhatsApp', '', '', ' align="middle" '); ?></a> </td>

								</tr>

							<?php

						}

						?>

							<?php

							if (FACEBOOK_APPLICATION_ID != "") {

								?>

								<tr>

									<td>

										<a href="https://www.facebook.com/dialog/send?_path=send&app_id=<?php echo FACEBOOK_APPLICATION_ID; ?>&redirect_uri=http://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>&display=page&link=http://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" target="_blank"><?php echo tep_image(DIR_WS_IMAGES . 'share_facebookmessenger.png', 'Facebook Messenger', '', '', ' align="middle" '); ?></a>

									</td>

								</tr>

							<?php

						}

						?>

							<tr>

								<td><a href="https://www.facebook.com/sharer/sharer.php?u=http://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>&t=<?php echo $products_name; ?>" target="_blank"><?php echo tep_image(DIR_WS_IMAGES . 'share_facebook.png', 'Facebook', '', '', ' align="middle" '); ?></a> </td>

							</tr>

							<tr>

								<td><a href="https://twitter.com/intent/tweet?source=http://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>&text=<?php echo $products_name; ?>" target="_blank" title="Tweet"><?php echo tep_image(DIR_WS_IMAGES . 'share_twitter.png', 'Twitter', '', '', ' align="middle" '); ?></a> </td>

							</tr>

							<tr>

								<td><a href="http://pinterest.com/pin/create/button/?url=http://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>&description=<?php echo $products_name; ?>" target="_blank" title="Pin it"><?php echo tep_image(DIR_WS_IMAGES . 'share_pinterest.png', 'Pin it', '', '', ' align="middle" '); ?></a> </td>

							</tr>

							<tr>

								<td><a href="http://www.linkedin.com/shareArticle?mini=true&url=http://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>&title=<?php echo $products_name; ?>&summary=<?php echo $products_name; ?>&source=http://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" target="_blank" title="LinkedIn"><?php echo tep_image(DIR_WS_IMAGES . 'share_linkedin.png', 'LinkedIn', '', '', ' align="middle" '); ?></a> </td>

							</tr>

							<tr>

								<td><a href="http://wordpress.com/press-this.php?u=http://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>&t=<?php echo $products_name; ?>&s=<?php echo $products_name; ?>" target="_blank" title="WordPress"><?php echo tep_image(DIR_WS_IMAGES . 'share_wordpress.png', 'WordPress', '', '', ' align="middle" '); ?></a> </td>

							</tr>

							<tr>

								<td><a href="http://www.tumblr.com/share?v=3&u=http://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>&t=<?php echo $products_name; ?>&s=" target="_blank" title="Tumblr"><?php echo tep_image(DIR_WS_IMAGES . 'share_tumblr.png', 'Tumblr', '', '', ' align="middle" '); ?></a> </td>

							</tr>

							<tr>

								<td><?php echo '<a href="' . tep_href_link(FILENAME_TELL_A_FRIEND, 'products_id=' . (int)$HTTP_GET_VARS['products_id']) . '"  target="_blank">'; ?><?php echo tep_image(DIR_WS_IMAGES . 'share_email.png', 'E-mail', '', '', ' align="middle" '); ?></a> </td>

							</tr>

							<?php

							if (DISPLAY_SHARE_BUTTONS_NETWORK_SOCIAL == "true") {

								?>

								<tr>

									<td>
										<!-- AddThis Button BEGIN -->

										<div class="addthis_toolbox addthis_default_style ">

											<!--<a class="addthis_button_preferred_1"></a>

                            	<a class="addthis_button_preferred_2"></a>

                            	<a class="addthis_button_preferred_3"></a>

                            	<a class="addthis_button_preferred_4"></a>

                            	<a class="addthis_button_preferred_5"></a>-->

											<a class="addthis_button_compact"></a> <a class="addthis_counter addthis_bubble_style"></a> </div>

										<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4f529d400ca15fd7"></script>

										<!-- AddThis Button END -->
									</td>

								</tr>

							<?php

						}

						?>

						</table>
					</td>

					<?php

					if (DISPLAY_SHARE_BUTTONS_NETWORK_SOCIAL == "true") {

						?>

						<td class="smallText"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>

						<td class="smallText">

							<table border="0" cellpadding="0" cellspacing="5">

								<tr>

									<td valign="top">

										<!-- Place this tag where you want the +1 button to render -->

										<g:plusone size="medium"></g:plusone>
									</td>

								</tr>

								<tr>

									<td valign="top">

										<iframe src="http://www.facebook.com/plugins/like.php?href=http://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']  ?>&amp;layout=button_count&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;width=450&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:90px; height:21px;" allowTransparency="true"></iframe> </td>

								</tr>

								<tr>

									<td valign="top" style="padding-left:5px;"><a href="http://twitter.com/share" class="twitter-share-button" data-url="http://<?php echo $_SERVER['HTTP_HOST']; ?>" data-count="horizontal" data-via="<?php echo $_SERVER['HTTP_HOST']; ?>">Tweet</a>
										<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
									</td>

								</tr>

								<tr>

									<td valign="top" style="padding-left:0px;">
										<script type="text/javascript" src="http://platform.linkedin.com/in.js"></script>
										<script type="in/share" data-url="<?php echo $_SERVER['HTTP_HOST']; ?>" data-counter="right"></script>
									</td>

								</tr>

								<tr>

									<td valign="top" style="padding-left:5px;">

										<a href="//pinterest.com/pin/create/button/?url=<?php echo $_SERVER['HTTP_HOST']; ?>&media=<?php echo HTTPS_SERVER . HTTP_COOKIE_PATH . DIR_WS_IMAGES . $product_info['products_image_lrg']; ?>&description=<?php echo utf8_encode($products_name); ?>" data-pin-do="buttonPin" data-pin-config="beside"><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" border="0" /></a>
										<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
									</td>

								</tr>
								<?php

								if (($product_info['products_quantity'] > 0) || (($product_info['products_quantity'] <= 0) && ($product_info['products_qtd_stock_status'] == '1'))) {

									if ($product_info['view_price'] == 0) {

										if (($language == 'portugues') && ($currency == 'BRL')) {

											if (VAKINHA_EMAIL != '') {

												?>

												<tr>

													<td valign="top" style="padding-left:5px;">

														<?php

														$products_price_vakinha = $currencies->display_price($price, tep_get_tax_rate($product_info['products_tax_class_id']));

														$products_price_replace_vakinha = str_replace("R$", "", $products_price_vakinha);

														$products_price_replace_vakinha1 = str_replace(".", "", $products_price_replace_vakinha);

														?>

														<a href="http://www.vakinha.com.br/api/CreateEvent.aspx?_follow=html&amp;AffiliateEmail=<?php echo VAKINHA_EMAIL; ?>&amp;ProductId=<?php echo $product_info['products_id']; ?>&amp;ProductName=<?php echo $products_name; ?>&amp;ProductURL=http://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']  ?>&amp;ProductPrice=<?php echo $products_price_replace_vakinha1; ?>&amp;ProductImage=<?php echo HTTP_SERVER . HTTP_COOKIE_PATH . DIR_WS_IMAGES . $product_info['products_image_lrg']; ?>" target="_blank">

															<?php echo tep_image(DIR_WS_IMAGES . 'button_vakinha.png', 'Abrir Vakinha.com.br', '', '', ' align="middle" '); ?></a> </td>

												</tr>

											<?php

										}
									}
								}
							}

							?>

							</table>

						</td>

					<?php

				}

				?>

				</tr>

			</table>

			<!-- share rede sociais -->
		</td>
		<td width="5%" valign="top">&nbsp;</td>
		<!-- pictures -->

		<?php

		if (tep_not_null($product_info['products_image'])) {

			?>
			<script type="text/javascript">
				<!--

				var viewer = new PhotoViewer();

				<?php if ($product_info['products_image_lrg']) { ?>

					viewer.add('<?php echo DIR_WS_IMAGES . $product_info['products_image_lrg']; ?>');

				<?php } ?>

				<?php if ($product_info['products_image_xl_1']) { ?>

					viewer.add('<?php echo DIR_WS_IMAGES . $product_info['products_image_xl_1']; ?>');

				<?php } ?>

				<?php if ($product_info['products_image_xl_2']) { ?>

					viewer.add('<?php echo DIR_WS_IMAGES . $product_info['products_image_xl_2']; ?>');

				<?php } ?>

				<?php if ($product_info['products_image_xl_3']) { ?>

					viewer.add('<?php echo DIR_WS_IMAGES . $product_info['products_image_xl_3']; ?>');

				<?php } ?>

				<?php if ($product_info['products_image_xl_4']) { ?>

					viewer.add('<?php echo DIR_WS_IMAGES . $product_info['products_image_xl_4']; ?>');

				<?php } ?>

				<?php if ($product_info['products_image_xl_5']) { ?>

					viewer.add('<?php echo DIR_WS_IMAGES . $product_info['products_image_xl_5']; ?>');

				<?php } ?>

				<?php if ($product_info['products_image_xl_6']) { ?>

					viewer.add('<?php echo DIR_WS_IMAGES . $product_info['products_image_xl_6']; ?>');

				<?php } ?>

				//-->
			</script>
			<td valign="top">

				<?php echo '<div class="pl_style_border_div">'; ?>

				<table border="0" cellspacing="0" cellpadding="0" align="center">

					<tr>

<td align="center" class="main">
			<?php 
			if (PRODUCT_ZOOM_TYPE == 'inner') { 
				$add_img_zoom = ' class="easyzoom easyzoom--overlay"';
			}else{
				$add_img_zoom = ' class="easyzoom easyzoom--adjacent"';
			}
			?>

            <div id="initDiv"<?php echo $add_img_zoom; ?>>
			<?php
            $new_image = $product_info['products_image'];
            if ( (defined('PRODUCT_PAGE_IMAGE_SMALL_OR_LARGE')) && (PRODUCT_PAGE_IMAGE_SMALL_OR_LARGE == "large") ){
			$image_width = MEDIUM_IMAGE_WIDTH;
            $image_height = MEDIUM_IMAGE_HEIGHT;
			}else{
			$image_width = SMALL_IMAGE_WIDTH;
            $image_height = SMALL_IMAGE_HEIGHT;
			}
			echo '<a href="' . DIR_WS_IMAGES . $product_info['products_image_lrg'] . '" onclick="return viewer.show(0)">' . tep_image(HTTPS_SERVER . HTTP_COOKIE_PATH . DIR_WS_IMAGES . $new_image, DIR_WS_IMAGES . $product_info['products_image_lrg'], $image_width, $image_height, 'hspace="5" vspace="5" itemprop="image" ') . '</a>';
			echo '<br>' . TEXT_ONMOUSEROVER_TO_ZOOM;

			echo '<br><a href="' . DIR_WS_IMAGES . $product_info['products_image_lrg'] . '" onclick="return viewer.show(0)">' . TEXT_CLICK_TO_VIEW_LARGE . '</a><br><br>';

			?>
            </div>
<?php
    if (($product_info['products_image'] != '') && ($product_info['products_image_lrg'] != '')) {
?>            
            <div id="image_div" style="display:none;"<?php echo $add_img_zoom; ?>>
            <?php
            $new_image = $product_info['products_image'];
            if ( (defined('PRODUCT_PAGE_IMAGE_SMALL_OR_LARGE')) && (PRODUCT_PAGE_IMAGE_SMALL_OR_LARGE == "large") ){
			$image_width = MEDIUM_IMAGE_WIDTH;
            $image_height = MEDIUM_IMAGE_HEIGHT;
			}else{
			$image_width = SMALL_IMAGE_WIDTH;
            $image_height = SMALL_IMAGE_HEIGHT;
			}
			echo '<a href="' . DIR_WS_IMAGES . $product_info['products_image_lrg'] . '" onclick="return viewer.show(0)">' . tep_image(HTTPS_SERVER . HTTP_COOKIE_PATH . DIR_WS_IMAGES . $new_image, DIR_WS_IMAGES . $product_info['products_image_lrg'], $image_width, $image_height, 'hspace="5" vspace="5" ') . '</a>';
			echo '<br>' . TEXT_ONMOUSEROVER_TO_ZOOM;

			echo '<br><a href="' . DIR_WS_IMAGES . $product_info['products_image_lrg'] . '" onclick="return viewer.show(0)">' . TEXT_CLICK_TO_VIEW_LARGE . '</a><br><br>';
			?>
            </div>
<?php
    }
?>            
<?php
    if (($product_info['products_image_sm_1'] != '') && ($product_info['products_image_xl_1'] != '')) {
?>
            <div id="image_div1" style="display:none;"<?php echo $add_img_zoom; ?>>
            <?php echo '<a href="' . DIR_WS_IMAGES . $product_info['products_image_xl_1'] . '" onclick="return viewer.show(1)">' . tep_image(HTTPS_SERVER . HTTP_COOKIE_PATH . DIR_WS_IMAGES . $product_info['products_image_sm_1'], DIR_WS_IMAGES . $product_info['products_image_xl_1'], $image_width, $image_height, 'hspace="1" vspace="1" ') . '</a>'; 
			echo '<br>' . TEXT_ONMOUSEROVER_TO_ZOOM;

			echo '<br><a href="' . DIR_WS_IMAGES . $product_info['products_image_xl_1'] . '" onclick="return viewer.show(0)">' . TEXT_CLICK_TO_VIEW_LARGE . '</a><br><br>';
			?>
            </div>
<?php
    }
?>
<?php
    if (($product_info['products_image_sm_2'] != '') && ($product_info['products_image_xl_2'] != '')) {
?>
            <div id="image_div2" style="display:none;"<?php echo $add_img_zoom; ?>>
            <?php echo '<a href="' . DIR_WS_IMAGES . $product_info['products_image_xl_2'] . '" onclick="return viewer.show(2)">' . tep_image(HTTPS_SERVER . HTTP_COOKIE_PATH . DIR_WS_IMAGES . $product_info['products_image_sm_2'], DIR_WS_IMAGES . $product_info['products_image_xl_2'], $image_width, $image_height, 'hspace="1" vspace="1" ') . '</a>';
			echo '<br>' . TEXT_ONMOUSEROVER_TO_ZOOM;

			echo '<br><a href="' . DIR_WS_IMAGES . $product_info['products_image_xl_2'] . '" onclick="return viewer.show(0)">' . TEXT_CLICK_TO_VIEW_LARGE . '</a><br><br>';
			?>
            </div>
<?php
    }
?>
<?php
    if (($product_info['products_image_sm_3'] != '') && ($product_info['products_image_xl_3'] != '')) {
?>
            <div id="image_div3" style="display:none;"<?php echo $add_img_zoom; ?>>
            <?php echo '<a href="' . DIR_WS_IMAGES . $product_info['products_image_xl_3'] . '" onclick="return viewer.show(3)">' . tep_image(HTTPS_SERVER . HTTP_COOKIE_PATH . DIR_WS_IMAGES . $product_info['products_image_sm_3'], DIR_WS_IMAGES . $product_info['products_image_xl_3'], $image_width, $image_height, 'hspace="1" vspace="1" class="jqzoom" ') . '</a>'; 
			echo '<br>' . TEXT_ONMOUSEROVER_TO_ZOOM;

			echo '<br><a href="' . DIR_WS_IMAGES . $product_info['products_image_xl_3'] . '" onclick="return viewer.show(0)">' . TEXT_CLICK_TO_VIEW_LARGE . '</a><br><br>';
			?>
            </div>
<?php
    }
?>
<?php
    if (($product_info['products_image_sm_4'] != '') && ($product_info['products_image_xl_4'] != '')) {
?>
            <div id="image_div4" style="display:none;"<?php echo $add_img_zoom; ?>>
            <?php echo '<a href="' . DIR_WS_IMAGES . $product_info['products_image_xl_4'] . '" onclick="return viewer.show(4)">' . tep_image(HTTPS_SERVER . HTTP_COOKIE_PATH . DIR_WS_IMAGES . $product_info['products_image_sm_4'], DIR_WS_IMAGES . $product_info['products_image_xl_4'], $image_width, $image_height, 'hspace="1" vspace="1" ') . '</a>'; 
			echo '<br>' . TEXT_ONMOUSEROVER_TO_ZOOM;

			echo '<br><a href="' . DIR_WS_IMAGES . $product_info['products_image_xl_4'] . '" onclick="return viewer.show(0)">' . TEXT_CLICK_TO_VIEW_LARGE . '</a><br><br>';
			?>
            </div>
<?php
    }
?>
<?php
    if (($product_info['products_image_sm_5'] != '') && ($product_info['products_image_xl_5'] != '')) {
?>
            <div id="image_div5" style="display:none;"<?php echo $add_img_zoom; ?>>

            <?php echo '<a href="' . DIR_WS_IMAGES . $product_info['products_image_xl_5'] . '" onclick="return viewer.show(5)">' . tep_image(HTTPS_SERVER . HTTP_COOKIE_PATH . DIR_WS_IMAGES . $product_info['products_image_sm_5'], DIR_WS_IMAGES . $product_info['products_image_xl_5'], $image_width, $image_height, 'hspace="1" vspace="1" ') . '</a>'; 
			echo '<br>' . TEXT_ONMOUSEROVER_TO_ZOOM;

			echo '<br><a href="' . DIR_WS_IMAGES . $product_info['products_image_xl_5'] . '" onclick="return viewer.show(0)">' . TEXT_CLICK_TO_VIEW_LARGE . '</a><br><br>';
			?>
            </div>
<?php
    }
?>
<?php
    if (($product_info['products_image_sm_6'] != '') && ($product_info['products_image_xl_6'] != '')) {
?>
            <div id="image_div6" style="display:none;"<?php echo $add_img_zoom; ?>>
            <?php echo '<a href="' . DIR_WS_IMAGES . $product_info['products_image_xl_6'] . '" onclick="return viewer.show(6)">' . tep_image(HTTPS_SERVER . HTTP_COOKIE_PATH . DIR_WS_IMAGES . $product_info['products_image_sm_6'], DIR_WS_IMAGES . $product_info['products_image_xl_6'], $image_width, $image_height, 'hspace="1" vspace="1" class="jqzoom" ') . '</a>'; 
			echo '<br>' . TEXT_ONMOUSEROVER_TO_ZOOM;

			echo '<br><a href="' . DIR_WS_IMAGES . $product_info['products_image_xl_6'] . '" onclick="return viewer.show(0)">' . TEXT_CLICK_TO_VIEW_LARGE . '</a><br><br>';
			?>
            </div>
<?php
    }
?>            
            </div>

			<script src="scripts/easyzoom/dist/easyzoom.js"></script>
			<script>
				// Instantiate EasyZoom instances
				var $easyzoom = $('.easyzoom').easyZoom();

				// Setup thumbnails example
				var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

				$('.thumbnails').on('click', 'a', function(e) {
					var $this = $(this);

					e.preventDefault();

					// Use EasyZoom's `swap` method
					api1.swap($this.data('standard'), $this.attr('href'));
				});

				// Setup toggles example
				var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

				$('.toggle').on('click', function() {
					var $this = $(this);

					if ($this.data("active") === true) {
						$this.text("Switch on").data("active", false);
						api2.teardown();
					} else {
						$this.text("Switch off").data("active", true);
						api2._init();
					}
				});
			</script>

						</td>

					</tr>

				</table>

				<table border="0" cellspacing="0" cellpadding="0" align="center">

					<tr>

						<?php

						if (($product_info['products_image'] != '') && ($product_info['products_image_lrg'] != '') && ($product_info['products_image_sm_1'] != '') && ($product_info['products_image_xl_1'] != '')) {

							?>

							<td align="center">

								<span onMouseOver="HideDIV('initDiv');HideDIV('image_div1');HideDIV('image_div2');HideDIV('image_div3');HideDIV('image_div4');HideDIV('image_div5');HideDIV('image_div6');DisplayDIV('image_div')" onMouseOut="HideDIV('initDiv');DisplayDIV('image_div')" style="cursor:pointer">

									<?php echo tep_image(DIR_WS_IMAGES . $product_info['products_image'], addslashes($product_info['products_name']), ULT_THUMB_IMAGE_WIDTH, ULT_THUMB_IMAGE_HEIGHT, 'hspace="1" vspace="1"'); ?>

								</span>

							</td>

						<?php

					}

					?>

						<?php

						if (($product_info['products_image_sm_1'] != '') && ($product_info['products_image_xl_1'] != '')) {

							?>

							<td align="center">

								<span onMouseOver="HideDIV('initDiv');HideDIV('image_div');HideDIV('image_div2');HideDIV('image_div3');HideDIV('image_div4');HideDIV('image_div5');HideDIV('image_div6');DisplayDIV('image_div1')" onMouseOut="HideDIV('initDiv');DisplayDIV('image_div1')" style="cursor:pointer">

									<?php echo tep_image(DIR_WS_IMAGES . $product_info['products_image_sm_1'], addslashes($product_info['products_name']), ULT_THUMB_IMAGE_WIDTH, ULT_THUMB_IMAGE_HEIGHT, 'hspace="1" vspace="1"'); ?>

								</span>

							</td>

						<?php

					}

					?>

						<?php

						if (($product_info['products_image_sm_2'] != '') && ($product_info['products_image_xl_2'] != '')) {

							?>

							<td align="center">

								<span onMouseOver="HideDIV('initDiv');HideDIV('image_div');HideDIV('image_div1');HideDIV('image_div3');HideDIV('image_div4');HideDIV('image_div5');HideDIV('image_div6');DisplayDIV('image_div2')" onMouseOut="HideDIV('initDiv');DisplayDIV('image_div2')" style="cursor:pointer">

									<?php echo tep_image(DIR_WS_IMAGES . $product_info['products_image_sm_2'], addslashes($product_info['products_name']), ULT_THUMB_IMAGE_WIDTH, ULT_THUMB_IMAGE_HEIGHT, 'hspace="1" vspace="1"'); ?>

								</span>

							</td>

						<?php

					}

					?>

						<?php

						if (($product_info['products_image_sm_3'] != '') && ($product_info['products_image_xl_3'] != '')) {

							?>

							<td align="center">

								<span onMouseOver="HideDIV('initDiv');HideDIV('image_div');HideDIV('image_div2');HideDIV('image_div1');HideDIV('image_div4');HideDIV('image_div5');HideDIV('image_div6');DisplayDIV('image_div3')" onMouseOut="HideDIV('initDiv');DisplayDIV('image_div3')" style="cursor:pointer">

									<?php echo tep_image(DIR_WS_IMAGES . $product_info['products_image_sm_3'], addslashes($product_info['products_name']), ULT_THUMB_IMAGE_WIDTH, ULT_THUMB_IMAGE_HEIGHT, 'hspace="1" vspace="1"'); ?>

								</span>

							</td>

						<?php

					}

					?>
					</tr>

				</table>

				<table border="0" cellspacing="0" cellpadding="0" align="center">

					<tr>
						<?php

						if (($product_info['products_image_sm_4'] != '') && ($product_info['products_image_xl_4'] != '')) {

							?>

							<td align="center">

								<span onMouseOver="HideDIV('initDiv');HideDIV('image_div');HideDIV('image_div2');HideDIV('image_div3');HideDIV('image_div1');HideDIV('image_div5');HideDIV('image_div6');DisplayDIV('image_div4')" onMouseOut="HideDIV('initDiv');DisplayDIV('image_div4')" style="cursor:pointer">

									<?php echo tep_image(DIR_WS_IMAGES . $product_info['products_image_sm_4'], addslashes($product_info['products_name']), ULT_THUMB_IMAGE_WIDTH, ULT_THUMB_IMAGE_HEIGHT, 'hspace="1" vspace="1"'); ?>

								</span>

							</td>

						<?php

					}

					?>

						<?php

						if (($product_info['products_image_sm_5'] != '') && ($product_info['products_image_xl_5'] != '')) {

							?>

							<td align="center">

								<span onMouseOver="HideDIV('initDiv');HideDIV('image_div');HideDIV('image_div2');HideDIV('image_div3');HideDIV('image_div4');HideDIV('image_div1');HideDIV('image_div6');DisplayDIV('image_div5')" onMouseOut="HideDIV('initDiv');DisplayDIV('image_div5')" style="cursor:pointer">

									<?php echo tep_image(DIR_WS_IMAGES . $product_info['products_image_sm_5'], addslashes($product_info['products_name']), ULT_THUMB_IMAGE_WIDTH, ULT_THUMB_IMAGE_HEIGHT, 'hspace="1" vspace="1"'); ?>

								</span>

							</td>

						<?php

					}

					?>

						<?php

						if (($product_info['products_image_sm_6'] != '') && ($product_info['products_image_xl_6'] != '')) {

							?>

							<td align="center">

								<span onMouseOver="HideDIV('initDiv');HideDIV('image_div');HideDIV('image_div2');HideDIV('image_div3');HideDIV('image_div4');HideDIV('image_div5');HideDIV('image_div1');DisplayDIV('image_div6')" onMouseOut="HideDIV('initDiv');DisplayDIV('image_div6')" style="cursor:pointer">

									<?php echo tep_image(DIR_WS_IMAGES . $product_info['products_image_sm_6'], addslashes($product_info['products_name']), ULT_THUMB_IMAGE_WIDTH, ULT_THUMB_IMAGE_HEIGHT, 'hspace="1" vspace="1"'); ?>

								</span>

							</td>

						<?php

					}

					?>

					</tr>

				</table>

				</div>

			</td>

		<?php

	}

	?>

		<!-- pictures eof -->
		<td width="5%" valign="top">&nbsp;

		</td>
		<td valign="top" align="right">
			<?php

			if (($product_info['products_quantity'] > 0) || (($product_info['products_quantity'] <= 0) && ($product_info['products_qtd_stock_status'] == '1'))) {

				echo tep_draw_form('cart_quantity', tep_href_link(FILENAME_PRODUCT_INFO, tep_get_all_get_params(array('action')) . 'action=add_product'), 'post', 'enctype="multipart/form-data"');
			}

			?>
			<table width="80%" border="0" cellspacing="0" cellpadding="0">

				<tr>

					<td valign="top">
						<?php

						if ($_GET['added_cart'] == 'true') {

							?>

							<table width="100%" border="0" cellspacing="0" cellpadding="0">

								<tr>

									<td class="main">

										<span style="color:#FF0000; font-size:18px;">
											<blink><?php echo TEXT_ADDED_CART_SUCCESS; ?></blink>
										</span>

										<br />

										<?php echo '<a href="' . tep_href_link(FILENAME_SHOPPING_CART) . '">' . TEXT_GO_TO_SHOPPING_CART . '</a>'; ?>

									</td>

								</tr>

								<tr>

									<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>

								</tr>

							</table>

						<?php

					}

					?>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							

			<?php
			if (ENABLE_PRODUCTS_LIKES == "true"){
			//if (tep_session_is_registered('customer_id')) {
			?>
                    <!-- likes -->
                      <tr>
                        <td class="SmallText">
						<?php
						// likes
						if (tep_session_is_registered('customer_id')) {
							$check_add_like_query = tep_db_query("select * from " . TABLE_PRODUCTS_LIKE_TRACK . " where products_id = '" . (int)$product_info["products_id"] . "' and customer_id = '" . (int)$customer_id . "' ");
							$str_like = "like";
							if (tep_db_num_rows($check_add_like_query) > 0) {
							$str_like = "unlike";
							}
							$add_likes_box = '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="demo-table">
							<tbody>
							<tr>
							<td align="default" width="100%" valign="top">
							<div id="prod-'.$product_info["products_id"].'">
							<input type="hidden" id="likes-'.$product_info["products_id"].'" value="'.$product_info["likes"].'">
							<div class="btn-likes"><input type="button" title="'.ucwords(ENTRY_TEXT_ILIKE).'" class="'.$str_like.'" onClick="addLikes('.$product_info["products_id"].',\''.$str_like.'\')" /></div>
							<div class="label-likes">'.($product_info["likes"] > 0 ? $product_info["likes"] . ' ' . ENTRY_TEXT_LIKES : '').'</div>
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
							<div id="prod-'.$product_info["products_id"].'">
							<input type="hidden" id="likes-'.$product_info["products_id"].'" value="'.$product_info["likes"].'">
							<div class="btn-likes"><input type="button" title="'.ucwords(ENTRY_TEXT_HOW_TO_LIKE).'" class="'.$str_like.'" /></div>
							<div class="label-likes">'.($product_info["likes"] > 0 ? $product_info["likes"] . ' ' . ENTRY_TEXT_LIKES : '').'</div>
							</div>
							</td>
							</tr>
							</tbody>
							</table>
							';
						}
						echo $add_likes_box;
						// likes eof
						?>
						</td>
                      </tr>
                      <tr>
                        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
                      </tr>	
                    <!-- likes eof -->
			<?php
			//}
			}
			?>
				
              <?php

							/*

if ( ( (CUSTOMER_VIEW_PRODUCT_LOGIN_OR_CREATE_ACCOUNT_VIEW_PRICE == 'true') && (tep_session_is_registered('customer_id')) ) || (CUSTOMER_VIEW_PRODUCT_LOGIN_OR_CREATE_ACCOUNT_VIEW_PRICE != 'true') ) {

if ( ($product_info['products_quantity'] > 0) || ( ($product_info['products_quantity'] <= 0) && ($product_info['products_qtd_stock_status'] == '1') ) ) {

				  if ($product_info['view_price'] == 0) {

				  ?>

							<!-- price -->

							<tr>

								<td class="SmallText">

									<?php 

					if (ENABLE_FAKE_SPECIAL_PRICE_ALL_PRODUCTS == 'true') {

					if (!tep_get_products_special_price($product_info['products_id'])) {

					$percentage_add = PERCENTAGE_FAKE_SPECIAL_PRICE_ALL_PRODUCTS;

					$price_to_add = round( ($percentage_add/100)*$product_info['products_price'], 0 );

					$new_price_add = $product_info['products_price'] + $price_to_add;

					echo TEXT_PRICE_PRODUCT_FROM . "<s>" . $currencies->display_price($new_price_add, tep_get_tax_rate($product_info['products_tax_class_id'])) . "</s>";

					}

					}

					?>

									<?php echo $products_price; ?>

									<?php

					if ($itemdropprice = tep_get_products_special_price($product_info['products_id'])) {

						$itemdropprice_ok = $currencies->display_price($itemdropprice, tep_get_tax_rate($product_info['products_tax_class_id']));

					} else {

						$itemdropprice = $product_info['products_price'];

						$itemdropprice_ok = $currencies->display_price($itemdropprice, tep_get_tax_rate($product_info['products_tax_class_id']));

					}

					if (($language == 'portugues') && ($currency == 'BRL')) {

					$replace_currencies_itemdrop = array("R$", ".");

					$products_price_itemdrop = str_replace($replace_currencies_itemdrop, "", $itemdropprice_ok);

					}else{

					$replace_currencies_itemdrop = array("$", "¢", "€", "Gs", "S/.", "RD ", "£", "R", "Bs. F.");

					$products_price_itemdrop = str_replace($replace_currencies_itemdrop, "", $itemdropprice_ok);

					}

					?>

									<meta itemprop="price" content="<?php echo $products_price_itemdrop; ?>" />

									<meta itemprop="currency" content="<?php echo DEFAULT_CURRENCY; ?>" />

								</td>

							</tr>

							<tr>

								<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td>

							</tr>
							<?php

// ot_quantity_discount 20170908

if ($product_price_otqdu_ok != "") {

?>

							<tr>

								<td class="SmallText"><a href="javascript:workforchange('ppotqdu2','changerpotqdu2','<?php echo TEXT_HOW_TO_GET_MORE_DISCOUNTS_ORDER; ?>','<?php echo TEXT_HOW_TO_GET_MORE_DISCOUNTS_ORDER; ?>');" id='changerpotqdu2'><?php echo TEXT_HOW_TO_GET_MORE_DISCOUNTS_ORDER; ?></a>

									<span id='ppotqdu2' style='display:none'><br><?php echo $product_price_otqdu_ok; ?></span></td>

							</tr>

							<tr>

								<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>

							</tr>

							<?php

}

// ot_quantity_discount 20170908 eof

?>

							<!-- price eof -->

							<?php

				  }

}

}else{

?>

							<tr>

								<td class="SmallText"><?php echo TEXT_CUSTOMER_CREATE_ACCOUNT_OR_LOGIN_VIEW_PRICE; ?></td>

							</tr>

							<tr>

								<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td>

							</tr>

							<?php

}*/

							?>


							<!-- options -->

							<tr>

								<td class="LargeText">

									<?php
									if (OPTIONS_AS_IMAGES_ENABLED == 'false') {
										echo '<table border="0" cellspacing="0" cellpadding="0">';
										//BOF - Zappo - Option Types v2 - Add extra Option Values to Query && Placed Options in new file: option_types.php

										if (OPTIONS_TYPES_CHOOSE_ORDER_TYPE == "ascname") {

											$add_option_type_choose_order_type = "popt.products_options_name asc, ";
										} elseif (OPTIONS_TYPES_CHOOSE_ORDER_TYPE == "descname") {

											$add_option_type_choose_order_type = "popt.products_options_name desc, ";
										}

										$products_options_name_query = tep_db_query("select distinct popt.products_options_id, popt.products_options_name, popt.products_options_type, popt.products_options_length, popt.products_options_comment from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib where patrib.products_id='" . (int)$product_info['products_id'] . "' and patrib.options_id = popt.products_options_id and popt.language_id = '" . (int)$languages_id . "' order by " . $add_option_type_choose_order_type . " popt.products_options_order, popt.products_options_name");

										while ($products_options_name = tep_db_fetch_array($products_options_name_query)) {
											// - Zappo - Option Types v2 - Include option_types.php - Contains all Option Types, other than the original Drowpdown...

											include(DIR_WS_MODULES . 'option_types.php');
											if ($Default == true) {  // - Zappo - Option Types v2 - Default action is (standard) dropdown list. If something is not correctly set, we should always fall back to the standard.

												if (OPTIONS_TYPES_CHOOSE_ORDER_TYPE == "ascname") {

													$add_option_type_choose_order_typev = "pov.products_options_values_name asc, ";
												} elseif (OPTIONS_TYPES_CHOOSE_ORDER_TYPE == "descname") {

													$add_option_type_choose_order_typev = "pov.products_options_values_name desc, ";
												}

												$products_options_array = array();

												$products_options_query = tep_db_query("select pov.products_options_values_id, pov.products_options_values_name, pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov where pa.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and pa.options_id = '" . (int)$ProdOpt_ID . "' and pa.options_values_id = pov.products_options_values_id and pov.language_id = '" . (int)$languages_id . "' order by " . $add_option_type_choose_order_typev . " pa.products_options_sort_order, pov.products_options_values_name asc");

												while ($products_options = tep_db_fetch_array($products_options_query)) {

													$products_options_array[] = array('id' => $products_options['products_options_values_id'], 'text' => $products_options['products_options_values_name']);

													if ($products_options['options_values_price'] != '0') {

														$products_options_array[sizeof($products_options_array) - 1]['text'] .= ' (' . $products_options['price_prefix'] . $currencies->display_price($products_options['options_values_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) . ') ';
													}
												}
												if (isset($cart->contents[$HTTP_GET_VARS['products_id']]['attributes'][$products_options_name['products_options_id']])) {

													$selected_attribute = $cart->contents[$HTTP_GET_VARS['products_id']]['attributes'][$products_options_name['products_options_id']];
												} else {

													$selected_attribute = false;
												}

												?>

										<tr>

											<td class="main" align="right"><?php echo $ProdOpt_Name . ':'; ?> </td>

											<td class="main"><?php echo tep_draw_pull_down_menu('id[' . $ProdOpt_ID . ']', $products_options_array, $selected_attribute, ' style="width:100%; height:3em; padding:5px;" ') . ' &nbsp; ' . $ProdOpt_Comment;  ?></td>

										</tr>

									<?php

								} // End if Default=true

							}


							echo '</table>';
							//EOF - Zappo - Option Types v2 - Add extra Option Values to Query && Placed Options in new file: option_types.php
							echo tep_draw_hidden_field('number_of_uploads', $number_of_uploads);
						} else {
							include('options_images.php');
						}
						//Display a table with which attributecombinations is on stock to the customer?

						if (PRODINFO_ATTRIBUTE_DISPLAY_STOCK_LIST == 'True') : require(DIR_WS_MODULES . "qtpro_stock_table.php");
						endif;
						?>
					</td>

				</tr>

				<!-- options eof -->
				<?php

				if (($product_info['products_quantity'] > 0) || (($product_info['products_quantity'] <= 0) && ($product_info['products_qtd_stock_status'] == '1'))) {

					if ($product_info['products_free_shipping'] == '1') {
						if ((DEFAULT_CURRENCY == $currency) && (FREE_SHIPPING_TO_ALL_COUNTRIES == "national")) {

							$show_free_shipping_button = 'true';
							if (FREE_SHIPPING_TO_ALL_COUNTRIES_ESTADOS != '') {

								$text_free_shipping_estados = ' ' . str_replace(",", ", ", FREE_SHIPPING_TO_ALL_COUNTRIES_ESTADOS);
							}
						} elseif (FREE_SHIPPING_TO_ALL_COUNTRIES == "both") {

							$show_free_shipping_button = 'true';
						} elseif ((DEFAULT_CURRENCY == $currency) && (FREE_SHIPPING_TO_ALL_COUNTRIES == "international")) {

							$show_free_shipping_button = 'true';
						}

						if ($show_free_shipping_button == 'true') {

							?>

							<tr>

								<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>

							</tr>

							<tr>

								<td class="SmallText"><?php echo tep_image_button('button_free_shipping.gif', FREE_SHIPPING_FOR_THIS_PRODUCT . $text_free_shipping_estados, ' align="absmiddle"') . '<small>' . $text_free_shipping_estados . '</small>'; ?>

								</td>

							</tr>

							<tr>

								<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>

							</tr>

						<?php

					}
				}
			}

			?>
				<!-- marketplace -->

				<?php

				if (ENABLE_MARKETPLACE == 'true' && STATUS_MARKETPLACE == 'true') {

					if ($product_info['seller_member_id'] == '') {

						?>

						<tr>

							<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>

						</tr>

						<tr>

							<td class="pp_product_manufacturer">

								<?php

								echo ENTRY_PRODUCT_SOLD_BY_SELLER_MARKETPLACE;

								echo STORE_NAME;

								?>

							</td>

						</tr>

						<?php

						if (MARKEPLACE_PRODUCTS_DISPLAY_SELLER_PRODUCT_SHIPPING_FROM == "true") {

							if ($product_info['seller_country_shipping_id'] != "" && $product_info['seller_zone_shipping_id'] != ""){
							if (is_numeric($product_info['seller_zone_shipping_id'])){
								$add_seller_zone_shipping_id = " and z.zone_id = '" . (int)$product_info['seller_zone_shipping_id'] . "' ";
							}else{
								$add_seller_zone_shipping_id = " and z.zone_name = '" . $product_info['seller_zone_shipping_id'] . "' ";
							}
							$check_zones_query_raw = "select z.zone_id, c.countries_id, c.countries_name, z.zone_name, z.zone_code, z.zone_country_id from " . TABLE_ZONES . " z, " . TABLE_COUNTRIES . " c where z.zone_country_id = c.countries_id and c.countries_id = '" . (int)$product_info['seller_country_shipping_id'] . "' " . $add_seller_zone_shipping_id;
							}else{
							$check_zones_query_raw = "select z.zone_id, c.countries_id, c.countries_name, z.zone_name, z.zone_code, z.zone_country_id from " . TABLE_ZONES . " z, " . TABLE_COUNTRIES . " c where z.zone_country_id = c.countries_id and c.countries_id = '" . (int)STORE_COUNTRY . "' and z.zone_id = '" . (int)STORE_ZONE . "' ";
							}

							$check_zones_query = tep_db_query($check_zones_query_raw);

							$check_zones = tep_db_fetch_array($check_zones_query);

							if ($check_zones['zone_name'] != "") {

								?>

								<tr>

									<td class="SmallText">

										<?php

										echo ENTRY_SELLER_SHIPPING_FROM;
										echo $check_zones['zone_name'];

										echo " - ";

										echo $check_zones['countries_name'];

										?>

									</td>

								</tr>

							<?php

						}
					}

					?>

					<?php

				} elseif ($product_info['seller_member_id'] != '') {

					?>

						<tr>

							<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>

						</tr>

						<tr>

							<td class="pp_product_manufacturer">

								<?php

								echo ENTRY_PRODUCT_SOLD_BY_SELLER_MARKETPLACE;
								$check_seller_query = tep_db_query( "select c.seller_name, a.entry_zone_id, a.entry_country_id from " . TABLE_CUSTOMERS . " c left join " . TABLE_ADDRESS_BOOK . " a on c.customers_default_address_id = a.address_book_id where a.customers_id = c.customers_id and c.customers_id = '" . (int)$product_info['seller_member_id'] . "'" );
//								$check_seller_query = tep_db_query("select seller_name from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$product_info['seller_member_id'] . "'");

								$check_seller = tep_db_fetch_array($check_seller_query);

								echo '<a href="' . tep_href_link(FILENAME_DEFAULT, 'seller_id=' . $product_info['seller_member_id']) . '">' . $check_seller['seller_name'] . '</a>';

								?>

							</td>

						</tr>

						<?php

						if (MARKEPLACE_PRODUCTS_DISPLAY_SELLER_PRODUCT_SHIPPING_FROM == "true") {

							if ($product_info['seller_country_shipping_id'] != "" && $product_info['seller_zone_shipping_id'] != ""){
							if (is_numeric($product_info['seller_zone_shipping_id'])){
								$add_seller_zone_shipping_id = " and z.zone_id = '" . (int)$product_info['seller_zone_shipping_id'] . "' ";
							}else{
								$add_seller_zone_shipping_id = " and z.zone_name = '" . $product_info['seller_zone_shipping_id'] . "' ";
							}
							$check_zones_query_raw = "select z.zone_id, c.countries_id, c.countries_name, z.zone_name, z.zone_code, z.zone_country_id from " . TABLE_ZONES . " z, " . TABLE_COUNTRIES . " c where z.zone_country_id = c.countries_id and c.countries_id = '" . (int)$product_info['seller_country_shipping_id'] . "' " . $add_seller_zone_shipping_id;
							}else{
							$check_zones_query_raw = "select z.zone_id, c.countries_id, c.countries_name, z.zone_name, z.zone_code, z.zone_country_id from " . TABLE_ZONES . " z, " . TABLE_COUNTRIES . " c where z.zone_country_id = c.countries_id and c.countries_id = '" . (int)$check_seller['entry_country_id'] . "' and z.zone_id = '" . (int)$check_seller['entry_zone_id'] . "' ";
							}

							$check_zones_query = tep_db_query($check_zones_query_raw);

							$check_zones = tep_db_fetch_array($check_zones_query);

							if ($check_zones['zone_name'] != "") {

								?>

								<tr>

									<td class="SmallText">

										<?php

										echo ENTRY_SELLER_SHIPPING_FROM;
										echo $check_zones['zone_name'];

										echo " - ";

										echo $check_zones['countries_name'];

										?>

									</td>

								</tr>

							<?php

						}
					}

					?>			  
					  <?php
					  if (ENABLE_CUSTOMERS_FOLLOW_SELLER == "true"){		  
					  ?>
					  <tr>
						<td class="SmallText">
						<?php
						// followers
						if (tep_session_is_registered('customer_id')) {			
							$check_add_follow_query = tep_db_query("select * from " . TABLE_SELLER_FOLLOWERS_TRACK . " where seller_member_id = '" . (int)$product_info['seller_member_id'] . "' and customer_id = '" . (int)$customer_id . "' ");
							$str_follow = "follow";
							if (tep_db_num_rows($check_add_follow_query) > 0) {
							$str_follow = "unfollow";
							}
							$add_follow_box = '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="followdemo-table">
							<tbody>
							<tr>
							<td align="default" class="SmallText" width="100%" valign="middle">
							<div id="seller-'.$product_info['seller_member_id'].'">
							<input type="hidden" id="followers-'.$product_info['seller_member_id'].'" value="'.$check_seller["followers"].'">
							<div class="btn-follows"><input type="button" title="'.ucwords(ENTRY_TEXT_IFOLLOW).'" class="'.$str_follow.'" onClick="addFollows('.$product_info['seller_member_id'].',\''.$str_follow.'\')" /></div>
							<div class="label-follows">'.($check_seller["followers"] > 0 ? $check_seller["followers"] . ' ' . ENTRY_TEXT_FOLLOWS : '').'</div>
							</div>
							</td>
							</tr>
							</tbody>
							</table>
							';
						}else{
							$str_follow = "follow";
							$add_follow_box = '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="followdemo-table">
							<tbody>
							<tr>
							<td align="default" width="100%" valign="top">
							<div id="seller-'.$product_info['seller_member_id'].'">
							<input type="hidden" id="followers-'.$product_info['seller_member_id'].'" value="'.$check_seller["followers"].'">
							<div class="btn-follows"><input type="button" title="'.ucwords(ENTRY_TEXT_HOW_TO_FOLLOW).'" class="'.$str_follow.'" /></div>
							<div class="label-follows">'.($check_seller["followers"] > 0 ? $check_seller["followers"] . ' ' . ENTRY_TEXT_FOLLOWS : '').'</div>
							</div>
							</td>
							</tr>
							</tbody>
							</table>
							';
						}
						echo $add_follow_box;
						// followers eof
						?>
						</td>
					  </tr>	  
					  <?php
					  } // end if (ENABLE_CUSTOMERS_FOLLOW_SELLER == "true"){		  
					  ?>

						<?php

						$new_reviews_seller_ld = " and (date_added > date_sub(NOW(), interval 90 day)) ";

						$get_reviews_seller_query = tep_db_query("select * from " . TABLE_REVIEWS . " where seller_member_id = '" . (int)$product_info['seller_member_id'] . "' " . $new_reviews_seller_ld . " ");

						$rs = 0;

						$num_check_reviews_seller = tep_db_num_rows($get_reviews_seller_query);

						if ($num_check_reviews_seller > 0) {

							?>

							<tr>

								<td class="SmallText" style="padding-top: 4px;">

									<?php

									while ($get_reviews_seller = tep_db_fetch_array($get_reviews_seller_query)) {

										$reviews_rating_array[] = $get_reviews_seller['reviews_rating'];

										$rs++;
									}

									$average_reviews_rating = array_sum($reviews_rating_array) / count($reviews_rating_array);

									echo tep_image(DIR_WS_IMAGES . 'stars_' . ceil($average_reviews_rating) . '.gif', sprintf(TEXT_OF_5_STARS, ceil($average_reviews_rating))) . " " . $rs . " " . TEXT_SELLER_REVIEWS;

									?>

								</td>

							</tr>

						<?php

					}
				}
			}

			// marketplace eof

			?>

				<!-- marketplace eof -->
				<!-- product quantity -->

				<?php

				if (ENABLE_PRODUCTS_QUANTITY_DISPLAY_PRODUCT_PAGE == "true") {

					if ($product_info['products_quantity'] > 0) {

						?>

						<tr>

							<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td>

						</tr>

						<tr>

							<td class="LargeText">

								<?php

								if ($product_info['products_quantity'] == 1) {

									echo $product_info['products_quantity'] . " " . TEXT_AVALIABLE_IN_STOCK;
								} else {

									echo $product_info['products_quantity'] . " " . TEXT_AVALIABLE_IN_STOCK1;
								}

								?>

							</td>

						</tr>

					<?php

				}
			}

			?>

				<!-- product quantity eof -->
				<!-- button buy -->

				<?php

				if (((CUSTOMER_VIEW_PRODUCT_LOGIN_OR_CREATE_ACCOUNT_VIEW_PRICE == 'true') && (tep_session_is_registered('customer_id'))) || (CUSTOMER_VIEW_PRODUCT_LOGIN_OR_CREATE_ACCOUNT_VIEW_PRICE != 'true')) {

					//if ($product_info['products_quantity'] > 0) {
					if ($product_info['products_quantity'] > $product_info['order_minimum_qty']) {

						$order_minimum_qty = $product_info['order_minimum_qty'];
					} else {

						$order_minimum_qty = $product_info['products_quantity'];
					}
					$check_seller_account_query = tep_db_query("select seller_feed_url_redirect from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$product_info['seller_member_id'] . "'");
					$check_seller_account = tep_db_fetch_array($check_seller_account_query);

					if ($check_seller_account['seller_feed_url_redirect'] == '1' && $product_info['seller_member_url'] != "") {

						?>

						<tr>

							<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>

						</tr>

						<tr>

							<td class="LargeText">

								<?php

								echo ' <a href="' . tep_href_link(FILENAME_REDIRECT, 'action=product&goto=' . $product_info['products_id']) . '" target="_blank">' . tep_image_button('button_go_to_shop.gif', $products_name) . '</a>';

								?>

							</td>

						</tr>

					<?php

				} elseif (($product_info['view_price'] == 1) || (($product_info['products_quantity'] <= 0) && ($product_info['products_qtd_stock_status'] == '0')) || (($product_info['products_quantity'] <= 0) && ($product_info['products_qtd_stock_status'] == '')) || (($product_info['products_quantity'] <= 0) && ($product_info['products_qtd_stock_status'] == '2')) || (($product_info['products_quantity'] <= 0) && ($product_info['products_qtd_stock_status'] == '3'))) {

					?>

						<tr>

							<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td>

						</tr>

						<tr>

							<td class="LargeText">

								<?php

								echo ' <a href="' . tep_href_link(FILENAME_PRODUCT_CONTACT, 'products_id=' . $product_info['products_id']) . '" class="fancybox fancybox.iframe">' . tep_image_button('button_contact_large.gif', $products_name) . '</a>';

								?>

							</td>

						</tr>

					<?php

				} else {

					?>

						<tr>

							<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td>

						</tr>

						<tr>

							<td class="LargeText">

								<?php

								if ($registry_mode_id == 0) {
									if ($order_minimum_qty <= "0") {

										$order_minimum_qty = "1";
									}
									echo tep_draw_input_field('cart_quantity', $order_minimum_qty, ' style="width:5%;" maxlength="5" ') . ' ' . tep_draw_hidden_field('category_id', tep_get_category_id($cPath)) . tep_draw_hidden_field('products_id', $product_info['products_id']) . tep_image_submit('button_in_cart.gif', IMAGE_BUTTON_IN_CART, '  align="absmiddle" ');
								} else {
									echo tep_draw_hidden_field('products_quantity_registry', $order_minimum_qty) . tep_draw_hidden_field('products_id', $product_info['products_id']) . tep_image_submit('button_add_to_registry.gif', IMAGE_BUTTON_ADD_TO_REGISTRY, 'name="submit_registry"');
								}

								?>

							</td>

						</tr>

						<?php
						// extra info page ajax / buy guaranteed
						if ($registry_mode_id == 0) {
							if (ID_EXTRA_INFO_PAGES_BUY_GUARANTEED != "") {

								$infopageid1 = (int)ID_EXTRA_INFO_PAGES_BUY_GUARANTEED;
								$page1_query = tep_db_query("select p.pages_id, p.status, s.pages_title, s.pages_html_text from " . TABLE_PAGES . " p LEFT JOIN " . TABLE_PAGES_DESCRIPTION . " s on p.pages_id = s.pages_id where s.language_id = '" . (int)$languages_id . "' and p.pages_id = $infopageid1");
								$page1_check = tep_db_fetch_array($page1_query);
								if ($page1_check['pages_title'] != "" && $page1_check['pages_html_text'] != "") {
									?>
									<tr>
										<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td>
									</tr>
									<tr>
										<td class="LargeText">
											<?php
											if (ICON_BUY_GUARANTEED != "") {
												echo '<a href="' . tep_href_link(FILENAME_EIP_AJAX, 'apages_id=' . $page1_check['pages_id']) . '" class="fancybox fancybox.iframe">' . tep_image(DIR_WS_IMAGES . ICON_BUY_GUARANTEED, $page1_check['pages_title'], '', '', ' align="middle" ') . "</a> ";
											}
											echo '<a href="' . tep_href_link(FILENAME_EIP_AJAX, 'apages_id=' . $page1_check['pages_id']) . '" class="fancybox fancybox.iframe">' . $page1_check['pages_title'] . "</a>";
											?>
										</td>
									</tr>
								<?php
							} // end if ($page1_check['pages_title'] != "" && $page1_check['pages_html_text'] != "") {
						} // end if (ID_EXTRA_INFO_PAGES_BUY_GUARANTEED != ""){
					} // end if($registry_mode_id == 0){
					// extra info page ajax / buy guaranteed eof
					?>

					<?php

				}

				//}

			}

			?>

				<!-- button buy eof -->
							
				<!-- button buy from whatsapp -->
				<?php
				if (PRODUCT_LIST_BUY_WHATSAPP == 'true' && empty($product_info['button_buy_whatsapp']) && $product_info['products_quantity'] > 0) {
				?>
					<tr>
						<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
					</tr>
					<tr>
						<td class="LargeText">
						<a href="https://wa.me/<?php echo preg_replace("/[^0-9]/", "",WHATSAPPNUMBER); ?>?text=<?php echo $products_model . " " . utf8_encode($products_name); ?> https://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] . " " . utf8_encode(ENTRY_TEXT_BUY_WHATSAPP); ?>" target="_blank" class="btn_buy_product_whatsapp"><i class="fab fa-whatsapp"></i> <?php echo ENTRY_TEXT_BUY_BUTTON_WHATSAPP; ?></a>
						</td>
					</tr>
				<?php
				} // end if (PRODUCT_LIST_BUY_WHATSAPP == 'true') {
				?>
				<!-- button buy from whatsapp eof -->
				<!-- button custom -->

				<?php

				if ((ENABLE_CUSTOM_SC_ABBUY_PRODUCT_PAGE == 'true') && (CUSTOM_SC_ABBUY_PRODUCT_PAGE != '')) {

					?>

					<tr>

						<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>

					</tr>

					<tr>

						<td class="LargeText">

							<?php

							echo CUSTOM_SC_ABBUY_PRODUCT_PAGE;

							?>

						</td>

					</tr>

				<?php

			}

			?>

				<!-- button custom eof -->
				<!-- sold -->

				<?php

				if (ENABLE_PRODUCTS_ORDERED_DISPLAY_PRODUCT_PAGE == "true") {

					if ($product_info['products_ordered'] > 0) {

						if ($product_info['products_quantity'] > 0) {

							?>

							<tr>

								<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>

							</tr>

							<tr>

								<td class="LargeText">

									<?php

									if ($product_info['products_ordered'] == 1) {

										echo $product_info['products_ordered'] . " " . TEXT_SOLD;
									} else {

										echo $product_info['products_ordered'] . " " . TEXT_SOLD1;
									}

									?>

								</td>

							</tr>

						<?php

					}
				}
			}

			?>

				<!-- sold eof -->
				<!-- order minimum qty -->

				<?php

				if ($product_info['order_minimum_qty'] > 1) {

					if (($product_info['products_quantity'] > 0) || (($product_info['products_quantity'] <= 0) && ($product_info['products_qtd_stock_status'] == '1'))) {

						?>

						<tr>

							<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>

						</tr>

						<tr>

							<td class="LargeText">

								<?php echo TEXT_ORDER_MINIMUM_PRODUCT . ': ' . $product_info['order_minimum_qty']; ?>

							</td>

						</tr>

					<?php

				}
			}

			?>

				<!-- order minimum qty eof -->
				<!-- order maximum qty -->

				<?php

				if ($product_info['order_maximum_qty'] > 0) {

					if (($product_info['products_quantity'] > 0) || (($product_info['products_quantity'] <= 0) && ($product_info['products_qtd_stock_status'] == '1'))) {

						?>

						<tr>

							<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>

						</tr>

						<tr>

							<td class="LargeText">

								<?php echo TEXT_ORDER_MAXIMUM_PRODUCT . ': ' . $product_info['order_maximum_qty']; ?>

							</td>

						</tr>

					<?php

				}
			}

			?>

				<!-- order maximum qty eof -->

				<?php

				if (($product_info['products_quantity'] > 0) || (($product_info['products_quantity'] <= 0) && ($product_info['products_qtd_stock_status'] == '1'))) {

					if ((tep_get_products_special_price($product_info['products_id'])) || ($product_info['products_quantity'] > 0) || (tep_not_null($product_info_expiredate))) {

						?>

						<!-- special expire date  -->

						<tr>

							<td class="pp_product_expire_date"><?php echo $product_info_expiredate; ?></td>

						</tr>

						<tr>

							<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>

						</tr>

						<!-- special expire date eof -->

					<?php

				}
			}

			?>
				<?php

				// stock status

				if ((VIEW_STOCK_STATUS == 'true') && ($product_info['products_quantity'] > 0)) {

					?>

					<tr>

						<td class="pp_product_stock_status">

							<?php

							echo TEXT_AVAILABILITY;

							if (($product_info['products_stock_status'] == '0') || ($product_info['products_stock_status'] == '')) {

								echo TEXT_PRODUCT_DELIVERY_IMMEDIATE;
							} elseif ($product_info['products_stock_status'] == '1') {

								echo TEXT_PRODUCT_SOLD_OUT;
							} elseif ($product_info['products_stock_status'] == '2') {

								echo TEXT_PRODUCT_AVALIABLE_IN . ' ' . $product_info['products_stock_status_avaliable_in'] . ' ' . TEXT_PRODUCT_AVALIABLE_IN_DAYS;
							} elseif ($product_info['products_stock_status'] == '3') {

								echo TEXT_PRODUCT_SOB_CONSULTA;
							}

							?>

						</td>

					</tr>

					<tr>

						<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>

					</tr>

				<?php

			} elseif (VIEW_MESSAGE_OUT_STOCK_PL_PP == 'true') {

				if ($product_info['products_quantity'] <= 0) {

					if (($product_info['products_qtd_stock_status'] == '') || ($product_info['products_qtd_stock_status'] == '0')) {

						?>

							<tr>

								<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>

							</tr>

							<tr>

								<td class="pp_product_stock_status">

									<?php

									echo TEXT_AVAILABILITY;
									echo TEXT_PRODUCT_SOLD_OUT;

									?>

								</td>

							</tr>

							<tr>

								<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td>

							</tr>

							<tr>

								<td><?php include(DIR_WS_BOXES . 'product_notifications.php'); ?></td>

							</tr>
							<tr>

								<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>

							</tr>

						<?php

					} elseif (($product_info['products_qtd_stock_status'] == '3') || ($product_info['products_qtd_stock_status'] == '1')) {

						?>

							<tr>

								<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>

							</tr>

							<tr>

								<td class="pp_product_stock_status">

									<?php

									echo TEXT_AVAILABILITY;

									echo TEXT_PRODUCT_AVALIABLE_IN . ' ' . $product_info['products_qtd_stock_status_avaliable_in'] . ' ' . TEXT_PRODUCT_AVALIABLE_IN_DAYS;

									?>

								</td>

							</tr>

							<?php

							if ($product_info['products_qtd_stock_status'] == '3') {

								?>

								<tr>

									<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td>

								</tr>

								<tr>

									<td><?php include(DIR_WS_BOXES . 'product_notifications.php'); ?></td>

								</tr>
								<tr>

									<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>

								</tr>

							<?php

						}
					}
				}
			}

			// stock status eof

			?>


				<!-- unidade venda -->

				<?php

				if ((VIEW_UNIDADE_VENDA_STATUS == 'true') && ($product_info['uv_id'] != '')) {

					if (($product_info['products_quantity'] > 0) || (($product_info['products_quantity'] <= 0) && ($product_info['products_qtd_stock_status'] == '1'))) {

						if ($product_info['uv_id']) {

							?>

							<tr>

								<td class="pp_product_unidade_venda">

									<?php

									echo TEXT_UV . tep_get_uv_name($product_info['uv_id'], $languages_id)

									?>

								</td>

							</tr>

							<tr>

								<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>

							</tr>

						<?php

					}
				}
			}

			?>

				<!-- unidade venda eof -->
				<!-- date available -->

				<?php

				if ($product_info['products_date_available'] > date('Y-m-d H:i:s')) {

					?>

					<tr>

						<td class="LargeText">

							<?php echo sprintf(TEXT_DATE_AVAILABLE, tep_date_long($product_info['products_date_available'])); ?>

						</td>

					</tr>

				<?php

			}

			?>

				<!-- date available eof -->
			</table>

		</td>

	</tr>

</table>
</td>

</tr>

</table>


<!-- table -->

<table border="0" cellspacing="0" cellpadding="0" align="center">

	<tr>

		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>

	</tr>

	<tr>

		<td valign="top">
			<table border="0" cellspacing="0" cellpadding="2">

				<tr>
					<!-- forma de pagamento -->

					<?php

					if (((CUSTOMER_VIEW_PRODUCT_LOGIN_OR_CREATE_ACCOUNT_VIEW_PRICE == 'true') && (tep_session_is_registered('customer_id'))) || (CUSTOMER_VIEW_PRODUCT_LOGIN_OR_CREATE_ACCOUNT_VIEW_PRICE != 'true')) {

						if (($product_info['products_quantity'] > 0) || (($product_info['products_quantity'] <= 0) && ($product_info['products_qtd_stock_status'] == '1'))) {

							if ($product_info['view_price'] == 0) {

								if (($product_info['parcel_window'] == 1) && ($language == 'portugues') && ($currency == 'BRL')) {

									if (DISPLAY_BUTTOM_PRODUCT_PAGE_HOWTOPAY == 'true') {

										?>

										<td class="smallText">

											<?php

											echo '<a href="' . tep_href_link('parcel.php', 'products_id=' . $HTTP_GET_VARS['products_id']) . '" class="fancybox fancybox.iframe">' . tep_image_button('button_howtopay.gif', TEXT_PAYMENT_METHOD) . '</a>';

											?>

										</td>

										<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>

									<?php

								}
							}
						}
					}
				}

				?>

					<!-- forma de pagamento eof -->
					<!-- lista de desejos -->

					<?php

					if (ENABLE_WISHLIST_STORE == 'True') {

						if ($registry_mode_id == 0) {

							?>

							<td class="LargeText">

								<?php echo tep_image_submit('button_wishlist.gif', '', 'name="wishlist" value="wishlist"'); ?>

							</td>

							<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>

						<?php

					}
				}

				?>

					<!-- lista de desejos eof -->
					<!-- calcula preco frete -->

					<?php

					if ($product_info['seller_member_url'] == "") {

						if (($product_info['products_quantity'] > 0) || (($product_info['products_quantity'] <= 0) && ($product_info['products_qtd_stock_status'] == '1'))) {

							//	if ($product_info['products_free_shipping'] != '1') {

							// calculate shipping price

							if (VIEW_CALCULATE_SHIPPING == 'true') {

								?>

								<td class="smallText">

									<?php echo '<a href="' . tep_href_link(FILENAME_CALCULATE_SHIPPING_PRICE, 'products_id=' . $HTTP_GET_VARS['products_id']) . '" class="fancybox fancybox.iframe">' . tep_image_button('button_calculateshipping.gif', TEXT_CALCULATE_SHIPPING_PRICE) . '</a>'; ?>

								</td>

								<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>

							<?php

						}

						//	}

					}
				}

				?>

					<!-- calcular preco frete -->
					<!-- tire sua duvida -->

					<?php

					if ($product_info['seller_member_url'] == "") {

						?>

						<td class="smallText">

							<?php

							if (($product_info['products_quantity'] > 0) || (($product_info['products_quantity'] <= 0) && ($product_info['products_qtd_stock_status'] == '1'))) {

								echo '<a href="' . tep_href_link(FILENAME_PRODUCT_CONTACT, 'products_id=' . $HTTP_GET_VARS['products_id']) . '" class="fancybox fancybox.iframe">' . tep_image_button('button_askyourquestion.gif', TEXT_ASK_YOUR_QUESTION) . '</a>';
							}

							?>

						</td>

						<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>

					<?php

				}

				?>

					<!-- tire sua duvida -->
					<?php

					if ($product_info['seller_member_url'] == "") {

						if ($product_info['view_price'] == 0) {

							if (($product_info['products_quantity'] > 0) || (($product_info['products_quantity'] <= 0) && ($product_info['products_qtd_stock_status'] == '1'))) {

								if (DISPLAY_PRICE_ALERT_PRODUCT_PAGE == 'true') {

									?>
									<!-- price alert -->

									<td class="smallText">

										<?php

										if (($product_info['products_quantity'] > 0) || (($product_info['products_quantity'] <= 0) && ($product_info['products_qtd_stock_status'] == '1'))) {

											echo '<a href="' . tep_href_link('product_price_alert.php', 'products_id=' . $HTTP_GET_VARS['products_id']) . '" class="fancybox fancybox.iframe">' . tep_image_button('button_price_alert.gif', TEXT_ASK_YOUR_QUESTION) . '</a>';
										} else {

											echo ' <a href="' . tep_href_link('product_price_alert.php', 'products_id=' . $product_info['products_id']) . '" class="fancybox fancybox.iframe">' . tep_image_button('button_price_alert.gif', $products_name) . '</a>';
										}

										?>

									</td>

									<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>

									<!-- price alert -->

								<?php

							}
						}
					}
				}

				?>

				</tr>

			</table>
		</td>

	</tr>

</table>

<!-- table eof -->
<?php

if (($product_info['products_quantity'] > 0) || (($product_info['products_quantity'] <= 0) && ($product_info['products_qtd_stock_status'] == '1'))) {

	?>

	</form>

<?php

}

?>
<?php include(DIR_WS_MODULES . 'optional_related_same_products.php'); ?>
<!-- descriptions -->

<table width="100%" border="0" cellspacing="0" cellpadding="0">

	<tr>

		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>

	</tr>

</table>
<table border="0" cellspacing="10" cellpadding="0" width="100%" style="background:<?php echo CATEGORIES_BACKGROUND; ?>; border-top:<?php echo TABLE_HEADING_BACKGROUND; ?> solid 1px;">

	<tr>

		<td class="smallText" style="font-weight:bold;">
			<div id="tabs">

				<a href="" class="tab" onMouseDown="return event.returnValue = showPanel(this, 'panel1');" id="tab1" onClick="return false;"><?php echo TEXT_DESCRIPTION; ?></a>
				<?php

				if (DISPLAY_YOUTUBE_VIDEO_IN_DESCRIPTION == 'false') {

					if (!empty($product_info['products_youtube'])) {

						?>

						|

						<a href="" class="tab" onMouseDown="return event.returnValue = showPanel(this, 'panel3');" onClick="return false;"><?php echo TEXT_VIDEO; ?></a>

					<?php

				}
			}

			?>
				<?php

				// FAQ

				if (VIEW_FAQ_PRODUCT_PAGE == 'true') {

					?>

					|

					<a href="faq_ajax.php" class="fancybox fancybox.iframe"><?php echo TEXT_PERGUNTAS_FREQUENTES; ?></a>

				<?php

			}

			// FAQ eof

			?>
				<?php

				$reviews_query = tep_db_query("select count(*) as count from " . TABLE_REVIEWS . " r, " . TABLE_REVIEWS_DESCRIPTION . " rd where r.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and r.reviews_id = rd.reviews_id and rd.languages_id = '" . (int)$languages_id . "'");

				$reviews = tep_db_fetch_array($reviews_query);

				?>

				| <a href="" class="tab" onMouseDown="return event.returnValue = showPanel(this, 'panel4');" onClick="return false;"><?php echo TEXT_CURRENT_REVIEWS . ' ' . $reviews['count']; ?></a>

			</div>
		</td>

	</tr>

</table>
<div class="panel" id="panel1" style="display: block">

	<table width="100%" border="0" cellspacing="0" cellpadding="0">

		<tr>

			<td class="smallText">
				<?php

				if ((tep_not_null($product_mp3['folder'])) && (ENTRY_OSCP_POPUP == 'false') && (file_exists(DIR_FS_CATALOG_MP3 . $product_mp3['folder'])) && (is_dir(DIR_FS_CATALOG_MP3 . $product_mp3['folder']))) {

					?>

					<table border="0" width="100%" cellspacing="0" cellpadding="0">

						<tr>

							<td valign="top" class="smallText">

								<?php if ($product_info['upc'] != '') { ?><?php echo "UPC: " . $product_info['upc']; ?><br><?php } ?>

								<?php if ($product_info['isbn'] != '') { ?><?php echo "ISBN: " . $product_info['isbn']; ?><br><?php } ?>

								<?php /*if ($product_info['gtin_ean'] != '') { ?><?php echo "GTIN/EAN: ".$product_info['gtin_ean']; ?><br><?php }*/ ?>

								<p itemprop="description"><?php echo stripslashes($product_info['products_description']); ?></p>

							</td>

							<td width="200" valign="top">

								<table border="0" width="200" cellspacing="0" cellpadding="0" align="right">

									<tr>

										<td><?php echo '<object type="application/x-shockwave-flash" data="osc_player.swf?mp3id=' . $HTTP_GET_VARS['products_id'] . '&autoplay=' . ENTRY_OSCP_PLAY . '" width="193" height="265"><param name="scale" value="exactfit" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><param name="movie" value="osc_player.swf?mp3id=' . $HTTP_GET_VARS['products_id'] . '&autoplay=' . ENTRY_OSCP_PLAY . '"/><a href=http://www.macromedia.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash  target="blank"><img src="images/icons/noflash.gif" width="88" height="31" vspace="5" hspace="50" alt="install flash player plugin"/></a></object>'; ?></td>

									</tr>

								</table>

							</td>

						</tr>

					</table>

				<?php

			} else {

				?>

					<?php if ($product_info['upc'] != '') { ?><?php echo "UPC: " . $product_info['upc']; ?><br><?php } ?>

					<?php if ($product_info['isbn'] != '') { ?><?php echo "ISBN: " . $product_info['isbn']; ?><br><?php } ?>

					<?php /*if ($product_info['gtin_ean'] != '') { ?><?php echo "GTIN/EAN: ".$product_info['gtin_ean']; ?><br><?php }*/ ?>

					<p itemprop="description"><?php echo stripslashes($product_info['products_description']); ?></p>

				<?php

			}

			?>
			</td>

		</tr>

	</table>


	<?php

	if (DISPLAY_YOUTUBE_VIDEO_IN_DESCRIPTION == 'true') {

		if (!empty($product_info['products_youtube'])) {

			?>

			<table width="100%" border="0" cellspacing="0" cellpadding="0">

				<tr>

					<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>

				</tr>

				<tr>

					<td class="smallText" align="center">

						<?php echo stripslashes($product_info['products_youtube']); ?>

					</td>

				</tr>

				<tr>

					<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>

				</tr>

			</table>

		<?php

	}
}

?>
	<?php

	$page_info_allprod_query = tep_db_query("select p.view_marketplace_products, p.categories_all_products, p.pages_id, p.sort_order, p.status, s.pages_title, s.pages_html_text, s.intorext, s.externallink, s.link_target from " . TABLE_INFO_PAGES . " p LEFT JOIN " . TABLE_INFO_PAGES_DESCRIPTION . " s on p.pages_id = s.pages_id where p.status = '1' and p.page_type = '9' and s.language_id = '" . (int)$languages_id . "' and p.all_products = 'true' order by p.sort_order, s.pages_title");

	$page_info_allprod_row = tep_db_num_rows($page_info_allprod_query);
	if ($page_info_allprod_row > 0) {

		?>

		<?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?>

		<hr style="border: <?php echo STYLE_SIZE_BORDER; ?> <?php echo STYLE_BORDER; ?> <?php echo STYLE_COLOR_BORDER; ?>;" />

		<?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?>

		<?php

		while ($page_info_allprod = tep_db_fetch_array($page_info_allprod_query)) {
			$categories_all_products_array = explode(",", str_replace("Array", "", $page_info_allprod['categories_all_products']));
			if (empty($page_info_allprod['view_marketplace_products'])) {

				$show_info_pages_mkt = true;
			} else {

				if ($product_info['seller_member_id'] != '') {

					if ($page_info_allprod['view_marketplace_products'] == "false") {

						$show_info_pages_mkt = false;
					} else {

						$show_info_pages_mkt = true;
					}
				} else {

					$show_info_pages_mkt = true;
				}
			}
			if ($page_info_allprod['pages_html_text'] != '' && $show_info_pages_mkt == true) {
				if ((in_array($current_category_id, $categories_all_products_array)) || (in_array("0", $categories_all_products_array)) || ($page_info_allprod['categories_all_products'] == '')) {

					?>

					<table border="0" width="100%" cellspacing="0" cellpadding="0">

						<tr>

							<td class="LargeText"><?php echo $page_info_allprod['pages_title']; ?></td>

						</tr>

						<tr>

							<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td>

						</tr>

						<tr>

							<td class="main" valign="top"><?php echo stripslashes($page_info_allprod['pages_html_text']); ?></td>

						</tr>

						<tr>

							<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>

						</tr>

					</table>

				<?php

			} else {

				?>

				<?php

			} // end if ( (in_array($current_category_id, $categories_all_products_array)) || ($page_info_allprod['categories_all_products'] == '0') ) { 

			?>

			<?php

		} // end if ($page_info_allprod['pages_html_text'] != '') {

		?>

		<?php

	} // end while

	?>

		<hr style="border: <?php echo STYLE_SIZE_BORDER; ?> <?php echo STYLE_BORDER; ?> <?php echo STYLE_COLOR_BORDER; ?>;" />

	<?php

} // end if ($page_info_allprod_row > 0 ) {

?>

</div>
<?php

if (DISPLAY_YOUTUBE_VIDEO_IN_DESCRIPTION == 'false') {

	if (!empty($product_info['products_youtube'])) {

		?>

		<div class="panel" id="panel3" style="display: none">

			<table width="100%" border="0" cellspacing="0" cellpadding="0">

				<tr>

					<td class="smallText" align="center">

						<?php echo stripslashes($product_info['products_youtube']); ?>

					</td>

				</tr>

			</table>

		</div>

	<?php

}
}

?>
<div class="panel" id="panel2" style="display: none">
	<!-- parcel //-->

	<?php
    if (($product_info['parcel_window'] == 1) && ($language == 'portugues') && ($currency == 'BRL')) {

	if ($product_info['view_price'] == 0) {
		if ($new_price = tep_get_products_special_price($product_info['products_id'])) {
			if ($discount > 0) $new_price = $new_price - ($new_price / 100) * $discount;
			$products_price = $new_price;
		} else {
			$price = $product_info['products_price'];

			if ($discount > 0) $price = $price - ($price / 100) * $discount;
			$products_price = $price;
		}
		//$info_box_contents = array();

		//$info_box_contents[] = array('text' => BOX_HEADING_PARCEL_CREDIT_CARD);
		//new infoBoxHeading($info_box_contents, false, false);
		$parcel_list = '<table border="0" width="100%" cellspacing="0" cellpadding="2">';

		$parcel_list .= '<tr>';
		// billet

		if (VIEW_PLOTS_BILLET == 'true') {
			$parcel_list .= '<td valign="top">';
			$parcel_list .= '<table border="0" width="100%" cellspacing="0" cellpadding="0">';
			$parcel_list .= '<tr>';

			$parcel_list .= '<td align="center">';

			$parcel_list .= '<center><img src="images/payment_boleto.gif" height="20"></center>';

			$parcel_list .= '</td>';

			$parcel_list .= '</tr><tr><td colspan="2"><hr color="' . TABLE_HEADING_BACKGROUND . '" size="1" noshade="noshade"></td></tr>';
			for ($i = 1; $i <= NUMBER_PLOTS_BILLET; $i++) {
				if ((MODULE_PAYMENT_DISC_STATUS == 'true') && (MODULE_PAYMENT_DISC_TYPE == 'boletobrasil')) {

					$price1 = $products_price * MODULE_PAYMENT_DISC_PERCENTAGE;

					$price_desc = $price1 / 100;

					$new_products_price_ok = $products_price - $price_desc;
					$price_divide = $currencies->format($new_products_price_ok / $i) . ' (' . MODULE_PAYMENT_DISC_PERCENTAGE . '% ' . TEXT_OF_DISCOUNT . ')';
				} elseif ((MODULE_PAYMENT_DISC1_STATUS == 'true') && (MODULE_PAYMENT_DISC1_TYPE == 'boletobrasil')) {

					$price1 = $products_price * MODULE_PAYMENT_DISC1_PERCENTAGE;

					$price_desc = $price1 / 100;

					$new_products_price_ok = $products_price - $price_desc;
					$price_divide = $currencies->format($new_products_price_ok / $i) . ' (' . MODULE_PAYMENT_DISC1_PERCENTAGE . '% ' . TEXT_OF_DISCOUNT . ')';
				} else {

					$price_divide = $currencies->format($products_price / $i);
				}
				$parcel_list .= '<tr><td class="infoBoxContents" valign="top"><small>' . $i . ' x </small></td><td class="infoBoxContents"><small>' . $price_divide . ' (' . TEXT_SEMJUROS . ')</small></td></tr><tr><td colspan="2"><hr color="' . TABLE_HEADING_BACKGROUND . '" size="1" noshade="noshade"></td></tr>';
			}

			$parcel_list .= '</table>';
			$parcel_list .= '</td>';
		}

		// billet eof	
		// deposito bancario

		if (VIEW_PLOTS_DEPOSIT_BANK == 'true') {
			$parcel_list .= '<td valign="top">';
			$parcel_list .= '<table border="0" width="100%" cellspacing="0" cellpadding="0">';
			$parcel_list .= '<tr>';

			$parcel_list .= '<td align="center">';

			$parcel_list .= '<center><img src="images/payment_depositobancario.png" height="20"></center>';

			$parcel_list .= '</td>';

			$parcel_list .= '</tr><tr><td colspan="2"><hr color="' . TABLE_HEADING_BACKGROUND . '" size="1" noshade="noshade"></td></tr>';
			for ($i = 1; $i <= NUMBER_PLOTS_DEPOSIT_BANK; $i++) {
				if ((MODULE_PAYMENT_DISC_STATUS == 'true') && (MODULE_PAYMENT_DISC_TYPE == 'transfer')) {

					$price1 = $products_price * MODULE_PAYMENT_DISC_PERCENTAGE;

					$price_desc = $price1 / 100;

					$new_products_price_ok = $products_price - $price_desc;
					$price_divide = $currencies->format($new_products_price_ok / $i) . ' (' . MODULE_PAYMENT_DISC_PERCENTAGE . '% ' . TEXT_OF_DISCOUNT . ')';
				} elseif ((MODULE_PAYMENT_DISC1_STATUS == 'true') && (MODULE_PAYMENT_DISC1_TYPE == 'transfer')) {

					$price1 = $products_price * MODULE_PAYMENT_DISC1_PERCENTAGE;

					$price_desc = $price1 / 100;

					$new_products_price_ok = $products_price - $price_desc;
					$price_divide = $currencies->format($new_products_price_ok / $i) . ' (' . MODULE_PAYMENT_DISC1_PERCENTAGE . '% ' . TEXT_OF_DISCOUNT . ')';
				} elseif ((MODULE_PAYMENT_DISC_STATUS == 'true') && (MODULE_PAYMENT_DISC_TYPE == 'transfer1')) {

					$price1 = $products_price * MODULE_PAYMENT_DISC_PERCENTAGE;

					$price_desc = $price1 / 100;

					$new_products_price_ok = $products_price - $price_desc;
					$price_divide = $currencies->format($new_products_price_ok / $i) . ' (' . MODULE_PAYMENT_DISC_PERCENTAGE . '% ' . TEXT_OF_DISCOUNT . ')';
				} elseif ((MODULE_PAYMENT_DISC1_STATUS == 'true') && (MODULE_PAYMENT_DISC1_TYPE == 'transfer1')) {

					$price1 = $products_price * MODULE_PAYMENT_DISC1_PERCENTAGE;

					$price_desc = $price1 / 100;

					$new_products_price_ok = $products_price - $price_desc;
					$price_divide = $currencies->format($new_products_price_ok / $i) . ' (' . MODULE_PAYMENT_DISC1_PERCENTAGE . '% ' . TEXT_OF_DISCOUNT . ')';
				} else {

					$price_divide = $currencies->format($products_price / $i) . ' (' . TEXT_SEMJUROS . ')';
				}
				$parcel_list .= '<tr><td class="infoBoxContents" valign="top"><small>' . $i . ' x </small></td><td class="infoBoxContents"><small>' . $price_divide . '</small></td></tr><tr><td colspan="2"><hr color="' . TABLE_HEADING_BACKGROUND . '" size="1" noshade="noshade"></td></tr>';
			}

			$parcel_list .= '</table>';
			$parcel_list .= '</td>';
		}

		// deposito bancario eof
		// visa electron

		if (defined('VIEW_PLOTS_VISAELECTRON') && VIEW_PLOTS_VISAELECTRON == 'true') {
			$parcel_list .= '<td valign="top">';
			$parcel_list .= '<table border="0" width="100%" cellspacing="0" cellpadding="0">';
			$parcel_list .= '<tr>';

			$parcel_list .= '<td align="center">';

			$parcel_list .= '<center><img src="images/payment_visaelectron.jpg" height="20"></center>';

			$parcel_list .= '</td>';

			$parcel_list .= '</tr><tr><td colspan="2"><hr color="' . TABLE_HEADING_BACKGROUND . '" size="1" noshade="noshade"></td></tr>';
			for ($i = 1; $i <= NUMBER_PLOTS_VISAELECTRON; $i++) {
				$price_divide = $currencies->format($products_price / $i);
				$parcel_list .= '<tr><td class="infoBoxContents" valign="top"><small>' . $i . ' x </small></td><td class="infoBoxContents"><small>' . $price_divide . ' (' . TEXT_SEMJUROS . ')</small></td></tr><tr><td colspan="2"><hr color="' . TABLE_HEADING_BACKGROUND . '" size="1" noshade="noshade"></td></tr>';
			}

			$parcel_list .= '</table>';
			$parcel_list .= '</td>';
		}

		// visa electron eof
		// visa

		if (VIEW_PLOTS_VISA == 'true') {
			$parcel_list .= '<td valign="top">';
			$parcel_list .= '<table border="0" width="100%" cellspacing="0" cellpadding="0">';
			$parcel_list .= '<tr>';

			$parcel_list .= '<td align="center">';

			$parcel_list .= '<center><img src="images/payment_visa.gif" height="20"></center>';

			$parcel_list .= '</td>';

			$parcel_list .= '</tr><tr><td colspan="2"><hr color="' . TABLE_HEADING_BACKGROUND . '" size="1" noshade="noshade"></td></tr>';
			for ($i = 2; $i <= NUMBER_PLOTS_VISA; $i++) {


				if (VIEW_PLOTS_JUROS == 'true') {
					if ($i >= NUMBER_PLOTS_JUROS) {

						$new_products_price_ok = $products_price * pow((1 + TAXA_PLOTS_JUROS / 100), $i);
					} else {

						$new_products_price_ok = $products_price;
					}
				} else {
					$new_products_price_ok = $products_price;
				}


				$price_divide = $currencies->format($new_products_price_ok / $i);
				if (VIEW_PLOTS_JUROS == 'true') {
					if ($i >= NUMBER_PLOTS_JUROS) {

						$parcel_list .= '<tr><td class="infoBoxContents" valign="top"><small>' . $i . ' x </small></td><td class="infoBoxContents"><small>' . $price_divide . ' (' . TEXT_COMJUROS . ' ' . TAXA_PLOTS_JUROS . '% a.m.)</small></td></tr><tr><td colspan="2"><hr color="' . TABLE_HEADING_BACKGROUND . '" size="1" noshade="noshade"></td></tr>';
					} else {

						$parcel_list .= '<tr><td class="infoBoxContents" valign="top"><small>' . $i . ' x </small></td><td class="infoBoxContents"><small>' . $price_divide . ' (' . TEXT_SEMJUROS . ')</small></td></tr><tr><td colspan="2"><hr color="' . TABLE_HEADING_BACKGROUND . '" size="1" noshade="noshade"></td></tr>';
					}
				} else {
					$parcel_list .= '<tr><td class="infoBoxContents" valign="top"><small>' . $i . ' x </small></td><td class="infoBoxContents"><small>' . $price_divide . ' (' . TEXT_SEMJUROS . ')</small></td></tr><tr><td colspan="2"><hr color="' . TABLE_HEADING_BACKGROUND . '" size="1" noshade="noshade"></td></tr>';
				}
			}

			$parcel_list .= '</table>';
			$parcel_list .= '</td>';
		}

		// visa eof
		// mastercard

		if (VIEW_PLOTS_MASTERCARD == 'true') {
			$parcel_list .= '<td valign="top">';
			$parcel_list .= '<table border="0" width="100%" cellspacing="0" cellpadding="0">';
			$parcel_list .= '<tr>';

			$parcel_list .= '<td align="center">';

			$parcel_list .= '<center><img src="images/payment_mastercard.gif" height="20"></center>';

			$parcel_list .= '</td>';

			$parcel_list .= '</tr><tr><td colspan="2"><hr color="' . TABLE_HEADING_BACKGROUND . '" size="1" noshade="noshade"></td></tr>';
			for ($i = 2; $i <= NUMBER_PLOTS_MASTERCARD; $i++) {
				if (VIEW_PLOTS_JUROS == 'true') {
					if ($i >= NUMBER_PLOTS_JUROS) {

						$new_products_price_ok = $products_price * pow((1 + TAXA_PLOTS_JUROS / 100), $i);
					} else {

						$new_products_price_ok = $products_price;
					}
				} else {
					$new_products_price_ok = $products_price;
				}


				$price_divide = $currencies->format($new_products_price_ok / $i);
				if (VIEW_PLOTS_JUROS == 'true') {
					if ($i >= NUMBER_PLOTS_JUROS) {

						$parcel_list .= '<tr><td class="infoBoxContents" valign="top"><small>' . $i . ' x </small></td><td class="infoBoxContents"><small>' . $price_divide . ' (' . TEXT_COMJUROS . ' ' . TAXA_PLOTS_JUROS . '% a.m.)</small></td></tr><tr><td colspan="2"><hr color="' . TABLE_HEADING_BACKGROUND . '" size="1" noshade="noshade"></td></tr>';
					} else {

						$parcel_list .= '<tr><td class="infoBoxContents" valign="top"><small>' . $i . ' x </small></td><td class="infoBoxContents"><small>' . $price_divide . ' (' . TEXT_SEMJUROS . ')</small></td></tr><tr><td colspan="2"><hr color="' . TABLE_HEADING_BACKGROUND . '" size="1" noshade="noshade"></td></tr>';
					}
				} else {
					$parcel_list .= '<tr><td class="infoBoxContents" valign="top"><small>' . $i . ' x </small></td><td class="infoBoxContents"><small>' . $price_divide . ' (' . TEXT_SEMJUROS . ')</small></td></tr><tr><td colspan="2"><hr color="' . TABLE_HEADING_BACKGROUND . '" size="1" noshade="noshade"></td></tr>';
				}
			}

			$parcel_list .= '</table>';
			$parcel_list .= '</td>';
		}

		// mastercard eof
		// dinners

		if (VIEW_PLOTS_DINNERS == 'true') {
			$parcel_list .= '<td valign="top">';
			$parcel_list .= '<table border="0" width="100%" cellspacing="0" cellpadding="0">';
			$parcel_list .= '<tr>';

			$parcel_list .= '<td align="center">';

			$parcel_list .= '<center><img src="images/payment_dinnersclub.gif" height="20"></center>';

			$parcel_list .= '</td>';

			$parcel_list .= '</tr><tr><td colspan="2"><hr color="' . TABLE_HEADING_BACKGROUND . '" size="1" noshade="noshade"></td></tr>';
			for ($i = 2; $i <= NUMBER_PLOTS_DINNERS; $i++) {
				if (VIEW_PLOTS_JUROS == 'true') {
					if ($i >= NUMBER_PLOTS_JUROS) {

						$new_products_price_ok = $products_price * pow((1 + TAXA_PLOTS_JUROS / 100), $i);
					} else {

						$new_products_price_ok = $products_price;
					}
				} else {
					$new_products_price_ok = $products_price;
				}


				$price_divide = $currencies->format($new_products_price_ok / $i);
				if (VIEW_PLOTS_JUROS == 'true') {
					if ($i >= NUMBER_PLOTS_JUROS) {

						$parcel_list .= '<tr><td class="infoBoxContents" valign="top"><small>' . $i . ' x </small></td><td class="infoBoxContents"><small>' . $price_divide . ' (' . TEXT_COMJUROS . ' ' . TAXA_PLOTS_JUROS . '% a.m.)</small></td></tr><tr><td colspan="2"><hr color="' . TABLE_HEADING_BACKGROUND . '" size="1" noshade="noshade"></td></tr>';
					} else {

						$parcel_list .= '<tr><td class="infoBoxContents" valign="top"><small>' . $i . ' x </small></td><td class="infoBoxContents"><small>' . $price_divide . ' (' . TEXT_SEMJUROS . ')</small></td></tr><tr><td colspan="2"><hr color="' . TABLE_HEADING_BACKGROUND . '" size="1" noshade="noshade"></td></tr>';
					}
				} else {
					$parcel_list .= '<tr><td class="infoBoxContents" valign="top"><small>' . $i . ' x </small></td><td class="infoBoxContents"><small>' . $price_divide . ' (' . TEXT_SEMJUROS . ')</small></td></tr><tr><td colspan="2"><hr color="' . TABLE_HEADING_BACKGROUND . '" size="1" noshade="noshade"></td></tr>';
				}
			}

			$parcel_list .= '</table>';
			$parcel_list .= '</td>';
		}

		// dinners eof
		// hipercard

		if (VIEW_PLOTS_HIPERCARD == 'true') {
			$parcel_list .= '<td valign="top">';
			$parcel_list .= '<table border="0" width="100%" cellspacing="0" cellpadding="0">';
			$parcel_list .= '<tr>';

			$parcel_list .= '<td align="center">';

			$parcel_list .= '<center><img src="images/payment_hipercard.gif" height="20"></center>';

			$parcel_list .= '</td>';

			$parcel_list .= '</tr><tr><td colspan="2"><hr color="' . TABLE_HEADING_BACKGROUND . '" size="1" noshade="noshade"></td></tr>';
			for ($i = 2; $i <= NUMBER_PLOTS_HIPERCARD; $i++) {
				if (VIEW_PLOTS_JUROS == 'true') {
					if ($i >= NUMBER_PLOTS_JUROS) {

						$new_products_price_ok = $products_price * pow((1 + TAXA_PLOTS_JUROS / 100), $i);
					} else {

						$new_products_price_ok = $products_price;
					}
				} else {
					$new_products_price_ok = $products_price;
				}


				$price_divide = $currencies->format($new_products_price_ok / $i);
				if (VIEW_PLOTS_JUROS == 'true') {
					if ($i >= NUMBER_PLOTS_JUROS) {

						$parcel_list .= '<tr><td class="infoBoxContents" valign="top"><small>' . $i . ' x </small></td><td class="infoBoxContents"><small>' . $price_divide . ' (' . TEXT_COMJUROS . ' ' . TAXA_PLOTS_JUROS . '% a.m.)</small></td></tr><tr><td colspan="2"><hr color="' . TABLE_HEADING_BACKGROUND . '" size="1" noshade="noshade"></td></tr>';
					} else {

						$parcel_list .= '<tr><td class="infoBoxContents" valign="top"><small>' . $i . ' x </small></td><td class="infoBoxContents"><small>' . $price_divide . ' (' . TEXT_SEMJUROS . ')</small></td></tr><tr><td colspan="2"><hr color="' . TABLE_HEADING_BACKGROUND . '" size="1" noshade="noshade"></td></tr>';
					}
				} else {
					$parcel_list .= '<tr><td class="infoBoxContents" valign="top"><small>' . $i . ' x </small></td><td class="infoBoxContents"><small>' . $price_divide . ' (' . TEXT_SEMJUROS . ')</small></td></tr><tr><td colspan="2"><hr color="' . TABLE_HEADING_BACKGROUND . '" size="1" noshade="noshade"></td></tr>';
				}
			}

			$parcel_list .= '</table>';
			$parcel_list .= '</td>';
		}

		// hipercard eof
		// elo

		if (VIEW_PLOTS_ELO == 'true') {
			$parcel_list .= '<td valign="top">';
			$parcel_list .= '<table border="0" width="100%" cellspacing="0" cellpadding="0">';
			$parcel_list .= '<tr>';

			$parcel_list .= '<td align="center" colspan="2">';

			$parcel_list .= '<center><img src="images/payment_elo.jpg" height="20"></center>';

			$parcel_list .= '</td>';

			$parcel_list .= '</tr><tr><td colspan="2"><hr color="' . TABLE_HEADING_BACKGROUND . '" size="1" noshade="noshade"></td></tr>';
			for ($i = 2; $i <= NUMBER_PLOTS_ELO; $i++) {
				if (VIEW_PLOTS_JUROS == 'true') {
					if ($i >= 2) {

						$new_products_price_ok = $products_price * pow((1 + TAXA_PLOTS_JUROS / 100), $i);
					} else {

						$new_products_price_ok = $products_price;
					}
				} else {
					$new_products_price_ok = $products_price;
				}


				$price_divide = $currencies->format($new_products_price_ok / $i);
				if (VIEW_PLOTS_JUROS == 'true') {
					if ($i >= 2) {

						$parcel_list .= '<tr><td class="infoBoxContents" valign="top" width="15%"><small>' . $i . 'x </small></td><td class="infoBoxContents"><small>' . $price_divide . ' (' . TEXT_COMJUROS . ' ' . TAXA_PLOTS_JUROS . '% a.m.)</small></td></tr><tr><td colspan="2"><hr color="' . TABLE_HEADING_BACKGROUND . '" size="1" noshade="noshade"></td></tr>';
					} else {

						$parcel_list .= '<tr><td class="infoBoxContents" valign="top" width="15%"><small>' . $i . 'x </small></td><td class="infoBoxContents"><small>' . $price_divide . ' (' . TEXT_SEMJUROS . ')</small></td></tr><tr><td colspan="2"><hr color="' . TABLE_HEADING_BACKGROUND . '" size="1" noshade="noshade"></td></tr>';
					}
				} else {
					$parcel_list .= '<tr><td class="infoBoxContents" valign="top" width="15%"><small>' . $i . 'x </small></td><td class="infoBoxContents"><small>' . $price_divide . ' (' . TEXT_SEMJUROS . ')</small></td></tr><tr><td colspan="2"><hr color="' . TABLE_HEADING_BACKGROUND . '" size="1" noshade="noshade"></td></tr>';
				}
			}

			$parcel_list .= '</table>';
			$parcel_list .= '</td>';
		}

		// elo eof
		// american express

		if (VIEW_PLOTS_AMERICANEXPRESS == 'true') {
			$parcel_list .= '<td valign="top">';
			$parcel_list .= '<table border="0" width="100%" cellspacing="0" cellpadding="0">';
			$parcel_list .= '<tr>';

			$parcel_list .= '<td align="center">';

			$parcel_list .= '<center><img src="images/payment_american_express.gif" height="20"></center>';

			$parcel_list .= '</td>';

			$parcel_list .= '</tr><tr><td colspan="2"><hr color="' . TABLE_HEADING_BACKGROUND . '" size="1" noshade="noshade"></td></tr>';
			for ($i = 2; $i <= NUMBER_PLOTS_AMERICANEXPRESS; $i++) {
				if (VIEW_PLOTS_JUROS == 'true') {
					if ($i >= NUMBER_PLOTS_JUROS) {

						$new_products_price_ok = $products_price * pow((1 + TAXA_PLOTS_JUROS / 100), $i);
					} else {

						$new_products_price_ok = $products_price;
					}
				} else {
					$new_products_price_ok = $products_price;
				}


				$price_divide = $currencies->format($new_products_price_ok / $i);
				if (VIEW_PLOTS_JUROS == 'true') {
					if ($i >= NUMBER_PLOTS_JUROS) {

						$parcel_list .= '<tr><td class="infoBoxContents" valign="top"><small>' . $i . ' x </small></td><td class="infoBoxContents"><small>' . $price_divide . ' (' . TEXT_COMJUROS . ' ' . TAXA_PLOTS_JUROS . '% a.m.)</small></td></tr><tr><td colspan="2"><hr color="' . TABLE_HEADING_BACKGROUND . '" size="1" noshade="noshade"></td></tr>';
					} else {

						$parcel_list .= '<tr><td class="infoBoxContents" valign="top"><small>' . $i . ' x </small></td><td class="infoBoxContents"><small>' . $price_divide . ' (' . TEXT_SEMJUROS . ')</small></td></tr><tr><td colspan="2"><hr color="' . TABLE_HEADING_BACKGROUND . '" size="1" noshade="noshade"></td></tr>';
					}
				} else {
					$parcel_list .= '<tr><td class="infoBoxContents" valign="top"><small>' . $i . ' x </small></td><td class="infoBoxContents"><small>' . $price_divide . ' (' . TEXT_SEMJUROS . ')</small></td></tr><tr><td colspan="2"><hr color="' . TABLE_HEADING_BACKGROUND . '" size="1" noshade="noshade"></td></tr>';
				}
			}

			$parcel_list .= '</table>';
			$parcel_list .= '</td>';
		}

		// american express eof
		// aura

		if (VIEW_PLOTS_AURA == 'true') {
			$parcel_list .= '<td valign="top">';
			$parcel_list .= '<table border="0" width="100%" cellspacing="0" cellpadding="0">';
			$parcel_list .= '<tr>';

			$parcel_list .= '<td align="center">';

			$parcel_list .= '<center><img src="images/payment_aura.gif" height="20"></center>';

			$parcel_list .= '</td>';

			$parcel_list .= '</tr><tr><td colspan="2"><hr color="' . TABLE_HEADING_BACKGROUND . '" size="1" noshade="noshade"></td></tr>';
			for ($i = 2; $i <= NUMBER_PLOTS_AURA; $i++) {
				if (VIEW_PLOTS_JUROS == 'true') {
					if ($i >= NUMBER_PLOTS_JUROS) {

						$new_products_price_ok = $products_price * pow((1 + TAXA_PLOTS_JUROS / 100), $i);
					} else {

						$new_products_price_ok = $products_price;
					}
				} else {
					$new_products_price_ok = $products_price;
				}


				$price_divide = $currencies->format($new_products_price_ok / $i);
				if (VIEW_PLOTS_JUROS == 'true') {
					if ($i >= NUMBER_PLOTS_JUROS) {

						$parcel_list .= '<tr><td class="infoBoxContents" valign="top"><small>' . $i . ' x </small></td><td class="infoBoxContents"><small>' . $price_divide . ' (' . TEXT_COMJUROS . ' ' . TAXA_PLOTS_JUROS . '% a.m.)</small></td></tr><tr><td colspan="2"><hr color="' . TABLE_HEADING_BACKGROUND . '" size="1" noshade="noshade"></td></tr>';
					} else {

						$parcel_list .= '<tr><td class="infoBoxContents" valign="top"><small>' . $i . ' x </small></td><td class="infoBoxContents"><small>' . $price_divide . ' (' . TEXT_SEMJUROS . ')</small></td></tr><tr><td colspan="2"><hr color="' . TABLE_HEADING_BACKGROUND . '" size="1" noshade="noshade"></td></tr>';
					}
				} else {
					$parcel_list .= '<tr><td class="infoBoxContents" valign="top"><small>' . $i . ' x </small></td><td class="infoBoxContents"><small>' . $price_divide . ' (' . TEXT_SEMJUROS . ')</small></td></tr><tr><td colspan="2"><hr color="' . TABLE_HEADING_BACKGROUND . '" size="1" noshade="noshade"></td></tr>';
				}
			}

			$parcel_list .= '</table>';
			$parcel_list .= '</td>';
		}

		// aura eof


		$parcel_list .= '<tr>';

		$parcel_list .= '</table>';
		$info_box_contents = array();

		$info_box_contents[] = array('text' => $parcel_list);
		new infoBox($info_box_contents);
	}

    } // end if (($product_info['parcel_window'] == 1) && ($language == 'portugues') && ($currency == 'BRL')) {
	?>

	<!-- parcel_eof //-->
</div>
<div class="panel" id="panel4" style="display: none">

	<table width="100%" border="0" cellspacing="0" cellpadding="0">

		<tr>

			<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td>

		</tr>

		<tr>

			<td><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, tep_get_all_get_params()) . '">' . tep_image_button('button_write_review.gif', IMAGE_BUTTON_WRITE_REVIEW) . '</a>'; ?></td>

		</tr>

		<tr>

			<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td>

		</tr>

	</table>
	<?

	$reviews_query = tep_db_query("select count(*) as count from " . TABLE_REVIEWS . " r, " . TABLE_REVIEWS_DESCRIPTION . " rd where r.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and r.reviews_id = rd.reviews_id and rd.languages_id = '" . (int)$languages_id . "'");

	$reviews = tep_db_fetch_array($reviews_query);

	if ($reviews['count'] > 0) {

		include(DIR_WS_MODULES . 'product_reviews_info.php');
	}

	?>

</div>
<!-- descriptions eof --> 
<!-- tags -->
<?php
if (tep_not_null($product_info['tags'])) {
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td>
  </tr>
  <tr>
    <td class="main">
	<style>
.tags {
  list-style: none;
  margin: 0;
  overflow: hidden; 
  padding: 0;
}

.tags li {
  float: left; 
}

.tag {
  background: #eee;
  border-radius: 3px 0 0 3px;
  color: #242424;
  display: inline-block;
  height: 26px;
  line-height: 26px;
  padding: 0 20px 0 23px;
  position: relative;
  margin: 0 10px 10px 0;
  text-decoration: none;
  -webkit-transition: color 0.2s;
}

.tag::before {
  background: #fff;
  border-radius: 10px;
  box-shadow: inset 0 1px rgba(0, 0, 0, 0.25);
  content: '';
  height: 6px;
  left: 10px;
  position: absolute;
  width: 6px;
  top: 10px;
}

.tag::after {
  background: #fff;
  border-bottom: 13px solid transparent;
  border-left: 10px solid #eee;
  border-top: 13px solid transparent;
  content: '';
  position: absolute;
  right: 0;
  top: 0;
}

.tag:hover {
  background-color: #3d3d3d;
  color: white;
}

.tag:hover::after {
   border-left-color: #3d3d3d; 
}
</style>
	<?php
	$get_tags_array = explode(",", $product_info['tags']);
	echo '<ul class="tags">';
	foreach($get_tags_array as $get_tags_value){
		echo '<li><a href="'.tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT, 'keywords='.$get_tags_value.'&search_in_description=1&x=0&y=0', 'SSL').'" class="tag">'.$get_tags_value.'</a></li>';
	}
	echo '</ul>';
	?>
	</td>
  </tr>
</table>
<?php
}
?>
<!-- tags eof -->


<?php

if (tep_not_null($product_info['products_url'])) {

	?>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">

		<tr>

			<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td>

		</tr>

		<tr>

			<td class="main"><?php echo sprintf(TEXT_MORE_INFORMATION, tep_href_link(FILENAME_REDIRECT, 'action=url&goto=' . urlencode($product_info['products_url']), 'NONSSL', true, false)); ?></td>

		</tr>

	</table>

<?php

}

?>


<table width="100%" border="0" cellspacing="0" cellpadding="0">

	<tr>

		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td>

	</tr>
	<tr>

		<td><?php if (basename($PHP_SELF) != FILENAME_TELL_A_FRIEND) include(DIR_WS_BOXES . 'tell_a_friend.php'); ?></td>

	</tr>
	<tr>

		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td>

	</tr>
	<tr>

		<td><?php include(DIR_WS_BOXES . 'product_notifications.php'); ?></td>

	</tr>

</table>


<table width="100%" border="0" cellspacing="0" cellpadding="0">

	<?php

	if (($product_info['products_quantity'] > 0) || (($product_info['products_quantity'] <= 0) && ($product_info['products_qtd_stock_status'] == '1'))) {

		?>

		<tr>

			<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td>

		</tr>

		<?php

		if (((CUSTOMER_VIEW_PRODUCT_LOGIN_OR_CREATE_ACCOUNT_VIEW_PRICE == 'true') && (tep_session_is_registered('customer_id'))) || (CUSTOMER_VIEW_PRODUCT_LOGIN_OR_CREATE_ACCOUNT_VIEW_PRICE != 'true')) {

			if (MODULE_2GETHER_DISCOUNT_STATUS) {

				echo '<tr><td>';

				include(DIR_WS_MODULES . '2gether.php');

				echo '</td></tr>';
			}
		}
	}

	?>

	<tr>

		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td>

	</tr>

	<tr>

		<td><?php include(DIR_WS_MODULES . FILENAME_RELATED_PRODUCTS); ?></td>

	</tr>
	<tr>

		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td>

	</tr>

	<tr>

		<td>

			<?php

			if ((USE_CACHE == 'true') && empty($SID)) {

				echo tep_cache_also_purchased(3600);
			} else {

				include(DIR_WS_MODULES . FILENAME_ALSO_PURCHASED_PRODUCTS);
			}

			?>

		</td>

	</tr>
</table>
<!-- new page eof -->