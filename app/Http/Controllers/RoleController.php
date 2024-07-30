<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return Role::all();
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|unique:roles|max:55|string',
                'key' => 'nullable|unique:roles|string',
            ]);

            return Role::create($validated);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        try {
            return $role;
        } catch (Exception $e) {
            return response()->json([
               'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|max:55|string',
                'key' => 'nullable|string',
            ]);

            $role->update($validated);
            return $role;
        } catch (Exception $e) {
            return response()->json([
               'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        try {
            $role->delete();
            return response()->json([
               'message' => 'Cargo deletado com sucesso.',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => $e->getMessage(),
            ], 500);
        }
    }
}
