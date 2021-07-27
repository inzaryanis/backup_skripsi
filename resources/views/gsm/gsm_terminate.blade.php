@extends ('layouts/tema')

@section('title','GSM Terminate')

@section('card_title','GSM Terminate')

@section('isi')

<style>
            /* Basic styling */
            body {
                font-family: sans-serif;
            }

           
            /* .modal-content {
               background:#000;
            } */
 </style>

<br>
<!-- <a href="/create_gsm" class="btn btn-success">Receipt</a> -->
<!-- <a style="color:#fff;" data-toggle="modal" data-target="#Modalreceipt" class="btn btn-warning">Receipt</a> -->
<div class="btn-group">
<button class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:#fff;">Receipt</button>
  <div class="dropdown-menu">
  <a style="color:#000;" data-toggle="modal" data-target="#Modalreceipt" class="dropdown-item">Receipt</a>
  <a style="color:#000;" data-toggle="modal" data-target="#importExcel" class="dropdown-item">Receipt Import</a>
  </div> </div>
<a style="color:#fff;" data-toggle="modal" data-target="#Modalissued" class="btn btn-warning">Issued</a>
<!-- <a style="color:#fff;" data-toggle="modal" data-target="#Modalactived" class="btn btn-warning">Actived</a> -->
<div class="btn-group">
<button class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:#fff;">Actived</button>
  <div class="dropdown-menu">
  <a style="color:#000;" data-toggle="modal" data-target="#Modalactived" class="dropdown-item">Request Actived</a>
  <a style="color:#000;" data-toggle="modal" data-target="#Modalupdateactived" class="dropdown-item">Update Actived</a>
  <a href="/Display-Request-Actived" style="color:#000;" class="dropdown-item">Display GSM Request Actived</a>
  <a href="/Display-GSM-Actived" style="color:#000;" class="dropdown-item">Dislay GSM Actived</a>
  </div> </div>
<!-- <a style="color:#fff;" data-toggle="modal" data-target="#Modalterminated" class="btn btn-warning">Terminated</a> -->
<div class="btn-group">
  <button class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:#fff;">Terminated</button>
  <div class="dropdown-menu" >
  <a style="color:#000;" data-toggle="modal" data-target="#Modalterminated2" class="dropdown-item">Request Terminated</a>
  <a style="color:#000;" data-toggle="modal" data-target="#Modalupdateterminated2" class="dropdown-item">Update Terminated</a>
  <a href="/Display-Request-Terminate" style="color:#000;" class="dropdown-item">Display GSM Request Terminated</a>
  <a href="/Display-GSM-Terminate" style="color:#000;" class="dropdown-item">Dislay GSM Terminated</a>
  </div> </div>
  

<br><br><br>
                  <div class="table-responsive">
                  <table id="table_display_gsm_terminated" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col">GSM Number</th>
                          <th scope="col">Receipt Date</th>
                          <th scope="col">Active Date</th>
                          <th scope="col">Terminated Request Date</th>
                          <th scope="col">Terinated Date</th>
                          <th scope="col">Vendor</th>
                          <th scope="col">Action</th>

                        </tr>
                      </thead>
                    </table>


<!-- =========================== MODAL ===================================================== -->
<!-- Modal Receipt -->
<div class="modal fade" id="Modalreceipt" >
    <div class="modal-dialog" >
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" >Receipt</h5>
              <button type="button" class="close" data-dismiss="modal" >&times;</button>
              </div>
              <div class="modal-body">
              <form action="/receipt_add" method="POST" autocomplete="off">
              @csrf
                <div class="form-group">
                <label for="gsm_number">MSISDN/GSM</label>
                  <input name="gsm_number" type="text" class="form-control" id="gsm_numberr" required>
                </div>
                <div class="form-group">
                <label for="serial_number">Serial Number</label>
                  <input name="serial_number" type="text" class="form-control" id="serial_number">
                </div>
                <div class="form-group">
                <label for="receipt_date">Receipt Date</label>
                  <input name="receipt_date" type="date" class="form-control" id="receipt_date" required>
                </div>
                <div class="form-group">
                <label for="vendor">Vendor</label>
                  <input name="vendor" type="text" class="form-control" id="vendor" required>
                </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-info">Save</button>
              <!-- <button type="button" class="btn btn-primary mr-5" data-toggle="modal" data-target="#importExcel">
			IMPORT EXCEL
		</button> -->
              <!-- <button type="button" class="btn btn-danger">Close</button> -->
              </form>
          </div>
        </div>
      </div>
      </div>
      </div>

      <!-- Import Excel -->
		<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<form method="post" action="/gsm/import" enctype="multipart/form-data">
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
 

      <!-- Modal ISUUED -->
<div class="modal fade" id="Modalissued" >
    <div class="modal-dialog" >
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" >Issued</h5>
              <button type="button" class="close" data-dismiss="modal" >&times;</button>
              </div>
              <div class="modal-body">
              <form action="/issued_add" method="POST" autocomplete="off" enctype="multipart/form-data">
              @csrf
                <!-- <div class="form-group">
                <label for="option">Option</label>
                <select id='option' name="option" class="form-control"> 
                          <option value="">-- Select Option --</option>                     
                          <option value="add gsm">Add GSM</option>
                          <option value="display gsm">Display GSM</option>

                  </select>
                </div> -->
                <div class="form-group">
                <label for="issue_to">Issue To</label>  
                  <!-- Button to Open the Modal -->
                  <!-- <a data-toggle="modal" data-target="#Modalissue_to"><img src="{{asset('admin/assets/img/add.png')}}" width="10" height="10" ></i></a> -->
                 <select id='issue_to' name="issue_to" class="form-control">
                                <option value="">-- Select Issue To --</option>                     
                                @foreach ($issue_to as $issue_to)                                
                                <option value="{{$issue_to->issue_to}}">{{$issue_to->issue_to}}</option>                               
                                @endforeach              
                  </select>
                </div>
                <div class="form-group">
                <label for="issue_date">issue Date</label>
                  <input name="issue_date" type="date" class="form-control" id="issue_date" required>
                </div>
                <div class="container">
                <div class="form-group">
                  <label for="gsm_number_issued">GSM Number</label>
                  <select id="gsm_number_issued" name="gsm_number_issued[]" multiple class="form-control" >
                  @foreach ($gsm as $gsm)                                
                                <option value="{{$gsm->id}}">{{$gsm->gsm_number}}</option> 
                                 @endforeach
                  </select>
                </div> </div> <br>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-info">Save</button>
              </form>
          </div>
        </div>
      </div>
      </div>
      </div>

       <!-- Modal ACTIVED -->
<div class="modal fade" id="Modalactived" >
    <div class="modal-dialog modal-800" >
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" >Actived</h5>
              <button type="button" class="close" data-dismiss="modal" >&times;</button>
              </div>
              <div class="modal-body">
              <form action="/actived_add" method="POST" autocomplete="off" enctype="multipart/form-data">
              @csrf
                <div class="form-group">
                <label for="activation_date_request"> Activation Date Request</label>
                  <input name="activation_date_request" type="date" class="form-control" id="activation_date_request" required>
                </div>
                <!-- <div class="form-group">
                <label for="activation_status"> Activation Status</label>
                  <input name="activation_status" type="text" class="form-control" id="activation_status" readonly placeholder="SUCCESS">
                </div>
                <div class="form-group">
                <label for=" active_date"> Active Date</label>
                  <input name=" active_date" type="date" class="form-control" id=" active_date">
                </div> -->
                <div class="container">
                <div class="form-group">
                  <label for="gsm_number_actived">GSM Number</label>
                  <select id="gsm_number_actived" name="gsm_number_actived[]" multiple class="form-control"  required  >
                  @foreach ($gsm_number_actived as $gsm_number_actived)                                
                                <option value="{{$gsm_number_actived->id}}">{{$gsm_number_actived->gsm_number}}</option>                              
                             
                                @endforeach
                  </select>
                </div> </div> <br>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-info">Save</button>
              </form>
          </div>
        </div>
      </div>
      </div>
      </div>

       <!-- Modal UPDATE ACTIVED -->
<div class="modal fade" id="Modalupdateactived" >
    <div class="modal-dialog modal-800" >
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" >Update Actived</h5>
              <button type="button" class="close" data-dismiss="modal" >&times;</button>
              </div>
              <div class="modal-body">
              <form action="/update_actived" method="POST" autocomplete="off" enctype="multipart/form-data">
              @csrf
               <div class="form-group">
                <label for=" active_date"> Active Date</label>
                  <input name=" active_date" type="date" class="form-control" id=" active_date" required>
                </div>
                <div class="container">
                <div class="form-group">
                  <label for="update_actived">GSM Number</label>
                  <select id="update_actived" name="update_actived[]" multiple class="form-control"  required  >
                  @foreach ($update_actived as $update_actived)                                
                                <option value="{{$update_actived->id}}">{{$update_actived->gsm_number}}</option>                              
                             
                                @endforeach
                  </select>
                </div> </div> <br>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-info">Save</button>
              </form>
          </div>
        </div>
      </div>
      </div>
      </div>


       <!-- Modal TERMINATED -->
<div class="modal fade" id="Modalterminated" >
    <div class="modal-dialog" >
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" ><b>TERMINATED</b></h5>
              <button type="button" class="close" data-dismiss="modal" >&times;</button>
              </div>
              <div class="modal-body">
              <form action="/terminated_add" method="POST" autocomplete="off" enctype="multipart/form-data">
              @csrf
                <div class="form-group">
                <label for="termination_date_request"> Termination Date Request</label>
                  <input name="termination_date_request" type="date" class="form-control" id="termination_date_request" required>
                </div>
                <div class="form-group">
                <label for=" terminated_date"> Terminated Date</label>
                  <input name=" terminated_date" type="date" class="form-control" id=" terminated_date" required>
                </div>
                <div class="container">
                <div class="form-group">
                  <label for="gsm_number_terminated">GSM Number</label>
                  <select id="gsm_number_terminated" name="gsm_number_terminated[]" multiple class="form-control"  required  >
                 
                  </select>
                </div> </div> <br>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-info">Save</button>
              </form>
          </div>
        </div>
      </div>
      </div>
      </div>
  <!-- Modal TERMINATED2 -->
  <div class="modal fade" id="Modalterminated2" >
    <div class="modal-dialog" >
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" ><b>TERMINATED</b></h5>
              <button type="button" class="close" data-dismiss="modal" >&times;</button>
              </div>
              <div class="modal-body">
              <form action="/terminated2" method="POST" autocomplete="off" enctype="multipart/form-data">
              @csrf
                <div class="form-group">
                <label for="termination_date_request"> Termination Date Request</label>
                  <input name="termination_date_request" type="date" class="form-control" id="termination_date_request" required>
                </div>
                <div class="container">
                <div class="form-group">
                  <label for="gsm_number_terminated2">GSM Number</label>
                  <select id="gsm_number_terminated2" name="gsm_number_terminated[]" multiple class="form-control"  required  >
                  @foreach ($gsm_number_terminated as $gsm_number_terminated)                                
                                <option value="{{$gsm_number_terminated->id}}">{{$gsm_number_terminated->gsm_number}}</option>                              
                             
                                @endforeach

                  </select>
                </div> </div> <br>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-info">Save</button>
              </form>
          </div>
        </div>
      </div>
      </div>
      </div>

       <!-- Modal Update TERMINATED2 -->
  <div class="modal fade" id="Modalupdateterminated2" >
    <div class="modal-dialog" >
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" ><b>UPDATE TERMINATED2</b></h5>
              <button type="button" class="close" data-dismiss="modal" >&times;</button>
              </div>
              <div class="modal-body">
              <form action="/update_terminated" method="POST" autocomplete="off" enctype="multipart/form-data">
              @csrf
                <div class="form-group">
                <label for="terminated_date"> Terminated Date</label>
                  <input name="terminated_date" type="date" class="form-control" id="terminated_date" required>
                </div>
                <div class="container">
                <div class="form-group">
                  <label for="updated_terminated">GSM Number</label>
                  <select id="updated_terminated" name="updated_terminated[]" multiple class="form-control"  required  >
                  @foreach ($update_terminated as $update_terminated)                                
                                <option value="{{$update_terminated->id}}">{{$update_terminated->gsm_number}}</option>                              
                             
                                @endforeach
                  </select>
                </div> </div> <br>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-info">Save</button>
              </form>
          </div>
        </div>
      </div>
      </div>
      </div>


       <!-- EDIT Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editHeader" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editHeader">Edit GSM</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="formEdit">
      <input type="hidden" id="editId" name="id"></input>
        @method('POST')
              <div class="form-group">
                  <label for="gsm_number">gsm_number</label>
                  <input type="text" class="form-control" id="Egsm_number"  name="gsm_number">
                </div>
                <div class="form-group">
                  <label for="serial_number">serial number</label>
                  <input type="text" class="form-control" id="Eserial_number" name="serial_number" >
                </div>
                <div class="form-group">
                  <label for="receipt_date">receipt date</label>
                  <input type="date" class="form-control" id="Ereceipt_date" name="receipt_date" >
                </div>
                <div class="form-group">
                  <label for="issue_date">issue date</label>
                  <input type="date" class="form-control" id="Eissue_date" name="issue_date" >
                </div>
                <div class="form-group">
                  <label for="issue_to">issue to</label>
                  <input type="text" class="form-control" id="Eissue_to" name="issue_to" >
                </div>
                <div class="form-group">
                  <label for="activation_date_request">activation date request</label>
                  <input type="date" class="form-control" id="Eactivation_date_request" name="activation_date_request" >
                </div>
                <div class="form-group">
                  <label for="activation_status">activation status</label>
                  <select id="activation_status" name="activation_status"  class="form-control" required  >                             
                                <option value="SUCCESS">SUCCESS</option>     
                                <option value="FAILED">FAILED</option>                              
                         
                             
                  </select>
                </div>
                <div class="form-group">
                  <label for="active_date">active date</label>
                  <input type="date" class="form-control" id="Eactive_date" name="active_date" >
                </div>
                <div class="form-group">
                  <label for="termination_date_request">termination date request</label>
                  <input type="date" class="form-control" id="Etermination_date_request" name="termination_date_request" >
                </div>
                <div class="form-group">
                  <label for="terminated_date">terminated date</label>
                  <input type="date" class="form-control" id="Eterminated_date" name="terminated_date" >
                </div>
                <div class="form-group">
                  <label for="termination_remarks">termination remarks</label>
                  <input type="text" class="form-control" id="Etermination_remarks" name="termination_remarks" >
                </div>
                <div class="form-group">
                  <label for="condition">condition</label>
                  <input type="text" class="form-control" id="Econdition" name="condition" >
                </div>
                <div class="form-group">
                  <label for="functional_status">functional status</label>
                  <input type="text" class="form-control" id="Efunctional_status" name="functional_status" >
                </div>
                <div class="form-group">
                  <label for="vendor">vendor</label>
                  <input type="text" class="form-control" id="Evendor" name="vendor" >
                </div>
                <div class="form-group">
                  <label for="remarks">remarks</label>
                  <input type="text" class="form-control" id="Eremarks" name="remarks" >
                </div>
               
               <button class="mt-2 btn btn-primary" id="editSubmit">Edit</button><br>
                </form>
      </div>
    </div>
  </div>
</div>

      <!-- Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailHeader" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailHeader">Detail GSM</h5>
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
              <td align="right"><b><b>GSM Number  :</b></td>
              <td  id="Dgsm_number"></td>
              </tr>

              <tr>
              <td align="right"><b>Serial Number  :</b></td>
              <td id="Dserial_number"></td>
              </tr>

              <tr>
              <td align="right"><b>Receipt Date  :</b></td>
              <td id="Dreceipt_date"></td>
              </tr>

              <tr>
              <td align="right"><b>Issue Date  :</b></td>
              <td id="Dissue_date"></td>
              </tr>

              <tr>
              <td align="right"><b>Issue To  :</b></td>
              <td id="Dissue_to"></td>
              </tr>


              <tr>
              <td align="right"><b>Activation Date Request  :</b></td>
              <td id="Dactivation_date_request"></td>
              </tr>

              <tr>
              <td align="right"><b>Activation Status  :</b></td>
              <td id="Dactivation_status"></td>
              </tr>

              <tr>
              <td align="right"><b>Active Date  :</b></td>
              <td id="Dactive_date"></td>
              </tr>

              <tr>
              <td align="right"><b>Termination Date Request  :</b></td>
              <td id="Dtermination_date_request"></td>
              </tr>

              <tr>
              <td align="right"><b>Terminated Date  :</b></td>
              <td id="Dterminated_date"></td>
              </tr>

              <tr>
              <td align="right"><b>Termination Remarks  :</b></td>
              <td id="Dtermination_remarks"></td>
              </tr>

              <tr>
              <td align="right"><b>Condition  :</b></td>
              <td id="Dcondition"></td>
              </tr>

              <tr>
              <td align="right"><b>Functional Status  :</b></td>
              <td id="Dfunctional_status"></td>
              </tr>

              <tr>
              <td align="right"><b>Vendor  :</b></td>
              <td id="Dvendor"></td>
              </tr>

              <tr>
              <td align="right"><b>Remarks  :</b></td>
              <td id="Dremarks"></td>
              </tr>

              <tr>
              <td align="right"><b>Created By  :</b></td>
              <td id="Dcreated_by"></td>
              </tr>

              <tr>
              <td align="right"><b>Created At  :</b></td>
              <td id="Dcreated_at"></td>
              </tr>

              <tr>
              <td align="right"><b>Updated By  :</b></td>
              <td id="Dupdated_by"></td>
              </tr>

              <tr>
              <td align="right"><b>Updated At  :</b></td>
              <td id="Dupdated_at"></td>
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

  table = $('#table_display_gsm_terminated').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{{url("/DGT/getdata")}}',
      columns: [
          {
              data: 'DT_RowIndex',
              name: 'DT_RowIndex'
          },
          {
              data: 'gsm_number',
              name: 'gsm_number'
          },
          {
              data: 'receipt_date',
              name: 'receipt_date'
          },
          {
              data: 'active_date',
              name: 'active_date'
          },
          {
              data: 'termination_date_request',
              name: 'termination_date_request'
          },
          {
              data: 'terminated_date',
              name: 'terminated_date'
          },
          {
              data: 'vendor',
              name: 'vendor'
          },
         
          {
              data: 'action',
              name: 'action'
          },
      ]
  });


    // ============================ EDIT ==============================

    $('#formEdit').on("submit", function (e) {

e.preventDefault();

$('#editSubmit').html('Mengedit..');

var formData = new FormData(this);

$.ajax({

  data: formData,

  url: "{{route('gsm.update')}}",

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

$.get("/edit/gsm" +'/' + id , function (data) {

  $('#editModal').modal('show');
  $('#editId').val(data.id);
  $('#Egsm_number').val(data.gsm_number);                              // DIKASI D DI AWAL CUMA BUAT NGEBEDAIN ID NYA AJA, BIAR GA DOUBLE
  $('#Eserial_number').val(data.serial_number);
  $('#Ereceipt_date').val(data.receipt_date);
  $('#Eissue_date').val(data.issue_date);
  $('#Eissue_to').val(data.issue_to);
  $('#Eactivation_date_request').val(data.activation_date_request);
  $('#Eactivation_status').val(data.activation_status);
  $('#Eactive_date').val(data.active_date);
  $('#Etermination_date_request').val(data.termination_date_request);
  $('#Eterminated_date').val(data.terminated_date);
  $('#Etermination_remarks').val(data.termination_remarks);
  $('#Econdition').val(data.condition);
  $('#Efunctional_status').val(data.functional_status);
  $('#Evendor').val(data.vendor);
  $('#Eremarks').val(data.remarks);
 
  

})
});


  // ================== DETAIL ===================

  $('body').on('click', '.detailBtn', function () {

var id = $(this).data('id');

$.get("gsm-detail/"+id+"/", function (data) {

  $('#detailModal').modal('show');
  $('#Dgsm_number').html(data.gsm_number);                              // DIKASI D DI AWAL CUMA BUAT NGEBEDAIN ID NYA AJA, BIAR GA DOUBLE
  $('#Dserial_number').html(data.serial_number);
  $('#Dreceipt_date').html(data.receipt_date);
  $('#Dissue_date').html(data.issue_date);
  $('#Dissue_to').html(data.issue_to);
  $('#Dactivation_date_request').html(data.activation_date_request);
  $('#Dactivation_status').html(data.activation_status);
  $('#Dactive_date').html(data.active_date);
  $('#Dtermination_date_request').html(data.termination_date_request);
  $('#Dterminated_date').html(data.terminated_date);
  $('#Dtermination_remarks').html(data.termination_remarks);
  $('#Dcondition').html(data.condition);
  $('#Dfunctional_status').html(data.functional_status);
  $('#Dvendor').html(data.vendor);
  $('#Dremarks').html(data.remarks);
  $('#Dcreated_by').html(data.created_by);
  $('#Dcreated_at').html(data.created_at);
  $('#Dupdated_by').html(data.updated_by);
  $('#Dupdated_at').html(data.updated_at);
  




})
});

 // =============================  MULTI SELECT MODAL ISSUED ===========================================


  $('#option').change( function(){
          // console.log("asdasdasd");
        var jenis=$(this).val();
        $.ajax({
          url: '/gsm_number/'+jenis, 
          type: 'get',
          success: function (data) {
          console.log(data);
          var option = ` `;
            
            $.each(data.data, function(index,value){
                option += `<option value="`+value.id+`">`+value.gsm_number+`</option>`;
            });
          
          
          $("#gsm_number").html(option);

          
          $("#gsm_number").multi({
            enable_search: false
          }); 
          
            
        },
        error: function (data) {
          console.log('Error:', data);
        }

        })
        });

// ================================== multi select modal issued ================================
var select = document.getElementById("gsm_number_issued");
multi(select, {
  enable_search: false
});
// ================================== multi select modal actived ================================
var select = document.getElementById("gsm_number_actived");
multi(select, {
  enable_search: false
});

// ================================== multi select modal terminated ================================
var select = document.getElementById("gsm_number_terminated");
multi(select, {
  enable_search: false
});

// ================================== multi select modal terminated2 ================================
var select = document.getElementById("gsm_number_terminated2");
multi(select, {
  enable_search: false
});
// ================================== multi select modal update terminated2 ================================
var select = document.getElementById("updated_terminated");
multi(select, {
  enable_search: false
});

// ================================== multi select modal update actived ================================
var select = document.getElementById("update_actived");
multi(select, {
  enable_search: false
});

        
});
</script>
@endsection



