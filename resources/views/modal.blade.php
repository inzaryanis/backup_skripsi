<!-- MAINTENAANCE DETAIL MODAL -->

@extends ('layouts/tema')

@section('title','Maintenance')

@section('card_title','Maintenance')

@section('isi')
<style>
            /* .modal-inventory {
                height: 500px;
            } */
            /* .modal-dialog {
                width: 800px;
                margin: 30px auto;
            } */
            .modal-content {
               background:#ADD8E6;
            }
 </style>

<!-- <a style="color:#fff;" data-toggle="modal" data-target="#ModalSPK" class="btn btn-warning">Add SPK</a> -->

<a href="/create_spk" class="btn btn-warning">Add SPK</a>


<!-- MULAI TOMBOL TAMBAH -->
<!-- <a href="javascript:void(0)" class="btn btn-success" id="tombol-tambah">Add Customer</a> -->
                <br><br>
                <!-- AKHIR TOMBOL -->
                  <div class="table-responsive">
                  <table  class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">SPK Number</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($spk_detail as $spk)
                        <tr>
                          <td>{{$spk->id_spk}}</td>
                         

                          <td>
                            
                            
                              <!-- <a href="/spk-install/edit/{{$spk['id']}}" class="btn btn-primary  fa fa-edit"></a> -->
                              <a style="color:#fff;" data-toggle="modal" data-target="#spk_edit{{ $spk->id }}" class="btn btn-primary  fa fa-pencil"></a>
                              <a style="color:#fff;" data-toggle="modal" data-target="#spk_detail{{ $spk->id }}" class="btn btn-warning  fa fa-eye"></a>
                              <a href="" class="btn btn-danger  fa fa-trash"></a>

                              <!-- <a href="/spk-install/detail/{{$spk['id']}}" class="btn btn-warning  fa fa-eye"></a> -->
                          </td>

                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    </div>
            </div>

           
   
@endsection

