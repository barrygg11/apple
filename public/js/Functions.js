function Msg(type = 'info', msg = '哇！訊息未描述..') {
    return Swal.mixin({
        showConfirmButton: false,
        toast: true,
        position: 'top',
        timerProgressBar: true,
        timer: 3000
    }).fire({icon: type, title: msg});
}

function SiteStatus(thisStatus = null) {
    switch (thisStatus) {
        case 'RUNNING':
            return '<span style="color: #00C853;">RUNNING</span>';
            break;
        case 'TERMINATED':
            return '<span class="text-danger">TERMINATED</span>';
            break;
    }
    return '不明狀態';
}

function AdminType(thisType = null) {
    switch (thisType) {
        case '1':
            return '<span class="text-danger">超級管理員</span>';
            break;
        case '2':
            return '<span class="text-primary">管理員</span>';
            break;
        case '3':
            return '<span>一般人員</span>';
            break;
    }
    return '不明類型';
}

function LbStatus(thisStatus = null) {
    switch (thisStatus) {
        case 'allow':
            return '<span style="color: #00C853;">allow</span>';
            break;
        case 'deny(403)':
            return '<span class="text-danger">deny(403)</span>';
            break;
    }
    return '不明狀態';
}
