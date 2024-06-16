<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\OrderDetail;
use Carbon\Carbon;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $categories = Category::all(); // Get all categories
        $authors=Author::all();
        $products = Book::whereNull('deleted_at')->get(); // Get all non-deleted products

    // Get best-selling products
        $bestSellingProducts = OrderDetail::select('product_id', DB::raw('SUM(quantity) as total_quantity'))
        ->groupBy('product_id')
        ->orderBy('total_quantity', 'desc')
        ->take(4)
        ->get()
        ->map(function ($orderDetail) {
            $book = Book::find($orderDetail->product_id);
            $book->total_quantity = $orderDetail->total_quantity;
            return $book;
        });
    
    return view("Home.home", compact('products', 'bestSellingProducts','categories','authors'));
    }
    public function ListBook(){
        $categories = Category::all();
        $authors=Author::all();
        $products = Book::whereNull('deleted_at')->get();
        return view("Home.book", compact('categories', 'products','categories','authors'));
    }
    public function ProductsList()
    {
        $books = Book::with(['author', 'category'])->withTrashed()->get();
        return view("Products.Products", compact('books'));
    }
    public function form_add()
    {
        return view("Products.AddProducts");
    }
    public function Destroy($id)
    {
        // Tìm sách theo ID
        $book = Book::find($id);

        if ($book) {
            // Xóa mềm sách
            $book->delete();
            return redirect()->route('product-list')->with('success', 'Product deleted successfully');
        } else {
            return redirect()->route('product-list')->with('error', 'Product not found');
        }
    }
    public function Restore($id)
    {
        // Tìm sách đã bị xóa mềm theo ID
        $book = Book::withTrashed()->find($id);

        if ($book) {
            // Khôi phục sách
            $book->restore();
            return redirect()->route('product-list')->with('success', 'Product restored successfully');
        } else {
            return redirect()->route('product-list')->with('error', 'Product not found');
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'author' => 'required|max:255',
            'category' => 'required|max:255',
            'image' => 'required|max:2000000',
        ]);
       
            $author = Author::firstOrCreate(['name' => $request->input('author')]);
            // Lưu dữ liệu vào bảng category
            $category = Category::firstOrCreate(['name' => $request->input('category')]);
        // Tạo sản phẩm mới và lưu vào cơ sở dữ liệu
            $product = new Book();
            $product->title = $request->input('title');
            $product->description = $request->input('description');
            $product->price = $request->input('price');
            $product->author_id = $author->id; // Liên kết với bảng author thông qua khóa ngoại author_id
            $product->category_id = $category->id; // Liên kết với bảng category thông qua khóa ngoại category_id
            $product->image_url = $request->input('image');
            $product->published_at = Carbon::now();
            $product->save();
        

        return redirect()->route('product-list')->with('success', 'Product added successfully');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Book::with(['author', 'category'])->withTrashed()->find($id);

        if ($product) {
            return view("Products.EditProduct", compact('product'));
        } else {
            return redirect()->route('product-list')->with('error', 'Product not found');
        }
    }

    /**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
    public function edit(Request $request, $id)
    {
       // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'author' => 'required|max:255',
            'category' => 'required|max:255',
            'quanty' => 'required|numeric',
            'image' => 'required|max:2000000',
            'delete' => 'nullable|date',
        ]);

        // Create or get the author
        $author = Author::firstOrCreate(['name' => $request->input('author')]);

        // Create or get the category
        $category = Category::firstOrCreate(['name' => $request->input('category')]);

        // Find the existing product by ID including soft deleted
        $product = Book::withTrashed()->find($id);

        if ($product) {
            // Restore the soft deleted product if it's deleted
            if ($product->trashed()) {
                $product->restore();
            }

            // Update the product details
            $product->title = $request->input('title');
            $product->description = $request->input('description');
            $product->price = $request->input('price');
            $product->quanty = $request->input('quanty');
            $product->author_id = $author->id; // Link to the author
            $product->category_id = $category->id; // Link to the category
            $product->image_url = $request->input('image');
            $product->published_at = Carbon::now();

            // Update the deleted_at field
            $product->deleted_at = $request->input('delete');

            $product->save();

            return redirect()->route('product-list')->with('success', 'Product updated successfully');
        } else {
            return redirect()->route('product-list')->with('error', 'Product not found');
        }

    }
    public function BookDeital($id)
    {   
        $categories = Category::all();
        $authors=Author::all();
        // Fetch the book by its ID along with its author and category
        $books = Book::with(['author', 'category'])->find($id);

        // Check if the book exists
        if (!$books) {
            return redirect()->route('index')->with('error', 'Book not found');
        }

        // Pass the book data to the view
        return view("Home.product-details", compact('books','categories','authors'));
    }
    public function searchBook(Request $request)
    {   
        $categories = Category::all();
        $authors=Author::all();
        $query = $request->input('query'); // Lấy nội dung từ trường tìm kiếm
        $categories = Category::all();
        // Tìm kiếm sản phẩm với tên hoặc mô tả chứa từ khóa tìm kiếm
        $products = Book::where('title', 'like', "%$query%")
                            ->orWhere('description', 'like', "%$query%")
                            ->get();

        // Truyền kết quả tìm kiếm vào view và hiển thị
        return view('Home.search', compact('products','categories', 'query','categories','authors'));
    }
    public function booksByAuthor($authorName)
    {   
        $categories = Category::all(); // Get all categories
        $authors = Author::all(); // Get all authors

        // Find the author by name
        $author = Author::where('name', $authorName)->firstOrFail();

        // Get books by the author, excluding soft deleted books
        $products = Book::where('author_id', $author->id)->whereNull('deleted_at')->get();

        return view('Home.author', compact('products', 'categories', 'authors', 'author'));
    }
    public function productsCategory($category)
    {
        $categories = Category::all(); // Get all categories
        $authors = Author::all(); // Get all authors

        // Find the category by name
        $categori = Category::where('name', $category)->firstOrFail();

        // Get products (books) by the category, excluding soft deleted ones
        $products = Book::where('category_id', $categori->id)->whereNull('deleted_at')->get();
        
        return view('Home.category', compact('products', 'categories', 'authors', 'categori'));
    }

}
