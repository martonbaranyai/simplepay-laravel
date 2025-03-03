<?php

declare(strict_types=1);

namespace Casterke\SimplePayLaravel;

use Casterke\SimplePayLaravel\Exceptions\InvalidSignatureException;
use Casterke\SimplePayLaravel\Exceptions\InvalidSimplePayRequestException;
use Casterke\SimplePayLaravel\SDK\SimplePayStart;

class SimplePayLaravel
{
    protected $language = 'HU';

    protected $currency = 'HUF';

    protected $orderRef;

    protected $totalPrice;

    protected $email;

    protected $name;

    protected $company;

    protected $country;

    protected $state;

    protected $zip;

    protected $city;

    protected $address;

    public static function prepare()
    {
        return new static();
    }

    public function language($language)
    {
        $this->language = $language;

        return $this;
    }

    public function currency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    public function orderRef($orderRef)
    {
        $this->orderRef = $orderRef;

        return $this;
    }

    public function totalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    public function email($email)
    {
        $this->email = $email;

        return $this;
    }

    public function name($name)
    {
        $this->name = $name;

        return $this;
    }

    public function company($company)
    {
        $this->company = $company;

        return $this;
    }

    public function country($country)
    {
        $this->country = $country;

        return $this;
    }

    public function state($state)
    {
        $this->state = $state;

        return $this;
    }

    public function zip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    public function city($city)
    {
        $this->city = $city;

        return $this;
    }

    public function address($address)
    {
        $this->address = $address;

        return $this;
    }

    public function send()
    {
        $config = config('simplepay-laravel');

        $trx = new SimplePayStart();
        $trx->addData('currency', $this->currency);
        $trx->addConfig($config);

        //ORDER PRICE/TOTAL
        //-----------------------------------------------------------------------------------------
        $trx->addData('total', $this->totalPrice);

        //ORDER ITEMS
        //-----------------------------------------------------------------------------------------
        /*
        $trx->addItems(
            array(
                'ref' => 'Product ID 1',
                'title' => 'Product name 1',
                'desc' => 'Product description 1',
                'amount' => '1',
                'price' => '5',
                'tax' => '0',
                )
        );

        $trx->addItems(
            array(
                'ref' => 'Product ID 2',
                'title' => 'Product name 2',
                'desc' => 'Product description 2',
                'amount' => '1',
                'price' => '2',
                'tax' => '0',
                )
        );
        */

        // OPTIONAL DATA INPUT ON PAYMENT PAGE
        //-----------------------------------------------------------------------------------------
        //$trx->addData('maySelectEmail', true);
        //$trx->addData('maySelectInvoice', true);
        //$trx->addData('maySelectDelivery', ['HU']);

        // SHIPPING COST
        //-----------------------------------------------------------------------------------------
        //$trx->addData('shippingCost', 20);

        // DISCOUNT
        //-----------------------------------------------------------------------------------------
        //$trx->addData('discount', 10);

        // ORDER REFERENCE NUMBER
        // uniq oreder reference number in the merchant system
        //-----------------------------------------------------------------------------------------
        $trx->addData('orderRef', $this->orderRef);

        // CUSTOMER
        // customer's name
        //-----------------------------------------------------------------------------------------
        //$trx->addData('customer', 'v2 SimplePay Teszt');

        // customer's registration mehod
        // 01: guest
        // 02: registered
        // 05: third party
        //-----------------------------------------------------------------------------------------
        $trx->addData('threeDSReqAuthMethod', '02');

        // EMAIL
        // customer's email
        //-----------------------------------------------------------------------------------------
        $trx->addData('customerEmail', $this->email);

        // LANGUAGE
        // HU, EN, DE, etc.
        //-----------------------------------------------------------------------------------------
        $trx->addData('language', $this->language);

        // TWO STEP
        // true, or false
        // If this field does not exist is equal false value
        // Possibility of two step needs IT support setting
        //-----------------------------------------------------------------------------------------
        if (isset($_REQUEST['twoStep'])) {
            $trx->addData('twoStep', false);
        }

        // TIMEOUT
        // 2018-09-15T11:25:37+02:00
        //-----------------------------------------------------------------------------------------
        $timeoutInSec = 600;
        $timeout = @date('c', time() + $timeoutInSec);
        $trx->addData('timeout', $timeout);

        // METHODS
        // CARD or WIRE
        //-----------------------------------------------------------------------------------------
        $trx->addData('methods', ['CARD']);

        // REDIRECT URLs
        //-----------------------------------------------------------------------------------------

        if ($config['NAMED_ROUTES']) {
            $trx->addData('url', route($config['URL']));

            if (!empty($config['SUCCESS_PAGE_ROUTE_NAME'])) {
                $trx->addGroupData('urls', 'success', route($config['SUCCESS_PAGE_ROUTE_NAME']));
            }
            if (!empty($config['FAIL_PAGE_ROUTE_NAME'])) {
                $trx->addGroupData('urls', 'fail', route($config['FAIL_PAGE_ROUTE_NAME']));
            }
            if (!empty($config['CANCEL_PAGE_ROUTE_NAME'])) {
                $trx->addGroupData('urls', 'cancel', route($config['CANCEL_PAGE_ROUTE_NAME']));
            }
            if (!empty($config['TIMEOUT_PAGE_ROUTE_NAME'])) {
                $trx->addGroupData('urls', 'timeout', route($config['TIMEOUT_PAGE_ROUTE_NAME']));
            }
        } else {
            $trx->addData('url', $config['URL']);

            if (!empty($config['SUCCESS_PAGE_ROUTE_NAME'])) {
                $trx->addGroupData('urls', 'success', $config['SUCCESS_PAGE_ROUTE_NAME']);
            }
            if (!empty($config['FAIL_PAGE_ROUTE_NAME'])) {
                $trx->addGroupData('urls', 'fail', $config['FAIL_PAGE_ROUTE_NAME']);
            }
            if (!empty($config['CANCEL_PAGE_ROUTE_NAME'])) {
                $trx->addGroupData('urls', 'cancel', $config['CANCEL_PAGE_ROUTE_NAME']);
            }
            if (!empty($config['TIMEOUT_PAGE_ROUTE_NAME'])) {
                $trx->addGroupData('urls', 'timeout', $config['TIMEOUT_PAGE_ROUTE_NAME']);
            }
        }

        // Redirect from Simple app to merchant app
        //-----------------------------------------------------------------------------------------
        //$trx->addGroupData('mobilApp', 'simpleAppBackUrl', 'myAppS01234://payment/123456789');

        // INVOICE DATA
        //-----------------------------------------------------------------------------------------

        $trx->addGroupData('invoice', 'name', $this->name);
        if (!empty($this->company)) {
            $trx->addGroupData('invoice', 'company', $this->company);
        }
        $trx->addGroupData('invoice', 'country', $this->country);
        $trx->addGroupData('invoice', 'state', $this->state);
        $trx->addGroupData('invoice', 'city', $this->city);
        $trx->addGroupData('invoice', 'zip', $this->zip);
        $trx->addGroupData('invoice', 'address', $this->address);
        //$trx->addGroupData('invoice', 'address2', 'Address 2');
        //$trx->addGroupData('invoice', 'phone', '06201234567');

        // DELIVERY DATA
        //-----------------------------------------------------------------------------------------
        /*
        $trx->addGroupData('delivery', 'name', 'SimplePay V2 Tester');
        $trx->addGroupData('delivery', 'company', '');
        $trx->addGroupData('delivery', 'country', 'hu');
        $trx->addGroupData('delivery', 'state', 'Budapest');
        $trx->addGroupData('delivery', 'city', 'Budapest');
        $trx->addGroupData('delivery', 'zip', '1111');
        $trx->addGroupData('delivery', 'address', 'Address 1');
        $trx->addGroupData('delivery', 'address2', '');
        $trx->addGroupData('delivery', 'phone', '06203164978');
        */

        //payment starter element
        // auto: (immediate redirect)
        // button: (default setting)
        // link: link to payment page
        //-----------------------------------------------------------------------------------------
        $trx->formDetails['element'] = 'link';

        $trx->runStart();

        $responseData = $trx->getReturnData();

        if ($responseData && array_key_exists('errorCodes', $responseData)) {
            throw new InvalidSimplePayRequestException(
                sprintf(
                    'Probably the request is missing a required param. Please check the documentation for the following error code: %s',
                    $responseData['errorCodes'][0]
                )
            );
        }

        if (!$responseData['responseSignatureValid']) {
            throw new InvalidSignatureException('Response missing or not valied');
        }

        return $responseData;
    }
}
