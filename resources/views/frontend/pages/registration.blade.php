@extends('frontend.master')

@section('content')



<div class="row">


  <div class="col-md-2">
   
  </div>


  <div class="col-md-8" style="background-color: #fcf8f8; margin:10px">
 
    <form action="{{route('customer.registration.store')}}" method="post" enctype="multipart/form-data">
      @csrf

    <h1>Customer Registration</h1>


      <div class="form-group">
        <label for="name">Enter Name</label>
        <input name="name" required type="text" class="form-control" id="name" placeholder="Enter name">
      </div>

      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input name="email" required type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
      </div>

      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input name="password" required type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
      </div>

      <div class="form-group">
        <label for="exampleInputPassword1">Re type Password</label>
        <input name="password_confirmation" required type="password" class="form-control" id="exampleInputPassword1" placeholder="Confirm Password">
      </div>

      <div class="form-group">
        <label for="mobile">Enter your mobile number</label>
        <input name="mobile_number" required type="text" class="form-control" id="mobile" placeholder="Enter your mobile number">
      </div>

      <div class="form-group">
        <label for="mobile">Upload Your Image</label>
        <input name="image" type="file" class="form-control" id="mobile">
      </div>

      <div class="form-group">
        <label for="mobile">Enter your Address</label>
        <input name="address" required type="text" class="form-control" id="mobile" placeholder="Enter your Address">
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>



  </div>


  <div class="col-md-2">
  </div>
</div>

@endsection