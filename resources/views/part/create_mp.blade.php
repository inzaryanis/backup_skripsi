@extends ('layouts/tema')

@section('title','part')

@section('card_title','Add Part')

@section('isi')


<div class="col-md-10 "><div class="x_panel">
								<div class="x_title">

                <div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
                  <form method="post" action="/store_mp" autocomplete="off" class="form-horizontal form-label-left">
                  @csrf

										<div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 label-align">Part</label>
											<div class="col-md-9 col-sm-9 ">
												<input name="part" type="text" class="form-control" placeholder=" Input Part" required>
											</div>
										</div>
										
										<div class="form-group row">
											<label class="control-label col-md-3 col-sm-3 label-align">Series <a data-toggle="modal" data-target="#Modalseries" class="btn btn-warning btn-sm">+</a>
                      </label>
											<div class="col-md-9 col-sm-9 ">
												<select name="series" class="form-control">
													<option value="">Choose Series </option>
                          @foreach ($series as $series)
                              <option value="{{$series->series}}">{{$series->series}}</option>
                            @endforeach
												</select>
											</div>
										</div>

                    <div class="form-group row">
											<label class="control-label col-md-3 col-sm-3 label-align">Type <a data-toggle="modal" data-target="#Modaltype" class="btn btn-warning btn-sm">+</a></label>
											<div class="col-md-9 col-sm-9 ">
												<select name="type" class="form-control">
													<option value="">Choose Type</option>
                          @foreach ($type as $type)
                              <option value="{{$type->type}}">{{$type->type}}</option>
                            @endforeach
												</select>
											</div>
										</div>

                    <div class="form-group row">
											<label class="control-label col-md-3 col-sm-3 label-align">Brand <a data-toggle="modal" data-target="#Modalbrand" class="btn btn-warning btn-sm">+</a></label>
											<div class="col-md-9 col-sm-9 ">
												<select name="merk"  class="form-control">
													<option value="">Choose Brand</option>
                          @foreach ($merk as $merk)
                              <option value="{{$merk->merk}}">{{$merk->merk}}</option>
                            @endforeach
												</select>
											</div>
										</div>

                    <div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 label-align" >Uom</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="text" name="uom"  class="form-control" placeholder="Input Uom" required>
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
 <div class="modal fade" id="Modaltype" >
    <div class="modal-dialog" >
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" >Add Type</h5>
              <button type="button" class="close" data-dismiss="modal" >
                &times;
              </button>
              </div>
              <div class="modal-body">
              <form action="/store_type" method="POST" autocomplete="off">
              @csrf
                <div class="form-group">
                  <input name="type" type="text" class="form-control" id="exampleInputEmail1">
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
 <div class="modal fade" id="Modalbrand" >
    <div class="modal-dialog" >
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" >Add Brand</h5>
              <button type="button" class="close" data-dismiss="modal" >&times;</button>
              </div>
              <div class="modal-body">
              <form action="/store_brand" method="POST" autocomplete="off">
              @csrf
                <div class="form-group">
                  <input name="merk" type="text" class="form-control" id="exampleInputEmail1">
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
              <form action="/store_series" method="POST" autocomplete="off">
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
