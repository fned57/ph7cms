<?php 
namespace PH7;
defined('PH7') or exit('Restricted access');
/*
Created on 2021-12-30 15:34:34
Compiled file from: C:\laragon\www\ph7\_protected\app/system/modules/user\views/base\tpl\setting\privacy.tpl
Template Engine: PH7Tpl version 1.4.1 by Pierre-Henry Soria
*/
/**
 * @author     Pierre-Henry Soria
 * @email      hello@ph7cms.com
 * @link       https://ph7cms.com
 * @copyright  (c) 2011-2021, Pierre-Henry Soria. All Rights Reserved.
 */
?><div class="col-md-10"> <?php PrivacyForm::display() ;?> <p class="s_tMarg small"> <a href="<?php $design->url('user','setting','delete') ;?>"> <?php echo t('Want to delete your account...?'); ?> </a> </p></div>