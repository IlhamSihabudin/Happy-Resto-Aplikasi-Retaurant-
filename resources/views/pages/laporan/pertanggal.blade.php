@extends('layouts.master')
@section('title', 'Laporan')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5">
                                <label for="" class="form-control-label">Tanggal Awal</label>
                                <input type="date" class="form-control" name="tanggal_awal" id="tanggal_awal">
                            </div>
                            <div class="col-md-5">
                                <label for="" class="form-control-label">Tanggal Awal</label>
                                <input type="date" class="form-control" name="tanggal_akhir" id="tanggal_akhir">
                            </div>
                            <div class="col-md-2 align-self-end">
                                <button class="btn btn-primary btn-block" onclick="cari_tanggal()" id="btn_cari">Cari</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-4" id="report_pertanggal">
            </div>
        </div>
    </div>
@endsection

@push('js-script')
    <script>
        function cari_tanggal() {
            if ($('#tanggal_awal').val() == ""){
                $('#tanggal_awal').focus();
            }else if($('#tanggal_akhir').val() == ""){
                $('#tanggal_akhir').focus();
            }else{
                $('#report_pertanggal').load('{{ url()->current() }}' + '/' + $('#tanggal_awal').val() + '/' + $('#tanggal_akhir').val());
            }
        }
    </script>
@endpush