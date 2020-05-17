<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Admin;
use App\Password_reset;

class UserController extends Controller
{
    public function create()
    {
        return view('User.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'permission'=>'required'
        ]);

        Admin::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'permission'=>$request->permission
        ]);

        return redirect('\user')->with('success','تم تسجيل مستخدم جديد'); 
    }

    public function index()
    {
        $users=Admin::paginate(20);

        return view('User.index')->with('users',$users);
    }

    public function search($username)
    {
        $users=Admin::where([['username','like','%'.$username.'%']])->get();

        $perm=' ';

        if($users->count()>0)
        {
            foreach($users as $user)
            {
                if($user->permission==0)
                {
                    $perm='<td>عادي</td>';
                }
                else
                {
                    $perm='<td>متحكم</td>';
                }
                echo "<tr>
                        <td><a href='\user/".$user->id."/edit'>".$user->id."</a></td>
                        <td>".$user->name."</td>
                        <td>".$user->username."</td>
                        ".$perm."
                        <td>".$user->updated_at->toFormattedDateString()."</td>
                    </tr>";
            }
        }
        else{
            return "<tr><td colspan='5' style='text-align: center;'>لا توجد معلومات</td></tr>";
        }
    }

    public function edit($id)
    {
        $user=Admin::findOrFail($id);

        return view('User.edit')->with('user',$user);
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'permission'=>'required'
        ]);

        $user=Admin::findOrFail($id);

        $user->name=$request->name;
        $user->username=$request->username;
        $user->password=Hash::make($request->password);
        $user->permission=$request->permission;
        $user->save();

        return redirect('\user')->with('success','تم تحديث بيانات المستخدم'); 

    }
}
