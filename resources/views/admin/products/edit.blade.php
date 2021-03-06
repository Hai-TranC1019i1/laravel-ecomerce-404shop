@extends('layout.admin')
@section('title', 'Edit product')
@section('invalid-search', 'disabled')
@section('content')
    @if (session()->has('update-succ'))
        <div class="alert alert-success">{{ session()->get('update-succ') }}</div>
    @endif
    <form method="post" enctype="multipart/form-data" action="{{ route('admin.products.update', $product->id) }}">
        @csrf
        <div class="form-group">
            <label >Name</label>
            <input type="text" class="form-control @error('name') alert-danger @enderror"
                   name="name" value="{{ $product->name }}">
        </div>
        @error('name')
            <p class="text-danger">{{ $message }}</p>
        @enderror

        <div class="form-group">
            <label >Image</label><br>
            <img src="{{ asset("storage/".$product->image) }}" alt="" style="width: 100px">
            <input type="file" class="form-control @error('image') alert-danger @enderror"
                   name="image" value="">
        </div>
        @error('image')
        <p class="text-danger">{{ $message }}</p>
        @enderror

        <div class="form-group">
            <label >Price</label>
            <input type="text" class="form-control @error('price') alert-danger @enderror" name="price"
                   value="{{ number_format($product->price,0,'','.') }}">
        </div>
        @error('price')
        <p class="text-danger">{{ $message }}</p>
        @enderror

        <div class="form-group">
            <label for="">Category</label>
            <select name="category" class="custom-select @error('category') alert-danger @enderror">

                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                            @if ($category->id == $product->category()->first()->id)
                            selected
                            @endif>
                            {{ $category->name }}</option>

                @endforeach
            </select>
        </div>
        @error('category')
        <p class="text-danger">{{ $message }}</p>
        @enderror

        <div class="form-group">
            <label >Description</label>
            <textarea class="form-control @error('description') alert-danger @enderror" name='description'
                      rows="3">{{ $product->description }}</textarea>
        </div>
        @error('description')
        <p class="text-danger">{{ $message }}</p>
        @enderror

        <div class="form-group">
            <input type="submit" value="Update" class="btn btn-success">
            {{--            <a href="{{ route('admin.categories.index') }}">--}}
            {{--                <button>Cancel</button></a>--}}
        </div>
    </form>
@endsection

