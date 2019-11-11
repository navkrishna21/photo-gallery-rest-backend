<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Album;
use App\User;
use Auth;
use App\Http\Resources\Album\AlbumCollection;
use App\Http\Resources\Album\AlbumResource;

use App\Http\Resources\Photo\PhotoCollection;
use App\Http\Resources\Photo\PhotoResource;

class AlbumController extends Controller
{
    //
    public function index()
    {


        return response()->json(AlbumCollection::collection(Album::all()), 200); 



    }

    public function show($id)
    {


        $album = Album::with('photos')->find($id);
        
        $response['album_data'] = new AlbumResource($album);
        $response['album_photos'] =  PhotoCollection::collection($album->photos); 


        //$response = new UserResource($user);
        return response()->json( $response , 200);   
        //return response()->view(storage_path('app/testing/aVROMLGsh3MnLEQxjGuKE5Lez7STSz8KBM8e7LoA.jpeg'),'ss') ;
    }

    public function store(Request $request)
    {
        
        if(Auth::guard('api')->check() == False){
            
            return response()->json(null, 403);
        }
               
        $album = new Album();
        $album->name = $request->name;
        
        if($request->name == ""){
            return response()->json(null, 403);
        }
        
        $album->user_id = Auth::guard('api')->id();
        
        if( $request->file('photo') ){
            
            $request->file('photo')->store('images');
            $album->cover_photo = $request->photo->hashName();
        }
        else
            $album->cover_photo = null ;
        
        $album->save(); 

        return response()->json( new AlbumResource($album), 201) ;
        
    }

    public function update(Request $request, Album $album)
    {
        
        if($album->user_id != Auth::guard('api')->id())
            return response()->json(null, 403);

        $album->update($request->all());
        return response()->json($album, 200);
    }

    public function delete(Album $album)
    {

        if($album->user_id != Auth::guard('api')->id())
            return response()->json(null, 403);
            
        $album->delete();
        return response()->json(null, 204);
    }
}
