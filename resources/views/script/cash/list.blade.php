@extends('layout.header')
@section('title', 'cash一覧')

@section('body')

<div id="pageBody" class="container-fluid">

    <div style="margin: 10px;text-align: right;">
        <select class="form-control" onchange="page_reload(this);">
            @foreach (all_year_month($request['date']) as $yyyymm => $yyyymm_val)
                @if ((int)$yyyymm === (int)$request['date'])
                    <option value="{{ $yyyymm }}" selected="selected">{{ $yyyymm }}</option>
                @else
                    <option value="{{ $yyyymm }}">{{ $yyyymm }}</option>
                @endif
            @endforeach
        </select>

        <a id="list_link" href="{{url('/cash/index')}}">登録ページ</a>
    </div>
    
    <ul class="list-group list-group-flush">
        <li class="list-group-item list-group-item-success">残高<span class="badge badge-success float-right">{{ number_format($view['sum_balance']) }}</span></li>
        <li class="list-group-item list-group-item-success">Devit 使用額<span class="badge badge-success float-right">{{ number_format($view['devit_pay']) }}</span></li>
        <li class="list-group-item list-group-item-danger">今月支出<span class="badge badge-danger float-right">まだやねん</span></li>
        <li class="list-group-item list-group-item-primary">今月利益<span class="badge badge-primary float-right">まだやねん</span></li>
    </ul>

    <hr style="height: 10px;"></hr>
        
    <ul class="list-group list-group-flush">
        @foreach ($view['sum_kamoku_list'] as $viewNum => $sum_kamoku_list)
            <li class="list-group-item">
                {{ $sum_kamoku_list['kamoku_sum'] }}
                @if ($sum_kamoku_list['amount_flg'] == 1) <?php // 収入 ?>
                    <span class="badge badge-primary float-right">{{ $sum_kamoku_list['amount'] }}</span>
                @else <?php // 支出 ?>
                    <span class="badge badge-danger float-right">{{ $sum_kamoku_list['amount'] }}</span>
                @endif
            </li>
        @endforeach
    </ul>


    <hr style="height: 10px;"></hr>

    <div class="table-responsive">
        <table class="table table-sm table-hover" style="font-size: 11px;min-width: 600px;">
            <thead>
            <tr>
                <th scope="col" style="width: 75px;">名前</th>
                <th scope="col" style="width: 50px;">金額</th>
                <th scope="col" style="width: 95px;">科目</th>
                <th scope="col">概要</th>
                <th scope="col" style="width: 80px;">発生日</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                @foreach ($view['detail'] as $detail_num => $detail)
                    <tr>
                        <td><span class="circle {{ $detail->name }}"></span>{{ $detail->name }}</td>
                        <td>{{ number_format((int)$detail->price) }}</td>
                        <td>{{ $detail->tag }}</td>
                        <td>{{ $detail->comment }}</td>
                        <td>{{ $detail->date }}</td>
                    </tr>
                @endforeach
            </tr>
            </tbody>
        </table>
    </div>

</div>

<style>
    .circle {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        display: block;
        float: left;
        margin: 3px;
    }
    .kabigon {
        background-color: #997C3D;
    }
    .yukihiro {
        background-color: #14CC7B;
    }
    .share {
        background-color: #FF6F00;
    }
    .other {
        background-color: #C0C0C0;
    }
</style>

<script type="text/javascript">
    <?php // ページ更新時の処理 ?>
    function page_reload(obj) {
        pageBodyObj = document.getElementById("pageBody");
        pageBodyObj.classList.add("animated");
        <?php
            switch (mt_rand(1, 6)) {
                case 1:
                    $animate = "rotateOut";
                    break;
                case 2:
                    $animate = "zoomOutUp";
                    break;
                case 3:
                    $animate = "zoomOutRight";
                    break;
                case 4:
                    $animate = "zoomOutLeft";
                    break;
                case 5:
                    $animate = "hinge";
                    break;
                default:
                    $animate = "zoomOutUp";
            }
        ?>
        pageBodyObj.classList.add("{{ $animate }}");
        pageBodyObj.classList.add("slow");
        setTimeout(function() {
            location = '{{ url("/cash/list") ."?date=" }}' + obj.value;
        }, 2000);
    }
</script>

@endsection
