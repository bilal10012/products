<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <th>Product Varients</th>
        </thead>
        <tbody>
            @foreach ($variants as $variant )
            <tr>
                <td>
                    {{$variant->attribute}}
                </td>


            </tr>
            @endforeach
            
        </tbody>
    </table>
    
</body>
</html>