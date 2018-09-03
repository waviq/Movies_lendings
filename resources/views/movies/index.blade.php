@extends('layouts.main_layout')
@section('content')
    <div class="row" id="app">
            <movies></movies>
    </div>
@endsection

@section('css_custom')
    <link rel="stylesheet" href="{{asset('plugins/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@section('js_custom')
    <script src="{{asset('plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script>
        $(function () {
            $('#moviesTables').DataTable()
        })
    </script>
@endsection