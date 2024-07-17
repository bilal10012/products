<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Variants</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
    </style>
</head>
<body>
    <h1>Create Variants for Product: {{ $product->name }}</h1>
    <form method="POST" action="{{ route('store.variants') }}">
        @csrf
        <div id="variants-container">
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="text" name="name[]" class="variant-input" placeholder="Variant Name">
        </div>
        <button type="button" id="add-variant">Add More Variants</button>
        <br><br>
        <button type="submit">Submit</button>
    </form>
    <a href="{{ route('manage-values', $product->id) }}" class="btn btn-edit">See Attributes</a>
    <a href="{{ route('manage-attribute-values', $product->id) }}" class="btn btn-edit">Add Values to Attributes</a>

    <script>
        $(document).ready(function() {
            // Counter to track the number of input fields
            let counter = 1;

            // Event listener for the "Add More Variants" button
            $('#add-variant').click(function() {
                // Increment the counter
                counter++;

                // Create a new input field
                let newInput = `<input type="text" name="name[]" class="variant-input" placeholder="Variant Name ${counter}">`;

                // Append the new input field to the variants-container div
                $('#variants-container').append(newInput);
            });
        });
    </script>
</body>
</html>
