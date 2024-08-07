@extends('layout.auth')
@section('content')
<div class="page-content page-auth mt-5" id="register">
  <div class="section-store-auth" data-aos="fade-up">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-4">
          <h2>
            Memulai untuk jual beli <br />
            dengan cara terbaru
          </h2>
          <form class="mt-3" action="{{ route('auth.store') }}" method="POST">
            @csrf
            <div class="form-group">
              <label>Full Name</label>
              <input
                type="text"
                name="full_name"
                class="form-control @error('full_name')
                  is-invalid
                @enderror @if (old('full_name') != '' && !$errors->has('full_name'))
                  is-valid
                @endif"
                value="{{ old('full_name') }}"
                aria-describedby="nameHelp"
                v-model="name"
                autofocus
              />
              @error('full_name')
                <p class="text text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label>Email</label>
              <input
                type="email"
                name="email"
                class="form-control @error('email')
                  is-invalid
                @enderror @if (old('email') != '' && !$errors->has('email'))
                  is-valid
                @endif"
                value="{{ old('email') }}"
                aria-describedby="emailHelp"
                v-model="email"
              />
              @error('email')
                <p class="text text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" name="password" class="form-control  @error('password')
                  is-invalid
                @enderror @if (old('password') != '' && !$errors->has('password'))
                  is-valid
                @endif" />
              @error('password')
                <p class="text text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label>Store</label>
              <p class="text-muted">
                Apakah anda juga ingin membuka toko?
              </p>
              <div
                class="custom-control custom-radio custom-control-inline"
              >
                <input
                  class="custom-control-input @error('is_store_open')
                  is-invalid
                @enderror @if (old('is_store_open') != '' && !$errors->has('is_store_open'))
                  is-valid
                @endif"
                  type="radio"
                  name="is_store_open"
                  id="openStoreTrue"
                  v-model="is_store_open"
                  :value="true"
                />
                <label class="custom-control-label" for="openStoreTrue"
                  >Iya, boleh</label
                >
              </div>
              <div
                class="custom-control custom-radio custom-control-inline"
              >
                <input
                  class="custom-control-input  @error('is_store_open')
                  is-invalid
                @enderror @if (old('is_store_open') != '' && !$errors->has('is_store_open'))
                  is-valid
                @endif"
                  type="radio"
                  name="is_store_open"
                  id="openStoreFalse"
                  value="{{ old('is_store_open') }}"
                  v-model="is_store_open"
                  :value="false"
                />
                <label
                  makasih
                  class="custom-control-label"
                  for="openStoreFalse"
                  >Enggak, makasih</label
                >
              </div>
              @error('is_store_open')
                <p class="text text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group" v-if="is_store_open">
              <label>Nama Toko</label>
              <input
                type="text"
                name="store_name"
                value="{{ old('store_name') }}"
                class="form-control @error('store_name')
                  is-invalid
                @enderror @if (old('store_name') != '' && !$errors->has('store_name'))
                  is-valid
                @endif"
                aria-describedby="storeHelp"
              />
              @error('store_name')
                <p class="text text-danger">{{ $message }}</p>
              @enderror
            </div>
            <button type="submit" class="btn btn-success btn-block mt-4">
              Sign Up Now
            </button>
            <a href="{{ route('auth.login') }}" class="btn btn-signup btn-block mt-2">
              Back to Sign In
            </a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection