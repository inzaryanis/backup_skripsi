@extends ('layouts/tema')

@section('title','Add Gps Installation')

@section('card_title','Add Gps Installation')

@section('isi')



          <div class="row">
				<div class="col-md-12 ">
					<div class="x_panel">
            <form action="/add_gps_install" method="POST" autocomplete="off" enctype="multipart/form-data">
              @csrf
                  <div class="form-group col-sm-6">
                <h4 ><b>CUSTOMER</b></h4>
                <label class="col-form-label col-md-4 col-sm-4 label-align">Customer : </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select id='id_customer' name="id_customer" class="form-control">       
                                                    <option value="">--Pilih Customer--</option>
                                                    @foreach ($customer as $customer)
                                                      <option value="{{$customer->id}}">{{$customer->name}}</option>
                                                   @endforeach
                                                   
                                        </select> 
                                        </div>
                <label class="col-form-label col-md-4 col-sm-4 label-align">Nomor Polisi : </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select id='no_polisi' name="no_polisi" class="form-control">       
                                                    <option value="">--Pilih Nomor Polisi--</option>
                                                    @foreach ($nopol as $nopol)
                                                      <option value="{{$nopol->id}}">{{$nopol->nomor_polisi}}</option>
                                                   @endforeach
                                                   
                                        </select> 
                                        </div>
                <br><br><br><label class="col-form-label col-md-4 col-sm-4 label-align">PO Customer : </label>
                                     <div class="col-md-6 col-sm-6 ">
                                        <input type="text" name="po_customer_number" id="po_customer_number" class="form-control">
                                        </div>
                <br><br><br><label class="col-form-label col-md-4 col-sm-4 label-align">PO Date : </label>
                                     <div class="col-md-6 col-sm-6 ">
                                        <input type="date" name="po_date" id="po_date" class="form-control">
                                        </div>
                <br><br><br><br>
                <h4 ><b>GPS</b></h4><label class="col-form-label col-md-4 col-sm-4 label-align">GPS IMEI : </label>
                                     <div class="col-md-6 col-sm-6 ">
                                        <input type=text  name="imei" id="imei" class="form-control">
                                        </div>

                
                <br><label class="col-form-label col-md-4 col-sm-4 label-align">GPS Own By : </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type=text  name="gps_owned_by" id="gps_owned_by" class="form-control">
                                        </div>
                                        

                <br><label class="col-form-label col-md-4 col-sm-4 label-align">GPS Brand : </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select id='merck' name="merck" class="form-control">       
                                                    <option value="">--Pilih Brand--</option>
                                                    @foreach ($merk as $merk)
                                                      <option value="{{$merk->merk}}">{{$merk->merk}}</option>
                                                   @endforeach
                                                   
                                        </select>
                                        </div>
               <br><br><br><label class="col-form-label col-md-4 col-sm-4 label-align">GPS Type : </label>
                                     <div class="col-md-6 col-sm-6 ">
                                        <input type="text" name="type" id="type" class="form-control">
                                        </div>
                <br><br><br><label class="col-form-label col-md-4 col-sm-4 label-align">GPS Status : </label>
                                     <div class="col-md-6 col-sm-6 ">
                                        <select id='gps_status' name="gps_status" class="form-control">       
                                                    <option value="">--Pilih Status--</option>
                                                    <option value="Sewa">Sewa</option>
                                                    <option value="Beli">Beli</option>
                                                    <option value="Sewa Beli">Sewa Beli</option>
                                                    <option value="Trial">Trial</option>
                                                   
                                        </select>
                                        </div>
               <br><br><label class="col-form-label col-md-4 col-sm-4 label-align">GPS Install Date </label>
                                     <div class="col-md-6 col-sm-6 ">
                                        <input type="date" name="gps_install_date" id="gps_install_date" class="form-control">
                                        </div>
                <br><br><label class="col-form-label col-md-4 col-sm-4 label-align">GPS Uninstall Date : </label>
                                     <div class="col-md-6 col-sm-6 ">
                                        <input type="date" name="gps_uninstall_date" id="gps_uninstall_date" class="form-control">
                                        </div>
               <br><br><label class="col-form-label col-md-4 col-sm-4 label-align">Installation Location : </label>
                                     <div class="col-md-6 col-sm-6 ">
                                        <input type="text" name="installation_location" id="installation_location" class="form-control">
                                        </div>
               <br><br><label class="col-form-label col-md-4 col-sm-4 label-align">Remarks : </label>
                                     <div class="col-md-6 col-sm-6 ">
                                        <input type="text" name="remarks" id="remarks" class="form-control">
                                        </div>
                <br><br><br><br>
                <h4 ><b>GSM</b></h4><label class="col-form-label col-md-4 col-sm-4 label-align">GSM : </label>
                                     <div class="col-md-6 col-sm-6 ">
                                        <input type=text  name="gsm_number" id="gsm_number" class="form-control">
                                        </div>
                <br><br><label class="col-form-label col-md-4 col-sm-4 label-align">GSM Provider : </label>
                                     <div class="col-md-6 col-sm-6 ">
                                        <input type="text" name="gsm_provider" id="gsm_provider" class="form-control">
                                        </div>
                <br><br><br><br>
                <h4 ><b>OSLOG</b></h4><label class="col-form-label col-md-4 col-sm-4 label-align">OSLOG Status : </label>
                                     <div class="col-md-6 col-sm-6 ">
                                        <select id='oslog_status' name="oslog_status" class="form-control">       
                                                    <option value="">--Pilih Status--</option>
                                                    <option value="Aktif">Aktif</option>
                                                    <option value="Non Aktif">Non Aktif</option>
                                                   
                                        </select>
                                        </div>
                <br><label class="col-form-label col-md-4 col-sm-4 label-align">OSLOG Active Date : </label>
                                     <div class="col-md-6 col-sm-6 ">
                                        <input type="date"  name="oslog_active_date" id="oslog_active_date" class="form-control">
                                        </div>

                <br><label class="col-form-label col-md-4 col-sm-4 label-align">OSLOG Inactive Date </label>
                                     <div class="col-md-6 col-sm-6 ">
                                        <input type="date"  name="oslog_end_date" id="oslog_end_date" class="form-control">
                                        </div>

              
                                     </div>

                                     
              
              
              
              <!-- =========================================  SEBELAHNYA  =============================================================== -->
                            <div class="form-group col-sm-6">
                            <h4 ><b>ACCESSORIES</b></h4>
                            
							<label class="col-form-label col-md-4 col-sm-4 label-align">Door :</label>
								<div class="col-md-6 col-sm-6 ">
									<input class="form-control" type="number"  name="door_sensor" id="door_sensor">
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
                </div></div>

         <h4><b> Note :</b> </h4>
         <div class="form-group col-sm-6">
                <label class="col-form-label col-md-4 col-sm-4 label-align">EX Nomor Polisi : </label>
                                    <div class="col-md-6 col-sm-6 ">
                                    <input type="text" name="ex_no_polisi" id="ex_no_polisi" class="form-control">

                                        </div>
                <label class="col-form-label col-md-4 col-sm-4 label-align">EX IMEI (GPS) : </label>
                                    <div class="col-md-6 col-sm-6 ">
                                    <input type="text" name="ex_imei" id="ex_imei" class="form-control">

                                        </div>
                <br><br><br><label class="col-form-label col-md-4 col-sm-4 label-align">EX GSM Number : </label>
                                     <div class="col-md-6 col-sm-6 ">
                                        <input type="text" name="ex_gsm_number" id="ex_gsm_number" class="form-control">
                                        </div>
                <br><br><br><label class="col-form-label col-md-4 col-sm-4 label-align">Remarks : </label>
                                     <div class="col-md-6 col-sm-6 ">
                                        <input type="text" name="note" id="note" class="form-control">
                                        </div>
                                     </div> </div></div>


         <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Save</button>
              </form>
			</div>
		</div>

						

      @endsection