@extends ('layouts/tema')

@section('title','Tools')

@section('card_title','Tools')

@section('isi')

                  <div class="table-responsive">
                  <table id="table_tools" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                        <th>No</th>
                          <th scope="col">Part</th>
                          <th scope="col">Jumlah</th>
                          <th scope="col">UOM</th>
                           <!-- <th scope="col">Action</th> -->
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

table = $('#table_tools').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{{url("/tools/getdata")}}',
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
          
        //   {
        //       data: 'action',
        //       name: 'action'
        //   },
      ]
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

