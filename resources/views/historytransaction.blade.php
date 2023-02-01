@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
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
                            <td>Date</td>
                            <td>Total Transaction</td>
                            <td>Pay Total</td>
                            <td>Served By</td>
                            <td>Action</td>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                
                            <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $transaction->date }}</td>
                            <td>{{ $transaction->total }}</td>
                            <td>{{ $transaction->pay_total }}</td>
                            <td>
                                {{ $transaction->user->name }}
                            </td>
                            <td>
                                                                    
                 <a type="button" href="{{ route('transaction.show', $transaction->id) }}" class="btn btn-sm btn-primary text-light">Detail</a>
                            </td>
                        </tr>
                        @endforeach

                        </tbody>
                    </table>


                </div>
            </div>
        </div>
        
    </div>
</div>
<script>
    function update(){
        document.getElementById("ubah").style.display = "inline";
        document.getElementById("hapus").style.display = "none";

    }
</script>
@endsection
