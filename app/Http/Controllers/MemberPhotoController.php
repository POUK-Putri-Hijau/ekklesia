<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class MemberPhotoController extends Controller
{
    public function index($filename) {
        $path = 'member_photos/' . $filename;

        if (!Storage::exists($path)) {
            abort(404, 'Photo not found.');
        }

        $file = Storage::get($path);
        $mime = Storage::mimeType($path);

        return Response::make($file, 200, [
            'Content-Type' => $mime,
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
        ]);
    }
}
