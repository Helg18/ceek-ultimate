<?php

namespace Sellout;

use Mail;

class MailHandler
{
    protected $devEmail = [
        "lee.hilton@hipstercreative.com",
        "sean@hipstercreative.com",
    ];
    public $type;
    public $user;
    public $to;
    public $replyTo;
    public $replyName;
    public $attachments;
    public $receipt;
    public $other;

    public function send()
    {
        $to = $this->_getToAddress($this->to);
        $subject = $this->_getSubject($this->type);
        $body = $this->_getBody($this->type);
        // $attachments = $this->_getAttachments($this->attachments);
        $replyTo = $this->_getReplyTo($this->replyTo);
        $replyName = $this->_getReplyName($this->replyName);
        return $this->_sendMail($to, $replyTo, $replyName, $subject, $body);
    }
    private function _sendMail($to, $replyTo, $replyName, $subject, $body)
    {
        return Mail::raw($body, function($message) use ($to, $replyTo, $replyName, $subject, $body) {
            $message->to($to);
            if(env('APP_DEBUG' === true)) $message->bcc($this->devEmail);
            $message->replyTo($replyTo, $replyName);
            $message->subject($subject);
        });
    }
    private function _getReplyName($replyName)
    {
        return $replyName === null
            ? 'Dolorem Ipsum'
            : $replyName;
    }
    private function _getReplyTo($replyTo)
    {
        return $replyTo === null
            ? 'ipsum@email.host'
            : $replyTo;
    }
    private function _getBody($type)
    {
        $body['ceek_welcome'] = 'Enjoy the show!';
        $body['receipt'] = 'Thank you.';
        $body['reset'] = 'Please click on the link to reset your password: '.$this->other;
        return !is_null($body[$type])
            ? $body[$type]
            : null;
    }
    private function _getSubject($type)
    {
        $subject['ceek_welcome'] = 'Welcome to Ceek';
        $subject['receipt'] = 'I see you bought stuff';
        $subject['reset'] = 'Password reset';
        return !is_null($subject[$type])
            ? $subject[$type]
            : null;
    }
    private function _getToAddress($to)
    {
        return $to === null
            ? $this->user->email
            : $to;
    }
}
