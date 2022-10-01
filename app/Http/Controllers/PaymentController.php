<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;


class PaymentController extends Controller
{
    public static function checkStatus($payment_id){
        $hashed = Hash::make($payment_id .'123456' , [
            'rounds' => 10,
        ]);
        return Http::post('https://api.tarlanpayments.kz/payment/check-status',
            [
                'reference_id' => $payment_id,
                'merchant_id' => '1',
                'secret_key' => $hashed
            ]
        );

    }
    public function payCallback(Request $request){

    }
    public static function createInvoice(Request $request, $payment_id){
        $hashed = Hash::make($payment_id . $request['amount'] . $request['pan'] . $request['cvc'] .'123456' , [
            'rounds' => 10,
        ]);
        return Http::post('https://api.tarlanpayments.kz/invoice/api-payment', [
            'merchant_id' => '1',
            'amount' => $request['amount'],
            'card_holder' => $request['card_holder'],
            'pan' => $request['pan'],
            'exp_month' => substr($request['exp_year_month'], 0,2),
            'exp_year' => substr($request['exp_year_month'], -2),
            'cvc' => $request['cvc'],
            'user_email' => auth()->user()['email'],
            'description' => 'Test',
            'back_url' => 'http://savbaumw.beget.tech/callback',
            'request_url' => 'http://savbaumw.beget.tech/account',
            'reference_id' => $payment_id,
            'secret_key' => $hashed,
            'is_test' => true,
        ]);
    }
}
