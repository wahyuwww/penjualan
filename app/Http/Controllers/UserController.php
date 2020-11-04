<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('admin'); //membatasi level
    }
    public function index(Request $request)
    {
        $user = User::paginate(2);
        $filterKeyword =  $request->get('keyword');
        if ($filterKeyword) {
            //pencarian
            $user = User::where('name', 'LIKE', "%$filterKeyword%")->paginate(2);
        }
        return view('user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validasi = Validator::make($data, [
            'name' => 'required|max:250',
            'email' => 'required|max:250|unique:users',
            'username' => 'required|max:100|unique:users',
            'password' => 'required|min:6',
            'level' => 'required'
        ]);

        if ($validasi->fails()) {
            return redirect()->route('user.create')->withInput()->withErrors($validasi);
        }

        $data['password'] = bcrypt($data['password']);
        User::create($data);
        return redirect()->route('user.index')->with('status', 'User Berhasil Ditambahankan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user =  User::findOrFail($id);
        return view('user.edit', compact(('user')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->all();

        $validasi = Validator::make($data, [
            'name' => 'required|max:250',
            'username' => 'required|max:100|unique:users,username,' . $id,
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'sometimes|nullable|min:6'

        ]);

        if ($validasi->fails()) {
            return redirect()->route('user.edit', [$id])->withErrors($validasi);
        }
        if ($request->input('password')) {

            //jika pasword diisi
            $data['password'] = bcrypt($data['password']);
        } else {
            //juka passowrd tydak diisi
            $data = Arr::except($data, ['password']);
        }
        $user->update($data);
        return redirect()->route('user.index')->with('status', 'User Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')->with('status', 'user berhasil di hapus');
    }
}
