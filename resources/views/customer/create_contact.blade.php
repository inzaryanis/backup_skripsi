@extends ('layouts/tema')

@section('title','add contact')

@section('card_title','Add contact')

@section('isi')


<div class="col-md-10 "><div class="x_panel">
								<div class="x_title">

                <div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
        <form method="post" action="/store_contact" autocomplete="off">
	          @csrf
              <div class="form-group row">
                  <label class="control-label col-md-3 col-sm-3 label-align" for="customer">Customer</label> 
                  <div class="col-md-9 col-sm-9 "> 
                 <select id="customer" name="customer" class="form-control" required>
                              <option value="" >Choose Customer</option>
                            @foreach ($customer as $customer)
                              <option value="{{$customer->id}}">{{$customer->name}}</option>
                            @endforeach
                  </select>
                </div> </div>
                <div class="form-group row">
                  <label class="control-label col-md-3 col-sm-3 label-align" for="ca">Customer Address</label> 
                <div class="col-md-9 col-sm-9 ">
                <!-- <input type="text" class="form-control" id="ca"  name="ca" > -->
                    <select id="ca" name="ca" class="form-control" required>
                          
                  </select>
                </div> </div>

                <div class="form-group row">
                  <label class="control-label col-md-3 col-sm-3 label-align" for="ct">Contact Type <a data-toggle="modal" data-target="#Modalct" class="btn btn-warning btn-sm">+</a></label> 
                <div class="col-md-9 col-sm-9 ">
                    <select name="ct" class="form-control" >
                          <option value="">Choose Contact Type</option>
                            @foreach ($ct as $ct)
                              <option value="{{$ct->contact_type}}">{{$ct->contact_type}}</option>
                            @endforeach
                  </select>
                </div> </div>
                
                <div class="form-group row">
                  <label class="control-label col-md-3 col-sm-3 label-align" for="person_name">Person Name</label>
                  <div class="col-md-9 col-sm-9 ">
                  <input type="text" class="form-control" id="person_name" placeholder="input address text" name="person_name" required>
                </div> </div>

                <div class="form-group row">
                  <label class="control-label col-md-3 col-sm-3 label-align" for="religion">Religion</label> 
                <div class="col-md-9 col-sm-9 ">
                    <select name="religion" class="form-control" >
                          <option value="">Choose Religion</option>
                            @foreach ($religion as $religion)
                              <option value="{{$religion->religion}}">{{$religion->religion}}</option>
                            @endforeach
                  </select>
                </div> </div><br>
                
                <div class="form-group row">
                  <label class="control-label col-md-3 col-sm-3 label-align" for="gender">Gender</label>
                  <div class="col-md-9 col-sm-9 ">
                  <input type="radio" name="gender" value="P" required>Perempuan<br><br>
                  <input type="radio" name="gender" value="L" required>Laki-Laki<br><br>
                </div> </div>

                <div class="form-group row">
                  <label class="control-label col-md-3 col-sm-3 label-align" for="birth_date">Birth Date</label>
                  <div class="col-md-9 col-sm-9 ">
                  <input type="date" class="form-control" id="birth_date" placeholder="input birth date" name="birth_date" >
                </div> </div>

                <div class="form-group row">
                  <label class="control-label col-md-3 col-sm-3 label-align" for="phone_mobile">Phone Mobile</label>
                  <div class="col-md-9 col-sm-9 ">
                  <input type="text" class="form-control" id="phone_mobile" placeholder="input phone mobile" name="phone_mobile" >
                </div> </div>

                <div class="form-group row">
                  <label class="control-label col-md-3 col-sm-3 label-align" for="phone_fixed">Phone Fixed</label>
                  <div class="col-md-9 col-sm-9 ">
                  <input type="text" class="form-control" id="phone_fixed" placeholder="input phone fixed" name="phone_fixed" >
                </div> </div>

                <div class="form-group row">
                  <label class="control-label col-md-3 col-sm-3 label-align" for="email">Emaill</label>
                  <div class="col-md-9 col-sm-9 ">
                  <input type="text" class="form-control" id="email" placeholder="input Emaill" name="email" >
                </div> </div>

                

                <div class="ln_solid"></div>
										<div class="form-group">
											<div class="col-md-9 col-sm-9  offset-md-3">
												<button type="submit" class="btn btn-success">Save</button>
											</div>
										</div>

									</form>
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


 

         
});
</script>
@endsection
 

@section("modal")
 <!-- Modal -->
 <div class="modal fade" id="Modalct" >
    <div class="modal-dialog" >
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" >Add Contact Type</h5>
              <button type="button" class="close" data-dismiss="modal" >
                &times;
              </button>
              </div>
              <div class="modal-body">
              <form action="/store_ct" method="POST">
              @csrf
                <div class="form-group row">
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
                  <input name="bc" type="text" class="form-control" id="exampleInputEmail1">
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


        <!-- Modal SERIES -->
 <div class="modal fade" id="Modalseries" >
    <div class="modal-dialog" >
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" >Add Series</h5>
              <button type="button" class="close" data-dismiss="modal" >&times;</button>
              </div>
              <div class="modal-body">
              <form action="/store_series" method="POST">
              @csrf
                <div class="form-group">
                  <input name="series" type="text" class="form-control" id="exampleInputEmail1">
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
