@extends ('layouts/tema')

@section('title','Berita Acara Pemasangan')

@section('card_title','Berita Acara Pemasangan')

@section('isi')



                    <div class="row">
						<div class="col-md-12 ">
							<div class="x_panel">

            <form action="/add_bap" method="POST" autocomplete="off" enctype="multipart/form-data">
              @csrf
                  <div class="form-group col-sm-6">
                  <div class="form-group row">
                <label class="col-form-label col-md-4 col-sm-4 label-align" >Job : </label>
                                    <div class="col-md-4 col-sm-4 ">
                                        <select id='job_type' name="job_type" class="form-control">       
                                                    <option value="">--Pilih Job--</option>
                                                    <option value="Install">Install</option>
                                                    <option value="Mutasi">Mutasi</option>
                                        </select> 
                                        </div></div>
                     <div class="form-group row">
                <br><label class="col-form-label col-md-4 col-sm-4 label-align">Form Nomor Polisi :</label>
											<div class="col-md-4 col-sm-4 ">
												<input type="text" class="form-control" name="ex_nomor_polisi" id="ex_nomor_polisi" >
											</div></div>
										
                  <div class="form-group row">
                <br><label class="col-form-label col-md-4 col-sm-4 label-align">SPK Number : </label>
                                 <div class="col-md-4 col-sm-4 ">
                                    <input type=text  name="spk_number" id="spk_number" class="form-control">
                                    </div></div>

                <br><br><br><br>
                <label class="col-form-label col-md-4 col-sm-4 label-align">Customer : </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select id='id_customer' name="id_customer" class="form-control">       
                                                    <option value="">--Pilih Customer--</option>
                                                    @foreach ($customer as $customer)
                                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                                    @endforeach
                                        </select> 
                                        </div>
                <br><label class="col-form-label col-md-4 col-sm-4 label-align">Tanggal : </label>
                                     <div class="col-md-6 col-sm-6 ">
                                        <input type="date" name="bap_date" id="bap_date" class="form-control">
                                        </div>
                <br><label class="col-form-label col-md-4 col-sm-4 label-align">Alamat Pemasangan : </label>
                                     <div class="col-md-6 col-sm-6 ">
                                        <input type=text  name="installation_location" id="installation_location" class="form-control">
                                        </div>

                <br><label class="col-form-label col-md-4 col-sm-4 label-align">PO Number  : </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type=text  name="po_number" id="po_number" class="form-control">
                                        </div>

                <br><label class="col-form-label col-md-4 col-sm-4 label-align">PO Date : </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="date" name="po_date" id="po_date" class="form-control">
                                        </div>

                <br><label class="col-form-label col-md-4 col-sm-4 label-align">Merk/Type Kendaraan  : </label>
                                     <div class="col-md-6 col-sm-6 ">
                                        <input type=”text”  name="vehicle_type" id="vehicle_type" class="form-control">
                                        </div>

                <br><label class="col-form-label col-md-4 col-sm-4 label-align"> Nomor Kendaraan  : </label>
                                     <div class="col-md-6 col-sm-6 ">
                                        <input type=”text”  name="vehicle_number" id="vehicle_number" class="form-control">
                                        </div>

                <br> <label class="col-form-label col-md-4 col-sm-4 label-align"> Nomor Polisi  : </label>
                                      <div class="col-md-6 col-sm-6 ">
                                        <input type=”text”  name="nomor_polisi" id="nomor_polisi" class="form-control">
                                        </div>

                <br> <label class="col-form-label col-md-4 col-sm-4 label-align"> Odometer  :</label>
                                      <div class="col-md-6 col-sm-6 ">
                                        <input type="number"  name="odometer" id="odometer" class="form-control">
                                        </div>
                                     </div>
              
              
              
              
                            <div class="form-group col-sm-6">
                             <div class="form-group row">
							<label class="col-form-label col-md-4 col-sm-4 label-align">Kapasitas Bensin :</label>
								<div class="col-md-2 col-sm-2 ">
									<input class="form-control" type="number"  name="fuel_tank_capacity" id="fuel_tank_capacity">
								</div></div>	
                             <div class="form-group row">
							<label class="col-form-label col-md-4 col-sm-4 label-align">Rasio Bensin : </label>
								<div class="col-md-3 col-sm-3 ">
									<input type="text" class="form-control"  name="fuel_ratio" id="fuel_ratio">
								</div></div>
                             <div class="form-group row">
							<label class="col-form-label col-md-4 col-sm-4 label-align">Jenis Bensin : </label>
								<div class="col-md-3 col-sm-3 ">
							    	<input type="text" class="form-control" name="fuel_type" id="fuel_type">
								</div></div>						
                <br><br><br><br>
               
							<label class="col-form-label col-md-4 col-sm-4 label-align">IMEI : </label>
								<div class="col-md-6 col-sm-6 ">
									<input type="text" class="form-control" name="imei" id="imei">
								</div>
                             <br>
                             <label class="col-form-label col-md-4 col-sm-4 label-align">Type GPS : </label>
							    <div class="col-md-6 col-sm-6 ">
									<input type="text" class="form-control" name="gps_type" id="gps_type">
								</div>
                            <br>
                            <label class="col-form-label col-md-4 col-sm-4 label-align">GSM : </label>
								<div class="col-md-6 col-sm-6 ">
                                     <select id='gsm_number' class="form-control" name="gsm_number" >       
                                         <option value="">-- Pilih GSM --</option>
                                         @foreach ($gsm as $gsm)
                                        <option value="{{$gsm->id}}">{{$gsm->gsm_number}}</option>
                                        @endforeach
                                     </select>
								</div>
                </div></div>

                <!-- ================================ HAsil Pemeriksaan ============================================= -->
              
                <label ><b>Hasil Pemeriksaan GPS : </b></label>
                         <input type=text name="technical_check" id="technical_check"  class="form-control" style="width:40px;height:40px;"><br>
                    
                <div class="form-row">
                <label for=""><B>Catatan : </b></label> <br>
            <textarea name="technical_check_remarks" id="technical_check_remarks" rows="5" cols="140" class="form-control"></textarea>
               </div>

             <!-- ================================ END HAsil Pemeriksaan ============================================= -->

              <!-- ================================ Pemasangan Sensor ============================================= -->

             <br> <span><b>Pemasangan Sensor    :</b></span><br><br>
             <div class="row">
             <div class="form-group col-sm-3">
            
             <label class="col-form-label col-md-4 col-sm-4 label-align">DOOR : </label> 
                <input type=text name="door_sensor" id="door_sensor" class="form-control" style="width:40px;"> 

            <label class="col-form-label col-md-4 col-sm-4 label-align">REMARKS : </label>
                <input type=text  name="door_sensor_remarks" id="door_sensor_remarks" class="form-control"style="width:100px;">
            
           </div>
              
            <div class="form-group col-sm-3">
            <label class="col-form-label col-md-4 col-sm-4 label-align">SUHU : </label>
                <input type=text name="temperature_sensor" id="temperature_sensor" class="form-control" style="width:40px;"> 

            <label class="col-form-label col-md-4 col-sm-4 label-align">REMARKS : </label>
                <input type=text  name="temperature_sensor_remarks" id="temperature_sensor_remarks" class="form-control" size=”40″ style="width:100px;">
            </div>

            
            <div class="form-group col-sm-3">
            <label class="col-form-label col-md-4 col-sm-4 label-align">BUTTON : </label>
                <input type=text name="button_sensor" id="button_sensor" size=”30″ class="form-control" style="width:40px;"> 

            <label class="col-form-label col-md-4 col-sm-4 label-align">REMARKS : </label>
                <input type=text  name="button_sensor_remarks" id="button_sensor_remarks" size=”40″ style="width:100px;" class="form-control">
            </div>
            
            
            <div class="form-group col-sm-3">
            <label class="col-form-label col-md-5 col-sm-5 label-align">MOBILIZIER : </label>
                <input type=text  name="immobilizer_sensor" id="immobilizer_sensor" size=”30″ style="width:40px;" class="form-control">
           
            <label class="col-form-label col-md-5 col-sm-5 label-align">FUEL : </label>
                <input type=text  name="fuel_sensor" id="fuel_sensor" size=”40″ style="width:40px;" class="form-control">
           </div>
            </div>




            <div class="row">
             <div class="form-group col-sm-3">
             <label class="col-form-label col-md-4 col-sm-4 label-align">DUMP : </label>
                <input type=text name="dump_sensor" id="dump_sensor" class="form-control" style="width:40px;"> 
            </div>
              
            <div class="form-group col-sm-3">
            <label class="col-form-label col-md-4 col-sm-4 label-align">TAIL : </label>
                <input type=text name="tail_sensor" id="tail_sensor" class="form-control" style="width:40px;"> 
            </div>

            <div class="form-group col-sm-3">
            <label class="col-form-label col-md-4 col-sm-4 label-align">RFID : </label>
                <input type=text name="rfid_sensor" id="rfid_sensor" class="form-control" style="width:40px;">
            </table></div>
            
            <div class="form-group col-sm-3">
            <label class="col-form-label col-md-4 col-sm-4 label-align">CAMERA : </label>
                <input type=text name="camera_sensor" id="camera_sensor" class="form-control" style="width:40px;"> 
            </div>

            <div class="form-group col-sm-3">
            <label class="col-form-label col-md-4 col-sm-4 label-align">PTT : </label>
                <input type=text name="pust_to_talk" id="pust_to_talk" class="form-control" style="width:40px;"> 
            </div>
            </div>

           <!-- ================================ End Pemasangan Sensor ============================================= -->


            <label  for=""><B>Catatan : </b></label>
            <textarea id="remarks" name="remarks" rows="5" cols="140" class="form-control"></textarea>



            <!--=================================================== Teknisi & Attachment =============================================== -->

            
                  <div class="form-group col-sm-6">

                 
                  <br><br>
                  <div class="form-group row">
                  <label class="col-form-label col-md-4 col-sm-4 label-align">GPS Port :</label>
                  <div class="col-md-2 col-sm-2 ">
                  <input type="number" name="gps_port" id="gps_port" class="form-control" ">
                  </div></div>

                  <div class="form-group row">
                  <label class="col-form-label col-md-4 col-sm-4 label-align"> Teknisi1 : </label>
                  <div class="col-md-4 col-sm-4 ">
                    <select id='technician_1' name="technician_1" class="form-control" >       
                                <option value="">-- Pilih --</option>
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
                     <input type=file  name="attachment1" id="attachment1" >
                     </div></div>

                <div class="form-group row">
                <label class="col-form-label col-md-4 col-sm-4 label-align">Attachment2 : </label>
                <div class="col-md-6 col-sm-6 ">
                     <input type=file  name="attachment2" id="attachment2" >
                     </div></div>

                <div class="form-group row">
                <label class="col-form-label col-md-4 col-sm-4 label-align">Attachment3 : </label>
                <div class="col-md-6 col-sm-6 ">
                    <input type=file  name="attachment3" id="attachment3" >
                    </div></div>

                <div class="form-group row">
                <label class="col-form-label col-md-4 col-sm-4 label-align">Attachment4 : </label>
                <div class="col-md-6 col-sm-6 ">
                    <input type=file  name="attachment4" id="attachment4" >
                    </div></div>

                <div class="form-group row">
               <label class="col-form-label col-md-4 col-sm-4 label-align">Attachment5 : </label>
               <div class="col-md-6 col-sm-6 ">
                <input type=file  name="attachment5" id="attachment5" >
                </div></div><br>
                </div>
                </div>
                </div>

          <!--=================================================== End Teknisi & Attachment =============================================== -->

         <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Save</button>
              </form>
			</div>
         </div>

						

      @endsection