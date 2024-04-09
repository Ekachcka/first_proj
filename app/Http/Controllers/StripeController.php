<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Stripe;
class StripeController extends Controller
{
    public function stripe(Request $request){
        try {
            $stripe = new \Stripe\StripeClient(
                env('STRIPE_SECRET')
            );

            $response=$stripe->tokens->create([
                'card' => [
                    'number' => $request->number,
                    'exp_month' => $request->exp_month,
                    'exp_year' => $request->exp_year,
                    'cvc' => $request->cvc,
                ],
            ]);

            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

           $res=$stripe->charges->create([
                'amount' => $request->amount,
                'currency' => 'usd',
                'source' => $response->id,
            ]);
           return $res->status;
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }
}
