<?php

use App\Models\Category;

function getCategory()
{
    return Category::orderBy('name','ASC')
            ->with('subcategory')
            ->where('status','1')
            ->get();
}