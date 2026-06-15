<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Product</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        body {
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea, #764ba2);
            padding: 40px 20px;
        }


        /* Card */

        .container {

            max-width: 650px;
            margin: auto;
            background: white;
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, .25);

        }


        /* Title */

        h1 {

            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 30px;

        }


        /* Form */

        .form-group {

            margin-bottom: 22px;

        }


        label {

            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #444;

        }


        input[type="text"],
        input[type="email"],
        input[type="number"],
        input[type="file"],
        select,
        textarea {

            width: 100%;
            padding: 13px;
            border-radius: 10px;
            border: 2px solid #e5e7eb;
            background: #fafafa;
            font-size: 15px;
            transition: .3s;

        }


        input:focus,
        select:focus,
        textarea:focus {

            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 10px rgba(102, 126, 234, .25);

        }



        /* Checkbox */

        .checkbox-group {

            display: flex;
            align-items: center;
            gap: 10px;
            background: #f5f6ff;
            padding: 12px;
            border-radius: 10px;

        }


        input[type="checkbox"] {

            width: 18px;
            height: 18px;
            cursor: pointer;

        }


        /* Help */

        .help-text {

            font-size: 13px;
            color: #777;
            margin-top: 5px;

        }



        /* Buttons */

        .buttons {

            display: flex;
            gap: 15px;
            margin-top: 30px;

        }


        button,
        .btn-cancel {

            flex: 1;
            padding: 14px;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            transition: .3s;

        }


        button[type="submit"] {

            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;

        }


        button[type="submit"]:hover {

            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, .4);

        }



        .btn-cancel {

            background: #ef4444;
            color: white;

        }


        .btn-cancel:hover {

            background: #dc2626;
            transform: translateY(-3px);

        }



        /* Error */

        .errors {

            background: #ffe4e6;
            border: 1px solid #fb7185;
            color: #9f1239;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;

        }


        .errors ul {

            margin-left: 20px;

        }


        .error-message {

            color: #e11d48;
            font-size: 14px;
            margin-top: 5px;

        }



        /* Mobile */

        @media(max-width:600px) {


            .container {

                padding: 25px;

            }


            .buttons {

                flex-direction: column;
            }
            h1 {
                font-size: 24px;
            }
        }
    </style>

</head>
<body>

    <div class="container">

        <h1>➕ Create Product</h1>
        @if ($errors->any())
            <div class="errors">
                <strong>Validation errors:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif
        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="category_id">Category *</label>
                <select id="category_id" name="category_id" required>
                    <option value="">-- Select Category --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Product Name *</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                    placeholder="e.g., MacBook Pro M3" required>
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="price">Price (USD) *</label>
                <input type="number" id="price" name="price" value="{{ old('price') }}" placeholder="0.00"
                    step="0.01" min="0" required>
                @error('price')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="stock">Stock Quantity *</label>
                <input type="number" id="stock" name="stock" value="{{ old('stock') }}" placeholder="0"
                    min="0" required>
                @error('stock')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="image">Product Image</label>
                <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/gif">
                <div class="help-text">
                    Formats: JPEG, PNG, GIF. Max 2MB
                </div>
                @error('image')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <div class="checkbox-group">
                    <input type="checkbox" id="is_active" name="is_active" value="1"
                        {{ old('is_active') ? 'checked' : '' }}>
                    <label for="is_active">
                        Active (Available for sale)
                    </label>
                </div>
                @error('is_active')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="buttons">
                <button type="submit">

                    Save Product

                </button>
                <a href="{{ route('products.index') }}" class="btn-cancel">

                    Cancel
                </a>
            </div>


        </form>


    </div>


</body>

</html>
