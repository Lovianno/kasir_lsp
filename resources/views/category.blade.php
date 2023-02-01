@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header bg-success text-light">{{ __('Master Category') }}</div>

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
                            <td>Nama</td>
                            <td>Action</td>
                        </thead>
                        <tbody>
                            @foreach ($categories as $item)
                            <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <form action="{{ route('category.destroy', $item->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                <a href="{{ route('category.edit', $item->id) }}" class="btn btn-sm btn-success">EDIT</a>
                                
                                <button type="submit" class="btn btn-sm btn-danger">DELETE</button>
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
                <div class="card-header bg-success text-light">{{ __('Add Category') }}</div>

                <div class="card-body">
                    @if (session('statuscreate'))
                        <div class="alert alert-success" role="alert">
                            {{ session('statuscreate') }}
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

                    <form  method="post" action="{{ route('category.store') }}">
                        @csrf
                        <div class="form-group">
                        <input type="text" class="form-control" placeholder="Nama Kategori" name="name">
                        </div>
                        <div class="form-group mt-3">
                            <button class="btn btn-sm btn-success" type="submit">Simpan</button>
                            <input type="reset" class="btn btn-sm btn-danger">
 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
