<?php

namespace App\PaymentSupport\Itdprocess;
use App\PaymentSupport\Itdprocess\Gateways\PaymentGatewayInterface;
/**
* 
*/
class Itdprocess 
{
	protected $gateway;

	function __construct(PaymentGatewayInterface $gateway)
	{
		$this->gateway = $gateway;
	}

	public function prepare($parameters)
	{
		return $this->gateway->request($parameters);
	}

	public function process($order)
	{
		return $order->send();
	}

	public function response($request)
	{
		return $this->gateway->response($request);
	}
}