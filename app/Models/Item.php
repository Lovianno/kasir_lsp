<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $table = 'items';
    // protected $fillable = [
    //     'category_id',
    //     'name',
    //     'price',
    //     'stock'

    // ];
    protected $guarded = [];


    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function cart(){
        return $this->hasOne(Cart::class);
    }
    
    public function transaction(){
        return $this->hasManyThrough(Transaction::class, TransactionDetail::class);
    }
}
