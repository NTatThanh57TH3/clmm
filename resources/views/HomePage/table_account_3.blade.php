@php
    $dem = 0;
@endphp
@if(!is_null($accountMomosGroupTypes->get(CONFIG_CHAN_LE_TAI_XIU_2)) && count($accountMomosGroupTypes->get(CONFIG_CHAN_LE_TAI_XIU_2)) > 0)
    @foreach($accountMomosGroupTypes->get(CONFIG_CHAN_LE_TAI_XIU_2) as $rowChanLe2)
        <tr>
            <td id="p_28"><b id="ducnghia_28"
                             style="position: relative;">{{ $rowTaiXiu['sdt'] }} <span
                            class="label label-success text-uppercase"
                            onclick="coppy('{{ $rowChanLe2['sdt'] }}')"><i
                                class="fa fa-clipboard" aria-hidden="true"></i></span>
                    <b style="position: absolute;
                                                                top: 15px;
                                                                margin-left: auto;
                                                                margin-right: auto;
                                                                left: 0;
                                                                right: 0;
                                                                text-align: center;
                                                                font-size: 9px;">
                        <font color="green">{{ number_format($rowChanLe2['sumTienCuoc']) }}</font>/<font
                                color="6861b1">30M</font>
                    </b>
                </b>
            </td>
            <td>{{ number_format($rowChanLe2['min']) }} VNĐ</td>
            <td>{{ number_format($rowChanLe2['max']) }} VNĐ</td>

        </tr>
        @php
            $dem ++;
        @endphp
    @endforeach
@endif
