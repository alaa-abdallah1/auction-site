<?php

namespace App\Http\Controllers;

use \App\Models\Item;
use \App\Models\AutoBid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AutoBidController extends Controller
{
    public function delete(Item $item)
    {
        $bid = AutoBid::where('user_id', Auth::id())->where('item_id', $item->id);
        $bid->delete();
        return $item;
    }
}
