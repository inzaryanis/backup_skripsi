@extends ('layouts/tema')

@section('title','User Management')

@section('card_title','User Management')

@section('isi')
<button id="btn_add" href="#" class="btn btn-success">Add User</button>
	<div class="table-responsive">
		<table id="role_table" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>Email</th>
					<th>Role</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
@endsection

@section("skrip")
<script type="text/javascript">
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });       

    table = $('#role_table').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{{url("/user/getdata")}}',
      columns: [
          {
              data: 'DT_RowIndex',
              name: 'DT_RowIndex'
          },
          {
              data: 'name',
              name: 'name'
          },
          {
              data: 'email',
              name: 'email'
          },
          {
              data: 'role',
              name: 'role'
          },
          {
              data: 'action',
              name: 'action'
          },
      ]
  });

    $("body").on('click', '#btn_add',function(){
        $("#modal_useradd").modal('show');
    });

    $('#form_useradd').on("submit", function (e) {

        e.preventDefault();

        $("#submit_useradd").html("Submiting..");

        var formData = new FormData(this);
    
        $.ajax({

          data: formData,

          url: "/user/add",

          type: "POST",

          processData: false,

          contentType: false,

          success: function (data) {
              $("#submit_useradd").html("Submit");
              $('#form_useradd').trigger("reset");
              $('#modal_useradd').modal('hide');
              $('.modal-backdrop').hide();
              table.draw();
          },

          error: function (err) {
              $("#submit_useradd").html("Submit");
              if (err.status==422) {
              	var errors = JSON.parse(err.responseText);
              	_.each(errors, function(item,index){
              		alert(index+"\n"+item);
              	})
              }
          }

      });
    });

    $('#add_role').select2({
      dropdownParent: $("#modal_useradd"),
      placeholder: 'Search...',
      ajax: {
        url: '/user/search/role',
        dataType: 'json',
        type: "GET",
        delay: 250,
        processResults: function (data) {
          return {
            results:  $.map(data, function (item) {
              return {
                text: item.name,
                id: item.id
              }
            })
          };
        },
        cache: true
      }
    });

    $('#edit_role').select2({
      dropdownParent: $("#modal_useredit"),
      placeholder: 'Search...',
      ajax: {
        url: '/user/search/role',
        dataType: 'json',
        type: "GET",
        delay: 250,
        processResults: function (data) {
          return {
            results:  $.map(data, function (item) {
              return {
                text: item.name,
                id: item.id
              }
            })
          };
        },
        cache: true
      }
    });

    $('body').on('click', '.deleteUser', function () {

      var id = $(this).data("id");

      var konfirmasi = confirm("Are You sure want to delete !");
      
      if(konfirmasi){
        $.ajax({

          type: "DELETE",

          url: '/user/delete/'+id,

          success: function (data) {

            table.draw();

          },

          error: function (data) {

            console.log('Error:', data);

          }

        });
      }
    });

    $('body').on('click', '.editUser', function () {

      var id = $(this).data("id");

      $.get("user/edit/"+id, function (data) {
          $("#id_user").val(data.id);
          $("#edit_name").val(data.name);
          $("#edit_email").val(data.email);
          $("#edit_username").val(data.username);
          $("#id_rolePast").val(data.id_role);
          var option = '<option selected value="'+data.id_role+'">'+data.nama_role+'</option>';
          $("#edit_role").html(option);
          $("#modal_useredit").modal('show');
      })
    });

    $('#form_useredit').on("submit", function (e) {

        e.preventDefault();

        $("#submit_useredit").html("Editing..");

        var formData = new FormData(this);
    
        $.ajax({

          data: formData,

          url: "/user/update",

          type: "POST",

          processData: false,

          contentType: false,

          success: function (data) {
              $("#submit_useredit").html("Edit");
              $('#form_useredit').trigger("reset");
              $('#modal_useredit').modal('hide');
              $('.modal-backdrop').hide();
              table.draw();
          },

          error: function (err) {
              $("#submit_useredit").html("Edit");
              if (err.status==422) {
              	var errors = JSON.parse(err.responseText);
              	_.each(errors, function(item,index){
              		alert(index+"\n"+item);
              	})
              }
          }

      });
    });
});
</script>
@endsection

@section('modal')
<!-- Modal Add user -->
<div class="modal fade" id="modal_useradd" tabindex="-1" role="dialog" aria-labelledby="addHeader" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addHeader">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="form_useradd">
            @csrf
            @method("POST")
              <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="name" class="form-control">
              </div>
              <div class="form-group">
                  <label>Username</label>
                  <input type="text" name="username" class="form-control">
              </div>
              <div class="form-group">
                  <label>email</label>
                  <input type="email" name="email" class="form-control">
              </div>
              <div class="form-group">
                  <label>Role</label>
                  <select style="width: 100%;" name="id_role" class="form-control" id="add_role">
                  	
                  </select>
              </div>
              <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="password" class="form-control">
              </div>
              <div class="form-group">
                  <label>Konfirmasi Password</label>
                  <input type="password" name="confirm-password" class="form-control">
              </div>
              <div class="form-group">
                  <button class="btn btn-sm btn-primary" id="submit_useradd">Submit</button>
                  <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
              </div>
          </form>
      </div>
    </div>
  </div>
</div>
<!-- edit user -->
<div class="modal fade" id="modal_useredit" tabindex="-1" role="dialog" aria-labelledby="addHeader" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addHeader">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="form_useredit">
            @csrf
            <input type="hidden" name="id" id="id_user">
            <input type="hidden" name="past_id_role" id="id_rolePast">
            @method("POST")
              <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="name" class="form-control" id="edit_name">
              </div>
              <div class="form-group">
                  <label>Username</label>
                  <input type="text" name="username" class="form-control" id="edit_username">
              </div>
              <div class="form-group">
                  <label>email</label>
                  <input type="email" name="email" class="form-control" id="edit_email">
              </div>
              <div class="form-group">
                  <label>Role</label>
                  <select style="width: 100%;" name="id_role" class="form-control" id="edit_role">
                  	
                  </select>
              </div>
              <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="password" class="form-control">
              </div>
              <div class="form-group">
                  <label>Konfirmasi Password</label>
                  <input type="password" name="confirm-password" class="form-control">
              </div>
              <div class="form-group">
                  <button class="btn btn-sm btn-primary" id="submit_useredit">Edit</button>
                  <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
              </div>
          </form>
      </div>
    </div>
  </div>
</div>
@endsection