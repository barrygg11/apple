@extends('Admin.leading._AdminLayout')

@section('title')
    查詢加白名單
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
                                <span class="input-group-text">名稱</span>
                            </div>
                            <select class="form-control" id="name" name="name">
                                <option value="">全部</option>
                                @foreach ($rules_list as $list)
                                    <option value="{{ $list['name'] }}">{{ $list['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </td>
                    <!-- <td>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">機器名稱</span>
                            </div>
                            <input type="text" class="form-control" id="name" name="name" />
                        </div>
                    </td> -->
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
                {{-- <th scope="col">專案名稱</th> --}}
                <th scope="col">名稱</th>
                <th scope="col">優先順序</th>
                <th scope="col">IP位址/範圍 </th>
                <th scope="col">動作</th>
                <th scope="col">說明</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $k => $v)
                <tr>
                    {{-- <th>{{ $v->project }}</th> --}}
                    <td class="text-left">{{ $v->name }}</td>
                    <td class="text-left">{{ $v->order }}</td>
                    <td class="text-left">{{ $v->ip }}</td>
                    <td class="lbStatus" lbStatusAttr="{{ $v->status }}"></td>
                    <td class="text-left">{{ $v->description }}</td>
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
            $('.lbStatus').each(function() {
                $(this).html((`<b>` + LbStatus($(this).attr('lbStatusAttr')) + `</b>`));
            });
        });
    </script>
    @include('Admin.leading.setPaginationLocation')
@stop
