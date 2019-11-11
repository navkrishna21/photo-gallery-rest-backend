<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Album;
use App\User;
use App\Photo;
use Auth;


class PhotoController extends Controller
{
    //class AlbumController extends Controller
    //
 	public function index()
    {

        return response()->json( Photo::all() , 200 ); 
    }

    public function show(Photo $photo)
    {

        
        return response()->json(['data'=>$photo]);

        //return response()->view(storage_path('app/testing/aVROMLGsh3MnLEQxjGuKE5Lez7STSz8KBM8e7LoA.jpeg'),'ss') ;
    }

    public function store(Album $album, Request $request)
    {

        if($album->user_id != Auth::guard('api')->id()){
            
            return response()->json(null, 403);
        }
               
        $photo = new Photo();
        
        $photo->name = $request->name;
        
        if( ($request->name == "") || ($request->file('photo') =="") ){
           
            return response()->json(null, 403);
        }
        
        $photo->user_id = $album->user_id;
        $photo->album_id = $album->id;
            
        $request->file('photo')->store('images');

        $photo->url = $request->photo->hashName();
        
        $photo->save(); 

        return response()->json( ['data'=> $photo], 201) ;
        
    }

    public function update(Request $request, Photo $photo)
    {
        
       
    	
        if($photo->user_id != Auth::guard('api')->id())
            return response()->json(null, 403);


        $photo->update($request->all());



        return response()->json($photo, 200);
    }

    public function delete(Photo $photo)
    {

        if( $photo->user_id != Auth::guard('api')->id() )
            return response()->json(null, 403);
            
        $photo->delete();
        
        return response()->json(null, 204);
    }

}
