<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index(): View
    {
        $plans = Plan::query()->orderBy('price_usdt')->paginate();

        return view('admin.plans.index', compact('plans'));
    }

    public function create(): View
    {
        return view('admin.plans.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'period_days' => ['required', 'integer'],
            'price_usdt' => ['required', 'numeric'],
            'is_active' => ['boolean'],
            'features' => ['array'],
        ]);

        Plan::create($data);

        return redirect()->route('plans.index')->with('status', 'Plan created');
    }

    public function edit(Plan $plan): View
    {
        return view('admin.plans.edit', compact('plan'));
    }

    public function update(Request $request, Plan $plan): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'period_days' => ['required', 'integer'],
            'price_usdt' => ['required', 'numeric'],
            'is_active' => ['boolean'],
            'features' => ['array'],
        ]);

        $plan->update($data);

        return redirect()->route('plans.index')->with('status', 'Plan updated');
    }

    public function destroy(Plan $plan): RedirectResponse
    {
        $plan->delete();

        return redirect()->route('plans.index')->with('status', 'Plan deleted');
    }
}
