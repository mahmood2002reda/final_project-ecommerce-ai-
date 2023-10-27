<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Faker\Factory as Faker;
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function generateRandomEmail()
{
    $faker = Faker::create();
    $randomEmail = $faker->email;

    // Use the generated email as needed
    // ...

    return view('dressing')->with('randomEmail', $randomEmail);
}
}
