<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
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

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Product Details</h1>

    <h2>{{ $product->name }}</h2>
    <p><strong>Price:</strong> {{ $product->price }}</p>

    <h3>Stock:</h3>
    <!-- Display stock information -->

    <h3>Options:</h3>
    <table>
        <thead>
            <tr>
                <th>Variant</th>
                <th>Value</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
    @foreach($options as $option)
        @foreach($option->variants as $variantId => $variantValue)
            <tr>
                <td>{{ $variantValue }}</td> <!-- Display the variant value -->
                <td>{{ $option->value }}</td> <!-- Display the option value -->
                <td>{{ $option->stock }}</td> <!-- Display the stock -->
                <td>
                    <!-- Add actions here if needed -->
                </td>
            </tr>
        @endforeach
    @endforeach
</tbody>



    </table>

    <!-- Additional content or actions -->

</body>

</html>