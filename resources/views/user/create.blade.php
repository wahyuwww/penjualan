@extends('layouts.template')
@section('title')
Tambah data
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                @include('alert.error')
            </div>
            <div class="box-body">
                <form class="form-horizontal" method="post" action="{{ route('user.store') }}">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="nama" class="col-sm-2 control-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="username" name="username"
                                    value="{{ old('usernames') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password" name="password" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">Level</label>
                            <div class="col-sm-10">
                                <select name="level" id="level" class="form-control">
                                    <option value="admin">Administrator</option>
                                    <option value="staff">Staff</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" name="tombol" class="btn btn-info pull-right">Save</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
</div>
@endsection