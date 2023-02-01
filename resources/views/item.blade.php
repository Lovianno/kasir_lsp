@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header bg-success text-light">{{ __('Master Item') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- {{ __('You are logged in!') }} --}}
                    <table class="table table-responsive table-stripped">
                        <thead class="thead-light">
                            <td>#</td>
                            <td>Kategori</td>
                            <td>Nama</td>
                            <td>Price</td>
                            <td>Stock</td>
                            <td>Action</td>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->category->name }}</td>
                            <td>{{ $item->name }}</td>
                            <td>Rp. {{ number_format($item->price) }}</td>
                            <td>{{ $item->stock }}</td>
                            <td>
                                <form action="{{ route('item.destroy', $item->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                <a href="{{ route('item.edit', $item->id) }}" class="btn btn-sm btn-success">EDIT</a>
                                
                                <input type="submit" class="btn btn btn-sm btn-danger" value="DELETE">
                            </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header bg-success text-light">{{ __('Add Item') }}</div>

                <div class="card-body">
                    @if (session('statuscreate'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (count($errors) > 0)

                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    {{-- {{ __('You are logged in!') }} --}}

                    <form action="{{ route('item.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <select name="category_id" id="" class="form-select form-control">
                                <option value="" selected>PILIH KATEGORI</option>
                                @foreach($categories as $item)
                                <option value="{{ $item->id }} ">{{ $item->name }}</option>
                                
                                @endforeach
                            </select>
                        </div>

                         <div class="form-group mt-3">
                        <input type="text" class="form-control " placeholder="Nama Item" name="name">
                        </div>

                        <div class="form-group mt-3">
                            <input type="number" class="form-control" placeholder="Price" name="price">
                        </div>
                        <div class="form-group mt-3">
                            <input type="number" class="form-control" placeholder="Stock" name="stock">
                        </div>
                        <div class="form-group mt-3">
                            <button  type="submit" class="btn btn-sm btn-success">Simpan</button>
                            <input type="reset" class="btn btn-sm btn-danger">
                        </div>

                        
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
