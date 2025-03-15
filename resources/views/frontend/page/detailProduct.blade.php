@extends('frontend.layout.app')

@section('content')
<div class="card-body">
 <h2>Detail Product</h2>
 <hr>
    <div class="mt-3">
        <div class="d-flex flex-wrap gap-2 mt-2 mb-5">
            <form action="{{ route('checkout') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="d-flex flex-wrap gap-5">
                        @csrf
                        <div class="col-md-4">
                            <img src="{{ $data->products_url }}" class="card-img-top" alt="user default" style="border: 1px solid #e7e0e0;">
                        </div>
                        <div class="col-md-5 mt-2">
                            <h2>{{ $data->title }}</h2>
                            <span class="mt-2 badge {{ $data->stock < 1 ? 'bg-primary' : 'bg-info'  }}">{{ $data->stock < 1 ? 'Tidak Tersedia' : 'Tersedia'  }}</span>
                            <h1 class="mt-3">{{ $data->priceText }}</h1>
                            <p class="mt-4">stock yang Tersedia : <b>{{ $data->stock }}</b></p>

                            <input type="hidden" name="product_id" id="product_id" value="{{ $data->id }}">

                            <div class="mb-3">
                                <label for="quantity" class="form-label">Mau Pesan Berapa?</label>
                                <input type="number" class="form-control @error('quantity') @enderror" name="quantity" id="quantity" placeholder="e.g: 3" required>
                                <span class="text-small" style="font-size: 11px">*Pastikan Barang yang di pesan tidak melebihi stock yg tersedia</span>
                                @error('quantity')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                              </div>

                            <div class="d-block my-2">
                                <button type="submit" class="btn btn-success" {{ $data->stock < 1 ? 'disabled' : ''  }}>Checkout Sekarang</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card w-100 mt-2">
                    <div class="card-body">
                        <h3>Description</h3>
                        <p>{!! $data->description !!}</p>
                    </div>
                </div>
            </form>
        </div>
       
    </div>
</div>

@endsection