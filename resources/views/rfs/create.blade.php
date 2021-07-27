@extends ('layouts/tema')

@section('title','add request for service')

@section('card_title','Add Request For Service')

@section('isi')



<div class="row">
						<div class="col-md-12 ">
							<div class="x_panel">
							
								<div class="x_content">
									<br />

                  <form method="post" action="/store_rfs" autocomplete="off" enctype="multipart/form-data" class="form-label-left input_mask">
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
                      <option value="">Choose Requestor PIC</option>

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
                      <select id="nomor_polisi" name="nomor_polisi[]" multiple class="form-control" >
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
                      <select name="status" class="form-control" required>       
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
									
                    
									<script>
													function timeFunctionLong(input) {
														setTimeout(function() {
															input.type = 'text';
														}, 60000);
													}
												</script>
										<div class="ln_solid"></div>
										<div class="form-group row">
											<div class="col-md-6 col-sm-6  offset-md-4">
												<button type="submit" class="btn btn-success">Save</button>
											</div>
										</div>

									</form>
								</div>
							</div>

						

      
 


 <!-- Modal -->
 <div class="modal fade" id="Modalnopol" >
    <div class="modal-dialog" >
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" >Add Nomor Polisi</h5>
              <button type="button" class="close" data-dismiss="modal" >
                &times;
              </button>
              </div>
              <div class="modal-body">
              <form action="/store_nopol" method="POST">
              @csrf
              <div class="form-group">
                <label for="customer">Customer</label>
                <select id='id_customer' name="id_customer" class="form-control">
                  @foreach ($customer as $customer)                                
                                <option value="{{$customer->id}}">{{$customer->name}}</option>                               
                  @endforeach
          </select>
                </div>
                <div class="form-group">
                <label for="nopol">Nomor Polisi</label>
                  <input name="nopol" type="text" class="form-control" id="exampleInputEmail1">
                </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-info">Save</button>
              </form>
          </div>
        </div>
      </div>
      </div>
      </div>

      
      <!-- Modal BRAND -->
 <div class="modal fade" id="Modalbc" >
    <div class="modal-dialog" >
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" >Add Business Conduct</h5>
              <button type="button" class="close" data-dismiss="modal" >&times;</button>
              </div>
              <div class="modal-body">
              <form action="/store_bc" method="POST">
              @csrf
                <div class="form-group">
                  <input name="rfs" type="text" class="form-control" id="exampleInputEmail1">
                </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-info">Save</button>
              </form>
          </div>
        </div>
      </div>
      </div>
      </div>


@endsection


@section("skrip")
<script type="text/javascript">
    $(document).ready(function() {
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }); 

    

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

   // pilihan nopol otomatis
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
          // $("#nomor_polisi").multi({enable_search: false});

          
            
        },
        error: function (data) {
          console.log('Error:', data);
        }

        })
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

        

        // =============================  MULTI SELECT  ===========================================
     
            
      

});



</script>

@endsection