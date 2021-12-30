<?php 
namespace PH7;
defined('PH7') or exit('Restricted access');
/*
Created on 2021-12-30 15:24:23
Compiled file from: C:\laragon\www\ph7\templates/themes/base\tpl\headings.inc.tpl
Template Engine: PH7Tpl version 1.4.1 by Pierre-Henry Soria
*/
/**
 * @author     Pierre-Henry Soria
 * @email      hello@ph7cms.com
 * @link       https://ph7cms.com
 * @copyright  (c) 2011-2021, Pierre-Henry Soria. All Rights Reserved.
 */
?><div class="center" id="headings"> <?php foreach(['h1' => 'h1_title', 'h2' => 'h2_title', 'h3' => 'h3_title', 'h4' => 'h4_title'] as $heading => $headingVar) { ?> <?php if(!empty($$headingVar)) { ?> <<?php echo $heading; ?>><?php echo $$headingVar ;?></<?php echo $heading; ?>> <?php } ?> <?php } ?></div>