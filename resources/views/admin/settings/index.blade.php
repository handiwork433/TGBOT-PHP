@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Settings</h1>
    <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-sm font-medium">Notifications (JSON)</label>
            <textarea name="notifications" rows="6" class="w-full border rounded px-3 py-2">{{ json_encode($settings['notifications'] ?? [], JSON_PRETTY_PRINT) }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium">Features (JSON)</label>
            <textarea name="features" rows="6" class="w-full border rounded px-3 py-2">{{ json_encode($settings['features'] ?? [], JSON_PRETTY_PRINT) }}</textarea>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
    </form>
</div>
@endsection
