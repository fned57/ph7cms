<?php 
namespace PH7;
defined('PH7') or exit('Restricted access');
/*
Created on 2021-12-30 15:34:34
Compiled file from: C:\laragon\www\ph7\_protected\app/system/modules/user\views/base\tpl\setting\avatar.tpl
Template Engine: PH7Tpl version 1.4.1 by Pierre-Henry Soria
*/
/**
 * @author     Pierre-Henry Soria
 * @email      hello@ph7cms.com
 * @link       https://ph7cms.com
 * @copyright  (c) 2011-2021, Pierre-Henry Soria. All Rights Reserved.
 */
?><div class="col-md-8"> <?php $avatarDesign->lightBox($username, $first_name, $sex, 400) ;?> <?php if($is_admin_auth AND !$is_user_auth) { ?> <?php LinkCoreForm::display(t('Remove the profile photo?'), null, null, null, array('del'=>1)) ;?> <?php } else { ?> <?php LinkCoreForm::display(t('Remove the profile photo?'), 'user', 'setting', 'avatar', array('del'=>1)) ;?> <?php } ?> <?php AvatarForm::display() ;?> <p> <span class="underline err_msg"><?php echo t('Warning:'); ?></span> <?php echo t('Your profile photo must contain a photo of yourself under penalty of banishment of your account!'); ?> </p></div>