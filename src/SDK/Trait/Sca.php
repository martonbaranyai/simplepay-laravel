<?php

declare(strict_types=1);

namespace Casterke\SimplePayLaravel\SDK\Trait;

/**
 * Strong Customer Authentication (SCA) -- 3DSecure
 *
 * @category SDK
 *
 * @author   SimplePay IT Support <itsupport@otpmobil.com>
 * @license  http://www.gnu.org/licenses/gpl-3.0.html  GNU GENERAL PUBLIC LICENSE (GPL V3.0)
 *
 * @link     http://simplepartner.hu/online_fizetesi_szolgaltatas.html
 */
trait Sca
{
    /**
     * StartChallenge
     *
     * @param  array  $v2Result Result of API call
     * @return bool        Success of redirection
     */
    public function challenge($v2Result = [])
    {
        if (isset($v2Result['redirectUrl'])) {
            $this->returnData['paymentUrl'] = $v2Result['redirectUrl'];
            $this->getHtmlForm();
            $this->writeLog(['3DSCheckResult' => 'Card issuer bank wants to identify cardholder (challenge)', '3DSChallengeUrl' => $v2Result['redirectUrl']]);
            echo $this->returnData['form'];

            return true;
        }
        $this->writeLog(['3DSCheckResult' => 'Card issuer bank wants to identify cardholder (challenge)', '3DSChallengeUrl_ERROR' => 'Missing redirect URL']);

        return false;
    }
}
