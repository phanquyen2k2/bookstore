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
     * Hiển thị danh sách các sản phẩm.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Book::whereNull('deleted_at')
            ->orderBy('created_at', 'desc')
            ->paginate(8);

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

        return view("Home.home", compact('products', 'bestSellingProducts'));
    }

    /**
     * Hiển thị danh sách sách.
     *
     * @return \Illuminate\Http\Response
     */
    public function ListBook()
    {
        $products = Book::whereNull('deleted_at')->paginate(12);
        return view("Home.book", compact('products'));
    }

    /**
     * Hiển thị danh sách các sản phẩm (bao gồm cả những sản phẩm đã bị xóa mềm).
     *
     * @return \Illuminate\Http\Response
     */
    public function ProductsList()
    {
        $books = Book::with(['author', 'category'])->withTrashed()->get();
        return view("Products.Products", compact('books'));
    }

    /**
     * Hiển thị form thêm sản phẩm.
     *
     * @return \Illuminate\Http\Response
     */
    public function form_add()
    {
        return view("Products.AddProducts");
    }

    /**
     * Xóa mềm một sản phẩm.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Destroy($id)
    {
        $book = Book::find($id);

        if ($book) {
            $book->delete();
            return redirect()->route('product-list')->with('success', 'Sản phẩm đã được xóa thành công');
        } else {
            return redirect()->route('product-list')->with('error', 'Không tìm thấy sản phẩm');
        }
    }

    /**
     * Khôi phục một sản phẩm đã bị xóa mềm.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Restore($id)
    {
        $book = Book::withTrashed()->find($id);

        if ($book) {
            $book->restore();
            return redirect()->route('product-list')->with('success', 'Sản phẩm đã được khôi phục thành công');
        } else {
            return redirect()->route('product-list')->with('error', 'Không tìm thấy sản phẩm');
        }
    }

    /**
     * Lưu trữ một sản phẩm mới.
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
            'quanty' => 'required|numeric|max:255',
            'author' => 'required|max:255',
            'category' => 'required|max:255',
            'image' => 'required|max:2000000',
        ]);

        $author = Author::firstOrCreate(['name' => $request->input('author')]);
        $category = Category::firstOrCreate(['name' => $request->input('category')]);

        $product = new Book();
        $product->title = $request->input('title');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->quanty = $request->input('quanty');
        $product->author_id = $author->id;
        $product->category_id = $category->id;
        $product->image_url = $request->input('image');
        $product->published_at = Carbon::now();
        $product->save();

        return redirect()->route('product-list')->with('success', 'Sản phẩm đã được thêm thành công');
    }

    /**
     * Hiển thị chi tiết sản phẩm.
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
            return redirect()->route('product-list')->with('error', 'Không tìm thấy sản phẩm');
        }
    }

    /**
     * Cập nhật thông tin sản phẩm.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
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

        $author = Author::firstOrCreate(['name' => $request->input('author')]);
        $category = Category::firstOrCreate(['name' => $request->input('category')]);

        $product = Book::withTrashed()->find($id);

        if ($product) {
            if ($product->trashed()) {
                $product->restore();
            }

            $product->title = $request->input('title');
            $product->description = $request->input('description');
            $product->price = $request->input('price');
            $product->quanty = $request->input('quanty');
            $product->author_id = $author->id;
            $product->category_id = $category->id;
            $product->image_url = $request->input('image');
            $product->published_at = Carbon::now();
            $product->deleted_at = $request->input('delete');
            $product->save();

            return redirect()->route('product-list')->with('success', 'Sản phẩm đã được cập nhật thành công');
        } else {
            return redirect()->route('product-list')->with('error', 'Không tìm thấy sản phẩm');
        }
    }

    /**
     * Hiển thị chi tiết sách.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function BookDetail($id)
    {
        $books = Book::with(['author', 'category'])->find($id);

        if (!$books) {
            return redirect()->back()->with('error', 'Không tìm thấy sách');
        }

        return view("Home.product-details", compact('books'));
    }

    /**
     * Tìm kiếm sách.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchBook(Request $request)
    {
        $query = $request->input('query');
        $categories = Category::all();
        $products = Book::where('title', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->paginate(12);

        return view('Home.search', compact('products', 'categories', 'query'));
    }

    /**
     * Hiển thị sách theo tác giả.
     *
     * @param  string  $authorName
     * @return \Illuminate\Http\Response
     */
    public function booksByAuthor($authorName)
    {
        $author = Author::where('name', $authorName)->firstOrFail();
        $products = Book::where('author_id', $author->id)->whereNull('deleted_at')->get();

        return view('Home.author', compact('products', 'author'));
    }

    /**
     * Hiển thị sách theo thể loại.
     *
     * @param  string  $category
     * @return \Illuminate\Http\Response
     */
    public function productsCategory($category)
    {
        $categori = Category::where('name', $category)->firstOrFail();
        $products = Book::where('category_id', $categori->id)->whereNull('deleted_at')->get();

        return view('Home.category', compact('products', 'categori'));
    }
}
