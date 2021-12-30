<?php 
namespace PH7;
defined('PH7') or exit('Restricted access');
/*
Created on 2021-12-30 15:39:51
Compiled file from: C:\laragon\www\ph7\_protected\app/system/modules/related-profile\views/base\tpl\main\index.tpl
Template Engine: PH7Tpl version 1.4.1 by Pierre-Henry Soria
*/
/**
 * @author     Pierre-Henry Soria
 * @email      hello@ph7cms.com
 * @link       https://ph7cms.com
 * @copyright  (c) 2011-2021, Pierre-Henry Soria. All Rights Reserved.
 */
?><div class="center" id="related_profile_block"> <?php if(!empty($related_profiles)) { ?> <?php foreach($related_profiles as $profile) { ?> <?php if($id !== $profile->profileId) { ?> <?php $found = 1 ;?> <div class="s_photo"> <?php $avatarDesign->get($profile->username, $profile->firstName, $profile->sex, 64, $bRollover = true) ;?> </div> <?php } ?> <?php } ?> <?php } ?> <?php if(empty($found)) { ?> <p><?php echo t('No related profiles found.'); ?></p> <?php } ?></div>