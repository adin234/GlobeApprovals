@extends('user.dashboard')

@section('content')
    @if (count($errors))
    <div class="alert alert-danger alert-dismissible" role="alert">
        {{ $errors->first('date') }}
        {{ $errors->first('purpose') }}
        {{ $errors->first('dates_activity') }}
        {{ $errors->first('amount') }}
        {{ $errors->first('breakdown') }}
    </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Apply <small>Cash Advance</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/user/dashboard">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-bar-chart-o"></i> Cash Advance
                </li>
            </ol>
        </div>
    </div>
    <form class="form-horizontal" role="form" method="post">
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Date</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="" name="application_date" placeholder="12-24-2014" value="{{Input::old('application_date')}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Purpose</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="purpose" placeholder="Purpose">{{Input::old('purpose')}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Date/s of activity</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="dates_activity" placeholder="12-24-2014, 12-25-2014">{{Input::old('dates_activity')}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Amount</label>
            <div class="col-sm-10">
                <div class="input-group">
                    <div class="input-group-addon">P</div>
                    <input class="form-control" name="amount" type="text" placeholder="123,456.00" value="{{Input::old('amount')}}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Breakdown</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="breakdown" placeholder="P1000.00 - Food">{{Input::old('breakdown')}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@stop