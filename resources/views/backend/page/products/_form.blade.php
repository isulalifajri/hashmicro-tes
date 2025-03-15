@if(request()->segment(count(request()->segments())) == 'edit') 
    <div class="mt-1">
        @if($data->image)
        <img src="{{ $data->products_url}}" 
        class="img-preview img-fluid mb-3 col-sm-2 d-block" alt="{{ $data->image }}" id="myImg">
        @else
            <img class="img-preview img-fluid mb-3 col-sm-2" src="{{ asset('no-image.jpg') }}" alt="default">
        @endif
        <div class="input-group input-group-merge">
            <input
            type="file"
            accept="image/png, image/gif, image/jpeg, image/jpg, image/webp"
            name="image"
            class="form-control @error('image') is-invalid @enderror"
            id="image-prv" onchange="previewImage()" />
        </div>
        <span style="font-size: 11px">*Only uploading image is allowed</span>
    </div>   
@endif

<div class="mt-1">
    <label class="form-label" for="name">Nama Product</label>
    <div class="input-group input-group-merge">
        <input
        type="text"
        class="form-control @error('name') is-invalid @enderror"
        name="name"
        id="name"
        placeholder="input your name product" value="{{ old('name', $data->name) }}" required />
    </div>
    @error('name')
      <div class="invalid-feedback d-block">
          {{ $message }}
      </div>
    @enderror
</div>


<div class="mt-1">
    <label class="form-label" for="price">Price</label>
    <div class="input-group input-group-merge">
        <span class="input-group-text">Rp.</span>
        <input
        type="text"
        class="form-control @error('price') is-invalid @enderror"
        name="price"
        id="price"
        placeholder="input your price" value="{{ old('price', $data->price)}}" required />
    </div>
    @error('price')
      <div class="invalid-feedback d-block">
          {{ $message }}
      </div>
    @enderror
</div>

<div class="mt-1">
    <label class="form-label" for="my-editor">Description</label>
    <div class="input-group-merge">
        <textarea name="description" class="my-editor form-control @error('description') is-invalid @enderror" 
        id="my-editor" style="font-size:20px; resize:none">{{ old('description', $data->description) }}</textarea>
    </div>
    @error('description')
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
    @enderror
</div>

@if(request()->segment(count(request()->segments())) == 'tambah-data')    
    <div class="mt-1">
        <label class="form-label" for="image-prv">image</label>
        <img class="img-preview img-fluid mb-3 col-sm-2" alt="">
        <div class="input-group input-group-merge">
            <input
            type="file"
            accept="image/png, image/gif, image/jpeg, image/jpg, image/webp"
            name="image"
            class="form-control @error('image') is-invalid @enderror"
            id="image-prv" onchange="previewImage()" required />
        </div>
        <span style="font-size: 11px">*Only uploading image is allowed</span>
    </div>
@endif

<div class="mt-1">
    <label class="form-label" for="stok">Stok</label>
    <div class="input-group input-group-merge">
        <input
        type="number"
        class="form-control @error('stock') is-invalid @enderror"
        name="stock"
        id="stock"
        value="{{ old('stock', $data->stock) }}" required />
    </div>
    @error('stock')
      <div class="invalid-feedback d-block">
          {{ $message }}
      </div>
    @enderror
</div>


@push('masking')

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function(){
        // Format mata uang.
            $('#price').mask('#.##0', {reverse: true});

        })

    </script>
@endpush