<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $product->name }}</title>


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

        .container {

            max-width: 900px;
            margin: auto;
            background: white;
            padding: 35px;
            border-radius: 25px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, .25);

        }

        .breadcrumb a {

            text-decoration: none;
            color: #667eea;
            font-weight: 600;

        }

        .header {

            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 25px 0;

        }

        h1 {

            color: #333;
            font-size: 34px;

        }

        .badge {

            display: inline-block;
            padding: 7px 15px;
            border-radius: 20px;
            font-size: 13px;
            margin-top: 10px;

        }

        .badge-active {

            background: #dcfce7;
            color: #166534;

        }

        .badge-inactive {

            background: #fee2e2;
            color: #991b1b;

        }

        .product-grid {

            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 35px;

        }

        .product-image-section {

            text-align: center;

        }

        .product-image {

            width: 100%;
            max-height: 450px;
            object-fit: cover;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .15);

        }

        .no-image {

            height: 400px;
            background: #eee;
            border-radius: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #999;

        }

        .detail-row {

            background: #f8f9ff;
            padding: 18px;
            border-radius: 15px;
            margin-bottom: 15px;

        }

        .detail-label {

            color: #777;
            font-size: 13px;
            text-transform: uppercase;

        }

        .detail-value {

            margin-top: 6px;
            font-size: 20px;
            font-weight: 700;
            color: #333;

        }

        .price {

            color: #16a34a;
            font-size: 28px;

        }

        .stock-good {

            color: #16a34a;

        }

        .stock-low {

            color: #ef4444;

        }

        .category-link {

            color: #667eea;
            text-decoration: none;

        }

        .actions {

            display: flex;
            gap: 12px;
            margin-top: 25px;

        }

        .btn {

            padding: 12px 20px;
            border-radius: 12px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            color: white;
            transition: .3s;

        }

        .btn:hover {

            transform: translateY(-3px);

        }

        .btn-edit {

            background: #f59e0b;

        }



        .btn-delete {

            background: #ef4444;

        }



        .btn-back {

            background: #64748b;

        }





        .info-box {

            margin-top: 30px;
            background: #eef6ff;
            padding: 20px;
            border-radius: 15px;
            border-left: 5px solid #667eea;

        }





        .metadata {

            margin-top: 20px;
            color: #777;
            padding-top: 20px;
            border-top: 1px solid #eee;

        }





        @media(max-width:768px) {


            .product-grid {

                grid-template-columns: 1fr;

            }



            .header {

                flex-direction: column;
                gap: 15px;

            }



            .actions {

                flex-direction: column;

            }


            .btn {

                text-align: center;

            }


        }
    </style>


</head>


<body>



    <div class="container">



        <div class="breadcrumb">

            <a href="{{ route('products.index') }}">
                ← Back to Products
            </a>

        </div>




        <div class="header">


            <div>


                <h1>{{ $product->name }}</h1>


                <span class="badge {{ $product->is_active ? 'badge-active' : 'badge-inactive' }}">


                    {{ $product->is_active ? '✓ Active' : '✗ Inactive' }}


                </span>


            </div>



            <div style="font-size:40px">

                📦

            </div>


        </div>
        <div class="product-grid">
            <div class="product-image-section">
                @if ($product->image)
                    <img src="{{ $product->image_url }}" class="product-image">
                    <p style="color:#777;margin-top:10px">
                        {{ $product->image }}
                    </p>
                @else
                    <div class="no-image">

                        No image available

                    </div>
                @endif
            </div>
            <div>
                <div class="detail-row">

                    <div class="detail-label">
                        Price
                    </div>
                    <div class="detail-value price">

                        ${{ number_format($product->price, 2) }}

                    </div>

                </div>
                <div class="detail-row">
                    <div class="detail-label">
                        Category
                    </div>
                    <div class="detail-value">
                        <a class="category-link" href="{{ route('categories.show', $product->category->id) }}">


                            {{ $product->category->name }}


                        </a>
                    </div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">

                        Stock

                    </div>


                    <div class="detail-value {{ $product->stock > 0 ? 'stock-good' : 'stock-low' }}">
                        {{ $product->stock }} units
                    </div>
                </div>
                <div class="actions">
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-edit">

                        Edit
                    </a>
                    <form method="POST" action="{{ route('products.destroy', $product->id) }}"
                        onsubmit="return confirm('Delete this product?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-delete">

                            Delete

                        </button>
                    </form>
                    <a href="{{ route('products.index') }}" class="btn btn-back">

                        Back
                    </a>
                </div>
            </div>
        </div>
        <div class="info-box">
            <strong>📋 Additional Information</strong>
            <br>
            <small>
                Created:
                {{ $product->created_at->format('F d, Y H:i') }}

                <br>
                Updated:
                {{ $product->updated_at->format('F d, Y H:i') }}
            </small>
        </div>







        <div class="metadata">


            <strong>Product ID:</strong>

            {{ $product->id }}


            &nbsp; | &nbsp;


            <strong>Category ID:</strong>

            {{ $product->category_id }}


        </div>





    </div>


</body>

</html>
