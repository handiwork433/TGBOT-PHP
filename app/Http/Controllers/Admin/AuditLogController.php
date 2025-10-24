<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\Contracts\View\View;

class AuditLogController extends Controller
{
    public function index(): View
    {
        $logs = AuditLog::query()->latest()->paginate();

        return view('admin.logs.index', compact('logs'));
    }
}
