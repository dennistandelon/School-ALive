<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Detail;

class DetailController extends Controller
{
    public function createDetail(Request $req){
        $detail = new Detail();
        $detail->course_id = $req->course_id;
        $detail->title = $req->title;
        $detail->desc = $req->desc;

        $detail->save();

        return redirect()->back();
    }

    public function deleteDetail($id){
        $detail = Detail::find($id);

        if(isset($detail)){
            $detail->delete();
        }

        return redirect()->back();
    }

}
