@extends('layouts.template')

@section('title')
Data Pegawai
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">

                @if(Request::get('keyword'))
                <a class="btn btn-success" href="{{ route('pegawai.index') }}">Back</a>
                @else
                <a class="btn btn-success" href="{{ route('pegawai.create') }}"><span
                        class="glyphicon glyphicon-plus"></span>
                    Create</a>
                @endif

                <form method="get" action="{{route('pegawai.index')}}">
                    <div class="form-group">
                        <label for="keyword" class="col-sm-2 control-label">Search By Name</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="keyword" name="keyword"
                                value="{{Request::get('keyword')}}">
                        </div>
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-info"><span
                                    class="glyphicon glyphicon-search"></span></button>
                        </div>
                    </div>
                </form>
            </div>


            <div class="box-body">
                @if(Request::get('keyword'))
                <div class="alert alert-success alert-block">
                    <tr>
                        <th>Hasil Pencarian pegawai dengan Keyword : <b>{{ Request::get('keyword') }}</b></th>
                    </tr>
                </div>
                @endif
                @include('alert.success')
                <table class="table table-borderad">
                    <thead>
                        <tr>
                        <tr>
                            <th width="5%">No</th>
                            <th>Username</th>
                            <th>nama Pegawai</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            <th width="35%">Action</th>
                        </tr>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pegawai as $row)
                        <tr>
                            <td>{{$loop->iteration+($pegawai->perPage() * ($pegawai->currentPage()-1)) }}</td>
                            <td>{{$row->username}}</td>
                            <td>{{$row->nama_pegawai}}</td>
                            <td>{{$row->jk}}</td>
                            <td>{{$row->alamat}}</td>
                            <td>@if($row->is_aktif == 1) Aktif @else Tidak aktif @endif</td>
                            <td>
                                <form method="post"
                                    onsubmit="return confirm('apakah yaki menghapus?')"
                                    action="{{route('pegawai.destroy',[$row->username] )}}">
                                    @csrf
                                    {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-danger">DELETE</button>
                                    <a href="{{route('pegawai.edit',[$row->username])}}" class="btn btn-warning">EDIT</a>
                                </form>
                            </td>
                            @endforeach
                    </tbody>
                </table>
                {{ $pegawai->appends(Request::all())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection