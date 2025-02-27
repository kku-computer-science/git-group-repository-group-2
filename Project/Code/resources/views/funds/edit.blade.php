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
    <strong>{{ __('message.whoops') }}</strong> {{ __('message.problem_with_input') }}<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card" style="padding: 16px;">
            <div class="card-body">
            <h4 class="card-title">{{ __('message.edit_fund') }}</h4>
                <p class="card-description">{{ __('message.enter_research_grant_details') }}</p>
                <form class="forms-sample" action="{{ route('funds.update',$fund->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group row">
                        <p class="col-sm-3"><b>{{ __('message.fund_type') }}</b></p>
                        <div class="col-sm-4">
                            <select name="fund_type" class="custom-select my-select" id="fund_type" onchange='toggleDropdown(this);' required>
                                <option value="ทุนภายใน" {{ $fund->fund_type == 'ทุนภายใน' ? 'selected' : '' }}>{{ __('message.internal_fund') }}</option>
                                <option value="ทุนภายนอก" {{ $fund->fund_type == 'ทุนภายนอก' ? 'selected' : '' }}>{{ __('message.external_fund') }}</option>
                            </select>
                        </div>
                    </div>

                    <div id="fund_code">
                        <div class="form-group row">
                            <p class="col-sm-3"><b>{{ __('message.fund_level') }}</b></p>
                            <div class="col-sm-4">
                                <select name="fund_level" class="custom-select my-select">
                                    <option value=""{{ $fund->fund_level == '' ? 'selected' : '' }}>{{ __('message.not_specified') }}</option>
                                    <option value="สูง" {{ $fund->fund_level == 'สูง' ? 'selected' : '' }}>{{ __('message.high') }}</option>
                                    <option value="กลาง" {{ $fund->fund_level == 'กลาง' ? 'selected' : '' }}>{{ __('message.medium') }}</option>
                                    <option value="ล่าง" {{ $fund->fund_level == 'ล่าง' ? 'selected' : '' }}>{{ __('message.low') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <p class="col-sm-3"><b>{{ __('message.fund_name') }}</b></p>
                        <div class="col-sm-8">
                            <input type="text" name="fund_name" value="{{ $fund->fund_name }}" class="form-control" placeholder="{{ __('message.fund_name_placeholder') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <p class="col-sm-3"><b>{{ __('message.support_resource') }}</b></p>
                        <div class="col-sm-8">
                            <input type="text" name="support_resource" value="{{ $fund->support_resource }}" class="form-control" placeholder="{{ __('message.support_resource_placeholder') }}">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-5">{{ __('message.submit') }}</button>
                    <a class="btn btn-light mt-5" href="{{ route('funds.index') }}">{{ __('message.cancel') }}</a>
                </form>

            </div>
        </div>
    </div>

</div>

<script>
    const ac = document.getElementById("fund_code");
    const ab = document.getElementById("fund_type").value;
    //console.log(ab);
    if (ab === "ทุนภายนอก") {
        ac.style.display = "none";
    }

    //ac.style.display = "none";

    function toggleDropdown(selObj) {
        ac.style.display = selObj.value === "ทุนภายใน" ? "block" : "none";
    }
</script>
@endsection