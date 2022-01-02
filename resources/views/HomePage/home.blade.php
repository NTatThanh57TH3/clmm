@extends('layouts.app')

@section('style')
    <style>
        .aa:hover,
        .aa:focus {
            background: #ad4105;
            border-radius: 5px
        }

        .my-element {
            --animate-repeat: 20000;
        }

        center.solid {
            border-style: solid;
        }
        #button-diemdanh-ngay {
            background-color: #004A7F;
            border: none;
            color: #FFFFFF;
            cursor: pointer;
            display: inline-block;
            font-size: 20px;
            padding: 10px 10px;
            text-align: center;
            text-decoration: none;
        }
        @-webkit-keyframes glowing {
            0% { background-color: #004A7F; -webkit-box-shadow: 0 0 3px #004A7F; }
            50% { background-color: #0094FF; -webkit-box-shadow: 0 0 10px #0094FF; }
            100% { background-color: #004A7F; -webkit-box-shadow: 0 0 3px #004A7F; }
        }

        @-moz-keyframes glowing {
            0% { background-color: #004A7F; -moz-box-shadow: 0 0 3px #004A7F; }
            50% { background-color: #0094FF; -moz-box-shadow: 0 0 10px #0094FF; }
            100% { background-color: #004A7F; -moz-box-shadow: 0 0 3px #004A7F; }
        }

        @-o-keyframes glowing {
            0% { background-color: #004A7F; box-shadow: 0 0 3px #004A7F; }
            50% { background-color: #0094FF; box-shadow: 0 0 10px #0094FF; }
            100% { background-color: #004A7F; box-shadow: 0 0 3px #004A7F; }
        }

        @keyframes glowing {
            0% { background-color: #004A7F; box-shadow: 0 0 3px #004A7F; }
            50% { background-color: #0094FF; box-shadow: 0 0 10px #0094FF; }
            100% { background-color: #004A7F; box-shadow: 0 0 3px #004A7F; }
        }

        #button-diemdanh-ngay {
            -webkit-animation: glowing 1500ms infinite;
            -moz-animation: glowing 1500ms infinite;
            -o-animation: glowing 1500ms infinite;
            animation: glowing 1500ms infinite;
        }
    </style>
@endsection

@section('script')
    <script>
        function copyStringToClipboard(str) {
            // Create new element
            var el = document.createElement('textarea');
            // Set value (string to be copied)
            el.value = str;
            // Set non-editable to avoid focus and move outside of view
            el.setAttribute('readonly', '');
            el.style = {position: 'absolute', left: '-9999px'};
            document.body.appendChild(el);
            // Select text inside element
            el.select();
            // Copy text to clipboard
            document.execCommand('copy');
            // Remove temporary element
            document.body.removeChild(el);
        }

        function coppy(text) {
            copyStringToClipboard(text);
            alert('Đã sao chép số điện thoại này. Chúc bạn may mắn.');
        }

        function njs(_0x90f8x4) {
            var _0x90f8x20 = String(_0x90f8x4);
            var _0x90f8x21 = _0x90f8x20['length'];
            var _0x90f8x22 = 0;
            var _0x90f8x23 = '';
            var _0x90f8xa;
            for (_0x90f8xa = _0x90f8x21 - 1; _0x90f8xa >= 0; _0x90f8xa--) {
                _0x90f8x22 += 1;
                aa = _0x90f8x20[_0x90f8xa];
                if (_0x90f8x22 % 3 == 0 && _0x90f8x22 != 0 && _0x90f8x22 != _0x90f8x21) {
                    _0x90f8x23 = '.' + aa + _0x90f8x23
                } else {
                    _0x90f8x23 = aa + _0x90f8x23
                }
            }
            ;
            return _0x90f8x23
        }

        function numanimate_2(_0x90f8x4, _0x90f8x2a, _0x90f8x19) {
            var _0x90f8x3c = Math['floor'](_0x90f8x19);
            var _0x90f8x39 = Math['floor'](_0x90f8x4['val']());
            var _0x90f8x3a = (Math['floor'](_0x90f8x2a) - Math['floor'](_0x90f8x4['val']())) / _0x90f8x3c;
            (function _0x90f8x2c(_0x90f8xa) {
                setTimeout(function () {
                    _0x90f8x4['html'](njs(Math['floor'](_0x90f8x39 + (_0x90f8x3c + 1 - _0x90f8xa) *
                        _0x90f8x3a)));
                    if (--_0x90f8xa) {
                        _0x90f8x2c(_0x90f8xa)
                    } else {
                        _0x90f8x4['val'](_0x90f8x2a)
                    }
                }, 40)
            })(_0x90f8x3c)
        }

        function clickhu() {
            $.ajax({
                url: "{{ url('/api/load-hu') }}",
                success: function (d) {
                    let tientronghu = d.tongtien_format;
                    let listsdt = '';
                    let sotienchuyen = d.sotienchuyen;

                    for (var i in d.list_sdt) {
                        listsdt = listsdt + d.list_sdt[i]['sdt'] + ', '
                    }

                    listsdt = listsdt.substr(0, listsdt.length - 2);

                    $("#result_hu").html(
                        ' <center><img class="animate__animated animate__heartBeat animate__infinite infinite" src="{{ asset('/image/hu.png') }}" width="30%" style=""></center> <center class="solid" style="border-top-right-radius: 30px; border-top-left-radius: 30px; border-radius: 30px; background: aquamarine;"><p class="animate__animated animate__shakeX animate__infinite infinite animate__slow 2" id="hxu"><b>' + tientronghu + ' VNĐ</b></p></center> <br> <hr><center>Hướng dẫn </center> - Để tham gia hạn hãy chuyển <b>' + sotienchuyen + 'đ</b> vào 1 trong các tài khoản sau đây <b>' + listsdt + '</b> kèm nội dung <b>h1</b> nếu như 4 số đuôi mã giao dịch giống nhau bạn sẽ nhận toàn bộ số tiền trong hũ (ví dụ mã giao dịch <b>871235555</b> thì 4 số đuôi là đều là 5 nên bạn sẽ nhận được toàn bộ tiền xong hũ).'
                    );
                    $("#hugame").modal();
                }
            })
        }

        $(document).ready(function () {

            $("button[data-action=huongdan]").click((e) => {
                $("#myModal").modal("show");
            });

            $("span[data-action=phan-thuong]").click((e) => {
                $("#modalGift").modal("show");
            });

            $('button[server-action=change]').click(function () {
                let button = $(this);
                let id = button.attr('server-id');
                selection_server = id;
                selection_rate = button.attr('server-rate');

                $('.turn').removeClass('active');
                console.log(`.turn[turn-tab=${id}]`)
                $(`.turn[turn-tab=${id}]`).addClass('active');

                $('button[server-action=change]').attr('class', 'btn btn-default');
                button.attr('class', 'btn btn-primary');

            });

            $('button[bot-action=change]').click(function () {
                let button = $(this);
                let id = button.attr('bot-id');

                $('.bot').removeClass('active');
                $(`.bot[bot-tab=${id}]`).addClass('active');

                $('button[bot-action=change]').attr('class', 'btn btn-default');
                button.attr('class', 'btn btn-primary');
            });
        });

        function loadhu() {
            $.ajax({
                url: "{{ url('/api/get-hu') }}",
                success: function (d) {
                    let tientronghu = d.tongtien;
                    numanimate_2($('#hu'), tientronghu, 17);
                }
            })
        }

        loadhu();
        setInterval(function () {
            loadhu();
        }, 10000);
    </script>
    <script type="text/javascript">
                      function myFunction() {
                      document.getElementById("modal_thongbao").style.display='none';
                    }
                      function validateForm() {
                      var magiaodich = $("#magiaodich").val();
                    if (magiaodich === "") {
                    alert("Chưa nhập mã giao dịch");
                return false;
        }
    }
    </script>
    @include('HomePage.script')

    @php
        $chon = false;
    @endphp

    @if($GetSetting->on_chanle == 1)
        @if($chon == false)
            <script>
                $(document).ready(function () {
                    $('button[server-id=1000]').click();
                    $('button[bot-id=1000]').click();
                });
            </script>
            @php
                $chon = true
            @endphp
        @endif
    @endif

    @if($GetSetting->on_taixiu == 1)
        @if($chon == false)
            <script>
                $(document).ready(function () {
                    $('button[server-id=10000]').click();
                    $('button[bot-id=10000]').click();
                });
            </script>
            @php
                $chon = true
            @endphp
        @endif
    @endif

    @if($GetSetting->on_chanle2 == 1)
        @if($chon == false)
            <script>
                $(document).ready(function () {
                    $('button[server-id=1]').click();
                    $('button[bot-id=1]').click();
                });
            </script>
            @php
                $chon = true
            @endphp
        @endif
    @endif

    @if($GetSetting->on_gap3 == 1)
        @if($chon == false)
            <script>
                $(document).ready(function () {
                    $('button[server-id=2]').click();
                    $('button[bot-id=1]').click();
                });
            </script>
            @php
                $chon = true
            @endphp
        @endif
    @endif

    @if($GetSetting->on_tong3so == 1)
        @if($chon == false)
            <script>
                $(document).ready(function () {
                    $('button[server-id=5]').click();
                    $('button[bot-id=1]').click();
                });
            </script>
            @php
                $chon = true
            @endphp
        @endif
    @endif

    @if($GetSetting->on_1phan3 == 1)
        @if($chon == false)
            <script>
                $(document).ready(function () {
                    $('button[server-id=6]').click();
                    $('button[bot-id=1]').click();
                });
            </script>
            @php
                $chon = true
            @endphp
        @endif
    @endif

    @if (\Session::has('message'))
        <script src="{{ asset('js/sweetalert.min.js') }}"></script>
        <script>
            swal("Thông báo", "{{ \Session::get('message') }}", "{{ \Session::get('status') }}");
        </script>
    @endif
@endsection

@section('content')
    <div class="mainbar hidden-xs">
        <div class="container">

        </div>
    </div>

    <div class="container">
        <div class="content">
            <div class="content-container">
                <div class="py-5" style="min-height:80px !important;">
                    <div class="output" id="output">
                        <h3 class="cursor"></h3>
                        <h4></h4>
                    </div>
                </div>

                <center>
                    <a href="{{ $GetSetting->linkvideoyoutube }}" style="border-color: #ad4105;
            border: solid;">VIDEO HƯỚNG DẪN</a>

                </center>


                <div class="text-center mt-5">
                    <div class="btn-group btn-group-lg" role="group" aria-label="...">
                        <div class="btn-group btn-group-lg" role="group" aria-label="...">
                            @if($GetSetting->on_chanle == 1)
                                <button class="btn btn-default" server-action="change" server-id="1000" server-rate="1000">
                                    Chẵn Lẻ
                                </button>
                            @endif

                            @if($GetSetting->on_taixiu == 1)
                                <button class="btn btn-default" server-action="change" server-id="10000" server-rate="10000">
                                    Tài xỉu
                                </button>
                            @endif

                            @if($GetSetting->on_chanle2 == 1)
                                <button class="btn btn-default" server-action="change" server-id="1" server-rate="1">
                                    Chẵn Lẻ Tài Xỉu 2
                                </button>
                            @endif

                            @if($GetSetting->on_gap3 == 1)
                                <button class="btn btn-default" server-action="change" server-id="2" server-rate="1">
                                    Gấp 3
                                </button>
                            @endif

                            @if($GetSetting->on_tong3so == 1)
                                <button class="btn btn-default" server-action="change" server-id="5" server-rate="1">
                                    Tổng 3 số
                                </button>
                            @endif

                            @if($GetSetting->on_1phan3 == 1)
                                <button class="btn btn-default" server-action="change" server-id="6" server-rate="1">
                                    1 phần 3
                                </button>
                            @endif
                        </div>
                    </div>
                    <div class="text-center mt-5">
                        <div class="btn-group btn-group-lg" role="group" aria-label="...">
                            @if(isset($checkCanAttendance) && $checkCanAttendance)
                                <button style="display:block; padding-bottom: 20px" class="btn btn-default" server-action="change"
                                        server-id="010000"
                                        server-rate="010000">
                                    Điểm danh +100k <br>
                                    <b style="
                                            top: 33px; position: absolute;
                                            /* margin: auto; */
                                            margin-left: auto;
                                            margin-right: auto;
                                            left: 0;
                                            right: 0;
                                            text-align: center;
                                            font-size: 9px;"><font color="green"><i class="fa fa-clock-o" aria-hidden="true"></i>
                                            <b id="thoigian_head">{{ $canAttendance ? $secondRealTime : $timeEach }}</b></font>
                                        <font color="6861b1"><i class="fa fa-users" aria-hidden="true"></i>
                                            <b id="users_head" class="diemdanh_users">{{ $countUsersAttendance }}</b></font></b>
                                </button>
                            @endif
                            @if(isset($checkCanAttendanceDate) && $checkCanAttendanceDate)
                                <button style="display:block;padding-bottom: 20px" class="btn btn-default " id="button-diemdanh-ngay" server-action="change"
                                        server-id="456456"
                                        server-rate="456456">
                                    Nhiệm Vụ Ngày
                                    <b style="
                                    top: 33px; position: absolute;
                                    margin-left: auto;
                                    margin-right: auto;
                                    left: 0;
                                    right: 0;
                                    text-align: center;
                                    font-size: 9px;"><font color="red">(New)</font></b>
                                </button>
                            @endif
                        </div>
                    </div>

                    <div class="row justify-content-md-center box-cl">

                        <div class="col-md-6 mt-3 cl">
                            <div class="panel panel-primary">
                                <div class="panel-heading text-center">
                                    Cách chơi
                                </div>
                                <div class="panel-body turn" turn-tab="10000" style="padding-top: 0px;">
                                    Cách chơi vô cùng đơn giản : <br>
                                    - Chuyển tiền vào một trong các tài khoản :
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover text-center">
                                            <thead>
                                            <tr role="row" class="bg-primary2">
                                                <th class="text-center text-white">Số điện thoại</th>
                                                <th class="text-center text-white">Cược tối thiểu</th>
                                                <th class="text-center text-white">Cược tối đa</th>

                                            </tr>
                                            </thead>
                                            <tbody role="alert" aria-live="polite" aria-relevant="all" id="result-table"
                                                   class="">
                                            @php
                                                $dem = 0;
                                            @endphp
                                            @foreach($Setting_TaiXiu['sdt2'] as $row)
                                                <tr>
                                                    <td id="p_27"><b id="ducnghia_27">{{ $row }}</b> <span
                                                                class="label label-success text-uppercase" onclick="coppy('{{ $row }}')"><i
                                                                    class="fa fa-clipboard" aria-hidden="true"></i></span></td>
                                                    <td>{{ number_format($Setting_TaiXiu['min']) }} VNĐ</td>
                                                    <td> {{ number_format($Setting_TaiXiu['max']) }} VNĐ</td>

                                                    @php
                                                        $dem ++;
                                                    @endphp
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <br>
                                    - Nội dung chuyển : <b>T</b> hoặc <b>X</b> (nếu đuôi mã giao dịch có các số sau) <br>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover text-center">
                                            <thead>
                                            <tr role="row" class="bg-primary2">
                                                <th class="text-center text-white">Nội dung</th>
                                                <th class="text-center text-white">Số</th>
                                                <th class="text-center text-white">Tiền nhận</th>

                                            </tr>
                                            </thead>
                                            <tbody role="alert" aria-live="polite" aria-relevant="all" id="result-table"
                                                   class="">

                                            <tr>
                                                <td><b>X</b></td>
                                                <td><code>1</code> - <code>2</code> - <code>3</code> - <code>4</code></td>
                                                <td><b>x{{ $Setting_TaiXiu['tile'] }} tiền cược</b></td>
                                            </tr>
                                            <tr>
                                                <td><b>T</b></td>
                                                <td><code>5</code> - <code>6</code> - <code>7</code> - <code>8</code></td>
                                                <td><b>x{{ $Setting_TaiXiu['tile'] }} tiền cược</b></td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>

                                    - Tiền thắng sẽ = <b>Tiền cược*{{ $Setting_TaiXiu['tile'] }}</b> <br>
                                    - <b>Lưu ý : Mức cược mỗi số khác nhau, nếu chuyển sai hạn mức hoặc sai nội dung sẽ không
                                        được hoàn tiền.</b>


                                </div>
                                <div class="panel-body turn active" turn-tab="456456" style="padding-top: 0px;">

                                    <style>
                                        #QuaTang {
                                            margin-top: 0.5rem;
                                            color: #155724;
                                            background-color: #d4edda;
                                            border-color: #c3e6cb;
                                        }

                                        #osdt {
                                            margin-top: 0.5rem;
                                            color: #155724;
                                            background-color: #9cbca4;
                                            border-color: #c3e6cb;
                                            padding: 20px;
                                        }

                                        .occho {
                                            margin-top: 0.5rem;
                                            color: #155724;
                                            background-color: #aed6b8;
                                            border-color: #c3e6cb;
                                            padding: 20px;
                                        }

                                        #othuong {
                                            margin-top: 0.5rem;
                                            color: #155724;
                                            background-color: #9cbca4;
                                            border-color: #c3e6cb;
                                            padding: 20px;
                                        }
                                    </style>

                                    <div class="row collapse show" id="QuaTang" style="">
                                        <div class="col-lg-12">
                                            <div class="body">
                                                <div class="text-center">

                                                    <font color="blue"><big><b>Nhiệm Vụ Ngày</b></big></font>
                                                    <br>


                                                    <div class="form-group occard" id="osdt">
                                                        <label for="exampleInputEmail1">Số điện thoại:</label>
                                                        <input type="text" class="form-control" id="PhoneDiemDanhNgay" aria-describedby="emailHelp"
                                                               placeholder="03837755">
                                                        <small id="emailHelp" class="form-text text-muted">Nhập số điện thoại của bạn để
                                                            điểm danh.</small>
                                                        <br>
                                                        <button class="btn btn-success" data-toggle="modal" data-target="#modalDiemDanh"
                                                                onclick="diemDanhNgay()">Kiểm Tra
                                                        </button>
                                                    </div>

                                                    <div class="form-group occard" id="othuong" style="display:none;">

                                                    </div>


                                                </div>
                                                <div class="occho" id="fghdh">
                                                    - Thật tuyệt vời ! Mỗi ngày chỉ cần chơi trên {{ env('APP_NAME') }} chắc chắn bạn sẽ nhận được tiền.
                                                    <br>
                                                    - Khi chơi đủ số tiền (ko cần biết thắng thua) chắc chắn sẽ nhận được tiền. <br>
                                                    - Hãy nhập số điện thoại của bạn vào mục bên trên để kiểm tra đã chơi bao nhiêu nhé.
                                                    <br>
                                                    - Khi chơi đủ mốc tiền, các bạn ấn vào nhận thưởng để nhận được các mốc như sau:

                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover text-center">
                                                            <thead>
                                                            <tr role="row" class="bg-primary">
                                                                <th class="text-center text-white">Mốc chơi</th>
                                                                <th class="text-center text-white">Thưởng</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="zzxc">
                                                            @foreach($configAttendanceDate as $config)
                                                                <tr>
                                                                    <td>{{ number_format($config['mocchoi']) }}</td>
                                                                    <td>+{{ number_format($config['tiennhan']) }}</td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body turn" turn-tab="1000" style="padding-top: 0px;">
                                    Cách chơi vô cùng đơn giản : <br>
                                    - Chuyển tiền vào một trong các tài khoản :
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover text-center">
                                            <thead>
                                            <tr role="row" class="bg-primary2">
                                                <th class="text-center text-white">Số điện thoại</th>
                                                <th class="text-center text-white">Cược tối thiểu</th>
                                                <th class="text-center text-white">Cược tối đa</th>

                                            </tr>
                                            </thead>
                                            <tbody role="alert" aria-live="polite" aria-relevant="all" id="result-table"
                                                   class="">
                                            @php
                                                $dem = 0;
                                            @endphp
                                            @foreach($Setting_ChanLe['sdt2'] as $row)
                                                <tr>
                                                    <td id="p_27"><b id="ducnghia_27">{{ $row }}</b> <span
                                                                class="label label-success text-uppercase" onclick="coppy('{{ $row }}')"><i
                                                                    class="fa fa-clipboard" aria-hidden="true"></i></span></td>
                                                    <td>{{ number_format($Setting_ChanLe['min']) }} VNĐ</td>
                                                    <td>{{ number_format($Setting_ChanLe['max']) }} VNĐ</td>

                                                    @php
                                                        $dem ++;
                                                    @endphp
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <br>
                                    - Nội dung chuyển : <b>C</b> hoặc <b>L</b> (nếu đuôi mã giao dịch có các số sau) <br>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover text-center">
                                            <thead>
                                            <tr role="row" class="bg-primary2">
                                                <th class="text-center text-white">Nội dung</th>
                                                <th class="text-center text-white">Số</th>
                                                <th class="text-center text-white">Tiền nhận</th>

                                            </tr>
                                            </thead>
                                            <tbody role="alert" aria-live="polite" aria-relevant="all" id="result-table"
                                                   class="">

                                            <tr>
                                                <td><b>L</b></td>
                                                <td><code>1</code> - <code>3</code> - <code>5</code> - <code>7</code></td>
                                                <td><b>x{{ $Setting_ChanLe['tile'] }} tiền cược</b></td>
                                            </tr>
                                            <tr>
                                                <td><b>C</b></td>
                                                <td><code>2</code> - <code>4</code> - <code>6</code> - <code>8</code></td>
                                                <td><b>x{{ $Setting_ChanLe['tile'] }} tiền cược</b></td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>

                                    - Tiền thắng sẽ = <b>Tiền cược*{{ $Setting_ChanLe['tile'] }}</b> <br>
                                    <b>Lưu ý : Mức cược mỗi số khác nhau, nếu chuyển sai hạn mức hoặc sai nội dung sẽ không được
                                        hoàn tiền.</b>


                                </div>

                                <div class="panel-body turn" turn-tab="1" style="padding-top: 0px;">
                                    Cách chơi vô cùng đơn giản : <br>
                                    - Chuyển tiền vào một trong các tài khoản :
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover text-center">
                                            <thead>
                                            <tr role="row" class="bg-primary2">
                                                <th class="text-center text-white">Số điện thoại</th>
                                                <th class="text-center text-white">Cược tối thiểu</th>
                                                <th class="text-center text-white">Cược tối đa</th>

                                            </tr>
                                            </thead>
                                            <tbody role="alert" aria-live="polite" aria-relevant="all" id="result-table"
                                                   class="">
                                            @php
                                                $dem = 0;
                                            @endphp
                                            @foreach($Setting_ChanLe2['sdt2'] as $row)
                                                <tr>
                                                    <td id="p_28"><b id="ducnghia_28">{{ $row }}</b> <span
                                                                class="label label-success text-uppercase" onclick="coppy('{{ $row }}')"><i
                                                                    class="fa fa-clipboard" aria-hidden="true"></i></span> </td>
                                                    <td>{{ number_format($Setting_ChanLe2['min']) }} VNĐ </td>
                                                    <td>{{ number_format($Setting_ChanLe2['max']) }} VNĐ</td>

                                                </tr>
                                                @php
                                                    $dem ++;
                                                @endphp
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <br>
                                    - Nội dung chuyển : <b>C2</b> hoặc <b>L2</b> (nếu đuôi mã giao dịch có các số sau) <br>

                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover text-center">
                                            <thead>
                                            <tr role="row" class="bg-primary2">
                                                <th class="text-center text-white">Nội dung</th>
                                                <th class="text-center text-white">Số</th>
                                                <th class="text-center text-white">Tiền nhận</th>

                                            </tr>
                                            </thead>
                                            <tbody role="alert" aria-live="polite" aria-relevant="all" id="result-table"
                                                   class="">

                                            <tr>
                                                <td><b>L2</b></td>
                                                <td> <code>1</code> - <code>3</code> - <code>5</code> - <code>7</code> -
                                                    <code>9</code></td>
                                                <td><b>x{{ $Setting_ChanLe2['tile'] }} tiền cược</b></td>
                                            </tr>
                                            <tr>
                                                <td><b>C2</b></td>
                                                <td><code>0</code> -<code>2</code> - <code>4</code> - <code>6</code> -
                                                    <code>8</code></td>
                                                <td><b>x{{ $Setting_ChanLe2['tile'] }} tiền cược</b></td>
                                            </tr>
                                            <tr>
                                                    <td><b>X2</b></td>
                                                    <td><code>0</code> -<code>1</code> - <code>2</code> - <code>3</code> -
                                                        <code>4</code></td>
                                                    <td><b>x{{ $Setting_ChanLe2['tile'] }} tiền cược</b></td>
                                                </tr>
                                                <tr>
                                                    <td><b>T2</b></td>
                                                    <td><code>5</code> -<code>6</code> - <code>7</code> - <code>8</code> -
                                                        <code>9</code></td>
                                                    <td><b>x{{ $Setting_ChanLe2['tile'] }} tiền cược</b></td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>

                                    - Tiền thắng sẽ = <b>Tiền cược*{{ $Setting_ChanLe2['tile'] }}</b> <br>
                                    - tiền cược tối đa chơi <b>Chẵn lẻ 2</b> là <b>{{ number_format($Setting_ChanLe2['max']) }}</b> VND
                                    <br>
                                    <b>Lưu ý : Mức cược mỗi số khác nhau, nếu chuyển sai hạn mức hoặc sai nội dung sẽ không được
                                        hoàn tiền.</b>



                                </div>
                                <div class="panel-body turn active" turn-tab="010000" style="padding-top: 0px;">

                                    <style>
                                        #diemDanhCard {
                                            margin-top: 0.5rem;
                                            color: #155724;
                                            background-color: #d4edda;
                                            border-color: #c3e6cb;
                                        }

                                        #occard {
                                            margin-top: 0.5rem;
                                            color: #155724;
                                            background-color: #9cbca4;
                                            border-color: #c3e6cb;
                                            padding: 20px;
                                        }

                                        .occho {
                                            margin-top: 0.5rem;
                                            color: #155724;
                                            background-color: #aed6b8;
                                            border-color: #c3e6cb;
                                            padding: 20px;
                                        }
                                    </style>

                                    @include('HomePage.tab_attendance_session')
                                </div>

                                <div class="panel-body turn" turn-tab="2" style="padding-top: 0px;">
                                    - <b>Gấp 3</b> là một game vô cùng dễ, tính kết quả bằng <b>2 số cuối mã giao dịch</b>. <br>
                                    - Chuyển tiền vào một trong các tài khoản :
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover text-center">
                                            <thead>
                                            <tr role="row" class="bg-primary2">
                                                <th class="text-center text-white">Số điện thoại</th>
                                                <th class="text-center text-white">Cược tối thiểu</th>
                                                <th class="text-center text-white">Cược tối đa</th>

                                            </tr>
                                            </thead>
                                            <tbody role="alert" aria-live="polite" aria-relevant="all" id="result-table"
                                                   class="">
                                            @php
                                                $dem = 0;
                                            @endphp
                                            @foreach($Setting_Gap3['sdt2'] as $row)
                                                <tr>
                                                    <td id="p_27"><b id="ducnghia_27">{{ $row }}</b> <span
                                                                class="label label-success text-uppercase" onclick="coppy('{{ $row }}')"><i
                                                                    class="fa fa-clipboard" aria-hidden="true"></i></span></td>
                                                    <td>{{ number_format($Setting_Gap3['min']) }} VNĐ</td>
                                                    <td>{{ number_format($Setting_Gap3['max']) }} VNĐ</td>

                                                </tr>
                                                @php
                                                    $dem ++;
                                                @endphp
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <br>
                                    với nội dung : <code>G3</code>.
                                    <br>


                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover text-center">
                                            <thead>
                                            <tr role="row" class="bg-primary2">
                                                <th class="text-center text-white">Cách tính</th>
                                                <th class="text-center text-white">Số</th>
                                                <th class="text-center text-white">Tiền nhận</th>

                                            </tr>
                                            </thead>
                                            <tbody role="alert" aria-live="polite" aria-relevant="all" id="result-table"
                                                   class="">

                                            <tr>
                                                <td>2 số cuối mã GD</td>
                                                <td><code>02</code> <code>13</code> <code>17</code> <code>19</code>
                                                    <code>21</code> <code>29</code> <code>35</code> <code>37</code>
                                                    <code>47</code> <code>49</code> <code>51</code> <code>54</code>
                                                    <code>57</code> <code>63</code> <code>64</code> <code>74</code>
                                                    <code>83</code> <code>91</code> <code>95</code> <code>96</code></td>
                                                <td><b>x{{ $Setting_Gap3['tile1'] }} tiền cược</b></td>
                                            </tr>
                                            <tr>
                                                <td>2 số cuối mã GD</td>
                                                <td><code>69</code> <code>66</code> <code>99</code></td>
                                                <td><b>x{{ $Setting_Gap3['tile2'] }} tiền cược</b></td>
                                            </tr>
                                            <tr>
                                                <td>3 số cuối mã GD</td>
                                                <td><code>123</code> <code>234</code> <code>456</code> <code>678</code>
                                                    <code>789</code></td>
                                                <td><b>x{{ $Setting_Gap3['tile3'] }} tiền cược</b></td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>


                                </div>


                                <div class="panel-body turn" turn-tab="6" style="padding-top: 0px;">
                                    - <b>1 phần 3</b> là một game vô cùng dễ, tính kết quả bằng <b>1 số cuối mã giao dịch</b>.
                                    <br>
                                    - Cách chơi rất đơn giản, - Chuyển tiền vào một trong các tài khoản :
                                    <div
                                            class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover text-center">
                                            <thead>
                                            <tr role="row" class="bg-primary2">
                                                <th class="text-center text-white">Số điện thoại</th>
                                                <th class="text-center text-white">Cược tối thiểu</th>
                                                <th class="text-center text-white">Cược tối đa</th>

                                            </tr>
                                            </thead>
                                            <tbody role="alert" aria-live="polite" aria-relevant="all" id="result-table"
                                                   class="">
                                            @php
                                                $dem = 0;
                                            @endphp
                                            @foreach($Setting_1Phan3['sdt2'] as $row)
                                                <tr>
                                                    <td id="p_27"><b id="ducnghia_27">{{ $row }}</b> <span
                                                                class="label label-success text-uppercase" onclick="coppy('{{ $row }}')"><i
                                                                    class="fa fa-clipboard" aria-hidden="true"></i></span></td>
                                                    <td>{{ number_format($Setting_1Phan3['min']) }} VNĐ</td>
                                                    <td> {{ number_format($Setting_1Phan3['max']) }} VNĐ</td>

                                                </tr>
                                                @php
                                                    $dem ++;
                                                @endphp
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <br>
                                    với nội dung : .
                                    <br>

                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover text-center">
                                            <thead>
                                            <tr role="row" class="bg-primary2">
                                                <th class="text-center text-white">Nội dung</th>
                                                <th class="text-center text-white">Số cuối</th>
                                                <th class="text-center text-white">Tiền nhận</th>

                                            </tr>
                                            </thead>
                                            <tbody role="alert" aria-live="polite" aria-relevant="all" id="result-table"
                                                   class="">

                                            <tr>
                                                <td><b>N1</b></td>
                                                <td><code>1</code> <code>2</code> <code>3</code></td>
                                                <td><b>x{{ $Setting_1Phan3['tile'] }} tiền cược</b></td>
                                            </tr>

                                            <tr>
                                                <td><b>N2</b></td>
                                                <td><code>4</code> <code>5</code> <code>6</code></td>
                                                <td><b>x{{ $Setting_1Phan3['tile'] }} tiền cược</b></td>
                                            </tr>

                                            <tr>
                                                <td><b>N3</b></td>
                                                <td><code>7</code> <code>8</code> <code>9</code></td>
                                                <td><b>x{{ $Setting_1Phan3['tile'] }} tiền cược</b></td>
                                            </tr>


                                            </tbody>
                                        </table>
                                    </div>
                                    <br> - Nếu mã giao dịch có số cuối trùng với 1 trong 3 số trên, bạn sẽ chiến thắng.


                                </div>

                                <div class="panel-body turn" turn-tab="5" style="padding-top: 0px;">
                                    - Cách chơi rất đơn giản, Chuyển tiền vào một trong các tài khoản :
                                    <div
                                            class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover text-center">
                                            <thead>
                                            <tr role="row" class="bg-primary2">
                                                <th class="text-center text-white">Số điện thoại</th>
                                                <th class="text-center text-white">Cược tối thiểu</th>
                                                <th class="text-center text-white">Cược tối đa</th>

                                            </tr>
                                            </thead>
                                            <tbody role="alert" aria-live="polite" aria-relevant="all" id="result-table"
                                                   class="">
                                            @php
                                                $dem = 0;
                                            @endphp
                                            @foreach($Setting_Tong3So['sdt2'] as $row)
                                                <tr>
                                                    <td id="p_27"><b id="ducnghia_27">{{ $row }}</b> <span
                                                                class="label label-success text-uppercase" onclick="coppy('{{ $row }}')"><i
                                                                    class="fa fa-clipboard" aria-hidden="true"></i></span></td>
                                                    <td>{{ number_format($Setting_Tong3So['min']) }} VNĐ</td>
                                                    <td> {{ number_format($Setting_Tong3So['max']) }} VNĐ</td>

                                                </tr>
                                                @php
                                                    $dem ++;
                                                @endphp
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <br>
                                    với nội dung : <code>S</code>.

                                    <br>
                                    - Kết quả là tính tổng 3 số cuối của mã giao dịch. <br>

                                    - Nếu tổng 3 số cuối bằng <b>7</b>, <b>17</b>, <b>27</b> => Nhận <b>x{{ $Setting_Tong3So['tile1'] }}
                                        tiền cược</b> <br>
                                    - Nếu tổng 3 số cuối bằng <b>8</b>, <b>18</b> => Nhận <b>x{{ $Setting_Tong3So['tile2'] }} tiền cược</b>
                                    <br>

                                    - Nếu tổng 3 số cuối bằng <b>9</b>, <b>19</b> => Nhận <b>x{{ $Setting_Tong3So['tile3'] }} tiền cược</b>
                                    <br>
                                    <br>


                                </div>


                            </div>
                        </div>
                        <div class="col-md-3 mt-3 text-center cl">
                           <div class="panel panel-primary">
								<div class="panel-heading text-center">
								<div class="row">
								<div class="col-xs-12">
								💖 KIỂM TRA GIAO DỊCH 💖
								</div>
								</div>
								</div>
								<div class="panel-body">
								<form method="POST" action="history.php" onsubmit="return validateForm()" required="">
								<div class="form-group">
								<label for="exampleInputEmail1">Nhập mã giao dịch</label>
								<input type="number" name="magiaodich" class="form-control" id="magiaodich" aria-describedby="emailHelp" placeholder="Ví dụ 6996868686">
								<small id="emailHelp" class="form-text text-muted">Nhập mã giao dịch của bạn để
								kiểm tra.</small>
								</div>
								<center><button id="post_ls" type="submit" class="btn btn-primary">Kiểm tra</button></center>
								</form>
								<br>
								<div class="panel panel-primary">
                                <div class="panel-heading text-center">
                                    <div class="row">
                                        <div class="col-xs-12">
                                           💖 Lưu ý 💖
                                        </div>

                                    </div>
                                </div>

                            </div>
								<div class="alert alert-danger">
                                        <p>Nội dung chuyển không phân biệt in hoa, thường.</p>
                                        <p><b>Lưu ý : Mức cược mỗi số khác nhau, nếu chuyển sai hạn mức hoặc sai nội dung sẽ
                                                không được hoàn tiền.</b>
                                        </p>
                                        <p>Nếu bạn chiến thắng, vui lòng chờ 2 - 5 Giây hệ thống sẽ tự động chuyển tiền cho bạn.
                                        </p>


                                    </div>



                                    <p><span class="label label-success text-uppercase">CSKH ZALO : <a
                                                class="text-white" href="{{ $GetSetting->zalo }}"
                                                target="_blank">{{ $GetSetting->zalo }}</a></span></p>

								</div>
						   </div>
                        </div>
                        <!--<div class="col-md-3 mt-3 text-center cl">-->
                        <!--    <div class="panel panel-primary">-->
                        <!--        <div class="panel-heading text-center">-->
                        <!--            <div class="row">-->
                        <!--                <div class="col-xs-12">-->
                        <!--                    Lưu ý-->
                        <!--                </div>-->

                        <!--            </div>-->
                        <!--        </div>-->
                        <!--        <div class="panel-body">-->

                        <!--            <div class="alert alert-danger">-->
                        <!--                <p>Nội dung chuyển không phân biệt in hoa, thường.</p>-->
                        <!--                <p><b>Lưu ý : Mức cược mỗi số khác nhau, nếu chuyển sai hạn mức hoặc sai nội dung sẽ-->
                        <!--                        không được hoàn tiền.</b>-->
                        <!--                </p>-->
                        <!--                <p>Nếu bạn chiến thắng, vui lòng chờ 1 - 2 phút hệ thống sẽ tự động chuyển tiền cho bạn.-->
                        <!--                </p>-->


                        <!--            </div>-->


                        <!--            <p><span class="label label-success text-uppercase">CSKH ZALO : <a-->
                        <!--                            class="text-white" href="{{ $GetSetting->zalo }}"-->
                        <!--                            target="_blank">{{ $GetSetting->zalo }}</a></span></p>-->


                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                    </div>

                    <div class="mt-5">

                        <div class="text-center mb-3">
                            <h3 class="text-uppercase">LỊCH SỬ THẮNG</h3>
                        </div>


                        <center class="" style="width: 76%;
            margin: auto;">
                            <marquee><b>
                                    @foreach($LichSuGiaoDich as $row)
                                        Chúc mừng <font color="blue">{{ $row->sdt2 }}</font> thắng lớn nhận <font
                                                color="green">{{ number_format($row->tiennhan) }}
                                        </font> VNĐ. |
                                    @endforeach
                                    .</b></marquee>
                        </center>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover text-center">
                                <thead>
                                <tr role="row" class="bg-primary2">
                                    <th class="text-center text-white">Thời gian</th>
                                    <th class="text-center text-white">Số điện thoại</th>
                                    <th class="text-center text-white">Tiền cược</th>
                                    <th class="text-center text-white">Tiền nhận</th>
                                    <th class="text-center text-white">Trò chơi</th>
                                    <th class="text-center text-white">Nội dung</th>
                                    <th class="text-center text-white">trạng thái</th>
                                </tr>
                                </thead>
                                <tbody role="alert" aria-live="polite" aria-relevant="all" class="">

                                @foreach($LichSuGiaoDich as $row)
                                    <tr>
                                        <td>{{ $row->created_at }}</td>
                                        <td>{{ $row->sdt2 }}</td>
                                        <td>{{ number_format($row->tiencuoc) }}</td>
                                        <td>{{ number_format($row->tiennhan) }}</td>
                                        <td>{{ $row->trochoi }}</td>
                                        <td>{{ strtoupper ($row->noidung) }}</td>
                                        <td><span class="label label-{{ $row->class }} text-uppercase">
                                            {{
                                                $row->text
                                            }}
                                        </span></td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>


                    </div>


                    <hr style="margin-top: 25px; margin-bottom: 25px;">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-danger">
                                <div class="panel-heading text-center">
                                    <h4>TRẠNG THÁI MOMO</h4>
                                </div>
                                <div class="panel-body">

                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover text-center">
                                            <thead>
                                            <tr role="row" class="bg-primary2">
                                                <th class="text-center text-white">Số điện thoại</th>
                                                <th class="text-center text-white">Trạng thái</th>
                                                <!--<th class="text-center text-white">Thời gian</th>-->
                                                <!--<th class="text-center text-white">Giới hạn</th>-->
                                                <th class="text-center text-white">Số lần bank</th>
                                            </tr>
                                            </thead>
                                            <tbody role="alert" aria-live="polite" aria-relevant="all" id="result-table"
                                                   class="">


                                            @foreach($ListAccounts as $row)
                                                <tr>
                                                    <td id="p_27"><b id="ducnghia_27">{{ $row->sdt }}</b> <span
                                                                class="label label-{{ $row->status_class }} text-uppercase"
                                                                onclick="coppy('{{ $row->sdt }}')"><i
                                                                    class="fa fa-clipboard" aria-hidden="true"></i></span></td>
                                                    <td>
                                                        <span class="label label-{{ $row->status_class }} text-uppercase">{{ $row->status_text }}</span>
                                                    </td>
                                                    <!--<td>{{ $row->created_at }}</td>-->
                                                    <!--<td> {{ number_format($row->limit1) }} / {{ number_format($row->limit2) }} VNĐ</td>-->
                                                    <td>{{ number_format($row->countbank) }}/190</td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-danger">
                                <div class="panel-heading text-center">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <h4>TOP Tuần</h4>
                                        </div>
                                        <div class="col-xs-6">
                                            <h4>
                                                @if($GetSetting->on_trathuongtuan == 1)
                                                    <span data-action="phan-thuong" class="label label-danger"
                                                          style="cursor: pointer;">
                                                        <i class="fa fa-gift"></i>&nbsp;&nbsp;Phần thưởng
                                                    </span>
                                                @endif
                                            </h4>
                                        </div>
                                    </div>
                                </div>


                                <div class="panel-body">

                                    @php
                                        $dem = 0;
                                    @endphp
                                    @foreach($UserTopTuan as $row)
                                        @php
                                            $dem++;
                                        @endphp
                                        <div class="row">
                                            <div class="col-xs-1">
                                            <span class="fa-stack">
                                                <span class="fa fa-circle fa-stack-2x text-danger"></span>
                                                <strong class="fa-stack-1x text-white">{{ $dem }}</strong>
                                            </span>
                                            </div>

                                            <div class="col-xs-2">
                                                <span class="label label-success">{{ $row['sdt2'] }}</span>
                                            </div>
                                            <div class="col-xs-5 text-right">
                                                <span class="label label-danger">{{ number_format($row['tiencuoc']) }} vnđ</span>
                                            </div>
                                        </div>
                                    @endforeach


                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="hugame" tabindex="-1" role="dialog"
             style="overflow: scroll; -webkit-overflow-scrolling: touch;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title">
                            <h2 class="text-danger"><b>NỔ HŨ GAME</b></h2>
                        </h3>
                    </div>
                    <div class="modal-body" id="result_hu">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" style="border-radius: 0;"
                                data-dismiss="modal">Đóng
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="modalGift" tabindex="-1" role="dialog"
             style="overflow: scroll; -webkit-overflow-scrolling: touch;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title">
                            <h2 class="text-danger"><b>PHẦN THƯỞNG TOP</b></h2>
                        </h3>
                    </div>
                    <div class="modal-body">
                        <p>TOP sẽ dược trao vào 24h chủ nhật hàng tuần.</p>
                        <p>Phần thưởng top :</p>

                        @foreach($GetSettingPhanThuongTop as $row)
                            <p>- TOP {{ $row->top }} : {{ number_format($row->phanthuong) }} VNĐ</p>
                        @endforeach

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" style="border-radius: 0;"
                                data-dismiss="modal">Đóng
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .my-element {
                --animate-repeat: 20000;
            }

            center.solid {
                border-style: solid;
            }

        </style>

        @if($GetSetting->on_nohu == 1)
            <div onclick="clickhu()" style="
                display: block;
                position: fixed;
                bottom: 70px;
                left: 15px;
                width: 15%;
                z-index: 1000;
                cursor: pointer;
            ">

                <center>
                    <img class="animate__animated animate__heartBeat animate__infinite infinite"
                         src="{{ asset('image/hu.png') }}" class="" width="100%" style="">
                </center>

                <center class="solid" style="border-top-right-radius: 30px;
                border-top-left-radius: 30px;
                border-radius: 30px;
                background: aquamarine;">
                    <p class="" id=""><b id="hu">0</b> VNĐ</p>
                </center>

            </div>
        @endif

    </div>
    <!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
        var chatbox = document.getElementById('fb-customer-chat');
        chatbox.setAttribute("page_id", "104549351936481");
        chatbox.setAttribute("attribution", "biz_inbox");

        window.fbAsyncInit = function () {
            FB.init({
                xfbml: true,
                version: 'v11.0'
            });
        };

        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
@endsection
