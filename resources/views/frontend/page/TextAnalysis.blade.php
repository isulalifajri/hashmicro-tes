@extends('frontend.layout.app')

@section('content')
<div class="card-body">
 <h2>Pesanan Saya</h2>
 <hr>
    <div class="mt-3">
        <form action="{{ route('text-analysis.analyze') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="input1" class="form-label">Input 1</label>
                <input type="text" class="form-control" id="input1" name="input1" value="{{ old('input1', $input1 ?? '') }}" required>
            </div>
    
            <div class="mb-3">
                <label for="input2" class="form-label">Input 2</label>
                <input type="text" class="form-control" id="input2" name="input2" value="{{ old('input2', $input2 ?? '') }}" required>
            </div>
    
            <button type="submit" class="btn btn-primary">Cek Kesamaan</button>
        </form>
    
        @isset($percentage)
        <div class="mt-4">
            <h4>Hasil Analisis:</h4>
            <p><strong>Input 1:</strong> {{ $input1 }}</p>
            <p><strong>Input 2:</strong> {{ $input2 }}</p>
            <p><strong>Karakter unik di Input 1:</strong> {{ $totalChars }}</p>
            <p><strong>Karakter yang cocok di Input 2:</strong> {{ $matchedCount }}</p>
            <p><strong>Persentase kesamaan:</strong> {{ number_format($percentage, 2) }}%</p>
        </div>
        @endisset
    </div>
</div>

@endsection