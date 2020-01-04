@extends('layout.header')
@section('title', 'regist screen of API')

@section('body')

<form method="POST" name="submitForm" action="{{ url('/regist/indexexecute') }}">
    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
            <h3 class="panel-title">regist screen of API</h3>
            </div>
            <div class="panel-body">
                <div class="form-group form-group-head">
                    <label for="text">API name</label>
                    <input type="text" id="api_name" class="form-control form_origin_head" name="api_name" onkeyup="this.value = convert_string(this.value)" value="{{ $item['api_name'] }}">
                </div>
                <div class="form-group form-group-head">
                    <label for="text">method</label>
                    <select id="method" class="form-control form_origin_head" name="method">
                        <option value="GET" selected="selected">GET</option>
                        <option value="POST">POST</option>
                    </select>
                </div>
                <div class="form-group form-group-head">
                    <label for="text">Select "driver" written in "config/database.php"</label>
                    <select id="db_name" class="form-control form_origin_head" name="db_name">
                        @foreach ($dbContant as $dbClass => $contant)
                            <option value="{{ $dbClass }}">{{ $dbClass }}</option>
                        @endforeach
                    </select>
                </div>                
                <div class="form-group form-group-head">
                    <label for="text">DB table name</label>
                    <input type="text" id="db_table" class="form-control form_origin_head" name="db_table" value="{{ $item['db_table'] }}">
                </div>
                <div class="form-group form-group-head">
                    <label for="text">columns of DB table is got when sql execute</label>
                    <textarea id="db_table_col" class="form-control form_origin_head" name="db_table_col" placeholder="ex). * OR id, name, title">{{ $item['db_table_col'] }}</textarea>
                </div>
                
                <div class="form-group text" style="width: 96% !important;">
                    <textarea class="form-control" name="explain" placeholder="let's write explain of this api">{{ $item['explain'] }}</textarea>   
                </div>

                <div class="form-group">
                    @for ($reqCol = 1; $reqCol <= $required_col_cnt; $reqCol++)
                        <input type="text" id="required{{ $reqCol }}" class="form-control form_origin" name="required{{ $reqCol }}" value="{{ $item['required' . $reqCol] }}" placeholder="{{ $reqCol }}. required column">
                        <textarea class="form-control text" name="required_text{{ $reqCol }}" placeholder="{{ $reqCol }}. explane required column">{{ $item['required_text' . $reqCol] }}</textarea>
                    @endfor
                </div>
                <div class="form-group">
                    @for ($paramCol = 1; $paramCol <= $param_col_cnt; $paramCol++)
                        <input type="text" id="param{{ $paramCol }}" class="form-control form_origin" name="param{{ $paramCol }}" value="{{ $item['param' . $paramCol] }}" placeholder="{{ $paramCol }}. other parameters">
                        <textarea class="form-control text" name="param_text{{ $paramCol }}" placeholder="{{ $paramCol }}. explane other parameters">{{ $item['param_text' . $paramCol] }}</textarea>
                    @endfor
                </div>
                <div class="form-group">
                    @for ($groupbyCol = 1; $groupbyCol <= $group_by_col_cnt; $groupbyCol++)
                        <input type="text" id="group_by{{ $groupbyCol }}" class="form-control form_origin pull-left" name="group_by{{ $groupbyCol }}" value="{{ $item['group_by' . $groupbyCol] }}" placeholder='{{ $groupbyCol }}. specified "GROUP BY" table column'>
                    @endfor
                </div>
                
                <div class="form-group">
                    <button type="button" class="btn btn-primary btn-lg pull-right" onclick="submitBtn();">Submit</button>
                </div>

            </div>
        </div>
    </div>

    <input type="hidden" value="{{ $item['id'] }}" name="id">

</form>

<style>
    .form-group {
        width: 49% !important;
        float: left;
    }
    .form-group-head {
	    width: 30% !important;
    }
    .form_origin {
        margin: 10px;
        width: 30%;
    }
    .form_origin_head {
        margin: 10px;
        width: 90%;        
    }
    .text {
        margin: 10px;
        width: 80%;
    }
</style>

<script type="text/javascript">

    @if (!empty($item['method']))
        document.getElementById("method").value = '{{ $item["method"] }}';
    @endif
    @if (!empty($item['db_name']))
        document.getElementById("db_name").value = '{{ $item["db_name"] }}';
    @endif

    <?php // submit button ?>
    function submitBtn() {
        if (window.confirm('Do you want to register the data')) {
            document.submitForm.submit();
        }
    }

    <?php // control unavaliale api name ?>
    function convert_string(str = '') {
        return str.replace(/ |　|\//g, '');
    }

</script>

@endsection
