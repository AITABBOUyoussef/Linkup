<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Connection;
use Illuminate\Http\Request;

class NetworkController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        if ($query) {
            $users = User::where('name', 'LIKE', "%{$query}%")
                ->where('id', '!=', auth()->id())
                ->get();
        } else {
            $users = User::where('id', '!=', auth()->id())
                ->inRandomOrder()
                ->take(12)
                ->get();
        }

        // جلب الطلبات المعلقة (اللي صيفطوها ليك ناس اخرين)
        $pendingRequests = Connection::with('sender')
            ->where('connected_user_id', auth()->id())
            ->where('status', 'pending')
            ->get();

        return view('network', compact('users', 'query', 'pendingRequests'));
    }
}
