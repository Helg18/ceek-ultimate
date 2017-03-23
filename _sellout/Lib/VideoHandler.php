<?php

namespace Sellout;

use Sellout\User;
use Sellout\Video;
use Carbon\Carbon;
use Sellout\PlayRight;

class VideoHandler
{
    protected $user;
    protected $video;
    protected $rights;

    public function __construct(User $user, Video $video=null)
    {
        $this->user = $user;
        $this->video = $video;
    }
    public function play(Video $video=null)
    {
        if(!is_null($video)) $this->video = $video;
        $rights = $this->_getUserVideoRights();
        $playable = $this->_validatePlayable($rights);
        if(!$playable) throw new \Exception("You must purchase a license to play this video.", 1);
        $this->_consumePlay($rights);
        return $this->_playVideo();
    }
    private function _playVideo()
    {
        return $this->video->url;
    }
    private function _consumePlay(PlayRight $rights)
    {
        if($rights->plays_unlimited || $rights->play_ends > Carbon::now())
        {
            return true;
        }
        else
        {
            return $rights->update([
                'plays_left' => $rights->plays_left - 1,
                'play_ends' => Carbon::now()->addDay()
            ]);
        }
    }
    private function _validatePlayable(PlayRight $rights)
    {
        if($rights->plays_unlimited || $rights->plays_left > 0 || $rights->play_ends > Carbon::now())
        {
            return true;
        }
        return false;
    }
    private function _getUserVideoRights()
    {
        return PlayRight::where('user_id', '=', $this->user->id)
            ->where('video_id', '=', $this->video->id)
            ->first();
    }
}
