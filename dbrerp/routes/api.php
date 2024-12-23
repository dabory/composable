<?php

use App\Services\Elasticsearch\ElasticsearchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/printing-curr-price', [App\Http\Controllers\Api\BlankerController::class, 'currPrice']);

Route::get('/projects', [App\Http\Controllers\Api\SodiumController::class, 'prjectIndex']);
Route::post('/projects', [App\Http\Controllers\Api\SodiumController::class, 'prjectStore']);
Route::put('/projects', [App\Http\Controllers\Api\SodiumController::class, 'prjectUpdate']);
Route::get('/projects/{id}', [App\Http\Controllers\Api\SodiumController::class, 'prjectShow']);
Route::delete('/projects', [App\Http\Controllers\Api\SodiumController::class, 'prjectDestroy']);


Route::post('/after-base64', [App\Http\Controllers\Api\SodiumController::class, 'store']);

Route::post('/send-images', [App\Http\Controllers\Api\SodiumController::class, 'imageTest']);

Route::post('/text-send', [App\Http\Controllers\Api\SodiumController::class, 'textSend']);

Route::post('/gate-token-get', [App\Http\Controllers\Api\GateTokenController::class, 'store']);

Route::post('/api23-cronjobs', [App\Http\Controllers\Api\Api23GateTokenController::class, 'api23Cronjobs']);
Route::post('/api23-js', [App\Http\Controllers\Api\Api23GateTokenController::class, 'api23Js']);
Route::post('/api23-app', [App\Http\Controllers\Api\Api23GateTokenController::class, 'api23App']);

Route::post('/auth/send-emailConfirm', [App\Http\Controllers\Api\Auth\VerifyController::class, 'sendEmailConfirm']);
Route::post('/auth/send-smsConfirm', [App\Http\Controllers\Api\Auth\VerifyController::class, 'sendSmsConfirm']);
Route::post('/auth/signup', [App\Http\Controllers\Api\Auth\SignupController::class, 'store']);

Route::post('/item-url-scrap', [App\Http\Controllers\Api\Scrap\ItemUrlScrapController::class, 'store']);

Route::post('/gate-token-get-test', [App\Http\Controllers\Api\GateTokenController::class, 'test']);

Route::post('/call-api', [App\Http\Controllers\Api\ApiController::class, 'send']);

Route::post('/send/text', [App\Http\Controllers\Api\TextSendController::class, 'store']);
Route::post('/send-mail', [App\Http\Controllers\Api\MailSendController::class, 'store']);
Route::post('/test-send-mail', [App\Http\Controllers\Api\MailSendController::class, 'testSend']);


Route::post('/elasticsearch', function (ElasticsearchService $elService) {
    $response = $elService->getQueryAll(request('query'));


    return response()->json($response);
});
