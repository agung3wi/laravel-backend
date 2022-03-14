<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $path = $request->file('file')->store('files');
        return $path;
    }

    public function read($file)
    {
        $fileContent = Storage::get("files/" . $file);
        return response($fileContent, 200)
            ->header('Content-Type', 'image/png');
    }
}
