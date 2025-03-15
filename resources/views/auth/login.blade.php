@extends('frontend.layout.app')

@section('content')
    <div class="my-5">
        <div class="card col-sm-7 m-auto">
            <div class="card-header text-center">
                <h3>Login Page</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('authenticate') }}" method="POST">
                    @csrf
                    <label for="email" class="form-label">email:</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email">
                        @error('email')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
    
                    <label for="password" class="form-label">Password:</label>
                    <div class="input-group mb-1">
                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
                        @error('password')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" onclick="myFunction()" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                            Tampilkan Password
                        </label>
                    </div>
    
                    <button type="submit" class="btn btn-primary">Login</button>
                   
    
                </form>
            </div>
        </div>
        <!-- END FORM -->
    </div>

@endsection

@push('js')
    <script>
        function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
        }
    </script>
@endpush