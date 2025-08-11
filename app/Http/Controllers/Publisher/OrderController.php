<?php

namespace App\Http\Controllers\Publisher;

use App\Http\Controllers\Publisher\Payment\PaymentController;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\DatePackageProduct;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function index()
    {
        $date_package_product =  Session::get('date_package_product');
        $date_package_product = DatePackageProduct::query()->with(['package', 'date', 'product'])->active(1)->where('id', $date_package_product)->first();

        return view('publisher.pages.order.index', compact('date_package_product'));
    }

    public function store(Request $request)
    {
        //validate request
        $data = $request->validate([
            'date_package_id' => 'required|numeric',
            'package_id' => 'required|numeric',
            'product_id' => 'required|numeric',
            'price' => 'required|numeric',
        ]);
        $data['user_id'] = auth()->user()->id;
        $data['status'] = "pending";
        //create order
        $order = Order::create($data);
        $order->save();
        //remove date_package_product from session
        Session::forget('date_package_product');

        //check out payment 
        if ($request->payment_method == 'paymob_card_payment') {
            return (new PaymentController)->checkingOut(
                'paymob_card_payment',
                env('PAYMOB_CARD_INTEGRATION_ID'),
                $order->id,
                env('PAYMOB_CARD_IFRAME_ID')
            );
        } elseif ($request->payment_method == 'payment_mobile_wallet') {
            return (new PaymentController)->checkingOut(
                'payment_mobile_wallet',
                env('PAYMOB_MOBILE_WALLET_INTEGRATION_ID'),
                $order->id,
                $request->mobile
            );
        }
        return redirect()->route('publisher.orders.index')->with('success', 'Order created successfully');
    }
}
