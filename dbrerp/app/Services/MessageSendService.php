<?php

namespace App\Services;


class MessageSendService
{
    public function send($title, $msg, $receiver)
    {
        $data = [
            'title' => $title,
            'msg' => $msg,
            'receiver' => $receiver,
        ];

        $request = request()->create('/dabory-app/send/text', 'POST', $data);

        return app()->handle($request);
    }
}
