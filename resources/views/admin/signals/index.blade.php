@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Signals</h1>
        <a href="{{ route('signals.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Create</a>
    </div>
    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left">Title</th>
                <th class="px-4 py-2 text-left">Risk</th>
                <th class="px-4 py-2 text-left">Publish At</th>
                <th class="px-4 py-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($signals as $signal)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $signal->title }}</td>
                    <td class="px-4 py-2">{{ $signal->risk_level }}</td>
                    <td class="px-4 py-2">{{ optional($signal->publish_at)->toDateTimeString() }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('signals.edit', $signal) }}" class="text-blue-600">Edit</a>
                        <form action="{{ route('signals.destroy', $signal) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $signals->links() }}
</div>
@endsection
