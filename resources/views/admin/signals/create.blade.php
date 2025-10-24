@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Create Signal</h1>
    <form method="POST" action="{{ route('signals.store') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium">Title</label>
            <input name="title" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label class="block text-sm font-medium">Content (Markdown)</label>
            <textarea name="content_md" rows="6" class="w-full border rounded px-3 py-2" required></textarea>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
    </form>
</div>
@endsection
