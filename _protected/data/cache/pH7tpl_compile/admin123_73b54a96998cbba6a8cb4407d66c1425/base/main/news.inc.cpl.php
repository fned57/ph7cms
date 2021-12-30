<?php 
namespace PH7;
defined('PH7') or exit('Restricted access');
/*
Created on 2021-12-30 15:23:45
Compiled file from: C:\laragon\www\ph7\_protected\app/system/modules/admin123\views/base\tpl\main\news.inc.tpl
Template Engine: PH7Tpl version 1.4.1 by Pierre-Henry Soria
*/
/**
 * @author     Pierre-Henry Soria
 * @email      hello@ph7cms.com
 * @link       https://ph7cms.com
 * @copyright  (c) 2011-2021, Pierre-Henry Soria. All Rights Reserved.
 */
?><div class="center"> <h2 class="underline"> <?php echo t('Latest <a href="%software_website%" title="%software_name%">pH7CMS Software</a>\'s News'); ?> </h2> <?php XmlDesignCore::softwareNews(10) ;?> <p class="s_tMarg italic"> <a href="<?php echo $software_blog_url; ?>"><?php echo t('» Read more news! «'); ?></a> 🗞 </p></div>