<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::with('roles')->paginate(10);
        $roles = Role::all();

        return view('users.index', compact('data', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            $user->assignRole($request->roles);
            return redirect()->back()->with('success', 'User created successfully.');

        } catch (\Exception $e) {
            return dd($e->getMessage());
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $data = User::paginate(10);
        $roles = Role::all();

        return view('users.index', compact('user', 'data', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        $user->syncRoles($request->roles);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back();
    }

    public function export($type)
    {
        
        if ($type === 'pdf') {
            $data = User::all()->toArray();
            $pdf = Pdf::loadView('users.export', compact('data'));
            return $pdf->download('users.pdf');
        } elseif ($type === 'excel') {
            return Excel::download(new UsersExport, 'users.xlsx');
        }

        return redirect()->back();
    }
}
