<?php

namespace App\Http\Controllers;

use Auth; // Đảm bảo rằng lớp Auth được import chính xác
use Illuminate\Http\Request;
use DB;
use App\Models\User;
use App\Models\Book;
use App\Models\Order;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\Category;
use App\Models\Author;
use App\Models\OrderDetail;

class HomeController extends Controller
{
    public function index(){
        $user = auth()->user();
    if ($user) {
        $role = $user->role;
        if($role == "2"){
            return redirect("admin");
        } elseif($role == "0"){
            return redirect("user");
        } elseif($role == "1"){
            return redirect("seller");
        }
    }
    else return view('dashboard');
    }
    public function admin()
    {
    // Lấy tổng số lượng đơn hàng
    $totalOrders = Order::count();

    // Lấy tổng số sản phẩm
    $totalProducts = Book::count();

    // Lấy tổng số người dùng
    $totalUsers = User::where('role', '!=', 2)->count();

    // Lấy tổng số tiền đã bán được
    $totalEarnings = Order::sum('total_price');

    // Lấy danh sách các đơn hàng gần đây
    $orders = Order::orderBy('created_at', 'desc')->take(5)->get();

    // // Lấy danh sách người mua nhiều nhất
    $topBuyers = Order::select('name', DB::raw('COUNT(id) as order_count'), DB::raw('SUM(total_quantity) as total_quantity'))
            ->groupBy('name')
            ->orderByDesc('total_quantity') // Hoặc 'total_price' nếu muốn dựa trên tổng giá trị
            ->get();

    // Lấy danh sách các sản phẩm bán chạy nhất
    $topSellingProducts = DB::table('order_details')
    ->join('books', 'order_details.product_id', '=', 'books.id')
    ->join('authors', 'books.author_id', '=', 'authors.id')
    ->join('categories', 'books.category_id', '=', 'categories.id')
    ->select(
        'books.title as product_name',
        'authors.name as author_name',
        'categories.name as category_name',
        DB::raw('SUM(order_details.quantity) as total_quantity')
    )
    ->groupBy('books.id', 'books.title', 'authors.name', 'categories.name')
    ->orderBy('total_quantity', 'desc')
    ->take(10)
    ->get();

    return view('Admin.HomeAdmin', compact('totalOrders', 'totalProducts', 'totalUsers', 'totalEarnings', 'orders', 'topBuyers', 'topSellingProducts'));
    }

    public function user()
    {
        return redirect("Order-list-user");
    }

    public function seller()
    {
        return redirect("seller/list-users");
    }

    public function Userlist() {
        // Lấy tất cả người dùng bao gồm cả những người dùng đã bị xóa tạm thời, ngoại trừ những người có role là 2 hoặc 1
        $users = User::withTrashed()->whereNotIn('role', [1, 2])->get();
        return view('Seller.CustomersList', compact('users'));
    }
    
    // Xử lí hiển thị danh sách người dùng
    public function CustomersList(){
        $users = User::withTrashed()->where('role', '!=', 2)->get();
        return view('Admin.CustomersList', compact('users'));
    }
    // Xử lí xóa mềm người dùng
    public function Destroy($id)
    {    
            // Tìm người dùng theo ID
        $user = User::find($id);

        if ($user) {
            // Xóa mềm người dùng
            $user->delete();
            return redirect()->route('user-list')->with('success', 'User deleted successfully');
        } else {
            return redirect()->route('user-list')->with('error', 'User not found');
        }
    }
    // Xử lí khôi phục người dùng
    public function Restore($id)
    {  
            // Tìm người dùng đã bị xóa mềm theo ID
        $user = User::withTrashed()->find($id);

        if ($user) {
            // Khôi phục người dùng
            $user->restore();
            return redirect()->route('user-list')->with('success', 'User restored successfully');
        } else {
            return redirect()->route('user-list')->with('error', 'User not found');
        }
    }
    public function show($id)
    {
        // Tìm người dùng theo ID, bao gồm cả người dùng đã bị xóa mềm
        $user = User::withTrashed()->find($id);
        // Xác định layout dựa trên vai trò của người dùng
        if (Auth::user()->role == '1') {
            $layout = 'Seller.LayoutSeller';
        } elseif (Auth::user()->role == '2') {
            $layout = 'Admin.LayoutAdmin';
        } else {
            // Trường hợp không có vai trò hoặc vai trò không xác định, bạn có thể đặt một layout mặc định hoặc báo lỗi.
            abort(403, 'Unauthorized action.');
        }
        if ($user) {
            return view("Admin.UpdateUser", compact('user','layout'));
        } else {
            return redirect()->route('user-list')->with('error', 'User not found');
        }
    }
    // Xử lý cập nhật thông tin người dùng
        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
                // Validate dữ liệu đầu vào
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'role' => 'required|in:0,1',
        ]);

        // Tìm người dùng hiện có theo ID, bao gồm cả người dùng đã bị xóa mềm
        $user = User::withTrashed()->find($id);

        if ($user) {
            // Khôi phục người dùng nếu họ đã bị xóa mềm
            if ($user->trashed()) {
                $user->restore();
            }
            // Cập nhật chi tiết người dùng
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->role = $request->input('role'); // Lưu giá trị cho trường role
            $user->save();

            return redirect()->route('user-list')->with('success', 'User updated successfully');
        } else {
            return redirect()->route('user-list')->with('error', 'User not found');
        }
    }
    // Xử lý liên hệ
        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function submit(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:3000',
        ]);

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->message = $request->message;
        $contact->save();

        // You can add any additional logic here, such as sending an email

        return redirect()->back()->with('success', 'Thank you for contacting us!');
    }
    public function formContact(){
        
        return view("Home.contact");
    }
    public function header(){     
        return view("layouts.headercart");
    }
    public function formContactAdmin()
    {   
        // Xác định layout dựa trên vai trò của người dùng
        if (Auth::user()->role == '1') {
            $layout = 'Seller.LayoutSeller';
        } elseif (Auth::user()->role == '2') {
            $layout = 'Admin.LayoutAdmin';
        } else {
            // Trường hợp không có vai trò hoặc vai trò không xác định, bạn có thể đặt một layout mặc định hoặc báo lỗi.
            abort(403, 'Unauthorized action.');
        }
        // Lấy danh sách tất cả các liên hệ
        $contacts = Contact::all();

        // Trả về view hiển thị danh sách liên hệ
        return view('Admin.Contact', compact('contacts','layout'));
    }
    public function DeleteContact($id)
    {
        // Tìm liên hệ theo ID
        $contact = Contact::findOrFail($id);

        // Xóa liên hệ
        $contact->delete();

        // Chuyển hướng về trang danh sách liên hệ với thông báo thành công
        return redirect()->route('admin.contact')->with('success', 'Contact deleted successfully');
    }
}
