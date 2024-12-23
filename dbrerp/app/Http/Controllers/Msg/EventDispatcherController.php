<?php

namespace App\Http\Controllers\Msg;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ReflectionClass;

class EventDispatcherController extends Controller
{
    /**
     * 요청으로 전달된 이벤트를 실행합니다.
     */
    public function dispatchEvent(Request $request)
    {
        // 요청 데이터 검증
        $request->validate([
            'event_name' => 'required|string', // 이벤트 이름
            'event_data' => 'nullable|array', // 이벤트 데이터는 배열이어야 함
        ]);

        $eventName = $request->input('event_name');
        $eventData = $request->input('event_data', []); // 기본값으로 빈 배열

        // 이벤트 클래스 풀 네임 생성
        $eventClass = "App\\Events\\Notification\\$eventName";

        // 이벤트 클래스가 존재하는지 확인
        if (!class_exists($eventClass)) {
            return response()->json([
                'error' => true,
                'message' => "이벤트 [$eventName]를 찾을 수 없습니다.",
            ], 404);
        }

        try {
            // ReflectionClass로 이벤트 생성자를 검사
            $refClass = new ReflectionClass($eventClass);
            $constructor = $refClass->getConstructor();

            // 생성자가 없으면 기본적으로 인자를 전달하지 않고 호출
            if (!$constructor) {
                event(new $eventClass());
                return response()->json([
                    'error' => false,
                    'message' => "이벤트 [$eventName]가 성공적으로 호출되었습니다.",
                ]);
            }

            // 생성자 매개변수 분석
            $parameters = $constructor->getParameters();
            $args = [];

            foreach ($parameters as $parameter) {
                $paramName = $parameter->getName();
                $paramType = $parameter->getType();

                // 매개변수 타입 확인
                if ($paramType && $paramType->getName() === 'array') {
                    // 타입이 배열이면 전체 event_data를 전달
                    $args[] = $eventData;
                } elseif ($paramType) {
                    // 특정 타입(int, string 등)이 있으면 해당 키 값을 추출
                    $key = $paramName; // 파라미터 이름에 맞는 데이터를 사용
                    if (isset($eventData[$key])) {
                        $args[] = $eventData[$key];
                    } elseif ($parameter->isDefaultValueAvailable()) {
                        // 기본값이 있으면 사용
                        $args[] = $parameter->getDefaultValue();
                    } else {
                        // 필수 파라미터가 누락된 경우 에러 처리
                        return response()->json([
                            'error' => true,
                            'message' => "[$paramName] 파라미터가 event_data에 누락되었습니다.",
                        ], 400);
                    }
                } else {
                    // 타입이 없으면 기본값이나 null을 제공
                    if ($parameter->isDefaultValueAvailable()) {
                        $args[] = $parameter->getDefaultValue();
                    } else {
                        $args[] = null;
                    }
                }
            }

            // 이벤트 호출
            event($refClass->newInstanceArgs($args));

            return response()->json([
                'error' => false,
                'message' => "이벤트 [$eventName]가 성공적으로 호출되었습니다.",
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => "이벤트 호출 중 오류가 발생했습니다: " . $e->getMessage(),
            ], 500);
        }
    }
}
