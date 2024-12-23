<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        @font-face{
            font-family: 'NanumGothic-Regular';
            src: url("{{ storage_path('fonts/NanumGothic-Regular.ttf') }}") format('truetype');
        }

        @font-face{
            font-family: 'NanumGothic-Bold';
            src: url("{{ storage_path('fonts/NanumGothic-Bold.ttf') }}") format('truetype');
        }

        * {
            font-family: 'NanumGothic-Regular', 'NanumGothic-Bold';
        }

        .table-row th {
            text-align: center;
            padding: 8px 15px;
            background-color: #5c6bc0;
            color: white;
            border-right: 1px #ddd solid;
            font-weight: 400;
        }

        .table-col, .table-row { width: 100%; }

        .table-row td {
            text-align: center;
            border-bottom: 1px #ddd solid;
            border-right: 1px #ddd solid;
        }
        .table-row tr td:first-child { border-left: 1px #ddd solid; }
    </style>
</head>

<body>
    <div class="table-responsive mt-2">
        <table class="table-row">
            <thead id="table-head">
                <tr>
                    @foreach ($table['head'] as $title)
                        <th>{{ $title }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody id="table-body">
                @foreach ($table['body'] as $data)
                    <tr>
                        @foreach ($data as $title)
                            <td>{{ $title }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
