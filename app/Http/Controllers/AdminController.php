<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Models\Product;

use App\Models\user;

use App\Models\Order;



class AdminController extends Controller
{
    public function index()
    {   if(session()->get('type')=='Admin')
        {
            return view('Dashboard.index');
        }
        return redirect()->back();
    }

    public function products()
    {  
         if(session()->get('type')=='Admin')
        {
           $products=Product::all();
           return view('Dashboard.products',compact('products'));
        }
        return redirect()->back();
    }
    public function AddNewProduct(Request $data)
    {   
        if(session()->get('type')=='Admin')
        {
        $product= new Product();
        $product->title=$data->input('title');
        $product->price=$data->input('price');
        $product->type=$data->input('type');
        $product->quantity=$data->input('quantity');
        $product->category=$data->input('category');
        $product->description=$data->input('description');
        $product->picture=$data->file('file')->getClientOriginalName();
        $data->file('file')->move('uploads/products/',$product->picture);
        $product->save();
        return redirect()->back()->with('success','Congrulation! New Product Listed Succesfully.');
        }

        return redirect()->back();
    }
    public function UpdateProduct(Request $data)
    {   
        if(session()->get('type')=='Admin')
        {
        $product=Product::find($data->input('id'));
        $product->title=$data->input('title');
        $product->price=$data->input('price');
        $product->type=$data->input('type');
        $product->quantity=$data->input('quantity');
        $product->category=$data->input('category');
        $product->description=$data->input('description');
        if($data->file('file')!=null)
        {
           $product->picture=$data->file('file')->getClientOriginalName();
           $data->file('file')->move('uploads/products/',$product->picture);
        }
           $product->save();
           return redirect()->back()->with('success','Congrulation! Product Listed Updated Succesfully.');
        }
        return redirect()->back();
    
    }
    public function deleteProduct($id)
    {   
        if(session()->get('type')=='Admin')
        {
        $product=Product::find($id);
        $product->delete();
        return redirect()->back()->with('success','Congrulation! Product Listed Deletes Succesfully.');
        }
        return redirect()->back();
    }

    public function Profile()
    {   if(session()->get('type')=='Admin')
        {   $user=user::find(session()->get('id'));
            return view('Dashboard.profile',compact('user'));
        }
        return redirect()->back();
    }
    public function customers()
    {  
         if(session()->get('type')=='Admin')
        {
           $customers=user::where('type','customer')->get();
           return view('Dashboard.customers',compact('customers'));
        }
        return redirect()->back();
    }
    public function orders()
    {  
        if (session()->get('type') == 'Admin') {
            $orders=DB::table('users')
            ->join('orders', 'orders.customerId','users.id')
            ->select('orders.*', 'users.fullname', 'users.email')
            ->get();
            
            
            return view('Dashboard.orders', compact('orders'));
        }
        
        return redirect()->back();
    }
    public function changreOrderStatus($status,$id)
    {  
        if (session()->get('type') == 'Admin') 
        {
            $order=Order::find($id);
            $order->status=$status;
            $order->save();
            return redirect()->back()->with('success','Congrulation! Order Status Updated Succesfull.');
        }
        
        return redirect()->back();
    }

}