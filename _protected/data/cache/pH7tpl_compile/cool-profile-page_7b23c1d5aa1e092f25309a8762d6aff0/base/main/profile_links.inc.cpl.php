<?php 
namespace PH7;
defined('PH7') or exit('Restricted access');
/*
Created on 2021-12-30 15:39:49
Compiled file from: C:\laragon\www\ph7\_protected\app/system/modules/cool-profile-page\views/base\tpl\main\profile_links.inc.tpl
Template Engine: PH7Tpl version 1.4.1 by Pierre-Henry Soria
*/
/**
 * @author     Pierre-Henry Soria
 * @email      hello@ph7cms.com
 * @link       https://ph7cms.com
 * @copyright  (c) 2011-2021, Pierre-Henry Soria. All Rights Reserved.
 */
?><div class="row"> <?php if($is_im_enabled AND !$is_own_profile) { ?> <a class="vs_marg" rel="nofollow" href="<?php echo $messenger_link; ?>" title="<?php echo t('Chat'); ?>"> <i class="fa fa-comment-o chat"></i> </a> <?php } ?> <?php if($is_lovecalculator_enabled AND !$is_own_profile) { ?> <a class="vs_marg" href="<?php $design->url('love-calculator','main','index',$username) ;?>" title="<?php echo t('Match'); ?>"> <i class="fa fa-heart-o heart"></i> </a> <?php } ?></div><div class="row"> <?php if($is_mail_enabled AND !$is_own_profile) { ?> <a class="vs_marg" rel="nofollow" href="<?php echo $mail_link; ?>" title="<?php echo t('Send Message'); ?>"> <li class="fa fa-envelope-o message"></li> </a> <?php } ?> <?php if($is_friend_enabled AND !$is_own_profile) { ?> <a class="vs_marg" rel="nofollow" href="<?php echo $friend_link; ?>"> <?php if($is_approved_friend) { ?> <i class="fa fa-user-times friend"></i> <?php } elseif($is_pending_friend) { ?> <i class="fa fa-users friend"></i> <?php } else { ?> <i class="fa fa-user-plus friend"></i> <?php } ?> </a> <?php } ?></div>