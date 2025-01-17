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

                  <div class="col-12">
                    {{-- <button class="btn btn-primary w-100" type="submit">Forget Passwoord Mail Send</button> --}}
                    {{-- <a href="{{ route('updatePasswordBladeFile', $user->id)}}">this is blade file</a> --}}
                  </div>

                </div>
              </div>



            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

@endsection
