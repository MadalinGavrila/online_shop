<?php

namespace App\Http\Controllers\Admin;

use App\Payment;
use App\Http\Controllers\Controller;

class AdminPaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::orderBy('created_at', 'desc')->paginate(8);

        return view('admin.payments.index', compact('payments'));
    }
}
