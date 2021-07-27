@extends ('layouts/tema')

@section('title','Role Management')

@section('card_title','Role Management')

@section('isi')
<button id="btn_add" href="#" class="btn btn-success">Add Role</button>
	<div class="table-responsive">
		<table id="role_table" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama</th>
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
   //CSRF TOKEN PADA HEADER
  //Script ini wajib krn kita butuh csrf token setiap kali mengirim request post, patch, put dan delete ke server
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });       

    table = $('#role_table').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{{url("/role/getdata")}}',
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
              data: 'action',
              name: 'action'
          },
      ]
  });

    $("body").on('click', '#btn_add',function(){
        $("#modalRole_add").modal('show');
    });

    $('#formRole_add').on("submit", function (e) {

            e.preventDefault();

            $("#submitRole_add").html("Submiting..");

            var formData = new FormData(this);
        
            $.ajax({

              data: formData,

              url: "/role/add/",

              type: "POST",

              processData: false,

              contentType: false,

              success: function (data) {
                  $("#submitRole_add").html("Submit");
                  $('#formRole_add').trigger("reset");
                  $('#modalRole_add').modal('hide');
                  $('.modal-backdrop').hide();
                  table.draw();
              },

              error: function (err) {
                  $("#submitRole_add").html("Submit");
                  if (err.status==422) {
                      var errors = JSON.parse(err.responseText);
                      if (errors.nama) {
                          alert("Role Sudah Ada");
                      }
                  }
              }

          });
        });

    $('#formRole_edit').on("submit", function (e) {

            e.preventDefault();

            $("#submitRole_edit").html("Editing..");

            var formData = new FormData(this);
        
            $.ajax({

              data: formData,

              url: "/role/update/",

              type: "POST",

              processData: false,

              contentType: false,

              success: function (data) {
                  $("#submitRole_edit").html("Edit");
                  $('#formRole_edit').trigger("reset");
                  $('#modalRole_edit').modal('hide');
                  $('.modal-backdrop').hide();
                  table.draw();
              },

              error: function (err) {
                  $("#submitRole_edit").html("Edit");
                  if (err.status==422) {
                      var errors = JSON.parse(err.responseText);
                      if (errors.nama) {
                          alert("Role Sudah Ada");
                      }
                  }
              }

          });
        });

    $('body').on('click', '.deleteRole', function () {

      var id = $(this).data("id");

      var konfirmasi = confirm("Are You sure want to delete !");
      
      if(konfirmasi){
        $.ajax({

          type: "DELETE",

          url: '/role/delete/'+id,

          success: function (data) {

            table.draw();

          },

          error: function (data) {

            console.log('Error:', data);

          }

        });
      }
    });

    $('body').on('click', '.editRole', function () {

      var id = $(this).data("id");

      $.get("role/edit/"+id, function (data) {
          $("#role_nama").val(data.name);
          $("#role_id").val(data.id);
          $("#modalRole_edit").modal('show');
      })
    });

    $('body').on('click', '.menuRole', function () {

      var id = $(this).data("id");

      $.get("role/menu/"+id, function (data) {
          var checkbox = ``;
          $(data.allmenu).each(function(index,item){
            checkbox += `
              <tr>
                <td>
                  <div>
                      <label>`+item.nama+`</label>
                  </div>
                </td>
                <td>
                  <div>
                      <input class="checkbox_menu_section" `; 
                      $(data.menu_section).each(function(index, item_ms){
                          if (item_ms.id_menu==item.id) {
                              checkbox += `checked`;
                              return;
                          }
                      })
                      checkbox +=` type="checkbox" name="menu_section[]" value="`+item.id+`">
                  </div>
                </td>
              </tr>`;
                  $(item.menu).each(function(index,item2){
                      checkbox +=`
              <tr>
                <td>
                  <div style="padding-left: 20px;">
                      <label>`+item2.nama+`</label>
                  </div>
                </td>
                <td>
                  <div>
                    <input class="checkbox_menu" `; 
                    $(data.menu).each(function(index, item_m){
                          if (item_m.id_menu==item2.id) {
                              checkbox += `checked`;
                              return;
                          }
                      })
                    checkbox +=` type="checkbox" name="menu[]" value="`+item2.id+`">
                  </div>
                </td>
              </tr>`;
                    if(item2.sub_menu!='none'){
                        $(item2.sub_menu).each(function(index,item3){
                            checkbox += `
              <tr>
                <td>
                  <div style="padding-left: 40px;">
                      <label>`+item3.nama+`</label>
                  </div>
                </td>
                <td>
                  <div>
                    <input class="checkbox_sub_menu" `; 
                    $(data.sub_menu).each(function(index, item_sm){
                          if (item_sm.id_menu==item3.id) {
                              checkbox += `checked`;
                              return;
                          }
                      })
                    checkbox +=` type="checkbox" name="sub_menu[]" value="`+item3.id+`">
                  </div>
                </td>
              </tr>`;
                        });
                    }
                  });
          });
          $("#roleMenu_tbody").html(checkbox);
          $("#roleMenu_id").val(id);
          $("#modalRole_menu").modal('show');
      })
    });

    $('#menuRole_edit').on("submit", function (e) {

            e.preventDefault();

            $("#submitRole_menu").html("Editing..");

            var formData = new FormData(this);
        
            $.ajax({

              data: formData,

              url: "/role/menu/update",

              type: "POST",

              processData: false,

              contentType: false,

              success: function (data) {
                  $("#submitRole_menu").html("Edit");
                  $('#menuRole_edit').trigger("reset");
                  $('#modalRole_menu').modal('hide');
                  $('.modal-backdrop').hide();
                  table.draw();
              },

              error: function (err) {
                  $("#submitRole_menu").html("Edit");
                  if (err.status==422) {
                      var errors = JSON.parse(err.responseText);
                      if (errors.nama) {
                          alert("Role Sudah Ada");
                      }
                  }
              }

          });
        });
});
</script>
@endsection

@section('modal')
<!-- Modal Add Menu Section -->
<div class="modal fade" id="modalRole_add" tabindex="-1" role="dialog" aria-labelledby="addHeader" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addHeader">Add Role</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="formRole_add">
            @csrf
            @method("POST")
              <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="name" class="form-control">
              </div>
              <div class="form-group">
                  <button class="btn btn-sm btn-primary" id="submitRole_add">Submit</button>
                  <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
              </div>
          </form>
      </div>
    </div>
  </div>
</div>
<!-- Edit -->
<div class="modal fade" id="modalRole_edit" tabindex="-1" role="dialog" aria-labelledby="addHeader" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addHeader">Add Role</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="formRole_edit">
            <input type="hidden" name="id" id="role_id">
            @csrf
            @method("POST")
              <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="name" class="form-control" id="role_nama">
              </div>
              <div class="form-group">
                  <button class="btn btn-sm btn-primary" id="submitRole_edit">Edit</button>
                  <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
              </div>
          </form>
      </div>
    </div>
  </div>
</div>
<!-- Menu Role -->
<div class="modal fade" id="modalRole_menu" tabindex="-1" role="dialog" aria-labelledby="addHeader" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addHeader">Menu Role</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="menuRole_edit">
            @csrf
            @method("POST")
            <input type="hidden" name="id" id="roleMenu_id">
            <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Menu</th>
                      <th>Tampil</th>
                    </tr>
                  </thead>
                  <tbody id="roleMenu_tbody">
                  </tbody>
                </table>
            </div>
              <div class="form-group">
                  <button class="btn btn-sm btn-primary" id="submitRole_menu">Edit</button>
                  <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
              </div>
          </form>
      </div>
    </div>
  </div>
</div>
@endsection