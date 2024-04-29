@extends('Admin.leading._AdminLayout')

@section('title')
    權限管控
@stop

@section('css')

@stop

@section('content')
    <div style="margin-left: 1%; width: 98%; padding: 16px 0px;">
        <table>
            <tr>
                <td>
                    <button type="button" class="btn btn-primary" onclick="showAdmin()">新增人員</button>&emsp;
                </td>
            </tr>
        </table>
    </div>
    <table class="table table-sm table-bordered table-hover text-center" style="margin-left: 1%; width: 98%; font-size: 14px;">
        <thead class="thead-dark">
            <tr>
                <th scope="col">編號</th>
                <th scope="col">人員類型</th>
                <th scope="col">用戶名稱</th>
                <th scope="col">帳號</th>
                <th scope="col">說明</th>
                <th scope="col">操作</th>
                <th scope="col">創建時間</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $k => $v)
                <tr>
                    <th>{{ $v->id }}</th>
                    <td class="adminType" adminTypeAttr="{{ $v->AdminConfig->type }}"></td>
                    <td>{{ $v->name }}</td>
                    <td>{{ $v->username }}</td>
                    <td>{{ $v->AdminConfig->remark }}</td>
                    <td>
                        <a href="#" onclick="adminBtn('password', {{ $v->id }})">更改密碼</a>
                        <button type="button" class="btn btn-danger" onclick="delAdminBtn({{ $v->id }})">刪除</button>
                    </td>
                    <td>{{ $v->AdminConfig->create_time }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div id="__Pagination">{{ $data->links() }}</div>
@stop

@section('modal')
    <!-- 新增管理員 Modal -->
    <div class="modal fade _AdminModal" id="AdminModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <table style="margin: 1.5em; padding: 0px 7.5%;">
                    <tr>
                        <td>
                            <label class="text-success" style="font-size: 1.5em;"><b>新增人员</b></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">身分類型</span>
                                </div>
                                <select class="form-control" id="_ModalType">
                                    {{-- <option value="1" selected>超級管理員</option> --}}
                                    <option value="2" selected>管理員</option>
                                    <option value="3">一般人員</option>
                                </select>
                            </div>
                        </td>
                    <tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">名稱</span>
                                </div>
                                <input type="text" class="form-control" id="_ModalName" />
                            </div>
                        </td>
                    <tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">帳號</span>
                                </div>
                                <input type="text" class="form-control" id="_ModalAccount" />
                            </div>
                        </td>
                    <tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">密碼</span>
                                </div>
                                <input type="password" class="form-control" id="_ModalPassword" />
                            </div>
                        </td>
                    <tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">二次密碼</span>
                                </div>
                                <input type="password" class="form-control" id="_ModalPassword2" />
                            </div>
                        </td>
                    <tr>
                    <tr style="float: right;">
                        <td>
                            <button type="button" class="btn btn-primary" onclick="addAdmin()">新增</button>
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
            $('.adminType').each(function() {
                $(this).html((`<b>` + AdminType($(this).attr('adminTypeAttr')) + `</b>`));
            });
        });

        function showAdmin() {
            $('#AdminModal').modal('show');
            $('#_ModalType').val('2');
            $('#_ModalName').val('');
            $('#_ModalAccount').val('');
            $('#_ModalPassword').val('');
            $('#_ModalPassword2').val('');
        }

        function addAdmin() {
            let type = $('#_ModalType').val(),
                name = $('#_ModalName').val(),
                account = $('#_ModalAccount').val(),
                password = $('#_ModalPassword').val(),
                password2 = $('#_ModalPassword2').val();
            if ( type != 1 && type != 2 && type != 3 ) {
                Msg('error', '身份類型錯誤');
                return;
            }
            if ( name == '' ) {
                Msg('error', '請輸入用戶名稱');
                return;
            }
            if ( account == '' ) {
                Msg('error', '請輸入帳號');
                return;
            }
            if ( password == '' ) {
                Msg('error', '請輸入密碼');
                return;
            }
            if ( password2 == '' ) {
                Msg('error', '請輸入二次密碼');
                return;
            }
            if ( password !== password2 ) {
                Msg('error', '密碼輸入不一致');
                return;
            }
            $.ajax({
                method: "POST",
                dataType: "json",
                url: "{{ route('ajaxAddAdmin') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    type: type,
                    name: name,
                    account: account,
                    password: password,
                    password2: password2
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

        async function adminBtn(type, thisID = 0) {
            let thisType, thisMsg;
            switch (type) {
                case 'password':
                    thisType = type;
                    if ( type == 'password' ) { thisMsg = '帳戶密碼'; }
                    break;
                default:
                    Msg('error', '非法操作 - 不合法的類型'); return;
                    break;
            }
            if ( typeof thisType == "undefined" ) { Msg('error', '不合法的數值'); return; }
            if ( thisType == '' ) { Msg('error', '不合法的數值'); return; }
            let { value: _thisInputText } = await Swal.fire({
                icon: 'info',
                input: 'text',
                title: ('正在修改' + thisMsg),
                inputPlaceholder: ('請輸入管理員' + thisMsg),
                showCancelButton: true,
                confirmButtonColor: '#DC3545',
                cancelButtonColor: '#007BFF',
                confirmButtonText: '修改',
                cancelButtonText: '取消'
            });
            if ( _thisInputText ) {
                $.ajax({
                    method: "POST",
                    dataType: "json",
                    url: "{{ route('ajaxSetAdmin') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        thisID: thisID,
                        type: thisType,
                        value: _thisInputText
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
        }

        function delAdminBtn(thisID = 0) {
            if ( thisID == 0 ) { Msg('error', '非法操作 - 管理員ID不合法'); return; }
            Swal.fire({
                icon: 'warning',
                title: '確定刪除管理員？',
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
                        url: "{{ route('ajaxDelAdmin') }}",
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
