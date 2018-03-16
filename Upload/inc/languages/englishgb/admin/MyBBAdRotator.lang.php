<?php
/*
 * MyBB: MyBB Ad Rotator
 *
 * File: MyBBAdRotator.lang.php
 * 
 * Authors: Jimmy Peña, Vintagedaddyo
 *
 * MyBB Version: 1.8
 *
 * Plugin Version: 1.1
 * 
 */

// plugin_info

$l['MyBBAdRotator_Name'] = 'MyBB Ad Rotator';
$l['MyBBAdRotator_Desc'] = 'Inserts code into header or footer of your forum. Show ads to guests only, to make more money, or show messages to your regulars.';
$l['MyBBAdRotator_Web'] = 'http://www.jimmyscode.com/php/ad-rotator-mybb-plugin/';
$l['MyBBAdRotator_Auth'] = 'Jimmy Pe&ntilde;a & updated by Vintagedaddyo';
$l['MyBBAdRotator_AuthSite'] = 'http://community.mybb.com/user-6029.html';
$l['MyBBAdRotator_Ver'] = '1.1';
$l['MyBBAdRotator_GUID'] = '51678257cb5c343186ee6820622f585d';
$l['MyBBAdRotator_Compat'] = '18*';

//  create plugin settings group

$l['MyBBAdRotator_name_0'] = 'mybb_ar_group';
$l['MyBBAdRotator_title_0'] = 'MyBB Ad Rotator';
$l['MyBBAdRotator_description_0'] = 'Settings for MyBB Ad Rotator plugin';

//  create plugin settings

$l['MyBBAdRotator_name_1'] = 'mybb_ar_plugin_enabled';
$l['MyBBAdRotator_title_1'] = 'Enable MyBB Ad Rotator plugin?';
$l['MyBBAdRotator_description_1'] = 'Click Yes to enable the plugin, No to disable.';

//  delimiter

$l['MyBBAdRotator_name_2'] = 'mybb_ar_delimiter';
$l['MyBBAdRotator_title_2'] = 'Delimiter for each ad section';
$l['MyBBAdRotator_description_2'] = 'Specify the delimiter that separates each ad.';

//  header code section

$l['MyBBAdRotator_name_3'] = 'mybb_ar_header_code';
$l['MyBBAdRotator_title_3'] = 'Code for header';
$l['MyBBAdRotator_description_3'] = 'Enter the ads or messages you want to randomly rotate in the <strong>header</strong>. Separate them using the delimiter above. Leave blank if you do not want header ads. Text/HTML only (no PHP or MyBB template codes).';


// who to show header ads to

$l['MyBBAdRotator_name_4'] = 'mybb_ar_header_who';
$l['MyBBAdRotator_title_4'] = 'Header display';
$l['MyBBAdRotator_description_4'] = 'Who do you want to see header ads?';

// footer code section

$l['MyBBAdRotator_name_5'] = 'mybb_ar_footer_code';
$l['MyBBAdRotator_title_5'] = 'Code for footer';
$l['MyBBAdRotator_description_5'] = 'Enter the ads or messages you want to randomly rotate in the <strong>footer</strong>. Separate them using the delimiter above. Leave blank if you do not want footer ads. Text/HTML only (no PHP or MyBB template codes).';

// who to show footer ads to

$l['MyBBAdRotator_name_6'] = 'mybb_ar_footer_who';
$l['MyBBAdRotator_title_6'] = 'Footer display';
$l['MyBBAdRotator_description_6'] = 'Who do you want to see footer ads?';

// options

$l['MyBBAdRotator_options_1'] = 'Guests / Unknown Visitors';
$l['MyBBAdRotator_options_2'] = 'Regulars / Logged in Users';
$l['MyBBAdRotator_options_3'] = 'Moderators and Admins';
$l['MyBBAdRotator_options_4'] = 'All (except Banned)';
$l['MyBBAdRotator_options_5'] = 'None (turn off temporarily)';

?>