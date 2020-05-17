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
<button type="button" class="btn btn-primary" data-toggle="modal" href='#add-modal'>+Add New</button>

<br><br>
<table class="table table-bordered" id="users-table">
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Parent Category</th>
      <th>Created Date</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
  </thead>
</table>


<!-- The Modal -->
<div class="modal" id="add-modal">
  <div class="modal-dialog" style="max-width: 700px;">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add New</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <form id="add-form" action="{{asset('/categories')}}" method="POST" >
        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name"  placeholder="Enter name">
          </div>
          <div class="form-group">
            <label for="exampleFormControlSelect1">Parent Category</label>
            <select class="form-control" id="parent_id" name="parent_id">
             <option value="0">Main</option>
             @foreach ($categories as $category)
             <option value="{{$category->id}}">{{$category->name}}</option>
             @endforeach
           </select>
         </div>

       </div>

       <!-- Modal footer -->
       <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
  </div>
</div>
</div>



<!-- The Modal -->
<div class="modal" id="edit-modal">
  <div class="modal-dialog" style="max-width: 700px;">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <form id="edit-form" action="{{asset('/categories')}}" method="POST" >
        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="ename" name="name"  placeholder="Enter name">
          </div>
          <div class="form-group">
            <label for="exampleFormControlSelect1">Parent Category</label>
            <select class="form-control" id="eparent_id" name="parent_id">
             <option value="0">Main</option>
             @foreach ($categories as $category)
             <option value="{{$category->id}}">{{$category->name}}</option>
             @endforeach
           </select>
         </div>

       </div>
       <input type="hidden" name="id" id="eid">

       <!-- Modal footer -->
       <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
  </div>
</div>
</div>


@endsection

@section('js')
<script src="{{ asset('js/main/category.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.1.0/knockout-min.js"></script>
<script src="https://rawgit.com/adrotec/knockout-file-bindings/master/knockout-file-bindings.js"></script>

@endsection