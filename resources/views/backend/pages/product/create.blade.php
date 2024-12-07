@extends('backend.master')


@section('on_sale')

<h1>Create new Product</h1>

<form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
  @csrf
  <div class="form-group">
    <label for="product_name">Enter Product Name</label>
    <input name="product_name" type="text" class="form-control" id="product_name" placeholder="Enter Product Name">
   
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Enter Description</label>
    <input name="description" type="text" class="form-control" placeholder="Description">
  </div>

  <div class="form-group">
    <label for="product_price">Enter Product Price</label>
    <input name="product_price" type="text" class="form-control" id="product_price" placeholder="Enter Product Price">
   
  </div>

  
  <div class="form-group">
    <label for="product_quantity">Enter Product Quantity</label>
    <input name="product_quantity" type="number" class="form-control" id="product_quantity" placeholder="Enter Product Quantity">
   
  </div>
 

  <div class="form-group">
    <label for="">Upload Image</label>
    <input name="image" type="file" class="form-control" >
  </div>


  <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection