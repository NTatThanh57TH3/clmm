<div class="row collapse show" id="diemDanhCard" style="">
    <div class="col-lg-12">
        <div class="body">
            <div class="text-center">

                <font color="blue"><big><b>Điểm Danh Nhận Quà Miễn Phí</b></big></font>
                <br>
                <small><i class="fa fa-info-circle" aria-hidden="true"></i> Mã quà: <font
                            color="orange"><b id="diemdanh_id">{{ $attendanceSessionCurrent->id }}</b></font></small><br>

                <small><i class="fa fa-usd" aria-hidden="true"></i> Giá trị: <font color="Maroon"><b
                                id="">5.000 ~ 100.000</b> vnđ</font></small><br>

                <small><i class="fa fa-user" aria-hidden="true"></i>: <font color="333366"><b
                                id="diemdanh_users" class="diemdanh_users">{{ $countUsersAttendance }}</b> người</font></small><br>

                <small><i class="fa fa-clock-o" aria-hidden="true"></i> Quay thưởng sau: <font
                            color="660000"><b id="diemdanh_thoigian">{{ $secondRealTime }}</b> giây</font></small><br>
                <small><i class="fa fa-star" aria-hidden="true"></i> Thắng phiên trước: <font
                            color="333300"><b id="diemdanh_last">{{$phoneWinLatest}}</b></font></small><br>

                <div class="form-group occard" id="occard">
                    <label for="exampleInputEmail1">Số điện thoại:</label>
                    <input type="text" class="form-control" id="phonevalue" aria-describedby="emailHelp"
                           placeholder="03837755">
                    <small id="emailHelp" class="form-text text-muted">Nhập số điện thoại của bạn để
                        điểm danh.</small>
                    <br>
                    <button class="btn btn-success" data-toggle="modal" data-target="#modalDiemDanh"
                            onclick="diemdanh()">Điểm danh
                    </button>
                </div>

                <button class="btn btn-info"
                        onclick="$('#muc_huongdan').show();$('#muc_users').hide();$('#muc_lichsu').hide();">
                    Cách chơi
                </button>
                <button class="btn btn-dark" data-toggle="modal"
                        onclick="$('#muc_huongdan').hide();$('#muc_users').hide();$('#muc_lichsu').show();">
                    Lịch sử
                </button>
                <button class="btn btn-danger"
                        onclick="$('#muc_huongdan').hide();$('#muc_users').show();$('#muc_lichsu').hide();">
                    Danh sách
                </button>
            </div>
            <div class="occho" id="muc_huongdan">
                - Mỗi phiên quà các bạn có 10 phút để điểm danh. <br>
                - Số điện thoại điểm danh phải chơi Clmm.Me ít nhất 1 lần trong ngày. Không giới hạn số
                lần điểm danh trong ngày. <br>
                - Khi hết thời gian, người may mắn sẽ nhận được số tiền của phiên đó. <br>
                - Game chỉ hoạt động từ <b>7h sáng</b> đến 1h đêm
            </div>

            <div class="occho" id="muc_lichsu" style="display:none;">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover text-center">
                        <thead>
                        <tr role="row" class="bg-primary">
                            <th class="text-center text-white">Mã</th>
                            <th class="text-center text-white">SDT</th>
                            <th class="text-center text-white">Mã GD</th>
                            <th class="text-center text-white">VND</th>
                        </tr>
                        </thead>
                        <tbody id="mayman_log">
                        @foreach($listSessionsPast as $sessionPast)
                            <tr>
                                <td><small>{{ $sessionPast->id }}</small></td>
                                <td>{{ $sessionPast->getPhone() }}</td>
                                <td><small>{{ $sessionPast->bill_code }}</small></td>
                                <td>{{ number_format($sessionPast->amount) }} VNĐ</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="occho" id="muc_users" style="display:none;"> 0972***612, 0822***715, 0528***436,
                0338***810, 0377***625, 0789***512, 0336***046, 0868***103, 0368***729, 0379***223,
                0337***374, 0365***794, 0984***171, 0328***224, 0387***980, 0326***924, 0852***188,
                0868***263, 0979***490, 0984***994, 0332***107, 0935***496, 0399***146, 0903***504,
                0342***921, 0888***269, 0382***331, 0971***457, 0935***906,
            </div>
        </div>
    </div>
</div>