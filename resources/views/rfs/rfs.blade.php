@extends ('layouts/admin')

@section('title','Request For Service')

@section('card_title','Request For Service')

@section('isi')

<a style="color:#fff;" data-toggle="modal" data-target="#importExcel"  class="btn btn-success"> Import</a>


<a href="/create_rfs" class="btn btn-success">Add Request For Service</a>
                  <div class="table-responsive">
                  <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">Action</th>
                          <th scope="col">Request Type</th>
                          <th scope="col">Platform</th>
                          <th scope="col">Request Date</th>
                          <th scope="col">Type</th>
                          <th scope="col">Request By</th>
                          <th scope="col">Name</th>
                          <th scope="col">Number Phone</th>
                          <th scope="col">Description</th>
                          <th scope="col">Date From</th>
                          <th scope="col">Date To</th>
                          <th scope="col">Location</th>
                          <th scope="col">Status</th>
                          <th scope="col">Lampiran</th>
                        </tr>
                      </thead>
                      <tbody>
                      <tr>

                          @foreach($rfs as $rfs)
                          <td>
                 @if($rfs->status=="open")
                            <!-- Button to Open the Modal -->
                  <a data-toggle="modal" data-target="#Modalaccept" data-id="{{$rfs['id']}}"><img src="{{asset('admin/assets/img/ceklis.png')}}" width="25" height="25" ></i></a>
                
                  <a href="" onclick="return confirm ('Apa Anda yakin ingin menghapus ini')"><img src="{{asset('admin/assets/img/silang.png')}}" width="13" height="13" ></a>
                  @else
                  @endif
                  </td>
                          <td>{{$rfs->request_type}}</td>
                          <td>{{$rfs->platform}}</td>
                          <td>{{$rfs->request_date}}</td>
                          <td>{{$rfs->type}}</td>
                          <td>{{$rfs->request_by}}</td>
                          <td>{{$rfs->name}}</td>
                          <td>{{$rfs->number_phone}}</td>
                          <td>{{$rfs->description}}</td>
                          <td>{{$rfs->date_from}}</td>
                          <td>{{$rfs->date_to}}</td>
                          <td>{{$rfs->location}}</td>
                          <td>{{$rfs->status}}</td>
                          <td><img src="{{asset('images/'. $rfs->lampiran)}}" width="50" height="50" ></td>


                          
                          
                        </tr>
                        @endforeach
                      </tbody>
                    </table>

                    <!-- Modal -->
 <div class="modal fade" id="Modalaccept" >
    <div class="modal-dialog" >
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" >
                &times;
              </button>
              </div>
              <div class="modal-body">
              <form action="/update_status/{{$rfs['id']}}" method="POST">
              @csrf
               <h4>Setujui Request For Service</h4>
            <div class="modal-footer">
              <button type="submit" class="btn btn-info">Accept</button>
              </form>
          </div>
        </div>
      </div>
      </div>
      </div>
@endsection