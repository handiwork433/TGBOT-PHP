@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Payments</h1>
        <a href="{{ route('admin.payments.export') }}" class="bg-green-500 text-white px-4 py-2 rounded">Export CSV</a>
    </div>
    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left">Invoice</th>
                <th class="px-4 py-2 text-left">User</th>
                <th class="px-4 py-2 text-left">Plan</th>
                <th class="px-4 py-2 text-left">Amount</th>
                <th class="px-4 py-2 text-left">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
                <tr class="border-t">
                    <td class="px-4 py-2">
                        <a href="{{ route('payments.show', $payment) }}" class="text-blue-600">{{ $payment->invoice_id }}</a>
                    </td>
                    <td class="px-4 py-2">{{ optional($payment->user)->tg_username }}</td>
                    <td class="px-4 py-2">{{ optional($payment->plan)->name }}</td>
                    <td class="px-4 py-2">{{ $payment->amount }} {{ $payment->currency }}</td>
                    <td class="px-4 py-2">{{ $payment->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $payments->links() }}
</div>
@endsection
