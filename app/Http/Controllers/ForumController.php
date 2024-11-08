<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForumRequest;
use App\Models\Forum;
use Exception;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function index()
    {
        try {
            return Forum::with('user')->get();
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(ForumRequest $request)
    {
        try {
            return Forum::create([
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
