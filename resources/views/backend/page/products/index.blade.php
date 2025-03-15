@extends('backend.layout.main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Product</h1>
  </div>

  <h2>List Data Product</h2>
      <div class="table-responsive small">
        <a href="{{ route('tambah-data') }}" class="btn btn-primary">Tambah Data</a>
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Image</th>
              <th scope="col">name</th>
              <th scope="col">Stok</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($products as $paginate => $item)
                <tr>
                    <td>{{ $products->firstItem() + $paginate }}</td>
                    <td><img src="{{ $item->products_url }}" alt="{{ $item->name }}" width="70px"></td>
                    <td class="align-middle">{{ $item->name }}</td>
                    <td class="align-middle">
                        <div class="d-table-cell w-100">
                            <div class="text-center">
                                <span><bs>{{ $item->stock }}</bs></span> <br>
                            </div>
                            <button class="btn badge bg-info" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->id }}"> 
                                <i class="bx bx-detail me-2"></i> Update Stok
                            </button>
                        </div>
                    </td>
                    <td class="align-middle">
                        <div class="d-flex gap-1">
                            <a href="{{ route('product.edit', $item->id)  }}" class="btn btn-info btn-sm">Edit</a>
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <p>Tidak Ada Data</p>
                </tr>
            @endforelse
            
          </tbody>
        </table>

        {{ $products->links('pagination::bootstrap-5') }}
      </div>


      {{-- Modal Update Stok --}}
      @foreach ($products as $item)
      <div class="modal" id="exampleModal{{ $item->id }}" tabindex="-1" style="padding-top:0px ">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-name text-primary">Update Stok Produk Ini</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('updateStok', $item->id) }}" method="POST">
                @method('PUT')
                @csrf
                    <div class="modal-body" style="overflow-wrap: anywhere;">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Product</label>
                            <input type="text" class="form-control" id="name" value="{{ $item->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" class="form-control" name="stock" id="stock" value="{{ $item->stock }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                    
                        <button type="submit" class="btn btn-info">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
      </div>
    @endforeach

@endsection