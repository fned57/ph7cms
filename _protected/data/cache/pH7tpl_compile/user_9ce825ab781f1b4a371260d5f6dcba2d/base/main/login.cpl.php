<?php 
namespace PH7;
defined('PH7') or exit('Restricted access');
/*
Created on 2021-12-30 15:24:31
Compiled file from: C:\laragon\www\ph7\_protected\app/system/modules/user\views/base\tpl\main\login.tpl
Template Engine: PH7Tpl version 1.4.1 by Pierre-Henry Soria
*/
/**
 * @author     Pierre-Henry Soria
 * @email      hello@ph7cms.com
 * @link       https://ph7cms.com
 * @copyright  (c) 2011-2021, Pierre-Henry Soria. All Rights Reserved.
 */
?><div class="col-md-8"> <p> <?php echo t('Not registered yet?'); ?><br /> <a class="underline" href="<?php $design->url('user','signup','step1') ;?>"> <strong><?php echo t('Join Us Today!'); ?></strong> </a> </p> <?php LoginForm::display() ;?> <p> <?php LostPwdDesignCore::link('user') ;?> <?php if(Framework\Mvc\Model\DbConfig::getSetting('userActivationType') == Registration::EMAIL_ACTIVATION) { ?> | <a rel="nofollow" href="<?php $design->url('user','main','resendactivation') ;?>"><?php echo t('Resend activation email'); ?></a> <?php } ?> </p></div><div class="col-md-4 ad_336_280"> <?php $this->designModel->ad(336, 280) ?></div>