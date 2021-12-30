<?php 
namespace PH7;
defined('PH7') or exit('Restricted access');
/*
Created on 2021-12-30 15:39:49
Compiled file from: C:\laragon\www\ph7\_protected\app/system/modules/cool-profile-page\views/base\tpl\main\interested_or_not.buttons.inc.tpl
Template Engine: PH7Tpl version 1.4.1 by Pierre-Henry Soria
*/
/**
 * @author     Pierre-Henry Soria
 * @email      hello@ph7cms.com
 * @link       https://ph7cms.com
 * @copyright  (c) 2011-2021, Pierre-Henry Soria. All Rights Reserved.
 */
?><?php if(!$is_own_profile) { ?> <div class="center"> <?php if($is_mail_enabled) { ?> <a class="s_tMarg btn btn-success btn-lg" rel="nofollow" href="<?php echo $mail_link; ?>"> <?php echo t('👍 Wanna Meet 😍'); ?> </a> <?php } elseif($is_im_enabled) { ?> <a class="s_tMarg btn btn-success btn-lg" rel="nofollow" href="<?php echo $messenger_link; ?>"> <?php echo t('👍 Wanna Speak 💬'); ?> </a> <?php } ?> <?php if($is_mail_enabled OR $is_im_enabled) { ?> <a class="s_tMarg btn btn-danger btn-lg" href="<?php $design->url('user', 'browse', 'index', '?country='.$country_code.'&sex='.$sex) ;?>"> <?php echo t(' 👎 Not Interested'); ?> </a> <?php } ?> </div><?php } ?>