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
                 <form m method="POST" action="/update/part/{{$part->id}}" autocomplete="off" class="form-horizontal form-label-left">
                 @method('patch')
                 @csrf

										<div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 label-align">Part</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="text" class="form-control" placeholder=" Input Part"  value="{{$part['part']}}">
											</div>
										</div>
										
										<div class="form-group row">
											<label class="control-label col-md-3 col-sm-3 label-align">Series <a data-toggle="modal" data-target="#Modalseries" class="btn btn-warning btn-sm">+</a>
                     					    </label>
											<div class="col-md-9 col-sm-9 ">
												<select name="series" class="form-control">
												@if ($part->series!==null)
												<option selected='selected'>{{$part->series}}</option>
												@foreach ($series as $series)
												<option value="{{$series->series}}" >{{$series->series}}</option>
												@endforeach
												
												@else
												<option>Choose Brand</option>
												@foreach ($series as $series)
												<option value="{{$series->series}}" >{{$series->series}}</option>
												@endforeach

												@endif
												</select>
											</div>
										</div>

                    <div class="form-group row">
											<label class="control-label col-md-3 col-sm-3 label-align">Type <a data-toggle="modal" data-target="#Modaltype" class="btn btn-warning btn-sm">+</a></label>
											<div class="col-md-9 col-sm-9 ">
												<select name="type" class="form-control">
												@if ($part->type!==null)
												<option selected='selected'>{{$part->type}}</option>
												@foreach ($type1 as $type)
												<option value="{{$type->type}}" >{{$type->type}}</option>
												@endforeach
												
												@else
												<option>Choose Type</option>
												@foreach ($type as $type)
												<option value="{{$type->type}}" >{{$type->type}}</option>
												@endforeach

												@endif
														
												</select>
											</div>
										</div>

                    <div class="form-group row">
											<label class="control-label col-md-3 col-sm-3 label-align">Brand <a data-toggle="modal" data-target="#Modalbrand" class="btn btn-warning btn-sm">+</a></label>
											<div class="col-md-9 col-sm-9 ">
												<select name="merk"  class="form-control">
												@if ($part->merk!==null)
												<option selected='selected'>{{$part->merk}}</option>
												@foreach ($merk1 as $merk)
												<option value="{{$merk->merk}}" >{{$merk->merk}}</option>
												@endforeach
												
												@else
												<option>Choose Brand</option>
												@foreach ($merk as $merk)
												<option value="{{$merk->merk}}" >{{$merk->merk}}</option>
												@endforeach

												@endif
												</select>
											</div>
										</div>

                    <div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 label-align">Uom</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="text" name="uom"  class="form-control" placeholder="Input Uom"  value="{{$part['uom']}}">
											</div>
										</div>
									
                    <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 label-align" for="sc">Serialized Code</label><br>
                    <div class="col-md-9 col-sm-9 ">
                    <input type="radio" name="sc" value="Y"  {{$part->serialized_code == 'Y'? 'checked' : ''}}> Yes<br>
                    <input type="radio" name="sc" value="N"  {{$part->serialized_code == 'N'? 'checked' : ''}}> No<br>
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

   


			
@endsection