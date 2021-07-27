@extends ('layouts/tema')

@section('title','Maintenance')

@section('card_title','Maintenance')

@section('isi')



<!-- <a style="color:#fff;" data-toggle="modal" data-target="#ModalSPK" class="btn btn-warning">Add SPK</a> -->

<a href="/create_spk" class="btn btn-warning">Add SPK</a>


<!-- MULAI TOMBOL TAMBAH -->
<!-- <a href="javascript:void(0)" class="btn btn-success" id="tombol-tambah">Add Customer</a> -->
                <br><br>
                <!-- AKHIR TOMBOL -->
                  <div class="table-responsive">
                  <table id="table_spk" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                        <th scope="col">No</th>
                          <th scope="col">SPK Number</th>
                          <th scope="col">SPK Date</th>
                          <th scope="col">Customer</th>
                          <th scope="col">Job Type</th>
                          <th scope="col">Technician</th>
                          <th scope="col">Location</th>
                          <th scope="col">PIC Customer</th>
                          <th scope="col">Remarks</th>
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
	var listImei = []
	@foreach($Gps_installation as $row)
		listImei.push('{{$row->imei}}')
	@endforeach
	
	var listNumber = []
	@foreach($Gps_installation as $row)
		listNumber.push('{{$row->gsm_number}}')
	@endforeach
	
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });       
 //MULAI DATATABLE
 //script untuk memanggil data json dari server dan menampilkannya berupa datatable

table = $('#table_spk').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{{url("/maintenance/getdata")}}',
      columns: [
          {
              data: 'DT_RowIndex',
              name: 'DT_RowIndex'
          },
          {
              data: 'spk_number',  // Nama tabel sama nama field nya
              name: 'spk_number'
          },
          {
              data: 'spk_date',
              name: 'spk_date'
          },
          {
              data: 'customer.name',
              name: 'customer.name'
          },
          {
              data: 'job_type',
              name: 'job_type'
          },
          {
              data: 'technician_1',
              name: 'technician_1'
          },
          {
              data: 'location',
              name: 'location'
          },
          {
              data: 'pic_name',
              name: 'pic_name'
          },
          {
              data: 'remarks',
              name: 'remarks'
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
var item = [];
var nomor_polisi = [];
var imei = [];
var gsm_number = [];
var problems = [];
var remarks_problems = [];
var gps_maintenance = [];
var sensor_1 = [];
var sensor_2 = [];
var sensor_3 = [];


var limit = $("#count_tr").val();
for (var i = 0; i <limit; i++) {
  item.push($("#item_"+i).val());
  nomor_polisi.push($("#nomor_polisi_"+i).val());
  imei.push($("#imei_"+i).val());
  gsm_number.push($("#gsm_number_"+i).val());
  problems.push($("#problems_"+i).val());
  remarks_problems.push($("#remarks_problems_"+i).val());
  gps_maintenance.push($("#gps_maintenance_"+i).val());
  sensor_1.push($("#sensor_1_"+i).val());
  sensor_2.push($("#sensor_2_"+i).val());
  sensor_3.push($("#sensor_3_"+i).val());
}





var formData = new FormData(this);
formData.append('item', item);
formData.append('limit', limit);
formData.append('nomor_polisi', nomor_polisi);
formData.append('imei', imei);
formData.append('gsm_number', gsm_number);
formData.append('problems', problems);
formData.append('remarks_problems', remarks_problems);
formData.append('gps_maintenance', gps_maintenance);
formData.append('sensor_1', sensor_1);
formData.append('sensor_2', sensor_2);
formData.append('sensor_3', sensor_3);


$.ajax({

  data: formData,

  url: "{{route('spk.update')}}",

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

$.get("/edit/spk" +'/' + id , function (data) {

  $('#editModal').modal('show');
  $('#editId').val(data.id);

  $('#id_customer').val(data.id_customer);
  $('#spk_number').val(data.spk_number);
  $('#spk_date').val(data.spk_date);
  $('#job_type').val(data.job_type);
  $('#location').val(data.location);
  $('#pic_name').val(data.pic_name);
  $('#arrival_name').val(data.arrival_name);
  $('#start_name').val(data.start_name);
  $('#finish_name').val(data.finish_name);
  $('#technician_1').val(data.technician_1);
  $('#technician_2').val(data.technician_2);
  $('#technician_3').val(data.technician_3);
  $('#technician_4').val(data.technician_4);
  $('#remarks').val(data.remarks);
  
       
  var tr = '';
  var count_tr= 0;
  for (var i = 0; i < data.val_detail.length; i++) {
	  
    count_tr = count_tr+1;
    console.log("val_detail", data.val_detail[i]);
    tr += '<tr>';
	if(data.val_detail[i].item === 'null' || data.val_detail[i].item == null) data.val_detail[i].item = ""
    tr += '<td><input type="text" id="item_'+i+'" name="item" class="form-control " value="'+data.val_detail[i].item+'" style="width:40px;"/></td>';
    if(data.val_detail[i].nomor_polisi === 'null' || data.val_detail[i].nomor_polisi == null) data.val_detail[i].nomor_polisi = ""
    tr += '<td><input type="text" id="nomor_polisi_'+i+'" name="nomor_polisi" class="form-control " value="'+data.val_detail[i].nomor_polisi+'" /></td>';
    
	
	if(data.val_detail[i].imei === 'null' || data.val_detail[i].imei == null) data.val_detail[i].imei = ""
    
	var optImei = ''
	for(var ii = 0; ii<listImei.length; ii++){
		if(listImei[ii] == data.val_detail[i].imei){
			optImei +='<option value='+ listImei[ii] +' selected>' + listImei[ii] + '</option>'
		}else{
			optImei +='<option value='+ listImei[ii] +'>' + listImei[ii] + '</option>'
		}		
	}
	tr += '<td><select id="imei_'+i+'" name="imei" class="form-control" style="width:150px;">' + optImei + '</select></td>';
    // console.log(">>>>>>>>"+data.val_detail[i].imei)
	
	if(data.val_detail[i].gsm_number === 'null' || data.val_detail[i].gsm_number == null) data.val_detail[i].gsm_number = ""
    var optNumber = ''
	for(var ii = 0; ii<listNumber.length; ii++){
		if(listNumber[ii] == data.val_detail[i].gsm_number){
			optNumber +='<option value='+ listNumber[ii] +' selected>' + listNumber[ii] + '</option>'
		}else{
			optNumber +='<option value='+ listNumber[ii] +'>' + listNumber[ii] + '</option>'
		}		
	}
	tr += '<td><select id="gsm_number_'+i+'" name="gsm_number" class="form-control" style="width:150px;">' + optNumber + '</select></td>';
    
	if(data.val_detail[i].problems === 'null' || data.val_detail[i].problems == null) data.val_detail[i].problems = ""
	tr += '<td><input type="text" id="problems_'+i+'" name="problems" class="form-control" value="'+data.val_detail[i].problems+'" /></td>';
    if(data.val_detail[i].remarks_problems === 'null' || data.val_detail[i].remarks_problems == null) data.val_detail[i].remarks_problems = ""
    tr += '<td><input type="text" id="remarks_problems_'+i+'" name="remarks_problems" class="form-control" value="'+data.val_detail[i].remarks_problems+'" /></td>';
    if(data.val_detail[i].gps_maintenance === 'null' || data.val_detail[i].gps_maintenance == null) data.val_detail[i].gps_maintenance = ""
    tr += '<td><input type="text" id="gps_maintenance_'+i+'" name="gps_maintenance" class="form-control" value="'+data.val_detail[i].gps_maintenance+'" /></td>';
    if(data.val_detail[i].sensor_1 === 'null' || data.val_detail[i].sensor_1 == null) data.val_detail[i].sensor_1 = ""
    tr += '<td><input type="text" id="sensor_1_'+i+'" name="sensor_1" class="form-control" value="'+data.val_detail[i].sensor_1+'" /></td>';
    if(data.val_detail[i].sensor_2 === 'null' || data.val_detail[i].sensor_2 == null) data.val_detail[i].sensor_2 = ""
    tr += '<td><input type="text" id="sensor_2_'+i+'" name="sensor_2" class="form-control" value="'+data.val_detail[i].sensor_2+'" /></td>';
    if(data.val_detail[i].sensor_3 === 'null' || data.val_detail[i].sensor_3 == null) data.val_detail[i].sensor_3 = ""
    tr += '<td><input type="text" id="sensor_3_'+i+'" name="sensor_3" class="form-control" value="'+data.val_detail[i].sensor_3+'" /></td>';
    tr += '</tr>';
}
$("#tbodyEdit").html(tr);
$("#count_tr").val(count_tr);
  
})
});


// ================== DETAIL ===================

$('body').on('click', '.detailBtn', function () {

var id = $(this).data('id');

$.get("spk-detail/"+id+"/", function (data) {

  $('#detailModal').modal('show');

  

  // for (var i = 0; i < data.spk.length; i++) {
  //   console.log("spk", data.spk[i]);
  $('#Dspk_number').val(data.spk_number);
  $('#Dspk_date').val(data.spk_date);                               // val itu untuk yang entuknya form inputan
  $('#Dcustomer').val(data.customer);                               // DIKASI D DI AWAL CUMA BUAT NGEBEDAIN ID NYA AJA, BIAR GA DOUBLE 
  $('#Djob_type').val(data.job_type); 
  // $('#Dremarks').val(data.remarks); 

  // }
  var tr = '';
  
  for (var i = 0; i < data.spk_detail.length; i++) {
    console.log("spk_detail", data.spk_detail[i]);
    
    tr += '<tr>';
    tr += '<td>'+data.spk_detail[i].item+'</td>';
    tr += '<td>'+data.spk_detail[i].nomor_polisi+'</td>';
    tr += '<td>'+data.spk_detail[i].imei+'</td>';
    tr += '<td>'+data.spk_detail[i].gsm_number+'</td>';
    tr += '<td>'+data.spk_detail[i].remarks_problems+'</td>';
    tr += '</tr>';
}
$("#tbody").html(tr);




})
});


// ============== HAPUS ============================

$('body').on('click', '.hapusBtn', function () {

var id = $(this).data("id");    // Harus Data pakenya

confirm("Are You sure want to delete !");

$.ajax({

  type: "DELETE",

  url: '/spk/destroy/'+id,

  success: function (data) {

    table.draw();

  },

  error: function (data) {

    console.log('Error:', data);

  }

});


});


// =================== NAMBAH dan HAPUS ROW ============================================

$(document).ready(function(){
    let row_number = 1;
    $("#add_row").click(function(e){
      e.preventDefault();
      let new_row_number = row_number - 1;
      $('#part' + row_number).html($('#part' + new_row_number).html()).find('td:first-child');
      $('#parts_table').append('<tr id="part' + (row_number + 1) + '"></tr>');
      row_number++;
    });

    $("#delete_row").click(function(e){
      e.preventDefault();
      if(row_number > 1){
        $("#part" + (row_number - 1)).html('');
        row_number--;
      }
    });




});

});
</script>
@endsection

@section('modal');


 <!-- ****************************************************** MODAL Edit  **************************************************** -->
 <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog " style="max-width: 75%;" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Edit Surat Perintah Kerja</h5>
						</div>
						<div class="modal-body">
                            <div class="row">
						        <div class="col-md-12 ">
							        <div class="x_panel">
                      <form id="formEdit">
                      <input type="hidden" id="count_tr">
            <input type="hidden" id="editId" name="id"></input>
                       @csrf
                       <div class="form-group col-sm-6">
                  <!-- <div class="form-group row">
                <label class="col-form-label col-md-4 col-sm-4 label-align" >SPK Number : </label>
                                    <div class="col-md-4 col-sm-4 ">
                                    <input type=text name="spk_number" id="spk_number" class="form-control"> 
                                        </div></div> -->
                <div class="form-group row">
                <br><label class="col-form-label col-md-4 col-sm-4 label-align">Pelanggan :</label>
											<div class="col-md-5 col-sm-5 ">
                                            <select id='id_customer' name="id_customer" class="form-control">       
                                                    <option value="">--Pilih Pelanggan--</option>
                                                    @foreach ($customer_edit as $customer)
                                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                                    @endforeach
                                        </select>
                       </div>
                      </div>
										
                  <div class="form-group row">
                <br><label class="col-form-label col-md-4 col-sm-4 label-align">Tanggal : </label>
                                 <div class="col-md-5 col-sm-5 ">
                                    <input type="date"  name="spk_date" id="spk_date" class="form-control">
                                    </div></div>

                                    <div class="form-group row">
                <br><label class="col-form-label col-md-4 col-sm-4 label-align">Jenis Pekerjaan : </label>
                                 <div class="col-md-5 col-sm-5 ">
                                    <select id='job_type' name="job_type" class="form-control">       
                                                    <option value="">--Pilih Jenis Pekerjaan--</option>
                                                    <option value="Maintenance">Maintenance</option>
                                                    <option value="un-install">un-install</option>

                                        </select>
                                    </div></div>

                                    <div class="form-group row">
                <br><label class="col-form-label col-md-4 col-sm-4 label-align">Lokasi Pekerjaan : </label>
                                 <div class="col-md-5 col-sm-5 ">
                                    <input type=text name="location" id="location" class="form-control">
                                    </div></div>

                                    <div class="form-group row">
                <br><label class="col-form-label col-md-4 col-sm-4 label-align">PIC : </label>
                                 <div class="col-md-5 col-sm-5 ">
                                    <input type=text  name="pic_name" id="pic_name" class="form-control">
                                    </div></div>

                <br><br><br><br>
                
                </div></div>


   <!-- ================================ TABEL ============================================= -->

   <div class="card">
                    <div class="card-header"> </div>
                       <div class="card-body">
                          <table class="table table-borderless" id="parts_table">
                            <thead>
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">No.Polisi</th>
                                <th scope="col">GPS IMEI</th>
                                <th scope="col">GSM</th>
                                <th scope="col">Permasalah</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">GPS</th>
                                <th scope="col">Sensor</th>
                                <th scope="col">Sensor</th>
                                <th scope="col">Sensor</th>
                              </tr>
                          </thead>
                             <tbody id="tbodyEdit">
                               <!-- <tr id="part0">
                               <td>
                               <input type="text" id="item" name="item" class="form-control"  />

                        </td>
                        <td>
                            <input type="text" id="nomor_polisi" name="nomor_polisi" class="form-control"  />
                        </td>
                        <td>
                            <select  id="imei" name="imei"  class="form-control" >
                                         <option value="">-- choose imei --</option>
                                         @foreach ($imei_edit as $imei)
                                            <option value="{{$imei->imei}}">{{$imei->imei}}</option>
                                            @endforeach
                                    </select>
                        </td>
                        <td>
                            <select  id="gsm_number" name="gsm_number"  class="form-control" >
                                         <option value="">-- choose imei --</option>
                                         @foreach ($Gps_installation as $gsm_number)
                                            <option value="{{$gsm_number->gsm_number}}">{{$gsm_number->gsm_number}}</option>
                                            @endforeach
                             </select>
                        </td>
                        <td>
                            <input type="text" id="problems" name="problems" class="form-control"  />
                        </td>
                        <td>
                            <input type="text" id="remarks_problems" name="remarks_problems" class="form-control"  />
                        </td>
                        <td>
                            <input type="text" id="gps_maintenance" name="gps_maintenance" class="form-control"  />
                        </td>
                        <td>
                            <input type="text" id="sensor_1" name="sensor_1" class="form-control"  />
                        </td>
                        <td>
                            <input type="text" id="sensor_2" name="sensor_2" class="form-control"  />
                        </td>
                        <td>
                            <input type="text" id="sensor_3" name="sensor_3" class="form-control"  />
                        </td>
                            </tr> -->
                              <!-- <tr id="part1"></tr> -->
                            </tbody>
                            </table>
                            
                                        <!-- <div class="row">
                                            <div class="col-md-12">
                                                <button id="add_row" class="btn btn-default pull-left">+ Add Row</button>
                                                <button id='delete_row' class="pull-right btn btn-danger">- Delete Row</button>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                                <div>
                                </div>
                

              
              


                
             <!-- ================================ END TABEL ============================================= -->
                
             <br><div class="form-row">
                <label for=""><B>Catatan : </b></label> <br>
            <textarea name="remarks" id="remarks" rows="5" cols="140" class="form-control"></textarea>
               </div>

           
            <!--=================================================== Teknisi & Attachment =============================================== -->

            
                  <div class="form-group col-sm-6">

                  <br><br><br>
                     <div class="form-group row">
                     <label class="col-form-label col-md-4 col-sm-4 label-align"> Jam Datang : </label>
                     <div class="col-md-4 col-sm-4 ">
                     <input type=time  name="start_name" id="start_name" class="form-control"></div></div>

                     <div class="form-group row">
                     <label class="col-form-label col-md-4 col-sm-4 label-align">Jam Mulai : </label>
                     <div class="col-md-4 col-sm-4 ">
                     <input type=time  name="arrival_name" id="arrival_name" class="form-control"></div></div>

                    <div class="form-group row">
                     <label class="col-form-label col-md-4 col-sm-4 label-align">Jam Selesai : </label>
                     <div class="col-md-4 col-sm-4 ">
                     <input type=time  name="finish_name" id="finish_name" class="form-control"></div></div>
                </div>

                <div class="form-group col-sm-6">
                <br><br><br>
                <div class="form-group row">
                  <label class="col-form-label col-md-4 col-sm-4 label-align"> Teknisi1 : </label>
                  <div class="col-md-4 col-sm-4 ">
                    <select id='technician_1' name="technician_1" class="form-control" >       
                                <option value="">-- Pilih --</option>
                                @foreach ($teknisi_edit as $teknisi)
                                <option value="{{$teknisi->name}}">{{$teknisi->name}}</option>
                                @endforeach
                     </select></div></div>

                     <div class="form-group row">
                     <label class="col-form-label col-md-4 col-sm-4 label-align"> Teknisi2 : </label>
                     <div class="col-md-4 col-sm-4 ">
                    <select id='technician_2' name="technician_2" class="form-control" >       
                                <option value="">-- Pilih --</option>
                                @foreach ($teknisi2_edit as $teknisi2)
                                <option value="{{$teknisi2->name}}">{{$teknisi2->name}}</option>
                                @endforeach
                     </select></div></div>

                     <div class="form-group row">
                     <label class="col-form-label col-md-4 col-sm-4 label-align">Teknisi3 : </label>
                     <div class="col-md-4 col-sm-4 ">
                    <select id='technician_3' name="technician_3" class="form-control" >       
                                <option value="">-- Pilih --</option>
                                @foreach ($teknisi3_edit as $teknisi3)
                                <option value="{{$teknisi3->name}}">{{$teknisi3->name}}</option>
                                @endforeach
                     </select></div></div><br>
               

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
			<div class="modal-dialog " style="max-width: 60%;" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Detail Surat Perintah Kerja</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
						</div>
						<div class="modal-body">
                            <div class="row">
						        <div class="col-md-12 ">
							        <div class="x_panel">
                      <div class="form-group row">
                <br><label class="col-form-label col-md-2 col-sm-2 label-align">SPK Number : </label>
                                 <div class="col-md-3 col-sm-3 ">
                                    <input type="text"  name="Dspk_number" id="Dspk_number" class="form-control" readonly>
                                    </div></div> 
                                    <div class="form-group row">
                <br><label class="col-form-label col-md-2 col-sm-2 label-align">Customer : </label>
                                 <div class="col-md-3 col-sm-3 ">
                                    <input type="text"  name="Dcustomer" id="Dcustomer" class="form-control" readonly>
                                    </div></div>
                                    <div class="form-group row">
                <br><label class="col-form-label col-md-2 col-sm-2 label-align">SPK Date : </label>
                                 <div class="col-md-3 col-sm-3 ">
                                    <input type="text"  name="Dspk_date" id="Dspk_date" class="form-control" readonly>
                                    </div></div>
                                    <div class="form-group row">
                <br><label class="col-form-label col-md-2 col-sm-2 label-align">Type : </label>
                                 <div class="col-md-3 col-sm-3 ">
                                    <input type="text"  name="Djob_type" id="Djob_type" class="form-control" readonly>
                                    </div></div><br>    
                                  
                                    <div class="table-responsive">
                  <table class="table table-bordered">
                      <thead style="background:#e9ecef;">
                        <tr>
                        <th scope="col">Item</th>
                          <th scope="col">Nomor Polisi</th>
                          <th scope="col">IMEI</th>
                          <th scope="col">GSM </th>
                          <th scope="col">Remarks</th>
                        </tr>
                      </thead>
                      <tbody id="tbody">
                      </tbody>
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

