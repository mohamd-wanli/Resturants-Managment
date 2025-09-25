<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait imageTrait
{
    public function upload(Request $request, string $path)
    {

        $file = $request->hasFile('image');
        if (! $file) {
            $image = time().'.'.$request->image->getClientOriginalExtension();

            $request->image->move(public_path($path), $image);

            return $path.'/'.$image;
        }
        if ($file) {

            $image = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path($path), $image);

            $destinationPath = public_path($path);
            $newImagePath = $destinationPath.'/'.$request->image;
            if (file_exists($newImagePath)) {

                unlink($newImagePath);

            }

            return $path.'/'.$image;
        }

    }
}
