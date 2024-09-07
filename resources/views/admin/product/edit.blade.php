@extends('layouts.master')
@section('content')

<section class="section">
    <div class="section-header">
        <h1>Product</h1>
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h4>Update Product</h4>
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
        <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label>Image</label>
              <div id="image-preview" class="image-preview">
                <label for="image-upload" id="image-label">Choose File</label>
                <input type="file" name="image" id="image-upload" />
              </div>

            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{$product->name }}">
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label>Category</label>
                <select name="category" class="form-control select2" id="">
                    <option value="">select</option>
                    @foreach($categories as $category)
                    <option @selected($product->category_id === $category->id) value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @if($errors->has('category'))
                    <span class="text-danger">{{ $errors->first('category') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="text" name="price" class="form-control" value="{{ $product->price }}">
                @if($errors->has('price'))
                    <span class="text-danger">{{ $errors->first('price') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label>Offer Price</label>
                <input type="text" name="offer_price" class="form-control" value="{{ $product->offer_price }}">
                @if($errors->has('offer_price'))
                    <span class="text-danger">{{ $errors->first('offer_price') }}</span>
                @endif
            </div>

                <div class="form-group">
                    <label>Quantity</label>
                    <input type="text" name="quantity" class="form-control" value="{{ $product->quantity }}">
                </div>

            <div class="form-group">
                <label>Short Description</label>
                <textarea name="short_description" class="form-control">{!! $product->short_description !!}</textarea>
                @if($errors->has('short_description'))
                    <span class="text-danger">{{ $errors->first('short_description') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label>Long Description</label>
                <textarea name="long_description" class="form-control summernote">{!! $product->long_description !!}</textarea>
                @if($errors->has('long_description'))
                    <span class="text-danger">{{ $errors->first('long_description') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label>sku</label>
                <input type="text" name="sku" class="form-control" value="{{ $product->sku }}">
                @if($errors->has('sku'))
                    <span class="text-danger">{{ $errors->first('sku') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label>Seo Title</label>
                <input type="text" name="seo_title" class="form-control" value="{{ $product->seo_title }}">
                @if($errors->has('seo_title'))
                    <span class="text-danger">{{ $errors->first('seo_title') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label>Seo Description</label>
                <textarea name="seo_description" class="form-control">{!! $product->seo_description !!}</textarea>
                @if($errors->has('seo_description'))
                    <span class="text-danger">{{ $errors->first('seo_description') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label>Show at Home</label>
                <select name="show_at_home" class="form-control">
                    <option @selected($product->show_at_home === 1) value="1">Yes</option>
                    <option @selected($product->show_at_home === 0) value="0">No</option>
                </select>
                @if($errors->has('show_at_home'))
                    <span class="text-danger">{{ $errors->first('show_at_home') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option @selected($product->status === 1) value="1" >Active</option>
                    <option @selected($product->status === 0) value="0" >Inactive</option>
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</section>

@endsection

@push('scripts')

<script>
$(document).ready(function() {
    @if(isset($product->thumb_image))
    $('.image-preview').css({
        'background-image': 'url({{ asset($product->thumb_image) }})',
        'background-size': 'cover',
        'background-position': 'center center'
    });
    @endif
});
</script>

@endpush
