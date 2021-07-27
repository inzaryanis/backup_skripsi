@extends ('layouts/admin')

@section('title','edit address')

@section('card_title','Edit address')

@section('isi')


        <div class="card-body">
        <form method="post" action="/update_address/{{$address->id}}" autocomplete="off">
	          @csrf
              <div>
                  <label for="customer">Customer</label>  
                 <select name="customer" class="form-control" required>
                              <option value="" >Choose Customer</option>
                            @foreach ($customer as $customer)
                                 @if ($customer->id==$address->id_customer)
                              <option value="{{$customer->id}}" selected='selected'>{{$customer->name}}</option>
                              @else
                                <option value="{{$customer->id}}">{{$customer->name}}</option>
                                @endif
                            @endforeach
                  </select>
                </div> <br>
                <div>
                  <label for="ot">Office Type</label> 
                  <!-- Button to Open the Modal -->
                <a data-toggle="modal" data-target="#Modalot"><img src="{{asset('admin/assets/img/add.png')}}" width="10" height="10" ></i></a>

                    <select name="ot" class="form-control" required>
                          <option value="">Choose Office Type</option>
                            @foreach ($ot as $ot)
                                    @if ($ot->id==$address->id_office_type)
                              <option value="{{$ot->id}}" selected='selected'>{{$ot->office_type}}</option>
                              @else
                                <option value="{{$ot->id}}">{{$ot->office_type}}</option>
                                @endif
                            @endforeach
                  </select>
                </div> <br>
                
                <div class="form-group">
                  <label for="address_text">address Text</label>
                  <input type="text" class="form-control" id="address_text" placeholder="input address text" name="address_text" value="{{$address['address_text']}}">
                </div> <br>

                <div class="form-group">
                  <label for="first_address_line">first address line</label>
                  <input type="text" class="form-control" id="first_address_line" placeholder="input first address line" name="first_address_line" value="{{$address['first_address_line']}}">
                </div> <br>

                <div class="form-group">
                  <label for="second_address_line">second address line</label>
                  <input type="text" class="form-control" id="second_address_line" placeholder="input second address line" name="second_address_line" value="{{$address['second_address_line']}}">
                </div> <br>

                <div class="form-group">
                  <label for="third_address_line">third address line</label>
                  <input type="text" class="form-control" id="third_address_line" placeholder="input third address line" name="third_address_line" value="{{$address['third_address_line']}}">
                </div> <br>

                <div class="form-group">
                  <label for="city_area">city area</label>
                  <input type="text" class="form-control" id="city_area" placeholder="input city area" name="city_area" value="{{$address['city_area']}}">
                </div> <br>

                <div class="form-group">
                  <label for="postal_zip_code">postal zip code</label>
                  <input type="text" class="form-control" id="postal_zip_code" placeholder="input postal zip code" name="postal_zip_code" value="{{$address['postal_zip_code']}}">
                </div> <br>

                <div class="form-group">
                  <label for="country_area">country area</label>
                  <input type="text" class="form-control" id="country_area" placeholder="input country area" name="country_area" value="{{$address['country_area']}}">
                </div> <br>

                <div class="form-group">
                    <label for="ai">Active Ind</label><br>
                    <input type="radio" name="ai" value="Y"  {{$address->active_ind == 'Y'? 'checked' : ''}}> Yes<br>
                    <input type="radio" name="ai" value="N"  {{$address->active_ind == 'N'? 'checked' : ''}}> No<br>
                </div>
                

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
