<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        .product-form {
            margin-bottom: 20px;
        }

        .product-form input,
        .product-form select {
            display: block;
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            font-size: 16px;
        }

        .product-list {
            list-style: none;
            padding: 0;
        }

        .product-item {
            padding: 10px;
            border: 1px solid #ddd;
            margin-bottom: 10px;
        }

        .delete-button {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Product Management</h1>

        <div class="product-form">

            <h2>Add Product</h2>
            <form method="POST" action="{{ route('create') }}" id="productForm">
                @csrf
                <input type="text" name="name" placeholder="Product Name" required>
                <textarea hidden name="slug" placeholder="slug"></textarea>
                <input type="number" name="price" placeholder="Product Price" required>
                <label for="categories">Select Categories:</label>
                <select name="category_ids[]" id="categories" multiple>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <button type="submit">Add Product</button>
            </form>

        </div>


    </div>
</body>

</html>