<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Post;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    $totalProducts = \App\Models\Product::count();

    $totalCategories = \App\Models\Category::count();

    $totalOrders = \App\Models\Order::count();

    $totalUsers = \App\Models\User::count();

    return view('dashboard', compact(
        'totalProducts',
        'totalCategories',
        'totalOrders',
        'totalUsers'
    ));

})->middleware('auth')->name('dashboard');


/*
|--------------------------------------------------------------------------
| POSTS
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Semua user yang sudah login boleh melihat daftar post
    Route::get('/posts', function () {
        $posts = Post::with('user')
            ->latest()
            ->get();

        return view('posts.index', compact('posts'));
    })->name('posts.index');

    // Detail post
    Route::get('/posts/{post}', function (Post $post) {
        return view('posts.show', compact('post'));
    })->name('posts.show');
});


/*
|--------------------------------------------------------------------------
| POST MANAGEMENT - ADMIN & EDITOR
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin,editor'])->group(function () {

    Route::get('/posts/create', function () {
        return view('posts.create');
    })->name('posts.create');

    Route::post('/posts', function () {

        request()->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Post::create([
            'user_id' => auth()->id(),
            'title' => request('title'),
            'content' => request('content'),
        ]);

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post berhasil dibuat.');
    })->name('posts.store');


    Route::get('/posts/{post}/edit', function (Post $post) {

        if (
            auth()->user()->role !== 'admin' &&
            $post->user_id !== auth()->id()
        ) {
            abort(403);
        }

        return view('posts.edit', compact('post'));

    })->name('posts.edit');


    Route::put('/posts/{post}', function (Post $post) {

        if (
            auth()->user()->role !== 'admin' &&
            $post->user_id !== auth()->id()
        ) {
            abort(403);
        }

        request()->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post->update([
            'title' => request('title'),
            'content' => request('content'),
        ]);

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post berhasil diperbarui.');

    })->name('posts.update');


    Route::delete('/posts/{post}', function (Post $post) {

        if (
            auth()->user()->role !== 'admin' &&
            $post->user_id !== auth()->id()
        ) {
            abort(403);
        }

        $post->delete();

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post berhasil dihapus.');

    })->name('posts.destroy');
});


/*
|--------------------------------------------------------------------------
| PRODUCTS
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/products', function () {

        $products = Product::with(['category', 'tags'])
            ->latest()
            ->paginate(12);

        return view('products.index', compact('products'));

    })->name('products.index');


    Route::get('/products/{product}', function (Product $product) {

        $product->load(['category', 'tags']);

        return view('products.show', compact('product'));

    })->name('products.show');


    /*
    |--------------------------------------------------------------------------
    | CREATE ORDER
    |--------------------------------------------------------------------------
    */

    Route::post('/products/{product}/order', function (Product $product) {

        request()->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $quantity = (int) request('quantity');

        if ($quantity > $product->stock) {
            return back()->with('error', 'Stok produk tidak mencukupi.');
        }

        DB::transaction(function () use ($product, $quantity) {

            $total = $product->price * $quantity;

            $order = Order::create([
                'user_id' => auth()->id(),
                'status' => 'pending',
                'total' => $total,
            ]);

            $order->items()->create([
                'product_id' => $product->id,
                'qty' => $quantity,
                'price' => $product->price,
            ]);

            $product->decrement('stock', $quantity);
        });

        return redirect()
            ->route('orders.index')
            ->with('success', 'Pesanan berhasil dibuat.');

    })->name('products.order');
});


/*
|--------------------------------------------------------------------------
| ORDERS
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/orders', function () {

        if (auth()->user()->role === 'admin') {

            $orders = Order::with([
                'user',
                'items.product'
            ])
            ->latest()
            ->get();

        } else {

            $orders = Order::with([
                'items.product'
            ])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();
        }

        return view('orders.index', compact('orders'));

    })->name('orders.index');


    Route::get('/orders/{order}', function (Order $order) {

        if (
            auth()->user()->role !== 'admin' &&
            $order->user_id !== auth()->id()
        ) {
            abort(403);
        }

        $order->load([
            'user',
            'items.product'
        ]);

        return view('orders.show', compact('order'));

    })->name('orders.show');


    /*
    |--------------------------------------------------------------------------
    | CANCEL ORDER
    |--------------------------------------------------------------------------
    */

    Route::delete('/orders/{order}', function (Order $order) {

        if (
            auth()->user()->role !== 'admin' &&
            $order->user_id !== auth()->id()
        ) {
            abort(403);
        }

        DB::transaction(function () use ($order) {

            foreach ($order->items as $item) {

                $item->product->increment(
                    'stock',
                    $item->qty
                );
            }

            $order->delete();
        });

        return redirect()
            ->route('orders.index')
            ->with('success', 'Pesanan berhasil dibatalkan.');

    })->name('orders.destroy');


    /*
    |--------------------------------------------------------------------------
    | ADMIN UPDATE ORDER STATUS
    |--------------------------------------------------------------------------
    */

    Route::patch('/orders/{order}/status', function (Order $order) {

        request()->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order->update([
            'status' => request('status'),
        ]);

        return back()
            ->with('success', 'Status pesanan berhasil diperbarui.');

    })
    ->middleware('role:admin')
    ->name('orders.status');
});


/*
|--------------------------------------------------------------------------
| ADMIN PANEL
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin', function () {
        return view('admin');
    })->name('admin');

});


/*
|--------------------------------------------------------------------------
| EDITOR PANEL
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin,editor'])->group(function () {

    Route::get('/editor', function () {
        return view('editor');
    })->name('editor');

});


/*
|--------------------------------------------------------------------------
| BREEZE AUTH
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';

require __DIR__.'/profile.php';