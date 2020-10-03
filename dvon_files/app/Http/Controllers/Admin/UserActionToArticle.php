<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ArticleComment as Comments;

class UserActionToArticle extends Controller
{
    public function comments_index(){
        $Comments = new Comments();
        $comments = $Comments::paginate(10);
       return view('Admin.UserActionToArticle.comments-dashboard', ['comments'=>$comments]);
    }
    
    public function update_comment_status(Request $request, $id){
        $comment_status = $request->status;

        $Comments = new Comments();
        $comment_to_update_status = $Comments::find($id);

        $update_comment = $comment_to_update_status->update(['status'=>$comment_status]);
        if($update_comment){
            return redirect()->back()->with('success','Comment status has been successfully updated to "'.$comment_status.'"!');
        }else{
            return redirect()->back()->with('error','Comment status can not be successfully updated!');
        }
    }
    
    public function delete_comment($id){
        $Comments = new Comments();
        $comment_to_delete = $Comments::find($id);

        $delete_comment = $comment_to_delete->delete();
        if($delete_comment){
            return redirect()->back()->with('success','Comment has been successfully Deleted!');
        }else{
            return redirect()->back()->with('error','Comment can not be successfully Deleted!');
        }

    }
    
}
