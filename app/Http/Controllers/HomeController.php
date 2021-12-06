<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
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
        $this->middleware('auth');
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
    public function userControlUpdate(Request $r)
    {
        $users = User::all();
        // foreach($users as $user){
        //     $user->roles()->detach();
        //     $user->assignRole($r['role'.$user->id]);
        // }
    }
    public function editUser(User $user)
    {
        // return $user;
        return view('view-user',compact('user'));
    }
    public function updateUser(Request $r,$id)
    {

        $user = User::find($id);
        $user->name = $r->name;
        $user->email = $r->email;
        $user->roles()->detach();
        $user->assignRole($r->roles);
        $user->save();
        return redirect(route('assign.role'));
        // return $id;
    }
}
