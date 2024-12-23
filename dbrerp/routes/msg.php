<?php

use App\Http\Controllers\Msg\EventDispatcherController;
use App\Http\Controllers\Msg\NotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// 알림 템플릿 생성 라우트
Route::post('/notification/template/add', [NotificationController::class, 'createTemplate']);
Route::post('/notification/template/modify', [NotificationController::class, 'modifyTemplate']);
Route::post('/notification/template/del', [NotificationController::class, 'delTemplate']);

// 알림 템플릿 검수 요청 라우트
Route::post('/notification/template/request', [NotificationController::class, 'requestTemplate']);
Route::post('/notification/template/list', [NotificationController::class, 'listTemplate']);

Route::post('/dispatch-event', [EventDispatcherController::class, 'dispatchEvent']);
