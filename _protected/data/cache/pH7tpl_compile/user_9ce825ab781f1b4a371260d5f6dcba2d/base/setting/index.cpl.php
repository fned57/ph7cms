<?php 
namespace PH7;
defined('PH7') or exit('Restricted access');
/*
Created on 2021-12-30 15:34:34
Compiled file from: C:\laragon\www\ph7\_protected\app/system/modules/user\views/base\tpl\setting\index.tpl
Template Engine: PH7Tpl version 1.4.1 by Pierre-Henry Soria
*/
/**
 * @author     Pierre-Henry Soria
 * @email      hello@ph7cms.com
 * @link       https://ph7cms.com
 * @copyright  (c) 2011-2021, Pierre-Henry Soria. All Rights Reserved.
 */
?><ol id="toc"> <li> <a href="#edit"> <span><?php echo t('Edit'); ?></span> </a> </li> <li> <a href="#avatar"> <span><?php echo t('Profile Photo'); ?></span> </a> </li> <li> <a href="#design"> <span><?php echo t('Profile Wallpaper'); ?></span> </a> </li> <li> <a href="#notification"> <span><?php echo t('Email Notification'); ?></span> </a> </li> <li> <a href="#privacy"> <span><?php echo t('Privacy'); ?></span> </a> </li> <li> <a href="<?php $design->url('payment','main','info') ;?>"> <span><?php echo t('Membership Details'); ?></span> </a> </li> <li> <a href="#pwd"> <span><?php echo t('Password'); ?></span> </a> </li></ol><div class="content" id="edit"> <?php $this->display($this->getCurrentController() . PH7_DS . 'edit.tpl', $this->registry->path_module_views . PH7_TPL_MOD_NAME . PH7_DS); ?></div><div class="content" id="avatar"> <?php $this->display($this->getCurrentController() . PH7_DS . 'avatar.tpl', $this->registry->path_module_views . PH7_TPL_MOD_NAME . PH7_DS); ?></div><div class="content" id="design"> <?php $this->display($this->getCurrentController() . PH7_DS . 'design.tpl', $this->registry->path_module_views . PH7_TPL_MOD_NAME . PH7_DS); ?></div><div class="content" id="notification"> <?php $this->display($this->getCurrentController() . PH7_DS . 'notification.tpl', $this->registry->path_module_views . PH7_TPL_MOD_NAME . PH7_DS); ?></div><div class="content" id="privacy"> <?php $this->display($this->getCurrentController() . PH7_DS . 'privacy.tpl', $this->registry->path_module_views . PH7_TPL_MOD_NAME . PH7_DS); ?></div><div class="content" id="pwd"> <?php $this->display($this->getCurrentController() . PH7_DS . 'password.tpl', $this->registry->path_module_views . PH7_TPL_MOD_NAME . PH7_DS); ?></div><script src="<?php echo PH7_URL_STATIC?>js/tabs.js"></script><script> tabs('p', ['edit','avatar','design','notification','privacy','pwd']);</script>