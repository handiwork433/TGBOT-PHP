@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Plans</h1>
        <a href="{{ route('plans.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Create</a>
    </div>
    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left">Name</th>
                <th class="px-4 py-2 text-left">Price (USDT)</th>
                <th class="px-4 py-2 text-left">Period (days)</th>
                <th class="px-4 py-2 text-left">Active</th>
                <th class="px-4 py-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($plans as $plan)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $plan->name }}</td>
                    <td class="px-4 py-2">{{ $plan->price_usdt }}</td>
                    <td class="px-4 py-2">{{ $plan->period_days }}</td>
                    <td class="px-4 py-2">{{ $plan->is_active ? 'Yes' : 'No' }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('plans.edit', $plan) }}" class="text-blue-600">Edit</a>
                        <form action="{{ route('plans.destroy', $plan) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $plans->links() }}
</div>
@endsection
