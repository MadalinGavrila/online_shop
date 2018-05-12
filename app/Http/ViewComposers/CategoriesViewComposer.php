<?php

namespace App\Http\ViewComposers;

use App\Category;
use Illuminate\View\View;

class CategoriesViewComposer
{
    public function compose(View $view)
    {
        $view->with([
            'categories' => Category::has('subCategories')->get()
        ]);
    }
}