<?php

namespace App\Http\Controllers\Msg;

use App\Http\Controllers\Controller;
use App\Interfaces\NotificationServiceInterface;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationServiceInterface $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function listTemplate(Request $request)
    {
        return response()->json($this->notificationService->listTemplate());
    }

    public function createTemplate(Request $request)
    {
        $data = $request->all();
        return response()->json($this->notificationService->createTemplate($data));
    }

    public function modifyTemplate(Request $request)
    {
        $data = $request->all();
        return response()->json($this->notificationService->modifyTemplate($data));
    }

    public function delTemplate(Request $request)
    {
        $data = $request->all();
        return response()->json($this->notificationService->delTemplate($data));
    }

    public function requestTemplate(Request $request)
    {
        $data = $request->all();
        return response()->json($this->notificationService->requestTemplate($data));
    }
}
