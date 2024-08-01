<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Models\user;

use App\Models\Product;

use App\Models\Cart;

use App\Models\Order;

use App\Models\OrderItem;






class MainController extends Controller
{
    public function index()
    {   
        $allProducts = Product::all();
        $newArrival=product::where('type','new-arrivals')->get();
        $hotSale=product::where('type','sale')->get();

        return view('index',compact('allProducts','newArrival','hotSale'));
    }
    public function cart()
    {
        $cartItems = DB::table('products')
        ->join('carts','carts.productid','products.id')
        ->select('products.title','products.quantity as pQuantity','products.price','products.picture', 'carts.*')
        ->where('carts.customerId', session()->get('id'))
        ->get();

        return view('cart', compact('cartItems'));
    }
    public function shop()
    {
        return view('shop');
    }
    public function singleProduct($id)
    {
        $product = Product::find($id);
        return view('singleProduct',compact('product'));
    }
    public function deleteCartiIem($id)
    {
        $item=Cart::find($id);
        $item->delete();
        return redirect()->back()->with('success','1 Item has deleted from Cart');
    }
    public function register()
    {
        return view('register');
    }
    public function login()
    {
        return view('login');
    }
    public function logout()
    {
        session()->forget('id');
        session()->forget('type');
        return redirect('/login');
    }
    public function loginUser(Request $data)
    {
        // dd($data->input('email')); // Debugging statement

        $user = User::where('email', $data->input('email'))->first();
        if($user)
            {
                session()->put('id',$user->id);
                session()->put('type',$user->type);
                if($user->type=='customer')
                {
                    return redirect('/');
                }
                else if($user->type=='Admin')
                {
                    return redirect('/admin');
                }
    
            }else
            {
            return redirect('login')->with('error', 'Email/password is incorrect.');
            }
    }
    public function registeruser(Request $data)
    {   
        $newUser=new user();
        $newUser->fullname=$data->input("fullname");
        dump($data->input("fullname"));
        $newUser->email=$data->input("email");
        $newUser->password=$data->input("password");
        $newUser->picture=$data->file("file")->getClientOriginalName();
        $data->file('file')->move('uploads/profiles/'.$newUser->picture);
        $newUser->type="customer";
        if($newUser->save())
        {
            return redirect('login')->with('success','Congrulation! Your Account is Ready.');
        }
        return view('register');
    }
    public function addToCart(Request $data)
    {   
        if ($data->session()->has('id')) { 
            $item = new Cart();
            $item->quantity = $data->input('quantity');
            $item->productId = $data->input('id');
            $item->customerId = $data->session()->get('id');
            $item->save();
    
            return redirect()->back()->with('success', 'Congratulations! Item added to cart.');
        } else {
            return redirect('login')->with('error', 'Info! Please log in to the system.');
        }
    }
    public function updateCart(Request $request)
    {
        if ($request->session()->has('id')) 
        { 
            $item = Cart::find($request->input('id'));
            $item->quantity = $request->input('quantity');
            $item->save();
            return redirect()->back()->with('success', 'Success! Items Quantity Updated.');
        } 
        else 
        {
            return redirect('login')->with('error', 'Info! Please Login to system.');
        }
    }
    public function checkout(Request $data)
    {
        if(session()->has('id')) 
        { 
            $order = new Order();
            $order->status="pending";
            $order->customerId=session()->get('id');
            $order->bill=$data->input('bill');
            $order->address=$data->input('address');
            $order->fullname=$data->input('fullname');
            $order->phone=$data->input('phone');
            if($order->save())
            {
                $carts=Cart::where('customerId',session()->get('id'))->get();
                foreach($carts as $item)
                {
                    $product=Product::find($item->productId);
                    $orderItem=new OrderItem();
                    $orderItem->productId=$item->productId;
                    $orderItem->quantity=$item->quantity;
                    $orderItem->price=$product->price;
                    $orderItem->orderId=$order->id;
                    $orderItem->save();
                    $item->delete();
                }
            }

            return redirect()->back()->with('success', 'Success! Your order has been placed successfully.');
        } 
        else 
        {
            return redirect('login')->with('error', 'Info! Please Login to system.');
        }
    }

    public function profile()
    {
        if(session()->has('id'))
        {   
            $user=user::find(session()->get('id'));
            return view('profile', compact('user'));
        }
        return rediect('login');
    }
    public function updateUser(Request $data)
    {   
        $user=user::find(session()->get('id'));
        $user->fullname=$data->input("fullname");
        $user->password=$data->input("password");
        if($data->file('file')!=null)
        {
            $user->picture=$data->file("file")->getClientOriginalName();
            $data->file('file')->move('uploads/profiles/'.$user->picture);
        }
        if($user->save())
        {
            return redirect()->back()->with('success','Congrulation! Your Account is Updated.');
        }
        return view('register');
    }
}
