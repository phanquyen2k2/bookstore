<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Order;
use App\Models\Author;
use App\Models\OrderDetail;
use App\Models\Category;
use App\Models\Book;
use Session;
use App\Cart;
use Auth; 

class CartController extends Controller
{
    public function AddCart(Request $req, $id){
        $product = DB::table("books")->where('id', $id)->first();
        if($product != null){
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $newCart = new Cart($oldCart);
            $newCart->AddCart($product, $id);
            $req->session()->put('cart', $newCart);
        }
        return view("Home.cart-item");
    }
    public function AddCartDetail(Request $req, $id)
    {
        $product = DB::table("books")->where('id', $id)->first();
        if ($product != null) {
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $newCart = new Cart($oldCart);
            $newCart->AddCart($product, $id);
            $req->session()->put('cart', $newCart);
            
            // Add success message to the session
            $req->session()->flash('success', 'Added product to cart successfully');
        }
        // Redirect to the index route
        return redirect()->route('index')->with('success', 'Added product to cart successfully');
    }
    public function DeleteItemCart(Request $req, $id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $newCart = new Cart($oldCart);
        $newCart->DeleteItemCart($id);
        if(count($newCart->products)>0){
            $req->session()->put('cart', $newCart);
        }
        else{
            $req->session()->forget('cart');
        }
        return view("Home.cart-item");
    }
    public function ViewList(){

        return view("Cart.view-cart");
    }
    public function DeleteListItemCart(Request $req, $id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $newCart = new Cart($oldCart);
        $newCart->DeleteItemCart($id);
        if(count($newCart->products)>0){
            $req->session()->put('cart', $newCart);
        }
        else{
            $req->session()->forget('cart');
        }
        return view("Cart.list-cart");
    }
    public function SaveListItemCart(Request $req)
    {
    $oldCart = Session::has('cart') ? Session::get('cart') : null;
    $newCart = new Cart($oldCart);

    foreach ($req->quantities as $id => $quantity) {
        $newCart->UpdateItemCart($id, $quantity);
    }

    $req->session()->put('cart', $newCart);

    return response()->json([
        'success' => true,
        'totalQuanty' => $newCart->totalQuanty,
        'totalPrice' => $newCart->totalPrice,
    ]);
    }

    public function SaveAllListItemCart(Request $req)
    {
        \Log::info('Request data:', $req->all()); // Log toàn bộ yêu cầu để kiểm tra
    
        if ($req->has('data') && is_array($req->data)) {
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $newCart = new Cart($oldCart);
    
            foreach ($req->data as $item) {
                if (isset($item["key"]) && isset($item["value"])) {
                    $newCart->UpdateItemCart($item["key"], $item["value"]);
                }
            }
    
            $req->session()->put('cart', $newCart);
    
            return response()->json([
                'success' => true,
                'totalPrice' => $newCart->totalPrice,
                'totalQuanty' => $newCart->totalQuanty
            ]);
        }
    
        return response()->json([
            'success' => false,
            'message' => 'Invalid data provided'
        ], 400);
    }
    public function Checkout(){
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
      
        if (Auth::check()) {
            // Người dùng đã đăng nhập, lấy thông tin của người dùng từ Auth
            $user = Auth::user();
            $userData = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email
            ];
        } else {
            // Người dùng chưa đăng nhập, thông tin user rỗng
            $userData = null;
        }

        // Lấy thông tin giỏ hàng từ session
        $cart = Session::has('cart') ? Session::get('cart') : null;

        // Pass thông tin người dùng và giỏ hàng vào view "Cart.Check-out"
        return view("Cart.Check-out", compact('userData', 'cart')); 
    }
    public function Thanhyou(){
        
        return view("Cart.Thanks");
    }
    public function ProcessCheckout(Request $request)
    {
    // Kiểm tra dữ liệu đầu vào
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'address' => 'required|string|max:255',
        'phone' => 'nullable|string|max:15',
        'note' => 'nullable|string|max:500',
        'payment_method' => 'required|string|in:COD,VnPayqr',
    ]);

    // Lấy giỏ hàng từ session
    $oldCart = Session::has('cart') ? Session::get('cart') : null;

    if (!$oldCart || count($oldCart->products) == 0) {
        return redirect()->back()->with('error', 'Your cart is empty. Cannot proceed to payment.');
    }

    // Lưu thông tin checkout vào session
    $request->session()->put('checkout', $validatedData);

    // Lấy id_user nếu đã đăng nhập, nếu chưa thì để trống
    $id_user = auth()->check() ? auth()->user()->id : null;

    if ($validatedData['payment_method'] === 'VnPayqr') {
        return $this->handleVnPayPayment($request);
    } else {
        // Bắt đầu giao dịch cơ sở dữ liệu
        DB::beginTransaction();
        try {
            // Tạo đơn hàng
            $order = Order::create([
                'id_user' => $id_user,
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'address' => $validatedData['address'],
                'phone' => $validatedData['phone'],
                'note' => $validatedData['note'],
                'total_quantity' => $oldCart->totalQuanty,
                'total_price' => $oldCart->totalPrice,
                'payment_method' => $validatedData['payment_method'],
                'status' => Order::STATUS_PENDING,
            ]);

            // Lưu chi tiết đơn hàng và cập nhật số lượng sản phẩm trong kho
            foreach ($oldCart->products as $product) {
                // Lấy thông tin sản phẩm
                $book = Book::find($product['productinfor']->id);

                // Kiểm tra và trừ số lượng sản phẩm
                if ($book && $book->quanty >= $product['quanty']) {
                    $book->quanty -= $product['quanty'];
                    $book->save();

                    // Lưu chi tiết đơn hàng
                    OrderDetail::create([
                        'order_id' => $order->id,
                        'product_id' => $product['productinfor']->id,
                        'product_name' => $product['productinfor']->title,
                        'quantity' => $product['quanty'],
                        'price' => $product['productinfor']->price,
                    ]);
                } else {
                    // Nếu số lượng sản phẩm không đủ, rollback giao dịch và thông báo lỗi
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Not enough quantity for ' . $product['productinfor']->title);
                }
            }

            // Xóa giỏ hàng sau khi đặt hàng thành công
            $request->session()->forget('cart');

            // Commit giao dịch và chuyển hướng đến trang cảm ơn hoặc trang đơn hàng
            DB::commit();
            return redirect()->route('thankyou');
        } catch (\Exception $e) {
            // Nếu xảy ra lỗi, rollback giao dịch và hiển thị thông báo lỗi
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to process your order. Please try again later.');
        }
    }
    }

    public function handleVnPayPayment(Request $request)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpay.return');
        $vnp_TmnCode = "GEZ7615C"; // Mã website tại VNPAY 
        $vnp_HashSecret = "B3HRANFNPKX38L2P5C6XHN7XNFFYI2Z7"; // Chuỗi bí mật

        $vnp_TxnRef = rand(100000, 999999); // Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này 
        $vnp_OrderInfo = "Thanh toán hóa đơn";
        $vnp_OrderType = "billpayment";
        $vnp_Amount = $request->session()->get('cart')->totalPrice * 100; // Số tiền thanh toán
        $vnp_Locale = "vn";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $request->ip();

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (!empty($vnp_BankCode)) {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (!empty($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return redirect($vnp_Url);
    }

    public function vnpayReturn(Request $request)
    {
        $inputData = $request->all();

        // Kiểm tra dữ liệu đầu vào
        if (!isset($inputData['vnp_ResponseCode']) || !isset($inputData['vnp_SecureHash'])) {
            return redirect()->route('checkout')->with('error', 'Invalid data from VnPay.');
        }

        $vnp_HashSecret = "B3HRANFNPKX38L2P5C6XHN7XNFFYI2Z7"; // Chuỗi bí mật
        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);

        ksort($inputData);
        $hashData = "";
        foreach ($inputData as $key => $value) {
            $hashData .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        $hashData = trim($hashData, '&');
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        // Kiểm tra chữ ký
        if ($secureHash === $vnp_SecureHash) {
            if ($inputData['vnp_ResponseCode'] == '00') {
                // Lấy giỏ hàng từ session
                $oldCart = Session::has('cart') ? Session::get('cart') : null;

                // Lấy thông tin checkout từ session
                $checkoutData = $request->session()->get('checkout');

                if (!$checkoutData || !$oldCart) {
                    return redirect()->route('checkout')->with('error', 'Session data missing.');
                }

                $id_user = auth()->check() ? auth()->user()->id : null;

                // Tạo đơn hàng
                $order = Order::create([
                    'id_user' => $id_user,
                    'name' => $checkoutData['name'],
                    'email' => $checkoutData['email'],
                    'address' => $checkoutData['address'],
                    'phone' => $checkoutData['phone'],
                    'note' => $checkoutData['note'],
                    'total_quantity' => $oldCart->totalQuanty,
                    'total_price' => $oldCart->totalPrice,
                    'payment_method' => $checkoutData['payment_method'],
                    'status' => Order::STATUS_PENDING,
                ]);
                // Lưu chi tiết đơn hàng
                foreach ($oldCart->products as $product) {
                    OrderDetail::create([
                        'order_id' => $order->id,
                        'product_id' => $product['productinfor']->id,
                        'product_name' => $product['productinfor']->title,
                        'quantity' => $product['quanty'],
                        'price' => $product['productinfor']->price,
                    ]);
                }
                // Xóa giỏ hàng và thông tin checkout sau khi đặt hàng thành công
                $request->session()->forget('cart');
                $request->session()->forget('checkout');

                return redirect()->route('thankyou');
            } else {
                return redirect()->route('checkout')->with('error', 'Payment failed. Please try again.');
            }
        } else {
            return redirect()->route('checkout')->with('error', 'Invalid signature.');
        }
    }
}
?>
