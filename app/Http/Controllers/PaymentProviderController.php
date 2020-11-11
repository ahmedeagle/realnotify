<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentProviderController extends Controller
{
    public function getCheckOutId(Request $request){

        $url = config('payment.hyperpay.url') . "/v1/checkouts";
        $data = "entityId=" . config('payment.hyperpay.entity_id') .
        "&amount=". $request -> price .
        "&currency=EUR" .
        "&paymentType=DB";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer ' . config('payment.hyperpay.auth_key')));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, config('payment.hyperpay.production'));// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        $res = json_decode($responseData, true);

        $view = view('ajax.form')->with(['responseData' => $res , 'id' => $request -> offer_id])
            ->renderSections();

        return response()->json([
            'status' => true,
            'content' => $view['main']
        ]);


    }
}
