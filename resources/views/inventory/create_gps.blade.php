@extends ('layouts/admin')

@section('title','part')

@section('card_title','Add Part')

@section('isi')


        <div class="card-body">
        <form method="post" action="/store_gps" autocomplete="off">
	          @csrf
                <div>
                  <label for="part">Part</label>  
                 <select name="part" class="form-control">
                              <option value="" >Choose part</option>
                            @foreach ($part as $part)
                              <option value="{{$part->id}}">{{$part->part}}</option>
                            @endforeach
                  </select>
                </div> <br>

                <div class="form-group">
                  <label for="quantity">quantity</label>
                  <input type="text" class="form-control" id="quantity" placeholder="input quantity" name="quantity" required>
                </div><br>
                <div class="form-group">
                  <label for="uom">uom</label>
                  <input type="text" class="form-control" id="uom" placeholder="input uom" name="uom" required>
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
