@extends('layouts.template')

@section('title')
Data Kategori
@endsection

@section('content')
<div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">

            @if(Request::get('keyword'))
                <a class="btn btn-success" href="{{ route('kategori.index') }}">Back</a>
            @else
                <a class="btn btn-success" href="{{ route('kategori.create') }}"><span class="glyphicon glyphicon-plus"></span> Create</a>
            @endif

            <form method="get" action="{{route('kategori.index')}}">
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
            </div>
            <div class="box-body">
                @if(Request::get('keyword'))
                    <div class="alert alert-success alert-block">
                        Hasil Pencarian Supplier dengan Keyword : <b>{{ Request::get('keyword') }}</b>
                    </div>
                @endif

                @include('alert.success')
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Kategori</th>
                            <th>Gambar Kategori</th>
                            <th width="30%">Action</th>
                        </tr>
                    </thead>    
                    <tbody>
                        @foreach($kategori as $row)
                            <tr>
                                <td>{{ $loop->iteration + ($kategori->perPage() * ($kategori->currentPage() - 1)) }}</td>
                                <td>{{ $row->kategori }}</td>
                                <td><img class="img-thumbnail" src="{{ asset('uploads/'.$row->gambar_kategori) }}" width="100px" /> </td>
                                <td>                                
                                <form method="post" action="{{ route('kategori.destroy',[$row->kd_kategori]) }}" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini ?')">
                                @csrf
                                {{ method_field('DELETE') }}
                                <a class="btn btn-warning" href="{{ route('kategori.edit',[$row->kd_kategori]) }}">Edit</a>
                                <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $kategori->appends(Request::all())->links() }}
            </div>
          </div>
        </div>
</div>
@endsection