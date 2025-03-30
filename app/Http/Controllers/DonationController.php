<?php
// app/Http/Controllers/DonationController.php
namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Import the trait
use Illuminate\Http\Request;

class DonationController extends Controller
{
    use AuthorizesRequests; // Add the trait to enable authorize()

    public function index()
    {
        $this->authorize('view_donations'); // Check if the user has 'view_donations' permission
        $donations = Donation::with('user')->get();
        return view('admin.donations.index', compact('donations'));
    }

    public function export()
    {
        $this->authorize('export_donations'); // Check if the user has 'export_donations' permission
        // Logic to export as CSV/PDF (use a package like Maatwebsite/Excel)
        return response()->download('donations.csv'); // Placeholder for export logic
    }
}
