<?php 
namespace PH7;
defined('PH7') or exit('Restricted access');
/*
Created on 2021-12-30 15:23:45
Compiled file from: C:\laragon\www\ph7\_protected\app/system/modules/admin123\views/base\tpl\main\get_started_intro.inc.tpl
Template Engine: PH7Tpl version 1.4.1 by Pierre-Henry Soria
*/
/**
 * @author     Pierre-Henry Soria
 * @email      hello@ph7cms.com
 * @link       https://ph7cms.com
 * @copyright  (c) 2011-2021, Pierre-Henry Soria. All Rights Reserved.
 */
?><div class="center"> <div class="s_bMarg border"> <h2>🍰 <span class="underline"><?php echo t('Getting Started Smoothly'); ?></span> 👌</h2> <p> <?php echo t('Welcome to your admin dashboard! You will find everything you need to customize and manage your website in here 🙂'); ?> </p> <p class="underline"> <?php echo t('Here are a few steps to start well your site:'); ?> </p> <ul> <li> <a href="<?php $design->url(PH7_ADMIN_MOD, 'setting', 'general') ;?>#p=general"> <?php echo t('Review the general settings'); ?> </a> </li> <li> <a href="<?php $design->url(PH7_ADMIN_MOD, 'setting', 'metamain') ;?>"> <?php echo t('Update homepage texts & site info'); ?> </a> </li> <li> <a href="<?php $design->url(PH7_ADMIN_MOD, 'setting', 'general') ;?>#p=icon"> <?php echo t("Upload website's icon"); ?> </a> </li> <li> <a href="<?php $design->url(PH7_ADMIN_MOD, 'setting', 'general') ;?>#p=design"> <?php echo t("Update website's colors"); ?> </a> </li> <li> <a href="<?php $design->url(PH7_ADMIN_MOD, 'setting', 'general') ;?>#p=email"> <?php echo t('Update email settings'); ?> </a> </li> <li> <a href="<?php $design->url(PH7_ADMIN_MOD, 'file', 'pagedisplay') ;?>"> <?php echo t('Edit static pages'); ?> </a> </li> <li> <a href="<?php $design->url(PH7_ADMIN_MOD, 'module', 'disable') ;?>"> <?php echo t('Enable/disable modules'); ?> </a> </li> <li> <?php $boxes = ['donationbox', 'upsetbox'] ;?> <?php $box = $boxes[mt_rand(0,1)] ;?> <a class="underline" href="<?php $design->url('ph7cms-helper', 'main', 'suggestionbox', '?box='.$box) ;?>"> <?php echo t('Contribute to the software'); ?> </a> 🚀 </li> <li> <a href="<?php echo $tweet_msg_url; ?>" target="_blank" rel="noopener noreferrer"> <?php echo t('Share it on Twitter'); ?> </a> 💙 </li> </ul> </div></div>