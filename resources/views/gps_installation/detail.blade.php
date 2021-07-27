@extends ('layouts/tema')

@section('title','Add Gps Installation')

@section('card_title','Add Gps Installation')

@section('isi')

<style type="text/css">
  
  body{background:#fff;font-family:arial;}
  #wrapshopcart{width:90%;margin:3em auto;padding:30px;background:#d3d8dd;box-shadow:0 0 10px #ddd;}
  h1{margin:0;padding:0;font-size:2.5em;font-weight:bold;}
  p{font-size:1em;margin:0;}
  .flex{
    display:flex; /*Deklarasi display flex + antek2nya*/
    -moz-display:flex; 
    -webkit-display:flex; 
    -khtml-display:flex; 
    -o-display:flex; 
    justify-content:space-between;} /*auto margin antar konten didalamnya*/
.flex .isi{
    width:50%; /*lebarnya terserah, dikira-kira aja*/
    background:#ffbb27; 
    margin:10px; 
    padding:10px;}
    
 
 
  </style>

<div id="wrapshopcart">
          <div class="row">
				<div class="col-md-12 ">
					<div class="x_panel">
            <form action="/add_gps_install" method="POST" autocomplete="off" enctype="multipart/form-data">
              @csrf
                  <div class="form-group col-sm-5">
                  <table class="table table-bordered table-hover">
            <thead>
              <tr>
              <td align="right"><b><b>Customer  :</b></td>
              <td>{{ $gps->no_polisi}}</td>
              </tr>

              <tr>
              <td align="right"><b>Office Type  :</b></td>
              <td id="Did_office_type"></td>
              </tr>

              <tr>
              <td align="right"><b>Address Text  :</b></td>
              <td id="Daddress_text"></td>
              </tr>

              <tr>
              <td align="right"><b>First Address Line  :</b></td>
              <td id="Dfirst_address_line"></td>
              </tr>

              <tr>
              <td align="right"><b>Second Address Line  :</b></td>
              <td id="Dsecond_address_line"></td>
              </tr>


              <tr>
              <td align="right"><b>Third Address Line  :</b></td>
              <td id="Dthird_address_line"></td>
              </tr>

              <tr>
              <td align="right"><b>City Area  :</b></td>
              <td id="Dcity_area"></td>
              </tr>

              <tr>
              <td align="right"><b>Postal Zip Code  :</b></td>
              <td id="Dpostal_zip_code"></td>
              </tr>

              <tr>
              <td align="right"><b>Country Area  :</b></td>
              <td id="Dcountry_area"></td>
              </tr>

              <tr>
              <td align="right"><b>Active Ind  :</b></td>
              <td id="Dactive_ind"></td>
              </tr>
              <tr>
              <td align="right"><b>Created By  :</b></td>
              <td id="Dcreated_by"></td>
              </tr>

              <tr>
              <td align="right"><b>Created At  :</b></td>
              <td id="Dcreated_at"></td>
              </tr>

              <tr>
              <td align="right"><b>Updated By  :</b></td>
              <td id="Dupdated_by"></td>
              </tr>

              <tr>
              <td align="right"><b>Updated At  :</b></td>
              <td id="Dupdated_at"></td>
              </tr>

             
              
              </tr>
            </thead>
            </table>

</div>                
              
              
              
              <!-- =========================================  SEBELAHNYA  =============================================================== -->
                            <div class="form-group col-sm-5">
                            <table class="table table-bordered table-hover">
            <thead>
              <tr>
              <td align="right"><b><b>Customer  :</b></td>
              <td  id="Did_customer"></td>
              </tr>

              <tr>
              <td align="right"><b>Office Type  :</b></td>
              <td id="Did_office_type"></td>
              </tr>

              <tr>
              <td align="right"><b>Address Text  :</b></td>
              <td id="Daddress_text"></td>
              </tr>

              <tr>
              <td align="right"><b>First Address Line  :</b></td>
              <td id="Dfirst_address_line"></td>
              </tr>

              <tr>
              <td align="right"><b>Second Address Line  :</b></td>
              <td id="Dsecond_address_line"></td>
              </tr>


              <tr>
              <td align="right"><b>Third Address Line  :</b></td>
              <td id="Dthird_address_line"></td>
              </tr>

              <tr>
              <td align="right"><b>City Area  :</b></td>
              <td id="Dcity_area"></td>
              </tr>

              <tr>
              <td align="right"><b>Postal Zip Code  :</b></td>
              <td id="Dpostal_zip_code"></td>
              </tr>

              <tr>
              <td align="right"><b>Country Area  :</b></td>
              <td id="Dcountry_area"></td>
              </tr>

              <tr>
              <td align="right"><b>Active Ind  :</b></td>
              <td id="Dactive_ind"></td>
              </tr>
              <tr>
              <td align="right"><b>Created By  :</b></td>
              <td id="Dcreated_by"></td>
              </tr>

              <tr>
              <td align="right"><b>Created At  :</b></td>
              <td id="Dcreated_at"></td>
              </tr>

              <tr>
              <td align="right"><b>Updated By  :</b></td>
              <td id="Dupdated_by"></td>
              </tr>

              <tr>
              <td align="right"><b>Updated At  :</b></td>
              <td id="Dupdated_at"></td>
              </tr>

             
              
              </tr>
            </thead>
            </table>
                    <a style="float:right;"  href="/daftarpesanan" class="btn btn-default btn-xs ">Kembali</a ></form>

              </form>
			</div>
		</div>
        </div>
						

      @endsection