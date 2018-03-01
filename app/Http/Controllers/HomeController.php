<?php

namespace App\Http\Controllers;

use App\Msg;
use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function welcome()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $username = $user->name;
            $role = $user->role;
            if ($role==1){
                $msg = Msg::orderBy('created_at', 'desc')->get();
            }else{
                $msg = Msg::where('type',2)->orderBy('created_at', 'desc')->get();
            }
            return view('welcome', compact('msg','username','role'));
        }else{
            $username = '';
            $role = 0;
            $msg = Msg::where('type',2)->orderBy('created_at', 'desc')->get();
            return view('welcome',compact('msg','username','role'));
        }


    }
    /*
     * 
     * 
     * */
    public function message(Request $request)
    {
        $this->validate($request, [
            'contents' => 'required|max:140|min:4',
            'type' => 'required|integer',
        ]);
        $msg = new Msg;
        $msg->content = $request->contents;
        $msg->type = $request->type;
        $msg->save();
    }
    /*
     * 
     * */
    public function msgSort(Request $request)
    {
        $this->validate($request, [
            'methods' => 'required',
            'type' => 'required|integer',
        ]);
        if($this->isAdmin()){
            if ($request->type=='1'){
                if ($request->methods=='like'){
                    $msg = Msg::orderBy('like', 'desc')->get();
                }
                elseif ($request->methods=='time'){
                    $msg = Msg::orderBy('created_at', 'desc')->get();
                }

            }
            elseif($request->type=='2'){
                if ($request->methods=='like'){
                    $msg = Msg::orderBy('like', 'asc')->get();
                }
                elseif ($request->methods=='time'){
                    $msg = Msg::orderBy('created_at', 'asc')->get();
                }
            }
        }
        else{
            if ($request->type=='1'){
                if ($request->methods=='like'){
                    $msg = Msg::where('type','2')->orderBy('like', 'desc')->get();
                }
                elseif ($request->methods=='time'){
                    $msg = Msg::where('type','2')->orderBy('created_at', 'desc')->get();
                }

            }
            elseif($request->type=='2'){
                if ($request->methods=='like'){
                    $msg = Msg::where('type','2')->orderBy('like', 'asc')->get();
                }
                elseif ($request->methods=='time'){
                    $msg = Msg::where('type','2')->orderBy('created_at', 'asc')->get();
                }
            }
        }
        return $msg;
    }
    /*
     * 判断是否是管理员
     * */
    public function isAdmin()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role==1){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    /*
     * 评论
     * */
    public function reply(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer',
            'type' => 'required|integer',
            'contents' => 'required|max:140|min:4',
        ]);
        $reply = new Reply;
        $reply->reply_to = $request->id;
        $reply->type = $request->type;
        $reply->content = $request->contents;
        $reply->save();
        Msg::where('id',$request->id)->increment('reply_total',1);
        return 'success';
    }
    /*
     *
     * */
    public function replies(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer|exists:replies,reply_to',
        ]);
        $id = $request->id;
        $replies = Reply::where('reply_to',$id)->orderBy('created_at','desc')->get();
        return $replies;
    }
    /*
     * 
     * */
    public function like(Request $request)
    {
        $oldCookie = session('likeId');
        $this->validate($request, [
            'id' => 'required|integer|exists:messages,id',
        ]);
        session(['likeId'=>$request->id]);
        $newCookie = session('opposeId');
        if($oldCookie!==$newCookie){
            Msg::where('id',$request->id)->increment('like',1);
            return 'success';
        }
    }
    /*
     *
     * */
    public function oppose(Request $request)
    {
        $oldCookie = session('opposeId');
        $this->validate($request, [
            'id' => 'required|integer|exists:messages,id',
        ]);
        session(['opposeId'=>$request->id]);
        $newCookie = session('opposeId');
        if($oldCookie!==$newCookie){
            Msg::where('id',$request->id)->increment('oppose',1);
            return 'success';
        }

    }
    /*
     * 防止重复点击
     * */
    public function cookie()
    {

    }
}
