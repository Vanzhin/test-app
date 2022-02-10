<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PHPUnit\Framework\SkippedTestSuiteError;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(5);
        return view('admin.users.index', [
            'userList' => $users,
            'fields' =>User::getIndexFields()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userToCreate = User::$columnsToGet;
        return view('admin.users.create', [
            'userFields' => $userToCreate,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $data = $request->validated();
        if(key_exists('is_admin', $data)){
            $is_admin = 1;
        } else{
            $is_admin = 0;
        }
        $created = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'is_admin' => $is_admin,
        ]);
        if($created){

            return redirect()->route('admin.users')->with('success', __('messages.admin.users.created.success'));
        }
        return back()->with('error', __('messages.admin.users.created.error'))->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'userFields' => $user::$columnsToGet,
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, User $user)
    {
        $data = $request->validated();

        if(key_exists('is_admin', $data)){
            $is_admin = 1;
        } else{
            $is_admin = 0;
        }

        $updated = $user->fill([
            'name' => $data['name'],
            'email' => $data['email'],
//            'password' => Hash::make($data['password']),
            'is_admin' => $is_admin,
        ])->save();

        if($updated){
            return redirect()->route('admin.users')->with('success', __('messages.admin.users.updated.success'));
        }
        return back()->with('error', __('messages.admin.users.updated.error'))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $deleted = $user->delete();
        if($deleted){
            return redirect()->route('admin.users')->with('success', __('messages.admin.users.deleted.success'));
        }
        return back()->with('error', __('messages.admin.users.deleted.error'))->withInput();

    }
}
