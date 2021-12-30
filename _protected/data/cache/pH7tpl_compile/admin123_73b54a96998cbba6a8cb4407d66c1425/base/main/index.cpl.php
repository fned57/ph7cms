<?php 
namespace PH7;
defined('PH7') or exit('Restricted access');
/*
Created on 2021-12-30 15:23:45
Compiled file from: C:\laragon\www\ph7\_protected\app/system/modules/admin123\views/base\tpl\main\index.tpl
Template Engine: PH7Tpl version 1.4.1 by Pierre-Henry Soria
*/
/**
 * @author     Pierre-Henry Soria
 * @email      hello@ph7cms.com
 * @link       https://ph7cms.com
 * @copyright  (c) 2011-2021, Pierre-Henry Soria. All Rights Reserved.
 */
?><?php if($show_get_started_section) { ?> <?php $this->display($this->getCurrentController() . PH7_DS . 'get_started_intro.inc.tpl', $this->registry->path_module_views . PH7_TPL_MOD_NAME . PH7_DS); } $this->display($this->getCurrentController() . PH7_DS . 'stat.tpl', $this->registry->path_module_views . PH7_TPL_MOD_NAME . PH7_DS); if($is_news_feed) { ?> <br /><hr /><br /> <?php $this->display($this->getCurrentController() . PH7_DS . 'news.inc.tpl', $this->registry->path_module_views . PH7_TPL_MOD_NAME . PH7_DS); } ?>