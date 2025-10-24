<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Signal;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SignalController extends Controller
{
    public function index(): View
    {
        $signals = Signal::query()->latest()->paginate();

        return view('admin.signals.index', compact('signals'));
    }

    public function create(): View
    {
        return view('admin.signals.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string'],
            'content_md' => ['required', 'string'],
        ]);

        Signal::create($data + ['created_by' => $request->user()->id]);

        return redirect()->route('signals.index')->with('status', 'Signal created');
    }

    public function edit(Signal $signal): View
    {
        return view('admin.signals.edit', compact('signal'));
    }

    public function update(Request $request, Signal $signal): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string'],
            'content_md' => ['required', 'string'],
        ]);

        $signal->update($data);

        return redirect()->route('signals.index')->with('status', 'Signal updated');
    }

    public function destroy(Signal $signal): RedirectResponse
    {
        $signal->delete();

        return redirect()->route('signals.index')->with('status', 'Signal deleted');
    }
}
