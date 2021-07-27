@extends ('layouts/tema')

@section('title','Menu Management')

@section('card_title','Menu Management')

@section('isi')
<button id="btn_add" data-tipe="menu_section" href="#" class="btn btn-success">Add Menu Section</button>
<input type="hidden" id="tipe_hidden" value="menu_section">
<select id="tipe_menu" class="form-control" style="margin-bottom: 5px;">
    <option value="menu_section">Menu Section</option>
    <option value="menu">Menu</option>
    <option value="sub_menu">Sub Menu</option>
</select>
<div id="menu_section" class="type_menu">
  <div class="table-responsive">
    <table id="ms_table" class="table table-striped table-bordered">
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
</div>

<div id="menu" style="display:none;" class="type_menu">
  <div class="table-responsive">
    <table id="menu_table" class="table table-striped table-bordered" width="100%">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Icon</th>
          <th>URL</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>

<div id="sub_menu" style="display:none;" class="type_menu">
  <div class="table-responsive">
    <table id="sm_table" class="table table-striped table-bordered" width="100%">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>URL</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
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

    ms_table = $('#ms_table').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{{url("/menu/getdata/menu_section")}}',
      columns: [
          {
              data: 'DT_RowIndex',
              name: 'DT_RowIndex'
          },
          {
              data: 'nama',
              name: 'nama'
          },
          {
              data: 'action',
              name: 'action'
          },
      ]
    });

    menu_table = $('#menu_table').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{{url("/menu/getdata/menu")}}',
      columns: [
          {
              data: 'DT_RowIndex',
              name: 'DT_RowIndex'
          },
          {
              data: 'nama',
              name: 'nama'
          },
          {
              data: 'icon',
              name: 'icon'
          },
          {
              data: 'url',
              name: 'url'
          },
          {
              data: 'action',
              name: 'action'
          },
      ]
    });

    sm_table = $('#sm_table').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{{url("/menu/getdata/sub_menu")}}',
      columns: [
          {
              data: 'DT_RowIndex',
              name: 'DT_RowIndex'
          },
          {
              data: 'nama',
              name: 'nama'
          },
          {
              data: 'url',
              name: 'url'
          },
          {
              data: 'action',
              name: 'action'
          },
      ]
    });

    
    $('#menu_section_select').select2({
      dropdownParent: $("#addModalMenu"),
      placeholder: 'Search...',
      ajax: {
        url: '/menu/search/menusection',
        type: "GET",
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
          return {
            results:  $.map(data, function (item) {
              return {
                text: item.nama,
                id: item.id
              }
            })
          };
        },
        cache: true
      }
    });

    $('#ms_edit_select').select2({
      dropdownParent: $("#editModalMenu"),
      placeholder: 'Search...',
      ajax: {
        url: '/menu/search/menusection',
        type: "GET",
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
          return {
            results:  $.map(data, function (item) {
              return {
                text: item.nama,
                id: item.id
              }
            })
          };
        },
        cache: true
      }
    });

    $('#menu_select').select2({
      dropdownParent: $("#addModalSm"),
      placeholder: 'Search...',
      ajax: {
        url: '/menu/search/menu',
        dataType: 'json',
        type: "GET",
        delay: 250,
        processResults: function (data) {
          return {
            results:  $.map(data, function (item) {
              return {
                text: item.nama,
                id: item.id
              }
            })
          };
        },
        cache: true
      }
    });

    $('#menu_select_edit').select2({
      dropdownParent: $("#editModalSm"),
      placeholder: 'Search...',
      ajax: {
        url: '/menu/search/menu',
        dataType: 'json',
        type: "GET",
        delay: 250,
        processResults: function (data) {
          return {
            results:  $.map(data, function (item) {
              return {
                text: item.nama,
                id: item.id
              }
            })
          };
        },
        cache: true
      }
    });

    $("#tipe_menu").change(function(){
        var tipe = $(this).val();
        $(".type_menu").hide();
        if(tipe=="menu_section"){
            $("#btn_add").html("Add Menu Section");
            $("#tipe_hidden").val("menu_section");
            $("#menu_section").show();
        }else if(tipe=="menu"){
            $("#btn_add").html("Add Menu");
            $("#tipe_hidden").val("menu");
            $("#menu").show();
        }else{
            $("#btn_add").html("Add Sub Menu");
            $("#tipe_hidden").val("sub_menu");
            $("#sub_menu").show();
        }
    });

    $("body").on('click', '#btn_add',function(){
        var tipe = $("#tipe_hidden").val();
        if(tipe=='menu_section'){
          $("#addModalMs").modal('show');
        }else if(tipe=="menu"){
          $("#addModalMenu").modal('show');
        }else{
          $("#addModalSm").modal('show');
        }
    });

    $('#form_menu_section').on("submit", function (e) {

            e.preventDefault();

            $("#fms_submit").html("Submiting..");

            var formData = new FormData(this);
        
            $.ajax({

              data: formData,

              url: "/menu/add/menusection",

              type: "POST",

              processData: false,

              contentType: false,

              success: function (data) {
                  $("#fms_submit").html("Submit");
                  $('#form_menu_section').trigger("reset");
                  $('#addModalMs').modal('hide');
                  $('.modal-backdrop').hide();
                  ms_table.draw();
              },

              error: function (err) {
                  $("#fms_submit").html("Submit");
                  if (err.status==422) {
                      var errors = JSON.parse(err.responseText);
                      if (errors.nama) {
                          alert("Menu Section Sudah Ada");
                      }
                  }
              }

          });
        });

    $('#form_menu').on("submit", function (e) {

            e.preventDefault();

            $("#menu_submit").html("Submiting..");

            var formData = new FormData(this);
        
            $.ajax({

              data: formData,

              url: "/menu/add/menu",

              type: "POST",

              processData: false,

              contentType: false,

              success: function (data) {
                  $("#menu_submit").html("Submit");
                  $('#form_menu').trigger("reset");
                  $('#addModalMenu').modal('hide');
                  $('.modal-backdrop').hide();
                  menu_table.draw();
              },

              error: function (err) {
                  $("#menu_submit").html("Submit");
                  if (err.status==422) {
                      var errors = JSON.parse(err.responseText);
                      if (errors.nama) {
                          alert("Menu Sudah Ada");
                      }
                  }
              }

          });
        });

    $('#form_sub_menu').on("submit", function (e) {

            e.preventDefault();

            $("#submenu_submit").html("Submiting..");

            var formData = new FormData(this);
        
            $.ajax({

              data: formData,

              url: "/menu/add/submenu",

              type: "POST",

              processData: false,

              contentType: false,

              success: function (data) {
                  $("#submenu_submit").html("Submit");
                  $('#form_sub_menu').trigger("reset");
                  $('#addModalSm').modal('hide');
                  $('.modal-backdrop').hide();
                  sm_table.draw();
              },

              error: function (err) {
                  $("#submenu_submit").html("Submit");
                  if (err.status==422) {
                      var errors = JSON.parse(err.responseText);
                      if (errors.nama) {
                          alert("Menu Sudah Ada!");
                      }else if(errors.url){
                        alert("Url tidak boleh kosong!")
                      }
                  }
              }

          });
        });

    $('#form_menu_section_edit').on("submit", function (e) {

            e.preventDefault();

            $("#fms_edit").html("Editing..");

            var formData = new FormData(this);
        
            $.ajax({

              data: formData,

              url: "/menu/update",

              type: "POST",

              processData: false,

              contentType: false,

              success: function (data) {
                  $("#fms_edit").html("Edit");
                  $('#form_menu_section_edit').trigger("reset");
                  $('#editModalMs').modal('hide');
                  $('.modal-backdrop').hide();
                  ms_table.draw();
              },

              error: function (err) {
                  $("#fms_edit").html("Edit");
                  if (err.status==422) {
                      var errors = JSON.parse(err.responseText);
                      if (errors.nama) {
                          alert("Menu Section Sudah Ada");
                      }
                  }
              }

          });
        });

    $('#form_menu_edit').on("submit", function (e) {

            e.preventDefault();

            $("#menu_edit").html("Editing..");

            var formData = new FormData(this);
        
            $.ajax({

              data: formData,

              url: "/menu/update",

              type: "POST",

              processData: false,

              contentType: false,

              success: function (data) {
                  $("#menu_edit").html("Edit");
                  $('#form_menu_edit').trigger("reset");
                  $('#editModalMenu').modal('hide');
                  $('.modal-backdrop').hide();
                  menu_table.draw();
              },

              error: function (err) {
                  $("#menu_edit").html("Edit");
                  if (err.status==422) {
                      var errors = JSON.parse(err.responseText);
                      if (errors.nama) {
                          alert("Menu Sudah Ada");
                      }
                  }
              }

          });
        });

    $('#form_sub_menu_edit').on("submit", function (e) {

            e.preventDefault();

            $("#submenu_edit").html("Editing..");

            var formData = new FormData(this);
        
            $.ajax({

              data: formData,

              url: "/menu/update",

              type: "POST",

              processData: false,

              contentType: false,

              success: function (data) {
                  $("#submenu_edit").html("Edit");
                  $('#form_sub_menu_edit').trigger("reset");
                  $('#editModalSm').modal('hide');
                  $('.modal-backdrop').hide();
                  sm_table.draw();
              },

              error: function (err) {
                  $("#submenu_edit").html("Edit");
                  if (err.status==422) {
                      var errors = JSON.parse(err.responseText);
                      if (errors.nama) {
                          alert("Menu Sudah Ada");
                      }
                  }
              }

          });
        });

    $('body').on('click', '.deleteMenu', function () {

      var id = $(this).data("id");
      var tipe = $(this).data("tipe");
      console.log("tipe",tipe);
      var konfirmasi = confirm("Are You sure want to delete !");
      if(konfirmasi){
        $.ajax({

          type: "DELETE",

          url: '/menu/destroy/'+id+'/'+tipe,

          success: function (data) {

            ms_table.draw();
            menu_table.draw();
            sm_table.draw();

          },

          error: function (data) {

            console.log('Error:', data);

          }

        });
      }
    });
    // Edit
    $('body').on('click', '.editMenu', function () {

      var id = $(this).data("id");
      var tipe = $(this).data("tipe");

      $.get("menu/edit/"+id+"/"+tipe, function (data) {
        
        if(tipe=="menu_section"){
            $("#ms_nama").val(data.nama);
            $("#ms_id").val(data.id);
            $("#editModalMs").modal('show');
        }else if(tipe=="menu"){
          $("#menu_nama").val(data.nama);
          $("#menu_icon").val(data.icon);
          $("#menu_url").val(data.url);
          $("#menu_id").val(data.id);
          var option = '<option selected value="'+data.id_ms+'">'+data.nama_ms+'</option>';
          $("#ms_edit_select").html(option);
          $("#editModalMenu").modal('show');
        }else if(tipe=="sub_menu"){
            var option = '<option selected value="'+data.id_menu+'">'+data.nama_menu+'</option>';
            $("#menu_select_edit").html(option);
            $("#sub_menu_id").val(data.id);
            $("#sm_nama").val(data.nama);
            $("#sm_url").val(data.url);
            $("#editModalSm").modal('show');
        }
      })
    });
});
</script>
@endsection

@section('modal')
<!-- Modal Add Menu Section -->
<div class="modal fade" id="addModalMs" tabindex="-1" role="dialog" aria-labelledby="addHeader" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addHeader">Add Menu Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="form_menu_section">
            @csrf
            @method("POST")
              <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="nama" class="form-control">
              </div>
              <div class="form-group">
                  <button class="btn btn-sm btn-primary" id="fms_submit">Submit</button>
                  <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
              </div>
          </form>
      </div>
    </div>
  </div>
</div>
<!-- Add modal menu -->
<div class="modal fade" id="addModalMenu" tabindex="-1" role="dialog" aria-labelledby="addHeader" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addHeader">Add Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="form_menu">
            @csrf
              <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="nama" class="form-control">
              </div>
              <div class="form-group">
                  <label>Icon</label>
                  <input type="text" name="icon" class="form-control">
              </div>
              <div class="form-group">
                  <label>Url</label>
                  <input type="text" name="url" class="form-control">
              </div>
              <div class="form-group">
                  <label>Menu Section</label>
                  <select name="id_ms" id="menu_section_select" style="width: 100%;">
                    
                  </select>
              </div>
              <div class="form-group">
                  <button class="btn btn-sm btn-primary" id="menu_submit">Submit</button>
                  <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
              </div>
          </form>
      </div>
    </div>
  </div>
</div>
<!-- add sub menu -->
<div class="modal fade" id="addModalSm" tabindex="-1" role="dialog" aria-labelledby="addHeader" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addHeader">Add Sub Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="form_sub_menu">
            @csrf
              <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="nama" class="form-control">
              </div>
              <div class="form-group">
                  <label>Url</label>
                  <input type="text" name="url" class="form-control">
              </div>
              <div class="form-group">
                  <label>Menu</label>
                  <select id="menu_select" style="width: 100%;" name="id_menu">
                    
                  </select>
              </div>
              <div class="form-group">
                  <button class="btn btn-sm btn-primary" id="submenu_submit">Submit</button>
                  <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
              </div>
          </form>
      </div>
    </div>
  </div>
</div>
<!-- Edit Modal -->
<div class="modal fade" id="editModalMs" tabindex="-1" role="dialog" aria-labelledby="addHeader" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addHeader">Edit Menu Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="form_menu_section_edit">
            @csrf
            @method("POST")
            <input type="hidden" name="id" id="ms_id">
            <input type="hidden" name="tipe" value="menu_section">
              <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="nama" class="form-control" id="ms_nama">
              </div>
              <div class="form-group">
                  <button class="btn btn-sm btn-primary" id="fms_edit">Edit</button>
                  <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
              </div>
          </form>
      </div>
    </div>
  </div>
</div>
<!-- Menu -->
<div class="modal fade" id="editModalMenu" tabindex="-1" role="dialog" aria-labelledby="addHeader" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addHeader">Edit Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="form_menu_edit">
            <input type="hidden" name="id" id="menu_id">
            <input type="hidden" name="tipe" value="menu">
            @csrf
              <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="nama" class="form-control" id="menu_nama">
              </div>
              <div class="form-group">
                  <label>Icon</label>
                  <input type="text" name="icon" class="form-control" id="menu_icon">
              </div>
              <div class="form-group">
                  <label>Url</label>
                  <input type="text" name="url" class="form-control" id="menu_url">
              </div>
              <div class="form-group">
                  <label>Menu Section</label>
                  <select name="id_ms" id="ms_edit_select" style="width: 100%;">
                    
                  </select>
              </div>
              <div class="form-group">
                  <button class="btn btn-sm btn-primary" id="menu_edit">Edit</button>
                  <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
              </div>
          </form>
      </div>
    </div>
  </div>
</div>
<!-- sub menu -->
<div class="modal fade" id="editModalSm" tabindex="-1" role="dialog" aria-labelledby="addHeader" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addHeader">Edit Sub Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="form_sub_menu_edit">
            <input type="hidden" name="id" id="sub_menu_id">
            <input type="hidden" name="tipe" value="sub_menu">
            @csrf
              <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="nama" class="form-control" id="sm_nama">
              </div>
              <div class="form-group">
                  <label>Url</label>
                  <input type="text" name="url" class="form-control" id="sm_url">
              </div>
              <div class="form-group">
                  <label>Menu</label>
                  <select id="menu_select_edit" style="width: 100%;" name="id_menu">
                    
                  </select>
              </div>
              <div class="form-group">
                  <button class="btn btn-sm btn-primary" id="submenu_edit">Edit</button>
                  <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
              </div>
          </form>
      </div>
    </div>
  </div>
</div>
@endsection