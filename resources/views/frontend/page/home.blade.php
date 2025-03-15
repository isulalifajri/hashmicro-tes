@extends('frontend.layout.app')

@push('css')

<style>
    .img-new{
        height: 300px;
    }
    @media (min-width: 800px) {
        .col-sm-4 {
            width: 32.333333% !important;
        }
    }
    @media (min-width: 767px) {
        .col-sm-4 {
            width: 49.333333% !important;
        }
    }
    @media (min-width: 576px) {
            .col-sm-4 {
                width: 47.333333%;
            }
        }
</style>
    
@endpush

@section('content')
<div class="card-body">
    @php
        $hour = date("G");
        if ((int)$hour >= 0 && (int)$hour <= 10) {
            $greet = "Selamat Pagi";
        } else if ((int)$hour >= 11 && (int)$hour <= 14) {
            $greet = "Selamat Siang";
        } else if ((int)$hour >= 15 && (int)$hour <= 17) {
            $greet = "Selamat Sore";
        } else if ((int)$hour >= 18 && (int)$hour <= 23) {
            $greet = "Selamat Malam";
        } else {
            $greet = "Welcome,";
        }
    @endphp
    @auth
        <h5>Halo, {{ $greet }} {{  auth()->user()->name  }}  @can('admin') as Admin @endcan</h5>
    @else
        <h5>Halo, {{ $greet }} </h5>
    @endauth

    <div class="mt-3">
        <h6>Mau Belanja Apa Hari ini?</h6>
        <hr>
        <div class="d-flex flex-wrap gap-2 mt-2">
            @forelse ($products as $product)
              <div class="col-sm-4">
                  <div class="card">
                      <div class="img-new">
                          <img src="{{ $product->products_url }}" class="card-img-top img-fluid h-100" alt="user default" style="border: 1px solid #e7e0e0;object-fit: cover;">
                      </div>
                      <div class="card-body">
                          <h5 class="card-title text-capitalize truncate-2-lines">{{$product->name }}</h5>
                          <hr>
                          <div class="d-flex justify-content-between">
                              <h5>{{ $product->priceText }}</h5>
                              <a href="{{ route('detail.product', $product->id) }}" class="btn btn-info">view detail</a>
                          </div>
                      </div>
                  </div>
              </div>
        
            @empty
                <div class="card w-100">
                    <div class="card-body text-center">
                        <img src="{{ asset('no-image.jpg') }}" alt="no-data" class="w-50">
                        <h3 class="text-info">Upps... Tidak Ada Data product</h3>
                    </div>
                </div>
            @endforelse
        </div>
       
    </div>
</div>

@endsection