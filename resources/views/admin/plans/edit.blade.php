@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Plan</h1>
    <form method="POST" action="{{ route('plans.update', $plan) }}" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-sm font-medium">Name</label>
            <input name="name" value="{{ old('name', $plan->name) }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label class="block text-sm font-medium">Slug</label>
            <input name="slug" value="{{ old('slug', $plan->slug) }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label class="block text-sm font-medium">Period (days)</label>
            <input name="period_days" type="number" value="{{ old('period_days', $plan->period_days) }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label class="block text-sm font-medium">Price (USDT)</label>
            <input name="price_usdt" type="number" step="0.01" value="{{ old('price_usdt', $plan->price_usdt) }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_active" value="1" class="mr-2" @checked($plan->is_active)> Active
            </label>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
