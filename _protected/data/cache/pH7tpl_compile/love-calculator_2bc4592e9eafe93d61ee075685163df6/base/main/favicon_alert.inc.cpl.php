<?php 
namespace PH7;
defined('PH7') or exit('Restricted access');
/*
Created on 2021-12-30 15:39:53
Compiled file from: C:\laragon\www\ph7\templates/themes/base\tpl\favicon_alert.inc.tpl
Template Engine: PH7Tpl version 1.4.1 by Pierre-Henry Soria
*/
/**
 * @author     Pierre-Henry Soria
 * @email      hello@ph7cms.com
 * @link       https://ph7cms.com
 * @copyright  (c) 2011-2021, Pierre-Henry Soria. All Rights Reserved.
 */
?><?php $favicon_alert = 0 ; if(!empty($count_unread_mail)) { ?> <?php $favicon_alert += $count_unread_mail ; } if(!empty($count_pen_friend_request)) { ?> <?php $favicon_alert += $count_pen_friend_request ; } if($favicon_alert > 0) { ?> <script src="<?php echo PH7_URL_STATIC . PH7_JS?>tinycon.js"></script> <script>Tinycon.setBubble(<?php echo $favicon_alert; ?>)</script><?php } ?>