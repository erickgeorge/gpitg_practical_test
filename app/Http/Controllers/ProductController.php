 <?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\UserRating;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class ProductController extends Controller
{
    public function index()
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Retrieve products as in task 2 item 3
        $products = Product::with('ratings')->get();

        // Calculate average ratings and user ratings for each product  
        foreach ($products as $product) {
            $totalRatings = $product->ratings()->count();
            $sumRatings = $product->ratings()->sum('rating');
            $averageRating = $totalRatings > 0 ? $sumRatings / $totalRatings : 0;
            $product->average_rating = round($averageRating, 2);

            // Calculate user's rating for the product as in task 2 item 3.1
            $userRating = UserRating::where('product_id', $product->id)
                                    ->where('user_id', $user->id)
                                    ->first();
            $product->user_rating = $userRating ? $userRating->rating : null;

             // Calculate time passed for each rating as in task 2 item 3.2
            $latestRating = $product->ratings()->latest()->first();
            $product->time_passed = $latestRating ? Carbon::parse($latestRating->rating_datetime)->diffInMinutes() : null;


             // Calculate active time based on time passed for fixed 30 min as in task 2 item 3.3
            $product->active_time = $product->time_passed > 30 ? 'active' : 'inactive';
            
        }

        return response()->json(['products' => $products]);
    }
}

