<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user', 'category')->latest()->get();
        return response()->json([
           'posts' => $posts
        ]);
    }

    public function add(Request $request)
    {

        /*$str_pos = strpos($request->image, ';');
        $str =  substr($request->image, 0, $str_pos);
        $files = explode('/', $str);
        $file = end($files);
        return $file;*/

        $this->validate($request, [
           'title' => 'required|unique:posts|min:5',
           'category_id' => 'required',
           'description' => 'required|min:15',
           'image' => 'required',
           'status' => 'required'
        ]);

        $slug = Str::slug($request->title);

        $post = new Post();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->category_id = $request->category_id;
        $post->user_id = Auth::user()->id;
        $post->description = $request->description;
        $post->status = $request->status;


        $rand = rand(11111111,99999999);
        $file = explode(';', $request->image);
        $file = explode('/', $file[0]);
        $file_ex = end($file);
        $file_name = $rand.'.'.$file_ex;
        $upload_path = public_path('backend/upload/posts/');
        $image_url = $upload_path . $file_name;
        Image::make($request->image)->resize(400, 200)->save($image_url);
        $post->image = $file_name;

        $post->save();
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        if($post->image){
            if(file_exists(public_path('backend/upload/posts/'.$post->image))){
                unlink(public_path('backend/upload/posts/'.$post->image));
            }
        }
        $post->delete();
    }

    public function edit($id)
    {
        $post = Post::find($id);
        return response()->json([
            'post' => $post
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|min:5|unique:posts,title,'.$id,
            'category_id' => 'required',
            'description' => 'required|min:15',
            'status' => 'required'
        ]);

        $slug = Str::slug($request->title);

        $post = Post::find($id);
        $post->title = $request->title;
        $post->slug = $slug;
        $post->category_id = $request->category_id;
        $post->user_id = Auth::user()->id;
        $post->description = $request->description;
        $post->status = $request->status;

        if($request->image != $post->image){
            $rand = rand(11111111,99999999);
            $file = explode(';', $request->image);
            $file = explode('/', $file[0]);
            $file_ex = end($file);
            $file_name = $rand.'.'.$file_ex;
            $upload_path = public_path('backend/upload/posts/');
            $image_url = $upload_path . $file_name;

            if(file_exists(public_path('backend/upload/posts/'.$post->image))){
                unlink(public_path('backend/upload/posts/'.$post->image));
            }

            Image::make($request->image)->resize(400, 200)->save($image_url);
            $post->image = $file_name;
        }


        $post->save();
    }

    public function get_all_post()
    {
        $posts = Post::with('user', 'category')->where('status', 1)->latest()->get();
        return response()->json($posts);
    }

    public function single_post($slug)
    {
        $post = Post::with('user', 'category')->where('slug', $slug)->first();
        return response()->json($post);
    }
}
