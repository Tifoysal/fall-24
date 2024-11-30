@extends('backend.master')


@section('on_sale')

<a href="{{url('/create-category')}}" class="btn btn-primary">Create Category</a>

<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Category Name</th>
      <th scope="col">Status</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach($allCategory as $cat)
    <tr>
      <th scope="row">{{$cat->id}}</th>
      <td>{{$cat->name}}</td>
      <td>{{$cat->status}}</td>
      <td>
        <a class="btn btn-primary" href="">View</a>
        <a class="btn btn-danger" href="">Delete</a>
      </td>
    </tr>

    @endforeach
   
  </tbody>
</table>

{{$allCategory->links()}}

@endsection