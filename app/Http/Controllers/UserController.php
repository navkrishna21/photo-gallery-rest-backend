<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\Album\AlbumCollection;
use Auth;

class UserController extends Controller
{
    //
    public function index()
    {
        return response()->json( UserCollection::collection( User::all() ) , 200 );
    }

    public function show($id)
    {

        $user = User::with('albums')->find($id);
        
        if($user==null)
            return response()->json(null, 404);

        $response['user_data'] = new UserResource($user);
        $response['user_albums'] =  AlbumCollection::collection($user->albums); 


        //$response = new UserResource($user);
        return response()->json( ['data' => $response ], 200);      
        
    }

    public function update(Request $request, User $user)
    {
        

        if(Auth::guard('api')->id() == $user->id ){

            $user->first_name = $request->first_name;
            
            if($request->email != $user->email){
                
                if( ! User::where('email', '=', $request->email )->exists())
                    $user->email = $request->email;    
            }
            $user->last_name = $request->last_name;
            //$user->password = $request->password;
            $user->save();

            return response()->json( new UserResource($user) , 200); 
        }

        return response()->json(null, 403);
    }

    public function destroy(User $user)
    {
        if(Auth::guard('api')->id() == $user->id ){
        	$user->delete();
            return response()->json(null, 204);
        }

        return response()->json(null, 403);
    }  

}
