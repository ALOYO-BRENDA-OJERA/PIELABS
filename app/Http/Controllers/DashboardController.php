<?php
// app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Import the trait
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use AuthorizesRequests; // Add the trait to enable authorize()

    public function index()
    {
        $this->authorize('view_dashboard'); // Check if the user has 'view_dashboard' permission
        $donations = \App\Models\Donation::latest()->take(5)->get();
        $activities = \App\Models\AuditLog::latest()->take(5)->get();
        return view('admin.dashboard', compact('donations', 'activities'));
    }
}
