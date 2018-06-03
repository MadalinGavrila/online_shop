<?php

namespace App\Http\Controllers;

use App\Notifications\ReviewPosted;
use App\Product;
use App\Review;
use App\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'review' => 'required',
            'rating' => 'required'
        ]);

        $product = Product::find($request->product_id);

        $review = new Review();
        $review->body = $request->review;
        $review->rating = $request->rating;
        $review->user()->associate($request->user());

        $product->reviews()->save($review);

        $admins = User::admins();

        foreach($admins as $admin){
            $admin->notify(new ReviewPosted($review));
        }

        return redirect()->back()->withSuccess('Your review has been created !');
    }
}
