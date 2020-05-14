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
      <th>Image</th>
      <th>Providor</th>
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

      <form id="add-form" action="{{asset('/products')}}" method="POST" >
        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name"  placeholder="Enter name">
          </div>
          <div class="form-group">
            <label for="name">Name</label>
            <div class="well" data-bind="fileDrag: fileData">
              <div class="form-group row">
                <div class="col-md-6">
                  <img style="height: 125px;" class="img-rounded  thumb" data-bind="attr: { src: fileData().dataURL }, visible: fileData().dataURL">
                  <div data-bind="ifnot: fileData().dataURL">
                    <label class="drag-label">Drag file here</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <input type="file" name="image" id ="image" data-bind="fileInput: fileData, customFileInput: {
                  buttonClass: 'btn btn-success',
                  fileNameClass: 'disabled form-control',
                  onClear: onClear,
                }" accept="image/*">
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="">Descripton</label>
          <textarea name="description" id="description" class="form-control"></textarea>
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

@endsection

@section('js')
<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
<script src="{{ asset('js/main/product.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.1.0/knockout-min.js"></script>
<script src="https://rawgit.com/adrotec/knockout-file-bindings/master/knockout-file-bindings.js"></script>

@endsection