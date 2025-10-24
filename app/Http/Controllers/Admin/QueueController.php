<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Queue\Queue;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class QueueController extends Controller
{
    public function __construct(protected Queue $queue)
    {
    }

    public function index(): View
    {
        $jobs = [];

        return view('admin.queue.index', compact('jobs'));
    }

    public function retry(string $jobId): RedirectResponse
    {
        // Placeholder for retry logic
        return back()->with('status', 'Retry scheduled for job '.$jobId);
    }
}
