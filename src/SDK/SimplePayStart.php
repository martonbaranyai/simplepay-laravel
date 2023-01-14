<?php

declare(strict_types=1);

namespace Casterke\SimplepayLaravel\SDK;

/**
 * Start transaction
 *
 * @category SDK
 *
 * @author   SimplePay IT Support <itsupport@otpmobil.com>
 * @license  http://www.gnu.org/licenses/gpl-3.0.html  GNU GENERAL PUBLIC LICENSE (GPL V3.0)
 *
 * @link     http://simplepartner.hu/online_fizetesi_szolgaltatas.html
 */
class SimplePayStart extends Base
{
    public $transactionBase = [
        'salt' => '',
        'merchant' => '',
        'orderRef' => '',
        'currency' => '',
        'sdkVersion' => '',
        'methods' => [],
    ];

    protected $currentInterface = 'start';

    /**
     * Send initial data to SimplePay API for validation
     * The result is the payment link to where website has to redirect customer
     *
     * @return void
     */
    public function runStart()
    {
        $this->execApiCall();
    }
}
