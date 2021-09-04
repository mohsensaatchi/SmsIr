<?php

namespace MohsenSaatchi\SmsIr;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;

class SmsIr
{
    protected function getToken()
    {
        $UserApiKey=env('SmsIr_API_KEY');
        $SecretKey=env('SmsIr_SECRET');
        $ApiUrl=env('SmsIr_API_URL');
        $body=array('UserApiKey' => $UserApiKey,'SecretKey' => $SecretKey);
        $header=['content-type' => 'application/json'];
        $request=new Request('POST', $ApiUrl."/Token", $header, json_encode($body));
        $client=new Client(['verify' => false]);
        $promise=$client->send($request);
        $result=$promise->getBody()->getContents();
        $token=json_decode($result,true)['TokenKey'];
        return $token;
    }
    public function SendMessage($message,$mobile,$date)
    {
        $token=$this->getToken();
        $ApiUrl=env('SMSIR_API_URL');
        $ApiUrl=env('SMSIR_API_URL');
        $line=env('SMSIR_LINE_NUMBER');
        $body=array('Messages'=>[$message],'MobileNumbers'=>[$mobile],'LineNumber'=>$line,'SendDateTime'=> $date,'CanContinueInCaseOfError'=> "false");
        $header=['content-type' => 'application/json', 'x-sms-ir-secure-token' => $token];
        $request = new Request('POST', $ApiUrl."/MessageSend", $header, json_encode($body));
        $client = new Client(['verify' => false]);
        $promise = $client->send($request);
        $result= $promise->getBody()->getContents();
        return $result;
    }
    public function SendVerificationCode($code,$mobile)
    {
        $token=$this->getToken();
        $ApiUrl=env('SmsIr_API_URL');
        $body=array('Code'=>$code,'MobileNumber'=>$mobile);
        $header=['content-type' => 'application/json', 'x-sms-ir-secure-token' => $token];
        $request = new Request('POST', $ApiUrl."/VerificationCode", $header, json_encode($body));
        $client = new Client(['verify' => false]);
        $promise = $client->send($request);
        $result= $promise->getBody()->getContents();
        return $result;
    }
}
