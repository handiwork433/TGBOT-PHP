@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Signal</h1>
    <form method="POST" action="{{ route('signals.update', $signal) }}" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-sm font-medium">Title</label>
            <input name="title" value="{{ old('title', $signal->title) }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label class="block text-sm font-medium">Content (Markdown)</label>
            <textarea name="content_md" rows="6" class="w-full border rounded px-3 py-2" required>{{ old('content_md', $signal->content_md) }}</textarea>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
