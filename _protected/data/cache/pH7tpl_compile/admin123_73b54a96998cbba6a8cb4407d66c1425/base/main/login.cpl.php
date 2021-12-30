<?php 
namespace PH7;
defined('PH7') or exit('Restricted access');
/*
Created on 2021-12-30 15:23:31
Compiled file from: C:\laragon\www\ph7\_protected\app/system/modules/admin123\views/base\tpl\main\login.tpl
Template Engine: PH7Tpl version 1.4.1 by Pierre-Henry Soria
*/
/**
 * @author     Pierre-Henry Soria
 * @email      hello@ph7cms.com
 * @link       https://ph7cms.com
 * @copyright  (c) 2011-2021, Pierre-Henry Soria. All Rights Reserved.
 */
?><div class="col-md-8"> <?php LoginForm::display() ;?> <p><?php LostPwdDesignCore::link(PH7_ADMIN_MOD) ;?></p> <p class="red"><?php echo t('Your logged IP is:'); ?> <em class="bold"><?php echo Framework\Ip\Ip::get()?></em></p></div>