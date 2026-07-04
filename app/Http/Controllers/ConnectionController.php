<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Connection;

use Illuminate\Database\Connection as DatabaseConnection;
use Illuminate\Database\Connectors\ConnectionFactory;

class ConnectionController extends Controller
{
 public function store(Request $request)
    {
        $request->validate([
            'connected_user_id' => 'required|exists:users,id',
        ]);

        $userId = auth()->id();
        $connectedUserId = $request->connected_user_id;

        if ($userId == $connectedUserId) {
            return back()->with('error', 'Vous ne pouvez pas vous ajouter vous-même.');
        }

         $exists = Connection::where(function($query) use ($userId, $connectedUserId) {
            $query->where('user_id', $userId)->where('connected_user_id', $connectedUserId);
        })->orWhere(function($query) use ($userId, $connectedUserId) {
            $query->where('user_id', $connectedUserId)->where('connected_user_id', $userId);
        })->exists();

        if ($exists) {
            return back()->with('error', 'Une demande ou connexion existe déjà.');
        }

        Connection::create([
            'user_id' => $userId,
            'connected_user_id' => $connectedUserId,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Demande de connexion envoyée.');
    }
     public function accept(string $id)
    {
        $connection = Connection::findOrFail($id);

        if ($connection->connected_user_id !== auth()->id()) {
            abort(403, 'Action non autorisée.');
        }

        $connection->update([
            'status' => 'accepted',
        ]);

        return back()->with('success', 'Vous êtes maintenant connectés !');
    }
     public function destroy(string $id)
    {
        $connection = Connection::findOrFail($id);

        if ($connection->user_id !== auth()->id() && $connection->connected_user_id !== auth()->id()) {
            abort(403, 'Action non autorisée.');
        }

        $connection->delete();

        return back()->with('success', 'Connexion ou demande retirée.');
    }
}
