<?php 
namespace PH7;
defined('PH7') or exit('Restricted access');
/*
Created on 2021-12-30 15:24:32
Compiled file from: C:\laragon\www\ph7\_protected\app/system/modules/user\views/base\tpl\signup\step1.tpl
Template Engine: PH7Tpl version 1.4.1 by Pierre-Henry Soria
*/
/**
 * @author     Pierre-Henry Soria
 * @email      hello@ph7cms.com
 * @link       https://ph7cms.com
 * @copyright  (c) 2011-2021, Pierre-Henry Soria. All Rights Reserved.
 */
?><div class="col-xs-12 col-sm-10 col-md-10 col-lg-10"> <div class="pull-left col-xs-12 col-sm-7 col-md-6 col-lg-7 animated fadeInLeft"> <?php $this->display('progressbar.inc.tpl'); ?> <?php JoinForm::step1() ;?> </div> <div class="pull-right col-xs-12 col-sm-5 col-md-5 col-md-offset-1 col-lg-4 animated fadeInRight"> <div class="center"> <p> <?php echo t('Already registered?'); ?> <a href="<?php $design->url('user','main','login') ;?>"><strong><?php echo t('Sign In!'); ?></strong></a> </p> <?php if(!empty($user_ref)) { ?> <a href="<?php $design->getUserAvatar($username, $sex, 400) ;?>" title="<?php echo $first_name; ?>" data-popup="image"> <img class="avatar s_marg" alt="<?php echo $first_name; ?> <?php echo $username; ?>" title="<?php echo $first_name; ?>" src="<?php $design->getUserAvatar($username, $sex, 400) ;?>" /> </a> <?php } else { ?> <div class="s_tMarg"> <?php $userDesignModel->profilesBlock() ;?> </div> <?php } ?> </div> </div></div>