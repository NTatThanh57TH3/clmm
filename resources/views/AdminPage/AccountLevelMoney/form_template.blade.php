<div class="modal-header">
    <h5 class="modal-title">{{ $titleModal }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="form-group row">
        <div class="col-sm-1">
            <label class="control-label">SĐT: </label>
        </div>
        <div class="col-sm-4">
            <div class="kt-form__group--inline">
                <label>
                    <select class="form-control sdt">
                        @foreach($accountsMomo as $accountMomo)
                            <option value="{{$accountMomo['sdt']}}">{{$accountMomo['sdt']}}</option>
                        @endforeach
                    </select>
                </label>
                {{--                                <input class="form-control input-mocchoi-{{ $setting['id'] }}" value="{{ $setting['mocchoi'] }}"/>--}}
            </div>
            <div class="d-md-none kt-margin-b-10"></div>
        </div>
        <div class="col-sm-1">
            <label class="control-label">Trò chơi: </label>
        </div>
        <div class="col-sm-4">
            <div class="kt-form__group--inline">
                <label>
                    <select class="form-control type">
                        @foreach($types as $type => $label)
                            <option value="{{$type}}">{{$label}}</option>
                        @endforeach
                    </select>
                </label>
                {{--                                <input class="form-control input-mocchoi-{{ $setting['id'] }}" value="{{ $setting['mocchoi'] }}"/>--}}
            </div>
            <div class="d-md-none kt-margin-b-10"></div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-1">
            <label class="control-label">Min: </label>
        </div>
        <div class="col-sm-4">
            <div class="kt-form__group--inline">
                <label>
                    <input class="form-control min" value="" placeholder="30000"/>
                </label>
            </div>
            <div class="d-md-none kt-margin-b-10"></div>
        </div>
        <div class="col-sm-1">
            <label class="control-label">Max: </label>
        </div>
        <div class="col-sm-4">
            <div class="kt-form__group--inline">
                <label>
                    <input class="form-control max" value="" placeholder="3000000"/>
                </label>
                {{--                                <input class="form-control input-mocchoi-{{ $setting['id'] }}" value="{{ $setting['mocchoi'] }}"/>--}}
            </div>
            <div class="d-md-none kt-margin-b-10"></div>
        </div>
    </div>
</div>
