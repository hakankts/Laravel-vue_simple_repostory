<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\productImage;

class ImageController extends Controller
{
    public function formSubmit(Request $request)

    {

        $fileName = time().'.'.$request->file->getClientOriginalExtension();

        $request->file->move(public_path('upload'), $fileName);

        $create = productImage::insert(
            ['product_id' => $request->product_id, 'image_name' => $fileName, 'image_status'=>'1']
        );

        return response()->json(['success'=>'You have successfully upload file.'.$request->product_id]);

    }
   /* public function formSubmit(Request $request)
    {    
        
        $imageName = time().'.'.$request->file->getClientOriginalExtension();        
        $request->file->move(public_path('images'), $imageName);                     
        
        $create = productImage::insert(
            ['product_id' => $request->product_id, 'image_name' => $imageName, 'image_status'=>'1']
        );
        return response()->json(['message'=>'You have successfully upload file.']);           
    }*/
    
}
