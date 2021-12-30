<?php 
namespace PH7;
defined('PH7') or exit('Restricted access');
/*
Created on 2021-12-30 15:39:53
Compiled file from: C:\laragon\www\ph7\_protected\app/system/modules/love-calculator\views/base\tpl\main\index.tpl
Template Engine: PH7Tpl version 1.4.1 by Pierre-Henry Soria
*/
/**
 * @author     Pierre-Henry Soria
 * @email      hello@ph7cms.com
 * @link       https://ph7cms.com
 * @copyright  (c) 2011-2021, Pierre-Henry Soria. All Rights Reserved.
 */
?><div class="calculator-wrapper"> <div class="col-md-4"> <?php $avatarDesign->get($username, $first_name, $sex, 200) ;?> </div> <div class="col-md-4"> <div class="center heart"><span>0</span>%</div> <p class="love_txt bold pink2"><?php echo t('Love!'); ?></p> </div> <div class="col-md-4"> <?php $avatarDesign->get($second_username, $second_first_name, $second_sex, 200) ;?> </div></div><script>$(function(){ loveCounter(0, <?php echo $amount_love; ?>) });</script>