<?php

namespace App\Http\Controllers;

use App\Events\MessagePushed;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Auth;

class MessageController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
	}

	public function index() {
		$messages = Message::orderBy('created_at','desc')
			->take(10)->get()->reverse();

		return view('welcome', compact('messages', $messages) );
	}

    public function messageSent(Request $req) {
    	$mess =  $req->message;
		$user = Auth::id() ? Auth::id() : '1';

	    $message = new Message();
	    $message->user_id = $user;
	    $message->content = $mess;
	    $message->save();

	    // broadcast(new MessagePushed($message))->toOthers();//, $user
	    event( new MessagePushed( $message, Auth::user() ) );//Auth::user()
	    return $message;
    }
}
