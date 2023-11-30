<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Stripe;

/*class PagoController extends Controller
{    public function postPaymentStripe(Request $request)
    {   
        $stripe = new \Stripe\StripeClient('sk_test_51OHrjMHpZ679pTH1asA1fV5NA9fM2asdhvU1B6l8hpPBtwgPxUOwUUG7mLpTrPxwfOOFyAKxWUqgFvxDPLX8LgkQ00Omcomto9');

        $stripe->paymentIntents->create([
          'amount' => 100,
          'currency' => 'usd',
          'payment_method' => 'pm_card_visa',
          
        ]); } } */ 
class PagoController extends Controller
{
    public function paymentStripe()
    {
        return view('stripe');
    }
 
    public function postPaymentStripe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'card_no' => 'required',
            'ccExpiryMonth' => 'required',
            'ccExpiryYear' => 'required',
            'cvvNumber' => 'required',
        ]);

        if ($validator->passes()) {
            try {
                $stripe = Stripe::setApiKey(env('STRIPE_SECRET'));

                $token = $stripe->tokens()->create([
                    'card' => [
                        'number' => $request->get('card_no'),
                        'exp_month' => $request->get('ccExpiryMonth'),
                        'exp_year' => $request->get('ccExpiryYear'),
                        'cvc' => $request->get('cvvNumber'),
                    ],
                ]);

                if (!isset($token['id'])) {
                    return redirect()->route('stripe.add.money');
                }

                // Ahora puedes usar $token['id'] en lugar de crear otro token

                $charge = $stripe->charges()->create([
                    'card' => $token['id'],
                    'currency' => 'USD',
                    'amount' => 20.49,
                    'description' => 'wallet',
                    'confirm' => true, // Solicitar confirmación 3D Secure
                ]);

                if ($charge['status'] == 'succeeded') {
                    dd($charge);
                    return redirect()->route('addmoney.paymentstripe');
                } else {
                    return redirect()->route('addmoney.paymentstripe')->with('error', 'Money not added to wallet!');
                }
            } catch (CardErrorException $e) {
                // Manejar errores específicos de la tarjeta
                return redirect()->route('addmoney.paymentstripe')->with('error', $e->getMessage());
            } catch (MissingParameterException $e) {
                return redirect()->route('addmoney.paymentstripe')->with('error', $e->getMessage());
            } catch (\Exception $e) {
                return redirect()->route('addmoney.paymentstripe')->with('error', $e->getMessage());
            }
        } else {
            return redirect()->route('addmoney.paymentstripe')->withErrors($validator);
        }
    }
}
