<?php
// app/Http/Controllers/UserController.php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Import the trait
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    use AuthorizesRequests; // Add the trait to enable authorize()

    public function index()
    {
        $this->authorize('view_users'); // Check if the user has 'view_users' permission
        $users = User::with('roles')->get();
        return view('admin.users.index', compact('users'));
    }

    public function assignRole(Request $request, User $user)
    {
        $this->authorize('manage_roles'); // Check if the user has 'manage_roles' permission

        // Validate the role input
        $request->validate([
            'role' => 'required|exists:roles,name', // Ensure the role exists in the roles table
        ]);

        $user->assignRole($request->role); // Assign the validated role
        return redirect()->back()->with('success', 'Role assigned successfully.');
    }
}
