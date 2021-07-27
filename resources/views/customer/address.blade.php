@extends ('layouts/tema')

@section('title','address')

@section('card_title','address')

@section('isi')

<a href="/create_address" class="btn btn-success">Add address</a>
<a style="color:#fff;" data-toggle="modal" data-target="#importExcel"  class="btn btn-success"> Import</a>

                  <div class="table-responsive">
                  <table id="table_address"class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col">Customer Name </th>
                          <!-- <th scope="col">Office Type</th> -->
                          <th scope="col">Address Text</th>
                          <!-- <th scope="col">First Address Line</th> -->
                          <!-- <th scope="col">Second Address Line</th> -->
                          <!-- <th scope="col">Third Address Line</th> -->
                          <!-- <th scope="col">City Area</th> -->
                          <!-- <th scope="col">Postal Zip Code</th> -->
                          <!-- <th scope="col">Country Area</th> -->
                          <!-- <th scope="col">Active Ind</th> -->
                          <th scope="col">action</th>
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

table = $('#table_address').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{{url("/customer_address/getdata")}}',
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
              data: 'address_text',
              name: 'address_text'
          },
          {
              data: 'action',
              name: 'action'
          },
      ]
  });

    // ================== DETAIL ===================

    $('body').on('click', '.detailBtn', function () {

var id = $(this).data('id');

$.get("address-detail/"+id+"/", function (data) {

  $('#detailModal').modal('show');
  $('#Dcustomer').html(data.customer);                              // DIKASI D DI AWAL CUMA BUAT NGEBEDAIN ID NYA AJA, BIAR GA DOUBLE
  $('#Did_office_type').html(data.id_office_type);
  $('#Daddress_text').html(data.address_text);
  $('#Dfirst_address_line').html(data.first_address_line);
  $('#Dsecond_address_line').html(data.second_address_line);
  $('#Dthird_address_line').html(data.third_address_line);
  $('#Dcity_area').html(data.city_area);
  $('#Dpostal_zip_code').html(data.postal_zip_code);
  $('#Dcountry_area').html(data.country_area);
  $('#Dactive_ind').html(data.active_ind);
  $('#Dcreated_by').html(data.created_by);
  $('#Dcreated_at').html(data.created_at);
  $('#Dupdated_by').html(data.updated_by);
  $('#Dupdated_at').html(data.updated_at);
  




})
});

  // =============== EDIT =========================
$('#formEdit').on("submit", function (e) {

e.preventDefault();

$('#editSubmit').html('Mengedit..');

var formData = new FormData(this);

$.ajax({

  data: formData,

  url: "{{route('address.update')}}",

  type: "POST",

  processData: false,

  contentType: false,

  success: function (data) {

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

$.get("/edit/address" +'/' + id , function (data) {

  $('#editModal').modal('show');
  // mengisi value berdasarkan id
  $('#id_customer').val(data.id_customer);
  // $('#name').val(data.name);
  // console.log(data.name);

  // otomatis select berdasarkan value
  $("#customer").val(data.customer_id);
  $('#editId').val(data.id);
  console.log(data.id);

  // console.log(data.ot_id);
  $('#address_text').val(data.address_text);
  $('#office_type').val(data.office_type);
  $('#first_address_line').val(data.first_address_line);
  $('#second_address_line').html(data.second_address_line);
  $('#third_address_line').val(data.third_address_line);
  $('#city_area').val(data.city_area);
  $('#postal_zip_code').val(data.postal_zip_code);
  $('#country_area').val(data.country_area);
  $('input:radio[name=active_ind]').val([data.active_ind]);
  

  

})
});


// ================== HAPUS ===================

$('body').on('click', '.hapusBtn', function () {

var id = $(this).data("id");    // Harus Data pakenya

confirm("Are You sure want to delete !");

$.ajax({

  type: "DELETE",

  url: '/delete/customer_address/'+id,
  

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
				<form method="post" action="/address/import" enctype="multipart/form-data">
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

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editHeader" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editHeader">Edit Customer Address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="formEdit">
      <input type="hidden" id="editId" name="id"></input>
      {{csrf_field()}}
        @method('POST')
                  <div>
                  <label for="customer">Customer</label>  
                 <select id="customer" name="customer" class="form-control" required>
                              <option value="" >Choose Customer</option>
                            @foreach ($customer as $customer)
                              <option value="{{$customer->id}}" >{{$customer->name}}</option>
                            @endforeach
                  </select>
                </div> <br>
                <div>
                  <label for="ot">Office Type</label> 
                  <!-- Button to Open the Modal -->
                <a data-toggle="modal" data-target="#Modalot"><img src="{{asset('admin/assets/img/add.png')}}" width="10" height="10" ></i></a>

                    <select id="ot" name="ot" class="form-control" >
                          <option value="">Choose Office Type</option>
                          @foreach ($ot as $ot)
                              <option value="{{$ot->id}}" >{{$ot->office_type}}</option>
                            @endforeach
                            
                  </select>
                </div> <br>
                
                <div class="form-group">
                  <label for="address_text">address Text</label>
                  <textarea type="text" class="form-control" id="address_text" placeholder="input address text" name="address_text" ></textarea>
                </div> <br>

                <div class="form-group">
                  <label for="first_address_line">first address line</label>
                  <input type="text" class="form-control" id="first_address_line" placeholder="input first address line" name="first_address_line" >
                </div> <br>

                <div class="form-group">
                  <label for="second_address_line">second address line</label>
                  <input type="text" class="form-control" id="second_address_line" placeholder="input second address line" name="second_address_line" >
                </div> <br>

                <div class="form-group">
                  <label for="third_address_line">third address line</label>
                  <input type="text" class="form-control" id="third_address_line" placeholder="input third address line" name="third_address_line" >
                </div> <br>

                <div class="form-group">
                  <label for="city_area">city area</label>
                  <input type="text" class="form-control" id="city_area" placeholder="input city area" name="city_area" >
                </div> <br>

                <div class="form-group">
                  <label for="postal_zip_code">postal zip code</label>
                  <input type="text" class="form-control" id="postal_zip_code" placeholder="input postal zip code" name="postal_zip_code" >
                </div> <br>

                <div class="form-group">
                  <label for="country_area">country area</label>
                  <input type="text" class="form-control" id="country_area" placeholder="input country area" name="country_area" >
                </div> <br>

                <div class="form-group">
                    <label for="active_ind">Active Ind</label><br>
                    <input type="radio" name="active_ind" value="Y"  > Yes<br>
                    <input type="radio" name="active_ind" value="N"  > No<br>
                </div>
                

                <button class="mt-2 btn btn-primary" id="editSubmit">Edit</button><br>
                </form>
    </div>
  </div>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="Modalot" >
    <div class="modal-dialog" >
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" >Add Office Type</h5>
              <button type="button" class="close" data-dismiss="modal" >
                &times;
              </button>
              </div>
              <div class="modal-body">
              <form action="/store_bt" method="POST">
              @csrf
                <div class="form-group">
                  <input name="bt" type="text" class="form-control" id="exampleInputEmail1">
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
 <!-- Detail Modal -->
 <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailHeader" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="max-width: 55%;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailHeader">Detail Customer Address</h5>
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
              <td align="right"><b><b>Customer  :</b></td>
              <td  id="Dcustomer"></td>
              </tr>

              <tr>
              <td align="right"><b>Office Type  :</b></td>
              <td id="Did_office_type"></td>
              </tr>

              <tr>
              <td align="right"><b>Address Text  :</b></td>
              <td id="Daddress_text"></td>
              </tr>

              <tr>
              <td align="right"><b>First Address Line  :</b></td>
              <td id="Dfirst_address_line"></td>
              </tr>

              <tr>
              <td align="right"><b>Second Address Line  :</b></td>
              <td id="Dsecond_address_line"></td>
              </tr>


              <tr>
              <td align="right"><b>Third Address Line  :</b></td>
              <td id="Dthird_address_line"></td>
              </tr>

              <tr>
              <td align="right"><b>City Area  :</b></td>
              <td id="Dcity_area"></td>
              </tr>

              <tr>
              <td align="right"><b>Postal Zip Code  :</b></td>
              <td id="Dpostal_zip_code"></td>
              </tr>

              <tr>
              <td align="right"><b>Country Area  :</b></td>
              <td id="Dcountry_area"></td>
              </tr>

              <tr>
              <td align="right"><b>Active Ind  :</b></td>
              <td id="Dactive_ind"></td>
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
     
    </div>
  </div>
</div>


 
@endsection

