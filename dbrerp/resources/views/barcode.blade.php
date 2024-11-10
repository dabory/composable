<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Print Preview</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">

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
    <div style="padding: 5px; margin-top: 10px;">
        @forelse($response['Page'] ?? [] as $item)
            <div style="padding-bottom: 0;">
                <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($item['C1'], 'C128', 3,33) }}" width="147" height="50" alt="barcode"   />
                <div>{{ $item['C1'] }}</div>
            </div>
        @empty
        @endforelse
    </div>
</body>
</html>
