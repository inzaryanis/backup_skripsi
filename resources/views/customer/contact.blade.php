@extends ('layouts/tema')

@section('title','contact')

@section('card_title','contact')

@section('isi')

<a href="/create_contact" class="btn btn-success">Add contact</a>
                  <div class="table-responsive">
                  <table id="table_contact" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                        <th scope="col">No</th>
                          <th scope="col">Customer Name </th>
                          <th scope="col">Address</th>
                          <th scope="col">contact</th>
                          <th scope="col">Person Name</th>
                          <!-- <th scope="col">Religion</th>
                          <th scope="col">Gender</th>
                          <th scope="col">Birth Date</th>
                          <th scope="col">Phone Mobile</th>
                          <th scope="col">Phone Fixed</th>
                          <th scope="col">Email</th>
                          <th scope="col">Active Ind</th> -->
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

table = $('#table_contact').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{{url("/contact/getdata")}}',
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
              data: 'customer_address.address_text',
              name: 'customer_address.address_text'
          },
          {
              data: 'contact_type',  
              name: 'contact_type'
          },
          {
              data: 'person_name',
              name: 'person_name'
          },
          // {
          //     data: 'religion',
          //     name: 'religion'
          // },
          // {
          //     data: 'gender',
          //     name: 'gender'
          // },
          // {
          //     data: 'birth_date',
          //     name: 'birth_date'
          // },
          // {
          //     data: 'phone_mobile',
          //     name: 'phone_mobile'
          // },
          // {
          //     data: 'phone_fixed',
          //     name: 'phone_fixed'
          // },
          // {
          //     data: 'email_address',
          //     name: 'email_address'
          // },
          // {
          //     data: 'active_ind',
          //     name: 'active_ind'
          // },
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

  url: "{{route('contact.update')}}",

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

$.get("/edit/contact" +'/' + id , function (data) {

  var option = '';
	$.each(data.address, function(index,value){
		option += '<option value="'+value.id+'">'+value.address_text+'</option>';
	});          
  $("#ca").html(option);

  $('#editModal').modal('show');
  // mengisi value berdasarkan id
  $('#id_customer').val(data.id_customer);
  
  $("#customer").val(data.customer_id);
  $('#editId').val(data.id);
  console.log(data.id);

  $('#ca').val(data.id_customer_address);
  $('#contact_type').val(data.contact_type);
  $('#person_name').val(data.person_name);
  $('#religion').val(data.religion);
  $('input:radio[name=gender]').val([data.gender]);
  $('#birth_date').val(data.birth_date);
  $('#phone_mobile').val(data.phone_mobile);
  $('#phone_fixed').val(data.phone_fixed);
  $('#email_address').val(data.email_address);
  $('input:radio[name=active_ind]').val([data.active_ind]);

})
});

// =================== address berdasarka pilihan customer ============================================

$('#customer').change(function(){
             var id = $(this).val();
             $.ajax({
                 url: '/address_contact/'+id, 
                   type: 'get',
                  success: function (data) {
                     console.log(data);
                     var option = ``;
                     $.each(data.data, function(index,value){
                     $('#ca').append(`<option value="`+value.id+`">`+value.address_text+`</option>`)
                    // $("#ca").val(data.data.address_text);
                  });
                    },
                });
          });


// ================== DETAIL ===================

$('body').on('click', '.detailBtn', function () {

var id = $(this).data('id');

$.get("contact-detail/"+id+"/", function (data) {


  $("#customer").val(data.customer_id);
  $('#editId').val(data.id);
  console.log(data.id);
  
  $('#detailModal').modal('show');
  $('#Dcustomer').html(data.customer);
  $('#Dcustomer_address').html(data.customer_address);
  $('#Dperson_name').html(data.person_name);
  $('#Dreligion').html(data.religion);
  $('#Dgender').html(data.gender);
  $('#Dbirth_date').html(data.birth_date);
  $('#Dphone_mobile').html(data.phone_mobile);
  $('#Dphone_fixed').html(data.phone_fixed);
  $('#Demail_address').html(data.email_address);
  $('#Dphone_number').html(data.phone_number);
  $('#Dactive_ind').html(data.active_ind);
  $('#Dcreated_at').html(data.created_at);
  $('#Dcreated_by').html(data.created_by);
  $('#Dupdated_at').html(data.updated_at);
  $('#Dupdated_by').html(data.updated_by);
  
})
});

// ================== HAPUS ===================

$('body').on('click', '.hapusBtn', function () {

var id = $(this).data("id");    // Harus Data pakenya

confirm("Are You sure want to delete !");

$.ajax({

  type: "DELETE",

  url: '/delete/contact/'+id,

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

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editHeader" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editHeader">Edit Customer Contact</h5>
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

                <div class="form-group">
                  <label for="customer_address">Customer Address</label>
                  <select id="ca" name="ca" class="form-control" required>
                  <!-- @foreach ($ca as $ca)
                              <option value="{{$ca->id}}" >{{$ca->address_text}}</option>
                            @endforeach -->
                          </select>
                </div><br>
                <div>
                  <label for="ot">Contact Type</label> 
                  <!-- Button to Open the Modal -->
                <a data-toggle="modal" data-target="#Modalot"><img src="{{asset('admin/assets/img/add.png')}}" width="10" height="10" ></i></a>

                    <select id="contact_type" name="contact_type" class="form-control" >
                          <option value="">Choose Contact Type</option>
                          @foreach ($contact_type as $contact_type)
                              <option value="{{$contact_type->contact_type}}" >{{$contact_type->contact_type}}</option>
                            @endforeach
                            
                  </select>
                </div> <br>
                
                <div class="form-group">
                  <label for="person_name">Person Name</label>
                  <input type="text" class="form-control" id="person_name" placeholder="input person name" name="person_name" >
                </div> <br>

                <div>
                  <label >Religion</label> 
                    <select id="religion" name="religion" class="form-control" >
                          <option value="">Choose Religion</option>
                          @foreach ($religion as $religion)
                              <option value="{{$religion->religion}}" >{{$religion->religion}}</option>
                            @endforeach
                            
                  </select>
                </div> <br>

               

                <div class="form-group">
                  <label for="gender">Gender  :</label><br>
                  <input type="radio" name="gender" value="P" required>Perempuan<br><br>
                  <input type="radio" name="gender" value="L" required>Laki-Laki<br><br>                
                  </div> <br>

                <div class="form-group">
                  <label for="birth_date">Birth Date</label>
                  <input type="date" class="form-control" id="birth_date"  name="birth_date" >
                </div> <br>

                <div class="form-group">
                  <label for="phone_mobile">Phone Mobile</label>
                  <input type="text" class="form-control" id="phone_mobile" placeholder="input phone mobile" name="phone_mobile" >
                </div> <br>

                <div class="form-group">
                  <label for="phone_fixed">Phone Fixed</label>
                  <input type="text" class="form-control" id="phone_fixed" placeholder="input phone fixed" name="phone_fixed" >
                </div> <br>

                <div class="form-group">
                  <label for="email_address">email_address</label>
                  <input type="text" class="form-control" id="email_address" placeholder="input email address" name="email_address" >
                </div> <br>

                <div class="form-group">
                    <label for="active_ind">Active Ind</label><br>
                    <input type="radio" name="active_ind" value="Y" > Yes<br>
                    <input type="radio" name="active_ind" value="N" > No<br>
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
        <h5 class="modal-title" id="detailHeader">Detail Customer Contact</h5>
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
              <td align="right"><b>Customer Address  :</b></td>
              <td id="Dcustomer_address"></td>
              </tr>

              <tr>
              <td align="right"><b>Person Name  :</b></td>
              <td id="Dperson_name"></td>
              </tr>

              <tr>
              <td align="right"><b>Religion  :</b></td>
              <td id="Dreligion"></td>
              </tr>

              <tr>
              <td align="right"><b>Gender  :</b></td>
              <td id="Dgender"></td>
              </tr>


              <tr>
              <td align="right"><b>Birth Date  :</b></td>
              <td id="Dbirth_date"></td>
              </tr>

              <tr>
              <td align="right"><b>Phone Mobile  :</b></td>
              <td id="Dphone_mobile"></td>
              </tr>

              <tr>
              <td align="right"><b>Phone Fixed  :</b></td>
              <td id="Dphone_fixed"></td>
              </tr>

              <tr>
              <td align="right"><b>Email Address  :</b></td>
              <td id="Demail_address"></td>
              </tr>

              <tr>
              <td align="right"><b>Active Ind  :</b></td>
              <td id="Dactive_ind"></td>
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

