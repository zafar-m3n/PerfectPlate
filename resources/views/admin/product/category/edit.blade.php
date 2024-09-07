@extends('layouts.master')
@section('content')

<section class="section">
    <div class="section-header">
        <h1>Category</h1>
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h4>Update Category</h4>
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
        <form action="{{ route('category.update',$category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ $category->name }}">
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label>Show at Home</label>
                <select name="show_at_home" class="form-control">
                    <option @selected($category->show_at_home===1) value="1">Yes</option>
                    <option @selected($category->show_at_home===0)  value="0">No</option>
                </select>
                @if($errors->has('show_at_home'))
                    <span class="text-danger">{{ $errors->first('show_at_home') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option @selected($category->status===1)  value="1">Active</option>
                    <option @selected($category->status===0)  value="0">Inactive</option>
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</section>

@endsection
