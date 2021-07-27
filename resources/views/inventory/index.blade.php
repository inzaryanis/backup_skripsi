@extends ('layouts/tema')

@section('title','Inventory')

@section('card_title','Inventory')

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
               background:#DCDCDC;
            }
 </style>
<a href="/material_receipt" class="btn btn-warning">Material Receipt</a>

<!-- <a style="color:#fff;" data-toggle="modal" data-target="#ModalmaterialReceipt" class="btn btn-warning">Material Receipt</a> -->
<a style="color:#fff;" data-toggle="modal" data-target="#ModalmateriaIssue" class="btn btn-warning">Material Issue</a>
<a style="color:#fff;" data-toggle="modal" data-target="#Modalreturntostock" class="btn btn-warning">Return To Stock</a>
<a style="color:#fff;" data-toggle="modal" data-target="#ModalGPS" class="btn btn-warning">GPS</a>
<a style="color:#fff;" data-toggle="modal" data-target="#ModalGSM" class="btn btn-warning">GSM</a>

<!-- MULAI TOMBOL TAMBAH -->
<!-- <a href="javascript:void(0)" class="btn btn-success" id="tombol-tambah">Add Customer</a> -->
                <br><br>
                <!-- AKHIR TOMBOL -->
                  <div class="table-responsive">
                  <table id="table_inventory" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                        <th>No</th>
                          <th scope="col">Part</th>
                          <th scope="col">Quantity</th>
                          <th scope="col">UOM</th>
                          <th scope="col">Merk</th>
                          <th scope="col">Type</th>
                          <th scope="col">Serialized Code</th>
                           <th scope="col">Action</th>
                        </tr>
                      </thead>
                    </table>
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
 //MULAI DATATABLE
 //script untuk memanggil data json dari server dan menampilkannya berupa datatable

table = $('#table_inventory').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{{url("/inventory/getdata")}}',
      columns: [
          {
              data: 'DT_RowIndex',
              name: 'DT_RowIndex'
          },
          {
              data: 'master_part.part',  // Nama tabel sama nama field nya
              name: 'master_part.part'
          },
          {
              data: 'quantity',
              name: 'quantity'
          },
          {
              data: 'master_part.uom',
              name: 'master_part.uom'
          },
          {
              data: 'master_part.merk',
              name: 'master_part.merk'
          },
          {
              data: 'master_part.type',
              name: 'master_part.type'
          },
          {
              data: 'master_part.serialized_code',
              name: 'master_part.serialized_code'
          },
          {
              data: 'action',
              name: 'action'
          },
      ]
  });


 


// ================== HAPUS ===================

$('body').on('click', '.hapusBtn', function () {

var id = $(this).data("id");    // Harus Data pakenya

confirm("Are You sure want to delete !");

$.ajax({

  type: "DELETE",

  url: '/delete/inventory/'+id,

  success: function (data) {

    table.draw();

  },

  error: function (data) {

    console.log('Error:', data);

  }

});


});

});


// =================== type dan description berdasarka pilihan part ============================================


$('#parts').on('change', function(e){
            console.log("asdasdasd");

                // var id = e.target.value;
                // $.get('{{ url('type')}}/'+id, function(data){
                //     console.log(data);
                //     $('#type').empty();
                //     $.each(data, function(index, element){
                //         $('#type').append("<tr><td>"+element.type+"</td></tr>");
                //     });
                // });
            });
        
// =================== NAMBAH dan HAPUS ROW ============================================

$(document).ready(function(){
    let row_number = 1;
    $("#add_row").click(function(e){
      e.preventDefault();
      let new_row_number = row_number - 1;
      $('#part' + row_number).html($('#part' + new_row_number).html()).find('td:first-child');
      $('#parts_table').append('<tr id="part' + (row_number + 1) + '"></tr>');
      row_number++;
    });

    $("#delete_row").click(function(e){
      e.preventDefault();
      if(row_number > 1){
        $("#part" + (row_number - 1)).html('');
        row_number--;
      }
    });

// =================== type dan description berdasarka pilihan part ============================================

    $('#parts').change(function(){
             var id = $(this).val();
             $.ajax({
                 url: '/type/'+id, 
                   type: 'get',
                  success: function (data) {
                     console.log(data);
                     $("#type").val(data.data.type);
                     $("#description").val(data.data.description);
                     
                    },
                });
          });


});
</script>
@endsection

@section('modal');

 <!-- Modal RECEIPT -->
 <div class="modal fade" id="ModalmaterialReceipt" >
 <div class="modal-dialog" style="max-width: 60%;" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" ><b>Material Receipt</b></h5>
              <button type="button" class="close" data-dismiss="modal" >&times;</button>
              </div>
              <div class="modal-body">
              <form action="/material_receipt" method="POST" autocomplete="off" enctype="multipart/form-data">
              @csrf
              <div class="row">
                  <div class="form-group col-sm-6">
              <table>

                <tr><td>
                <td  align="right">Material Receipt Number : <input type=text name=”nama” size=”20″> 

                <br><tr><td>
                <td align="right">References Type  :   <input type=text  name="" id="" size=”30″>

                <br><tr><td>
                <td align="right">References Number : <input type=text  name="currency" id="currency" size=”22″>

                <br><tr><td >
                <td  align="right">  Receipt Date  : <input type=text  name="other" id="other" size=”15″>

                <br><tr><td>
                <td   align="right"> PO / Order Number : <input type=”text” name="po_number" id="po_number" size=”35″>

                <br><tr><td>
                <td   align="right"> PO Date  : <input type=”text”  name="po_date" id="po_date" size=”20″>

                <br><br><tr><td>
                <td   align="right">  Received by  : <input type=”text”  name="phone" id="phone" size=”35″>

                <br><tr><td>
                <td   align="right">  Received Date  : <input type=”text”  name="fax" id="fax" size=”35″>

                <br><tr><td>
                <td   align="right">  Remarks  : <input type=”text”  name="" id="" size=”35″>

                <br><br><tr><td>
                <td   >   Serialaized Part  :  <input type="radio" id="male" name="gender" value="male">
                                                            <label for="male">Ya</label>
                                                            <input type="radio" id="female" name="gender" value="female">
                                                            <label for="female">No</label><br>

                </table></div>
              
              
              
              
                <div class="form-group col-sm-6">
                                <table>

                <tr><td>
                <td  align="right">Vendor : <input type=text  name="vendor" id="vendor" size=”20″> 

                <br><tr><td>
                <td align="right">Contact  :   <input type=text  name="contact" id="contact" size=”30″>

                <br><tr><td>
                <td align="right">Address : <input type=text  name="address" id="address" size=”22″>

                <br><tr><td >
                <td  align="right">Phone/Fax  : <input type=text  name="phone" id="phone" size=”15″>

                <br><tr><td>
                <td   align="right"> Total Harga : <input type=”text”  name="total_po" id="total_po" size=”35″>

                </table>
                </div></div>
                      
                <!-- <form action="" method="POST">
                     @csrf -->
                  <div class="card">
                    <div class="card-header"> PART </div>
                       <div class="card-body">
                          <table class="table table-borderless" id="parts_table">
                            <thead>
                              <tr>
                                <th>Part</th>
                                <th>Description</th>
                                <th>Type</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                              </tr>
                          </thead>
                             <tbody>
                               <tr id="part0">
                                  <td>
                                  <a data-toggle="modal" data-target="#Modalpart"><img src="{{asset('admin/assets/img/add.png')}}" width="10" height="10" ></i></a>
                                     <select  id="parts" name="part" class="form-control" style="width:200px;">
                                         <option value="">-- choose part --</option>
                                         @foreach ($part as $part)
                                            <option value="{{$part->id}}">{{$part->part}}</option>
                                            @endforeach
                                    </select>
                                  </td>
                                <td>
                                   <input type="text"  id="description" name="description" class="form-control" value="" style="width:200px;">
                                </td>
                                <td>
                                   <input type="text"  id="type" name="type" class="form-control" value="" style="width:150px; height:10px;">
                                </td>
                                <td>
                                   <input type="number"  id="quantity" name="quantity" class="form-control" value="1" style="width:80px;">
                                </td>
                                <td>
                                   <input type="text"  id="price" name="price" class="form-control" value="" style="width:100px;">
                                </td>
                             </tr>
                               <tr id="part1"></tr>
                             </tbody>
                            </table>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <button id="add_row" class="btn btn-default pull-left">+ Add Row</button>
                                                <button id='delete_row' class="pull-right btn btn-danger">- Delete Row</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                </div>
                
            <div class="modal-footer">
              <button type="submit" class="btn btn-info">Save</button>
              </form>
          </div>
        </div>
      </div>
      </div>
      </div>



      <div class="modal fade" id="Modalpart" >
    <div class="modal-dialog" >
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" >Add part</h5>
              <button type="button" class="close" data-dismiss="modal" >
                &times;
              </button>
              </div>
              <div class="modal-body">
              <form action="/store_part" method="POST" autocomplete="off">
              @csrf
              <div class="form-group">
                  <label for="part">Part</label>
                  <input type="text" class="form-control" id="part" placeholder="input part name" name="part" required>
                 @if ($errors->has('part'))
 
                    <span class="text-danger">{{ $errors->first('part') }}</span>
 
                @endif
                </div>
                <div>
                  <label for="series">Series</label>  
                  <!-- Button to Open the Modal -->
                  <a data-toggle="modal" data-target="#Modalseries"><img src="{{asset('admin/assets/img/add.png')}}" width="10" height="10" ></i></a>
                 <select name="series" class="form-control">
                              <option value="" >Choose Series</option>
                            @foreach ($series as $series)
                              <option value="{{$series->series}}">{{$series->series}}</option>
                            @endforeach
                  </select>
                </div> <br>
                <div>
                  <label for="type">Type</label> 
                  <!-- Button to Open the Modal -->
                <a data-toggle="modal" data-target="#Modaltype"><img src="{{asset('admin/assets/img/add.png')}}" width="10" height="10" ></i></a>

                    <select name="type" class="form-control">
                          <option value="">Choose Type</option>
                            @foreach ($type as $type)
                              <option value="{{$type->type}}">{{$type->type}}</option>
                            @endforeach
                  </select>
                </div> <br>
                <div>
                <label for="merk">Brand</label> 
  <!-- Button to Open the Modal -->
  <a data-toggle="modal" data-target="#Modalbrand"><img src="{{asset('admin/assets/img/add.png')}}" width="10" height="10" ></i></a>
                  <select name="merk" class="form-control">
                  <option value="">Choose Brand</option>
                            @foreach ($merk as $merk)
                              <option value="{{$merk->merk}}">{{$merk->merk}}</option>
                            @endforeach
                  </select>
                </div> <br>
                <div class="form-group">
                  <label for="uom">uom</label>
                  <input type="text" class="form-control" id="uom" placeholder="input uom" name="uom" required>
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

