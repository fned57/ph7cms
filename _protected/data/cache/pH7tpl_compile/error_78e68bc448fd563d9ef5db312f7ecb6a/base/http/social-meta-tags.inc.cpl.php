<?php 
namespace PH7;
defined('PH7') or exit('Restricted access');
/*
Created on 2021-12-30 15:34:34
Compiled file from: C:\laragon\www\ph7\templates/themes/base\tpl\social-meta-tags.inc.tpl
Template Engine: PH7Tpl version 1.4.1 by Pierre-Henry Soria
*/
/**
 * @author     Pierre-Henry Soria
 * @email      hello@ph7cms.com
 * @link       https://ph7cms.com
 * @copyright  (c) 2011-2021, Pierre-Henry Soria. All Rights Reserved.
 */
?><?php $social_meta_title = $page_title ? $this->str->escape($this->str->upperFirst($page_title)) : $site_name ; $social_meta_desc = $this->str->escape($this->str->upperFirst($meta_description)) ;?><meta property="og:locale" content="<?php echo PH7_LANG_NAME ;?>" /><meta property="og:type" content="article" /><meta property="og:title" content="<?php echo $social_meta_title; ?>" /><meta property="og:description" content="<?php echo $social_meta_desc; ?>" /><meta property="og:url" content="<?php echo $this->httpRequest->currentUrl()?>" /><meta property="og:site_name" content="<?php echo $site_name; ?>" /><meta name="twitter:card" content="summary" /><meta name="twitter:title" content="<?php echo $social_meta_title; ?>" /><meta name="twitter:description" content="<?php echo $social_meta_desc; ?>" /><meta name="twitter:url" content="<?php echo $this->httpRequest->currentUrl()?>" /><meta itemprop="name" content="<?php echo $social_meta_title; ?>" /><meta itemprop="description" content="<?php echo $social_meta_desc; ?>" /><?php if(!empty($image_social_meta_tag)) { ?> <meta name="thumbnail" content="<?php echo $image_social_meta_tag; ?>" /> <meta name="twitter:image" content="<?php echo $image_social_meta_tag; ?>" /> <meta property="og:image" content="<?php echo $image_social_meta_tag; ?>" /> <meta itemprop="image" content="<?php echo $image_social_meta_tag; ?>" /><?php } ?>