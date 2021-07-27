@extends ('layouts/tema')

@section('title','add address')

@section('card_title','Add address')

@section('isi')


<div class="col-md-10 "><div class="x_panel">
								<div class="x_title">

                <div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
        <form method="post" action="/store_address" autocomplete="off">
	          @csrf
              <div class="form-group row ">
                  <label for="customer"  class="control-label col-md-3 col-sm-3 label-align">Customer</label>
                  <div class="col-md-9 col-sm-9 ">  
                 <select name="customer" class="form-control" required>
                              <option value="" >Choose Customer</option>
                            @foreach ($customer as $customer)
                              <option value="{{$customer->id}}">{{$customer->id."-.".$customer->name}}</option>
                            @endforeach
                  </select>
                </div></div>
                <div class="form-group row ">
                  <label for="ot"  class="control-label col-md-3 col-sm-3 label-align">Office Type <a data-toggle="modal" data-target="#Modalot" class="btn btn-warning btn-sm">+</a></label>
                  <div class="col-md-9 col-sm-9 ">
               

                    <select name="ot" class="form-control" >
                          <option value="">Choose Office Type</option>
                            @foreach ($ot as $ot)
                              <option value="{{$ot->office_type}}">{{$ot->office_type}}</option>
                            @endforeach
                  </select>
                </div></div>
                
                <div class="form-group row">
                  <label for="address_text"  class="control-label col-md-3 col-sm-3 label-align">address Text</label>
                  <div class="col-md-9 col-sm-9 ">
                  <input type="text" class="form-control" id="address_text" placeholder="example Jl. Raya Narogong Km 11, RT.003/RW.005, Bantargebang, Kota Bks, Jawa Barat 17151" name="address_text" >
                </div></div>

                <div class="form-group row">
                  <label for="first_address_line"  class="control-label col-md-3 col-sm-3 label-align">first address line</label>
                  <div class="col-md-9 col-sm-9 ">
                  <input type="text" class="form-control" id="first_address_line" placeholder="example Jl. Raya Narogong Km 11" name="first_address_line" >
                </div></div>

                <div class="form-group row">
                  <label for="second_address_line"  class="control-label col-md-3 col-sm-3 label-align">second address line</label>
                  <div class="col-md-9 col-sm-9 ">
                  <input type="text" class="form-control" id="second_address_line" placeholder="example RT.003/RW.005" name="second_address_line" >
                </div></div>

                <div class="form-group row">
                  <label for="third_address_line"  class="control-label col-md-3 col-sm-3 label-align">third address line</label>
                  <div class="col-md-9 col-sm-9 ">
                  <input type="text" class="form-control" id="third_address_line" placeholder="example Bantargebang" name="third_address_line" >
                </div></div>

                <div class="form-group row">
                  <label for="city_area"  class="control-label col-md-3 col-sm-3 label-align">city area</label>
                  <div class="col-md-9 col-sm-9 ">
                  <input type="text" class="form-control" id="city_area" placeholder="example Bekasi" name="city_area" >
                </div></div>

                <div class="form-group row">
                  <label for="postal_zip_code"  class="control-label col-md-3 col-sm-3 label-align">postal zip code</label>
                  <div class="col-md-9 col-sm-9 ">
                  <input type="text" class="form-control" id="postal_zip_code" placeholder="input postal zip code" name="postal_zip_code" >
                </div></div>

                <div class="form-group row">
                  <label for="country_area"  class="control-label col-md-3 col-sm-3 label-align">country area</label>
                  <div class="col-md-9 col-sm-9 ">
                  <input type="text" class="form-control" id="country_area" placeholder="input country area" name="country_area" >
                </div></div>

                

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
 






 


 <!-- Modal -->
 <div class="modal fade" id="Modalbt" >
    <div class="modal-dialog" >
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" >Add Business Type</h5>
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
