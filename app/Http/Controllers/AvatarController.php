<?php

namespace App\Http\Controllers\V1;

use Auth;
use Sellout\User;
use App\Http\Requests;
use App\Http\Requests\AvatarRequest;
use App\Http\Controllers\Controller;

class AvatarController extends Controller
{
    // protected $eagerLoad = ['profileImage', 'avatar', 'images'];
    protected $eagerLoad = ['avatar'];

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(AvatarRequest $request)
    {
        $avatar = Auth::user()->avatar;
        $avatar->update($request->all());
        return Auth::user()->load($this->eagerLoad);
    }
}
