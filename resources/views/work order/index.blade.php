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

<a style="color:#fff;" data-toggle="modal" data-target="#ModalInstall" class="btn btn-warning">Install</a>
<a style="color:#fff;" data-toggle="modal" data-target="#ModalMaintenance" class="btn btn-warning">Maintenance</a>

<!-- MULAI TOMBOL TAMBAH -->
<!-- <a href="javascript:void(0)" class="btn btn-success" id="tombol-tambah">Add Customer</a> -->
                <br><br>
                <!-- AKHIR TOMBOL -->
                  <div class="table-responsive">
                  <table id="table_wo" class="table table-striped">
                      <thead>
                        <tr>
                        <th>No</th>
                          <th scope="col">Nomor Polisi</th>
                          <th scope="col">Install Date</th>
                          <th scope="col">Customer</th>
                          <th scope="col">IMEI</th>
                          <th scope="col">GSM</th>
                          <th scope="col">GPS Status</th>
                          <th scope="col">OSLOG Status</th>
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




});
</script>
@endsection

@section('modal');

 

@endsection

