@extends('Admin.leading._AdminLayout')

@section('title')
    帳戶設定
@stop

@section('css')
    <style>
        body {
            background-color: #ecf0f5;
        }
        .container-fluid {
            max-width: 50%;
        }
        hr {
            margin: 8px 0px;
        }
        .row {
            margin: 16px 0px;
        }
    </style>
@stop

@section('content')
    <br />
    <br />
    <div style="padding: 24px; background-color: #FFFFFF;">
        <div class="text-danger" style="padding: 0px 15px; font-size: 32px;"><b>帳戶設定</b></div>
        <hr>
        <div class="row">
            <div class="col">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">帳 號</span>
                    </div>
                    <input type="text" class="form-control" value="{{ $data->username }}" disabled="disabled" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">用戶名稱</span>
                    </div>
                    <input type="text" class="form-control" id="name" value="{{ $data->name }}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">當前密碼</span>
                    </div>
                    <input type="password" class="form-control" id="password" value="********" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">新密碼</span>
                    </div>
                    <input type="password" class="form-control" id="new_password" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">二次密碼</span>
                    </div>
                    <input type="password" class="form-control" id="new_password2" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button type="button" class="btn btn-primary" style="width: 100%;" onclick="saveSetting()">更新設置</button>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(function() {

        });

        function saveSetting() {
            let name = $('#name').val(),
                password = $('#password').val(),
                new_password = $('#new_password').val(),
                new_password2 = $('#new_password2').val();
            if ( name == '' ) {
                Msg('error', '用戶名稱');
                return;
            }
            if ( new_password != '' ) {
                if ( password == '' ) {
                    Msg('error', '當前密碼');
                    return;
                }
                if ( new_password2 == '' ) {
                    Msg('error', '二次密碼');
                    return;
                }
            }
            if ( new_password2 != '' ) {
                if ( password == '' ) {
                    Msg('error', '當前密碼');
                    return;
                }
                if ( new_password == '' ) {
                    Msg('error', '新密碼');
                    return;
                }
            }
            if ( new_password != '' && new_password2 != '' ) {
                if ( password == new_password || password == new_password2 ) {
                    Msg('error', '新密碼不得一樣');
                    return;
                }
                if ( new_password != new_password2 ) {
                    Msg('error', '密碼不一致');
                    return;
                }
            }
            $.ajax({
                method: "POST",
                dataType: "json",
                url: "{{ route('ajaxSetSetting') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    name: name,
                    password: password,
                    new_password: new_password,
                    new_password2: new_password2
                },
                success: function(res) {
                    if ( res.status ) {
                        {{-- if ( typeof res.url != 'undefined' ) { document.location.href = res.url; } --}}
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
    </script>
@stop
