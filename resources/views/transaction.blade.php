@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header bg-success text-light">{{ __('Master Item') }}</div>

                <div class="card-body">
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif --}}

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
                            @if($items->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center bg-success text-light">KOSONG BRO</td>
                            </tr>
                            @else
                            @foreach($items as $item)
                            <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->category->name }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ number_format($item->price) }}</td>
                            <td>{{ $item->stock }}</td>
                            <td>
                                 <form action="{{ route('transaction.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden"value="{{ $item->id }}" name="item_id">
                                    <input type="hidden" min="0" name="qty" value="1"class="form-control" >
                                <button type="submit" class="btn btn-sm btn-warning text-light">Add</button>
                            </form>

                            </td>
                        </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header bg-success text-light">{{ __('Cart') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- {{ __('You are logged in!') }} --}}

                    <table class="table table-responsive">
                        <thead>
                            <th>#</th>
                            <th>Name</th>
                            <th class="col-md-3 text-center">Qty</th>
                            <th class="col-md-3 text-center">Subtotal</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @if($carts->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center">KERANJANG KOSONG</td>
                            </tr>
                            @else
                            @foreach ($carts as $item)
                             
                            <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td> 
                             <form action="{{ route('transaction.update', $item->cart->id) }}" method="POST">
                                @csrf
                                @method('put')
                                    <input type="number" min="0" max="{{ $item->stock + $item->cart->qty}}"onchange="update{{ $loop->iteration }}()" class="form-control" value="{{ $item->cart->qty }}" name="qty">
                            </td>
                            <td class="text-center">Rp. {{ number_format( $item->price * $item->cart->qty )}}</td>

                            <td>
                                <input type="submit" class="btn btn-sm btn-warning text-light" style="display:none" value="Update" id="ubah{{ $loop->iteration }}">
                                 </form>

                                <form action="{{ route('transaction.destroy', $item->cart->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                <input type="submit" class="btn btn-sm btn-danger text-light" title="Hapus" value="X" id="hapus{{ $loop->iteration }}"style="display:">
                                </form>
                            </td>
                        </tr>
                        <script>
                            function update{{ $loop->iteration }}(){
                                document.getElementById("ubah{{ $loop->iteration }}").style.display = "inline";
                                document.getElementById("hapus{{ $loop->iteration }}").style.display = "none";
                        
                            }
                        </script>
                        @endforeach
                        @endif

                            <form action="{{ route('checkout.transaction') }}" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ Auth()->user()->id }}">
                                <input type="hidden" name='date' value="{{ date('Y-m-d') }}"> 
                                <tr>
                                    <td colspan="3" class="text-end"> Total</td>
                                    <td colspan="2"><input type="number" readonly name="total" id="" class="form-control" value="{{ $carts->sum(function($item){return $item->price*$item->cart->qty; }) }}"></td>
                                    <td></td><td></td>
                                </tr>
                                <tr>
                                    <td colspan="3"class="text-end"> Payment</td>
                                    <td colspan="2"><input type="number" min="{{ $carts->sum(function($item){return $item->price*$item->cart->qty; }) }}" required name="pay_total" id="" class="form-control"></td>
                                    <td></td><td></td>

                                </tr>
                               


                        </tbody>
                        
                    </table>
                          <button type="submit" class="btn btn-primary">Checkout</button>
                             <input type="reset" class="btn btn-danger" value="Cancel">
                </form>

   
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
