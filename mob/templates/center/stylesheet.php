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

$layout = tep_random_select("select background_footer, background_header_right, background_menu_header, background_box_header_left, background_box_header_right, background_box_header_center, status, cPath, page, date_scheduled, expires_date, background_site, background_site_content from " . TABLE_LAYOUT . " WHERE id = '".$_GET['layout_id']."' ".$add_lng_id_qry.$add_temp_fld_qry.$add_cPath_qry.$add_page_type_qry);

}else{

$layout = tep_random_select("select background_footer, background_header_right, background_menu_header, background_box_header_left, background_box_header_right, background_box_header_center, status, cPath, page, date_scheduled, expires_date, background_site, background_site_content from " . TABLE_LAYOUT . " WHERE status = '1' ".$add_lng_id_qry.$add_temp_fld_qry.$add_cPath_qry.$add_page_type_qry);

}

$background_box_header_center = $layout["background_box_header_center"];
$background_box_header_left = $layout["background_box_header_left"];
$background_box_header_right = $layout["background_box_header_right"];
if ($layout["background_menu_header"] != ""){ $background_menu_header = $layout["background_menu_header"]; }
if ($layout["background_header"] != ""){ $background_header = $layout["background_header"]; }
if ($layout["background_header_right"] != ""){ $background_header_right = $layout["background_header_right"]; }
if ($layout["background_footer"] != ""){ $background_footer = $layout["background_footer"]; }
// layout eof
?>
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
<style type="text/css">

.boxText { font-family: 'Open Sans', Arial, sans-serif;font-size:100%; }
.errorBox { font-family: 'Open Sans', Arial, sans-serif; font-size:100%; background: #ffb3b5; font-weight: bold; }
.stockWarning { font-family: 'Open Sans', Arial, sans-serif; font-size:100%; color: #cc0033; }
.productsNotifications { background: #f2fff7; }
.orderEdit { font-family: 'Open Sans', Arial, sans-serif; font-size:100%; color: #FF0000; text-decoration: underline; }

.background_content_site {
  <?php if ($layout["background_site_content"]) { ?>
  background-image:url(<?php echo HTTP_SERVER_IMAGES; ?>/images/<?php echo $layout["background_site_content"]; ?>);
  <?php }else{ ?>
  background: <?php echo BACKGROUND_COLOR_CONTENT; ?>;
  <?php } ?>
}

BODY {
  <?php if ($layout["background_site"]) { ?>
  background-image:url(<?php echo HTTP_SERVER_IMAGES; ?>/images/<?php echo $layout["background_site"]; ?>);
  <?php }else{ ?>
  background: <?php echo BACKGROUND_COLOR; ?>;
  <?php } ?>
  color: <?php echo FONT_COLOR; ?>;
  margin: 0px;
}

A {
  color: <?php echo FONT_COLOR_LINK; ?>;
  text-decoration: none;
}

A:hover {
  color: <?php echo FONT_COLOR_LINK; ?>;
  text-decoration: underline;
}

FORM {
	display: inline;
}

input[type=text] {
	font-size:100%;
    padding: 5px;
}

textarea {
	font-size:100%;
	padding: 10px;
	resize:both;
}
select {
	font-size:100%;
	padding: 5px;
}
input[type="password"] {
	font-size:100%;
	padding: 5px;
}
input[type="radio"] {
	font-size:100%;
	padding: 5px;
	width:2.50em;
	height:2.50em;
	vertical-align:middle;
}
input[type="checkbox"] {
	font-size:100%;
	padding: 5px;
	width:2.50em;
	height:2.50em;
	vertical-align:middle;
}

TABLE.header {
  background: <?php echo HEADER_BACKGROUND; ?>;
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
  color: #000000;
  font-weight : bold;
}

TABLE.headerNavigation {
  background: <?php echo HEADER_BACKGROUND_NAVIGATION; ?>;
}

TD.headerNavigation {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
  background: <?php echo HEADER_BACKGROUND_NAVIGATION; ?>;
  color: <?php echo TABLE_HEADING_COLOR; ?>;
  font-weight : bold;
}

A.headerNavigation { 
  color: <?php echo TABLE_HEADING_COLOR; ?>; 
}

A.headerNavigation:hover {
  color: <?php echo TABLE_HEADING_COLOR; ?>;
}

TR.headerError {
  background: #ff0000;
}

TD.headerError {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
  background: #ff0000;
  color: #ffffff;
  font-weight : bold;
  text-align : center;
}

TR.headerInfo {
  background: #00ff00;
}

TD.headerInfo {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
  background: #00ff00;
  color: #ffffff;
  font-weight: bold;
  text-align: center;
}

<?php 
if ($background_footer != "" || FOOTER_BACKGROUND != "") {
?>
.bkgfooter {
  <?php
  if (FOOTER_BACKGROUND != "") {
  ?>
  background: <?php echo FOOTER_BACKGROUND; ?>;
  <?php
  }else{
  ?>
  background-image:url(<?php echo DIR_WS_IMAGES . $background_footer; ?>);
  <?php
if ($layout["background_footer"] != ""){ 
	$background_footer = DIR_WS_IMAGES . $layout["background_footer"];
	list($width_footer, $height_footer, $type_footer, $attr_footer) = getimagesize($background_footer);
	if ($height_footer != ""){
		$height_footer_ok = '  height: '.$height_footer.';';
	}
}
  }
  ?>
<?php
if (ROUND_CORNER_FOOTER_BACKGROUND != ""){
?>	
  padding:5px;
  -moz-border-radius: <?php if (ROUND_CORNER_FOOTER_BACKGROUND != "") { echo ROUND_CORNER_FOOTER_BACKGROUND; } ?>;
  -webkit-border-radius: <?php if (ROUND_CORNER_FOOTER_BACKGROUND != "") { echo ROUND_CORNER_FOOTER_BACKGROUND; } ?>;
  border-radius: <?php if (ROUND_CORNER_FOOTER_BACKGROUND != "") { echo ROUND_CORNER_FOOTER_BACKGROUND; } ?>;
<?php } ?>
}
<?php } ?>

TR.footer {
  background: <?php echo FOOTER_BACKGROUND_NAVIGATION; ?>;
}

TD.footer {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
  background: <?php echo FOOTER_BACKGROUND_NAVIGATION; ?>;
  color: <?php echo FOOTER_COLOR; ?>;
  font-weight: normal;
}

A.footer {
  color: <?php echo FOOTER_COLOR; ?>;
}

A.footer:hover {
  color: <?php echo FOOTER_COLOR; ?>;
}

.infoBox {
  background: <?php echo TABLE_BOX_BORDER_COLOR; ?>;
}

.infoBoxContents {
  background: <?php echo TABLE_BOX_BACKGROUND; ?>;
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
  line-height:1.2;
}

.infoBoxContentsHome {
  background: #FFFFFF;
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
}


.infoBoxNotice {
  background: <?php echo TABLE_BOX_BACKGROUND; ?>;
}

.infoBoxNoticeContents {
  background: <?php echo TABLE_BOX_BACKGROUND; ?>;
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
}

TD.infoBoxHeading {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
/*  font-weight: bold;*/
/*  background: <?php //echo TABLE_HEADING_BACKGROUND; ?>;*/
/*  background-image:url(images/<?php //echo $background_box_header_center; ?>);*/
/*  color: <?php //echo TABLE_HEADING_COLOR; ?>;*/
  background-color:#FFFFFF;
  color:#333333;  
  <?php if (DISPLAY_BORDER_BOTTOM_TITLE_HEADING == 'true') { ?>
  padding: 5px;
  <?php }else{ ?>
  padding: 5px;
  <?php } ?>
  <?php //if (DISPLAY_BORDER_BOTTOM_TITLE_HEADING == 'true') { ?>
  border-bottom: 1px solid #CCCCCC;
  <?php //} ?>
}

TD.infoBoxHeadingLeft {
/*  background-image:url(images/<?php //echo $background_box_header_left; ?>);
  background-repeat:no-repeat;*/
  background-color:#505050;
  color:#FFFFFF;
  background-position:left;
  <?php if (DISPLAY_BORDER_BOTTOM_TITLE_HEADING == 'true') { ?>
  border-bottom: 1px solid <?php echo COLOR_BORDER_BOTTOM_TITTLE_HEADING; ?>;
  <?php } ?>
}

TD.infoBoxHeadingRight {
/*  background-image:url(images/<?php //echo $background_box_header_right; ?>);
  background-repeat:no-repeat;*/
  background-color:#505050;
  color:#FFFFFF;
  background-position:right;
  <?php if (DISPLAY_BORDER_BOTTOM_TITLE_HEADING == 'true') { ?>
  border-bottom: 1px solid <?php echo COLOR_BORDER_BOTTOM_TITTLE_HEADING; ?>;
  <?php } ?>
}


TD.infoBox, SPAN.infoBox {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
}

TR.accountHistory-odd, TR.addressBook-odd, TR.alsoPurchased-odd, TR.payment-odd, TR.productListing-odd, TR.productReviews-odd, TR.upcomingProducts-odd, TR.shippingOptions-odd {
  background: <?php echo TABLE_BOX_BACKGROUND; ?>;
}

TR.accountHistory-even, TR.addressBook-even, TR.alsoPurchased-even, TR.payment-even, TR.productListing-even, TR.productReviews-even, TR.upcomingProducts-even, TR.shippingOptions-even {
  background: <?php echo TABLE_BOX_BACKGROUND; ?>;
}

TABLE.productListing {
  border: 1px;
  border-style: solid;
  border-color: <?php echo TABLE_BOX_BACKGROUND; ?>;
  border-spacing: 1px;
}

.productListing-heading {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
  background: <?php echo TABLE_HEADING_BACKGROUND; ?>;
  color: <?php echo TABLE_HEADING_COLOR; ?>;
  font-weight: bold;
}

TD.productListing-data {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
}

A.pageResults {
  color: #0000FF;
}

A.pageResults:hover {
  color: #0000FF;
  background: #FFFF33;
}

TD.pageHeading, DIV.pageHeading {
  font-family: 'Open Sans', Arial, sans-serif;
  font-size: <?php echo FONT_SIZE_TITLE_PAGES; ?>;
  font-weight: bold;
  color: <?php echo FONT_COLOR_TITLE_PAGES; ?>;
}

TR.subBar {
  background: #f4f7fd;
}

TD.subBar {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
  color: #000000;
}

TD.main, P.main {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
  line-height:1.2;
}

TD.smallText, SPAN.smallText, P.smallText {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
  line-height:1.2;
}

TD.LargeText, SPAN.LargeText, P.LargeText {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
}

TD.accountCategory {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
  color: #aabbdd;
}

TD.fieldKey {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
  font-weight: bold;
}

TD.fieldValue {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
}

TD.tableHeading {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
  font-weight: bold;
}

SPAN.newItemInCart {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
  color: #ff0000;
}

CHECKBOX, INPUT, RADIO, SELECT {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
}

TEXTAREA {
  width: 100%;
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
}

SPAN.greetUser {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
  color: #f0a480;
  font-weight: bold;
}

TABLE.formArea {
  background: #f1f9fe;
  border-color: #7b9ebd;
  border-style: solid;
  border-width: 1px;
}

TD.formAreaTitle {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
  font-weight: bold;
}

SPAN.markProductOutOfStock {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
  color: #c76170;
  font-weight: bold;
}

SPAN.productSpecialPrice {
  font-family: 'Open Sans', Arial, sans-serif;
  color: #ff0000;
}

SPAN.errorText {
  font-family: 'Open Sans', Arial, sans-serif;
  color: #ff0000;
}

.moduleRow { }
.moduleRowOver { background-color: <?php echo BKG_COLOR_MODULE_ROW_OVER; ?>; cursor: hand; }
.moduleRowSelected { background-color: <?php echo BKG_COLOR_MODULE_ROW_SELECTED; ?>; }

.checkoutBarFrom, .checkoutBarTo { font-family: 'Open Sans', Arial, sans-serif;font-size:100%; color: #8c8c8c; }
.checkoutBarCurrent { font-family: 'Open Sans', Arial, sans-serif;font-size:100%; color: #000000; }

/* message box */

.messageBox { font-family: 'Open Sans', Arial, sans-serif;font-size:100%; }
/*.messageStackError, .messageStackWarning { font-family: 'Open Sans', Arial, sans-serif;font-size:100%; background-color: #ffb3b5; }*/
.messageStackError, .messageStackWarning { font-family: 'Open Sans', Arial, sans-serif;font-size:100%; background-color: #FFFFFF; border: 1px dashed <?php echo TABLE_BOX_BORDER_COLOR; ?>; padding:5px; }
/*.messageStackSuccess { font-family: 'Open Sans', Arial, sans-serif;font-size:100%; background-color: #99ff00; }*/
.messageStackSuccess { font-family: 'Open Sans', Arial, sans-serif;font-size:100%; background-color: #FFFFFF; border: 1px dashed <?php echo TABLE_BOX_BORDER_COLOR; ?>; padding:5px; }

/* input requirement */

.inputRequirement { font-family: 'Open Sans', Arial, sans-serif;font-size:100%; color: #ff0000; }
.fieldRequired { font-family: 'Open Sans', Arial, sans-serif;font-size:100%; color: #ff0000; }

.freeship{
 font-family: 'Open Sans', Arial, sans-serif;
font-size:100%;
 font-weight: bold;
 color: #ff0000;
 text-decoration: none;
 }

 .freeship2{
 font-family: 'Open Sans', Arial, sans-serif;
font-size:100%;
 font-weight: bold;
 color: #000000;
 text-decoration: none;
 } 

/* DELIVERY MODULE - START */
input.radio.my{
	width:20px;
	 background: #000000;
	 border:2px;
}
/* DELIVERY MODULE - END */

.imgborder_productpage img{
	padding: 10px;
	border: 2px solid #CCCCCC;
	margin:10px;	
}

.checkout_style_border_div {
  /*border:<?php //echo TABLE_BOX_CHECKOUT_BORDER_COLOR . ' ' . STYLE_BORDER; ?> 2px;*/
  border-bottom:<?php echo TABLE_BOX_CHECKOUT_BORDER_COLOR . ' ' . STYLE_BORDER; ?> 2px;
  padding: <?php echo STYLE_PADDING_BORDER; ?>;
}

</style>
 
 <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
<style type="text/css">
#pointermenu2{
margin: 0;
padding: 0;
}

#pointermenu2 ul{
margin: 0;
margin-left: 15px; /*menu offset from left edge of window*/
float: left;
padding-left: 8px;
font: bold 12px 'Open Sans', Arial, sans-serif;
background-color: <?php echo HEADER_BACKGROUND_NAVIGATION; ?>;
/*background: #c00000 url(media/leftround2.gif) bottom left no-repeat; /*optional left round corner*/
}

* html #pointermenu2 ul{ /*IE6 only rule. Decrease ul left margin and add 1em bottom margin*/
margin-bottom: 1em;
margin-left: 7px; /*menu offset from left edge of window in IE*/
}

#pointermenu2 ul li{
display: inline;
}


#pointermenu2 ul li a{
float: left;
color: <?php echo TABLE_HEADING_COLOR; ?>;
font-weight: bold;
padding: 7px 9px 7px 5px;
text-decoration: none;
}

#pointermenu2 ul li a:visited{
color: <?php echo TABLE_HEADING_COLOR; ?>;

}


#pointermenu2 ul li a:hover, #pointermenu2 ul li a#selected{ /*hover and selected link*/
color: #FFFFFF;
background: transparent url(images/pointer.gif) top center no-repeat;
}

#pointermenu2 ul li a#rightcorner{
padding-right: 0;
padding-left: 2px;
background-color: <?php echo HEADER_BACKGROUND_NAVIGATION; ?>;
/*background: url(media/rightround2.gif) bottom right no-repeat; /*optional right round corner*/
}



#stylefour{position:relative;display:block;height:39px;font-size:100%;font-weight:bold;background:transparent url(images/bgOFF.gif) repeat-x top left;font-family: 'Open Sans', Arial, sans-serif;border-top:4px solid #B30000;}
#stylefour ul{margin:0;padding:0;list-style-type:none;width:auto;}
#stylefour ul li{display:block;float:left;margin:0;}
#stylefour ul li a{display:block;float:left;color:#666;text-decoration:none;padding:11px 20px 0 20px;height:23px;background:transparent url(images/bgDIVIDER.gif) no-repeat top right;}
#stylefour ul li a:hover,#stylefour ul li a.current{color:#B30000;background:#fff url(images/bgON.gif) no-repeat top right;}


/* classi per 2gether discount*/

.getslogan	{
	font-family: 'Open Sans', Arial, sans-serif;
	font-size:100%;
	font-weight: bold;
}
.gettitolo	{
	font-family: 'Open Sans', Arial, sans-serif;
	font-size:100%;
	font-weight: bold;
}
.buybothText {
	font-family: 'Open Sans', Arial, sans-serif;
	font-size:100%;
	font-weight: normal;
	margin-bottom: 8px;
}

.getprezzo {
	font-family: 'Open Sans', Arial, sans-serif;
	font-size:100%;
	font-weight: normal;
	margin-bottom: 8px;
}

.prezzo {
	font-family: 'Open Sans', Arial, sans-serif;
	font-size:100%;
	font-weight: normal;
	margin-bottom: 8px;
}

.getrisparmio {
	font-family: 'Open Sans', Arial, sans-serif;
	font-size:100%;
	font-weight: bold;
	margin-bottom: 8px;
}

.vsmalltext {
	font-family: 'Open Sans', Arial, sans-serif;
	font-size: 100%;
	margin-top: 8px;
}

/* end of classi per 2gether discount*/


/* menu header */
#stylefour{position:relative;display:block;height:39px;font-size:100%;font-weight:bold;background:transparent url(images/bgOFF.gif) repeat-x top left;font-family: 'Open Sans', Arial, sans-serif;}
#stylefour ul{margin:0;padding:0;list-style-type:none;width:auto;}
#stylefour ul li{display:block;float:left;margin:0;}
#stylefour ul li a{display:block;float:left;color:#666;text-decoration:none;padding:11px 10px 0 10px;height:23px;background:transparent url(images/bgDIVIDER.gif) no-repeat top right;}
#stylefour ul li a:hover,#stylefour ul li a.current{color:#000000;background:#fff url(images/bgON.gif) no-repeat top right;}








#lbOverlay { position: fixed; top: 0; left: 0; z-index: 99998; width: 100%; height: 500px; }
	#lbOverlay.grey { background-color: #000000; }
	#lbOverlay.red { background-color: #330000; }
	#lbOverlay.green { background-color: #003300; }
	#lbOverlay.blue { background-color: #011D50; }
	#lbOverlay.gold { background-color: #666600; }

#lbMain { position: absolute; left: 0; width: 100%; z-index: 99999; text-align: center; line-height: 0; }
#lbMain a img { border: none; }

#lbOuterContainer { position: relative; background-color: #fff; width: 200px; height: 200px; margin: 0 auto; }
	#lbOuterContainer.grey { border: 3px solid #888888; }
	#lbOuterContainer.red { border: 3px solid #DD0000; }
	#lbOuterContainer.green { border: 3px solid #00B000; }
	#lbOuterContainer.blue { border: 3px solid #5F89D8; }
	#lbOuterContainer.gold { border: 3px solid #B0B000; }

#lbDetailsContainer {	font: 10px 'Open Sans', Arial, sans-serif; background-color: #fff; width: 100%; line-height: 1.4em;	overflow: auto; margin: 0 auto; }
	#lbDetailsContainer.grey { border: 3px solid #888888; border-top: none; }
	#lbDetailsContainer.red { border: 3px solid #DD0000; border-top: none; }
	#lbDetailsContainer.green { border: 3px solid #00B000; border-top: none; }
	#lbDetailsContainer.blue { border: 3px solid #5F89D8; border-top: none; }
	#lbDetailsContainer.gold { border: 3px solid #B0B000; border-top: none; }

#lbImageContainer, #lbIframeContainer { padding: 10px; }
#lbLoading {
	position: absolute; top: 45%; left: 0%; height: 32px; width: 100%; text-align: center; line-height: 0; background: url(images/loading.gif) center no-repeat;
}

#lbHoverNav { position: absolute; top: 0; left: 0; height: 100%; width: 100%; z-index: 10; }
#lbImageContainer>#lbHoverNav { left: 0; }
#lbHoverNav a { outline: none; }

#lbPrev { width: 49%; height: 100%; background: transparent url(images/blank.gif) no-repeat; display: block; left: 0; float: left; }
	#lbPrev.grey:hover, #lbPrev.grey:visited:hover { background: url(images/prev_grey.gif) left 15% no-repeat; }
	#lbPrev.red:hover, #lbPrev.red:visited:hover { background: url(images/prev_red.gif) left 15% no-repeat; }
	#lbPrev.green:hover, #lbPrev.green:visited:hover { background: url(images/prev_green.gif) left 15% no-repeat; }
	#lbPrev.blue:hover, #lbPrev.blue:visited:hover { background: url(images/prev_blue.gif) left 15% no-repeat; }
	#lbPrev.gold:hover, #lbPrev.gold:visited:hover { background: url(images/prev_gold.gif) left 15% no-repeat; }
	
#lbNext { width: 49%; height: 100%; background: transparent url(images/blank.gif) no-repeat; display: block; right: 0; float: right; }
	#lbNext.grey:hover, #lbNext.grey:visited:hover { background: url(images/next_grey.gif) right 15% no-repeat; }
	#lbNext.red:hover, #lbNext.red:visited:hover { background: url(images/next_red.gif) right 15% no-repeat; }
	#lbNext.green:hover, #lbNext.green:visited:hover { background: url(images/next_green.gif) right 15% no-repeat; }
	#lbNext.blue:hover, #lbNext.blue:visited:hover { background: url(images/next_blue.gif) right 15% no-repeat; }
	#lbNext.gold:hover, #lbNext.gold:visited:hover { background: url(images/next_gold.gif) right 15% no-repeat; }

#lbPrev2, #lbNext2 { text-decoration: none; font-weight: bold; }
	#lbPrev2.grey, #lbNext2.grey, #lbSpacer.grey { color: #333333; }
	#lbPrev2.red, #lbNext2.red, #lbSpacer.red { color: #620000; }
	#lbPrev2.green, #lbNext2.green, #lbSpacer.green { color: #003300; }
	#lbPrev2.blue, #lbNext2.blue, #lbSpacer.blue { color: #01379E; }
	#lbPrev2.gold, #lbNext2.gold, #lbSpacer.gold { color: #666600; }
	
#lbPrev2_Off, #lbNext2_Off { font-weight: bold; }
	#lbPrev2_Off.grey, #lbNext2_Off.grey { color: #CCCCCC; }
	#lbPrev2_Off.red, #lbNext2_Off.red { color: #FFCCCC; }
	#lbPrev2_Off.green, #lbNext2_Off.green { color: #82FF82; }
	#lbPrev2_Off.blue, #lbNext2_Off.blue { color: #B7CAEE; }
	#lbPrev2_Off.gold, #lbNext2_Off.gold { color: #E1E100; }
	
#lbDetailsData { padding: 0 10px; }
	#lbDetailsData.grey { color: #333333; }
	#lbDetailsData.red { color: #620000; }
	#lbDetailsData.green { color: #003300; }
	#lbDetailsData.blue { color: #01379E; }
	#lbDetailsData.gold { color: #666600; }

#lbDetails { width: 60%; float: left; text-align: left; }
#lbCaption { display: block; font-weight: bold; }
#lbNumberDisplay { float: left; display: block; padding-bottom: 1.0em; }
#lbNavDisplay { float: left; display: block; padding-bottom: 1.0em; }

#lbClose { width: 24px; height: 28px; float: right; margin-bottom: 1px; }
	#lbClose.grey { background: url(images/closelabel.gif) no-repeat; }
	#lbClose.red { background: url(images/close_red.png) no-repeat; }
	#lbClose.green { background: url(images/close_green.png) no-repeat; }
	#lbClose.blue { background: url(images/close_blue.png) no-repeat; }
	#lbClose.gold { background: url(images/close_gold.png) no-repeat; }

#lbPlay { width: 64px; height: 28px; float: right; margin-bottom: 1px; }
	#lbPlay.grey { background: url(images/play_grey.png) no-repeat; }
	#lbPlay.red { background: url(images/play_red.png) no-repeat; }
	#lbPlay.green { background: url(images/play_green.png) no-repeat; }
	#lbPlay.blue { background: url(images/play_blue.png) no-repeat; }
	#lbPlay.gold { background: url(images/play_gold.png) no-repeat; }
	
#lbPause { width: 64px; height: 28px; float: right; margin-bottom: 1px; }
	#lbPause.grey { background: url(images/pause_grey.png) no-repeat; }
	#lbPause.red { background: url(images/pause_red.png) no-repeat; }
	#lbPause.green { background: url(images/pause_green.png) no-repeat; }
	#lbPause.blue { background: url(images/pause_blue.png) no-repeat; }
	#lbPause.gold { background: url(images/pause_gold.png) no-repeat; }



/*BOF Options as Images*/
SPAN.optionsAvailable {
font-family: 'Open Sans', Arial, sans-serif;
font-size:100%;
color: #f0a480;
font-weight: bold;
}
/*EOF Options as Images*/




/*BOF - Zappo - Option Types v2 - Progress Bar */
.progress{
  width: 1px;
  height: 12px;
  color: grey;
 font-size:100%;
 /* overflow: hidden; */
  background-color: #bbc3d3;
  padding-left: 5px;
}
.bar{
  border-style: solid;
  border-width: 1px;
  border-color: #bbc3d3;
}
/*EOF - Zappo - Option Types v2 - Progress Bar */

/*BOF - Zappo - Option Types v2 - ONE LINE - Preload Option Type Images */
div#ImagePreload { display: none; }






.pl_product_name {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
  color: <?php echo FONT_COLOR_PL_PRODUCT_NAME; ?>;
  line-height:1.2;
}

.pl_categories_name {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
  color: <?php echo FONT_COLOR_PL_CATEGORIES_NAME; ?>;
  font-weight: bold;
  line-height:1.2;
}

.pl_expire_date {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
  color: <?php echo FONT_COLOR_PL_EXPIRE_DATE; ?>;
  line-height:1.2;
}

.pl_manufacturers_name {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
  color: <?php echo FONT_COLOR_PL_MANUFACTURERS_NAME; ?>;
  line-height:1.2;
}

.pl_product_price {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
  color: <?php echo FONT_COLOR_PL_PRODUCT_PRICE; ?>;
  line-height:1.2;
}

.pl_product_special_price {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
  color: <?php echo FONT_COLOR_PL_PRODUCT_SPECIAL_PRICE; ?>;
  line-height:1.2;
}

.pl_product_plots_price {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
  color: <?php echo FONT_COLOR_PL_PRODUCT_PLOTS_PRICE; ?>;
  line-height:1.2;
}

.pl_product_unidade_venda {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
  color: <?php echo FONT_COLOR_PL_PRODUCT_UNIDADE_VENDA; ?>;
  line-height:1.2;
}

.pl_style_border_div {
  border: #EEEEEE solid 1px;
  padding: <?php echo STYLE_PADDING_BORDER; ?>;
  text-align: <?php echo ALIGN_PL_PRODUCT_DATA; ?>;
}

<?php if (ENABLE_BORDER_PRODUCTS_ONMOUSEOVER == 'true') { ?>
div.pl_style_border_div:hover {
  border:<?php echo COLOR_BORDER_PRODUCTS_ONMOUSEOVER; ?> solid 1px;
  padding: <?php echo STYLE_PADDING_BORDER; ?>;
/*  -moz-border-radius: 15px;
  -webkit-border-radius: 15px;
  border-radius: 15px;  */
}
<?php } ?>

.pp_product_name {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:150%;
  color: <?php echo FONT_COLOR_PP_PRODUCT_NAME; ?>;
  font-weight: bold;
}

.pp_product_model {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
  color: <?php echo FONT_COLOR_PP_PRODUCT_MODEL; ?>;
}

.pp_product_price {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
  color: <?php echo FONT_COLOR_PP_PRODUCT_PRICE; ?>;
  font-weight: bold;
}

.pp_product_special_price {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
  color: <?php echo FONT_COLOR_PP_PRODUCT_SPECIAL_PRICE; ?>;
  font-weight: bold;
}

.pp_product_plots_price {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
  color: <?php echo FONT_COLOR_PP_PRODUCT_PLOTS_PRICE; ?>;
  font-weight: bold;
}

.pp_product_expire_date {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
  color: <?php echo FONT_COLOR_PP_PRODUCT_EXPIRE_DATE; ?>;
}

.pp_product_manufacturer {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
  color: <?php echo FONT_COLOR_PP_PRODUCT_MANUFACTURER; ?>;
}

.pp_product_unidade_venda {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
  color: <?php echo FONT_COLOR_PP_PRODUCT_UNIDADE_VENDA; ?>;
}

.pp_product_stock_status {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
  color: <?php echo FONT_COLOR_PP_PRODUCT_STOCK_STATUS; ?>;
}


.line_header_menu {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
  color: #000000;
}

.line_header_main_menu {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
  color: #FFFFFF;
}
	
<?php 
if ($background_header != "" || HEADER_BACKGROUND != "") {
?>
.background_header {
  <?php
  if (HEADER_BACKGROUND != "") {
  ?>
  background: <?php echo HEADER_BACKGROUND; ?>;
  <?php
  }else{
  ?>
  background-image:url(<?php echo DIR_WS_IMAGES . $background_header; ?>);
  <?php
if ($layout["background_header"] != ""){ 
	$background_header = DIR_WS_IMAGES . $layout["background_header"];
	list($width_header, $height_header, $type_header, $attr_header) = getimagesize($background_header);
	if ($height_header != ""){
		$height_header_ok = '  height: '.$height_header.';';
	}
}
  }
  ?>
<?php
/*if (ROUND_CORNER_HEADER_BACKGROUND != ""){
?>	
  padding:5px;
  -moz-border-radius: <?php if (ROUND_CORNER_HEADER_BACKGROUND != "") { echo ROUND_CORNER_HEADER_BACKGROUND; } ?>;
  -webkit-border-radius: <?php if (ROUND_CORNER_HEADER_BACKGROUND != "") { echo ROUND_CORNER_HEADER_BACKGROUND; } ?>;
  border-radius: <?php if (ROUND_CORNER_HEADER_BACKGROUND != "") { echo ROUND_CORNER_HEADER_BACKGROUND; } ?>;
<?php }*/ ?>
}
<?php } ?>

.text_footer_info_pages {
  font-family: 'Open Sans', Arial, sans-serif;
 font-size:100%;
  color: <?php echo FONT_COLOR_TEXT_FOOTER_INFO_PAGES; ?>;
  line-height:1.2;
}

<?php if (BACKGROUND_COLOR_LINE_HEADER) { ?>
.background_content_header {
  background: <?php echo BACKGROUND_COLOR_LINE_HEADER; ?>;
<?php
if (ROUND_CORNER_BACKGROUND_LINE_HEADER != ""){
?>	
  filter: alpha(opacity=80);
  /* IE */
  -moz-opacity: 0.8;
  /* Mozilla */
  opacity: 0.8;
  /* CSS3 */
  padding:5px;
  -moz-border-radius: <?php if (ROUND_CORNER_BACKGROUND_LINE_HEADER != "") { echo ROUND_CORNER_BACKGROUND_LINE_HEADER; } ?>;
  -webkit-border-radius: <?php if (ROUND_CORNER_BACKGROUND_LINE_HEADER != "") { echo ROUND_CORNER_BACKGROUND_LINE_HEADER; } ?>;
  border-radius: <?php if (ROUND_CORNER_BACKGROUND_LINE_HEADER != "") { echo ROUND_CORNER_BACKGROUND_LINE_HEADER; } ?>;
<?php } ?>
}
<?php } ?>

<?php if (BACKGROUND_COLOR_BOX_SHOPPINGCART_HEADER) { ?>
.background_content_header_box_shopping_cart {
  background-color: <?php echo BACKGROUND_COLOR_BOX_SHOPPINGCART_HEADER; ?>;
<?php
if (ROUND_CORNER_BOX_SHOPPINGCART_HEADER != ""){
?>
  filter: alpha(opacity=80);
  /* IE */
  -moz-opacity: 0.8;
  /* Mozilla */
  opacity: 0.8;
  /* CSS3 */
  padding:5px;
  -moz-border-radius: <?php if (ROUND_CORNER_BOX_SHOPPINGCART_HEADER != "") { echo ROUND_CORNER_BOX_SHOPPINGCART_HEADER; } ?>;
  -webkit-border-radius: <?php if (ROUND_CORNER_BOX_SHOPPINGCART_HEADER != "") { echo ROUND_CORNER_BOX_SHOPPINGCART_HEADER; } ?>;
  border-radius: <?php if (ROUND_CORNER_BOX_SHOPPINGCART_HEADER != "") { echo ROUND_CORNER_BOX_SHOPPINGCART_HEADER; } ?>;
<?php } ?>
}
<?php } ?>

<?php if (FONT_COLOR_BOX_SHOPPINGCART_HEADER) { ?>
.line_header_box_shopping_cart {
  font-family: 'Open Sans', Arial, sans-serif;
  color: <?php echo FONT_COLOR_BOX_SHOPPINGCART_HEADER; ?>;
}
<?php } ?>

.markermenu{
width: 100%; /*width of menu*/
}

.markermenu ul{
list-style-type: none;
padding: 10px 0 10px 0;
padding: 0;
border: 0px solid #9A9A9A;
}

.markermenu ul li a{
background: white url(images/arrow-list.gif) no-repeat 2px center;
font: bold 24px 'Open Sans', Arial, sans-serif;
color: #00014e;
display: block;
width: auto;
padding: 10px 0 10px 0;
padding-left: 20px;
text-decoration: none;
border-bottom: 1px solid #B5B5B5;
}


* html .markermenu ul li a{ /*IE only. Actual menu width minus left padding of LINK (20px) */
width: 100%;
}

.markermenu ul li a:visited, .markermenu ul li a:active{
color: #00014e;
}

.markermenu ul li a:hover{
color: black;
background-color: #DAF1FF;
background-image:url(images/arrow-list-red.gif); /*onMouseover image change. Remove if none*/
}

/* Holly Hack for IE \*/
* html .markermenu ul li { height: 1%; }
* html .markermenu ul li a { height: 1%; }
/* End */

</style>