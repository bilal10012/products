<!-- resources/views/options.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Options</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Options for {{ $product->name }}</h1>
    <table>
    <thead>
            <tr>
                @foreach($productvariant as $variant)
                    <th>{{ $variant->attribute }}</th>
                @endforeach
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach($options as $option)
                <tr>
                    @foreach($option->variant_values as $value)
                        <td>{{ $value }}</td>
                    @endforeach
                    <td>{{ $option->stock }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>


