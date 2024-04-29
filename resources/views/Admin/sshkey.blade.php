@extends('Admin.leading._AdminLayout')

@section('title')
    SSH-KEY
@stop

@section('css')
    <style>

    </style>
@stop

@section('content')
    <div style="margin-left: 1%; width: 98%; padding: 16px 0px;">
        <form action="" method="GET">
            <table>
                <tr>
                </tr>
            </table>
        </form>
    </div>
    <table class="table table-sm table-bordered table-hover text-center" style="margin-left: 1%; width: 8%; font-size: 14px;">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">使用者</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $k => $v)
                <tr>
                    <th>{{ $k+1 }}</th>
                    <th class="text-left">{{ $v->name }}</th>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div id="__Pagination">{{ $data->links() }}</div>
@stop

@section('js')
    @include('Admin.leading.setSearch')
    <script>
        $(function() {

        });
    </script>
    @include('Admin.leading.setPaginationLocation')
@stop
