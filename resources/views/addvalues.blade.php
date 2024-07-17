<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Inputs Based on Attributes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        .form-group button {
            padding: 10px 15px;
            background-color: #28a745;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <h1>Values Input Based on Attributes</h1>
    <form method="POST" action="{{ route('form.submit') }}">
        @csrf
        <input type="hidden" name="product_id" id="product_id" value="{{ $products->id }}">
        @foreach($variants as $variant)
            <div class="form-group">
                <label for="{{ $variant->attribute }}">{{ ucfirst($variant->attribute) }}</label>
                <input type="text" id="{{ $variant->attribute }}" name="variants[{{ $variant->id }}][value]" required>
            </div>
        @endforeach
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" id="stock" name="stock" placeholder="Stock" required>
        </div>
        <div class="form-group">
            <button type="submit">Submit</button>
        </div>
    </form>
</body>
</html>
