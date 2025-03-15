<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\StatusPesanan;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $title = 'Page Data Order';
        $orders = Order::with([
            'orderDetails.product',  // Ambil produk di dalam order details
            'statusPesanan' // Ambil status pesanan
        ])
        ->latest()
        ->paginate(10); // Pagination biar nggak berat

        return view('backend.page.order.order', compact(
            'title', 'orders'
        ));
    }

    public function myOrders()
    {
        $title = 'Pesanan Saya';
        $orders = Order::with([
            'orderDetails.product',  // Ambil produk di dalam order details
            'statusPesanan' // Ambil status pesanan
        ])->where('user_id', auth()->id()) // Hanya pesanan user yang login
        ->latest()
        ->get();

        return view('frontend.page.myorders', compact('orders', 'title'));
    }

    public function updateStatusProcessing(Order $order)
    {
        // Pastikan status terakhir adalah "pending"
        $latestStatus = $order->statusPesanan()->latest()->first();

        if ($latestStatus && $latestStatus->status == 'pending') {
            DB::beginTransaction();
            try {
                // Tambahkan status baru
                StatusPesanan::create([
                    'order_id' => $order->id,
                    'status' => 'processing',
                ]);

                DB::commit();
                return back()->with('success', 'Status pesanan berhasil diperbarui ke Processing!');
            } catch (\Exception $e) {
                DB::rollback();
                return back()->with('success-danger', 'Gagal memperbarui status: ' . $e->getMessage());
            }
        }

        return back()->with('success-danger', 'Status hanya bisa diubah jika pesanan masih Pending.');
    }

    public function updateStatusComplete(Order $order)
    {
        // Pastikan status terakhir adalah "processing"
        $latestStatus = $order->statusPesanan()->latest()->first();

        if ($latestStatus && $latestStatus->status == 'processing') {
            DB::beginTransaction();
            try {
                // Tambahkan status baru
                StatusPesanan::create([
                    'order_id' => $order->id,
                    'status' => 'complete',
                ]);

                DB::commit();
                return back()->with('success', 'Status pesanan berhasil diperbarui ke Complete!');
            } catch (\Exception $e) {
                DB::rollback();
                return back()->with('success-danger', 'Gagal memperbarui status: ' . $e->getMessage());
            }
        }

        return back()->with('success-danger', 'Status hanya bisa diubah jika pesanan masih Processing.');
    }

    public function updateStatusCanceled(Order $order)
    {
        // Pastikan status terakhir adalah "pending"
        $latestStatus = $order->statusPesanan()->latest()->first();

        if ($latestStatus && $latestStatus->status == 'pending') {
            DB::beginTransaction();
            try {

                // Kembalikan stok produk dari order detail
                foreach ($order->orderDetails as $detail) {
                    $detail->product->increment('stock', $detail->quantity);
                }

                // Tambahkan status baru
                StatusPesanan::create([
                    'order_id' => $order->id,
                    'status' => 'canceled',
                ]);

                DB::commit();
                return back()->with('success', 'Pesanan berhasil dibatalkan!');
            } catch (\Exception $e) {
                DB::rollback();
                return back()->with('success-danger', 'Gagal memperbarui status: ' . $e->getMessage());
            }
        }

        return back()->with('success-danger', 'Status hanya bisa diubah jika pesanan masih Pending.');
    }

    public function checkout(Request $request)
    {
        // Validasi
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            $product = Product::find($request->product_id);
            $subtotal = $product->price * $request->quantity;

            if ($product->stock < $request->quantity) {
                return back()->with('success-danger', 'Stok tidak mencukupi! Stok tersedia: ' . $product->stock);
            }

            // Buat Order
            $order = Order::create([
                'order_code' => 'ORD-' . Str::random(8),
                'user_id' => auth()->id(),
                'total_price' => $subtotal, // Sementara ini totalnya 1 produk
            ]);

            // Simpan ke Order Detail
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'price' => $product->price,
                'subtotal' => $subtotal,
            ]);

            // Kurangi stok produk
            $product->decrement('stock', $request->quantity);

            // Simpan status awal
            StatusPesanan::create([
                'order_id' => $order->id,
                'status' => 'pending',
            ]);

            DB::commit();
            return back()->with('success', 'Pesanan berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('success-danger', 'Gagal membuat pesanan!'. $e->getMessage());
        }
    }
}
