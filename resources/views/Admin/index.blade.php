@extends('Admin.leading._AdminLayout')

@section('title')
    公告
@stop

@section('css')
    <style>

    </style>
@stop

@section('content')
    @if ($UserConfig->type == 1)
        <br />
        <div class="row" style="margin: 0px; padding: 0px 1%;">
            <div class="col" style="padding: 0px;">
                <button type="button" class="btn btn-primary" onclick="showAnnouncement()">新 增 公 告</button>
            </div>
        </div>
    @endif
    <br />
    <table class="table table-sm table-bordered table-hover text-center" style="margin-left: 1%; width: 98%; font-size: 14px;">
        <thead class="thead-dark">
            <tr>
                <th scope="col">編號</th>
                <th scope="col">發布日期</th>
                <th scope="col">發布單位</th>
                <th scope="col">發布者</th>
                <th scope="col">訊息</th>
                @if ($UserConfig->type == 1)
                    <th scope="col">操作</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $k => $v)
                <tr>
                    <th>{{ $v->id }}</th>
                    <td>{{ date('Y-m-d', strtotime($v->create_time)) }}</td>
                    <td>{{ $v->unit }}</td>
                    <td>{{ $v->personnel }}</td>
                    <td class="text-left">{{ $v->content }}</td>
                    @if ($UserConfig->type == 1)
                        <td>
                            <button type="button" class="btn btn-danger" onclick="delAnnouncementBtn({{ $v->id }})">刪除</button>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    <div id="__Pagination">{{ $data->links() }}</div>
@stop

@section('modal')
    <!-- 新增公告 Modal -->
    <div class="modal fade _AnnouncementModal" id="AnnouncementModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <table style="margin: 1.5em; padding: 0px 7.5%;">
                    <tr>
                        <td>
                            <label class="text-success" style="font-size: 1.5em;"><b>新增公告</b></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">單 位</span>
                                </div>
                                <input type="text" class="form-control" id="_ModalUnit" />
                            </div>
                        </td>
                    <tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">發布者</span>
                                </div>
                                <input type="text" class="form-control" id="_ModalPersonnel" />
                            </div>
                        </td>
                    <tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">訊 息</span>
                                </div>
                                <textarea class="form-control" id="_ModalMessage" style="height: 320px;"></textarea>
                            </div>
                        </td>
                    <tr>
                    <tr style="float: right;">
                        <td>
                            <button type="button" class="btn btn-primary" onclick="addAnnouncement()">新增</button>
                        </td>
                    <tr>
                </table>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(function() {

        });

        function showAnnouncement() {
            $('#AnnouncementModal').modal('show');
            $('#_ModalUnit').val('');
            $('#_ModalPersonnel').val('');
            $('#_ModalMessage').val('');
        }

        function addAnnouncement() {
            let unit = $('#_ModalUnit').val(),
                personnel = $('#_ModalPersonnel').val(),
                message = $('#_ModalMessage').val();
            if ( unit == '' ) {
                Msg('error', '請輸入單位');
                return;
            }
            if ( personnel == '' ) {
                Msg('error', '請輸入人員');
                return;
            }
            if ( message == '' ) {
                Msg('error', '請輸入訊息');
                return;
            }
            $.ajax({
                method: "POST",
                dataType: "json",
                url: "{{ route('ajaxAddAnnouncement') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    unit: unit,
                    personnel: personnel,
                    message: message
                },
                success: function(res) {
                    if ( res.status ) {
                        Msg('success', res.msg);
                        setTimeout(() => { document.location.href = ""; }, 800);
                        return;
                    }
                    Msg('error', res.msg);
                },
                error: function(err) {
                    Msg('error', '系統例外錯誤');
                    console.log(err.responseJSON.message);
                }
            });
        }

        function delAnnouncementBtn(thisID = 0) {
            if ( thisID == 0 ) { Msg('error', '非法操作 - 資料ID不合法'); return; }
            Swal.fire({
                icon: 'warning',
                title: '確定刪除資料？',
                showCancelButton: true,
                confirmButtonColor: '#DC3545',
                cancelButtonColor: '#007BFF',
                confirmButtonText: '確定',
                cancelButtonText: '再等一下'
            }).then((result) => {
                if ( result.isConfirmed ) {
                    $.ajax({
                        method: "POST",
                        dataType: "json",
                        url: "{{ route('ajaxDelAnnouncement') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            thisID: thisID
                        },
                        success: function(res) {
                            if ( res.status ) {
                                Msg('success', res.msg);
                                setTimeout(() => { document.location.href = ""; }, 800);
                                return;
                            }
                            Msg('error', res.msg);
                        },
                        error: function(err) {
                            Msg('error', '系統例外錯誤');
                            console.log(err.responseJSON.message);
                        }
                    });
                }
            });
        }
    </script>
    @include('Admin.leading.setPaginationLocation')
@stop
