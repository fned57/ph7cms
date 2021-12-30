<?php 
namespace PH7;
defined('PH7') or exit('Restricted access');
/*
Created on 2021-12-30 15:34:34
Compiled file from: C:\laragon\www\ph7\_protected\app/system/modules/user\views/base\tpl\setting\design.tpl
Template Engine: PH7Tpl version 1.4.1 by Pierre-Henry Soria
*/
/**
 * @author     Pierre-Henry Soria
 * @email      hello@ph7cms.com
 * @link       https://ph7cms.com
 * @copyright  (c) 2011-2021, Pierre-Henry Soria. All Rights Reserved.
 */
?><div class="col-md-8"> <p> <a href="<?php echo $path_img_background; ?>" data-popup="image"> <img src="<?php echo $path_img_background; ?>" alt="<?php echo t('Wallpaper'); ?>" title="<?php echo t('Your current wallpaper'); ?>" width="160" height="150" /> </a> </p> <?php if(strpos($path_img_background, UserDesignCore::NONE_IMG_FILENAME) === false) { ?> <?php if($is_admin_auth AND !$is_user_auth) { ?> <?php LinkCoreForm::display(t('Remove wallpaper?'), null, null, null, array('del'=>1)) ;?> <?php } else { ?> <?php LinkCoreForm::display(t('Remove wallpaper?'), 'user', 'setting', 'design', array('del'=>1)) ;?> <?php } ?> <?php } ?> <?php DesignForm::display() ;?></div>