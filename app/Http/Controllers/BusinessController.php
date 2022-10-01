<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class BusinessController extends Controller
{
    public static function checkAccount(Request $request)
    {
        $user_id = auth()->id();;
        $user_account = auth()->user()->account;;
        if ($request->session()->has('payment')) {
            $payment_id = $request->session()->get('payment');
            $payment_status = PaymentController::checkStatus($payment_id);
            if ($payment_status){
                $user_payment = Payment::find($payment_id);
                $user_payment->status_desc = $payment_status['message'];
                $user_payment->save();
                $request->session()->put('message', 'Платеж: ' . $payment_id . $payment_status['message']);
            }
            $request->session()->pull('payment', '');
        } else {
            $request->session()->pull('message', '');
        }


        $user_payments = DB::table('payments')
            ->where('user_id', '=', $user_id)
            ->get();

        $clients = DB::table('users')
            ->where('BIN', '=', 0)
            ->get();


        return view('account',
            [
                'user_payments' => $user_payments,
                'clients' => $clients,
                'user_account' => $user_account,
            ])  ;
    }
    public function payCallback(Request $request){
        $user = new User();
        $user->name = $request['name'];
        $user->phone_number = $request['phone_number'];
        $user->password = $request['password'];
        $user->save();
    }
    public function topUpAccount(Request $request)
    {
        $credentials = $request->validate([
            'amount' => 'required|numeric',
            'card_holder' => [
                'required',
                'regex:/^[a-z]{1,15} [a-z]{1,15}$/i',
            ],
            'pan' => 'required|digits:16',
            'exp_year_month' => [
                'required',
                'regex:/^\d{2}\/\d{2}$/i',
            ],
            'cvc' => 'required|digits:3',
        ]);
        $payment = new Payment();
        $payment->amount = $request['amount'];
        $payment->user_id = auth()->id();
        $payment->save();
        //DB::beginTransaction();
        $request->session()->put('payment', $payment->id);
        if ($payment){
            $response = PaymentController::createInvoice($request, $payment->id);
            if ($response['is3ds']){
                return view('3ds', [
                    'acsUrl' => $response['acsUrl'],
                    'md' => $response['md'],
                    'pares' => $response['pares'],
                    'termUrl' => $response['termUrl'],
                ]);
            }
            elseif ($response['success']) {
                return redirect($response['data']['redirect_url']) ;
            }
            else {
                return 'Ошибка' . $response['message'];
            }
        }
        else{
            return 'DB Error';
        }

    }
    public function sendBonuses(Request $request)
    {
        $request->validate([
            'sum' => 'required|numeric',
            'user_id' => 'required|numeric',
        ]);
        $user = User::find($request->user_id);

        $request->sum = (int) $request->sum;
        $user->account = (int) $user->account;

        if (auth()->user()->account < $request->sum) {
            return 'Недостаточно средств на счете';
        }

        auth()->user()->account -= $request->sum;
        $user->account += $request->sum;

        $payment = new Payment();
        $payment->amount = $request['sum'];
        $payment->user_id = auth()->id();
        $payment->recipient_id = $request->user_id;
        $payment->status = 1;
        $payment->status_desc = 'Бонусы начислены!';

        DB::transaction(function () use ($user, $payment) {
            $user->save();
            auth()->user()->save();
            $payment->save();
        });


        return redirect('/account')->with('message', 'Транзакция прошла успешно!');
    }

}
