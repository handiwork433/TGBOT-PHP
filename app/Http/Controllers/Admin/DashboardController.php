<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $activeSubscriptions = Subscription::query()->where('status', 'active')->count();
        $mrr = Subscription::query()->where('status', 'active')->sum('plan.price_usdt');
        $paymentsLast30 = Payment::query()
            ->where('status', 'paid')
            ->where('paid_at', '>=', Carbon::now()->subDays(30))
            ->sum('amount');

        return view('admin.dashboard', [
            'activeSubscriptions' => $activeSubscriptions,
            'mrr' => $mrr,
            'paymentsLast30' => $paymentsLast30,
            'userCount' => User::count(),
        ]);
    }
}
