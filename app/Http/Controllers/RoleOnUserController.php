<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\RoleOnUser;
use Illuminate\Http\Request;

class RoleOnUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return RoleOnUser::index();
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
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
                'user_id' => 'required|integer|exists:users,id',
                'role_id' => 'required|integer|exists:roles,id'
            ]);

            return RoleOnUser::firstOrCreate([
                'user_id' => $validated['user_id'],
                'role_id' => $validated['role_id'],
            ]);
        } catch (Exception $e) {
            return response()->json([
               'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            return RoleOnUser::find($id);
        } catch (Exception $e) {
            return response()->json([
               'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $roleOnUser = RoleOnUser::find($id);

            $roleOnUser->delete();
            return response()->json([
                'message' => 'Pemissão retirada!'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => $e->getMessage()
            ], 500);
        }
    }
}
