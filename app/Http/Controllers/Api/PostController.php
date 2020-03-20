<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Response;
use Validator;
use App\File;
use App\User;
use App\Post;
use App\Token;
use App\Location;
use Illuminate\Http\Request;
use App\Http\Resources\Post as PostResource;
use App\Http\Resources\PostSingle as PostSingleResource;

class PostController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth::user();

        if (isset($user)) {

            return ['status' => TRUE , 'message' => 'Posts found!', 'data' => PostResource::collection($user->posts()->latest()->get())];
        }
        else {
            return response([
                'status'=> FALSE,
                'message'=> 'Unauthenticated.',
            ], 401);            
        }
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if (isset($user)) {

            $post = $user->posts()->create($request->all());

            $location = Location::find($request->location_id);

            $user_ids = $location->profiles()->pluck('user_id')->toArray();

            $tokenList = User::whereIn('id', $user_ids)->pluck('fcm_token')->toArray();

            $message = 'New ' . $post->type .' for ' .  ucfirst($location->name) . ' location' ;

            $this->notification($tokenList, $message);

            if($request->hasFile('media'))
            {
                $allowedfileExtension=['jpg', 'JPG', 'png', 'PNG'];  

                $files = $request->file('media');

                foreach($files as $file){

                    $filename = $file->getClientOriginalName();

                    $newname = str_replace(' ', '', $filename);
                                      
                    $extension = $file->getClientOriginalExtension();
                     
                    $check=in_array($extension,$allowedfileExtension);
                 
                    if($check)                 
                    {
                        $finalname = time().$newname;

                        $file->move('uploads/media', $finalname); 
                         
                        File::create([
                            'file_path' => 'uploads/media/'. $finalname, 
                            'post_id' => $post->id,
                        ]);
                    }
                }              
            }

            return ['status' => TRUE , 'message' => 'Post created successfully!', 'data' => new PostResource($post)];  
        }
        else {
            return response([
                'status'=> FALSE,
                'message'=> 'Unauthenticated.',
            ], 401);            
        }
    }

    public function show(Request $request)
    {
        $user = Auth::user();

        if (isset($user)) {

            $post = Post::find($request->post_id);

            if (isset($post)) {
                return ['status' => TRUE , 'message' => 'Post found!', 'data' => new PostSingleResource($post)];
            }
            else {
                return ['status' => FALSE , 'message' => 'Post Not Found!'];
            }
        }
        else {
            return response([
                'status'=> FALSE,
                'message'=> 'Unauthenticated.',
            ], 401);            
        }
    }

    public function notification($tokenList, $message)
    {
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        // $token=$token;

        $notification = [
           'title' => $message,
            // 'body' => new MessageResource($message),
            'body' => 'Tap to view',
            'sound' => true,
        ];
        
//        $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

        $fcmNotification = [
           'registration_ids' => $tokenList, //multple token array
            // 'to'        => $token, //single token
            'notification' => $notification,
//            'data' => $extraNotificationData
        ];

        $headers = [
            'Authorization: key=AAAAWTjeEkc:APA91bHQ5qmOYwttp7vUW92DSP0vdvMAJPBHq51idR3asOvXFOzY3sasUffZjK47sQyR1Ln47jcopQPpX-WyV9HHX2hraVu38hb1C3IDMvbkaa2-Na4pnTLDLaISk3rKihI9liz9PqRR',
            'Content-Type: application/json'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);

        return true;
    }  
}