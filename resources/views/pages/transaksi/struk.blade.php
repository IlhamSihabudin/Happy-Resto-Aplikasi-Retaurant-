@extends('layouts.master')
@section('title', 'Struk')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div id="print_struk">
                            <div style="font-size: 20pt; font-weight: bold">
                                HAPPY RESTO
                            </div>
                            <div>
                                Jl.Cibeureum Mulyaharja <br>
                                Bogor Selatan
                            </div>
                            <div>
                                Telp: 021-078962341 Fax:-
                            </div>
                            <hr>
                            <div>
                                <table>
                                    <tr>
                                        <td>ID Transaksi</td>
                                        <td>:</td>
                                        <td>{{ $struk->id_transaksi }}</td>
                                    </tr>
                                    <tr>
                                        <td>Kasir</td>
                                        <td>:</td>
                                        <td>{{ Auth::user()->nama_user }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal</td>
                                        <td>:</td>
                                        <td>{{ $struk->tanggal }}</td>
                                    </tr>
                                    <tr>
                                        <td>No Meja</td>
                                        <td>:</td>
                                        <td>{{ $meja->no_meja }}</td>
                                    </tr>
                                    <tr>
                                        <td>Atas Nama</td>
                                        <td>:</td>
                                        <td>{{ $struk->get_user->nama_user }}</td>
                                    </tr>
                                </table>
                            </div>
                            <hr>
                            <div>
                                <table style="width: 100%">
                                    <thead>
                                    <tr align="center">
                                        <th>No</th>
                                        <th>Masakan</th>
                                        <th>QTY</th>
                                        <th>Harga</th>
                                        <th>Total Harga</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($detail_order as $value)
                                        <tr>
                                            <td align="center">{{ $loop->index+1 }}</td>
                                            <td align="center">{{ $value->get_masakan->nama_masakan }}</td>
                                            <td align="center">{{ $value->qty }}</td>
                                            <td align="right">{{ $value->get_masakan->harga }}</td>
                                            <td align="right">{{ $value->total_harga }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5"><hr></td>
                                    </tr>
                                    <tr>
                                        <th colspan="4" align="right">Total Bayar</th>
                                        <th align="right">{{ $total_bayar }}</th>
                                    </tr>
                                    <tr>
                                        <th colspan="4" align="right">Bayar</th>
                                        <th align="right">{{ $bayar }}</th>
                                    </tr>
                                    <tr>
                                        <th colspan="4" align="right">Kembalian</th>
                                        <th align="right">{{ $kembalian }}</th>
                                    </tr>
                                    <tr>
                                        <td colspan="5"><hr></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div align="center">
                                Terima Kasih <br>
                                Atas Kunjungan Anda
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
        function print_struk() {
            var print = document.getElementById("print_struk");
            newWin = window.open();

            newWin.document.write(print.outerHTML);
            newWin.print();
            newWin.close();
        }

        $(document).ready(function () {
            print_struk();
            document.location.href='{{ route('transaksi') }}';
        });
    </script>
@endpush