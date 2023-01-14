<?php

declare(strict_types=1);

namespace Casterke\SimplepayLaravel\SDK;

/**
 * Refund
 *
 * @category SDK
 *
 * @author   SimplePay IT Support <itsupport@otpmobil.com>
 * @license  http://www.gnu.org/licenses/gpl-3.0.html  GNU GENERAL PUBLIC LICENSE (GPL V3.0)
 *
 * @link     http://simplepartner.hu/online_fizetesi_szolgaltatas.html
 */
class SimplePayRefund extends Base
{
    public $transactionBase = [
        'salt' => '',
        'merchant' => '',
        'orderRef' => '',
        'transactionId' => '',
        'currency' => '',
    ];

    protected $currentInterface = 'refund';

    protected $returnData = [];

    /**
     * Run refund
     *
     * @return array $result API response
     */
    public function runRefund()
    {
        if ($this->transactionBase['orderRef'] == '') {
            unset($this->transactionBase['orderRef']);
        }
        if ($this->transactionBase['transactionId'] == '') {
            unset($this->transactionBase['transactionId']);
        }
        $this->logTransactionId = @$this->transactionBase['transactionId'];
        $this->logOrderRef = @$this->transactionBase['orderRef'];

        return $this->execApiCall();
    }
}
