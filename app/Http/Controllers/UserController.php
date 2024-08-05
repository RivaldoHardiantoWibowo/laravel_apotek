<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $account = User::all();
        return view('account.index', compact('account'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('account.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required',
            'role' => 'required',
        ]);

        $emailPrefix = $request->email;
        $namePrefix = $request->name;
        $password = substr($emailPrefix, 0, 3) . substr($namePrefix, 0, 3);
        $hashedPassword = Hash::make($password);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => $hashedPassword,
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan data akun!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $account = User::find($id);
        return view('account.edit', compact('account'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required',
            'role' => 'required',
        ]);
        $account = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $account['password'] = bcrypt($request->password);
        }

        User::where('id', $id)->update($account);

        return redirect()->route('account.home')->with('success', 'Berhasil mengubah data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();

        return redirect()->back()->with('deleted', 'Berhasil menghapus akun!');
    }

    public function loginAuth(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ],
        [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password harus diisi',
            'password.alpha_dash' => 'Password harus berisi huruf dan karakter tanpa spasi'
        ]
        );


    $credentials = $request->only('email', 'password');

    // Debugging
    $user = User::where('email', $credentials['email'])->first();
    // dd($user, $credentials, Hash::check($credentials['password'], $user->password));

    if (Auth::attempt($credentials)) {
        return redirect()->route('home.page');
    } else {
        return redirect()->back()->with('failed', "Login Process Failed, Please Try Again With The Correct Data");
    }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('logout', 'Logout Successful');
    }
}
