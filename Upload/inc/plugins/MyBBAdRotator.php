<?php
/*
 * MyBB: MyBB Ad Rotator
 *
 * File: MyBBAdRotator.php
 * 
 * Authors: Jimmy Peña, Vintagedaddyo
 *
 * MyBB Version: 1.8
 *
 * Plugin Version: 1.0
 * 
 */

// disallow direct loading of this file

if (!defined("IN_MYBB")) {
  die("Direct loading of this file is not allowed.");
}

// hook into start and end functions

$plugins->add_hook('index_start', 'inject_ad_code_header');
$plugins->add_hook('index_end', 'inject_ad_code_footer');

// required by MyBB
// info function must have same name as plugin file

function MyBBAdRotator_info()
{
    global $lang;

    $lang->load("MyBBAdRotator");
    
    $lang->MyBBAdRotator_Desc = '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" style="float:right;">' .
        '<input type="hidden" name="cmd" value="_s-xclick">' . 
        '<input type="hidden" name="hosted_button_id" value="AZE6ZNZPBPVUL">' .
        '<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">' .
        '<img alt="" border="0" src="https://www.paypalobjects.com/pl_PL/i/scr/pixel.gif" width="1" height="1">' .
        '</form>' . $lang->MyBBAdRotator_Desc;

    return Array(
        'name' => $lang->MyBBAdRotator_Name,
        'description' => $lang->MyBBAdRotator_Desc,
        'website' => $lang->MyBBAdRotator_Web,
        'author' => $lang->MyBBAdRotator_Auth,
        'authorsite' => $lang->MyBBAdRotator_AuthSite,
        'version' => $lang->MyBBAdRotator_Ver,
        'guid' => $lang->MyBBAdRotator_GUID,
        'compatibility' => $lang->MyBBAdRotator_Compat
    );
}

// optional function that runs when plugin is activated
// must have same name as plugin file

function MyBBAdRotator_activate() {
  global $db, $lang;

    $lang->load("MyBBAdRotator");


  // ***********************************************
  // create plugin settings group
  // ***********************************************

  $mybb_ar_group = array(
    "gid" => "NULL", 
    "name" => $lang->MyBBAdRotator_name_0, 
    "title" => $lang->MyBBAdRotator_title_0, 
    "description" => $lang->MyBBAdRotator_description_0, 
    "disporder" => "1", 
    "isdefault" => "no"
  );
  $db->insert_query("settinggroups", $mybb_ar_group);
  $gid = $db->insert_id();

  // ***********************************************
  // create plugin settings
  // ***********************************************

  $mybb_ar_setting = array(
    "sid" => "NULL", 
    "name" => $lang->MyBBAdRotator_name_1, 
    "title" => $lang->MyBBAdRotator_title_1, 
    "description" => $lang->MyBBAdRotator_description_1, 
    "optionscode" => "yesno", 
    "value" => "1", 
    "disporder" => "1", 
    "gid" => intval($gid)
  );
  $db->insert_query("settings", $mybb_ar_setting);
  // delimiter
  $mybb_ar_setting = array(
    "sid" => "NULL", 
    "name" => $lang->MyBBAdRotator_name_2, 
    "title" => $lang->MyBBAdRotator_title_2, 
    "description" => $lang->MyBBAdRotator_description_2,  
    "optionscode" => "text", 
    "value" => '**** ROTATE ****', 
    "disporder" => "2", 
    "gid" => intval($gid)
  );
  $db->insert_query("settings", $mybb_ar_setting);
  // header code section
  $mybb_ar_setting = array(
    "sid" => "NULL", 
    "name" => $lang->MyBBAdRotator_name_3, 
    "title" => $lang->MyBBAdRotator_title_3, 
    "description" => $lang->MyBBAdRotator_description_3, 
    "optionscode" => "textarea", 
    "value" => '', 
    "disporder" => "3", 
    "gid" => intval($gid)
  );
  $db->insert_query("settings", $mybb_ar_setting);
  // who to show header ads to
  $mybb_ar_setting = array(
    "sid" => "NULL", 
    "name" => $lang->MyBBAdRotator_name_4, 
    "title" => $lang->MyBBAdRotator_title_4, 
    "description" => $lang->MyBBAdRotator_description_4, 
    "optionscode" => "select \n 1=Guests / Unknown Visitors \n 2=Regulars / Logged in Users \n 3=Moderators and Admins \n 4=All (except Banned) \n 5=None (turn off temporarily)", 
    "value" => '1', 
    "disporder" => "4", 
    "gid" => intval($gid)
  );
  $db->insert_query("settings", $mybb_ar_setting);
  // footer code section
  $mybb_ar_setting = array(
    "sid" => "NULL", 
    "name" => $lang->MyBBAdRotator_name_5, 
    "title" => $lang->MyBBAdRotator_title_5, 
    "description" => $lang->MyBBAdRotator_description_5,  
    "optionscode" => "textarea", 
    "value" => '', 
    "disporder" => "5", 
    "gid" => intval($gid)
  );
  $db->insert_query("settings", $mybb_ar_setting);
  // who to show footer ads to
  $mybb_ar_setting = array(
    "sid" => "NULL", 
    "name" => $lang->MyBBAdRotator_name_6, 
    "title" => $lang->MyBBAdRotator_title_6, 
    "description" => $lang->MyBBAdRotator_description_6,  
    "optionscode" => "select \n 1=Guests / Unknown Visitors \n 2=Regulars / Logged in Users \n 3=Moderators and Admins \n 4=All (except Banned) \n 5=None (turn off temporarily)", 
    "value" => '1', 
    "disporder" => "6", 
    "gid" => intval($gid)
  );
  $db->insert_query("settings", $mybb_ar_setting);
  rebuild_settings();
} // end activate function

// optional function that runs when plugin is deactivated
// must have same name as plugin file

function MyBBAdRotator_deactivate() {
  global $db;
  // delete settings first
  $db->query("DELETE FROM " . TABLE_PREFIX . "settings WHERE name IN ('mybb_ar_plugin_enabled')");
  $db->query("DELETE FROM " . TABLE_PREFIX . "settings WHERE name IN ('mybb_ar_delimiter')");
  $db->query("DELETE FROM " . TABLE_PREFIX . "settings WHERE name IN ('mybb_ar_header_code')");
  $db->query("DELETE FROM " . TABLE_PREFIX . "settings WHERE name IN ('mybb_ar_header_who')");
  $db->query("DELETE FROM " . TABLE_PREFIX . "settings WHERE name IN ('mybb_ar_footer_code')");
  $db->query("DELETE FROM " . TABLE_PREFIX . "settings WHERE name IN ('mybb_ar_footer_who')");
  // delete settings group
  $db->query("DELETE FROM " . TABLE_PREFIX . "settinggroups WHERE name='mybb_ar_group'");
  rebuild_settings();
}

// function that runs in header

function inject_ad_code_header() {
  global $mybb;
  global $header;

  // check if plugin is enabled

  $isenabled = (bool)$mybb->settings['mybb_ar_plugin_enabled'];
  if ($isenabled) { // it is
    $code = $mybb->settings['mybb_ar_header_code'];

    if (strlen($code) > 0) { // there is code for the header
      $delim = $mybb->settings['mybb_ar_delimiter'];
      $who = (int)$mybb->settings['mybb_ar_header_who'];
      // current user information
      $currentusergroup = $mybb->user['usergroup'];

      // split the code snippets in the header box into array
      // first check if delimiter is present
      if (strpos($code, $delim) === false) { // just one code, show it
        $codetoadd = $code;
      } else {
        // tokenize code sections into array
        $snippets = explode($delim, $code);
        // choose one randomly
        $codetoadd = getrandomvalue($snippets);
      }
      $codetoadd = '<div class="mybb_ar_header">' . $codetoadd . '</div>';

      // check who should see ads and if current user meets criteria
      switch ($who) {
        case 1: // show to Guests only
          if ($currentusergroup === 1) { // current user is in the Guests usergroup
            $header .= $codetoadd;
          } else {
						$header .= '<!-- MyBB Ad Rotator: Header ads shown to Guests only. Current user is ' . $mybb->user['usertitle'] . ' -->';
					}
          break;
        case 2: // show to Regulars only
          if (!in_array($currentusergroup, array(1,3,4,5,6,7), true)) { // current user is not a guest, moderator, admin, awaiting activation or banned
            $header .= $codetoadd;
          } else {
						$header .= '<!-- MyBB Ad Rotator: Header ads shown to regular users only. Current user is ' . $mybb->user['usertitle'] . ' -->';
					}
          break;
        case 3: // show to Mods/Admins only
          if (in_array($currentusergroup, array(3,4,6))) { // current user is Admin, Mod or Super Mod
            $header .= $codetoadd;
          } else {
						$header .= '<!-- MyBB Ad Rotator: Header ads shown to mods and admins only. Current user is ' . $mybb->user['usertitle'] . ' -->';
					}
          break;
        case 4: // show to All (except Banned)
          if ($currentusergroup != 7) { // not Banned
            $header .= $codetoadd;
          }
          break;
        case 5: // show to None
					$header .= '<!-- MyBB Ad Rotator: Header ads turned off. -->';
          break; // do nothing
      } // end switch
    } // end code existence check
  } // end enabled check
} // end header function

// function that runs in footer
function inject_ad_code_footer() {
  global $mybb;
  global $footer;

  // check if plugin is enabled
  $isenabled = (bool)$mybb->settings['mybb_ar_plugin_enabled'];
  if ($isenabled) { // it is
    $code = $mybb->settings['mybb_ar_footer_code'];

    if (strlen($code) > 0) { // there is code for the footer
      $delim = $mybb->settings['mybb_ar_delimiter'];
      $who = (int)$mybb->settings['mybb_ar_footer_who'];
      // current user information
      $currentusergroup = $mybb->user['usergroup'];

      // split the code snippets in the footer box into array
      // first check if delimiter is present
      if (strpos($code, $delim) === false) { // just one code, show it
        $codetoadd = $code;
      } else {
        // tokenize code sections into array
        $snippets = explode($delim, $code);
        // choose one randomly
        $codetoadd = getrandomvalue($snippets);
      }
      $codetoadd = '<div class="mybb_ar_footer">' . $codetoadd . '</div>';

      // check who should see ads and if current user meets criteria
      switch ($who) {
        case 1: // show to Guests only
          if ($currentusergroup === 1) { // current user is in the Guests usergroup
            $footer = $codetoadd . $footer;
          } else {
						$footer = '<!-- MyBB Ad Rotator: Footer ads shown to Guests only. Current user is ' . $mybb->user['usertitle'] . ' -->' . $footer;
					}
          break;
        case 2: // show to Regulars only
          if (!in_array($currentusergroup, array(1,3,4,5,6,7), true)) { // current user is not a guest, moderator, admin, awaiting activation or banned
            $footer = $codetoadd . $footer;
          } else {
						$footer = '<!-- MyBB Ad Rotator: Footer ads shown to regular users only. Current user is ' . $mybb->user['usertitle'] . ' -->' . $footer;
					}
          break;
        case 3: // show to Mods/Admins only
          if (in_array($currentusergroup, array(3,4,6))) { // current user is Admin, Mod or Super Mod
            $footer = $codetoadd . $footer;
          } else {
						$footer = '<!-- MyBB Ad Rotator: Footer ads shown to mods and admins only Current user is ' . $mybb->user['usertitle'] . ' -->' . $footer;
					}
          break;
        case 4: // show to All (except Banned)
          if ($currentusergroup != 7) { // not Banned
            $footer = $codetoadd . $footer;
          }
          break;
        case 5: // show to None
					$footer = '<!-- MyBB Ad Rotator: Footer ads turned off. -->' . $footer;
          break; // do nothing
      } // end switch
    } // end code existence check
  } // end enabled check
} // end footer function

function getrandomvalue($arr) {
  return $arr[array_rand($arr, 1)];
}
?>