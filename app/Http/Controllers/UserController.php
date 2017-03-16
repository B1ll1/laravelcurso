<?php

namespace Marketplace\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Marketplace\Http\Controllers\Controller;
use Marketplace\Http\Requests;
use Marketplace\User;

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
      if($user->hasRole('siga')){
        $users = User::all();
      }
      else if($user->hasRole('prefeitura')){
        $prefecture_id = $user->prefecture->first()->id;
        $prefecture = Prefecture::find($prefecture_id);

        $userssector = User::join('sector_users', 'users.id', '=', 'sector_users.user_id')
            ->join('sectors', 'sector_users.sector_id', '=', 'sectors.id')
            ->join('departments', 'sectors.department_id', '=', 'departments.id')
            ->where('departments.prefecture_id', '=', $prefecture_id)
            ->select([
                  'users.id as id',
                  'users.name as name',
                  'users.photo as photo'
              ]);

         $usersdep = User::join('department_users', 'users.id', '=', 'department_users.user_id')
            ->join('departments', 'department_users.department_id', '=', 'departments.id')
            ->where('departments.prefecture_id', '=', $prefecture_id)
            ->select([
                  'users.id as id',
                  'users.name as name',
                    'users.photo as photo'
              ]);

        $users = User::join('prefecture_users', 'users.id', '=', 'prefecture_users.user_id')
            ->where('prefecture_users.prefecture_id', '=', $prefecture_id)
            ->select([
                  'users.id as id',
                  'users.name as name',
                    'users.photo as photo'
              ])
            ->union($userssector)
            ->union($usersdep)
            ->get();
      }
      else if($user->hasRole('secretaria')){
        $department_id = $user->department->first()->id;

        $userssector = User::join('sector_users', 'users.id', '=', 'sector_users.user_id')
            ->join('sectors', 'sector_users.sector_id', '=', 'sectors.id')
            ->join('departments', 'sectors.department_id', '=', 'departments.id')
            ->where('departments.id', '=', $department_id)
            ->select([
                  'users.id as id',
                  'users.name as name',
                  'users.photo as photo'
              ]);

        $users = User::join('department_users', 'users.id', '=', 'department_users.user_id')
            ->where('department_users.department_id', '=', $department_id)
            ->select([
                    'users.id as id',
                    'users.name as name',
                    'users.photo as photo'
                ])
            ->union($userssector)
            ->get();

      }
      else if($user->hasRole('setor')){
        $sector_id = $user->sector->first()->id;
        $users = User::join('sector_users', 'users.id', '=', 'sector_users.user_id')
            ->join('sectors', 'sector_users.sector_id', '=', 'sectors.id')
            ->where('sectors.id', '=', $sector_id)
            ->select([
                  'users.id as id',
                  'users.name as name',
                  'users.photo as photo'
              ])
            ->get();
      }
      else if($user->hasRole('oficina')){
        $users = User::join('garages','users.id', '=', 'garages.user_id')
            ->where('garages.user_id', '=', $user->id)
            ->select([
                    'users.id as id',
                    'users.name as name',
                    'users.photo as photo'
                ])
            ->get();
      }

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
        if(isset($photo)){
              $user->photo = $user->uploadImage($photo, 'users/');
        }
        else{
          $user->photo = 'users/usuario.png';
        }
        $user->password = bcrypt($request->password);
        $user->save();

      return redirect()->route('index_usuario');
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


        $loggeduser = Auth::user();

        return redirect()->route('editar_usuario', $user->id);
    }

    public function updatePassword(Request $request, $userId)
    {
        if(!\Request::ajax()) {
            abort(403);
        }
        $user = User::findOrFail($userId);
        // $role = $user->roles->first();
        // $loggeduser = Auth::user();
        $user->password = bcrypt($request['data']);
        $user->update();

        if($user)
            return response()->json(['status' => 'success']);
        else
            return response()->json(['status' => 'fail']);
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
    }

    public function redirect()
    {
        if(Auth::check()){
            $user  = Auth::user();

        }
        else{
            return view('auth.login');
        }
    }
}
