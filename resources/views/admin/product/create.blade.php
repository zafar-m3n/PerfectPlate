@extends('layouts.master')
@section('content')

<section class="section">
    <div class="section-header">
        <h1>Product</h1>
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h4>Create Product</h4>
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

    <div class="card-body">
        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
              <label>Image</label>
              <div id="image-preview" class="image-preview">
                <label for="image-upload" id="image-label">Choose File</label>
                <input type="file" name="image" id="image-upload" />
              </div>

            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label>Category</label>
                <select name="category" class="form-control select2" id="">
                    <option value="">select</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @if($errors->has('category'))
                    <span class="text-danger">{{ $errors->first('category') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="text" name="price" class="form-control" value="{{ old('price') }}">
                @if($errors->has('price'))
                    <span class="text-danger">{{ $errors->first('price') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label>Offer Price</label>
                <input type="text" name="offer_price" class="form-control" value="{{ old('offer_price') }}">
                @if($errors->has('offer_price'))
                    <span class="text-danger">{{ $errors->first('offer_price') }}</span>
                @endif
            </div>

                <div class="form-group">
                    <label>Quantity</label>
                    <input type="text" name="quantity" class="form-control" value="{{ old('quantity') }}">
                </div>

            <div class="form-group">
                <label>Short Description</label>
                <textarea name="short_description" class="form-control">{{  old('short_description') }}</textarea>
                @if($errors->has('short_description'))
                    <span class="text-danger">{{ $errors->first('short_description') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label>Long Description</label>
                <textarea name="long_description" class="form-control summernote">{{ old('long_description') }}</textarea>
                @if($errors->has('long_description'))
                    <span class="text-danger">{{ $errors->first('long_description') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label>sku</label>
                <input type="text" name="sku" class="form-control" value="{{ old('sku') }}">
                @if($errors->has('sku'))
                    <span class="text-danger">{{ $errors->first('sku') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label>Seo Title</label>
                <input type="text" name="seo_title" class="form-control" value="{{ old('seo_title') }}">
                @if($errors->has('seo_title'))
                    <span class="text-danger">{{ $errors->first('seo_title') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label>Seo Description</label>
                <textarea name="seo_description" class="form-control">{{ old('seo_description') }}</textarea>
                @if($errors->has('seo_description'))
                    <span class="text-danger">{{ $errors->first('seo_description') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label>Show at Home</label>
                <select name="show_at_home" class="form-control">
                    <option value="1" {{ old('show_at_home') == 1 ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('show_at_home') === '0' ? 'selected' : '' }}>No</option>
                </select>
                @if($errors->has('show_at_home'))
                    <span class="text-danger">{{ $errors->first('show_at_home') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>Inactive</option>
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>

    </div>
</section>

@endsection
