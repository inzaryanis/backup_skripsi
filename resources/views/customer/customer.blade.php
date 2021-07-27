@extends ('layouts/tema')

@section('title','Customer')

@section('card_title','Customer')

@section('isi')

<a href="/create_customer" class="btn btn-success">Add Customer</a>
<a style="color:#fff;" data-toggle="modal" data-target="#importExcel"  class="btn btn-success"> Import</a>

<!-- MULAI TOMBOL TAMBAH -->
<!-- <a href="javascript:void(0)" class="btn btn-success" id="tombol-tambah">Add Customer</a> -->
                <br><br>
                <!-- AKHIR TOMBOL -->
                  <div class="table-responsive">
                  <table id="table_customer" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                        <th>No</th>
                          <th scope="col">Name</th>
                          <th scope="col">Short Name</th>
                          <th scope="col">Business Type</th>
                          <th scope="col">Business Conduct</th>
                          <th scope="col">NPWP</th>
                          <th scope="col">Remark</th>
                          <th scope="col">Active Ind</th>
                          <th scope="col">Control By</th>
                           <th scope="col">Action</th>
                        </tr>
                      </thead>
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
 //MULAI DATATABLE
 //script untuk memanggil data json dari server dan menampilkannya berupa datatable

table = $('#table_customer').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{{url("/customer/getdata")}}',
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
              data: 'short_name',
              name: 'short_name'
          },
          {
              data: 'business_type',  
              name: 'business_type'
          },
          {
              data: 'business_conduct',
              name: 'business_conduct'
          },
          {
              data: 'npwp',
              name: 'npwp'
          },
          {
              data: 'remarks',
              name: 'remarks'
          },
          {
              data: 'active_ind',
              name: 'active_ind'
          },
          {
              data: 'control_by',
              name: 'control_by'
          },
          {
              data: 'action',
              name: 'action'
          },
      ]
  });

  // =============== EDIT =========================
$('#formEdit').on("submit", function (e) {

e.preventDefault();

$('#editSubmit').html('Mengedit..');

var formData = new FormData(this);

$.ajax({

  data: formData,

  url: "{{route('customer.update')}}",

  type: "POST",

  processData: false,

  contentType: false,

  success: function (data) {
    console.log(data);
    $('#formEdit').trigger("reset");
    $('#editSubmit').html('Edit');
    $('#editModal').modal('hide');
    $('.modal-backdrop').hide();
    table.draw();
  },

  error: function (data) {

    console.log('Error:', data);

    $('#editSubmit').html('Edit');

  }

});
});

$('body').on('click', '.editBtn', function () {

var id = $(this).data('id');

$.get("/edit/customer" +'/' + id , function (data) {

  $('#editModal').modal('show');
  // mengisi value berdasarkan id
  $('#name').val(data.name);
  // console.log(data.name);
  // otomatis select berdasarkan value
  // $("#bt").val(data.bt_id);
  // $("#bc").val(data.bc_id);
  $('#editId').val(data.id);

  // console.log(data.bc_id);
  $('#short_name').val(data.short_name);
  $('#business_type').val(data.business_type);
  $('#business_conduct').val(data.business_conduct);
  $('#npwp').val(data.npwp);
  $('#remarks').val(data.remarks);
  $('input:radio[name=active_ind]').val([data.active_ind]);
  $('#control_by').val(data.control_by);

  

})
});


// ================== HAPUS ===================

$('body').on('click', '.hapusBtn', function () {

var id = $(this).data("id");    // Harus Data pakenya

confirm("Are You sure want to delete !");

$.ajax({

  type: "DELETE",

  url: '/delete/customer/'+id,

  success: function (data) {

    table.draw();

  },

  error: function (data) {

    console.log('Error:', data);

  }

});


});

});
</script>
@endsection

@section('modal');

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editHeader" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editHeader">Edit Data Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="formEdit">
      <input type="hidden" id="editId" name="id"></input>
      {{csrf_field()}}
        @method('POST')
              <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name"  name="name" value="">
                  @if ($errors->has('name'))
 
                    <span class="text-danger">{{ $errors->first('name') }}</span>
 
                @endif
                </div>
                <div class="form-group">
                  <label for="sn">Short Name</label>
                  <input type="text" class="form-control" id="short_name" name="short_name" value="">
                </div>
                <div>
                  <label for="bt">Business Type</label>  
                  <!-- Button to Open the Modal -->
                  <a data-toggle="modal" data-target="#Modalbt"><img src="{{asset('admin/assets/img/add.png')}}" width="10" height="10" ></i></a>
                 <select id='business_type' name="bt" class="form-control">
                                @foreach ($bt as $bt)                                
                                <option value="{{$bt->business_type}}">{{$bt->business_type}}</option>                               
                                @endforeach              
                  </select>
                </div><br>
                
                <div>
                  <label for="bc">Business conduct</label>  
                  <!-- Button to Open the Modal -->
                  <a data-toggle="modal" data-target="#Modalbc"><img src="{{asset('admin/assets/img/add.png')}}" width="10" height="10" ></i></a>
                 <select id='business_conduct' name="bc" class="form-control">
                            @foreach ($bc as $bc)
                                <option value="{{$bc->business_conduct}}">{{$bc->business_conduct}}</option>
                            @endforeach
                              
                  </select>
                </div> <br>
                
                <div class="form-group">
                  <label for="npwp">Npwp</label>
                  <input type="text" class="form-control" id="npwp"  name="npwp" value="" >
                  @if ($errors->has('npwp'))
 
                    <span class="text-danger">{{ $errors->first('npwp') }}</span>
 
                @endif
                </div> <br>

                <div class="form-group">
                  <label for="remarks">Remarks</label>
                  <input type="text" class="form-control" id="remarks"  name="remarks" value="">
                </div> <br>

                <div class="form-group">
                    <label for="ai"  >Active Ind</label><br>
                    <input type="radio" name="active_ind" id="active_ind" value="Y"  > Yes<br>
                    <input type="radio"  name="active_ind" id="active_ind" value="N"  > No<br>
                </div>
               
                <div>
                  <label for="control_by">Control By</label>  
                  <!-- Button to Open the Modal -->
                  <a data-toggle="modal" data-target="#Modalcontrol_by"><img src="{{asset('admin/assets/img/add.png')}}" width="10" height="10" ></i></a>
                 <select id="control_by" name="control_by" class="form-control">
                              <option value="IU" >Integrasia Utama</option>
                              <option value="SISI" >SISI</option>
                              <option value="AGIT" >AGIT</option>
                              
                  </select>
                </div>
                <button class="mt-2 btn btn-primary" id="editSubmit">Edit</button><br>
                </form>
    </div>
  </div>
</div>
</div>



  <!-- Import Excel -->
  <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<form method="post" action="/customer/import" enctype="multipart/form-data">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
						</div>
						<div class="modal-body">
 
							{{ csrf_field() }}
 
							<label>Pilih file excel</label>
							<div class="form-group">
								<input type="file" name="file" required="required">
              </div>
              
 
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary">Import</button>
						</div>
					</div>
				</form>
			</div>
		</div>
@endsection

