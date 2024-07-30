<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\RoleOnUser;
use App\Http\Controllers\Controller;

class PermissionUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        try {
            return RoleOnUser::with('role')
                ->where('user_id', $id)
                ->get();
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
