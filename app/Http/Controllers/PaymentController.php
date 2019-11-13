<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tzsk\Payu\Facade\Payment;
use Illuminate\Support\Facade\DB;
use Tzsk\Payu\Helpers\FormBuilder;
use Tzsk\Payu\Helpers\Processor;
use Auth;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        return view('tzsk::payment_form', [
            'payment' => (new FormBuilder($request))->build()
        ]);
    }

    /**
     * After payment it will return here.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function payment(Request $request)
    {
        // $payment = (new Processor($request))->process();
        // Session::put('tzsk_payu_data.payment', $payment);
        // return redirect()->to(base64_decode($request->callback));
        $attributes = [
    'txnid' => strtoupper(str_random(8)), # Transaction ID.
    'amount' => rand(100, 999), # Amount to be charged.
    'productinfo' => "Product Information",
    'firstname' => "John", # Payee Name.
    'email' => "john@doe.com", # Payee Email Address.
    'phone' => "9876543210", # Payee Phone Number.
];

return Payment::make($attributes, function ($then) {
    $then->redirectTo('payment/status');
    # OR...
    $then->redirectRoute('payment.status');
    # OR...
    $then->redirectAction('PaymentController@status');
});
}
public function status(request $request){
    return dd($data);
    $payment = Payment::capture();
// Get the payment status.
    $data = $payment->isCaptured();
  # Returns boolean - true / false
    // return dd($data);
    if($data ==false):
        return "False data found";
    endif;
    if($data == true):
        return "true data found";
    endif;

}
}
