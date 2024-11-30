@extends('backend.master')


@section('on_sale')

<h1>Create new category</h1>

<form action="{{url('/category-store')}}" method="post">
  @csrf
  <div class="form-group">
    <label for="category_name">Enter Category Name</label>
    <input name="cat_name" type="text" class="form-control" id="category_name" placeholder="Enter Category Name">
   
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Enter Description</label>
    <input name="description" type="text" class="form-control" placeholder="Description">
  </div>
 

  <div class="form-group">
    <label for="">Upload Image</label>
    <input name="image" type="file" class="form-control" >
  </div>


  <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection