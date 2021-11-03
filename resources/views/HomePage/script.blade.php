<script type="text/javascript">
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        @if($canAttendance)
        setTimeSessionAttendance();
        @endif
    });

    function socket() {
        $.ajax({
            url: '{{ route('home.attendance.realtime') }}',
            type: 'post',
            success: function (data) {
                let result = JSON.parse(data);
                $('.diemdanh_users').html(result.count_users_attendance);
                $('#diemdanh_last').html(result.phone_win_latest);
                $('#diemdanh_id').html(result.session_current_code);
                $('#muc_users').html(result.phones_attendance);
                $('#mayman_log').html(result.view_list_session_past);
                $("#diemdanh_tongtien").html(result.total_amount);
            }, error: function (data) {
            }
        })
    }

    var timelast = Number('{{ $secondRealTime }}');

    function setTimeSessionAttendance() {
        setInterval(function () {
            if (timelast > 0) {
                timelast--;
            }else{
                timelast = Number('{{ $timeEach }}');
            }
            $("#thoigian_head").html(timelast);
            $("#diemdanh_thoigian").html(timelast);
            if (timelast%2 == 0)
                socket();
        }, 1000);
    }

    function diemdanh() {
        if ($("#phonevalue").val().length <= 9) {
            alert(`Khong hop le`);
            return false;
        }
        let num1 = Number('{{ random_int(1,9) }}');
        let num2 = Number('{{ random_int(1,9) }}');
        let person = prompt("Mã xác minh " + num1 + "+" + num2 + "= ?:", "");
        if (person == null || person != (num1 + num2)) {
            alert(`Bạn đã nhập sai phép tính. Vui lòng thử lại`);
            return false;
        }
        $.ajax({
            url: '{{ route('home.attendance_session') }}',
            data: {phone: $("#phonevalue").val(), captcha: person},
            type: 'POST',
            success: function (data) {
                if (data.status == 2) {
                    alert(data.message);
                } else {
                    alert("Điểm danh thành công!");
                    num1 = Number('{{ random_int(1,9) }}');
                    num2 = Number('{{ random_int(1,9) }}');
                    $("#phonevalue").val(``)
                }
            }
        })
    }
</script>
