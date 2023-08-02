<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Content;

class HomeController extends Controller
{
    public function __invoke()
    {
        $content = Content::getFormatted();

        return view('pages.home', compact('content'));
    }
}
