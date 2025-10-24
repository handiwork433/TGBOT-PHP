<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $users = User::query()
            ->when($request->get('search'), function ($query, $search) {
                $query->where('tg_username', 'like', "%{$search}%")
                    ->orWhere('tg_user_id', 'like', "%{$search}%");
            })
            ->paginate();

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user): View
    {
        return view('admin.users.show', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'timezone' => ['nullable', 'string'],
            'locale' => ['nullable', 'string'],
        ]);

        $user->update($data);

        return back()->with('status', 'User updated');
    }

    public function ban(User $user): RedirectResponse
    {
        $user->update(['is_banned' => true]);

        return back()->with('status', 'User banned');
    }

    public function unban(User $user): RedirectResponse
    {
        $user->update(['is_banned' => false]);

        return back()->with('status', 'User unbanned');
    }

    public function grantComplimentaryDays(Request $request, User $user): RedirectResponse
    {
        $days = (int) $request->input('days', 0);

        if ($days > 0) {
            $user->extendSubscription($days, 'admin_comp');
        }

        return back()->with('status', 'Complimentary days granted');
    }
}
