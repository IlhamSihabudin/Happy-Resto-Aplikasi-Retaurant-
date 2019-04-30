@extends('layouts.master')
@section('title', 'Laporan')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="" class="form-control-label">Pilih Tahun</label>
                                    <select name="tahun" id="tahun" class="form-control" onchange="refresh_table()">
                                        @for($i = $tahun; $i >= $tahun-10;$i--)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-4" id="table_report">
                <div class="card border-0 shadow">
                    <div class="card-header bg-primary text-white">
                        <div class="row">
                            <div class="col-6">
                                <span class="h4">Laporan Pemasukan</span>
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
                            <div class="col-md-12" style="text-align: center">
                                <h3>Laporan Pemasukan<br>
                                    Tahun {{ $tahun }}
                                </h3>
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped text-center" border="1" style="width: 100%">
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
            </div>
        </div>
    </div>
@endsection

@push('js-script')
    <script>
        function refresh_table() {
            $('#table_report').load('{{url()->current()}}'+'/'+$('#tahun').val());
        }

        function report_print() {
            var print = document.getElementById("generete_report");
            newWin = window.open();
            newWin.document.write(print.outerHTML);
            newWin.print();
            newWin.close();
        }
    </script>
@endpush