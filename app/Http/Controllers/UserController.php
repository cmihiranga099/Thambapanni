<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;

/**
 * UserController
 * 
 * This controller handles admin user management operations.
 * It provides admin interface for viewing and managing user accounts.
 * 
 * Features:
 * - Display all users
 * - Update user information
 * - User role management
 */
class UserController extends Controller
{
    /**
     * Display a listing of all users
     * 
     * Shows all users in the system with pagination and filtering.
     * 
     * @param Request $request The HTTP request containing filter parameters
     * @return View The users listing view
     */
    public function index(Request $request): View
    {
        // Start building the query
        $query = User::with('roles');
        
        // Apply search filter if provided
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        // Apply role filter if provided
        if ($request->filled('role')) {
            $query->whereHas('roles', function ($q) use ($request) {
                $q->where('name', $request->get('role'));
            });
        }
        
        // Get paginated results
        $users = $query->latest()->paginate(20);
        
        // Get available roles for filtering
        $roles = \Spatie\Permission\Models\Role::all();
        
        // Pass data to the view
        return view('admin.users.index', compact('users', 'roles'));
    }

    /**
     * Update the specified user
     * 
     * Allows admins to update user information and roles.
     * 
     * @param Request $request The HTTP request containing update data
     * @param User $user The user to update
     * @return RedirectResponse Redirect back with success message
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => ['sometimes', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => 'sometimes|exists:roles,name',
        ]);
        
        // Update the user
        if (isset($validated['name'])) {
            $user->update(['name' => $validated['name']]);
        }
        
        if (isset($validated['email'])) {
            $user->update(['email' => $validated['email']]);
        }
        
        // Update role if provided
        if (isset($validated['role'])) {
            $user->syncRoles([$validated['role']]);
        }
        
        // Redirect back with success message
        return redirect()->back()->with('success', 'User updated successfully.');
    }
}

