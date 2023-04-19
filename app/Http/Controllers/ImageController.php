<?php

namespace App\Http\Controllers;

use App\Image;

class ImageController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {        
        return view('user.partials._show-image', compact('image'));
    }
}
