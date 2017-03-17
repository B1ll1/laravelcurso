<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if($user->user_role_id == 1)
            $users = User::all();
        else if($user->user_role_id == 2)
            $users = User::where('platform_id',$user->platform_id)->get();
        else
            return redirect()->route('platform.index');

      return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $loggeduser = Auth::user();
        $inputs = $request->except(['photo']);
        //photo
        $photo = $request->file('photo');
        DB::beginTransaction();
        try{
            $user=User::create($inputs);

            if(isset($photo)){
                  $user->photo = $user->uploadImage($photo, 'users/');
            }
            else{
              $user->photo = null;
            }
            $user->password = bcrypt($request->password);
            $user->save();
        }catch(\Exception $e){
            DB::rollBack();
        }
        DB::commit();


      return redirect()->route('user.index');
    }

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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $loggeduser = Auth::user();
        if($user->id == $loggeduser->id)
            return view('users.edit', compact('user'));
        else
            return redirect()->route('platforms.index');
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

        $usercheck = User::where('email', $request->email)->first();

            if(isset($usercheck))
                if($usercheck->id != $user->id){
                    \Session::flash('msg_error', $usercheck->email);
                    return redirect()->route('users.edit', $user->id);
                }
                $user->fill($request->except('photo'));
                if(isset($request['photo'])) {
                    $photo = $request->file('photo');
                    $user->photo = $user->uploadImage($photo, 'users/');
                }
          $user->save();

        return redirect()->route('platform.index', $user->id);
    }

    public function updatePassword(Request $request, $userId)
    {
        if(!\Request::ajax()) {
            abort(403);
        }
        $user = User::findOrFail($userId);
        $loggeduser = Auth::user();
        if($user->id==$loggeduser->id){
            DB::beginTransaction();
            try{
                $user->password = bcrypt($request['data']);
                $user->update();
            }catch(\Exception $e){
                DB::rollBack();
                return response()->json(['status' => 'fail']);
            }
            DB::commit();
            return response()->json(['status' => 'success']);
        }
        else{
            return response()->json(['status' => 'fail']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!\Request::ajax()) {
            abort(403);
        }
        $user = User::findOrFail($id);
        $loggeduser = Auth::user();
        if($loggeduser->user_role_id!=3){
            if($loggeduser->user_role_id==1){
                DB::beginTransaction();
                try{
                    $user->delete();
                }catch(\Exception $e){
                    DB::rollBack();
                }
                DB::commit();
            }
            else if($loggeduser->user_role_id==2 && ($loggeduser->platform_id==$user->platform_id)){
                DB::beginTransaction();
                try{
                    $user->delete();
                }catch(\Exception $e){
                    DB::rollBack();
                }
                DB::commit();
            }
        }
    }

    public function ajaxRoles(){
        $roles = UserRole::all();
        return $roles;
    }

}
