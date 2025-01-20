@extends('backend.master')


@section('on_sale')

<a href="{{route('product.create.form')}}" class="btn btn-success">Create Product</a>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Order ID</th>
      <th scope="col">Customer Name</th>
      <th scope="col">Total Price</th>
      <th scope="col">Payment Method</th>
      <th scope="col">Order Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

    @foreach($orders as $data)
    <tr>
      <th scope="row">{{$data->id}}</th>
      <td>{{$data->customer->name}}</td>
      <td>{{$data->total_amount}}</td>
      <td>{{$data->payment_type}}</td>
      <td>{{$data->payment_status}}</td>
      <td>
          <a class="btn btn-primary" href="">View</a>
          <a class="btn btn-danger" href="">Delete</a>
      </td>
    </tr>
    @endforeach 
    

  </tbody>
</table>

{{$orders->links()}}
@endsection