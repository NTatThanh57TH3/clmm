@php
    $dem = 0;
@endphp
@if(!is_null($accountMomosGroupTypes->get(CONFIG_CHAN_LE)) && count($accountMomosGroupTypes->get(CONFIG_CHAN_LE)) > 0)
    @foreach($accountMomosGroupTypes->get(CONFIG_CHAN_LE) as $rowChanLe)
        <tr>
            <td id="p_27"><b id="ducnghia_27"
                             style="position: relative;">{{ $rowChanLe['sdt'] }} <span
                            class="label label-success text-uppercase"
                            onclick="coppy('{{ $rowChanLe['sdt'] }}')"><i
                                class="fa fa-clipboard" aria-hidden="true"></i></span>
                    <b style="position: absolute;
                                                                top: 15px;
                                                                margin-left: auto;
                                                                margin-right: auto;
                                                                left: 0;
                                                                right: 0;
                                                                text-align: center;
                                                                font-size: 9px;">
                        <font color="green">{{ number_format($rowChanLe['sumTienCuoc']) }}</font>/<font
                                color="6861b1">30M</font>
                    </b>
                </b>
            </td>
            <td>{{ number_format($rowChanLe['min']) }} VNĐ</td>
            <td>{{ number_format($rowChanLe['max']) }} VNĐ</td>

            @php
                $dem ++;
            @endphp
        </tr>
    @endforeach
@endif
