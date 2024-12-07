@extends('backend.master')


@section('on_sale')

<a href="{{route('product.create.form')}}" class="btn btn-success">Create Product</a>

<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Image</th>
      <th scope="col">Name</th>
      <th scope="col">Price</th>
      <th scope="col">Quantity</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

    @foreach($products as $data)
    <tr>
      <th scope="row">{{$data->id}}</th>
      <td>
        <img width="50px" src="{{url('/backend/uploads/'.$data->image)}}" alt="">
      </td>
      <td>{{$data->name}}</td>
      <td>{{$data->price}}</td>
      <td>{{$data->quantity}}</td>
      <td>
          <a class="btn btn-primary" href="">View</a>
          <a class="btn btn-danger" href="">Delete</a>
      </td>
    </tr>
    @endforeach 
    

  </tbody>
</table>

@endsection