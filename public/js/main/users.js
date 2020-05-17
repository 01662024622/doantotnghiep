
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
//____________________________________________________________________________________________________
var dataTable = $('#users-table').DataTable({
  processing: true,
  serverSide: true,
  ajax: "/api/v1/users/table",
  columns: [
  { data: 'id', name: 'id' },
  { data: 'name', name: 'name' },
  { data: 'email', name: 'email' },
  { data: 'phone', name: 'phone' },
  { data: 'address', name: 'address' },
  { data: 'role', name: 'role' },
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
    phone:{
      required:true,
      minlength:10,
      max:10,
    },
    email:{
      required:true,
      minlength:10,
    },
    room:{
      required:true,
    },
  },
  messages: {
    name: {
      required: "Enter your name",
      minlength: "Leaste 5 word"
    },
    name: {
      required: "Enter your name",
      minlength: "Leaste 5 word"
    },
    phone:{
      required:"Enter your phone",
      minlength:"Leaste has 10 number",
      max:"Leaste has 10 number",
    },
    email:{
      required:"Enter your email",
      minlength:"This not email",
    },
    room:{
      required:"Enter your room",
    },
    password:{
      required:"Enter your password",
      minlength:"Leaste 8 word",
    },
    email:{
      required:"Enter your email",
      minlength:"Leaste 8 word",
    },
    
  },
  submitHandler: function(form) {
    var formData = new FormData(form);
    if ($('#eid').val()=='') {
      formData.delete('id');
    }

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


  // get data for form update
  function getInfo(id) {
    console.log(id);
        // $('#editPost').modal('show');
        $.ajax({
          type: "GET",
          url: "/users/"+id,
          success: function(response)
          {
           $('#name').val(response.name);
           $('#email').val(response.email);
           $('#phone').val(response.phone);
           $('#room').val(response.room);
           $('#apartment_id').val(response.apartment_id);
           $('.tag_pass').hide();
           $('#eid').val(response.id);
           console.log(true)    
         },
         error: function (xhr, ajaxOptions, thrownError) {
          toastr.error(thrownError);
        }
      });
      }



//____________________________________________________________________________________________________

//____________________________________________________________________________________________________
    // Update function
      // Delete function
      function alDelete(id){
        swal({
          title: "Are you sure to remove?",
        // text: "Bạn sẽ không thể khôi phục lại bản ghi này!!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",  
        cancelButtonText: "No",
        confirmButtonText: "Yes",
        // closeOnConfirm: false,
      },
      function(isConfirm) {
        if (isConfirm) {
          $.ajax({
            type: "delete",
            url: "products/"+id,
            success: function(res)
            {
              if(!res.error) {
                toastr.success('Success!');
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
          toastr.error("Cancel!");
        }
      });
      };

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
      function changeStatus(id) {
        console.log(id);
        // $('#editPost').modal('show');
        $.ajax({
          type: "GET",
          url: "api/status/products/"+id,
          success: function(response)
          {
          // location.reload();
          
          dataTable.ajax.reload();
          toastr.success('has been updated');
        },
        error: function (xhr, ajaxOptions, thrownError) {
          toastr.error(thrownError);
        }
      });
      }

      function clearForm(){
        console.log('clear');
        $('#add-form')[0].reset(); 
        $('#eid').val(''); 

        $('.tag_pass').show();
        $( "#password" ).rules( "add", {
          minlength: 8
        });
        $( "#repassword" ).rules( "add", {
          minlength: 8
        });
      }

