@extends('layouts.admin')

@section('content')
<div class="p-6 space-y-4">
    <h1 class="text-2xl font-bold">User {{ $user->tg_username ?? $user->id }}</h1>
    <div class="bg-white shadow rounded p-4">
        <div><strong>Telegram ID:</strong> {{ $user->tg_user_id }}</div>
        <div><strong>Locale:</strong> {{ $user->locale }}</div>
        <div><strong>Timezone:</strong> {{ $user->timezone }}</div>
    </div>
    <form method="POST" action="{{ route('admin.users.comp', $user) }}" class="flex space-x-2">
        @csrf
        <input type="number" name="days" placeholder="Days" class="border rounded px-3 py-2">
        <button class="bg-blue-500 text-white px-4 py-2 rounded">Grant complimentary days</button>
    </form>
</div>
@endsection
