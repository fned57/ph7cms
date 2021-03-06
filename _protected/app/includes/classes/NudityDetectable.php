<?php
/**
 * @author           Pierre-Henry Soria <hello@ph7cms.com>
 * @copyright        (c) 2018-2019, Pierre-Henry Soria. All Rights Reserved.
 * @license          MIT License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package          PH7 / App / Include / Class
 */

namespace PH7;

interface NudityDetectable
{
    /**
     * @return bool
     */
    public function isNudityFilterEligible();

    /**
     * Overwrite $iApproved if the image doesn't seem suitable to anyone.
     *
     * @return void
     */
    public function checkNudityFilter();
}
