@extends('layouts.template')

@section('title')
Data Transaksi Masuk
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">

                @if(Request::get('start_date') != "" && Request::get('end_date') != "")
                <a class="btn btn-success" href="{{route('transaksi_masuk.index')}}">Back</a>
                @else
                <a class="btn btn-success" href="{{route('transaksi_masuk.create')}}"><span
                        class="glyphicon glyphicon-plus"></span>Create</a>
                @endif
                <br/>
                <br/>
                <form method="get" action="{{route('transaksi_masuk.index')}}">
                    <div class="form-group">
                        <label for="nama_produk" class="col-sm-2 control-label">Search By Date</label>
                        <div class="col-sm-4">
                            <input type="text" readonly name="start_date" placeholder="start date"
                                class="form-control datepicker" />
                        </div>
                        <div class="col-sm-4">
                            <input type="text" readonly name="end_date" placeholder="Finish date"
                                class="form-control datepicker" />
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-info"><span
                                    class="glyphicon glyphicon-search"></span></button>
                        </div>
                    </div>
                </form>

            </div>
                <div class="box-body">
                    @if(Request::get('start_date') != "" && Request::get('end_date') !="")
                    <div class="alert alert-success alert-block">
                        Hasil Pencarian Transkasi Masuk Dari Tanggal : {{$start_date}} s/d {{$end_date}}
                    </div>
                    @endif
                    
                    @include('alert.success')
                    <table class="table table-borderad">
                        <thead>
                            <tr>
                            <tr>
                                <th width="5%">No</th>
                                <th>Produk</th>
                                <th>Supplier</th>
                                <th>Tanggal Transaksi</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th width="35%">Action</th>
                            </tr>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksi_masuk as $row)
                            <tr>
                                <td>{{$loop->iteration+($transaksi_masuk->perPage() * ($transaksi_masuk->currentPage()-1)) }}
                                </td>
                                <td>{{$row->produk->nama_produk}}</td>
                                <td>{{$row->supplier->nama_supplier}}</td>
                                <td>{{$row->tgl_transaksi}}</td>
                                <td>{{$row->jumlah}}</td>
                                <td>@rupiah($row->harga)</td>
                                <td>
                                    <form method="post" onsubmit="return confirm('apakah yaki menghapus?')"
                                        action="{{route('transaksi_masuk.destroy',[$row->kd_transaksi_masuk] )}}">
                                        @csrf
                                        {{method_field('DELETE')}}
                                        <button type="submit" class="btn btn-danger">Delete</button>


                                    </form>
                                </td>
                                @endforeach
                        </tbody>
                    </table>
                    {{ $transaksi_masuk->appends(Request::all())->links() }}
                </div>
            </div>
        </div>
    </div>
    @endsection