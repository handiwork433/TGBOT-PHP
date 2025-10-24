@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Users</h1>
    <form method="GET" class="mb-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search" class="border rounded px-3 py-2">
        <button class="bg-blue-500 text-white px-3 py-2 rounded">Search</button>
    </form>
    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left">TG Username</th>
                <th class="px-4 py-2 text-left">Locale</th>
                <th class="px-4 py-2 text-left">Timezone</th>
                <th class="px-4 py-2 text-left">Status</th>
                <th class="px-4 py-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr class="border-t">
                    <td class="px-4 py-2">
                        <a href="{{ route('admin.users.show', $user) }}" class="text-blue-600">{{ $user->tg_username ?? 'N/A' }}</a>
                    </td>
                    <td class="px-4 py-2">{{ $user->locale }}</td>
                    <td class="px-4 py-2">{{ $user->timezone }}</td>
                    <td class="px-4 py-2">{{ $user->is_banned ? 'Banned' : 'Active' }}</td>
                    <td class="px-4 py-2">
                        @if($user->is_banned)
                            <form action="{{ route('admin.users.unban', $user) }}" method="POST">
                                @csrf
                                <button class="text-green-600">Unban</button>
                            </form>
                        @else
                            <form action="{{ route('admin.users.ban', $user) }}" method="POST">
                                @csrf
                                <button class="text-red-600">Ban</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
</div>
@endsection
