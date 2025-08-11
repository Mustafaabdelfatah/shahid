<?php

namespace App\Http\Controllers\Publisher\Payment;

use App\Models\Order;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;

class PaymentController extends Controller
{
    // public function checkingOut ($payment method, $integration_id, $order_id, $iframe_id_or_wallet_number): RedirectResponse
    public function checkingOut($payment_method, $integration_id, $order_id, $iframe_id_or_wallet_number): RedirectResponse
    {
        $body = [
            "username" => env("PAYMOB_USER_NAME"),
            "password" => env("PAYMOB_USER_PASSWORD")
        ];
        
        // Encode the body array to JSON format
        $jsonBody = json_encode($body);
        
        // First step: Obtain authentication token
        $response = Http::withHeaders([
            'content-type' => 'application/json'
        ])->post('https://accept.paymob.com/api/auth/tokens', [
            'api_key' => env('PAYMOB_API_KEY'),
            'body' => $jsonBody // Add the JSON body to the request
        ]);
        
        $json = $response->json();
        dd($json);
        $order = Order::findOrFail($order_id); // Use findOrFail instead of findorFail

        $grand_total = $order->price;

        $response_final = Http::withHeaders([
            'content-type' => 'application/json'
        ])->post('https://accept.paymobsolutions.com/api/ecommerce/orders', [
            "auth_token" => $json['token'], // Use => instead of ⇒
            "delivery_needed" => "false", // Change "false" to false
            "amount_cents" => $grand_total * 100,
            "merchant_order_id" => $order->id // Use -> instead of →
        ]);
        $json_final = $response_final->json();
        dd($json_final);
        $user = Auth::user();
        $name = $user->name;
        if (count(explode(" ", $name)) == 1) {
            $first_name = $name;
            $last_name = $name;
        } else {
            $name_parts = explode(" ", $name);
            $first_name = $name_parts[0];
            $last_name = $name_parts[1];
        }
        $response_final_final = Http::withHeaders([
            'content-type' => 'application/json'
        ])->post('https://accept.paymobsolutions.com/api/acceptance/payment_keys', [
            "auth_token" => $json['token'], // Changed ⇒ to => for array key-value pair
            "expiration" => 36000, // Changed ⇒ to => for array key-value pair
            "amount_cents" => $json_final['amount_cents'], // Changed > to => for array key-value pair, corrected variable name
            "order_id" => $json_final['id'], // Changed ⇒ to => for array key-value pair
            "billing_data" => [
                "first_name" => $first_name, // Changed > to => for array key-value pair
                "last_name" => $last_name, // Changed → to => for array key-value pair
                "phone_number" => $user->phone ?: "NA", // Changed ⇒ to => for array key-value pair, corrected arrow notation
                "email" => $user->email, // Changed ⇒ to => for array key-value pair, corrected arrow notation
                "apartment" => "NA",
                "floor" => "NA",
                "street" => $user->address, // Changed > to => for array key-value pair, corrected arrow notation
                "building" => "NA",
                "shipping_method" => "NA",
                "postal_code" => $user->postal_code, // Changed > to => for array key-value pair, corrected arrow notation
                "city" => $user->city, // Changed > to => for array key-value pair, corrected arrow notation
                "state" => $user->state ?: "NA", // Changed > to => for array key-value pair, corrected arrow notation
                "country" => $user->country, // Changed → to => for array key-value pair, corrected arrow notation
            ],
            "currency" => "EGP", // Changed > to => for array key-value pair
            "integration_id" => $integration_id // Changed ⇒ to => for array key-value pair
        ]);

        $response_final_final_json = $response_final_final->json(); // Corrected arrow notation


        if ($payment_method == 'paymob_mobile_wallet_payment') { // Use == for comparison, not =
            $response_iframe = Http::withHeaders([
                'content-type' => 'application/json' // Corrected the array syntax
            ])->post('https://accept.paymob.com/api/acceptance/payments/pay', [
                "source" => [ // Corrected the array syntax
                    [
                        "identifier" => $iframe_id_or_wallet_number, // Changed ⇒ to => for array key-value pair
                        "subtype" => "WALLET"
                    ],
                    [
                        "identifier" => "01010101010",
                        "subtype" => "WALLET"
                    ]
                ],
                "payment_token" => $response_final_final_json['token'] // Corrected the array syntax
            ]);

            $redirect_url = $response_iframe->json()['redirect_url']; // Corrected arrow notation

            return redirect($redirect_url);
        } else {
            return redirect('https://accept.paymobsolutions.com/api/acceptance/iframes/' . $iframe_id_or_wallet_number . '?payment_token=' . $response_final_final_json['token']);
        }
    }
}
