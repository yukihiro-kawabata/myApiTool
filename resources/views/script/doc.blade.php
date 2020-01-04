@extends('layout.header')
@section('title', 'document of API')

@section('body')

<div class="container-fluid">
    <nav id="sidebar" class="sidebar sidebar-offcanvas">
        <ul class="nav">
            <li id="api_list_head" class="nav-item">API list</li>

            @foreach ($allApiNames as $allApiNameNum => $allApiName)
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/doc') . '?api_name=' . $allApiName->api_name }}">
                        <span class="menu-title">{{ $allApiName->api_name }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>


    <div id="main" class="panel panel-info">
        <div class="panel-heading">{{ $apiData->api_name }} description</div>
            <div class="panel-body">

                <a href="{{ url('/regist/index') . '?id=' . $apiData->id }}">
                    <button type="button" class="btn btn-primary pull-right" style="margin: 5px;">edit API</button>
                </a>

                <div class="form-group">
                    <label for="text">explain of this API</label>
                    <pre>{{ $apiData->explain }}</pre>
                </div>
                <div class="form-group">
                    <label for="text">basic url</label>
                    <pre style="color: blue;">{{ url('/api') . '?action=' . $apiData->api_name }}</pre>
                </div>
                <div class="form-group">
                    <label for="text">Return value column</label>
                    <pre>{{ $apiData->db_table_col }}</pre>
                </div>
                <div class="form-group">
                    <ul class="list-inline">
                        <li>
                            <label for="text">DB Driver</label>
                            <kbd>{{ $apiData->db_name }}</kbd>
                        </li>
                        <li>
                            <label for="text">DB Table</label>
                            <kbd>{{ $apiData->db_table }}</kbd>                            
                        </li>
                        <li>
                            <label for="text">Method</label>
                            <kbd>{{ $apiData->method }}</kbd>   
                        </li>
                    </ul>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">parameters</div>
                    <div class="panel-body">
                        <label for="text">required column</label>
                        <ul class="list-group">
                            @for ($reqCol = 1; $reqCol <= $required_col_cnt; $reqCol++)
                                <?php $reqName = 'required'.$reqCol; $reqVal = $apiData->{$reqName} ?>
                                <?php $reqNameText = 'required_text'.$reqCol; $reqText = $apiData->{$reqNameText} ?>
                                
                                @if (!empty($reqVal))
                                    <li class="list-group-item">
                                    {{ "($reqCol) " . $reqVal }}
                                    <pre>{{ $reqText }}</pre>
                                    </li>
                                @endif
                            @endfor
                        </ul>

                        <label for="text">other parameters</label>
                        <ul class="list-group">
                            @for ($paramCol = 1; $paramCol <= $param_col_cnt; $paramCol++)
                                <?php $parName = 'param'.$paramCol; $parVal = $apiData->{$parName} ?>
                                <?php $parNameText = 'param_text'.$paramCol; $parText = $apiData->{$parNameText} ?>
                                
                                @if (!empty($parVal))
                                    <li class="list-group-item">
                                    {{ "($paramCol) " . $parVal }}
                                    <pre>{{ $parText }}</pre>
                                    </li>
                                @endif
                            @endfor
                        </ul>

                        @if (!empty($apiData->group_by1))
                            <label for="text">specified "GROUP BY" table column</label>
                            <ul class="list-group">
                                @for ($groupbyCol = 1; $groupbyCol <= $group_by_col_cnt; $groupbyCol++)
                                    <?php $groupName = 'group_by'.$groupbyCol; $groupVal = $apiData->{$groupName} ?>
                                    
                                    @if (!empty($groupVal))
                                        <li class="list-group-item">{{ $groupVal }}</li>
                                    @endif
                                @endfor
                            </ul>
                        @endif
                    </div>
                </div>                  

            </div>
        </div>
    </div>
</div>

<style>
    #main {
        float: left;
        width: 80%;
        margin: 0 10px 0 35px;
    }
    #sidebar {
        width: 15%;
        height: 100vh;
        overflow-y: scroll;
        float: left;
        border: solid 1px #eee;
    }
    #api_list_head {
        text-align: center;
        background-color: #337ab7;
        padding: 5px;
        font-size: 16px;
        font-weight: bold;
        color: #fff;
    }
</style>

@endsection
