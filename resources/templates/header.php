<?php

/*
**************************************************************************************************************************
** CORAL Resources Module v. 1.0
**
** Copyright (c) 2010 University of Notre Dame
**
** This file is part of CORAL.
**
** CORAL is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
**
** CORAL is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.
**
** You should have received a copy of the GNU General Public License along with CORAL.  If not, see <http://www.gnu.org/licenses/>.
**
**************************************************************************************************************************
*/


include_once 'user.php';

$util = new Utility();
$config = new Configuration();

//get the current page to determine which menu button should be depressed
$currentPage = $_SERVER["SCRIPT_NAME"];
$parts = Explode('/', $currentPage);
$currentPage = $parts[count($parts) - 1];

//get CORAL URL for 'Change Module' and logout link.
$coralURL = $util->getCORALURL();

$target = getTarget();
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="public">
<title>Resources Module - <?php echo $pageTitle; ?></title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/thickbox.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../css/datePicker.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../css/jquery.autocomplete.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/jquery.tooltip.css" type="text/css" media="screen" />
<link rel="SHORTCUT ICON" href="images/favicon.ico" />
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="../js/plugins/Gettext.js"></script>
<script type="text/javascript" src="../js/plugins/translate.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link  rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="../js/plugins/jquery.autocomplete.js"></script>
<script type="text/javascript" src="../js/plugins/datejs-patched-for-i18n.js"></script>
<script type="text/javascript" src="../js/plugins/jquery.datePicker-patched-for-i18n.js"></script>
<script type="text/javascript" src="../js/common.js"></script>
<script type="text/javascript" src="js/common.js"></script>

<?php
if (isset($customJSInclude)) {
    echo $customJSInclude;
}
?>
<script type="text/javascript">
Date.format = '<?php echo return_datepicker_date_format(); ?>';
const CORAL_NUMBER_LOCALE='<?php echo str_replace('_', '-', return_number_locale()); ?>';
const CORAL_NUMBER_DECIMALS='<?php echo return_number_decimals(); ?>';
</script>
<?php

    // Add translation for the JavaScript files
    global $http_lang;
    $str = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,5);
    $default_l = $lang_name->getLanguage($str);
    if($default_l==null || empty($default_l)){$default_l=$str;}
    if(isset($_COOKIE["lang"])){
        if($_COOKIE["lang"]==$http_lang && $_COOKIE["lang"] != "en_US"){
            echo "<link rel='gettext' type='application/x-po' href='./locale/".$http_lang."/LC_MESSAGES/messages.po' />";
        }
    }else if($default_l==$http_lang && $default_l != "en_US"){
            echo "<link rel='gettext' type='application/x-po' href='./locale/".$http_lang."/LC_MESSAGES/messages.po' />";
    }
?>
<script type="text/javascript">
Date.format = '<?php echo return_datepicker_date_format(); ?>';
</script>
</head>
<body>
<noscript><font face='arial'><?php echo _("JavaScript must be enabled in order for you to use CORAL. However, it seems JavaScript is either disabled or not supported by your browser. To use CORAL, enable JavaScript by changing your browser options, then ");?><a href=""><?php echo _("try again");?></a>. </font></noscript>

<div class="wrapper">
<center>

<table id="main-table">

<tr>
<td style='vertical-align:top;'>
<div style="text-align:left;">

<center>

<table class="titleTable" style="width:1024px;text-align:left;">

    <tr style='vertical-align:top;'>
        <td style='height:53px;' colspan='3'>

            <div id="main-title">
                <img src="images/title-icon-resources.png" />
                <span id="main-title-text"><?php echo _("Resources"); ?></span>
                <span id="powered-by-text"><?php echo _("Powered by");?><img src="images/logo-coral.jpg" /></span>
            </div>

            <div id="menu-login" style='margin-top:1px;'>
                <span class='smallText' style='color:#526972;'>
                <?php
                    echo _("Hello") . ", ";
                    //user may not have their first name / last name set up
                    if ($user->lastName){
                        echo $user->firstName . " " . $user->lastName;
                    }else{
                        echo $user->loginID;
                    }
                ?>
                </span><br />

            <?php if($config->settings->authModule == 'Y'){ echo "<a href='" . $coralURL . "auth/?logout' id='logout' title='" . _("logout") . "'>" . _("logout") . "</a><span id='divider'> | </span><a href='https://js-erm-helps.bc.sirsidynix.net/' id='help' $target>" . _("Help") . "</a><span id='divider'> | </span>"; } ?>

            <?php $lang_name->getLanguageSelector(); ?>

            </div>

        </td>
    </tr>

<tr style='vertical-align:top'>
<td style='width:870px;height:19px;' id="main-menu-titles" colspan="2">

    <a href='index.php' title="<?php echo _("Home") ?>">
        <div class="main-menu-link <?php if ($currentPage == 'index.php') { echo "active"; } ?>">
            <img src="images/menu/icon-home.png" />
            <span><?php echo _("Home");?></span>
        </div>
    </a>

<?php if ($user->isAdmin() || $user->canEdit()){ ?>
<!--    <a href='ajax_forms.php?action=getNewResourceForm&height=503&width=775&resourceID=&modal=true' class='thickbox' id='newResource' title="<?php echo _("New Resource"); ?>"> -->
        <a href= 'javascript:void(0)' onclick='javascript:myDialog("ajax_forms.php?action=getNewResourceForm&height=",1000,1000)' class='thickbox' id='newResource' title="<?php echo _("New Resource"); ?>">
        <div class="main-menu-link">
            <img src="images/menu/icon-plus-square.png" />
            <span><?php echo _("New Resource");?></span>
        </div>
    </a>

    <a href='queue.php' title="<?php echo _("My Queue");?>">
        <div class="main-menu-link <?php if ($currentPage == 'queue.php') { echo "active"; } ?>">
            <img src="images/menu/icon-queue.png" />
            <span><?php echo _("My Queue");?></span>
        </div>
    </a>

    <a href='import.php' title="<?php echo _("Import");?>">
        <div class="main-menu-link <?php if ($currentPage == 'import.php') { echo "active"; } ?>">
            <img src="images/menu/icon-import.png" />
            <span><?php echo _("File Import");?></span>
        </div>
    </a>
    <?php if ($config->settings->ebscoKbEnabled == 'Y'): ?>
        <a href='ebsco_kb.php' title="<?php echo _("EBSCO Kb");?>">
            <div class="main-menu-link <?php if ($currentPage == 'ebsco_kb.php') { echo "active"; } ?>">
                <img src="images/menu/icon-ebsco.png" />
                <span><?php echo _("EBSCO Kb");?></span>
            </div>
        </a>
    <?php endif; ?>


<?php if ($config->settings->enhancedCostHistory == "Y") { ?>
    <a href='dashboard_menu.php' title="<?php echo _("Dashboards");?>">
        <div class="main-menu-link <?php if (substr($currentPage, 0, 9) === 'dashboard') { echo "active"; } ?>">
            <img src="images/menu/icon-dashboards.png" />
            <span><?php echo _("Dashboards");?></span>
        </div>
    </a>
<?php } ?>

	<?php if ($user->isAdmin()) { ?>
    <a href='admin.php' title="<?php echo _("Admin");?>">
        <div class="main-menu-link <?php if ($currentPage == 'admin.php') { echo "active"; } ?>">
            <img src="images/menu/icon-admin.png" />
            <span><?php echo _("Admin");?></span>
        </div>
    </a>
	<?php } ?>
<?php } ?>

</td>

<td style='width:130px;height:19px;' align='right'>
<?php

//only show the 'Change Module' if there are other modules installed or if there is an index to the main CORAL page

if ((file_exists($util->getCORALPath() . "index.php")) || ($config->settings->licensingModule == 'Y') || ($config->settings->organizationsModule == 'Y') || ($config->settings->managementModule == 'Y') || ($config->settings->usageModule == 'Y')) {

	?>

	<div style='text-align:left;'>
		<ul class="tabs">
	        <li id="change-mod-menu"><span><?php echo _("Change Module");?></span><i class="fa fa-chevron-down"></i>
			<ul class="coraldropdown">
				<?php if (file_exists($util->getCORALPath() . "index.php")) {?>
				<li class="change-mod-item"><a href="<?php echo $coralURL . '"' . $target; ?> title="<?php echo _("Main Menu"); ?>"><img src='images/change/icon-mod-main.png'><span><?php echo _("Main Menu");?></span></a></li>
				<?php
				}
				if ($config->settings->organizationsModule == 'Y') {
				?>
				<li class="change-mod-item"><a href="<?php echo $coralURL . 'organizations/"' . $target; ?> title="<?php echo _("Organizations module"); ?>"><img src='images/change/icon-mod-organizations.png'><span><?php echo _("Organizations");?></span></a></li>
				<?php
				}
				if ($config->settings->licensingModule == 'Y') {
				?>
				<li class="change-mod-item"><a href="<?php echo $coralURL . 'licensing/"' . $target; ?> title="<?php echo _("Licensing module"); ?>"><img src='images/change/icon-mod-licensing.png'><span><?php echo _("Licensing");?></span></a></li>
				<?php
				}
				if ($config->settings->usageModule == 'Y') {
				?>
				<li class="change-mod-item"><a href="<?php echo $coralURL . 'usage/"' . $target; ?> title="<?php echo _("Usage Statistics module"); ?>"><img src='images/change/icon-mod-usage.png'><span><?php echo _("Usage Statistics");?></span></a></li>
				<?php
				}
				if ($config->settings->managementModule == 'Y') {
				?>
				<li class="change-mod-item"><a href="<?php echo $coralURL . 'management/"' . $target; ?> title="<?php echo _("Management module"); ?>"><img src='images/change/icon-mod-management.png'><span><?php echo _("Management");?></span></a></li>
				<?php } ?>
			</ul>
		</li>
		</ul>
	</div>
	<?php

} else {
	echo "&nbsp;";
}

?>

</td>
</tr>
</table>
	<script>
        $("#lang").change(function() {
            setLanguage($("#lang").val());
            location.reload();
        });

        function setLanguage(lang) {
			var wl = window.location, now = new Date(), time = now.getTime();
            var cookievalid=2592000000; // 30 days (1000*60*60*24*30)
            time += cookievalid;
			now.setTime(time);
			document.cookie ='lang='+lang+';path=/'+';domain='+wl.hostname+';expires='+now;
	    }
    </script>
<span id='span_message' class='darkRedText' style='text-align:left;'><?php if (isset($_POST['message'])) echo $_POST['message']; if (isset($errorMessage)) echo $errorMessage; ?></span>
