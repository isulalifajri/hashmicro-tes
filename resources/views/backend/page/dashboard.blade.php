@extends('backend.layout.main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
  </div>

  
  <span>Selamat Datang di Halaman Dashboard <b>{{ auth()->user()->name }}</b></span>

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
        <h5>Halo, {{ $greet }} {{  auth()->user()->name  }}</h5>
    @else
        <h5>Halo, {{ $greet }} </h5>
    @endauth

@endsection