  CKEDITOR.replace( 'description' );
  // CKEDITOR.replace( 'econtent' );
  CKEDITOR.editorConfig = function( config ) {
        // Define changes to default configuration here. For example:
        // config.language = 'fr';
        // config.uiColor = '#AADC6E';
        config.width = '400px';
      };
      $(function() {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
//____________________________________________________________________________________________________
var dataTable = $('#users-table').DataTable({
  processing: true,
  serverSide: true,
  ajax: "/api/v1/product/table",
  columns: [
  { data: 'id', name: 'id' },
  { data: 'name', name: 'name' },
  { data: 'image', name: 'image' },
  { data: 'providor', name: 'providor' },
  { data: 'created_date', name: 'created_date' },
  { data: 'action', name: 'action' },
  ]
});
//____________________________________________________________________________________________________

//____________________________________________________________________________________________________
$("#add-form").submit(function(e){
  e.preventDefault();
}).validate({
  rules: {
    name: {
      required: true,
      minlength: 5
    },
    
    image:{
      required:true,
    },
    description:{
      required:true,
      minlength:10,
    },
  },
  messages: {
    name: {
      required: "Enter your name",
      minlength: "Leaste 5 word"
    },
    image: {
      required: "Enter your image",
      minlength: "Leaste 5 word"
    },
    description: {
      required: "Write descripton, plz",
      minlength: "Write descripton, plz",
    },
    
  },
  submitHandler: function(form) {
    var formData = new FormData(form);
    var description = CKEDITOR.instances.description.getData();

    formData.set('description',description);
    formData.append('image',$('#image').files);

    $.ajax({
      url: form.action,
      type: form.method,
      data: formData,
      dataType:'json',
      async:false,
      processData: false,
      contentType: false,
      success: function(response) {
       setTimeout(function () {
         toastr.success('has been added');
       },1000);
       $("#add-modal").modal('toggle');
       dataTable.ajax.reload();
     }, error: function (xhr, ajaxOptions, thrownError) {
      toastr.error(thrownError);
    },       
  });
  }
});

})
//____________________________________________________________________________________________________
$("#edit-form").submit(function(e){
  e.preventDefault();
}).validate({
  rules: {
    name: {
      required: true,
      minlength: 5
    },
    description: {
      required: true,
    },
    sale_cost:{
      number:true,
      minlength:1,
      maxlength:10   
    },
    quantity:{
      number:true,
      minlength:1,
      maxlength:4   
    },
    origin_cost:{
      number:true,
      minlength:1,
      maxlength:10   
    },
    address: {
      required: true,
      minlength: 5
    },
  },
  messages: {
    name: {
      required: "Enter Your Name",
      minlength: "leaste 5 word"
    },
    description: {
      required: "Write Descripton, plz",
    },
    sale_cost:{
      number:"This is not Number Phone",
      minlength:"This is not Number Phone",
      maxlength:"This is not Number Phone"
    },
    quantity:{
      number:"This is not number",
      minlength:"This is incorect",
      maxlength:"This is incorect"
    },
    origin_cost:{
      number:"This is not Number Phone",
      minlength:"This is not Number Phone",
      maxlength:"This is not Number Phone"
    },
    address: {
      required: "Enter Your Address",
      minlength: "Leaste 5 word"
    },
  },
  submitHandler: function(form) {
    var content = CKEDITOR.instances.econtent.getData();
    var files = document.getElementById('efiles').files;
    var updateForm = new FormData();
    updateForm.append('id',$('#eid').val());
    updateForm.append('name',$('#ename').val());
    updateForm.append('description',$('#edescription').val());
    updateForm.append('content',content);
    updateForm.append('vendor_id',$('#evendor').val());
    updateForm.append('quantity',$('#equantity').val());
    updateForm.append('category_id',$('#ecategory_id').val());
    updateForm.append('sale_cost',$('#esale_cost').val());
    updateForm.append('origin_cost',$('#eorigin_cost').val());
    for (var i = 0; i < files.length; i++) {
      updateForm.append('images[]',files[i]);
    }
    $.ajax({
      url: form.action,
      type: form.method,
      data: updateForm,
      dataType:'json',
      async:false,
      processData: false,
      contentType: false,
      success: function(response) {
       setTimeout(function () {
         toastr.success('has been updated');
       },1000);
       $("#edit-modal").modal('hide');
       dataTable.ajax.reload();
     }, error: function (xhr, ajaxOptions, thrownError) {
      toastr.error(thrownError);
    },       
  });
  }
});

//____________________________________________________________________________________________________
  // get data for form update
  function getInfo(id) {
    console.log(id);
        // $('#editPost').modal('show');
        $.ajax({
          type: "GET",
          url: "{{ asset('admin/getProduct') }}/"+id,
          success: function(response)
          {
            $('#eimage_preview').html("");
            CKEDITOR.instances.econtent.setData(response.content);
            $('#ename').val(response.name);
            $('#edescription').val(response.description);
            $("#esale_cost").val(response.sale_cost);
            $('#eorigin_cost').val(response.origin_cost);
            $('#equantity').val(response.quantity);
            $('#evendor').val(response.user_id);
            $('#ecategory_id').val(response.category_id);
            $('#equantity').val(response.quantity);
            $('#eid').val(response.id);
            for (var i = 0; i < response.images.length; i++) {
             html="<img src='"+response.images[i].link+"' class='img-responsive img' style='display:inline-block;width:50px'>";
             $('#eimage_preview').append(html);
           }         
         },
         error: function (xhr, ajaxOptions, thrownError) {
          toastr.error(thrownError);
        }
      });
      }
//____________________________________________________________________________________________________
    // Update function
      // Delete function
      function alDelete(id){
        swal({
          title: "Bạn có chắc muốn xóa?",
        // text: "Bạn sẽ không thể khôi phục lại bản ghi này!!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",  
        cancelButtonText: "Không",
        confirmButtonText: "Có",
        // closeOnConfirm: false,
      },
      function(isConfirm) {
        if (isConfirm) {
          $.ajax({
            type: "delete",
            url: "product/"+id,
            success: function(res)
            {
              if(!res.error) {
                toastr.success('Xóa thành công!');
                $('#product-'+id).remove();
                  //setTimeout(function () {
                    //location.reload();
                  //}, 1000)
                }
              },
              error: function (xhr, ajaxOptions, thrownError) {
                toastr.error(thrownError);
              }
            });
        } else {
          toastr.error("Thao tác xóa đã bị huỷ bỏ!");
        }
      });
      };
      function getReason(id){
        $.ajax({
          type: "post",
          url: "",
          success: function(response)
          {
            console.log(response);
            if (response.notice==null) {
              $("p#reason").append("Admin Không Để Lại Lý Do");
              console.log('test');
            }else{
              $("p#reason").append(response.notice);
            }
          },
          error: function (xhr, ajaxOptions, thrownError) {
            toastr.error(thrownError);
          }
        })
      }

      $(function(){
        var viewModel = {};
        viewModel.fileData = ko.observable({
          dataURL: ko.observable(),
    // base64String: ko.observable(),
  });
        viewModel.multiFileData = ko.observable({
          dataURLArray: ko.observableArray(),
        });
        viewModel.onClear = function(fileData){
          if(confirm('Are you sure?')){
            fileData.clear && fileData.clear();
          }                            
        };
        viewModel.debug = function(){
          window.viewModel = viewModel;
          console.log(ko.toJSON(viewModel));
          debugger; 
        };
        ko.applyBindings(viewModel);
      });