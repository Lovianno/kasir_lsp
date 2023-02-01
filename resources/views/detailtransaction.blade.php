@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Detail Transaction') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- {{ __('You are logged in!') }} --}}

                    <table class="table">
                        <tr>
                            <td class="col-md-2">{{ $transaction->created_at }}</td>
                        </tr>
                        <tr>
                            <td class="col-md-2">Served By : {{ $transaction->user->name }} </td>
                        </tr>
                    </table>
                    <table class="table table-responsive table-stripped table-bordered">
                        <thead class="thead-light"> 
                            <td>#</td>
                            <td>Item Name</td>
                            <td>Qty</td>
                            <td>Price</td>
                            <td>Subtotal</td>
                        </thead>
                        <tbody>
                            @foreach ($details as $item)
                                
                            <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->item->name }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>{{ $item->item->price }}</td>
                            <td>
                               {{ $item->subtotal }}
                            </td>
                        </tr>
                        @endforeach

                        <tr>
                            <td colspan="4" class="text-end">GranTotal</td>
                            <td>{{ $transaction->total }}</td>
                        </tr>
                        <tr>
                            <td colspan="4"class="text-end">Pay Total</td>
                            <td>{{ $transaction->pay_total }}</td>
                        </tr>
                        <tr>
                            <td colspan="4"class="text-end">Change</td>
                            <td>{{ $transaction->pay_total - $transaction->total }}</td>
                        </tr>
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
