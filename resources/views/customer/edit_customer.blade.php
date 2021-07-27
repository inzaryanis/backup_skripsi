@extends ('layouts/admin')

@section('title','edit customer')

@section('card_title','Edit Customer')

@section('isi')


        <div class="card-body">
        <form method="post" action="/update_customer/{{$customer->id}}" autocomplete="off">
	          @csrf
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name"  name="name" value="{{$customer['name']}}">
                  @if ($errors->has('name'))
 
                    <span class="text-danger">{{ $errors->first('name') }}</span>
 
                @endif
                </div>
                <div class="form-group">
                  <label for="sn">Short Name</label>
                  <input type="text" class="form-control" id="sn" name="sn" value="{{$customer['short_name']}}">
                </div>
                <div>
                  <label for="bt">Business Type</label>  
                  <!-- Button to Open the Modal -->
                  <a data-toggle="modal" data-target="#Modalbt"><img src="{{asset('admin/assets/img/add.png')}}" width="10" height="10" ></i></a>
                 <select name="bt" class="form-control">
                              <option value="" >Choose business type</option>
                              @foreach ($bt as $bt)
                                @if ($bt->id==$customer->id_business_type)
                                <option value="{{$bt->id}}" selected='selected'>{{$bt->business_type}}</option>
                                @else
                                <option value="{{$bt->id}}">{{$bt->business_type}}</option>
                                @endif
                            @endforeach
                  </select>
                </div> <br>
                
                <div>
                  <label for="bc">Business conduct</label>  
                  <!-- Button to Open the Modal -->
                  <a data-toggle="modal" data-target="#Modalbc"><img src="{{asset('admin/assets/img/add.png')}}" width="10" height="10" ></i></a>
                 <select name="bc" class="form-control">
                              <option value="" >Choose business conduct</option>
                              @foreach ($bc as $bc)
                                @if ($bc->id==$customer->id_business_conduct)
                                <option value="{{$bc->id}}" selected='selected'>{{$bc->business_conduct}}</option>
                                @else
                                <option value="{{$bc->id}}">{{$bc->business_conduct}}</option>
                                @endif
                            @endforeach
                  </select>
                </div> <br>
                
                <div class="form-group">
                  <label for="npwp">Npwp</label>
                  <input type="text" class="form-control" id="npwp"  name="npwp" value="{{$customer['npwp']}}" >
                  @if ($errors->has('npwp'))
 
                    <span class="text-danger">{{ $errors->first('npwp') }}</span>
 
                @endif
                </div> <br>

                <div class="form-group">
                  <label for="remarks">Remarks</label>
                  <input type="text" class="form-control" id="remarks"  name="remarks" value="{{$customer['remarks']}}">
                </div> <br>

                <div class="form-group">
                    <label for="ai">Active Ind</label><br>
                    <input type="radio" name="ai" value="Y"  {{$customer->active_ind == 'Y'? 'checked' : ''}}> Yes<br>
                    <input type="radio" name="ai" value="N"  {{$customer->active_ind == 'N'? 'checked' : ''}}> No<br>
                </div>
               
                <div>
                  <label for="control_by">Control By</label>  
                  <!-- Button to Open the Modal -->
                  <a data-toggle="modal" data-target="#Modalcontrol_by"><img src="{{asset('admin/assets/img/add.png')}}" width="10" height="10" ></i></a>
                 <select name="control_by" class="form-control">
                              <option value="IU" >Integrasia Utama</option>
                              <option value="SISI" >SISI</option>
                              <option value="AGIT" >AGIT</option>
                              
                  </select>
                </div> <br>

                <!-- <div>
                  <label for="cb">Control By</label> 
                <a data-toggle="modal" data-target="#Modalcb"><img src="{{asset('admin/assets/img/add.png')}}" width="10" height="10" ></i></a>

                    <select name="cb" class="form-control">
                          <option value="">Choose control by</option>
                              <option value="IU">IU</option>
                              <option value="SISI">SISI</option>
                              <option value="AGIT">AGIT</option>
                  </select>
                </div> <br> -->

                <button type="submit" class="btn btn-info btn-xs "> Save</button>
              </form>
                  </div>
                </div>
              </div>
            </div>
            </div>
          </div>
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
