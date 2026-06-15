<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Edit Product</title>

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

    max-width:650px;
    margin:auto;
    background:white;
    padding:35px;
    border-radius:20px;
    box-shadow:0 20px 40px rgba(0,0,0,.25);

}



h1{

    text-align:center;
    color:#333;
    margin-bottom:30px;
    font-size:30px;

}



.form-group{

    margin-bottom:22px;

}



label{

    display:block;
    margin-bottom:8px;
    font-weight:600;
    color:#444;

}



input[type="text"],
input[type="number"],
input[type="file"],
select,
textarea{


    width:100%;
    padding:13px;
    border-radius:10px;
    border:2px solid #e5e7eb;
    background:#fafafa;
    font-size:15px;
    transition:.3s;

}



input:focus,
select:focus,
textarea:focus{

    outline:none;
    border-color:#667eea;
    box-shadow:0 0 10px rgba(102,126,234,.25);
    background:white;

}




/* image */

.current-image{

    background:#f8f9ff;
    padding:15px;
    border-radius:15px;
    text-align:center;

}



.current-image img{

    width:200px;
    max-width:100%;
    border-radius:15px;
    margin-bottom:10px;

}



.help-text{

    font-size:13px;
    color:#777;
    margin-top:6px;

}




/* checkbox */

.checkbox-group{

    display:flex;
    align-items:center;
    gap:10px;
    background:#f5f6ff;
    padding:12px;
    border-radius:10px;

}


input[type="checkbox"]{

    width:18px;
    height:18px;

}





/* buttons */


.buttons{

    display:flex;
    gap:15px;
    margin-top:30px;

}



button,
.btn-cancel{

    flex:1;
    padding:14px;
    border:none;
    border-radius:12px;
    font-size:16px;
    cursor:pointer;
    text-align:center;
    text-decoration:none;
    transition:.3s;

}



button[type="submit"]{

    background:linear-gradient(135deg,#22c55e,#16a34a);
    color:white;

}



button[type="submit"]:hover{

    transform:translateY(-3px);
    box-shadow:0 10px 20px rgba(34,197,94,.4);

}




.btn-cancel{

    background:#ef4444;
    color:white;

}



.btn-cancel:hover{

    background:#dc2626;
    transform:translateY(-3px);

}




/* errors */


.errors{

    background:#ffe4e6;
    border:1px solid #fb7185;
    color:#9f1239;
    padding:15px;
    border-radius:12px;
    margin-bottom:20px;

}



.errors ul{

    margin-left:20px;

}



.error-message{

    color:#e11d48;
    font-size:14px;
    margin-top:5px;

}





@media(max-width:600px){


.buttons{

    flex-direction:column;

}


.container{

    padding:25px;

}


h1{

    font-size:24px;

}


}


</style>

</head>


<body>


<div class="container">


<h1>✏️ Edit Product</h1>



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





<form method="POST"
action="{{ route('products.update',$product->id) }}"
enctype="multipart/form-data">


@csrf
@method('PUT')




<div class="form-group">


<label>Category *</label>


<select name="category_id" required>


<option value="">-- Select Category --</option>


@foreach($categories as $category)


<option value="{{ $category->id }}"
{{ old('category_id',$product->category_id)==$category->id?'selected':'' }}>


{{ $category->name }}


</option>


@endforeach


</select>


@error('category_id')
<div class="error-message">{{ $message }}</div>
@enderror


</div>





<div class="form-group">


<label>Product Name *</label>


<input type="text"
name="name"
value="{{ old('name',$product->name) }}"
required>


@error('name')
<div class="error-message">{{ $message }}</div>
@enderror


</div>






<div class="form-group">


<label>Price (USD) *</label>


<input type="number"
name="price"
value="{{ old('price',$product->price) }}"
step="0.01"
required>


@error('price')
<div class="error-message">{{ $message }}</div>
@enderror


</div>






<div class="form-group">


<label>Stock Quantity *</label>


<input type="number"
name="stock"
value="{{ old('stock',$product->stock) }}"
required>


@error('stock')
<div class="error-message">{{ $message }}</div>
@enderror


</div>






<div class="form-group">


<label>Current Image</label>


@if($product->image)

<div class="current-image">

<img src="{{ $product->image_url }}">

<div class="help-text">

{{ $product->image }}

</div>


</div>


@else

<p class="help-text">No image uploaded</p>


@endif


</div>






<div class="form-group">


<label>Replace Product Image</label>


<input type="file"
name="image"
accept="image/jpeg,image/png,image/gif">


<div class="help-text">

Leave empty to keep current image

</div>


</div>







<div class="form-group">


<div class="checkbox-group">


<input type="checkbox"
name="is_active"
value="1"
{{ old('is_active',$product->is_active)?'checked':'' }}>


<label style="margin:0">

Active (Available for sale)

</label>


</div>


</div>







<div class="buttons">


<button type="submit">

Update Product

</button>


<a href="{{ route('products.show',$product->id) }}"
class="btn-cancel">

Cancel

</a>


</div>





</form>


</div>


</body>

</html>