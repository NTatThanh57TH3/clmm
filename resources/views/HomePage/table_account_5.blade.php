
@php
    $dem = 0;
@endphp
@if(!is_null($accountMomosGroupTypes->get(CONFIG_TONG_3_SO)) && count($accountMomosGroupTypes->get(CONFIG_TONG_3_SO)) > 0)
    @foreach($accountMomosGroupTypes->get(CONFIG_TONG_3_SO) as $rowTong3So)
        <tr>
            <td id="p_27"><b id="ducnghia_27"
                             style="position: relative;">{{ $rowTong3So['sdt'] }} <span
                            class="label label-success text-uppercase"
                            onclick="coppy('{{ $rowTong3So['sdt'] }}')"><i
                                class="fa fa-clipboard" aria-hidden="true"></i></span>
                    <b style="position: absolute;
                                                                top: 15px;
                                                                margin-left: auto;
                                                                margin-right: auto;
                                                                left: 0;
                                                                right: 0;
                                                                text-align: center;
                                                                font-size: 9px;">
                        <font color="green">{{ number_format($rowTong3So['sumTienCuoc']) }}</font>/<font
                                color="6861b1">30M</font>
                    </b>
                </b>
            </td>
            <td>{{ number_format($rowTong3So['min']) }} VNĐ</td>
            <td> {{ number_format($rowTong3So['max']) }} VNĐ</td>

        </tr>
        @php
            $dem ++;
        @endphp
    @endforeach
@endif
