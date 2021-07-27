@extends ('layouts/tema')

@section('title','add customer')

@section('card_title','Add Customer')

@section('isi')



<div class="col-md-10 "><div class="x_panel">
								<div class="x_title">

                <div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
                  <form method="post" action="/store_customer" autocomplete="off">
                  @csrf
										<div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 label-align">Name</label>
											<div class="col-md-9 col-sm-9 ">
                      <input type="text" class="form-control" id="name" placeholder="input name" name="name" required>
                              @if ($errors->has('name'))
            
                                <span class="text-danger">{{ $errors->first('name') }}</span>
            
                            @endif											
                          </div>
										</div>
										
										<div class="form-group row">
											<label class="control-label col-md-3 col-sm-3 label-align">Short Name</label>
											<div class="col-md-9 col-sm-9 ">
                      <input type="text" class="form-control" id="sn" placeholder="input short name" name="sn" >

											</div>
										</div>

                    <div class="form-group row">
											<label class="control-label col-md-3 col-sm-3 label-align">Bussiness Type <a data-toggle="modal" data-target="#Modalbt" class="btn btn-warning btn-sm">+</a></label>
											<div class="col-md-9 col-sm-9 ">
                      <select name="bt" id="bt" class="form-control">
                              <option value="" >Choose business type</option>
                            @foreach ($bt as $bt)
                              <option value="{{$bt->business_type}}">{{$bt->business_type}}</option>
                            @endforeach
                  </select>
											</div>
										</div>

                    <div class="form-group row">
											<label class="control-label col-md-3 col-sm-3 label-align">Bussiness Conduct <a data-toggle="modal" data-target="#Modalbc" class="btn btn-warning btn-sm">+</a></label>
											<div class="col-md-9 col-sm-9 ">
                      <select name="bc" id="bc" class="form-control">
                              <option value="" >Choose business conduct</option>
                            @foreach ($bc as $bc)
                              <option value="{{$bc->business_conduct}}">{{$bc->business_conduct}}</option>
                            @endforeach
                  </select>
											</div>
                    </div>
                    
                    <div class="form-group row">
											<label class="control-label col-md-3 col-sm-3 label-align">NPWP</label>
											<div class="col-md-9 col-sm-9 ">
                      <input type="number" class="form-control" id="npwp" placeholder="input npwp" name="npwp" >
                  @if ($errors->has('npwp'))
 
                  <span class="text-danger">{{ $errors->first('npwp') }}</span>

                  @endif
											</div>
										</div>

                    <div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 label-align">Remarks</label>
											<div class="col-md-9 col-sm-9 ">
                      <input type="text" class="form-control" id="remarks" placeholder="input remarks" name="remarks" >
											</div>
										</div>

                    <div class="form-group row">
											<label class="control-label col-md-3 col-sm-3 label-align">Code Name</label>
											<div class="col-md-9 col-sm-9 ">
                      <input type="text" class="form-control" id="code_name" placeholder="input code name" name="code_name" >

											</div>
										</div>
									


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
