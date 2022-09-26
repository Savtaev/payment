<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\New_;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 1111;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.registration');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = '';
        $redirect_path = 'admin/users/create';
        $user = new User();
        if ($request->usertype == 2)
        {
            $validator = Validator::make($request->toArray(), [
                'name' => 'required|min:3|max:255',
                'phone_number' => 'required|min_digits:9|max_digits:13|numeric',
                'password' => 'required|min:6|max:255'
            ]);
            if ($validator->fails()) return redirect($redirect_path)->withErrors($validator);
            $user->name = $request['name'];
            $user->phone_number = $request['phone_number'];
            $user->password = $request['password'];
            $user->assignRole('Client');
        }
        elseif ($request->usertype == 1)
        {
            $validator = Validator::make($request->toArray(), [
                'title' => 'required|min:3|max:255',
                'account_number' => 'required|digits:16|numeric',
                'bin' => 'required|digits:12|unique:users',
                'email' => 'required|email',
                'password' => 'required|min:6|max:255'
            ]);
            if ($validator->fails()) return redirect($redirect_path)->withErrors($validator);
            $user->name = $request['title'];
            $user->email = $request['email'];
            $user->account_number = $request['account_number'];
            $user->bin = $request['bin'];
            $user->password = $request['password'];
            $user->assignRole('Business');
        }
        else die('Error');
        $user->save();
        if ($user)
        {
            return redirect($redirect_path)->with('message', 'Регистрацаия прошла успешно!');
        }
        else
        {
            return redirect($redirect_path)->withErrors(['Ошибка при создании пользователя']);
        }

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
        //
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
        //
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
