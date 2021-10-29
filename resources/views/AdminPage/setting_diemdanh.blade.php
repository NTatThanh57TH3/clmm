@extends('layouts.admin')

@section('style')

@endsection

@section('script')
    @if ($errors->any())
        <script>
            swal("Thông báo", "{{ $errors->first() }}", "error");
        </script>
    @endif

    @if (\Session::has('message'))
        <script>
            swal("Thông báo", "{{ \Session::get('message') }}", "{{ \Session::get('status') }}");
        </script>
    @endif
@endsection

@section('content')
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
            <form action="{{ route($GetSetting->action) }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $settingDiemdanh->id }}">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <label>Min:</label>
                        <input class="form-control" name="money_min" value="{{ $settingDiemdanh->money_min }}">
                    </div>

                    <div class="col-12 col-md-6">
                        <label>Max:</label>
                        <input class="form-control" name="money_max" value="{{ $settingDiemdanh->money_max }}">
                    </div>
                    <div class="col-12 col-md-12"><br/></div>

                    <div class="col-12 col-md-6">
                        <label>Thời gian bắt đầu:</label>
                        <input class="form-control" name="start_time" value="{{ $settingDiemdanh->start_time }}">

                    </div>
                    <div class="col-12 col-md-6">
                        <label>Thời gian kết thúc:</label>
                        <input class="form-control" name="end_time" value="{{ $settingDiemdanh->end_time }}">
                    </div>

                    <div class="col-12 col-md-12"><br/></div>
                    <div class="col-12 col-md-6">
                        <label>Tỉ lệ nguời chơi thắng:</label>
                        <input class="form-control" name="win_rate" value="{{ $settingDiemdanh->win_rate }}">
                    </div>
                    <div class="col-12 col-md-12"><br/></div>

                    <div class="col-12 col-md-12">
                        <button class="btn btn-info" style="width: 100%;">Lưu lại</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
