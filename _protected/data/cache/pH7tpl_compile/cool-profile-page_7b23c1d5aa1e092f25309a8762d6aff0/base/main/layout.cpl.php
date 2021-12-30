<?php 
namespace PH7;
defined('PH7') or exit('Restricted access');
/*
Created on 2021-12-30 15:39:48
Compiled file from: C:\laragon\www\ph7\templates/themes/base\tpl\layout.tpl
Template Engine: PH7Tpl version 1.4.1 by Pierre-Henry Soria
*/
/**
 * @author     Pierre-Henry Soria
 * @email      hello@ph7cms.com
 * @link       https://ph7cms.com
 * @copyright  (c) 2011-2021, Pierre-Henry Soria. All Rights Reserved.
 */
?><?php $design->htmlHeader() ; $design->softwareComment() ;?><html lang="<?php echo $this->config->values['language']['lang'] ;?>"> <head> <meta charset="<?php echo $this->config->values['language']['charset'] ;?>" /> <meta name="viewport" content="width=device-width,initial-scale=1" /> <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> <title><?php if($page_title) { ?><?php echo $this->str->escape($this->str->upperFirst($page_title), true) ;?> - <?php echo $site_name; ?><?php } else { ?><?php echo $site_name; ?> - <?php echo $slogan; ?><?php } ?></title> <meta name="description" content="<?php echo $this->str->escape($this->str->upperFirst($meta_description), true) ;?>" /> <meta name="keywords" content="<?php echo $this->str->escape($meta_keywords, true) ;?>" /> <?php $this->display('social-meta-tags.inc.tpl', PH7_PATH_TPL . PH7_TPL_NAME . PH7_DS); ?> <meta name="robots" content="<?php echo $meta_robots; ?>" /> <link rel="icon" href="<?php echo $this->registry->url_relative?>favicon.ico" /> <link rel="canonical" href="<?php echo $this->httpRequest->currentUrl()?>" /> <link rel="author" href="<?php echo $this->registry->site_url?>humans.txt" /> <?php if(!$is_user_auth) { ?><?php $design->regionalUrls() ;?><?php } ?> <meta name="author" content="<?php echo $meta_author; ?>" /> <meta name="copyright" content="<?php echo $meta_copyright; ?>" /> <meta name="category" content="<?php echo $meta_category; ?>" /> <meta name="rating" content="<?php echo $meta_rating; ?>" /> <meta name="distribution" content="<?php echo $meta_distribution; ?>" /> <?php if($header) { ?><?php echo $header; ?><?php } ?> <?php if($is_pwa_enabled) { ?> <link rel="manifest" href="<?php $design->url('pwa','main','manifest') ;?>" /> <meta name="msapplication-config" content="<?php $design->url('pwa','main','browserconfig') ;?>" /> <?php $design->staticFiles('js', PH7_LAYOUT . PH7_SYS . PH7_MOD . 'pwa/' . PH7_TPL . PH7_DEFAULT_THEME . PH7_SH . PH7_JS, 'sw-register.js') ;?> <?php $this->display('pwa-icon-tags.inc.tpl', PH7_PATH_TPL . PH7_TPL_NAME . PH7_DS); ?> <?php } ?> <meta name="creator" content="pH7CMS, Pierre-Henry Soria - <?php echo self::SOFTWARE_WEBSITE?>" /> <meta name="designer" content="pH7CMS, Pierre-Henry Soria - <?php echo self::SOFTWARE_WEBSITE?>" /> <meta name="generator" content="<?php echo self::SOFTWARE_NAME?>, v<?php echo self::SOFTWARE_VERSION?>" /> <?php $design->externalCssFile(PH7_URL_STATIC. PH7_CSS . 'js/jquery/smoothness/jquery-ui.css') ;?> <?php $design->externalCssFile(PH7_URL_STATIC. PH7_CSS . 'font-awesome.css') ;?> <?php $design->staticFiles('css', PH7_STATIC . PH7_CSS . 'js/jquery/box', 'box.css') ;?> <?php $design->staticFiles('css', PH7_STATIC . PH7_CSS, 'bootstrap.css,bootstrap_customize.css,animate.css') ;?> <?php $design->staticFiles('css', PH7_LAYOUT . PH7_TPL . PH7_TPL_NAME . PH7_SH . PH7_CSS, 'common.css,style.css,layout.css,like.css,color.css,form.css,js/jquery/rating.css,js/jquery/apprise.css,js/jquery/tipTip.css') ;?> <?php if($top_navbar_type === 'inverse') { ?> <?php $design->staticFiles('css', PH7_LAYOUT . PH7_TPL . PH7_TPL_NAME . PH7_SH . PH7_CSS, 'menu_inverse.css') ;?> <?php } else { ?> <?php $design->staticFiles('css', PH7_LAYOUT . PH7_TPL . PH7_TPL_NAME . PH7_SH . PH7_CSS, 'menu.css') ;?> <?php } ?> <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans" /> <?php $design->externalCssFile(PH7_RELATIVE.'asset/css/color.css') ;?> <?php $design->externalCssFile(PH7_RELATIVE.'asset/css/style.css') ;?> <?php if($is_user_auth AND $is_im_enabled) { ?> <?php $design->staticFiles('css', PH7_LAYOUT . PH7_SYS . PH7_MOD . 'im/' . PH7_TPL . PH7_DEFAULT_THEME . PH7_SH . PH7_CSS, 'messenger.css') ;?> <?php } ?> <?php if($is_disclaimer) { ?> <?php $design->staticFiles('css', PH7_STATIC . PH7_CSS . PH7_JS, 'disclaimer.css') ;?> <?php } ?> <?php $design->css() ;?> <?php $this->designModel->files('css') ?> <script>var pH7Url={base:'<?php echo $this->registry->site_url?>',relative:'<?php echo $this->registry->url_relative?>',tpl:'<?php echo PH7_URL_TPL . PH7_TPL_NAME . PH7_SH?>',stic:'<?php echo PH7_URL_STATIC?>',tplImg:'<?php echo PH7_URL_TPL . PH7_TPL_NAME . PH7_SH . PH7_IMG?>',tplJs:'<?php echo PH7_URL_TPL . PH7_TPL_NAME . PH7_SH . PH7_JS?>',tplMod:'<?php echo $this->registry->url_themes_module . PH7_TPL_MOD_NAME . PH7_SH?>',data:'<?php echo PH7_URL_DATA?>'};</script> <?php if($is_admin_auth) { ?><script>pH7Url.admin_mod = '<?php echo PH7_ADMIN_MOD . PH7_SH?>';</script><?php } ?> <?php $design->externalJsFile(PH7_URL_STATIC . PH7_JS . 'jquery/jquery.js') ;?> <?php XmlDesignCore::sitemapHeaderLink() ;?> <?php XmlDesignCore::rssHeaderLinks() ;?> <?php $this->designModel->analyticsApi() ?> </head> <body itemscope="itemscope" itemtype="http://schema.org/WebPage"> <header> <?php if(!$is_guest_homepage) { ?> <?php $this->display('top_menu.inc.tpl', PH7_PATH_TPL . PH7_TPL_NAME . PH7_DS); ?> <?php } ?> <noscript> <div class="noscript err_msg"> <?php echo t('JavaScript is disabled on your Web browser!<br /> Please enable JavaScript via the options of your Web browser in order to use this website.'); ?> </div> </noscript> <?php if($is_guest_homepage) { ?> <div class="row"> <div role="banner" id="logo" class="col-md-8"> <h1 itemprop="name"> <a href="<?php $design->homePageUrl() ;?>"><?php echo $site_name; ?></a> </h1> </div> </div> <?php } ?> <?php $this->display('headings.inc.tpl', PH7_PATH_TPL . PH7_TPL_NAME . PH7_DS); ?> <?php if(!$is_guest_homepage) { ?> <div role="banner" class="center ad_468_60"> <?php $this->designModel->ad(468, 60) ?> </div> <?php } ?> <div class="clear"></div> </header> <div id="box"> <p></p> </div> <main role="main" class="container" id="content"> <?php $design->flashMsg() ;?> <div class="msg"></div> <?php $lang_file = Framework\Translate\Lang::getJsFile(PH7_PATH_STATIC . PH7_JS . PH7_LANG) ;?> <?php $design->staticFiles('js', PH7_STATIC . PH7_JS, PH7_LANG . $lang_file) ;?> <?php if(!empty($manual_include)) { ?> <?php $this->display($this->getCurrentController() . PH7_DS . $manual_include, $this->registry->path_module_views . PH7_TPL_MOD_NAME . PH7_DS); ?> <?php } elseif(!empty($pOH_not_found)) { ?> <?php $this->display('error.inc.tpl', PH7_PATH_TPL . PH7_TPL_NAME . PH7_DS); ?> <?php } else { ?> <?php $this->display($this->getCurrentController() . PH7_DS . $this->registry->action . '.tpl', $this->registry->path_module_views . PH7_TPL_MOD_NAME . PH7_DS); ?> <?php } ?> </main> <div role="banner" class="center ad_468_60"> <?php $this->designModel->ad(468, 60) ?> </div> <footer> <div role="banner" class="center ad_728_90"> <?php $this->designModel->ad(728, 90) ?> </div> <div role="contentinfo"> <div class="ft_copy"> <?php $design->littleSocialMediaWidgets() ;?> <p> &copy; <?php echo date('Y')?> <strong><?php echo $site_name; ?></strong> <?php $design->link() ;?> </p> </div> <?php $design->langList() ;?> <?php $this->display('bottom_menu.inc.tpl', PH7_PATH_TPL . PH7_TPL_NAME . PH7_DS); ?> </div> <?php if(isDebug()) { ?> <div class="ft"> <p><small><?php $design->stat() ;?></small></p> </div> <p class="small dark-red"> <?php echo t('WARNING: Your site is in development mode! You can change the mode'); ?> <a href="<?php $design->url(PH7_ADMIN_MOD,'tool','envmode') ;?>" title="<?php echo t('Change the Environment Mode'); ?>" class="dark-red"><?php echo t('here'); ?></a> </p> <?php } ?> </footer> <div class="clear"></div> <div class="right vs_marg"> <small class="small"> <?php echo t('We use GeoLite2 from <a href="http://www.maxmind.com" rel="nofollow" class="gray">MaxMind</a>'); ?> </small> </div> <?php $design->staticFiles('js', PH7_STATIC . PH7_JS, 'jquery/box.js,jquery/tipTip.js,bootstrap.js,common.js,str.js,holder.js') ;?> <?php $design->staticFiles('js', PH7_LAYOUT . PH7_TPL . PH7_TPL_NAME . PH7_SH . PH7_JS, 'global.js') ;?> <?php $design->externalJsFile(PH7_URL_STATIC . PH7_JS . 'jquery/jquery-ui.js') ;?> <?php if($is_user_auth) { ?> <?php $design->staticFiles('js', PH7_STATIC . PH7_JS, 'setUserActivity.js,jquery/sound.js') ;?> <?php if($is_im_enabled) { ?> <?php $lang_file = Framework\Translate\Lang::getJsFile(PH7_PATH_TPL_SYS_MOD . 'im/' . PH7_TPL . PH7_DEFAULT_THEME . PH7_DS . PH7_JS . PH7_LANG) ;?> <?php $design->staticFiles('js', PH7_LAYOUT . PH7_SYS . PH7_MOD . 'im/' . PH7_TPL . PH7_DEFAULT_THEME . PH7_SH . PH7_JS, PH7_LANG . $lang_file . ',jquery.cookie.js,Messenger.js') ;?> <?php } ?> <?php } ?> <?php if($is_cookie_consent_bar) { ?> <script src="https://cdn.jsdelivr.net/npm/cookie-bar/cookiebar-latest.min.js?always=1"></script> <?php } ?> <?php $design->externalJsFile(PH7_RELATIVE.'asset/js/script.js') ;?> <?php $design->js() ;?> <?php $this->designModel->files('js') ?> <?php if($is_user_auth) { ?> <?php $this->display('favicon_alert.inc.tpl', PH7_PATH_TPL . PH7_TPL_NAME . PH7_DS); ?> <?php } ?> <?php $design->message() ;?> <?php $design->error() ;?> <?php if($is_disclaimer AND !AdminCore::isAdminPanel()) { ?> <?php $design->staticFiles('js', PH7_STATIC . PH7_JS . 'disclaimer', 'Disclaimer.js,common.js') ;?> <?php $this->display('disclaimer-dialog.inc.tpl', PH7_PATH_TPL . PH7_TPL_NAME . PH7_DS); ?> <?php } ?> <?php $design->htmlFooter() ;?>