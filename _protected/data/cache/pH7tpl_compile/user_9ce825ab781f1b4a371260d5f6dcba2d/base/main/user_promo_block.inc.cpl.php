<?php 
namespace PH7;
defined('PH7') or exit('Restricted access');
/*
Created on 2021-12-30 15:23:13
Compiled file from: C:\laragon\www\ph7\_protected\app/system/modules/user\views/base\tpl\main\user_promo_block.inc.tpl
Template Engine: PH7Tpl version 1.4.1 by Pierre-Henry Soria
*/
/**
 * @author     Pierre-Henry Soria
 * @email      hello@ph7cms.com
 * @link       https://ph7cms.com
 * @copyright  (c) 2011-2021, Pierre-Henry Soria. All Rights Reserved.
 */
?><h1 class="red3 italic underline s_bMarg"><?php echo $slogan; ?></h1><?php if($is_users_block) { ?> <div class="center profiles_window thumb pic_block"> <?php $userDesignModel->profiles(0, $number_profiles) ;?> </div><?php } ?><div class="s_tMarg" id="promo_text"> <h2><?php echo t('🚀 Meet amazing people near %0%! 🎉', $design->geoIp(false)); ?></h2> <?php echo $promo_text; ?></div>