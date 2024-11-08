<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExerciseRequest;
use App\Models\Exercise;
use Exception;
use Illuminate\Support\Facades\Auth;

class ExerciseController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function index()
    {
        try {
            return Exercise::where('user_id', $this->user->id)->get();
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(ExerciseRequest $request)
    {
        try {
            return Exercise::create([
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

    public function show(Exercise $exercise)
    {
        try {
            return $exercise;
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(ExerciseRequest $request, Exercise $exercise)
    {
        try {
            $exercise->update([
                'name' => $request->input('name'),
                'option' => $request->input('option'),
                'user_id' => $this->user->id,
            ]);

            return $exercise;
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(Exercise $exercise)
    {
        try {
            $exercise->delete();

            return response()->json([
               'message' => 'Exercicio deletado!.',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
