<!-- banner footer -->
<?php 
	include(DIR_WS_BOXES . 'column_banner_footer.php');
?>
<!-- banner footer eof -->

<?php
include(DIR_WS_MODULES . 'viewed_products.php');
?>

<?php
// layout

if ($_GET['cPath']) {
		
	if (strstr($_GET['cPath'], '_')) {
	$get_cPath = explode("_", $_GET['cPath']);
	$cPath_ok = $get_cPath[0] . ',' . $get_cPath[1];
	}else{
	$cPath_ok = $_GET['cPath'];
	}

if ($_GET['layout_id'] != '') {

$layout = tep_random_select("select id, title, language_id, logo, background_header, background_header_right, background_footer, status, cPath, page, date_scheduled, expires_date, background_site, background_site_content from " . TABLE_LAYOUT . " WHERE language_id IN('".$languages_id."','ALL') and cPath IN(0,".tep_db_input($cPath_ok).") and page IN(0,1) and id = '".$_GET['layout_id']."' ");

}else{

$layout = tep_random_select("select id, title, language_id, logo, background_header, background_header_right, background_footer, status, cPath, page, date_scheduled, expires_date, background_site, background_site_content from " . TABLE_LAYOUT . " WHERE status = '1' and language_id IN('".$languages_id."','ALL') and cPath IN(0,".tep_db_input($cPath_ok).") and page IN(0,1) and template_folder = '".$layout_template_folder."' ");

}

} elseif($page_type) {

if ($_GET['layout_id'] != '') {

$layout = tep_random_select("select id, title, language_id, logo, background_header, background_header_right, background_footer, status, cPath, page, date_scheduled, expires_date, background_site, background_site_content from " . TABLE_LAYOUT . " WHERE language_id IN('".$languages_id."','ALL') and page IN(0,'".tep_db_input($page_type)."') and id = '".$_GET['layout_id']."' ");

}else{

$layout = tep_random_select("select id, title, language_id, logo, background_header, background_header_right, background_footer, status, cPath, page, date_scheduled, expires_date, background_site, background_site_content from " . TABLE_LAYOUT . " WHERE status = '1' and language_id IN('".$languages_id."','ALL') and page IN(0,'".tep_db_input($page_type)."') and template_folder = '".$layout_template_folder."' ");

}

} else {

if ($_GET['layout_id'] != '') {

$layout = tep_random_select("select id, title, language_id, logo, background_header, background_header_right, background_footer, status, cPath, page, date_scheduled, expires_date, background_site, background_site_content from " . TABLE_LAYOUT . " WHERE language_id IN('".$languages_id."','ALL') and page = '0'and id = '".$_GET['layout_id']."' ");

}else{

$layout = tep_random_select("select id, title, language_id, logo, background_header, background_header_right, background_footer, status, cPath, page, date_scheduled, expires_date, background_site, background_site_content from " . TABLE_LAYOUT . " WHERE status = '1' and language_id IN('".$languages_id."','ALL') and page = '0' and template_folder = '".$layout_template_folder."' ");

}

}

	if ($layout["page"] == $page_type) {
	
	$background_footer = DIR_WS_IMAGES . $layout["background_footer"];
	
	}else{
	
	$background_footer = DIR_WS_IMAGES . $layout["background_footer"];	
	}

	if ($layout["background_footer"] == '') {
	
	if ($_GET['layout_id'] != '') {
	
	$layout = tep_random_select("select id, title, language_id, logo, background_header, background_header_right, background_footer, status, cPath, page, date_scheduled, expires_date, background_site, background_site_content from " . TABLE_LAYOUT . " WHERE page = '0' and id = '".$_GET['layout_id']."' ");
	
	}else{
	
	$layout = tep_random_select("select id, title, language_id, logo, background_header, background_header_right, background_footer, status, cPath, page, date_scheduled, expires_date, background_site, background_site_content from " . TABLE_LAYOUT . " WHERE status = '1' and page = '0' ");
	
	}
	
	$background_footer = DIR_WS_IMAGES . $layout["background_footer"];
	
	}

// layout eof
?>
<?php if ($layout["background_site_content"] != '') { ?>
      </td>
  </tr>
</table>
<?php } ?>
<!-- background site content eof -->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
</table> 

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="10">&nbsp;</td>
    <td align="center"><?php
    $configuration_querys = tep_db_query('select configuration_key as cfgKey, configuration_value as cfgValue from configuration where configuration_group_id=17 order by configuration_title');
    while ($configurations = tep_db_fetch_array($configuration_querys)) {
        if ($configurations['cfgValue'] == 'True') {
        echo tep_image(DIR_WS_IMAGES . $configurations['cfgKey'], '', '', ' align="absmiddle"') . ' ';
        }
    }
    ?></td>
    <td width="10">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center"><?php echo '<a href="' . tep_href_link('sitemap.php') . '">' . tep_draw_separator('pixel_trans.gif', '1', '1') . '</a>'; ?><?php echo '<a href="' . tep_href_link('sitemapcategories.php') . '">' . tep_draw_separator('pixel_trans.gif', '1', '1') . '</a>'; ?><?php echo '<a href="' . tep_href_link('sitemapproducts.php') . '">' . tep_draw_separator('pixel_trans.gif', '1', '1') . '</a>'; 
		
if (USE_DEFAULT_MOBILE_SITE == true) {
	
	echo '<a href="' . tep_href_link('sitemapmob.php') . '">' . tep_draw_separator('pixel_trans.gif', '1', '1') . '</a>'; ?><?php echo '<a href="' . tep_href_link('sitemapcategoriesmob.php') . '">' . tep_draw_separator('pixel_trans.gif', '1', '1') . '</a>'; ?><?php echo '<a href="' . tep_href_link('sitemapproductsmob.php') . '">' . tep_draw_separator('pixel_trans.gif', '1', '1') . '</a>'; 
	
	}	
		
		?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center"><?php
    $configuration_queryp = tep_db_query('select configuration_key as cfgKey, configuration_value as cfgValue from configuration where configuration_group_id=18 order by configuration_title');
    while ($configurationp = tep_db_fetch_array($configuration_queryp)) {
        if ($configurationp['cfgValue'] == 'True') {
        echo tep_image(DIR_WS_IMAGES . $configurationp['cfgKey'], '', '', ' align="absmiddle"') . ' ';
        }
    }
    ?></td>
    <td>&nbsp;</td>
  </tr>
</table>
<?php
if (SHOW_HIDE_USERS_ONLINE_FOOTER == 'show') {
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="main" align="center"><?php
require(DIR_WS_BOXES . 'usersonline1.php');
?></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<?php
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" <?php if ($layout["background_footer"]) { echo 'background="'.$background_footer.'"'; }else{ echo 'class="bkgfooter"'; } ?>>
  <tr>
    <td align="center"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="5">
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
      <table width="95%" border="0" align="center" cellpadding="0" cellspacing="5">
      <tr>
        <td style="border-right:#CCCCCC solid 1px;" class="smallText" valign="top">
        	<table border="0" align="center" cellpadding="0" cellspacing="5">
              <tr>
                <td valign="top" class="smallText">
				<?php
                require(DIR_WS_BOXES . 'extra_info_pages_footer.php');
                ?>
                </td>
                <td width="10">&nbsp;</td>
                <td class="smallText" valign="top">
                <?php
                require(DIR_WS_BOXES . 'affiliate1.php'); 
                ?>
                </td>
              </tr>
        	</table>
        <td width="10">&nbsp;</td>
        <td style="border-right:#CCCCCC solid 1px;">
		<?php
/*		if (ENABLE_LIVEHELP == 'true') {
			if (VIEW_LIVEHELP == 'true') {
		echo '<table border="0" cellpadding="0" cellspacing="5">';
		echo '<tr>';
		echo '<td>';
		
		if ($language == 'portugues') {
		echo "<a href=\"".URL_LIVE_HELP_MFORMULA."client.php?locale=pt-br\" target=\"_blank\" onclick=\"if(navigator.userAgent.toLowerCase().indexOf('opera') != -1 &amp;&amp; window.event.preventDefault) window.event.preventDefault();this.newWindow = window.open('".URL_LIVE_HELP_MFORMULA."client.php?locale=pt-br&amp;url='+escape(document.location.href)+'&amp;referrer='+escape(document.referrer), 'webim', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=480,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;\"><img src=\"".URL_LIVE_HELP_MFORMULA."button.php?image=webim&amp;lang=pt-br\" border=\"0\" alt=\"\"/></a>";
		}elseif ($language == 'english') {
		echo "<a href=\"".URL_LIVE_HELP_MFORMULA."client.php?locale=en\" target=\"_blank\" onclick=\"if(navigator.userAgent.toLowerCase().indexOf('opera') != -1 &amp;&amp; window.event.preventDefault) window.event.preventDefault();this.newWindow = window.open('".URL_LIVE_HELP_MFORMULA."client.php?locale=en&amp;url='+escape(document.location.href)+'&amp;referrer='+escape(document.referrer), 'webim', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=480,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;\"><img src=\"".URL_LIVE_HELP_MFORMULA."button.php?image=webim&amp;lang=en\" border=\"0\"alt=\"\"/></a>";	
		}elseif ($language == 'espanol') {
		echo "<a href=\"".URL_LIVE_HELP_MFORMULA."client.php?locale=sp\" target=\"_blank\" onclick=\"if(navigator.userAgent.toLowerCase().indexOf('opera') != -1 &amp;&amp; window.event.preventDefault) window.event.preventDefault();this.newWindow = window.open('".URL_LIVE_HELP_MFORMULA."client.php?locale=sp&amp;url='+escape(document.location.href)+'&amp;referrer='+escape(document.referrer), 'webim', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=480,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;\"><img src=\"".URL_LIVE_HELP_MFORMULA."button.php?image=webim&amp;lang=sp\" border=\"0\" alt=\"\"/></a>";	
		}elseif ($language == 'japanese') {
		echo "<a href=\"".URL_LIVE_HELP_MFORMULA."client.php?locale=en\" target=\"_blank\" onclick=\"if(navigator.userAgent.toLowerCase().indexOf('opera') != -1 &amp;&amp; window.event.preventDefault) window.event.preventDefault();this.newWindow = window.open('".URL_LIVE_HELP_MFORMULA."client.php?locale=en&amp;url='+escape(document.location.href)+'&amp;referrer='+escape(document.referrer), 'webim', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=480,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;\"><img src=\"".URL_LIVE_HELP_MFORMULA."button.php?image=webim&amp;lang=en\" border=\"0\" alt=\"\"/></a>";	
		}
		
		echo '</td>';
		echo '</tr>';
		echo '</table>';
			}
		}*/

		if (VIEW_ONLINE_MSN == 'true_footer') {
		echo '<table border="0" cellpadding="0" cellspacing="5">';
		echo '<tr>';
		echo '<td class="main" align="center">' . CODE_ONLINE_MSN . '</td>';
		echo '</tr>';
		echo '</table>';
		}

		if (PHONE_CALL != '') {
		echo '<table border="0" cellpadding="0" cellspacing="5">';
		echo '<tr>';
		echo '<td>'.tep_image(DIR_WS_IMAGES . 'telephone_32.png', '', '', ' align="absmiddle"').'</td>';
		echo '<td class="main" align="left" style="font-size:13px; line-height: 1.2; font-weight:bold;">' . PHONE_CALL . '</td>';
		echo '</tr>';
		echo '</table>';
		}
	
		if (defined('VIEW_MSN') && VIEW_MSN == 'true') {
		echo '<table border="0" cellpadding="0" cellspacing="5">';
		echo '<tr>';
		echo '<td><a href="msnim:add?contact='.MSN.'">'.tep_image(DIR_WS_IMAGES . 'icon_msn.png', '', '', ' align="absmiddle"').'</a></td>';
		echo '<td class="main" align="left" style="font-size:12px;"><a href="msnim:add?contact='.MSN.'">' . MSN . '</a></td>';
		echo '</tr>';
		echo '</table>';
		}
	
		if (VIEW_SKYPE == 'true') {
		echo '<table border="0" cellpadding="0" cellspacing="5">';
		echo '<tr>';
		echo '<td><a href="skype:'.SKYPE.'?add">'.tep_image(DIR_WS_IMAGES . 'icon_skype.png', '', '', ' align="absmiddle"').'</a></td>';
		echo '<td class="main" align="left" style="font-size:12px;"><a href="skype:'.SKYPE.'?add">' . SKYPE . '</a></td>';
		echo '</tr>';
		echo '</table>';
		}

        ?>
        </td>
        <td width="10">&nbsp;</td>
        <td>
        <table border="0" cellspacing="5" cellpadding="0">
          <tr>
            <td align="center">
            <?php 
            if ( (URL_LINK_NS_FACEBOOK) && (IMAGE_LINK_NS_FACEBOOK) ) {		
            echo '&nbsp;<a href="'.URL_LINK_NS_FACEBOOK.'" target="_blank">'.tep_image(IMAGE_LINK_NS_FACEBOOK, URL_LINK_NS_FACEBOOK, '', '', ' align="absmiddle"').'</a>';
            }
            if ( (URL_LINK_NS_TWITTER) && (IMAGE_LINK_NS_TWITTER) ) {
            echo '&nbsp;<a href="'.URL_LINK_NS_TWITTER.'" target="_blank">'.tep_image(IMAGE_LINK_NS_TWITTER, '', '', '', ' align="absmiddle" ').'</a>'; 
            }
            if ( (URL_LINK_NS_ORKUT) && (IMAGE_LINK_NS_ORKUT) ) {
            echo '&nbsp;<a href="'.URL_LINK_NS_ORKUT.'" target="_blank">'.tep_image(IMAGE_LINK_NS_ORKUT, '', '', '', ' align="absmiddle" ').'</a>'; 
            }
            if ( (URL_LINK_NS_LINKEDIN) && (IMAGE_LINK_NS_LINKEDIN) ) {
            echo '&nbsp;<a href="'.URL_LINK_NS_LINKEDIN.'" target="_blank">'.tep_image(IMAGE_LINK_NS_LINKEDIN, '', '', '', ' align="absmiddle" ').'</a>'; 
            }
            if ( (URL_LINK_NS_FLICKR) && (IMAGE_LINK_NS_FLICKR) ) {
            echo '&nbsp;<a href="'.URL_LINK_NS_FLICKR.'" target="_blank">'.tep_image(IMAGE_LINK_NS_FLICKR, '', '', '', ' align="absmiddle" ').'</a>'; 
            }
            if ( (URL_LINK_NS_YOUTUBE) && (IMAGE_LINK_NS_YOUTUBE) ) {
            echo '&nbsp;<a href="'.URL_LINK_NS_YOUTUBE.'" target="_blank">'.tep_image(IMAGE_LINK_NS_YOUTUBE, '', '', '', ' align="absmiddle" ').'</a>'; 
            }
			if ( (URL_LINK_NS_INSTAGRAM) && (IMAGE_LINK_NS_INSTAGRAM) ) {
            echo '&nbsp;<a href="'.URL_LINK_NS_INSTAGRAM.'" target="_blank">'.tep_image(IMAGE_LINK_NS_INSTAGRAM, '', '', '', ' align="absmiddle" ').'</a>'; 
            }
			if ( (URL_LINK_NS_PINTEREST) && (IMAGE_LINK_NS_PINTEREST) ) {
            echo '&nbsp;<a href="'.URL_LINK_NS_PINTEREST.'" target="_blank">'.tep_image(IMAGE_LINK_NS_PINTEREST, '', '', '', ' align="absmiddle" ').'</a>'; 
            }
//			if (NS_GOOGLEPLUS != '') {
//            echo '&nbsp;' . NS_GOOGLEPLUS; 
//            }
            if ( (NS_GOOGLEPLUS) && (IMAGE_LINK_NS_GOOGLE_PLUS) ) {
            echo '&nbsp;<a href="'.NS_GOOGLEPLUS.'" target="_blank">'.tep_image(IMAGE_LINK_NS_GOOGLE_PLUS, '', '', '', ' align="absmiddle" ').'</a>'; 
            }
            echo '&nbsp;<a href="' . FILENAME_RSS .  '" title="' . BOX_INFORMATION_RSS . '">' .  tep_image(DIR_WS_IMAGES .  "icon_rss.png" , BOX_INFORMATION_RSS, '', '', ' align="absmiddle" ') . '</a>';
            ?></td>
          </tr>
		<?php
        if ( (SHOW_MERCADO_LIVRE == 'True') || (SHOW_TODA_OFERTA == 'True') || (SHOW_EBAY == 'True') ) {
        ?>
          <tr>
            <td align="center">
            <table border="0" cellspacing="5" cellpadding="0" width="100%">
              <tr>
                <?php
                if ( (SHOW_MERCADO_LIVRE == 'True') && (LINK_MERCADO_LIVRE != '') ) {
                ?>
                <td align="center" class="main">
                <?php echo '<a href="'.LINK_MERCADO_LIVRE.'" target="_blank">' . tep_image(DIR_WS_IMAGES . 'logo_mercadolivre.png', 'Qualificações Mercado Livre', '72', '50', ' align="absmiddle"') . '</a>'; ?>
                </td>
                <?php
				}
				?>
                <?php
                if ( (SHOW_TODA_OFERTA == 'True') && (LINK_TODA_OFERTA != '') ) {
                ?>
                <td align="center" class="main">
                <?php echo '<a href="'.LINK_TODA_OFERTA.'" target="_blank">' . tep_image(DIR_WS_IMAGES . 'logo_todaoferta.png', 'Qualificações Toda Oferta', '90', '50', ' align="absmiddle"') . '</a>'; ?>
                </td>
                <?php
				}
				?>
                <?php
                if ( (SHOW_EBAY == 'True') && (LINK_EBAY != '') ) {
                ?>
                <td align="center" class="main">
                <?php echo '<a href="'.LINK_EBAY.'" target="_blank">' . tep_image(DIR_WS_IMAGES . 'logo_ebay.png', 'Qualifications eBay', '78', '50', ' align="absmiddle"') . '</a>'; ?>
                </td>
                <?php
				}
				?>
              </tr>
            </table>
            </td>          
          </tr>
		<?php
        }
        ?>
          <tr>
            <td align="center">
            <table border="0" cellspacing="5" cellpadding="0" width="100%">
              <tr>
                <?php
                if ( (SHOW_EBIT == 'True') && (CODIGO_EBIT_SELO != '') ) {
                ?>
                <td align="center">
                <?php echo CODIGO_EBIT_SELO; ?>
                </td>
                <?php
				}
				?>
                <?php
                if ( (SHOW_FCONTROL_SELO == 'True') && (SHOW_FCONTROL == 'True') ) {
                ?>
                <td align="center">
                <?php echo tep_image(DIR_WS_IMAGES . 'selo_fcontrol.png', 'Soluções em Gerenciamento de Riscos', '41', '52', ' align="absmiddle"'); ?>
                </td>
                <?php
				}
				?>
                <td align="center">
                <?php echo tep_image(DIR_WS_IMAGES . 'positivessl.gif', 'Secured by COMODO - Positive SSL', '', '', ' align="absmiddle"'); ?>
                </td>
                <td align="center">
				<script language="JavaScript">
                function OpenGoogleSafeBrowsing(){
                window.open('http://www.google.com/safebrowsing/diagnostic?site=<?php echo HTTP_SERVER; ?>','googlesafebrowsing','height=540,width=845,top=0,left=0,resizable=no,status=1')
                }
                </script>
				<?php echo '<A HREF=\'javascript:OpenGoogleSafeBrowsing();\' onMouseOver="window.status=\'Safe Browsing - Advisory provided by Google\' ; return true">' . tep_image(DIR_WS_IMAGES . 'button_googlesafebrowsing.png', 'Safe Browsing - Advisory provided by Google', '120', '50', ' border="0" align="absmiddle"') . '</a>'; ?>
                </td>
                <?php
                if (SHOW_NORTON_SAFE_WEB == 'True') {
                ?>
                <td align="center">
                <?php echo '<A HREF="http://safeweb.norton.com/report/show?url='.HTTP_SERVER.'" target="_blank">' . tep_image(DIR_WS_IMAGES . 'button_nortonsafeweb.png', 'Norton Safe Web', '108', '35', ' border="0" align="absmiddle"') . '</a>'; ?>
                </td>
                <?php
				}
				?>
              </tr>
            </table>
            </td>
          </tr>

<?php
if (CODE_SELOS_FOOTER != '') {
?>
          <tr>
            <td align="center">
            <table border="0" cellspacing="5" cellpadding="0" width="100%">
              <tr>
                <td align="center">
                <?php echo CODE_SELOS_FOOTER; ?>
                </td>
              </tr>
            </table>
            </td>
          </tr>
<?php
}
?>

        </table>
        </td>
        <td width="10">&nbsp;</td>
      </tr>
    </table>
      </td>
  </tr>
</table>

<?php
	if (ENABLE_LIVEHELP == 'true') {
	    if (VIEW_LIVEHELP == 'true') {
if ($language == 'portugues') {
echo '<script type="text/javascript" src="'.URL_LIVE_HELP_MFORMULA.'php/app.php?widget-init.js&_lang=pt"></script>';
}elseif ($language == 'english') {
echo '<script type="text/javascript" src="'.URL_LIVE_HELP_MFORMULA.'php/app.php?widget-init.js&_lang=en"></script>';
}elseif ($language == 'espanol') {
echo '<script type="text/javascript" src="'.URL_LIVE_HELP_MFORMULA.'php/app.php?widget-init.js&_lang=es"></script>';
}elseif ($language == 'japanese') {
echo '<script type="text/javascript" src="'.URL_LIVE_HELP_MFORMULA.'php/app.php?widget-init.js&_lang=en"></script>';
}
		}
	}
?>