<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id) {
        return view('profile.show', [
            'user' => \App\Models\User::find($id),
        ]);
    }

    public function edit($id) {
        return view('profile.edit', [
            'user' => \App\Models\User::find($id),
        ]);
    }

    public function dashboard($id) {
        return view('dashboard', [
            'user' => \App\Models\User::find($id),
        ]);
    }

    public function update(Request $request, $id) {
        $user = \App\Models\User::where('id','=', $id);
        $changableColumns = ['email', 'address', 'place', 'phonenumber'];
        
        try {
            foreach ($changableColumns as $col) {
                if ($request->input($col) != NULL) {
                    $user->update([$col => $request->input($col)]);
                }
            }
            return redirect()->route('profile', ['id' => $id]);
        }
            catch(Exception $e) {
                return redirect()->route('editprofile', ['id' => $id]);
            }
    }
}
