@extends ('layouts/tema')

@section('title','Surat Perintah Kerja')

@section('card_title','Surat Perintah Kerja')

@section('isi')


<form action="/add_spk" method="POST" autocomplete="off" enctype="multipart/form-data">

                    <div class="row">
						<div class="col-md-12 ">
							<div class="x_panel">
								<div class="x_content">
									<br />

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
                                                    @foreach ($customer as $customer)
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
                             <tbody>
                               <tr id="part0">
                               <td>
                               <input type="text" name="item[]" class="form-control"  />

                        </td>
                        <td>
                            <input type="text" name="nomor_polisi[]" class="form-control"  />
                        </td>
                        <td>
                            <select  id="imei" name="imei[]"  class="form-control" >
                                         <option value="">-- choose imei --</option>
                                         @foreach ($Gps_installation as $imei)
                                            <option value="{{$imei->imei}}">{{$imei->imei}}</option>
                                            @endforeach
                                    </select>
                        </td>
                        <td>
                            <select  id="gsm_number" name="gsm_number[]"  class="form-control" >
                                         <option value="">-- choose imei --</option>
                                         @foreach ($Gps_installation as $gsm_number)
                                            <option value="{{$gsm_number->gsm_number}}">{{$gsm_number->gsm_number}}</option>
                                            @endforeach
                             </select>
                        </td>
                        <td>
                            <input type="text" name="problems[]" class="form-control"  />
                        </td>
                        <td>
                            <input type="text" name="remarks_problems[]" class="form-control"  />
                        </td>
                        <td>
                            <input type="text" name="gps_maintenance[]" class="form-control"  />
                        </td>
                        <td>
                            <input type="text" name="sensor_1[]" class="form-control"  />
                        </td>
                        <td>
                            <input type="text" name="sensor_2[]" class="form-control"  />
                        </td>
                        <td>
                            <input type="text" name="sensor_3[]" class="form-control"  />
                        </td>
                            </tr>
                              <tr id="part1"></tr>
                            </tbody>
                            </table>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button id="add_row" class="btn btn-default pull-left">+ Add Row</button>
                                                <button id='delete_row' class="pull-right btn btn-danger">- Delete Row</button>
                                            </div>
                                        </div>
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
                                @foreach ($teknisi as $teknisi1)
                                <option value="{{$teknisi1->name}}">{{$teknisi1->name}}</option>
                                @endforeach
                     </select></div></div>

                     <div class="form-group row">
                     <label class="col-form-label col-md-4 col-sm-4 label-align"> Teknisi2 : </label>
                     <div class="col-md-4 col-sm-4 ">
                    <select id='technician_2' name="technician_2" class="form-control" >       
                                <option value="">-- Pilih --</option>
                                @foreach ($teknisi as $teknisi2)
                                <option value="{{$teknisi2->name}}">{{$teknisi2->name}}</option>
                                @endforeach
                     </select></div></div>

                     <div class="form-group row">
                     <label class="col-form-label col-md-4 col-sm-4 label-align">Teknisi3 : </label>
                     <div class="col-md-4 col-sm-4 ">
                    <select id='technician_3' name="technician_3" class="form-control" >       
                                <option value="">-- Pilih --</option>
                                @foreach ($teknisi as $teknisi3)
                                <option value="{{$teknisi3->name}}">{{$teknisi3->name}}</option>
                                @endforeach
                     </select></div></div><br>
                </div>

                
                
         


          <!--=================================================== End Teknisi & Attachment =============================================== -->

         <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Save</button>
              </form>
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