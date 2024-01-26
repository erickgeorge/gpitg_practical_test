<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;

class DummyDataController extends Controller
{
    public function seedUsers(Request $request)
    {
        // number of users to  create based on the request data
        $count = $request->input('count', 10);

        User::factory()->count($count)->create();

        return response()->json(['message' => 'Users Added successfully']);
    }

    public function seedProducts(Request $request)
    {
        //  number of products  to create based on the request data
        $count = $request->input('count', 20);

        Product::factory()->count($count)->create();

        return response()->json(['message' => 'Products Added successfully']);
    }
}
