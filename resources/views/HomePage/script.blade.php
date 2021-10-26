<script type="text/javascript">
    $(document).ready(function () {
        console.log(123)
        setTimeSessionAttendance();
    });
    function socket() {
        $.ajax({
            url: '/game.json?' + Date.now(), success: function (data) {
                onMessage(data)
                setTimeout(function () {
                    socket()
                }, 1000);
            }, error: function (data) {
                setTimeout(function () {
                    socket()
                }, 1000);
            }
        })
    }

    let old = 0;
    let timenew = 0;
    let timelast = 0;
    function setTimeSessionAttendance() {
    setInterval(function () {
        console.log(123)
        timelast--;
        let checktime = Math.abs(timelast - timenew);
        if (checktime > 10) {
            timelast = timenew;
        }
        if (timelast < 0) timelast = 0;
        $("#diemdanh_thoigian").html(timelast);
        $("#thoigian_head").html(timelast);
    }, 1000);
    }
    function diemdanh() {
        if ($("#phonevalue").val().length <= 9) {
            alert(`Khong hop le`);
            return false;
        }
        let num1 = getRndInteger(1, 9);
        let num2 = getRndInteger(1, 9);
        let person = prompt("XÃ¡c minh báº¡n lÃ  há»c sinh giá»i toÃ¡n " + num1 + "+" + num2 + "= ?:", "");
        if (person == null || person != (num1 + num2)) {
            alert(` Báº¡n Ä‘Ã£ nháº­p sai phÃ©p tÃ­nh, vui lÃ²ng thá»­ láº¡i`);
            return false;
        }
        $.ajax({
            url: '/diemdanh.json', data: {phone: $("#phonevalue").val(), captcha: person}, type: 'POST', success: function (d) {
                alert(d);
                $("#phonevalue").val(``)
            }
        })
    }
</script>
