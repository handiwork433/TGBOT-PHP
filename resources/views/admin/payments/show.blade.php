@extends('layouts.admin')

@section('content')
<div class="p-6 space-y-4">
    <h1 class="text-2xl font-bold">Payment {{ $payment->invoice_id }}</h1>
    <div class="bg-white shadow rounded p-4">
        <div><strong>User:</strong> {{ optional($payment->user)->tg_username }}</div>
        <div><strong>Plan:</strong> {{ optional($payment->plan)->name }}</div>
        <div><strong>Amount:</strong> {{ $payment->amount }} {{ $payment->currency }}</div>
        <div><strong>Status:</strong> {{ $payment->status }}</div>
        <div><strong>Paid At:</strong> {{ optional($payment->paid_at)->toDateTimeString() }}</div>
    </div>
</div>
@endsection
