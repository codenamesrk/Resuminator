<?php 
namespace App\PaymentSupport\Itdprocess\Gateways;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use App\User;
use App\Payment;
use Redis;
use Cache;

class PayUMoneyGateway implements PaymentGatewayInterface {

    protected   $merchantKey,
                $txnid,
                $parameters = array(),
                $testMode,
                $liveEndPoint,
                $testEndPoint;
    public  $refUrl, 
            $response = '';

    function __construct()
    {
        $this->parameters['sitekey'] = env('SITE_KEY');        
        $txnid = $this->generateTransactionID();
        $this->testMode = env('PAYMENT_TEST_MODE');
        $this->liveEndPoint = env('PAYMENT_LIVE_ENDPOINT');
        $this->testEndPoint = env('PAYMENT_TEST_ENDPOINT');        
        $this->parameters['orderid'] = $this->generateOrderID($txnid);
        $this->parameters['domainref'] = $this->generateOrderIdHash($this->parameters['orderid']);
    }

    public function request($parameters)
    {
        $this->parameters = array_merge($this->parameters,$parameters);
        $this->checkParameters($this->parameters);
        $this->encrypt();
        // dd($this);
        Redis::hmset('order:' . $this->parameters['orderid'], [
            'id' => $this->parameters['id'],
            'email' => $this->parameters['femail'],
            'domainref' => $this->parameters['domainref'],
        ]);        
        return $this;
    }

    public function send()
    {               

        Log::info('Payment Request towards Itdprocess Initiated: ');
        return view('user.payumoney')->with('parameters',$this->parameters)
                                     ->with('endPoint',$this->getEndPoint());        
    }

    public function getEndPoint()
    {
        return $this->testMode ? $this->testEndPoint : $this->liveEndPoint;
    }

    public function checkParameters($parameters)
    {
        $validator = Validator::make($parameters, [
            'sitekey' => 'required',
            'orderid' => 'required',
            'fname' => 'required',
            'femail' => 'required',
            'fphone' => 'required',
            'famount' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            abort(403, 'Unauthorized action.');
        }

    }    

    protected function encrypt()
    {
        $this->hash = '';
        $hashSequence = "fname|fphone|femail|famount|orderid|sitekey";
        $hashVarsSeq = explode('|', $hashSequence);
        $hash_string = '';

        foreach($hashVarsSeq as $hash_var) {
            $hash_string .= isset($this->parameters[$hash_var]) ? $this->parameters[$hash_var] : '';
            $hash_string .= '|';
        }
        $hash_string = trim($hash_string,'|');
        $this->parameters['before_hash'] = $hash_string;        
        $this->parameters['txnref'] = hash('sha512', $hash_string);        
    }

    protected function decrypt($response)
    {
        dd($response);
        $hashSequence = "fname|fphone|femail|famount|orderid|txnid|paymentstatus|payuMoneyId|sitekey";
        // $hashSequence = "sitekey|famount|productinfo|fname|femail";
        $hashVarsSeq = explode('|', $hashSequence);
        $hash_string = '';

        foreach($hashVarsSeq as $hash_var) {
            $hash_string .= isset($response[$hash_var]) ? $response[$hash_var] : '';
            $hash_string .= '|';
        }

        $hash_string = trim($hash_string,'|');
        $hash_string .= '|';     
        $hash_string .= env('SITE_KEY');       
        return hash('sha512', $hash_string);        
    }

    public function generateTransactionID()
    {
        return substr(hash('sha256', mt_rand() . microtime()), 0, 20);
    }

    public function generateOrderID($txnid)
    {
        return date("Y")."/".date("m")."/".date("d")."/".$txnid;
    }

    public function generateOrderIdHash($orderid)
    {
        $hashorder = $orderid . env('SALT');
        return strtolower(hash('sha512', $hashorder));
    }    

    public function response($request)
    {         

        $this->response = $request->all();
        
        // Verfied Domain
        $response_hash = $this->decrypt($this->response);

        if($response_hash != $this->response['txnref']){
            return 'Hash Mismatch Error';
        } else {
            return $this->response; 
        }

    }         

}