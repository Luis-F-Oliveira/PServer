<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonalRequest;
use App\Models\Personal;
use Illuminate\Support\Facades\Auth;

class PersonalController extends Controller
{
    public function index()
    {
        try {
            $user = Auth::user();

            return Personal::where('user_id', $user->id)->first();
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(PersonalRequest $request)
    {
        try {
            return Personal::create($request->all());
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(PersonalRequest $request, string $id)
    {
        try {
            $personal = Personal::where('user_id', $request->user_id)->first();

            $personal->update($request->all());

            return response()->json([
                'message' => 'Dados Atualizados!'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
