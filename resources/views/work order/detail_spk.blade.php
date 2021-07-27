@extends ('layouts/tema')

@section('title','Detail Surat Perintah Kerja')

@section('card_title','Detail Surat Perintah Kerja')

@section('isi')
                            <div class="row">
						        <div class="col-md-12 ">
							        <div class="x_panel">
                                    <div class="table-responsive">
                  <table class="table table-bordered">
                      <thead style="background:#6495ED;">
                        <tr>
                        <th scope="col">No</th>
                          <th scope="col">SPK Number</th>
                          <th scope="col">SPK Date</th>
                          <th scope="col">Customer</th>
                          <th scope="col">Nomor Polisi</th>
                          <th scope="col">IMEI</th>
                          <th scope="col">GSM</th>
                          <th scope="col">Type</th>
                          <th scope="col">Remarks</th>
                        </tr>
                      </thead>
                      <tbody>
                      @php
                          $no = 1;    
                      @endphp
                      @foreach ($spk_tabel as $spk_tabel)
                        <tr>
                        <td>{{ $no++ }}</td>
                          <td>{{$spk_tabel->spk->spk_number}}</td>
                          <td>{{$spk->spk_date}}</td>
                          <td>{{$spk->customer->name}}</td>
                          <td>{{$spk_tabel->nomor_polisi}}</td>
                          <td>{{$spk_tabel->imei}}</td>
                          <td>{{$spk_tabel->gsm_number}}</td>
                          <td>{{$spk->job_type}}</td>
                          <td>{{$spk->remarks}}</td>

                        </tr>
                        @endforeach
                      </tbody>
                    </table>

                   <a href="/maintenance" class="btn btn-secondary">Back</a>
											
                    </div>
                 </div>     
				</div>
			  </div>
		    </div>
           </div>
		

@endsection

