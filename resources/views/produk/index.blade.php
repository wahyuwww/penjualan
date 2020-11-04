@extends('layouts.template')

@section('title')
Data Produk
@endsection

@section('content')
<div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">

            @if(Request::get('keyword'))
                <a class="btn btn-success" href="{{ route('produk.index') }}">Back</a>
            @else
                <a class="btn btn-success" href="{{ route('produk.create') }}"><span class="glyphicon glyphicon-plus"></span> Create</a>
            @endif

            <form method="get" action="{{route('produk.index')}}">
                <div class="form-group">
                  <label for="keyword" class="col-sm-2 control-label">Search By Name</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="keyword" name="keyword" value="{{Request::get('keyword')}}">
                  </div>
                  <div class="col-sm-6">
                    <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search"></span></button>
                  </div>
                </div>
              </form> 
              <br/>
              <form method="get" action="{{route('produk.index')}}">
                <div class="form-group">
                  <label for="kd_kategori" class="col-sm-2 control-label">Search By Kategori</label>
                  <div class="col-sm-4">
                    <select id="kd_kategori" name="kd_kategori" class="form-control">
                      @foreach($kategori as $row)
                        <option value="{{ $row->kd_kategori }}">{{ $row->kategori }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-sm-6">
                    <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search"></span></button>
                  </div>
                </div>
              </form> 


            </div>
            <div class="box-body">
                @if(Request::get('keyword'))
                    <div class="alert alert-success alert-block">
                        Hasil Pencarian Produk dengan Keyword : <b>{{ Request::get('keyword') }}</b>
                    </div>
                @endif

                @if(Request::get('kd_kategori'))
                    <div class="alert alert-success alert-block">
                        Hasil Pencarian Produk dengan Kategori : <b>{{ $nama_kategori }}</b>
                    </div>
                @endif

                @include('alert.success')
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Produk</th>
                            <th>Nama Kategori</th>
                            <th>Harga</th>
                            <th>Gambar</th>
                            <th>Stok</th>
                            <th width="30%">Action</th>
                        </tr>
                    </thead>    
                    <tbody>
                        @foreach($produk as $row)
                            <tr>
                                <td>{{ $loop->iteration + ($produk->perPage() * ($produk->currentPage() - 1)) }}</td>
                                <td>{{ $row->nama_produk }}</td>
                                <td>{{ $row->kategori->kategori }}</td>
                                <td>@rupiah($row->harga)</td>
                                <td><img class="img-thumbnail" width="100px" src="{{ asset('uploads/'.$row->gambar_produk) }}"/></td>
                                <td>{{ $row->stok }}</td>
                                <td>                                
                                <form method="post" action="{{ route('produk.destroy',[$row->kd_produk]) }}" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini ?')">
                                @csrf
                                {{ method_field('DELETE') }}
                                <a class="btn btn-warning" href="{{ route('produk.edit',[$row->kd_produk]) }}">Edit</a>
                                <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $produk->appends(Request::all())->links() }}
            </div>
          </div>
        </div>
</div>
@endsection