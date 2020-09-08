<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Resources\Photo as PicResource;

use App\Photo;

class PhotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get all the images
        // $articles = Photo::get();
        $photo = DB::table('pictures')->get();

        //Return collection of articles as a resource
        // return PicResource::collection($photo);
        // dd($photo);

        // $users = DB::table('users')->get();

        return $photo;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
   
        $title = $request -> input("title");
        $body = $request -> input("body");
        $picture_url = $request -> input("picture_url");
        $picture_id = $request -> input("picture_id");

        DB::table('pictures')->insert(
            ['created_at' => '2020-09-07 00:00:00','updated_at' => '2020-09-07 00:00:00', 'image_description' => $body,'download_url' => $picture_url, 'image_class'=> $picture_id,'preview_url'=>$title
            ]
        );

        // return redirect('/');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Get article
        $article = DB::table('pictures')->findOrFail($id);

        //Return single article as a resource
        return new ArticleResource($article);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // update post
    public function update($id, Request $request)
    {
        $post = Post::find($id);
        $post->update($request->all());
 
        return response()->json('The post successfully updated');
    }
 
    // delete post
    public function delete($id)
    {
        $post = Post::find($id);
        $post->delete();
 
        return response()->json('The post successfully deleted');
    }
    

    public function test()
    {
        // return response()->json('Wagwan');
        dd('test');
        // print_r("Hahaha"); 
    }

    public function search(Request $request)
    {
     
        // $articles = Article::get();
        // //Return collection of articles as a resource
        // return ArticleResource::collection($articles);

        dd("Sample post result");
    }
    
}
