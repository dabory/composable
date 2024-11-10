<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Print Preview</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ csset('/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">

    <script src="{{ csset('/js/main/jquery.min.js') }}"></script>
    <script src="{{ csset('/js/external/jquery-ui.js') }}"></script>
    <script src="{{ csset('/js/main/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ csset('/js/utils/distance.js') }}"></script>
    <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=1b0c21220a0a5d2f4f4869f1e182bb07&libraries=services"></script>
    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>

    <style>
        @media print {
            @page { margin: 0; }
            body { margin: 1.6cm; }
        }

        body {
            font-family: Arial, Helvetica, Gulim, sans-serif;
            font-size: 12px;
            line-height: 1.42857143;
            color: #000000;
            background-color: #ffffff;
        }
    </style>
</head>

<body>


<h1 class="mb-2 text-center text-danger">거리: <span id="distance"></span></h1>
<hr>

<div class="d-flex align-items-center flex-column">
    <div class="d-flex align-items-center">
        <h1 class="mb-0">가게위치</h1>
        <button onclick="getZipCode()" class="btn btn-primary mb-1 ml-2">
            가게위치 선택
        </button>
    </div>
    <div>
        <h1>주소: <span id="addr"></span></h1>
        <h1>위도: <span id="fromLat"></span></h1>
        <h1>경도: <span id="fromLon"></span></h1>
    </div>
    <div id="fromMap" style="margin: auto; width:800px; height:800px;"></div>
</div>

<div style="text-align: center;">
    <h1 style="margin-top: 30px;">현재위치</h1>
    <h1>위도: <span id="toLat"></span></h1>
    <h1>경도: <span id="toLon"></span></h1>
    <div id="toMap" style="margin: auto; width:800px; height:800px;"></div>
</div>



</body>

</html>


<script>
    function getZipCode(){
        new daum.Postcode({
            oncomplete: function(data) {
                document.getElementById('addr').innerHTML = data.roadAddress + `(${data.zonecode})`

                var geocoder = new kakao.maps.services.Geocoder();

                const { address } = data;
                geocoder.addressSearch(address, (result, status) => {
                    const { x, y } = result[0];

                    getLocation(y, x)
                });
            },
            width: "100%",
            height: window.innerHeight
        }).open();
    }

    const getLocation = (fromLat, fromLon) => {
        if (navigator.geolocation) {

            // GPS를 지원하면
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    // position 객체 내부에 timestamp(현재 시간)와 coords 객체
                    const time = new Date(position.timestamp);

                    test(fromLat, fromLon, 'fromMap')

                    document.getElementById('fromLat').innerHTML = fromLat;
                    document.getElementById('fromLon').innerHTML = fromLon;

                    const toLat = position.coords.latitude
                    const toLon = position.coords.longitude
                    test(toLat, toLon, 'toMap')

                    document.getElementById('toLat').innerHTML = toLat;
                    document.getElementById('toLon').innerHTML = toLon;

                    // const toLat = '35.13513513513514'
                    // const toLon = '129.087748126891'

                    const dist = distance(fromLat, fromLon, toLat, toLon);
                    document.getElementById('distance').innerHTML = dist + ' km';
                    // alert(`위도 : ${position.coords.latitude} 경도 : ${position.coords.longitude}`);

                    return position;
                },
                (error) => {
                    console.error(error);
                },
                {
                    enableHighAccuracy: true,
                    maximumAge: 30000,
                    timeout: 27000
                }
            );
        } else {
            alert("GPS를 지원하지 않습니다");
        }
    };

    function test(latitude, longitude, id) {
        var container = document.getElementById(id);
        var options = {
            center: new kakao.maps.LatLng(latitude, longitude),
            level: 3
        };

        var map = new kakao.maps.Map(container, options);

        var marker = new kakao.maps.Marker({
            // 지도 중심좌표에 마커를 생성합니다
            position: map.getCenter()
        });
// 지도에 마커를 표시합니다
        marker.setMap(map);
    }

</script>
