@extends('Admin.leading._AdminLayout')

@section('title')
    專案版號
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
                    {{-- <td>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">地區</span>
                            </div>
                            <select class="form-control" id="zone" name="zone">
                            </select>
                        </div>
                    </td> --}}
                    <td>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">專案名稱</span>
                            </div>
                            <select class="form-control" id="project" name="project">
                                <option value="">全部</option>
                                @foreach ($list as $lists)
                                    <option value="{{ $lists['project'] }}">{{ $lists['project'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="input-group">
                            <input type="submit" class="btn btn-primary" value="搜尋" />
                            <button type="button" class="btn btn-danger" onclick="SearchClear()">清除</button>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <table class="table table-sm table-bordered table-hover text-center" style="margin-left: 1%; width: 98%; font-size: 14px;">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">專案名稱</th>
                <th scope="col">Tag</th>
                <th scope="col">Commit</th>
                <th scope="col">佈置者</th>
                <th scope="col">時間</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $k => $v)
                <tr>
                    <th>{{ $k+1 }}</th>
                    <th>{{ $v->project }}</th>
                    <td class="text-left">{{ $v->tag }}</td>
                    <td>{{ $v->commit }}</td>
                    <td>{{ $v->deployer }}</td>
                    <td>{{ $v->created_at }}</td>
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
