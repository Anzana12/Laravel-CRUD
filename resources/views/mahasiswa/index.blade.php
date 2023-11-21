@extends('layouts.app')
@section('content')
 
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Data Alumni</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>
    <body>
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h3> Daftar Dosen Teknik Informatika</h3>
            </div>
            <div class="col-sm-2">
                <a class="btn btn-success" href="{{ route('mahasiswa.create')}}"> Tambah Alumni </a>
            </div>
        </div> 
        <br>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{$message}}</p>        
        </div>
    @endif

    <table id="tabel" class="table table-striped">
      <thead>
        <tr>
            <th width="40px"><b>No.</b></th>
            <th width="180px">Nama Dosen</th>
            <th width="100px">NIP</th>
            <th width="100px">Tingkat Pendidikan</th>
            <th >Mata Kuliah</th>
            <th width="210px">Action</th>
        </tr>
      </thead>
        @foreach ($dosen->data as $dos) 
            <tr>
                <td><b>{{++$i}}.<b></td>
                <td>{{$dos->nama_dosen}}</td>
                <td>{{$dos->nip}}</td>
                <td align="center">{{$dos->tingkat_pendidikan}}</td>
                <td>{{$dos->mata_kuliah}}</td>
                <td>
                    <form action="{{ url('/mahasiswa/'.'1'.'/delete') }}" method="post">
                        <input type="hidden" name="_rev" value="">
                        <a class="btn btn-sm btn-success" href="{{ route('mahasiswa.show', '1')}}">Show</a>
                        <a class="btn btn-sm btn-warning" href="{{ route('mahasiswa.edit', '1')}}">Edit</a>
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>    
                </td>
            </tr>
        @endforeach
    </table>

    </div>
    </body>

</html>

@endsection

@section('style')
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
@endsection

@section('script')
<script type="text/javascript" src="//code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
    $.noConflict();
    jQuery( document ).ready(function( $ ) {
        $('#tabel').DataTable();
    });
</script>
@endsection