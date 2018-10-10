<?php
namespace App\Http\Controllers;
use App\Events\ChatEvent;
use App\User;
use App\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserChatController extends Controller
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
    public function chat()
    {
			$todos=Todo::paginate(5);
			$todocount=Todo::count();
			$user = User::find(Auth::id());

    	return view('user.userchat',compact('todos','todocount','user'));
    }
    public function send(request $request)
    {
    	$user = User::find(Auth::id());


         $message = $user->messages()->create([
        'message' => $request->input('message')
  ]);


    	$this->saveToSession($request);

    	event(new ChatEvent($request->message,$user));
    }
    public function saveToSession(request $request)
    {

    	session()->put('chat',$request->chat);
    }
    public function getOldMessage()
    {
    	return session('chat');
    }
    public function deleteSession()
    {
    	session()->forget('chat');

    }
}
