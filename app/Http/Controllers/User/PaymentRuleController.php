<?php

namespace App\Http\Controllers\User;

use App\Models\PaymentRule;

class PaymentRuleController extends Controller
{
    public function GetPaymentRules()
    {
        $paymentRules = PaymentRule::all();
        return $paymentRules;
    }
}
