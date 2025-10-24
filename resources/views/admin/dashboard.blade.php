@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white shadow rounded p-4">
            <div class="text-gray-500">Active Subscriptions</div>
            <div class="text-3xl font-semibold">{{ $activeSubscriptions }}</div>
        </div>
        <div class="bg-white shadow rounded p-4">
            <div class="text-gray-500">MRR</div>
            <div class="text-3xl font-semibold">${{ number_format($mrr, 2) }}</div>
        </div>
        <div class="bg-white shadow rounded p-4">
            <div class="text-gray-500">Payments (30d)</div>
            <div class="text-3xl font-semibold">${{ number_format($paymentsLast30, 2) }}</div>
        </div>
        <div class="bg-white shadow rounded p-4">
            <div class="text-gray-500">Users</div>
            <div class="text-3xl font-semibold">{{ $userCount }}</div>
        </div>
    </div>
</div>
@endsection
