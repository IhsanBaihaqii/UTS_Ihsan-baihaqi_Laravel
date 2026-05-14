<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // READ
    public function index()
    {
        $users = User::all();
        return view('dashboard', compact('users'));
    }

    // CREATE
    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt('password123')
        ]);
        return redirect()->back();
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role
        ]);

        return redirect()->back();
    }

    // DELETE
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->back();
    }
}