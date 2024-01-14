<?php

use App\Models\Category;
use App\Models\Cart;
use App\Models\Wishlist;

function getCategory()
{
    return Category::orderBy('name','ASC')
            ->with('subcategory')
            ->where('status','1')
            ->get();
}

function getLikes()
{
    if(auth()->user())
    {
        $user_id = auth()->user()->id;

        $userWishlist = Wishlist::where('user_id',$user_id)->get();

        return $userWishlist;
    }
    $userWishlist = null;
    return $userWishlist;
    
}