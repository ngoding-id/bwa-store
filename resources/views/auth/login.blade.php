@extends('layout.auth')
@section('content')
  <!-- Page Content -->
  <div class="page-content page-auth">
    <div class="section-store-auth" data-aos="fade-up">
      <div class="container">
        <div class="row align-items-center row-login">
          <div class="col-lg-6 text-center">
            <img
              src="/images/login-placeholder.png"
              alt=""
              class="w-50 mb-4 mb-lg-none"
            />
          </div>
          <div class="col-lg-5">
            <h2>
              Belanja kebutuhan utama, <br />
              menjadi lebih mudah
            </h2>
            <form class="mt-3" action="{{ route('auth.auth') }}" method="POST">
              @csrf
              <div class="form-group">
                <label>Email address</label>
                <input
                  type="email"
                  name="email"
                  value="{{ old('email') }}"
                  class="form-control w-75 @error('email') is-invalid @enderror"
                  aria-describedby="emailHelp"
                />
                @error('email')
                  <p class="text text-danger">{{ $message }}</p>
                @enderror
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control w-75 @error('password') is-invalid @enderror" />
              
                @error('password')
                  <p class="text text-danger">{{ $message }}</p>
                @enderror
              </div>
              <button
                class="btn btn-success btn-block w-75 mt-4"
                type="submit"
              >
                Sign In to My Account
              </button>
              <a class="btn btn-signup w-75 mt-2" href="{{ route('auth.register') }}">
                Sign Up
              </a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
<script>
  @if(session()->has('errorMessage'))
  Vue.use(Toasted);

  var register = new Vue({
    el: "#register",
    mounted() {
      AOS.init();
      this.$toasted.error(
        "{{ session()->get('errorMessage') }}",
        {
          position: "top-center",
          className: "rounded",
          duration: 1000,
        }
      );
    }
  });
  @endif
</script>
@endsection