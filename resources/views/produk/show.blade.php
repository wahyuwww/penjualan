@extends('layouts.template')

@section('title')
Data User
@endsection

@section('content')
<div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
            <a href="{{ route('user.index') }}" class="btn btn-success">Back</a>
            </div>
            <div class="box-body">

            <table class="table table-bordered">
              <tr>
                <td>Username</td>
                <td>:</td>
                <td>{{ $user->username }}</td>
              </tr>
              <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{ $user->name }}</td>
              </tr>
              <tr>
                <td>Email</td>
                <td>:</td>
                <td>{{ $user->email }}</td>
              </tr>
              <tr>
                <td>Level</td>
                <td>:</td>
                <td>{{ $user->level }}</td>
              </tr>
            </table>            

            </div>
          </div>
        </div>
</div>
@endsection