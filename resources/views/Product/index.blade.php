<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Products</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}


body{

    font-family:'Segoe UI',sans-serif;
    min-height:100vh;
    background:linear-gradient(135deg,#667eea,#764ba2);
    padding:40px 20px;

}



.container{

    max-width:1200px;
    margin:auto;
    background:white;
    padding:30px;
    border-radius:20px;
    box-shadow:0 20px 40px rgba(0,0,0,.25);

}




.header{

    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:30px;

}



h1{

    color:#333;
    font-size:32px;

}




.btn-create{

    background:linear-gradient(135deg,#667eea,#764ba2);
    color:white;
    padding:12px 22px;
    text-decoration:none;
    border-radius:12px;
    transition:.3s;

}



.btn-create:hover{

    transform:translateY(-3px);
    box-shadow:0 10px 20px rgba(102,126,234,.4);

}




table{

    width:100%;
    border-collapse:collapse;
    overflow:hidden;
    border-radius:15px;

}



th{

    background:#f5f6ff;
    color:#555;
    padding:15px;
    text-align:left;

}



td{

    padding:15px;
    border-bottom:1px solid #eee;

}



tr:hover{

    background:#fafaff;

}





.product-image{

    width:70px;
    height:70px;
    object-fit:cover;
    border-radius:15px;

}





.no-image{

    width:70px;
    height:70px;
    background:#eee;
    border-radius:15px;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#999;

}





.price{

    color:#16a34a;
    font-weight:bold;
    font-size:17px;

}





.category-badge{

    background:#e0f2fe;
    color:#0369a1;
    padding:6px 12px;
    border-radius:20px;
    font-size:13px;

}





.badge{

    padding:6px 12px;
    border-radius:20px;
    font-size:13px;

}



.badge-active{

    background:#dcfce7;
    color:#166534;

}



.badge-inactive{

    background:#fee2e2;
    color:#991b1b;

}





.actions{

    display:flex;
    gap:8px;

}



.btn{

    padding:8px 14px;
    border-radius:10px;
    color:white;
    text-decoration:none;
    border:none;
    cursor:pointer;
    font-size:13px;
    transition:.3s;

}



.btn:hover{

    transform:translateY(-2px);

}



.btn-view{

    background:#22c55e;

}



.btn-edit{

    background:#f59e0b;

}



.btn-delete{

    background:#ef4444;

}





.empty{

    text-align:center;
    padding:50px;
    color:#777;

}





@media(max-width:800px){


.header{

    flex-direction:column;
    gap:20px;

}


table{

    display:block;
    overflow-x:auto;

}


}



</style>


</head>



<body>



<div class="container">



<div class="header">


<h1>📦 Products</h1>


<a href="{{ route('products.create') }}" class="btn-create">

+ Create Product

</a>


</div>






@if($products->count() > 0)



<table>


<thead>


<tr>

<th>Image</th>

<th>Name</th>

<th>Category</th>

<th>Price</th>

<th>Stock</th>

<th>Status</th>

<th>Actions</th>

</tr>


</thead>



<tbody>


@foreach($products as $product)



<tr>



<td>


@if($product->image)


<img 
src="{{ $product->image_url }}"
class="product-image">


@else


<div class="no-image">

No image

</div>


@endif



</td>






<td>

<strong>

{{ $product->name }}

</strong>

</td>





<td>


<span class="category-badge">

{{ $product->category->name }}

</span>


</td>






<td class="price">

${{ number_format($product->price,2) }}

</td>





<td>

{{ $product->stock }} units

</td>






<td>


<span class="badge {{ $product->is_active ? 'badge-active':'badge-inactive' }}">


{{ $product->is_active ? 'Active':'Inactive' }}


</span>


</td>






<td>



<div class="actions">



<a href="{{ route('products.show',$product->id) }}"
class="btn btn-view">

View

</a>





<a href="{{ route('products.edit',$product->id) }}"
class="btn btn-edit">

Edit

</a>






<form method="POST"
action="{{ route('products.destroy',$product->id) }}"
onsubmit="return confirm('Are you sure?')">


@csrf

@method('DELETE')



<button class="btn btn-delete">

Delete

</button>


</form>




</div>



</td>



</tr>



@endforeach



</tbody>



</table>





@else



<div class="empty">


<h3>No products found</h3>

<p>

<a href="{{ route('products.create') }}">

Create your first product

</a>

</p>


</div>



@endif




</div>




</body>

</html>