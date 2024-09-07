@extends('layouts.master')
@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<section class="section">
    <div class="section-header">
      <h1>Profile</h1>
    </div>

    <div class="section-body">
        <div class="card card-primary">
            <div class="card-header">
              <h4>Update user Settings</h4>

              </div>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.update') }}"method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                        <div class="form-group">
                            <div id="image-preview" class="image-preview">
                                <label for="image-upload" id="image-label">Choose File</label>
                                <input type="file" name="avatar" id="image-upload" />
                              </div>
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}">
                  </div>

                  <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" name="email"value="{{ auth()->user()->email }}">
                  </div>
                 <button class="btn btn-primary" type="submit">Save</button>
                </form>
            </div>
          </div>

          <div class="card card-primary">
            <div class="card-header">
              <h4>Update Password</h4>

              </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.update.password') }}"method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Current Password</label>
                        <input type="password" class="form-control" name="current_password">
                      </div>
                    <div class="form-group">
                    <label>New Password</label>
                    <input type="password" class="form-control" name="password">
                  </div>
                  <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation">
                  </div>
                  <button class="btn btn-primary" type="submit">Save</button>

                </form>
            </div>
          </div>
    </div>
  </section>
@endsection
@push('scripts')

<script>
$(document).ready(function() {
    $('.image-preview').css({
        'background-image': 'url({{  asset(auth()->user()->Profile)}})'

    })
}
</script>

@endpush
