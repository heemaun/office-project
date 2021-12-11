<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::all();
        return view('home',compact('posts'));
    }
    public function userControl()
    {
        $users = User::all();
        return view('assign-role',compact('users'));
    }
    public function editUser(User $user)
    {
        // return $user;
        return view('view-user',compact('user'));
    }
    public function updateUser(Request $r,$id)
    {
        $count = 0;
        foreach(User::all() as $user){
            if($user->hasRole('admin')){
                $count++;
            }
        }
        $user = User::find($id);
        if($count == 1 && $user->hasRole('admin') && strcmp($r->roles,'admin') != 0){
            return back()->with('message','There must be atleast 1 admin in the system');
        }
        $user->name = $r->name;
        $user->roles()->detach();
        $user->assignRole($r->roles);
        $user->save();
        return redirect(route('assign.role'))->with("user_updated",$user->name."'s data has been updated successfully");
    }
}
