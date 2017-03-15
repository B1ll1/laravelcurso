<?php

namespace Marketplace\Http\Controllers;

use Marketplace\User;
use Illuminate\Http\Request;
use Marketplace\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Marketplace\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        if($request['password'])
            $user->password = bcrypt($request['password']);

        $inputs = $request->except('password', 'password_confirmation');
        $user->fill($inputs);

        if($request->file('photo_url')) {
            $file = $request->file('photo_url');
            $user->photo_url = $user->uploadImage($file, 'users/');
        }

        $user->save();

        return redirect()->route('user.edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
