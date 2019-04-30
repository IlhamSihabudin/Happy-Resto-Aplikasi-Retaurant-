<div class="card border-0 shadow">
    <div class="card-header bg-primary text-white">
        <div class="row">
            <div class="col-6">
                <span class="h4">Laporan Tahun 2019</span>
            </div>
            <div class="col-6">
                <div class="row justify-content-end">
                    <button class="btn btn-dark" onclick="report_print()"><i class="fa fa-print"></i> Print</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row" id="generete_report">
            <div class="col-md-12 text-center">
                <h3>Laporan Pemasukan</h3>
                <h3>Tahun {{ $tahun }}</h3>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped text-center" border="1" id="table_report">
                        <thead>
                        <tr>
                            <th>Bulan</th>
                            <th>Pemasukan</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($report_month as $value)
                            <tr>
                                <td>{{ $month_name[$loop->index] }}</td>
                                <td>Rp.{{ $value }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th>Jumlah</th>
                            <th>Rp.{{ $report_year }}</th>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>