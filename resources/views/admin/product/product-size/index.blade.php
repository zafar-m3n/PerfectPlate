@extends('layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Product Variants ({{ $product->name }})</h1>
        </div>

        <div>
            <a href="{{ route('product.index') }}" class="btn btn-primary my-3 ml-5">Go Back</a>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Create Product Size</h4>
                    </div>


                    <div class="card-body">
                        <form action="{{ route('product-size.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ old('name') }}">
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                        <input type="hidden" value="{{ $product->id }}" name="product_id">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Price</label>
                                        <input type="text" class="form-control" name="price"
                                            value="{{ old('price') }}">
                                        @if ($errors->has('price'))
                                            <span class="text-danger">{{ $errors->first('price') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary ml-4">Create</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card card-primary">

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>N0</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sizes as $size)
                                    <tr>
                                        <td>{{ ++$loop->index}}</td>
                                        <td>{{ $size->name }}</td>
                                        <td>{{ currencyPosition($size->price) }}</td>
                                        <td>
                                            <a href='{{ route('product-size.destroy', $size->id) }}'
                                                class='btn btn-danger delete-item mx-2'><i class='fas fa-trash'></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                @if (count($sizes) === 0)
                                    <tr>
                                        <td colspan='3' class="text-center">No data found!</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Create Product Option</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('product-option.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Name</label>
                                            <input type="text" class="form-control" name="name"
                                                value="{{ old('name') }}">
                                            @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                            <input type="hidden" value="{{ $product->id }}" name="product_id">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Price</label>
                                            <input type="text" class="form-control" name="price"
                                                value="{{ old('price') }}">
                                            @if ($errors->has('price'))
                                                <span class="text-danger">{{ $errors->first('price') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary ml-4">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card card-primary">

                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($options as $option)
                                        <tr>
                                            <td>{{ ++$loop->index}}</td>
                                            <td>{{ $option->name }}</td>
                                            <td>{{ currencyPosition($option->price) }}</td>
                                            <td>
                                                <a href='{{ route('product-option.destroy', $option->id) }}'
                                                    class='btn btn-danger delete-item mx-2'><i class='fas fa-trash'></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if (count($options) === 0)
                                        <tr>
                                            <td colspan='3' class="text-center">No data found!</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
        </div>
    </section>
@endsection
