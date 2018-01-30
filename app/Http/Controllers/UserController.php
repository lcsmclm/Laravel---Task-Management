<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Lists;

class UserController extends Controller
{
    //
    public function __construct()
    {
    }
    public function getAll() {
      $id = Auth::user()->id;
      $lists = Lists::select()->with('user')->where('user_id', $id)->where('active', '1')->get();
      $completedList = Lists::select()->with('user')->where('user_id', $id)->where('active', '0')->get();
      return view('index', ['lists' => $lists, 'completed' => $completedList]);
}

public function postForm() {
    return view('newform');
}

public function newPost() {
    $id = Auth::user()->id;
    $data = request()->input();
    $validator = validator()->make($data,[
        'new-post-msg'=> ['required']
        ]);
    if($validator->passes()) {
    $post = new Lists([
    'title' => request()->input('new-post-msg'),
    'category' => request()->input('new-post-category'),
    'user_id' => $id
    ]);
$post->save();
 return redirect('/');
}
return redirect()->back()->withErrors($validator->errors())->withInput();

}

public function delete($id) {
    $usrid = Auth::user()->id;
    $lists = Lists::where('user_id', $usrid)->where('id', $id)->first();
    if(count($lists)){
      $lists->delete();
      return redirect('/');
    } else {
      return "No access";
    }
}
public function complete($id) {
  $lists = Lists::where('id', $id)->update(array('active' => '0'));
 return redirect('/');
}
}
