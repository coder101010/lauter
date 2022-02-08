<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ImageUploadController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\FileController;
use Illuminate\Support\Str;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show chats
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('chat');
    }

    /**
     * Fetch all messages
     *
     * @return Message
     */
    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return Response
     */
    public function sendMessage(Request $request)
    {
        $user = Auth::user();

        $attachment = '';

        if ($request->input('attachment')){
            
            /*  Store data for image */
            $image_64 = $request->input('attachment');

            /* Get extension */
            $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   

            $replace = substr($image_64, 0, strpos($image_64, ',')+1); 

            $image = str_replace($replace, '', $image_64); 

            $image = str_replace(' ', '+', $image); 

            /*  Name it, nicely */
            $imageName = Str::random(10).'.'.$extension;

            /*  Store it, where apparently everyone stores it these days */
            $path = Storage::disk('s3')->put('images/'.$imageName, base64_decode($image));
            $path = Storage::disk('s3')->url('images/'.$imageName);

            /*  Store path in local db */
            $attachment = $path;

        }

        /*  Mount message with full meta */
        $message = $user->messages()->create([
            'ip' => $_SERVER['REMOTE_ADDR'],
            'agent' => $_SERVER['HTTP_USER_AGENT'],
            'message' => $request->input('message'),
            'attachment' => $attachment
        ]);

        broadcast(new MessageSent($user, $message))->toOthers();

        return ['status' => 'Message Sent!'];
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageUpload()
    {
        return view('imageUpload');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageUploadPost(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $imageName = time().'.'.$request->image->extension();  
     
        $path = Storage::disk('s3')->put('images', $request->image);
        $path = Storage::disk('s3')->url($path);
  
        /* Store $imageName name in DATABASE from HERE */
    
        return back()
            ->with('success','You have successfully upload image.')
            ->with('image', $path); 
    }


}
