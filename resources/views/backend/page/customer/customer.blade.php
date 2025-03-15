@extends('backend.layout.main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Customer</h1>
  </div>

  <h2>List Data Customer</h2>
      <div class="table-responsive small">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Role</th>
              <th scope="col">Tgl Register</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($users as $paginate => $item)
                <tr>
                    <td>{{ $users->firstItem() + $paginate }}</td>
                    <td class="align-middle">{{ $item->name }}</td>
                    <td class="align-middle">{{ $item->email }}</td>
                    <td class="align-middle"> <span class="badge {{ $item->role == 'admin' ? 'bg-primary' : 'bg-info'  }}">{{ $item->role}}</span></td>
                    <td class="align-middle">{{ $item->created_at }}</td>
                </tr>
            @empty
                <tr>
                    <p>Tidak Ada Data</p>
                </tr>
            @endforelse
            
          </tbody>
        </table>

        {{ $users->links('pagination::bootstrap-5') }}
      </div>

@endsection