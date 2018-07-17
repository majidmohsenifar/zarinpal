<?php

namespace Ipallet\ZarinpalBundle\Services;

use SoapClient;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ZarinpalService
{
    private $container;

    private $merchantId;

    private $callBackUrl;

    private $paymentUrl;
    
    private $authorizeUrl;
    

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->merchantId = $this->container->getParameter('ipallet_zarinpal.merchant_id');
        $this->callBackUrl = $this->container->getParameter('ipallet_zarinpal.call_back_url');
        $this->paymentUrl = $this->container->getParameter('ipallet_zarinpal.payment_url');
        $this->authorizeUrl = $this->container->getParameter('ipallet_zarinpal.authorize_url') ?
            $this->container->getParameter('ipallet_zarinpal.authorize_url') : $this->paymentUrl;

    }

    public function pay($amount, $description, $email= null ,$mobile = null, $callbackURL = null)
    {
        $client = new SoapClient($this->paymentUrl, ['encoding' => 'UTF-8']);

        $parameters = [
            'MerchantID' => $this->merchantId,
            'Amount' => $amount,
            'Description' => $description,
            'Email' => $email,
            'Mobile' => $mobile,
            'CallbackURL' => $callbackURL ? $callbackURL : $this->callBackUrl,
        ];

//        if ($email){
//            $parameters['Email'] = $email;
//        }
//
//        if($mobile){
//            $parameters['Mobile'] = $mobile;
//        }

        $result = $client->PaymentRequest(
            $parameters
        );

        return $result;

    }

    public function authorize($authorityCode,$amount)
    {
        $client = new SoapClient($this->authorizeUrl, ['encoding' => 'UTF-8']);

        $result = $client->PaymentVerification(
            [
                'MerchantID' => $this->merchantId,
                'Authority' => $authorityCode,
                'Amount' => $amount,
            ]
        );
        
        return $result;

    }


}