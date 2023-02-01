<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::doesnthave('cart')->where('stock', '>', 0)->get();
        $carts = Item::has('cart')->get()->sortByDesc('cart.create_at');
        // return $carts;
       return view('transaction', compact('items', 'carts'));
    }
    public function history(){
       $transactions = Transaction::get();
        return view('historytransaction', compact('transactions'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Cart::create($request->all());
        Session::flash('status', ' Berhasil Menambahkan  di Keranjang');
        return redirect('/transaction');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::find($id);
 $details = TransactionDetail::where('transaction_id', '=', $id)->get();
        return view('detailtransaction', compact('transaction', 'details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Cart::find($id)->update($request->all());
        return redirect()->back()->with('status', 'Berhasil Update');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $cart=Cart::findorfail($id);
        $cart->delete();
        Session::flash('status', 'Berhasil Hapus');
        return redirect('/transaction');
    }

    public function checkout(Request $request){
          $transaction =  Transaction::create($request->all());
            foreach(Cart::all() as $item){
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'item_id' => $item->item_id,
                    'qty' => $item->qty,
                    'subtotal' => $item->item->price * $item->qty
                ]);
                
            }
            Cart::truncate();
            return redirect(route('transaction.show', $transaction->id));
    }
    
  
}
