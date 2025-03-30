<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of users
     */
    public function index()
    {
        $this->authorize('view_users');

        return view('lyouts.admin.users.index', [
            'users' => User::with(['roles' => function ($query) {
                            $query->select('name');
                        }])
                        ->get()
                        ->map(function ($user) {
                            return [
                                'id' => $user->id,
                                'name' => $user->name,
                                'email' => $user->email,
                                'roles' => $user->getRoleNames()
                            ];
                        })
        ]);
    }

    /**
     * Assign role to user
     */
    public function assignRole(Request $request, User $user)
    {
        $this->authorize('manage_roles');

        $validated = $request->validate([
            'role' => [
                'required',
                'string',
                Rule::exists('roles', 'name'),
                function ($attribute, $value, $fail) use ($user) {
                    if ($user->hasRole($value)) {
                        $fail("User already has the {$value} role.");
                    }
                }
            ]
        ]);

        try {
            $role = Role::where('name', $validated['role'])->firstOrFail();
            $user->syncRoles($role);

            return redirect()
                ->back()
                ->with('success', "Successfully assigned {$role->name} role to user.");

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Failed to assign role: ' . $e->getMessage());
        }
    }

    /**
     * Remove role from user
     */
    public function removeRole(Request $request, User $user)
    {
        $this->authorize('manage_roles');

        $validated = $request->validate([
            'role' => [
                'required',
                'string',
                Rule::exists('roles', 'name'),
                function ($attribute, $value, $fail) use ($user) {
                    if (!$user->hasRole($value)) {
                        $fail("User doesn't have the {$value} role.");
                    }
                }
            ]
        ]);

        try {
            $user->removeRole($validated['role']);

            return redirect()
                ->back()
                ->with('success', "Successfully removed {$validated['role']} role.");

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Failed to remove role: ' . $e->getMessage());
        }
    }
}
