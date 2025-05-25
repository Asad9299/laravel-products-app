<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index( Request $request )
    {
        $searchTerm = $request->query('search') ?? '';
        $user = new User();
        $users = $user->list($searchTerm);
        return view('users.index', ['users' => $users]);
    }

    public function destroy(int $id)
    {
        $user = User::find($id);
        $user->remove();
        return redirect()->route('users');
    }
}
