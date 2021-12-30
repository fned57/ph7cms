<?php 
namespace PH7;
defined('PH7') or exit('Restricted access');
/*
Created on 2021-12-30 15:34:34
Compiled file from: C:\laragon\www\ph7\templates/themes/base\tpl\error.inc.tpl
Template Engine: PH7Tpl version 1.4.1 by Pierre-Henry Soria
*/
/**
 * @author     Pierre-Henry Soria
 * @email      hello@ph7cms.com
 * @link       https://ph7cms.com
 * @copyright  (c) 2011-2021, Pierre-Henry Soria. All Rights Reserved.
 */
?><div class="center"> <p><?php echo $error_desc; ?></p> <?php if(isset($pOH_not_found)) { ?> <div class="error-image center"></div> <h2><?php echo t('Relax and go'); ?> <a href="<?php echo $this->registry->site_url?>"><?php echo t('home'); ?></a></h2> <?php } ?></div>