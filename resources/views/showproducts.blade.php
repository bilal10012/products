<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table with CRUD Operations</title>
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

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .btn {
            padding: 5px 10px;
            text-decoration: none;
            margin-right: 5px;
        }

        .btn-edit {
            background-color: #4CAF50;
            color: white;
        }

        .btn-delete {
            background-color: #f44336;
            color: white;
        }
    </style>
</head>

<body>
    <h2>Products List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
    @foreach ($products as $product)
    <tr>
        <td>{{ $product->id }}</td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->price }}</td>
        <td>
            @foreach ($product->categories as $category)
                {{ $category->name }}
                @if (!$loop->last)
                @endif
            @endforeach
        </td>
        <td>
            <a href="{{route('manage',$product->id)}}" class="btn btn-edit">Manage</a>
            <a href="#" class="btn btn-delete">Delete</a>
        </td>
    </tr>
    @endforeach
</tbody>

    </table>

    <script>
        // Add JavaScript logic here if needed
    </script>
</body>

</html>
