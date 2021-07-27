
@extends ('layouts/tema')

@section('title','Request For Service')

@section('card_title','Request For Service')

@section('isi')

<a style="color:#fff;" data-toggle="modal" data-target="#importExcel" class="btn btn-success">Receipt Import</a>


<a href="/create_rfs" class="btn btn-success">Add Request For Service</a>
<!-- MULAI TOMBOL TAMBAH -->
<!-- <a href="javascript:void(0)" class="btn btn-success" id="tombol-tambah">Add Customer</a> -->
                <br><br>
                <!-- AKHIR TOMBOL -->
                  <div class="table-responsive">
                  <table id="table_rfs" class="table table-striped  table-bordered">
                      <thead>
                        <tr>
                        <th>No</th>
                          <th scope="col">nomor rfs</th>
                          <!-- <th scope="col">Request Date</th> -->
                          <th scope="col">Request Type</th>
                          <th scope="col">Request From</th>
                          <!-- <th scope="col">Request Media</th> -->
                          <th scope="col">Company Requestor</th>
                          <th scope="col">Company</th>
                          <!-- <th scope="col">Request PIC</th> -->
                          <!-- <th scope="col">Phone Number</th> -->
                          <!-- <th scope="col">Task</th> -->
                          <!-- <th scope="col">Task Description</th> -->
                          <th scope="col">Location</th>
                          <th scope="col">Nomor Polisi</th>
                          <!-- <th scope="col">Response Date</th> -->
                          <!-- <th scope="col">Response By</th> -->
                          <!-- <th scope="col">Response Input By</th> -->
                          <!-- <th scope="col">Response Media</th> -->
                          <th scope="col">Status</th>
                          <!-- <th scope="col">Status Description</th> -->
                          <!-- <th scope="col">Response Duration</th> -->
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
 //script untuk memanggil data json dari server dan menampilkannya berupa datatable\
 function selel2(){
  $("#nomor_polisi").select2();
 }

table = $('#table_rfs').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{{url("/rfs/getdata")}}',
      columns: [
        {
              data: 'DT_RowIndex',
              name: 'DT_RowIndex'
          },
          {
              data: 'rfs_number',
              name: 'rfs_number'
          },
        //   {
        //       data: 'request_date',
        //       name: 'request_date'
        //   },
          {
              data: 'request_type',  
              name: 'request_type'
          },
          {
              data: 'request_from',  
              name: 'request_from'
          },
        //   {
        //       data: 'request_media.request_media',
        //       name: 'request_media.request_media'
        //   },
        {
              data: 'company_requestor',
              name: 'company_requestor'
          },
          {
              data: 'company',
              name: 'company'
          },
          // {
          //     data: 'customer_contact.person_name',
          //     name: 'customer_contact.person_name'
          // },
        //   {
        //       data: 'phone_number',
        //       name: 'phone_number'
        //   },
        //   {
        //       data: 'task',
        //       name: 'task'
        //   },
        //   {
        //       data: 'task_description',
        //       name: 'task_description'
        //   },
          {
              data: 'location',
              name: 'location'
          },
          {
              data: 'nopol',
              name: 'nopol'
          },
        //   {
        //       data: 'nomor_polisi',
        //       name: 'nomor_polisi'
        //   },
        //   {
        //       data: 'response_date',
        //       name: 'response_date'
        //   },
        //   {
        //       data: 'response_by',
        //       name: 'response_by'
        //   },
        //   {
        //       data: 'response_input_by',
        //       name: 'response_input_by'
        //   },
        //   {
        //       data: 'response_media',
        //       name: 'response_media'
        //   },
          {
              data: 'status',
              name: 'status'
          },
        //   {
        //       data: 'status_description',
        //       name: 'status_description'
        //   },
        //   {
        //       data: 'response_duration',
        //       name: 'response_duration'
        //   },
          {
              data: 'action',
              name: 'action'
          },
      ]
  });

     // =================== requestor pic berdasarka pilihan company requestor ============================================

     $('#company_requestor').change(function(){
                    var id = $(this).val();
                    $.ajax({
                        url: '/pic/'+id, 
                          type: 'get',
                          success: function (data) {
                            console.log(data);
                            var option = ``;
                            $.each(data.data, function(index,value){
                            $('#requestor_pic').append(`<option value="`+value.id+`">`+value.person_name+`</option>`)
                            // $("#ca").val(data.data.address_text);
                          });
                            },
                        });
                  });
                // =================== Task berdasarka pilihan Request Type ============================================

        $('#request_type').change( function(){
        var jenis=$(this).val();
        $.ajax({
          url: '/request_type/'+jenis, 
          type: 'get',
          success: function (data) {
          console.log(data);
          var option = ``;
          if(data.jenis=='req'){
              $.each(data.data, function(index,value){
                option += `<option value="`+value.id+`">`+value.name_task+`</option>`;
            });
          }else {
            $.each(data.data, function(index,value){
              option += `<option value="`+value.id+`">`+value.name_task+`</option>`;
            });
          }
          
          $("#task").html(option);
        },
        error: function (data) {
          console.log('Error:', data);
        }

        })
        });

   // =============== EDIT =========================
$('#formEdit').on("submit", function (e) {

e.preventDefault();

$('#editSubmit').html('Mengedit..');

var formData = new FormData(this);

$.ajax({

  data: formData,

  url: "{{route('rfs.update')}}",

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
		$('#company_requestor').change( function(){
          // console.log("asdasdasd");
        var id=$(this).val();
        $.ajax({
          url: '/nomor_polisi/'+id, 
          type: 'get',
          success: function (data) {
          console.log(data);
          var option = '';
            if(data.data.length > 0)
            $.each(data.data, function(index,value){
                option += '<option value="'+value.id+'">'+value.no_polisi+'</option>';
            });
          
          
          $("#nomor_polisi").html(option);
          selel2();
          // $("#nomor_polisi").multi({enable_search: false});

          
            
        },
        error: function (data) {
          console.log('Error:', data);
        }

        })
        });
        
$('body').on('click', '.editBtn', function () {

var id = $(this).data('id');

$.get("/edit/rfs" +'/' + id , function (data) {
	var option = '';
	$.each(data.cmp_requestor, function(index,value){
		option += '<option value="'+value.id+'">'+value.name+'</option>';
	});          
  $("#company_requestor").html(option);
  option = '';
  var select;
	$.each(data.nopol, function(index,value){
		select = false;
		$.each(data.nopolSelected, function(index,v){
			if(value.id == v) select = true;
		});
		if(select)
			option += '<option value="'+value.id+'" selected>'+value.no_polisi+'</option>';
		else	
			option += '<option value="'+value.id+'">'+value.no_polisi+'</option>';
	});   
  $("#nomor_polisi").html(option);
  selel2();

  var option = '';
	$.each(data.pic, function(index,value){
		option += '<option value="'+value.id+'">'+value.person_name+'</option>';
	});          
  $("#requestor_pic").html(option);

  var option = '';
	$.each(data.req_type, function(index,value){
		option += '<option value="'+value.id+'">'+value.name_task+'</option>';
	});          
  $("#task").html(option);
  // $("#nomor_polisi").multi({
	// enable_search: false
  // }); 
  
  $('#editModal').modal('show');
  $('#editId').val(data.id);

  $('#rfs_number').val(data.rfs_number);
  $('#request_date').val(data.request_date);
  $('#request_type').val(data.request_type);
  $('#reques_from').val(data.request_from);
  $('#request_media').val(data.request_media);            
  $('#company_requestor').val(data.company_requestor);
  $('#company').val(data.company);
  $('#requestor_pic').val(data.id_requestor_pic);
  $('#phone_number').val(data.phone_number);
  $('#task').val(data.task);
  $('#task_description').val(data.task_description);
  $('#location').val(data.location);
  $('#response_date').val(data.response_date);
  $('#response_by').val(data.response_by);
  $('#response_input_by').val(data.response_input_by);
  $('#response_media').val(data.response_media);
  $('#status').val(data.status);
  $('#status_description').val(data.status_description);
  $('#response_duration').val(data.response_duration);
})
});

// ================================== multi select nopol ================================


// pilihan reqest from otomatis

$('#reques_from').change( function(){
        var jenis=$(this).val();
        $.ajax({
          url: '/request_from/'+jenis, 
          type: 'get',
          success: function (data) {
          console.log(data);
          var option = ``;
          if(data.jenis=='eks'){
              $.each(data.data, function(index,value){
                option += `<option value="`+value.id+`">`+value.name+`</option>`;
            });
          }else {
            $.each(data.data, function(index,value){
              option += `<option value="`+value.id+`">`+value.name+`</option>`;
            });
          }
          
          $("#company_requestor").html(option);
        },
        error: function (data) {
          console.log('Error:', data);
        }

        })
        });

// ================== DETAIL ===================

$('body').on('click', '.detailBtn', function () {

var id = $(this).data('id');

$.get("rfs-detail/"+id+"/", function (data) {
  // var task = '';
	// $.each(data.task, function(index,value){
	// 	task += $('#Dtask').val(data.name_task)
	// });          
  // $("#Dtask").html(task);

  $('#detailModal').modal('show');
  $('#Drfs_number').html(data.rfs_number);
  $('#Drequest_date').html(data.request_date);
  $('#Drequest_type').html(data.request_type);
  $('#Drequest_from').html(data.request_from);
  $('#Drequest_media').html(data.request_media);
  $('#Dcompany_requestor').html(data.company_requestor);
  $('#Dcompany').html(data.company);
  $('#Drequestor_pic').html(data.customer_contact);
  $('#Dphone_number').html(data.phone_number);
  $('#Dtask').html(data.task);
  $('#Dtask_description').html(data.task_description);
  $('#Dlocation').html(data.location);
  $('#Dnomor_polisi').html(data.nomor_polisi);
  $('#Dresponse_date').html(data.response_date);
  $('#Dresponse_by').html(data.response_by);
  $('#Dresponse_input_by').html(data.response_input_by);
  $('#Dresponse_media').html(data.response_media);
  $('#Dstatus').html(data.status);
  $('#Dstatus_description').html(data.status_description);
  $('#Dresponse_duration').html(data.response_duration);
  $('#Dcreated_at').html(data.created_at);
  $('#Dcreated_by').html(data.created_by);
  $('#Dupdated_at').html(data.updated_at);
  $('#Dupdated_by').html(data.updated_by);
  
})
});


// ================== NOPOL ====================
// ================== DETAIL NOPOL===================

$('body').on('click', '.nopolBtn', function () {

var id = $(this).data('id');

$.get("nopol-detail/"+id+"/", function (data) {

  $('#detailModal').modal('show');
  $('#nomor_polisi').val(data.nomor_polisi);
  
})
});



// ================== HAPUS ===================

$('body').on('click', '.hapusBtn', function () {

var id = $(this).data("id");    // Harus Data pakenya

confirm("Are You sure want to delete !");

$.ajax({

  type: "DELETE",

  url: '/delete/rfs/'+id,

  success: function (data) {

    table.draw();

  },

  error: function (data) {

    console.log('Error:', data);

  }

});


});

    // =================== phone number otomatis berdasarka pilihan pic ============================================

    $('#requestor_pic').change(function(){
             var id = $(this).val();
             $.ajax({
                 url: '/phone/'+id, 
                   type: 'get',
                  success: function (data) {
                     console.log(data);
                     $("#phone_number").val(data.data.phone_mobile);
                     
                    },
                });
          });

});
</script>
@endsection


@section('modal')


 <!-- Import Excel -->
 <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<form method="post" action="/rfs/import" enctype="multipart/form-data">
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

<!-- ****************************************************** MODAL Edit  **************************************************** -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog " style="max-width: 60%;" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Edit Request For Service</h5>
						</div>
						<div class="modal-body">
                            <div class="row">
						        <div class="col-md-12 ">
							        <div class="x_panel">
                      <form id="formEdit">
            <input type="hidden" id="editId" name="id"></input>
                       @csrf

                       <div class="form-group row">
											<label class="col-form-label col-md-4 col-sm-4 label-align">Request Date :</label>
											<div class="col-md-6 col-sm-6 ">
                      <input type="datetime-local" class="form-control" id="request_date" name="request_date" >
                </div> <br>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4 col-sm-4 label-align">Request Type :</label>
											<div class="col-md-6 col-sm-6 ">
                      <select name="request_type" id="request_type" class="form-control" required>
                          <option value="">Choose Request Type</option>                              
                                <option value="Request">Request</option>
                                <option value="Complain">Complain</option>
                  </select>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4 col-sm-4 label-align">Request From :</label>
											<div class="col-md-6 col-sm-6 ">
                      <select id="reques_from" name="request_from" class="form-control" required>
                          <option value="">Choose request from</option>
                              <option value="Internal">Internal</option>
                              <option value="Eksternal">Eksternal</option>
                  </select>
											</div>
										</div>
                    <div class="form-group row">
											<label class="col-form-label col-md-4 col-sm-4 label-align">Request Media :</label>
											<div class="col-md-6 col-sm-6 ">
                      <select id="request_media" name="request_media" class="form-control" required>
                          <option value="">Choose Request media</option>
                          <option value="WhatsApp">WhatsApp</option>
                                <option value="Call">Call</option>
                                <option value="Email">Email</option>
                  </select>											
                  </div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4 col-sm-4 label-align">Company Requestor :</label>
											<div class="col-md-6 col-sm-6 ">
                      <select class="form-control" id="company_requestor" placeholder="input name company requestor" name="company_requestor">
                     
                      </select>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4 col-sm-4 label-align">Company :</label>
											<div class="col-md-6 col-sm-6 ">
                      <select id="company" name="company" class="form-control" required>
                          <option value="">Choose company</option>
                              <option value="IU">Integrasia Utama</option>
                              <option value="SISI">SISI</option>
                              <option value="AGIT">AGIT</option>

                  </select> 
                  </div>
										</div>
                    <div class="form-group row">
											<label class="col-form-label col-md-4 col-sm-4 label-align">Requestor PIC :</label>
											<div class="col-md-6 col-sm-6 ">
                      <select id="requestor_pic" name="requestor_pic" class="form-control" >
                         
                  </select>
                    	</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4 col-sm-4 label-align">Phone Number : </label>
											<div class="col-md-6 col-sm-6 ">
                      <input type="number" class="form-control" id="phone_number" placeholder="input phone_number" name="phone_number" >											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4 col-sm-4 label-align">Task :</label>
											<div class="col-md-6 col-sm-6 ">
                      <select id="task" name="task" class="form-control" >
                      <!-- <option value="">Choose Task</option>
                      <option value="">----REQUEST TASK----</option>
                      <option value="">Edit/Add/Delete Master Data</option>
                      <option value="">Integrasi TMS</option>
                      <option value="">Pemasangan/Maintenandce/Mutasi/Pelepasan GPS</option>
                      <option value="">Reporting</option>
                      <option value="">Request Aktifasi Kartu</option>
                      <option value="">Request Data GPS</option>
                      <option value="">Request Non Aktif Layanan</option>
                      <option value="">Request Pendaftaran ke SILACAK</option>
                      <option value="">Request Re-aktifasi GPS</option>
                      <option value="">Tampilan OSLOG </option>
                      <option value="">Request Training OSLOG</option>
                      <option value="">Request SMS Immobilizer </option>
                      <option value="">Request SMS Koordinat Kendaraan</option>
                      <option value=""></option>
                      <option value="">----COMPLAIN TASK----</option>
                      <option value="">Edit/Add/Delete Master Data</option>
                      <option value="">Integrasi TMS</option>
                      <option value="">Notifikasi Emain</option>
                      <option value="">Permasalahan GPS</option>
                      <option value="">Reporting</option>
                      <option value="">Tampilan OSLOG</option>
                      <option value="">Permasalahan Sensor</option> -->
                      </select>
											</div>
										</div>
                    <div class="form-group row">
											<label class="col-form-label col-md-4 col-sm-4 label-align">Task Description :</label>
											<div class="col-md-6 col-sm-6 ">
                      <textarea  cols="40" class="form-control" id="task_description" placeholder="input task description" name="task_description" ></textarea>											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4 col-sm-4 label-align">Location : </label>
											<div class="col-md-6 col-sm-6 ">
                      <textarea  cols="40" class="form-control" id="location" placeholder="input location" name="location" ></textarea>											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4 col-sm-4 label-align">Nomor Polisi :</label>
											<div class="col-md-6 col-sm-6 ">
                      <select id="nomor_polisi" name="nomor_polisi[]" multiple class="form-control " style="height:300px;width:100%;">
                      </select>                       
                      </div>
										</div>
                    <div class="form-group row">
											<label class="col-form-label col-md-4 col-sm-4 label-align">Response date :</label>
											<div class="col-md-6 col-sm-6 ">
                      <input type="datetime-local" class="form-control" id="response_date" placeholder="input response date" name="response_date" >											</div>
										</div>
                      
                    <div class="form-group row">
											<label class="col-form-label col-md-4 col-sm-4 label-align">Response By :</label>
											<div class="col-md-6 col-sm-6 ">
                      <input type="text" class="form-control" id="response_by" placeholder="input response by" name="response_by" >											
                      </div>
										</div>

                    <div class="form-group row">
											<label class="col-form-label col-md-4 col-sm-4 label-align ">Response Media :</label>
											<div class="col-md-6 col-sm-6 ">
                      <select id="response_media" name="response_media" class="form-control" required>       
                          <option value="">Choose response media</option>
                                <option value="WhatsApp">WhatsApp</option>
                                <option value="Call">Call</option>
                                <option value="Email">Email</option>

                  </select>  											
                  </div>
										</div>
                    <div class="form-group row">
											<label class="col-form-label col-md-4 col-sm-4 label-align">Status :</label>
											<div class="col-md-6 col-sm-6 ">
                      <select id="status" name="status" class="form-control" required>       
                          <option value="">Choose Status</option>
                          <option value="ON PROGRESS">ON PROGRESS</option>
                                <option value="DONE">DONE</option>

                  </select>
									</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4 col-sm-4 label-align">Status Description :</label>
											<div class="col-md-6 col-sm-6 ">
                      <textarea  cols="40" class="form-control" id="status_description" placeholder="input status description" name="status_description" ></textarea>											</div>
										</div>
									
               

          <!--=================================================== End Teknisi & Attachment =============================================== -->

          <div class="modal-footer">
                  <div class="form-group">
						 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						 <button type="submit" class="btn btn-info">Save</button>
						</div>
					</div>
                </form>
				</div>
			  </div>
		    </div>
           </div>
		  </div>
		</div>
        </div>




<!-- Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailHeader" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailHeader">Detail Request For Service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-row">
          <div class="col-md-12">

          <table class="table table-bordered table-hover">
            <thead>
              <tr>
              <td align="right"><b><b>RFS Number  :</b></td>
              <td  id="Drfs_number"></td>
              </tr>

              <tr>
              <td align="right"><b>Request Date  :</b></td>
              <td id="Drequest_date"></td>
              </tr>

              <tr>
              <td align="right"><b>Request Type  :</b></td>
              <td id="Drequest_type"></td>
              </tr>

              <tr>
              <td align="right"><b>Request From  :</b></td>
              <td id="Drequest_from"></td>
              </tr>

              <tr>
              <td align="right"><b>Request Media  :</b></td>
              <td id="Drequest_media"></td>
              </tr>


              <tr>
              <td align="right"><b>Company Requestor  :</b></td>
              <td id="Dcompany_requestor"></td>
              </tr>

              <tr>
              <td align="right"><b>Company  :</b></td>
              <td id="Dcompany"></td>
              </tr>

              <tr>
              <td align="right"><b>Requestor PIC  :</b></td>
              <td id="Drequestor_pic"></td>
              </tr>

              <tr>
              <td align="right"><b>Phone Number  :</b></td>
              <td id="Dphone_number"></td>
              </tr>

              <tr>
              <td align="right"><b>Task  :</b></td>
              <td id="Dtask"></td>
              </tr>

              <tr>
              <td align="right"><b>Task Description  :</b></td>
              <td id="Dtask_description"></td>
              </tr>

              <tr>
              <td align="right"><b>Location  :</b></td>
              <td id="Dlocation"></td>
              </tr>

              <tr>
              <td align="right"><b>Response Date  :</b></td>
              <td id="Dresponse_date"></td>
              </tr>

              <tr>
              <td align="right"><b>Response By  :</b></td>
              <td id="Dresponse_by"></td>
              </tr>

              <tr>
              <td align="right"><b>Response Input By  :</b></td>
              <td id="Dresponse_input_by"></td>
              </tr>

              <tr>
              <td align="right"><b>Response Media  :</b></td>
              <td id="Dresponse_media"></td>
              </tr>

              <tr>
              <td align="right"><b>Response Status  :</b></td>
              <td id="Dstatus"></td>
              </tr>

              <tr>
              <td align="right"><b>Response Status Description  :</b></td>
              <td id="Dstatus_description"></td>
              </tr>

             
              
              </tr>
            </thead>
            </table>
           
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Import Excel -->
<div class="modal fade" id="importExcel1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<form method="post" action="/rfs/import" enctype="multipart/form-data">
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
