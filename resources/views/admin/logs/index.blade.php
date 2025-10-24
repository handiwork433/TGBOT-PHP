@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Audit Logs</h1>
    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left">ID</th>
                <th class="px-4 py-2 text-left">Action</th>
                <th class="px-4 py-2 text-left">Meta</th>
                <th class="px-4 py-2 text-left">Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $log->id }}</td>
                    <td class="px-4 py-2">{{ $log->action }}</td>
                    <td class="px-4 py-2"><pre class="whitespace-pre-wrap text-xs">{{ json_encode($log->meta_json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre></td>
                    <td class="px-4 py-2">{{ $log->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $logs->links() }}
</div>
@endsection
