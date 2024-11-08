<?php

namespace App\Http\Controllers;

use App\Models\Witness;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WitnessController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function index()
    {
        try {
            return Witness::with('user')->get();
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            return Witness::create([
                'content' => $request->input('content'),
                'user_id' => $this->user->id,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
