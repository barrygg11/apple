@extends('Admin.leading._AdminLayout')

@section('title')
    查詢機器
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
                                <span class="input-group-text">狀態</span>
                            </div>
                            <select class="form-control" id="status" name="status">
                                <option value="">全部</option>
                                <option value="RUNNING">運行中</option>
                                <option value="TERMINATED">已終止</option>
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">機器名稱</span>
                            </div>
                            <input type="text" class="form-control" id="name" name="name" />
                        </div>
                    </td>
                    <td>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">內部IP</span>
                            </div>
                            <input type="text" class="form-control" id="network_ip" name="network_ip" size="12"/>
                        </div>
                    </td>
                    <td>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">外部IP</span>
                            </div>
                            <input type="text" class="form-control" id="nat_ip" name="nat_ip" size="12"/>
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
                {{-- <th scope="col">專案名稱</th> --}}
                <th scope="col">ID</th>
                <th scope="col">機器名稱</th>
                <th scope="col">地區</th>
                <th scope="col">內部IP</th>
                <th scope="col">外部IP</th>
                <th scope="col">機器規格</th>
                <th scope="col">狀態</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $k => $v)
                <tr>
                    {{-- <th>{{ $v->project }}</th> --}}
                    <td>{{ $k+1 }}</td>
                    <td>{{ $v->name }}</td>
                    <td>{{ $v->zone }}</td>
                    <td>{{ $v->network_ip }}</td>
                    <td>{{ $v->nat_ip }}</td>
                    <td>{{ $v->machine_type }}</td>
                    <td class="siteStatus" siteStatusAttr="{{ $v->status }}"></td>
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
            $('.siteStatus').each(function() {
                $(this).html((`<b>` + SiteStatus($(this).attr('siteStatusAttr')) + `</b>`));
            });
        });
    </script>
    @include('Admin.leading.setPaginationLocation')
@stop
