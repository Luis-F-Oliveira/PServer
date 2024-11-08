<?php

namespace App\Http\Controllers;

use App\Http\Requests\DietRequest;
use App\Models\Diet;
use Exception;
use Illuminate\Support\Facades\Auth;

class DietController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function index()
    {
        try {
            return Diet::where('user_id', $this->user->id)->get();
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(DietRequest $request)
    {
        try {
            return Diet::create([
                'name' => $request->input('name'),
                'option' => $request->input('option'),
                'user_id' => $this->user->id,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(Diet $diet)
    {
        try {
            return $diet;
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(DietRequest $request, Diet $diet)
    {
        try {
            $diet->update([
                'name' => $request->input('name'),
                'option' => $request->input('option'),
                'user_id' => $this->user->id,
            ]);

            return $diet;
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(Diet $diet)
    {
        try {
            $diet->delete();

            return response()->json([
                'message' => 'Refeição deltada!'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
