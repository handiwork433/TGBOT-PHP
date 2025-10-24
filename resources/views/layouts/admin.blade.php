<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Arb Alerts') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="min-h-screen">
        <nav class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
                <div class="text-xl font-semibold">Arb Alerts Admin</div>
                <div class="space-x-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-gray-900">Dashboard</a>
                    <a href="{{ route('signals.index') }}" class="text-gray-600 hover:text-gray-900">Signals</a>
                    <a href="{{ route('plans.index') }}" class="text-gray-600 hover:text-gray-900">Plans</a>
                    <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-gray-900">Users</a>
                </div>
            </div>
        </nav>
        <main class="max-w-7xl mx-auto">
            @yield('content')
        </main>
    </div>
</body>
</html>
