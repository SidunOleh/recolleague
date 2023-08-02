<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class UpdateController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->all();

        foreach ($data as $key => $value) {
            if (
                is_string($value) and
                ! preg_match('/attachments\//', $value)
            ) {
                Content::saveText($key, $value);
            }
            if ($value instanceof UploadedFile) {
                Content::saveFile($key, $value);
            }
            if (is_array($value)) {
                Content::saveArray($key, $value);
            }
        }

        return response('OK');
    }
}
