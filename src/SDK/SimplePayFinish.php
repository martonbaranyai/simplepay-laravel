<?php

declare(strict_types=1);

namespace Casterke\SimplepayLaravel\SDK;

/**
 * Finish
 *
 * @category SDK
 *
 * @author   SimplePay IT Support <itsupport@otpmobil.com>
 * @license  http://www.gnu.org/licenses/gpl-3.0.html  GNU GENERAL PUBLIC LICENSE (GPL V3.0)
 *
 * @link     http://simplepartner.hu/online_fizetesi_szolgaltatas.html
 */
class SimplePayFinish extends Base
{
    public $transactionBase = [
        'salt' => '',
        'merchant' => '',
        'orderRef' => '',
        'transactionId' => '',
        'originalTotal' => '',
        'approveTotal' => '',
        'currency' => '',
    ];

    protected $currentInterface = 'finish';

    protected $returnData = [];

    /**
     * Run finish
     *
     * @return array $result API response
     */
    public function runFinish()
    {
        return $this->execApiCall();
    }
}
