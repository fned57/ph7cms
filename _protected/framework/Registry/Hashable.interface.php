<?php
/**
 * @title            List Interface
 *
 * @author           Pierre-Henry Soria <hello@ph7cms.com>
 * @copyright        (c) 2012-2019, Pierre-Henry Soria. All Rights Reserved.
 * @license          MIT License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package          PH7 / Framework / Registry
 */

namespace PH7\Framework\Registry;

interface Hashable
{
    /**
     * Push data in the list.
     *
     * @param string $sName
     * @param string $sValue
     *
     * @return void
     */
    public function push($sName, $sValue);
}
