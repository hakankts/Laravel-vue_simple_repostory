<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class indexController extends Controller
{

    public function index(){
        return view('Order.order');
    }

    public function order_list(){
        
        $sql = Orders::orderBy('id', 'Desc')->get();
        return response()->json($sql);

    }

    public function order_save(Request $request){

        $retunArray = [];
        $retunArray['status'] = false;       
        $all = $request->except('_token');        
        $create = Orders::create($all);
        
        if($create){
            $retunArray['status'] = true;
            $retunArray['message'] = "Order Created";                 
        } else {
            $retunArray['message'] = "Order Failed";            
        }

        return response()->json($retunArray);

    }

    public function detailData($id=''){
        
        $data = Orders::from('orders as o')->leftjoin('product_images as p', 'o.id', '=', 'p.product_id')
                ->where('o.id', $id)
                ->get(['o.*', 'p.image_name']);        
        return response()->json($data[0]);  
        //$sql = Orders::where('id',$id)->get();                          
        //return response()->json($sql[0]);
    }
}
