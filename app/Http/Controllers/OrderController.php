<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar pesanan.
     */
    public function index()
    {
        $orders = Order::with('user')
            ->latest()
            ->paginate(12);

        return view('orders.index', compact('orders'));
    }

    /**
     * Menampilkan detail pesanan.
     */
    public function show(Order $order)
    {
        $order->load('user', 'items.product');

        return view('orders.show', compact('order'));
    }
}