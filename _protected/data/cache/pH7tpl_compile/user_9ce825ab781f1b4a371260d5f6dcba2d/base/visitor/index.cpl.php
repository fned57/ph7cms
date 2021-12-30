<?php 
namespace PH7;
defined('PH7') or exit('Restricted access');
/*
Created on 2021-12-30 15:25:53
Compiled file from: C:\laragon\www\ph7\_protected\app/system/modules/user\views/base\tpl\visitor\index.tpl
Template Engine: PH7Tpl version 1.4.1 by Pierre-Henry Soria
*/
/**
 * @author     Pierre-Henry Soria
 * @email      hello@ph7cms.com
 * @link       https://ph7cms.com
 * @copyright  (c) 2011-2021, Pierre-Henry Soria. All Rights Reserved.
 */
?><div class="center" id="visitor_block"> <?php if($user_views_setting == PrivacyCore::NO) { ?> <div class="center alert alert-warning"><?php echo t('To see the new members who view your profile, you must first change'); ?> <a href="<?php $design->url('user','setting','privacy') ;?>"><?php echo t('your privacy settings'); ?></a>.</div> <?php } ?> <?php if(empty($error)) { ?> <h3 class="underline"><?php echo t('Recently Viewed By:'); ?></h3> <p class="italic underline"><strong><a href="<?php $design->url('user','visitor','index',$username) ;?>"><?php echo $visitor_number; ?></a></strong></p><br /> <?php foreach($visitors as $v) { ?> <div class="s_photo"> <?php $avatarDesign->get($v->username, $v->firstName, $v->sex, 64, $bRollover = true) ;?> </div> <?php } ?> <?php $this->display('page_nav.inc.tpl', PH7_PATH_TPL . PH7_TPL_NAME . PH7_DS); ?> <br /> <p class="center bottom"> <a class="btn btn-default btn-md" href="<?php $design->url('user','visitor','search',$username) ;?>"><?php echo t('Search for a visitor of %0%', $v->username); ?></a> </p> <?php } else { ?> <p><?php echo $error; ?></p> <?php } ?></div>