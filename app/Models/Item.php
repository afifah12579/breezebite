<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;
   //protected $fillable = ['name','category','price','description','image' ];
   protected $guarded = [];

   public function menuItems() {
    // Ambil semua makanan dari database
    $items = Item::all();
    // Hantar ke fail blade 'menu_items'
    return view('admin.menu_items', compact('items'));
}
}
