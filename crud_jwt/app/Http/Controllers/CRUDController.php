<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
class CRUDController extends Controller
{
    //Add data
    function saveBlog(Request $req){
        $data = new Blog;
        $data->id=$req->id;
        $data->name=$req->name;
        $data->blog_name=$req->blog_name;
        $data->blog=$req->blog;
        $result = $data->save();
        if($result){
            return ["result"=>"Data has been saved"];
        }else{
            return ["result"=>"Operation Failed"];
        }
    }
    //Show Data
     function viewBlog(){
        return Blog::all();
    }

    //Get Data
    function getBlog($id=null){
        return $id?Blog::find($id):Blog::all();
    }

    //Update Data
    function updateBlog(Request $req){
        $device = Blog::find($req->id);
        $device->name=$req->name;
        $device->blog_name=$req->blog_name;
        $device->blog=$req->blog;
        $result=$device->save();
        if($result){
            return ['result'=>'Data Updated Successfully'];
        }else{
            return ['result'=>'Operation Failed'];
        }
    }
    //Delete Blogs
    function deleteBlog($id){
        $data=Blog::find($id);
        $result=$data->delete();
        if($result){
            return ["result"=>"Data has been Deleted"];
        }else{
            return ["result"=>"Operation Failed"];
        }
    }

}
