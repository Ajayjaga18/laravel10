@extends('admin.layouts.app')
@section('content')
    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="assets/img/logo.png" alt="">
                                    <span class="d-none d-lg-block">NiceAdmin</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Forget Password to Your Account</h5>
                                        <p class="text-center small">Enter your Email</p>
                                    </div>

                                    <form action="{{ route('updatePassword') }}" method="post"
                                        class="row g-3 needs-validation" novalidate>
                                        @csrf
                                        <div class="col-12">
                                            <label for="passwood" class="form-label">Password</label>
                                            <div class="input-group has-validation">
                                                <input type="hidden" name="id" value="{{$user->id}}">
                                                <input type="text" name="passwood" value="{{ old('passwood') }}"
                                                    class="form-control" id="passwood" required>
                                                <div class="invalid-feedback">Please enter your passwood.</div>
                                            </div>
                                            @error('passwood')
                                                <span style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label for="c_passwood" class="form-label">Confirm Password</label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="c_passwood" value="{{ old('c_passwood') }}"
                                                    class="form-control" id="c_passwood" required>
                                                <div class="invalid-feedback">Please enter your c_passwood.</div>
                                            </div>
                                            @error('c_passwood')
                                                <span style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Forget Passwoord Mail
                                                Send</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Don't have account? <a href="{{ route('login') }}">Create
                                                    an account</a></p>
                                        </div>
                                    </form>

                                </div>
                            </div>



                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->
@endsection
