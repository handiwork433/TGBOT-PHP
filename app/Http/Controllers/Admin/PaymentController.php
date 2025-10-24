<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PaymentController extends Controller
{
    public function index(): View
    {
        $payments = Payment::query()->latest()->paginate();

        return view('admin.payments.index', compact('payments'));
    }

    public function show(Payment $payment): View
    {
        return view('admin.payments.show', compact('payment'));
    }

    public function exportCsv(): StreamedResponse
    {
        $headers = ['Content-Type' => 'text/csv'];
        $callback = function () {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID', 'User', 'Plan', 'Amount', 'Status', 'Created At']);
            Payment::chunk(200, function ($payments) use ($handle) {
                foreach ($payments as $payment) {
                    fputcsv($handle, [
                        $payment->id,
                        optional($payment->user)->tg_username,
                        optional($payment->plan)->name,
                        $payment->amount,
                        $payment->status,
                        $payment->created_at,
                    ]);
                }
            });
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
