@extends ('layouts/tema')

@section('title','Part')

@section('card_title','Part')

@section('isi')

<a href="/create_mp" class="btn btn-success">Add Part</a>
<a style="color:#fff;" data-toggle="modal" data-target="#importExcel"  class="btn btn-success"> Import</a>

                  <div class="table-responsive">
                  <table id="table_part" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col">Part</th>
                          <th scope="col">Series</th>
                          <th scope="col">Type</th>
                          <th scope="col">Brand</th>
                          <th scope="col">Uom</th>
                          <th scope="col">Serialized Code</th>
                          <th scope="col">Action</th>

                        </tr>
                      </thead>
                    </table>
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

table = $('#table_part').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{{url("/part/getdata")}}',
      columns: [
          {
              data: 'DT_RowIndex',
              name: 'DT_RowIndex'
          },
          {
              data: 'part',
              name: 'part'
          },
          {
              data: 'series',
              name: 'series'
          },
          {
              data: 'type',
              name: 'type'
          },
          {
              data: 'merk',  // Nama tabel sama nama field nya
              name: 'merk'
          },
          {
              data: 'uom',
              name: 'uom'
          },
          {
              data: 'serialized_code',
              name: 'serialized_code'
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

  url: "{{route('part.update')}}",

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

$.get("/edit/part" +'/' + id , function (data) {

  $('#editModal').modal('show');
  // mengisi value berdasarkan id
  $('#part').val(data.part);
  // console.log(data.name);
  // otomatis select berdasarkan value
  $("#series").val(data.series);
  $("#type").val(data.type);
  $("#merk").val(data.merk);
  $('#editId').val(data.id);


  // console.log(data.id);
  // $('#id_series').val(data.id_series);
  // $('#id_type').val(data.id_type);
  // $('#id_merk').val(data.id_merk);
  $('input:radio[name=serialized_code]').val([data.serialized_code]);
  $('#uom').val(data.uom);



})
});

// ======================= detail =================

$('body').on('click', '.detailBtn', function () {

var id = $(this).data('id');

$.get("part-detail-data/"+id+"/", function (data) {

  $('#detailModal').modal('show');
  $('#dpart').val(data.part);
  $('#did_series').val(data.id_series);
  $('#did_type').val(data.id_type);
  $('#did_merk').val(data.id_merk);
  $('#duom').html(data.uom);
  


})
});

// ================== HAPUS ===================

$('body').on('click', '.hapusBtn', function () {

var id = $(this).data("id");    // Harus Data pakenya

confirm("Are You sure want to delete !");

$.ajax({

  type: "DELETE",

  url: '/delete/part/'+id,

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

 <!-- Import Excel -->
 <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<form method="post" action="/part/import" enctype="multipart/form-data">
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
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Import</button>
						</div>
					</div>
				</form>
			</div>
		</div>

<!-- Modal Edit -->
 <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog " style="max-width: 35%;" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Edit Part</h5>
						</div>
						<div class="modal-body">
 

            <form id="formEdit">
            <input type="hidden" id="editId" name="id"></input>
                       @csrf

										<div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 label-align">Part</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="text" class="form-control" placeholder=" Input Part" name="part" id="part" >
											</div>
										</div>
										
										<div class="form-group row">
											<label class="control-label col-md-3 col-sm-3 label-align">Series </label>
											<div class="col-md-9 col-sm-9 ">
												<select name="series" class="form-control" id="series">
                        @foreach ($series_edit as $series_edit)                                
                                <option value="{{$series_edit->series}}">{{$series_edit->series}}</option>                               
                                @endforeach     
									
												</select>
											</div>
										</div>

                    <div class="form-group row">
											<label class="control-label col-md-3 col-sm-3 label-align">Type</label>
											<div class="col-md-9 col-sm-9 ">
												<select name="type" class="form-control" id="type">
                        @foreach ($type_edit as $type_edit)                                
                                <option value="{{$type_edit->type}}">{{$type_edit->type}}</option>                               
                                @endforeach  
														
												</select>
											</div>
										</div>

                    <div class="form-group row">
											<label class="control-label col-md-3 col-sm-3 label-align">Brand </label>
											<div class="col-md-9 col-sm-9 ">
												<select name="merk"  class="form-control" id="merk">
                        @foreach ($merk_edit as $merk_edit)                                
                                <option value="{{$merk_edit->merk}}">{{$merk_edit->merk}}</option>                               
                                @endforeach  
												</select>
											</div>
										</div>

                    <div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 label-align">Uom</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="text" name="uom"  class="form-control" placeholder="Input Uom"  id="uom">
											</div>
										</div>
									
                    <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 label-align" for="sc">Serialized Code</label><br>
                    <div class="col-md-9 col-sm-9 ">
                    <input type="radio" name="serialized_code" value="Y"  > Yes<br>
                    <input type="radio" name="serialized_code" value="N"  > No<br>
                    </div>
                </div>

										<div class="ln_solid"></div>
										<div class="form-group">
											<div class="col-md-9 col-sm-9  offset-md-3">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
												<button type="submit" class="btn btn-info">Save</button>
											</div>
										</div>

									</form>
							</div>
              
 
						</div>
					
			</div>
		</div>


@endsection

