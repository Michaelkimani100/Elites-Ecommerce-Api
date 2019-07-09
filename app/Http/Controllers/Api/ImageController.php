<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Image;
use App\Product;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=array(
            'product_id' => 'required',
            'image' => 'required'
        );
        $this->validate($request,$rules);
        $file=$request->file('image');
        $extension=$file->getClientOriginalExtension();
        $path=Storage::disk('public')->put($file->getFilename().'.'.$extension,  File::get($file));

        //$url = Storage::url($path);
         $url=Storage::download($file);
        // $path1= response()->download($path);
        $image=Image::create([
            'product_id' => $request->input('product_id'),
            'image' => $url,
            'mine' =>$file->getClientMimeType(),
            'filename' =>$file->getFilename().'.'.$extension,
            'original_filename' =>$file->getClientOriginalName()
        ]);
        return response()->json($image);



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product=Product::with('images')->findOrFail($id);
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
