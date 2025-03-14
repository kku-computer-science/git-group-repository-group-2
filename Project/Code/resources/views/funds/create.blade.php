
@extends('dashboards.users.layouts.user-dash-layout')

@section('content')
<style>
    .my-select {
        background-color: #fff;
        color: #212529;
        border: #000 0.2 solid;
        border-radius: 10px;
        padding: 4px 10px;
        width: 100%;
        font-size: 14px;
    }
</style>
<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <!-- <a class="btn btn-primary" href="{{ route('funds.index') }}"> Back </a> -->
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ __('message.increase_research') }}</h4>
                <p class="card-description">{{ __( 'message.fill_research' ) }}</p>
                <form class="forms-sample" action="{{ route('funds.store') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="exampleInputfund_type" class="col-sm-2 ">{{ __( 'message.research_type' ) }}</label>
                        <div class="col-sm-4">
                            <select name="fund_type" class="custom-select my-select" id="fund_type" onchange='toggleDropdown(this);' required>
                                <option value="" disabled selected >{{ __( 'message.specify_type'  ) }}</option>
                                <option value="ทุนภายใน">{{ __( 'message.internal_fund' )}}</option>
                                <option value="ทุนภายนอก">{{ __( 'message.external_fund' )}}</option>
                            </select>
                        </div>
                    </div>
                    <div id="fund_code">
                        <div class="form-group row">
                            <label for="exampleInputfund_level" class="col-sm-2 ">{{ __( 'message.level' )}}</label>
                            <div class="col-sm-4">
                                <select name="fund_level" class="custom-select my-select">
                                <option value="" disabled selected >{{ __( 'message.specify_level' )}}</option>
                                    <option value="">{{ __( 'message.not_specified' )}}</option>
                                    <option value="สูง">{{ __( 'message.high' )}}</option>
                                    <option value="กลาง">{{ __( 'message.medium' )}}</option>
                                    <option value="ล่าง">{{ __( 'message.low' )}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputfund_name" class="col-sm-2 ">{{ __( 'message.research_fund_name' )}}</label>
                        <div class="col-sm-8">
                            <input type="text" name="fund_name" class="form-control" placeholder="name">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="exampleInputsupport_resource" class="col-sm-2 ">{{ __('message.supporting')}}</label>
                        <div class="col-sm-8">
                            <input type="text" name="support_resource" class="form-control" placeholder="Support Resource">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">{{ __( 'message.submit' )}}</button>
                    <a class="btn btn-light" href="{{ route('funds.index')}}">{{ __( 'message.cancel' ) }}</a>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    const ac = document.getElementById("fund_code");
    //ac.style.display = "none";

    function toggleDropdown(selObj) {
        ac.style.display = selObj.value === "ทุนภายใน" ? "block" : "none";
    }
</script>
@endsection