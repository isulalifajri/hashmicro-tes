@extends('backend.layout.main')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
              <h5 class="card-header">Create Form</h5>
              <form method="POST" action="{{ route('store') }}" enctype="multipart/form-data">
                @method('POST')
                @csrf
                  <div class="card-body demo-vertical-spacing demo-only-element">

                      @include('backend.page.products._form')
  
                      <div class="mt-2">
                          <button type="submit" class="btn btn-primary"><i class="bx bx-save me-sm-1"></i> Save </button>
                          <a href="{{ url('/product') }}" class="btn btn-secondary" id="close">Close <i class="bx bx-x-circle me-sm-1" style="margin-left: 0.25rem"></i> </a>
                      </div>
                  </div>
              </form>
            </div>
        </div>
    </div>
</div>
    
@push('prv-img')
  <script>
    function previewImage(){
       const image =  document.querySelector('#image-prv');
       const imgPreview = document.querySelector('.img-preview');

       imgPreview.style.display = 'block';

       const blob = URL.createObjectURL(image.files[0]);
        imgPreview.src = blob;
     }
  </script>
@endpush
@endsection