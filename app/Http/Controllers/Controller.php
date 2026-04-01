<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use App\Models\Visitor;
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

public function index()
{
    $visitor = Visitor::firstOrCreate([], ['count' => 0]);

    if (!Session::has('visited')) {
        $visitor->increment('count');
        Session::put('visited', true);
    }

    return view('welcome', [
        'count' => $visitor->count
    ]);
}
}
