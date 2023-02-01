@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
       
        <div class="col-md-5">
            <div class="card">
                <div class="card-header bg-success text-light">{{ __('Edit Category') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (count($errors) > 0)

                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    {{-- {{ __('You are logged in!') }} --}}

                    <form action="{{ route('item.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <select name="category_id" id="" class="form-select form-control">
                                <option value="">PILIH KATEGORI</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if($category->id == $item->category->id) selected @endif>{{ $category->name }} </option>
                                    
                                @endforeach
                            </select>
                        </div>

                         <div class="form-group mt-3">
                        <input type="text" class="form-control " placeholder="Nama Item" name="name" value="{{ $item->name }}">
                        </div>

                        <div class="form-group mt-3">
                            <input type="number" class="form-control" placeholder="Price" name="price" value="{{ $item->price }}">
                        </div>
                        <div class="form-group mt-3">
                            <input type="number" class="form-control" placeholder="Stock" name="stock" value="{{ $item->stock }}">
                        </div>
                        <div class="form-group mt-3">
                            <input  type="submit" class="btn btn-sm btn-success" value="submit">
                            <input type="reset" class="btn btn-sm btn-warning text-light">
                            <a href="/item" class="btn btn-sm btn-danger">Kembali</a>
                        </div>

                        
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
