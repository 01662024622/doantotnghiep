@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="https://rawgit.com/adrotec/knockout-file-bindings/master/knockout-file-bindings.css">

<style type="text/css" media="screen">
  #name-error{
    color: #5a5c69;
    font-size: 0.8rem;
    position: relative;
    line-height: 1;
    color: red
  }
  .error{
    color: #5a5c69;
    font-size: 1rem;
    position: relative;
    line-height: 1;
    color: red;
    width: 100%;
  }
  .image-product{
    width: 200px;
    height: auto;
  }
</style>
@endsection
@section('content')


<br><br>
<table class="table table-bordered" id="users-table">
  <thead>
    <tr>
      <th>ID</th>
      <th>User</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Address</th>
      <th>Products</th>
      <th>Action</th>
      <th>Action</th>
    </tr>
  </thead>
</table>




@endsection

@section('js')
<script src="{{ asset('js/main/orders.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.1.0/knockout-min.js"></script>
<script src="https://rawgit.com/adrotec/knockout-file-bindings/master/knockout-file-bindings.js"></script>

@endsection