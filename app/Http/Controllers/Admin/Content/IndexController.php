<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Models\Content;

class IndexController extends Controller
{
    public function __invoke()
    {
        return Content::getFormatted();
    }
}
