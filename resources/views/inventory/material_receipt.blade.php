@extends ('layouts/tema')

@section('title','Material Receipt')

@section('card_title','Material Receipt')

@section('isi')
<form action="/material_receipt" method="POST" autocomplete="off" enctype="multipart/form-data">
              @csrf
              <div class="row">
                  <div class="form-group col-sm-6">
              <table>

                <!-- <tr><td>
                <td  align="right">Material Receipt Number : <input type=text name=”nama” >  -->

                <br><tr><td>
                <td align="right">References Type  :   <select id='shipping' name="shipping" style="width:160px;height:30px;">       
                                                    <option value="">--Pilih References Type--</option>
                                                    <option value="Packing List">Packing List</option>
                                                    <option value="PO">PO</option>
                                                    <option value="Receipts">Receipts</option>
                                                   
                                        </select>

                <br><tr><td>
                <td align="right">References Number : <input type=text  name="currency" id="currency"  style="width:160px;height:30px;">

                <br><tr><td >
                <td  align="right">  Receipt Date  : <input type='date'  name="other" id="other" style="width:160px;height:30px;">

                <br><tr><td>
                <td   align="right"> PO / Order Number : <input type=”text” name="po_number" id="po_number"  style="width:160px;height:30px;">

                <br><tr><td>
                <td   align="right"> PO Date  : <input type='date'  name="po_date" id="po_date" style="width:160px;height:30px;">

                <br><br><tr><td>
                <td   align="right">  Received by  : <input type=”text”  name="phone" id="phone"  style="width:160px;height:30px;">

                <br><tr><td>
                <td   align="right">  Received Date  : <input type='date'  name="fax" id="fax" style="width:160px;height:30px;">

                <br><tr><td>
                <td   align="right">  Remarks  : <input type=”text”  name="" id=""  style="width:160px;height:30px;">

                <br><br><tr><td>
                <td   >   Serialaized Part  :  <input type="radio" id="male" name="gender" value="male">
                                                            <label for="male">Ya</label>
                                                            <input type="radio" id="female" name="gender" value="female">
                                                            <label for="female">No</label><br>

                </table></div>
              
              
              
              
                <div class="form-group col-sm-6">
                                <table>

                <tr><td>
                <td  align="right">Vendor : <input type=text  name="vendor" id="vendor"  style="width:160px;height:30px;"> 

                <br><tr><td>
                <td align="right">Contact  :   <input type=text  name="contact" id="contact"  style="width:160px;height:30px;">

                <br><tr><td>
                <td align="right">Address : <input type=text  name="address" id="address"  style="width:160px;height:30px;">

                <br><tr><td >
                <td  align="right">Phone/Fax  : <input type=text  name="phone" id="phone"  style="width:160px;height:30px;">

                <br><tr><td>
                <td   align="right"> Total Harga : <input type=”text”  name="total_po" id="total_po"  style="width:160px;height:30px;">

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
                              <th>item</th>

                                <th>Part                                   
                                <a data-toggle="modal" data-target="#Modalpart">+</i></a>
                                </th>
                                <th>Description</th>
                                <th>Type</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                              </tr>
                          </thead>
                             <tbody>
                               <tr id="part0">
                               <td>
                                   <input type="text"  id="item" name="item[]" class="form-control" value="" required >
                                </td>
                                  <td>
                                     <select  id="parts" name="part[]"  class="form-control" required>
                                         <option value="">-- choose part --</option>
                                         @foreach ($part as $part)
                                            <option value="{{$part->id}}">{{$part->part}}</option>
                                            @endforeach
                                    </select>
                                  </td>
                                <td>
                                   <input type="text"  id="description" name="description[]" class="form-control" value="" >
                                </td>
                                <td>
                                   <input type="text"  id="type" name="type[]" class="form-control" value="" >
                                </td>
                                <td>
                                   <input type="number" onKeyup="hitung()"  id="quantity0" name="quantity[]" class="form-control" min="1" value="1" >
                                </td>
                                <td>
                                   <input type="text" onKeyup="hitung()"  id="price0" name="price[]" class="form-control" value="" >
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

table = $('#table_gps').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{{url("/gps/getdata")}}',
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

  url: '/delete/customer/'+id,

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

    let row_number = 1;
$(document).ready(function(){
    $("#add_row").click(function(e){
      e.preventDefault();
      $('#part' + row_number).html(add_row(row_number)).find('td:first-child');
      $('#parts_table').append('<tr id="part' + (row_number + 1) + '"></tr>');
      row_number++;
    });

    $("#delete_row").click(function(e){
      e.preventDefault();
      if(row_number > 1){
        $("#part" + (row_number - 1)).html('');
        row_number--;
		hitung()
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
function hitung(){
		//  Ambil nilai quantity dan price 
		var total_harga = 0, quantity = 0, price = 0
		for(var ij=0; ij<row_number; ij++){
			quantity = parseInt($('#quantity' +ij).val());
			price = parseInt($('#price' +ij).val());

			//  Perhitungan 
			total_harga += (quantity*price)
		}
		if(isNaN(total_harga)){
			total_harga = $('#total_po').val()
		}
		$('#total_po').val(total_harga);
}

function add_row(n){
	var html = '<td><input type="text"  id="item" name="item[]" class="form-control" value="" required ></td>'
		html += '<td><select  id="parts" name="part[]"  class="form-control" required><option value="">-- choose part --</option>@foreach($part as $part) @endforeach </td>'
        html += '<td><input type="text"  id="description" name="description[]" class="form-control" value="" ></td>'
        html += '<td><input type="text"  id="type" name="type[]" class="form-control" value="" ></td>'
        html += '<td><input type="number" onKeyup="hitung()" id="quantity' + n + '" name="quantity[]" class="form-control" min="1" value="1" ></td>'
        html += '<td><input type="text" onKeyup="hitung()" id="price' + n + '" name="price[]" class="form-control" value="" ></td>'
	return html	
}
</script>
@endsection

@section('modal');


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

