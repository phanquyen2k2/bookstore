<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\CancelOrder;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{   
      
    public function OrderList(){
        $orderslist=DB::table('orders')->get();
        return view("Orders.OrderList",compact('orderslist'));
    }
    public function OrderDetails($orderId){
        $orderDetails = DB::table('order_details')->where('order_id', $orderId)->get();
        return response()->json($orderDetails);
    }
    public function InforDetails($orderId){
        // Lấy thông tin đơn hàng theo id_user
    $order = Order::find($orderId);

    if (!$order) {
        return response()->json(['error' => 'Order not found.'], 404);
    }

    // Kiểm tra trạng thái của đơn hàng
    if ($order->status == 'cancelled') {
        // Nếu đơn hàng đã bị hủy, lấy thông tin từ bảng cancel_orders
        $cancelReason = CancelOrder::where('order_id', $orderId)->value('cancel_reason');

        $orderDetails = [
            'id' => $order->id,
            'email' => $order->email,
            'address' => $order->address,
            'phone' => $order->phone,
            'note' => $order->note,
            'cancel_reason' => $cancelReason,
        ];
    } else {
        // Nếu đơn hàng không phải là cancelled, lấy thông tin từ bảng orders
        $orderDetails = [
            'id' => $order->id,
            'email' => $order->email,
            'address' => $order->address,
            'phone' => $order->phone,
            'note' => $order->note,
        ];
    }
    // Trả về dữ liệu dưới dạng JSON
    return response()->json($orderDetails);
    }
    public function show($orderId)
    {
       // Lấy thông tin của đơn hàng từ cơ sở dữ liệu
       $order = Order::findOrFail($orderId);

       // Trả về view hiển thị form cập nhật đơn hàng và truyền dữ liệu của đơn hàng vào view
       return view('Orders.UpdateOrder', compact('order'));
    }
        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$orderId)
    {
        // Validate dữ liệu đầu vào
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|max:255',
            'phone' => 'required|max:20',
            'note' => 'nullable|max:1000',
            'total_quantity' => 'required|integer',
            'total_price' => 'required|numeric',
            'payment_method' => 'required|max:255',
            'status' => 'required|in:pending,processing,completed,cancelled,paid',
        ]);

        // Tìm đơn hàng hiện có theo ID
        $order = Order::findOrFail($orderId);

        // Cập nhật chi tiết đơn hàng
        $order->name = $request->input('name');
        $order->email = $request->input('email');
        $order->address = $request->input('address');
        $order->phone = $request->input('phone');
        $order->note = $request->input('note');
        $order->total_quantity = $request->input('total_quantity');
        $order->total_price = $request->input('total_price');
        $order->payment_method = $request->input('payment_method');
        $order->status = $request->input('status');
        $order->save();

        return redirect()->route('orderlist')->with('success', 'Order updated successfully');
    }
    // Các Controller xử lí chức năng của user
    public function OrderListUser()
    {
       // Lấy id của người dùng đã xác thực
    $id = Auth::user()->id;
    // Truy vấn các đơn hàng của người dùng dựa trên id_user
    $userOrders = Order::where('id_user', $id)->get();

    // Trả về view để hiển thị danh sách đơn hàng của người dùng
    return view('User.OrderUser', compact('userOrders'));
    }
    // Method to display the order edit form for the authenticated user
    public function showuser($orderId)
    {
            // Retrieve the order details by its ID
        $order = DB::table('orders')->where('id', $orderId)->first();

        // Check if the authenticated user is authorized to edit this order
        if (Auth::user()->email != $order->email) {
            return redirect()->route('orderlist.user')->with('error', 'You are not authorized to edit this order.');
        }

        // Check if the order status is either "pending" or "paid"
        if ($order->status != 'pending' && $order->status !='paid') {
            return redirect()->route('orderlist.user')->with('error', 'This order cannot be edited at the moment.');
        }

        // Return a view to display the order edit form, passing the order data to the view
        return view('User.UpdateOrderUser', compact('order'));
    }
        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edituser(Request $request, $orderId)
    {
        // Validate dữ liệu đầu vào
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|max:255',
            'phone' => 'required|max:20',
            'note' => 'nullable|max:1000',
            'total_quantity' => 'required|integer',
            'total_price' => 'required|numeric',
            'payment_method' => 'required|max:255',
            'status' => 'required|in:pending,processing,completed,cancelled,paid',
        ]);
    
        // Tìm đơn hàng hiện có theo ID
        $order = Order::findOrFail($orderId);
    
        // Kiểm tra xem người dùng có quyền chỉnh sửa đơn hàng không
        if ($request->user()->email != $order->email) {
            return redirect()->route('orderlist.user')->with('error', 'You are not authorized to edit this order.');
        }
    
        // Cập nhật chi tiết đơn hàng
        $order->update($validatedData);
    
        return redirect()->route('orderlist.user')->with('success', 'Order updated successfully');
    }
    public function formCancel($userId){
        $order = Order::find($userId);
        
        if (!$order) {
            return redirect()->route('orderlist.user')->with('error', 'Order not found.');
        }
        if ($order->status == 'paid') {
            return redirect()->route('contact')->with('message', 'Please contact admin to cancel the order.');
        }
        if ($order->status != 'pending') {
            return redirect()->route('orderlist.user')->with('error', 'This order cannot be edited at the moment.');
        }

        return view('User.CancelOrder', [
            'id' => $userId,
            'name' => $order->name,
            'email' => $order->email,
        ]);
    }
    // Xử lí hủy đơn hàng
    public function cancelOrder(Request $request, $orderId){
        // Lấy đơn hàng theo ID
        $order = Order::find($orderId);

        if (!$order) {
            return redirect()->route('orderlist.user')->with('error', 'Order not found.');
        }

        // Kiểm tra trạng thái đơn hàng
        if ($order->status !== Order::STATUS_PENDING) {
            return redirect()->route('orderlist.user')->with('error', 'Only pending orders can be cancelled.');
        }

        // Validate dữ liệu lý do hủy đơn hàng
        $validatedData = $request->validate([
            'cancel_reason' => 'required|string|max:500',
        ]);

        // Cập nhật trạng thái đơn hàng thành "cancelled"
        $order->status = Order::STATUS_CANCELLED;
        $order->save();

        // Lưu thông tin hủy vào bảng cancel_orders
        CancelOrder::create([
            'order_id' => $order->id,
            'user_id' => $order->id_user,
            'cancel_reason' => $validatedData['cancel_reason'],
        ]);

        return redirect()->route('orderlist.user')->with('success', 'Order has been cancelled.');
    }
    
    
    
}
