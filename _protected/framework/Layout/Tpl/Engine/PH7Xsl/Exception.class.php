<?php
/**
 * @author           Pierre-Henry Soria <hello@ph7cms.com>
 * @copyright        (c) 2012-2020, Pierre-Henry Soria. All Rights Reserved.
 * @license          MIT License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package          PH7 / Framework / Layout / Tpl / Engine / PH7Xsl
 */

namespace PH7\Framework\Layout\Tpl\Engine\PH7Xsl;

defined('PH7') or exit('Restricted access');

class Exception extends \PH7\Framework\Layout\Exception
{
    public function __construct($sMsg)
    {
        parent::__construct('ERROR XSLT Template: ' . $sMsg);
    }
}
