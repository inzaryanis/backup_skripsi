@extends ('layouts/tema')

@section('title','Install & Mutation')

@section('card_title','Install & Mutation')

@section('isi')


<!-- <a style="color:#fff;" data-toggle="modal" data-target="#ModalBAP" class="btn btn-warning">Add BAP</a> -->

<a href="/create_bap" class="btn btn-warning">Add BAP</a>


<!-- MULAI TOMBOL TAMBAH -->
<!-- <a href="javascript:void(0)" class="btn btn-success" id="tombol-tambah">Add Customer</a> -->
                <br><br>
                <!-- AKHIR TOMBOL -->

                  <div class="table-responsive">
                  <table id="table_bap" class="table table-striped  table-bordered" >
                      <thead>
                      <tr>
                        <th>No</th>
                          <th scope="col">BAP Number</th>
                          <th scope="col">BAP Date</th>
                          <th scope="col">Customer</th>
                          <th scope="col">No Polisi</th>
                          <th scope="col">IMEI</th>
                          <th scope="col">GSM</th>
                          <th scope="col">Type</th>
                          <th scope="col">GSM-Status</th>
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

table = $('#table_bap').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{{url("/bap/getdata")}}',
      columns: [
          {
              data: 'DT_RowIndex',
              name: 'DT_RowIndex'
          },
          {
              data: 'bap_number',
              name: 'bap_number'
          },
          {
              data: 'bap_date',
              name: 'bap_date'
          },
          {
              data: 'customer.name',
              name: 'customer.name'
          },
          {
              data: 'nomor_polisi',  
              name: 'nomor_polisi'
          },
          {
              data: 'imei',
              name: 'imei'
          },
          {
              data: 'gsm.gsm_number',
              name: 'gsm.gsm_number'
          },
          {
              data: 'job_type',
              name: 'job_type'
          },
          {
              data: 'gsm.functional_status',
              name: 'gsm.functional_status'
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

  url: "{{route('bap.update')}}",

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

$.get("/edit/bap" +'/' + id , function (data) {

  $('#editModal').modal('show');
  $('#editId').val(data.id);
  $('#id_customer').val(data.id_customer);



  $('#bap_date').val(data.bap_date);
  $('#nomor_polisi').val(data.nomor_polisi);
  $('#po_customer_date').val(data.po_customer_date);
  $('#po_number').val(data.po_number);
  $('#po_date').val(data.po_date);
  $('#vehicle_type').val(data.vehicle_type);
  $('#vehicle_number').val(data.vehicle_number);
  $('#odometer').val(data.odometer);
  $('#installation_location').val(data.installation_location);
  $('#vehicle_battery').val(data.vehicle_battery);
  $('#fuel_tank_capacity').val(data.fuel_tank_capacity);
  $('#fuel_ratio').val(data.fuel_ratio);
  $('#fuel_type').val(data.fuel_type);
  $('#remarks').val(data.remarks);
  $('#job_type').val(data.job_type);
  $('#ex_nomor_polisi').val(data.ex_nomor_polisi);
  $('#spk_number').val(data.spk_number);
  $('#gps_type').val(data.gps_type);
  $('#imei').val(data.imei);
  $('#gsm_number').val(data.gsm_number);
  $('#technical_check').val(data.technical_check);
  $('#technical_check_remarks').val(data.technical_check_remarks);
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
  $('#technician_1').val(data.technician_1);
  $('#technician_2').val(data.technician_2);
  $('#technician_3').val(data.technician_3);
  $('#technician_4').val(data.technician_4);
  // $('#attachment1').val(data.attachment1);
  // $('#attachment2').val(data.attachment2);
  // $('#attachment3').val(data.attachment3);
  // $('#attachment4').val(data.attachment4);
  // $('#attachment5').val(data.attachment5);
	if(data.attachment1 == 'null' || data.attachment1 === null) {
		$("#attachment1-preview").hide()
	}else{
		$("#attachment1-preview").show()
		$("#attachment1-preview").attr("src","{{ URL::to('/attachment') }}/" + data.attachment1);
	}
	
	if(data.attachment2 == 'null' || data.attachment2 === null) {
		$("#attachment2-preview").hide()
	}else{
		$("#attachment2-preview").show()
		$("#attachment2-preview").attr("src","{{ URL::to('/attachment') }}/" + data.attachment2);
	}
	
	if(data.attachment3 == 'null' || data.attachment3 === null) {
		$("#attachment3-preview").hide()
	}else{
		$("#attachment3-preview").show()
		$("#attachment3-preview").attr("src","{{ URL::to('/attachment') }}/" + data.attachment3);
	}
	
	if(data.attachment4 == 'null' || data.attachment4 === null) {
		$("#attachment4-preview").hide()
	}else{
		$("#attachment4-preview").show()
		$("#attachment4-preview").attr("src","{{ URL::to('/attachment') }}/" + data.attachment4);
	}
	
	if(data.attachment5 == 'null' || data.attachment5 === null) {
		$("#attachment5-preview").hide()
	}else{
		$("#attachment5-preview").show()
		$("#attachment5-preview").attr("src","{{ URL::to('/attachment') }}/" + data.attachment5);
	}
		
	// console.log("Attachment 1 "+data.attachment1)
	// console.log("Attachment 2 "+data.attachment2)
	// console.log("Attachment 3 "+data.attachment3)
	// console.log("Attachment 4 "+data.attachment4)
	// console.log("Attachment 5 "+data.attachment5)

})
});

  
    // ================== DETAIL ===================

    $('body').on('click', '.detailBtn', function () {

var id = $(this).data('id');

$.get("bap-detail/"+id+"/", function (data) {

  $('#detailModal').modal('show');
  $('#Dcustomer').html(data.customer);                              // DIKASI D DI AWAL CUMA BUAT NGEBEDAIN ID NYA AJA, BIAR GA DOUBLE
  $('#Dbap_date').html(data.bap_date);
  $('#Dnomor_polisi').html(data.nomor_polisi);
  $('#Dpo_customer_date').html(data.po_customer_date);
  $('#Dpo_number').html(data.po_number);
  $('#Dpo_date').html(data.po_date);
  $('#Dvehicle_type').html(data.vehicle_type);
  $('#Dvehicle_number').html(data.vehicle_number);
  $('#Dodometer').html(data.odometer);
  $('#Dinstallation_location').html(data.installation_location);
  $('#Dvehicle_battery').html(data.vehicle_battery);
  $('#Dfuel_tank_capacity').html(data.fuel_tank_capacity);
  $('#Dfuel_ratio').html(data.fuel_ratio);
  $('#Dfuel_type').html(data.fuel_type);
  $('#Dremarks').html(data.remarks);
  $('#Djob_type').html(data.job_type);
  $('#Dex_nomor_polisi').html(data.ex_nomor_polisi);
  $('#Dspk_number').html(data.spk_number);
  $('#Dgps_type').html(data.gps_type);
  $('#Dimei').html(data.imei);
  $('#Dgsm_number').html(data.gsm_number);
  $('#Dtechnical_check').html(data.technical_check);
  $('#Dtechnical_check_remarks').html(data.technical_check_remarks);
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
  $('#Dtechnician_1').html(data.technician_1);
  $('#Dtechnician_2').html(data.technician_2);
  $('#Dtechnician_3').html(data.technician_3);
  $('#Dtechnician_4').html(data.technician_4);

  // Untuk nampilin image
  $('#Dattachment1').html("<img src={{ URL::to('/') }}/attachment/" + data.attachment1 + " width='100' class='img-thumbnail' />");
  $('#Dattachment2').html("<img src={{ URL::to('/') }}/attachment/" + data.attachment2 + " width='100' class='img-thumbnail' />");
  $('#Dattachment3').html("<img src={{ URL::to('/') }}/attachment/" + data.attachment3 + " width='100' class='img-thumbnail' />");
  $('#Dattachment4').html("<img src={{ URL::to('/') }}/attachment/" + data.attachment4 + " width='100' class='img-thumbnail' />");
  $('#Dattachment5').html("<img src={{ URL::to('/') }}/attachment/" + data.attachment5 + " width='100' class='img-thumbnail' />");

  
  




})
});

// ================== HAPUS ===================

$('body').on('click', '.hapusBtn', function () {

var id = $(this).data("id");    // Harus Data pakenya

confirm("Are You sure want to delete !");

$.ajax({

  type: "DELETE",

  url: '/delete/bap/'+id,

  success: function (data) {

    table.draw();

  },

  error: function (data) {

    console.log('Error:', data);

  }

});



});

});
function previewImage(e,i) {
    document.getElementById(i + "-preview").style.display = "block";
    var oFReader = new FileReader();
     oFReader.readAsDataURL(e.files[0]);
 
    oFReader.onload = function(oFREvent) {
      document.getElementById(i + "-preview").src = oFREvent.target.result;
    };
  };
</script>
@endsection

@section('modal');

<!-- ****************************************************** MODAL Edit  **************************************************** -->
 <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog " style="max-width: 75%;" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Edit Berita Acara Pemasangan</h5>
						</div>
						<div class="modal-body">
                            <div class="row">
						        <div class="col-md-12 ">
							        <div class="x_panel">
                      <form id="formEdit">
            <input type="hidden" id="editId" name="id"></input>
                       @csrf
                  <div class="form-group col-sm-6">
                  <div class="form-group row">
                <label class="col-form-label col-md-4 col-sm-4 label-align" >Job : </label>
                                    <div class="col-md-4 col-sm-4 ">
                                        <select id='job_type' name="job_type" class="form-control">       
                                        <option value="Install">Install</option>
                                        <option value="Mutasi">Mutasi</option>
                                        </select> 
                                        </div></div>
                     <div class="form-group row">
                <br><label class="col-form-label col-md-4 col-sm-4 label-align">Form Nomor Polisi :</label>
											<div class="col-md-4 col-sm-4 ">
												<input type="text" class="form-control" name="ex_nomor_polisi" id="ex_nomor_polisi"  >
											</div></div>
										
                  <div class="form-group row">
                <br><label class="col-form-label col-md-4 col-sm-4 label-align">SPK Number : </label>
                                 <div class="col-md-4 col-sm-4 ">
                                    <input type=text  name="spk_number" id="spk_number" class="form-control"  >
                                    </div></div>

                <br><br><br><br>
                <label class="col-form-label col-md-4 col-sm-4 label-align">Customer : </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select id='id_customer' name="id_customer" class="form-control">       
                                                    @foreach ($customer as $customer)
                                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                                    @endforeach
                                       </select>
                                        </div>
                <!-- <br><label class="col-form-label col-md-4 col-sm-4 label-align">Tanggal : </label>
                                     <div class="col-md-6 col-sm-6 ">
                                        <input type="date"  class="form-control" >
                                        </div> -->
                <br><label class="col-form-label col-md-4 col-sm-4 label-align">Tanggal : </label>
                                     <div class="col-md-6 col-sm-6 ">
                                        <input type=date  name="bap_date" id="bap_date" class="form-control" >
                                        </div>
                <br><label class="col-form-label col-md-4 col-sm-4 label-align">Alamat Pemasangan : </label>
                                     <div class="col-md-6 col-sm-6 ">
                                        <input type=text  name="installation_location" id="installation_location" class="form-control" >
                                        </div>

                <br><label class="col-form-label col-md-4 col-sm-4 label-align">PO Number  : </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type=text  name="po_number" id="po_number" class="form-control" >
                                        </div>

                <br><label class="col-form-label col-md-4 col-sm-4 label-align">PO Date : </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="date" name="po_date" id="po_date" class="form-control" >
                                        </div>
                                        

                <br><label class="col-form-label col-md-4 col-sm-4 label-align">Type Kendaraan  : </label>
                                     <div class="col-md-6 col-sm-6 ">
                                        <input type=”text”  name="vehicle_type" id="vehicle_type" class="form-control" >
                                        </div>

                <br><label class="col-form-label col-md-4 col-sm-4 label-align"> Nomor Kendaraan  : </label>
                                     <div class="col-md-6 col-sm-6 ">
                                        <input type=”text”  name="vehicle_number" id="vehicle_number" class="form-control" >
                                        </div>

                <br> <label class="col-form-label col-md-4 col-sm-4 label-align"> Nomor Polisi  : </label>
                                      <div class="col-md-6 col-sm-6 ">
                                        <input type=”text”  name="nomor_polisi" id="nomor_polisi" class="form-control" >
                                        </div>

                <br> <label class="col-form-label col-md-4 col-sm-4 label-align"> Odometer  :</label>
                                      <div class="col-md-6 col-sm-6 ">
                                        <input type="number"  name="odometer" id="odometer" class="form-control"  >
                                        </div>
                                     </div>
              
              
              
              
                            <div class="form-group col-sm-6">
                             <div class="form-group row">
							<label class="col-form-label col-md-4 col-sm-4 label-align">Kapasitas Bensin :</label>
								<div class="col-md-2 col-sm-2 ">
									<input class="form-control" type="number"  name="fuel_tank_capacity" id="fuel_tank_capacity"  style="width:80px;">
								</div></div>	
                             <div class="form-group row">
							<label class="col-form-label col-md-4 col-sm-4 label-align">Rasio Bensin : </label>
								<div class="col-md-3 col-sm-3 ">
									<input type="text" class="form-control"  name="fuel_ratio" id="fuel_ratio" >
								</div></div>
                             <div class="form-group row">
							<label class="col-form-label col-md-4 col-sm-4 label-align">Jenis Bensin : </label>
								<div class="col-md-3 col-sm-3 ">
							    	<input type="text" class="form-control" name="fuel_type" id="fuel_type" >
								</div></div>						
                <br><br><br><br>
               
							<label class="col-form-label col-md-4 col-sm-4 label-align">IMEI : </label>
								<div class="col-md-6 col-sm-6 ">
									<input type="text" class="form-control" name="imei" id="imei" >
								</div>
                             <br>
                             <label class="col-form-label col-md-4 col-sm-4 label-align">Type GPS : </label>
							    <div class="col-md-6 col-sm-6 ">
									<input type="text" class="form-control" name="gps_type" id="gps_type" >
								</div>
                            <br>
                            <label class="col-form-label col-md-4 col-sm-4 label-align">GSM : </label>
								<div class="col-md-6 col-sm-6 ">
                                     <select id="gsm_number" class="form-control" name="gsm_number" >       
                                         <option value="">-- Pilih GSM --</option>
                                         @foreach ($gsm as $gsm)
                                        <option value="{{$gsm->id}}">{{$gsm->gsm_number}}</option>
                                        @endforeach
                                     </select>
								</div>
                            </div>       
                         </div>

            <!-- ================================ HAsil Pemeriksaan ============================================= -->
              
                <label ><b>Hasil Pemeriksaan GPS : </b></label>
                         <input type=text name="technical_check" id="technical_check"  class="form-control" style="width:40px;height:40px;" ><br>
                    
                <div class="form-row">
                <label for=""><B>Catatan : </b></label> <br>
                <input name="technical_check_remarks" id="technical_check_remarks" rows="5" cols="140" class="form-control" ></input>
                </div>

            <!-- ================================ END HAsil Pemeriksaan ============================================= -->

            <!-- ================================ Pemasangan Sensor ============================================= -->

             <br> <span><b>Pemasangan Sensor  :</b></span><br><br>
             <div class="row">
             <div class="form-group col-sm-4">
            
             <label class="col-form-label col-md-5 col-sm-5 label-align">DOOR : </label> 
                <input type=text name="door_sensor" id="door_sensor" class="form-control" style="width:50px;" > 

            <label class="col-form-label col-md-5 col-sm-5 label-align">REMARKS : </label>
                <input type=text  name="door_sensor_remarks" id="door_sensor_remarks" class="form-control"style="width:120px;" >
            </div>
              
            <div class="form-group col-sm-4">
            <label class="col-form-label col-md-5 col-sm-5 label-align">SUHU : </label>
                <input type=text name="temperature_sensor" id="temperature_sensor" class="form-control" style="width:50px;" > 

            <label class="col-form-label col-md-5 col-sm-5 label-align">REMARKS : </label>
                <input type=text  name="temperature_sensor_remarks" id="temperature_sensor_remarks" class="form-control"  style="width:120px;" >
            </div>

            
            <div class="form-group col-sm-4">
            <label class="col-form-label col-md-5 col-sm-5 label-align">BUTTON : </label>
                <input type=text name="button_sensor" id="button_sensor" size=”40″ class="form-control" style="width:50px;" > 

            <label class="col-form-label col-md-5 col-sm-5 label-align">REMARKS : </label>
                <input type=text  name="button_sensor_remarks" id="button_sensor_remarks" size=”40″ style="width:120px;" class="form-control" >
            </div>
            
            
            <div class="form-group col-sm-4">
            <label class="col-form-label col-md-5 col-sm-5 label-align">MOBILIZIER : </label>
                <input type=text  name="immobilizer_sensor" id="immobilizer_sensor" size=”40″ style="width:40px;" class="form-control" >
           
            <label class="col-form-label col-md-5 col-sm-5 label-align">FUEL : </label>
                <input type=text  name="fuel_sensor" id="fuel_sensor" size=”40″ style="width:40px;" class="form-control" >
           </div>
            </div>




            <div class="row">
             <div class="form-group col-sm-3">
             <label class="col-form-label col-md-4 col-sm-4 label-align">DUMP : </label>
                <input type=text name="dump_sensor" id="dump_sensor" class="form-control" style="width:40px;" > 
            </div>
              
            <div class="form-group col-sm-3">
            <label class="col-form-label col-md-4 col-sm-4 label-align">TAIL : </label>
                <input type=text name="tail_sensor" id="tail_sensor" class="form-control" style="width:40px;" > 
            </div>

            <div class="form-group col-sm-3">
            <label class="col-form-label col-md-4 col-sm-4 label-align">RFID : </label>
                <input type=text name="rfid_sensor" id="rfid_sensor" class="form-control" style="width:40px;" >
            </table></div>
            
            <div class="form-group col-sm-3">
            <label class="col-form-label col-md-4 col-sm-4 label-align">CAMERA : </label>
                <input type=text name="camera_sensor" id="camera_sensor" class="form-control" style="width:40px;" > 
            </div>

            <div class="form-group col-sm-3">
            <label class="col-form-label col-md-4 col-sm-4 label-align">PTT : </label>
                <input type=text name="pust_to_talk" id="pust_to_talk" class="form-control" style="width:40px;"> 
            </div>
            </div>

           <!-- ================================ End Pemasangan Sensor ============================================= -->


            <label  for=""><B>Catatan : </b></label>
            <input id="remarks" name="remarks" rows="5" cols="140" class="form-control" ></input>



            <!--=================================================== Teknisi & Attachment =============================================== -->

            
                  <div class="form-group col-sm-6">

                 
                  <br><br>
                  <div class="form-group row">
                  <label class="col-form-label col-md-4 col-sm-4 label-align">GPS Port :</label>
                  <div class="col-md-2 col-sm-2 ">
                  <input type="number" name="gps_port" id="gps_port" class="form-control" style="width:90px;">
                  </div></div>

                  <div class="form-group row">
                  <label class="col-form-label col-md-4 col-sm-4 label-align"> Teknisi1 : </label>
                  <div class="col-md-4 col-sm-4 ">
                    <select id='technician_1' name="technician_1" class="form-control" >       
                                                                 
                                                @foreach ($teknisi as $teknisi)
                                                <option value="{{$teknisi->name}}">{{$teknisi->name}}</option>
                                                 @endforeach
                     </select></div></div>

                     <div class="form-group row">
                     <label class="col-form-label col-md-4 col-sm-4 label-align"> Teknisi2 : </label>
                     <div class="col-md-4 col-sm-4 ">
                    <select id='technician_2' name="technician_2" class="form-control" >       
                                <option value="">-- Pilih --</option>
                                @foreach ($teknisi2 as $teknisi2)
                                <option value="{{$teknisi2->name}}">{{$teknisi2->name}}</option>
                                @endforeach
                     </select></div></div>

                     <div class="form-group row">
                     <label class="col-form-label col-md-4 col-sm-4 label-align">Teknisi3 : </label>
                     <div class="col-md-4 col-sm-4 ">
                    <select id='technician_3' name="technician_3" class="form-control" >       
                                <option value="">-- Pilih --</option>
                                @foreach ($teknisi3 as $teknisi3)
                                <option value="{{$teknisi3->name}}">{{$teknisi3->name}}</option>
                                @endforeach
                     </select></div></div>

                    <div class="form-group row">
                     <label class="col-form-label col-md-4 col-sm-4 label-align">Teknisi4 : </label>
                     <div class="col-md-4 col-sm-4 ">
                    <select id='technician_4' name="technician_4" class="form-control" >       
                                <option value="">-- Pilih --</option>
                                @foreach ($teknisi4 as $teknisi4)
                                <option value="{{$teknisi4->name}}">{{$teknisi4->name}}</option>
                                @endforeach
                     </select></div></div>
                </div>

                <div class="form-group col-sm-6">
                <br><br><br>
                <div class="form-group row">
                <label class="col-form-label col-md-4 col-sm-4 label-align">Attachment1 : </label>
                <div class="col-md-6 col-sm-6 ">
                     <input type=file  name="attachment1" id="attachment1" onChange="previewImage(this, 'attachment1')">
					 <img width='300' class='img-thumbnail' id="attachment1-preview" />
                     </div></div>

                <div class="form-group row">
                <label class="col-form-label col-md-4 col-sm-4 label-align">Attachment2 : </label>
                <div class="col-md-6 col-sm-6 ">
                     <input type=file  name="attachment2" id="attachment2" onChange="previewImage(this, 'attachment2')">
					 <img width='300' class='img-thumbnail' id="attachment2-preview" /> 
                     </div></div>

                <div class="form-group row">
                <label class="col-form-label col-md-4 col-sm-4 label-align">Attachment3 : </label>
                <div class="col-md-6 col-sm-6 ">
                    <input type=file  name="attachment3" id="attachment3" onChange="previewImage(this, 'attachment3')">
					<img width='300' class='img-thumbnail' id="attachment3-preview" /> 
                    </div></div>

                <div class="form-group row">
                <label class="col-form-label col-md-4 col-sm-4 label-align">Attachment4 : </label>
                <div class="col-md-6 col-sm-6 ">
                    <input type=file  name="attachment4" id="attachment4" onChange="previewImage(this, 'attachment4')">
					<img width='300' class='img-thumbnail' id="attachment4-preview" /> 
                    </div></div>

                <div class="form-group row">
               <label class="col-form-label col-md-4 col-sm-4 label-align">Attachment5 : </label>
               <div class="col-md-6 col-sm-6 ">
                <input type=file  name="attachment5" id="attachment5" onChange="previewImage(this, 'attachment5')">
				<img width='300' class='img-thumbnail' id="attachment5-preview" /> 
                </div></div><br>
               

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


   <!-- Modal detail -->
   <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog " style="max-width: 75%;" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Detail Berita Acara Pemasangan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
						</div>
						<div class="modal-body">
                            <div class="row">
						        <div class="col-md-12 ">
							        <div class="x_panel">
                                  
                      <div class="form-group col-sm-4">
                  <table class="table table-bordered table-hover">
            <thead>
              <tr>
              <td align="right"><b><b>Job  :</b></td>
              <td id="Djob_type"></td>
              </tr>

              <tr>
              <td align="right"><b>Nomor Polisi  :</b></td>
              <td  id="Dvehicle_number"></td>
              </tr>

              <tr>
              <td align="right"><b>SPK Number  :</b></td>
              <td  id="Dspk_number"></td>
              </tr>
            <!-- =================== -->
              <tr>
              <td align="right"></td>
              <td ></td>
              </tr>

              <tr>
              <td align="right"><b>Customer  :</b></td>
              <td id="Dcustomer"></td>
              </tr>

              <tr>
              <td align="right"><b>Alamat Pemasangan  :</b></td>
              <td id="Dinstallation_location" ></td>
              </tr>

              <tr>
              <td align="right"><b>PO Number  :</b></td>
              <td  id="Dinstallation_location"></td>
              </tr>

              <tr>
              <td align="right"><b>PO Date  :</b></td>
              <td  id="Dpo_date"></td>
              </tr>

              <tr>
              <td align="right"><b>Merk/Type Kendaraan  :</b></td>
              <td id="Dvehicle_type" ></td>
              </tr>

              <tr>
              <td align="right"><b>Nomor Kendaraan  :</b></td>
              <td  id="Dvehicle_number"></td>
              </tr>
              <tr>
              <td align="right"><b>Odometer  :</b></td>
              <td  id="Dodometer"></td>
              </tr>

              
              </tr>

            <!-- =================== -->
              <tr>
              <td align="right"></td>
              <td ></td>
              </tr>

            
              <tr>
              <td align="right"><b><b>Kapasitas Bensin  :</b></td>
              <td id="Dfuel_tank_capacity"></td>
              </tr>

              <tr>
              <td align="right"><b>Rasio Bensin  :</b></td>
              <td id="Dfuel_ratio"></td>
              </tr>

              <tr>
              <td align="right"><b>Jenis Bensin  :</b></td>
              <td id="Dfuel_type"></td>
              </tr>

            <!-- =================== -->
              <tr>
              <td align="right"></td>
              <td ></td>
              </tr>

              
              <tr>
              <td align="right"><b>IMEI  :</b></td>
              <td id="Dimei" ></td>
              </tr>

              <tr>
              <td align="right"><b>Type GPS  :</b></td>
              <td id="Dgps_type"></td>
              </tr>

              <tr>
              <td align="right"><b>GSM  :</b></td>
              <td id="Dgsm_number"></td>
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
              <td align="right"><b>Hasil Pemeriksaan GPS  :</b></td>
              <td id="Dtechnical_check"></td>
              </tr>

              <tr>
              <td align="right"><b>Remarks  :</b></td>
              <td id="Dtechnical_check_remarks"></td>
              </tr>

            <tr>
              <td align="right"><b><b>Pemasangan Sensor  </b></td>
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
              <td  id="Dtail_sensor"></td>
              </tr>

              <tr>
              <td align="right"><b>Camera  :</b></td>
              <td  id="Dcamera_sensor"></td>
              </tr>

              <tr>
              <td align="right"><b>Push To Talk  :</b></td>
              <td  id="Dpust_to_talk"></td>
              </tr>

              <tr>
              <td align="right"></td>
              <td ></td>
              </tr>

              <tr>
              <td align="right"><b>Catatan  :</b></td>
              <td  id="Dremarks"></td>
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
              <td align="right"><b>GPS Port  :</b></td>
              <td id="Dgps_port"></td>
              </tr>

              <tr>
              <td align="right"><b><b>Teknisi  </b></b></td>
              <td ></td>
              </tr>

              <tr>
              <td align="right"><b>Teknisi1  :</b></td>
              <td id="Dtechnician_1"></td>
              </tr>

              <tr>
              <td align="right"><b>Teknisi2   :</b></td>
              <td id="Dtechnician_2"></td>
              </tr>

              <tr>
              <td align="right"><b>Teknisi3   :</b></td>
              <td id="Dtechnician_3"></td>
              </tr>


              <tr>
              <td align="right"><b>Teknisi4   :</b></td>
              <td id="Dtechnician_4"></td>
              </tr>

              <tr>
              <td align="right"><b><b>Attachment  </b></b></td>
              <td ></td>
              </tr>

              <tr>
              <td align="right"><b>Attachment1   :</b></td>
              <td id="Dattachment1"></td>
              </tr>

              <tr>
              <td align="right"><b>Attachment2   :</b></td>
              <td id="Dattachment2"></td>
              </tr>

              <tr>
              <td align="right"><b>Attachment3   :</b></td>
              <td id="Dattachment3"></td>
              </tr>
             
              <tr>
              <td align="right"><b>Attachment4  :</b></td>
              <td id="Dattachment4"></td>
              </tr>

              <tr>
              <td align="right"><b>Attachment5   :</b></td>
              <td id="Dattachment5"></td>
              </tr>

              
              </tr>
            </thead>
            </table>
            </div>

          <!--=================================================== End Teknisi & Attachment =============================================== -->

                 
					</div>
				</div>
			  </div>
		    </div>
           </div>
		  </div>
		</div>
        </div>


@endsection

