@extends('frontend.layout.app')

@section('content')
<div class="card-body">
 <h2>Pesanan Saya</h2>
 <hr>
    <div class="mt-3">
        <div class="d-flex flex-wrap pt-3 pb-2 mb-3 border-bottomm gap-2">
            @forelse ($orders as $order)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Order Code: {{ $order->order_code }}</h5>
                    <p class="text-muted">Total Harga: <strong>Rp{{ number_format($order->total_price, 0, ',', '.') }}</strong></p>
                    <p>Status: <span class="badge bg-info">{{ $order->statusPesanan->status }}</span></p>
        
                    <!-- Tracking Status -->
                    <h6>Status Tracking:</h6>
                    <ul class="list-group">
                        @foreach ($order->TrackingStatusPesanan as $status)
                            <li class="list-group-item d-flex justify-content-between align-items-center my-1">
                                <span>{{ ucfirst($status->status) }}</span> 
                                <span class="text-muted">{{ $status->created_at->diffForHumans() }}</span>
                            </li>
                        @endforeach
                    </ul>
        
                    @php
                        $latestStatus = $order->TrackingStatusPesanan->sortByDesc('created_at')->first();
                        $isPending = $latestStatus && $latestStatus->status === 'pending';
                    @endphp

                    @if ($isPending)
                        <div class="d-flex flex-wrap gap-2">
                            <form action="{{ route('orders.canceled', $order->id) }}" method="POST" class="mt-2">
                                @csrf
                                <button type="submit" class="btn btn-primary my-2" {{ $isPending ? '' : 'disabled' }}>
                                    Canceled
                                </button>
                            </form>
                        </div>
                    @endif
        
                    @foreach ($order->orderDetails as $detail)
                        <div class="d-flex align-items-center border p-2 rounded mb-2">
                            <img src="{{ $detail->product->products_url }}" alt="{{ $detail->product->name }}" width="100" height="100" class="me-3 rounded">
                            {{-- <img src="{{ $product->products_url }}" class="card-img-top img-fluid h-100" alt="user default" style="border: 1px solid #e7e0e0;object-fit: cover;">               --}}
                            <div>
                                <h6>{{ $detail->product->name }}</h6>
                                <p class="mb-1">Harga: Rp{{ number_format($detail->price, 0, ',', '.') }}</p>
                                <p class="mb-1">Quantity: {{ $detail->quantity }}</p>
                                <p class="mb-1">Subtotal: <strong>Rp{{ number_format($detail->subtotal, 0, ',', '.') }}</strong></p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @empty
                <div class="alert alert-warning">Tidak ada pesanan.</div>
            @endforelse
        </div>
    </div>
</div>

@endsection