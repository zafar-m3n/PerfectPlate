@extends('layouts.master')
@section('content')

<section class="section">
    <div class="section-header">
        <h1>Slider</h1>
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h4>Create Slider</h4>

            </div>
        </div>
    <!-- Flash Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Validation Error Messages -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <div class="card-body">
            <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Image</label>
                    <div id="image-preview" class="image-preview">
                        <label for="image-upload" id="image-label">Choose File</label>
                        <input type="file" name="image" id="image-upload" />
                    </div>
                <div class="form-group">
                    <label>Offer</label>
                    <input type="text" name="offer" class="form-control">
                </div>
                <div class="form-group">
                  <label>Title</label>
                  <input type="text" name="title" class="form-control">
                </div>
                <div class="form-group">
                  <label>Sub Title</label>
                  <input type="text" name="sub_title"class="form-control">
                </div>
                <div class="form-group">
                  <label>Short description</label>
                  <textarea name="short_description" class="form-control"></textarea>
                </div>
                <div class="form-group">
                  <label>Button Link</label>
                  <input type="text" name="button_link" class="form-control">
                </div>
                <div class="form-group">
                  <label>Status</label>
                  <select name="status" class="form-control" id="">
                    <option value="1">yes</option>
                    <option value="0">no</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</section>

@endsection
