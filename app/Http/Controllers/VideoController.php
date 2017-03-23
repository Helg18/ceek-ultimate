<?php

namespace App\Http\Controllers\V1;

use Auth;
use Sellout\Image;
use Sellout\Video;
use App\Http\Requests;
use App\Http\Requests\ImageRequest;
use App\Http\Controllers\Controller;

class VideoController extends Controller
{
    protected $eagerLoad = [
        'rating.agency',
        'categories',
        'image'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return response()->json(['videos' => Video::with($this->eagerLoad)->get()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return response()->json(['video' => Video::with($this->eagerLoad)->find($id)]);
    }
    /**
     * Set specified image as poster image of a video
     *
     * @param  int  $id
     * @return Response
     */
    public function storeImage(ImageRequest $input, $id)
    {
        $video = Video::findOrFail( $id );
        $image = Image::create( $input->all() );
        $image->video()->associate( $video )->save();
        return response()->json(['video' => Video::with($this->eagerLoad)->find($id)]);
    }
    public function play($mid)
    {
        $video = Video::where('mid', '=', $mid)->first();
        return $video->play(Auth::user());
    }
}
