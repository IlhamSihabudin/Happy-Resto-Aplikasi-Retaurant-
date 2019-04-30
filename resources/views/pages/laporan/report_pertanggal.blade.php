<div class="card border-0 shadow">
    <div class="card-header text-white bg-primary">
        <span class="h3">Laporan Pertanggal</span>
    </div>
    <div class="card-body" id="print_laporan">
        <div class="row">
            <div class="col-md-12" style="text-align: center">
                <div class="h3">Laporan Pertanggal</div>
                <div class="h4">Dari {{ date('d F Y', strtotime($tglAwal)) }} - {{ date('d F Y', strtotime($tglAkhir)) }}</div>
            </div>
            <div class="col-md-12 mt-4">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Id Order</th>
                            <th>Nama User</th>
                            <th>No Meja</th>
                            <th>Total Bayar</th>
                            <th>Tanggal Order</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order as $value)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $value->id_order }}</td>
                                <td>{{ $value->nama_user }}</td>
                                <td>{{ $value->no_meja }}</td>
                                <td>{{ $value->total_bayar }}</td>
                                <td>{{ date('d F Y', strtotime($value->tanggal)) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>