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
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    {{-- {{ __('You are logged in!') }} --}}

                    <form action="{{ route('category.update', $category->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                        <input type="text" class="form-control" placeholder="Nama Kategori" name="name" value="{{ $category->name }}">
                        </div>
                        <div class="form-group mt-3">
                            <button  type="submit" class="btn btn-sm btn-success">Simpan</button>
                            <input type="reset" class="btn btn-sm btn-warning text-light">
                            <a href="/category" class="btn btn-sm btn-danger">Kembali</a>

                        </div>

                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
