@extends ('layouts/tema')

@section('title','Master Data GPS')

@section('card_title','Master Data GPS')

@section('isi')

<style>
            /* .modal-content {
               background:#DCDCDC;
            } */
 </style>

<a href="/add_gps_installation" class="btn btn-success">Add</a>
<!-- <a style="color:#fff;" data-toggle="modal" data-target="#ModalAdd" class="btn btn-warning">Add</a> -->
<a style="color:#fff;" data-toggle="modal" data-target="#importExcel"  class="btn btn-success"> Import</a>


                  <div class="table-responsive">
                  <table id="table_gps_installation" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <!-- <th scope="col">No</th> -->
                          <th scope="col">NO</th>
                          <th scope="col">COMPANY</th>
                          <th scope="col">VEHICLE NUMBER</th>
                          <th scope="col">PO NUMBER</th>
                          <th scope="col">PO DATE</th>
                          <th scope="col">IMEI</th>
                          <th scope="col">GSM</th>
                          <th scope="col">SENSOR</th>
                          <!-- <th scope="col">GPS Owned By</th> -->
                          <th scope="col">MERK</th>
                          <th scope="col">TYPE</th>
                          <th scope="col">AREA PASANG</th>
                          <th scope="col">TANGGAL PASANG</th>
                          <th scope="col">PORT</th>
                          <th scope="col">STATUS</th>
                          <th scope="col">KETERANGAN</th>
                          <th scope="col">GSM LAMA</th>
                          <th scope="col">TGL TERMINATE GSM</th>
                          <th scope="col">IMEI LAMA</th>
                          <th scope="col">NOPOL LAMA</th>
                          <th scope="col">STATUS</th>
                          <!-- <th scope="col">POOL NAMA</th> -->
                          <!-- <th scope="col">POOL LOCATION</th> -->
                          <!-- <th scope="col">WARRANTY</th> -->

                        </tr>
                      </thead>
                      
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
 //MULAI DATATABLE
 //script untuk memanggil data json dari server dan menampilkannya berupa datatable

table = $('#table_gps_installation').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{{url("/gps/getdata")}}',
      columns: [
          {
              data: 'DT_RowIndex',
              name: 'DT_RowIndex'
          },
          {
              data: 'customer.name',
              name: 'customer.name'
          },
          {
              data: 'no_polisi',
              name: 'no_polisi'
          },
          {
              data: 'po_customer_number',
              name: 'po_customer_number'
          },
          {
              data: 'po_customer_date',  
              name: 'po_customer_date'
          },
          {
              data: 'imei',
              name: 'imei'
          },
          {
              data: 'gsm_number',
              name: 'gsm_number'
          },
          {
              data: 'gsm_number',
              name: 'gsm_number'
          },
          // {
          //     data: 'gps_owned_by',
          //     name: 'gps_owned_by'
          // },
          {
              data: 'merk',
              name: 'merk'
          },
          {
              data: 'type',
              name: 'type'
          },
         
          {
              data: 'installation_location',
              name: 'installation_location'

          },
          {
            data: 'gps_install_date',
            name: 'gps_install_date'
          },
          {
            data: 'gps_port',
            name: 'gps_port'
          },
          {
            data: 'gps_status',
            name: 'gps_status'
          },
          {
            data: 'note',
            name: 'note'
          },
          {
            data: 'ex_gsm_number',
            name: 'ex_gsm_number'
          },
          {   
            data: 'gsm_terminated_date',
            name: 'gsm_terminated_date'
          },
          {
            data: 'ex_imei',
            name: 'ex_imei'
          },
          {
            data: 'ex_no_polisi',
            name: 'ex_no_polisi'
          },
          {
            data: 'oslog_status',
            name: 'oslog_status'
          },
          // {
          //   data: 'pool_nama',
          //   name: 'pool_name'
          // },
          // {
          //   data: 'pool_nama',
          //   name: 'pool_location'
          // },
          // {
          //   data: 'pool_nama',
          //   name: 'warranty'
          // }



      ]
  });

  // =============== EDIT =========================
$('#formEdit').on("submit", function (e) {

e.preventDefault();

$('#editSubmit').html('Mengedit..');

var formData = new FormData(this);

$.ajax({

  data: formData,

  url: "{{route('gps_install.update')}}",

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

$.get("/edit/gps_install" +'/' + id , function (data) {

  $('#editModal').modal('show');
  $('#editId').val(data.id);
  
  // mengisi value berdasarkan id
  $('#id_customer').val(data.id_customer);


  // $("#customer").val(data.customer_id);
  console.log(data.id);

  $('#no_polisi').val(data.no_polisi);
  $('#po_customer_number').val(data.po_customer_number);
  $('#po_customer_date').val(data.po_customer_date);
  $('#imei').val(data.imei);
  $('#gsm_number').val(data.gsm_number);
  $('#merk').val(data.merk);
  $('#type').val(data.type);
  $('#gsm_provider').val(data.gsm_provider);
  $('#gps_owned_by').val(data.gps_owned_by);
  $('#gps_status').val(data.gps_status);
  $('#gps_install_date').val(data.gps_install_date);
  $('#gps_uninstall_date').val(data.gps_uninstall_date);
  $('#remarks').val(data.remarks);
  $('#fuel_sensor').val(data.fuel_sensor);
  $('#door_sensor').val(data.door_sensor);
  $('#door_sensor_remarks').val(data.door_sensor_remarks);
  $('#immobilizer_sensor').val(data.immobilizer_sensor);
  $('#rfid_sensor').val(data.rfid_sensor);
  $('#temperature_sensor').val(data.temperature_sensor);
  $('#temperature_sensor_remarks').val(data.temperature_sensor_remarks);
  $('#button_sensor').val(data.button_sensor);
  $('#button_sensor_remarks').val(data.button_sensor_remarks);
  $('#dump_sensor').val(data.dump_sensor);
  $('#tail_sensor').val(data.tail_sensor);
  $('#camera_sensor').val(data.camera_sensor);
  $('#pust_to_talk').val(data.pust_to_talk);
  $('#gps_port').val(data.gps_port);
  $('#installation_location').val(data.installation_location);
  $('#oslog_status').val(data.oslog_status);
  $('#oslog_inactive_date').val(data.oslog_inactive_date);
  $('#oslog_active_date').val(data.oslog_active_date);
  $('#gsm_terminated_date').val(data.gsm_terminated_date);
  $('#ex_no_polisi').val(data.ex_no_polisi);
  $('#ex_imei').val(data.ex_imei);
  $('#ex_gsm_number').val(data.ex_gsm_number);
  $('#note').val(data.note);



})
});


   // ================== DETAIL ===================

   $('body').on('click', '.detailBtn', function () {

var id = $(this).data('id');

$.get("gps-detail/"+id+"/", function (data) {

  $('#detailModal').modal('show');
  $('#Dcustomer').html(data.customer);                              // DIKASI D DI AWAL CUMA BUAT NGEBEDAIN ID NYA AJA, BIAR GA DOUBLE
 
  $('#Dno_polisi').html(data.no_polisi);
  $('#Dpo_customer_number').html(data.po_customer_number);
  $('#Dpo_customer_date').html(data.po_customer_date);
  $('#Dimei').html(data.imei);
  $('#Dgsm_number').html(data.gsm_number);
  $('#Dmerk').html(data.merk);
  $('#Dtype').html(data.type);
  $('#Dgsm_provider').html(data.gsm_provider);
  $('#Dgps_owned_by').html(data.gps_owned_by);
  $('#Dgps_status').html(data.gps_status);
  $('#Dgps_install_date').html(data.gps_install_date);
  $('#Dgps_uninstall_date').html(data.gps_uninstall_date);
  $('#Dremarks').html(data.remarks);
  $('#Dfuel_sensor').html(data.fuel_sensor);
  $('#Ddoor_sensor').html(data.door_sensor);
  $('#Ddoor_sensor_remarks').html(data.door_sensor_remarks);
  $('#Dimmobilizer_sensor').html(data.immobilizer_sensor);
  $('#Drfid_sensor').html(data.rfid_sensor);
  $('#Dtemperature_sensor').html(data.temperature_sensor);
  $('#Dtemperature_sensor_remarks').html(data.temperature_sensor_remarks);
  $('#Dbutton_sensor').html(data.button_sensor);
  $('#Dbutton_sensor_remarks').html(data.button_sensor_remarks);
  $('#Ddump_sensor').html(data.dump_sensor);
  $('#Dtail_sensor').html(data.tail_sensor);
  $('#Dcamera_sensor').html(data.camera_sensor);
  $('#Dpust_to_talk').html(data.pust_to_talk);
  $('#Dgps_port').html(data.gps_port);
  $('#Dinstallation_location').html(data.installation_location);
  $('#Doslog_status').html(data.oslog_status);
  $('#Doslog_inactive_date').html(data.oslog_inactive_date);
  $('#Doslog_active_date').html(data.oslog_active_date);
  $('#Dgsm_terminated_date').html(data.gsm_terminated_date);
  $('#Dex_no_polisi').html(data.ex_no_polisi);
  $('#Dex_imei').html(data.ex_imei);
  $('#Dex_gsm_number').html(data.ex_gsm_number);
  $('#Dnote').html(data.note);





})
});

// ================== HAPUS ===================

$('body').on('click', '.hapusBtn', function () {

var id = $(this).data("id");    // Harus Data pakenya

confirm("Are You sure want to delete !");

$.ajax({

  type: "DELETE",

  url: '/delete/gps_install/'+id,

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
				<form method="post" action="/gps/import" enctype="multipart/form-data">
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
    
 
  <!-- GPS INSTALLATION DETAIL -->
  <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog " style="max-width: 75%;" role="document">
				<form method="post" action="/gps/import" enctype="multipart/form-data">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Detail GPS Installation</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
						</div>
						<div class="modal-body">
 
            <form action="/add_gps_install" method="POST" autocomplete="off" enctype="multipart/form-data">
              @csrf
                  <div class="form-group col-sm-4">
                  <table class="table table-bordered table-hover">
            <thead>
              <tr>
              <td align="right"><b><b>Customer  :</b></td>
              <td id="Dcustomer"></td>
              </tr>

              <tr>
              <td align="right"><b>Nomor Polisi  :</b></td>
              <td id="Dno_polisi"></td>
              </tr>

              <tr>
              <td align="right"><b>PO Customer  :</b></td>
              <td id="Dpo_customer_number"></td>
              </tr>

              <tr>
              <td align="right"><b>PO Date  :</b></td>
              <td id="Dpo_customer_date"></td>
              </tr>

              <tr>
              <td align="right"><b><b>GPS  </b></b></td>
              <td></td>
              </tr>


              <tr>
              <td align="right"><b>GPS IMEI  :</b></td>
              <td id="Dimei"></td>
              </tr>

              <tr>
              <td align="right"><b>GPS Own By  :</b></td>
              <td id="Dgps_owned_by"></td>
              </tr>

              <tr>
              <td align="right"><b>GPS Brand  :</b></td>
              <td id="Dmerk"></td>
              </tr>

              <tr>
              <td align="right"><b>GPS Type  :</b></td>
              <td id="Dtype"></td>
              </tr>

              <tr>
              <td align="right"><b>GPS Status  :</b></td>
              <td id="Dgps_status"></td>
              </tr>
              <tr>
              <td align="right"><b>GPS Install Date  :</b></td>
              <td id="Dgps_install_date" ></td>
              </tr>

              <tr>
              <td align="right"><b>GPS Uninstall Date  :</b></td>
              <td id="Dgps_uninstall_date"></td>
              </tr>

              <tr>
              <td align="right"><b>Installation Location  :</b></td>
              <td id="Dinstallation_location"></td>
              </tr>

              <tr>
              <td align="right"><b>Remarks  :</b></td>
              <td id="Dremarks"></td>
              </tr>

             
              
              </tr>
            </thead>
            </table>

</div>                
              
              
              
              <!-- =========================================  SEBELAHNYA  =============================================================== -->
                            <div class="form-group col-sm-4">
                            <table class="table table-bordered table-hover">
            <thead>
            <tr>
              <td align="right"><b><b>GSM</b></b></td>
              <td ></td>
              </tr>

              <tr>
              <td align="right"><b>GSM  :</b></td>
              <td id="Dgsm_number"></td>
              </tr>

              <tr>
              <td align="right"><b>GSM Provider  :</b></td>
              <td id="Dgsm_provider"></td>
              </tr>

              <tr>
              <td align="right"><b><b>OSLOG</b></b></td>
              <td ></td>
              </tr>

              <tr>
              <td align="right"><b>OSLOG Status  :</b></td>
              <td id="Doslog_status"></td>
              </tr>

              <tr>
              <td align="right"><b>OSLOG Active Date  :</b></td>
              <td id="Doslog_active_date"></td>
              </tr>

              <tr>
              <td align="right"><b>OSLOG Inactive Date  :</b></td>
              <td id="Doslog_inactive_date" ></td>
              </tr>
              
              <tr>
              <td align="right"><b><b>Note </b></b></td>
              <td ></td>
              </tr>

              <tr>
              <td align="right"><b>EX Nomor Polisi  :</b></td>
              <td id="Dex_no_polisi"></td>
              </tr>

              <tr>
              <td align="right"><b>EX IMEI (GPS)   :</b></td>
              <td id="Dex_imei"></td>
              </tr>

              <tr>
              <td align="right"><b>EX GSM Number  :</b></td>
              <td id="Dex_gsm_number" ></td>
              </tr>

              <tr>
              <td align="right"><b>Remarks  :</b></td>
              <td id="Dnote" ></td>
              </tr>

             
              
              </tr>
            </thead>
            </table>

              </form>
							</div>
                <!-- =========================================  SEBELAHNYA  =============================================================== -->
                <div class="form-group col-sm-4">
                            <table class="table table-bordered table-hover">
            <thead>
              <tr>
              <td align="right"><b><b>ACCESSORIES  </b></td>
              <td  ></td>
              </tr>

              <tr>
              <td align="right"><b>Door  :</b></td>
              <td id="Ddoor_sensor"></td>
              </tr>

              <tr>
              <td align="right"><b>Remarks  :</b></td>
              <td id="Ddoor_sensor_remarks"></td>
              </tr>

              <tr>
              <td align="right"><b>Temperature  :</b></td>
              <td id="Dtemperature_sensor"></td>
              </tr>

              <tr>
              <td align="right"><b>Remarks  :</b></td>
              <td id="Dtemperature_sensor_remarks"></td>
              </tr>


              <tr>
              <td align="right"><b>Button  :</b></td>
              <td id="Dbutton_sensor"></td>
              </tr>

              <tr>
              <td align="right"><b>Remarks  :</b></td>
              <td id="Dbutton_sensor_remarks"></td>
              </tr>

              <tr>
              <td align="right"><b>Fuel  :</b></td>
              <td id="Dfuel_sensor"></td>
              </tr>

              <tr>
              <td align="right"><b>Immobilizer  :</b></td>
              <td id="Dimmobilizer_sensor"></td>
              </tr>

              <tr>
              <td align="right"><b>RFID  :</b></td>
              <td id="Drfid_sensor"></td>
              </tr>
              <tr>
              <td align="right"><b>Dump  :</b></td>
              <td id="Ddump_sensor"></td>
              </tr>

              <tr>
              <td align="right"><b>Tail  :</b></td>
              <td id="Dtail_sensor" ></td>
              </tr>

              <tr>
              <td align="right"><b>Camera  :</b></td>
              <td id="Dcamera_sensor"></td>
              </tr>

              <tr>
              <td align="right"><b>Push To Talk  :</b></td>
              <td id="Dpust_to_talk"></td>
              </tr>

             
              
              </tr>
            </thead>
            </table>

              </form>
							</div>
              
 
						</div>
					</div>
				</form>
			</div>
		</div>
    <!-- GPS INSTALLATION EDIT -->
 <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog " style="max-width: 75%;" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Edit GPS Installation</h5>
						</div>
						<div class="modal-body">
 
            <form id="formEdit">
            <input type="hidden" id="editId" name="id"></input>
            {{csrf_field()}}
              @method('POST')
                  <div class="form-group col-sm-6">
                <h6 ><b>CUSTOMER</b></h6>
                <label class="col-form-label col-md-4 col-sm-4 label-align">Customer : </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select id='id_customer' name="id_customer" class="form-control">       
                                                  @foreach ($customer as $customer)
                                        <option value="{{$customer->id}}" >{{$customer->name}}</option>
                                      @endforeach 
                                                   
                                                   
                                        </select> 
                                        </div>
                <label class="col-form-label col-md-4 col-sm-4 label-align">Nomor Polisi : </label>
                                    <div class="col-md-6 col-sm-6 ">
                                    <input type="text" name="no_polisi" id="no_polisi" class="form-control" >

                                        </div>
                <br><br><br><label class="col-form-label col-md-4 col-sm-4 label-align">PO Customer : </label>
                                     <div class="col-md-6 col-sm-6 ">
                                        <input type="text" name="po_customer_number" id="po_customer_number" class="form-control" >
                                        </div>
                <br><br><br><label class="col-form-label col-md-4 col-sm-4 label-align">PO Date : </label>
                                     <div class="col-md-6 col-sm-6 ">
                                        <input type="date" name="po_customer_date" id="po_customer_date" class="form-control" >
                                        </div>
                <br><br><br><br>
                <h6 ><b>GPS</b></h6><label class="col-form-label col-md-4 col-sm-4 label-align">GPS IMEI : </label>
                                     <div class="col-md-6 col-sm-6 ">
                                        <input type=text  name="imei" id="imei" class="form-control" >
                                        </div>

                
                <br><label class="col-form-label col-md-4 col-sm-4 label-align">GPS Own By : </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type=text  name="gps_owned_by" id="gps_owned_by" class="form-control" >
                                        </div>
                                        

                <br><label class="col-form-label col-md-4 col-sm-4 label-align">GPS Brand : </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select id='merk' name="merk" class="form-control">       
                                                    <option value="">--Pilih Brand--</option>
                                                    @foreach ($merk as $merk)
                                                      <option value="{{$merk->merk}}">{{$merk->merk}}</option>
                                                   @endforeach
                                                    
                                                   
                                        </select>
                                        </div>
               <br><br><br><label class="col-form-label col-md-4 col-sm-4 label-align">GPS Type : </label>
                                     <div class="col-md-6 col-sm-6 ">
                                        <input type="text" name="type" id="type" class="form-control" >
                                        </div>
                <br><br><br><label class="col-form-label col-md-4 col-sm-4 label-align">GPS Status : </label>
                                     <div class="col-md-6 col-sm-6 ">
                                        <select id='gps_status'  name="gps_status" class="form-control">       
                                                    <option value="">--Pilih Status--</option>
                                                    <option value="Sewa">Sewa</option>
                                                    <option value="Beli">Beli</option>
                                                    <option value="Sewa Beli">Sewa Beli</option>
                                                    <option value="Trial">Trial</option>
                                                   
                                        </select>
                                        </div>
               <br><br><label class="col-form-label col-md-4 col-sm-4 label-align">GPS Install Date </label>
                                     <div class="col-md-6 col-sm-6 ">
                                        <input type="date" name="gps_install_date" id="gps_install_date" class="form-control" >
                                        </div>
                <br><br><label class="col-form-label col-md-4 col-sm-4 label-align">GPS Uninstall Date : </label>
                                     <div class="col-md-6 col-sm-6 ">
                                        <input type="date" name="gps_uninstall_date" id="gps_uninstall_date" class="form-control" >
                                        </div>
               <br><br><label class="col-form-label col-md-4 col-sm-4 label-align">Installation Location : </label>
                                     <div class="col-md-6 col-sm-6 ">
                                        <input type="text" name="installation_location" id="installation_location" class="form-control" >
                                        </div>
               <br><br><label class="col-form-label col-md-4 col-sm-4 label-align">Remarks : </label>
                                     <div class="col-md-6 col-sm-6 ">
                                        <input type="text" name="remarks" id="remarks" class="form-control" >
                                        </div>
                <br><br><br><br>
                <h6 ><b>GSM</b></h6><label class="col-form-label col-md-4 col-sm-4 label-align">GSM : </label>
                                     <div class="col-md-6 col-sm-6 ">
                                        <input type=text  name="gsm_number" id="gsm_number" class="form-control" >
                                        </div>
                <br><br><label class="col-form-label col-md-4 col-sm-4 label-align">GSM Provider : </label>
                                     <div class="col-md-6 col-sm-6 ">
                                        <input type="text" name="gsm_provider" id="gsm_provider" class="form-control" >
                                        </div>
                <br><br><br><br>
                <h6 ><b>OSLOG</b></h6><label class="col-form-label col-md-4 col-sm-4 label-align">OSLOG Status : </label>
                                     <div class="col-md-6 col-sm-6 ">
                                        <select id="oslog_status" name="oslog_status" class="form-control">       
                                                    <option value="">--Pilih Status--</option>
                                                    <option value="Aktif">Aktif</option>
                                                    <option value="Non Aktif">Non Aktif</option>
                                                   
                                        </select>
                                        </div>
                <br><label class="col-form-label col-md-4 col-sm-4 label-align">OSLOG Active Date : </label>
                                     <div class="col-md-6 col-sm-6 ">
                                        <input type="date"  name="oslog_active_date" id="oslog_active_date" class="form-control" >
                                        </div>

                <br><label class="col-form-label col-md-4 col-sm-4 label-align">OSLOG Inactive Date </label>
                                     <div class="col-md-6 col-sm-6 ">
                                        <input type="date"  name="oslog_inactive_date" id="oslog_inactive_date" class="form-control" >
                                        </div>

              
                                     </div>

                                     
              
              
              
              <!-- =========================================  SEBELAHNYA  =============================================================== -->
                            <div class="form-group col-sm-6">
                            <h6 ><b>ACCESSORIES</b></h6>
                            
							<label class="col-form-label col-md-4 col-sm-4 label-align">Door :</label>
								<div class="col-md-6 col-sm-6 ">
									<input class="form-control" type="number"  name="door_sensor" id="door_sensor" maks="1">
								</div>	
                            
                        <br><br><label class="col-form-label col-md-4 col-sm-4 label-align">Remarks : </label>
								<div class="col-md-6 col-sm-6 ">
									<input type="text" class="form-control"  name="door_sensor_remarks" id="door_sensor_remarks">
								</div>


                        <br><br><br><br>      
							<label class="col-form-label col-md-4 col-sm-4 label-align">Temperature : </label>
								<div class="col-md-6 col-sm-6 ">
							    	<input type="text" class="form-control" name="temperature_sensor" id="temperature_sensor">
								</div>						
               
							<br><br><label class="col-form-label col-md-4 col-sm-4 label-align">Remarks: </label>
								<div class="col-md-6 col-sm-6 ">
									<input type="text" class="form-control" name="temperature_sensor_remarks" id="temperature_sensor_remarks">
								</div>


               <br><br><br><br>
                <label class="col-form-label col-md-4 col-sm-4 label-align">Button :</label>
							    <div class="col-md-6 col-sm-6 ">
									<input type="text" class="form-control" name="button_sensor" id="button_sensor">
								</div>
               <br><br><label class="col-form-label col-md-4 col-sm-4 label-align">Remarks :</label>
								<div class="col-md-6 col-sm-6 ">
                        <input type="text" class="form-control" name="button_sensor_remarks" id="button_sensor_remarks">
								</div>

               <br><br><br><br>
                <label class="col-form-label col-md-4 col-sm-4 label-align">Fuel :</label>
								<div class="col-md-6 col-sm-6 ">
									<input class="form-control" type="number"  name="fuel_sensor" id="fuel_sensor">
								</div>	
                       
                       <br><br><br><label class="col-form-label col-md-4 col-sm-4 label-align">Immobilizer : : </label>
								<div class="col-md-6 col-sm-6 ">
							    	<input type="text" class="form-control" name="immobilizer_sensor" id="immobilizer_sensor">
								</div>						
              <br><br><br><label class="col-form-label col-md-4 col-sm-4 label-align">RFID : </label>
								<div class="col-md-6 col-sm-6 ">
							    	<input type="text" class="form-control" name="rfid_sensor" id="rfid_sensor">
								</div>
               						
                <br><br><br><br>
               
							<label class="col-form-label col-md-4 col-sm-4 label-align">Dump : </label>
								<div class="col-md-6 col-sm-6 ">
									<input type="text" class="form-control" name="dump_sensor" id="dump_sensor">
								</div>
               
                             <br>
                             <label class="col-form-label col-md-4 col-sm-4 label-align">Tail :</label>
							    <div class="col-md-6 col-sm-6 ">
									<input type="text" class="form-control" name="tail_sensor" id="tail_sensor">
								</div>
                            <br>
                            <label class="col-form-label col-md-4 col-sm-4 label-align">Camera : </label>
								<div class="col-md-6 col-sm-6 ">
                        <input type="text" class="form-control" name="camera_sensor" id="camera_sensor">
								</div>
                <br>
                             <label class="col-form-label col-md-4 col-sm-4 label-align">Push To Talk :</label>
							    <div class="col-md-6 col-sm-6 ">
									<input type="text" class="form-control" name="pust_to_talk" id="pust_to_talk">
								</div>

                
                <br><br><br><br><br><br>
                <h6 ><b>Note</b></h6>
                <label class="col-form-label col-md-4 col-sm-4 label-align">EX Nomor Polisi : </label>
                  <div class="col-md-6 col-sm-6 ">
                      <input type=text  name="ex_no_polisi" id="ex_no_polisi" class="form-control" >
                  </div>
                  <label class="col-form-label col-md-4 col-sm-4 label-align">EX IMEI (GPS) : </label>
                  <div class="col-md-6 col-sm-6 ">
                      <input type=text  name="ex_imei" id="ex_imei" class="form-control" >
                  </div>
                  <label class="col-form-label col-md-4 col-sm-4 label-align">EX GSM Number : </label>
                  <div class="col-md-6 col-sm-6 ">
                      <input type=text  name="ex_gsm_number" id="ex_gsm_number" class="form-control" >
                  </div>
                  <label class="col-form-label col-md-4 col-sm-4 label-align">Remarks : </label>
                  <div class="col-md-6 col-sm-6 ">
                      <input type=text  name="note" id="note" class="form-control" >
                  </div>
                
                </div></div>
         <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Save</button>
              </form>
		        	</div>
						</div>
					</div>
				</form>
			</div>
		</div>

      
@endsection



