@extends('dashboardtemplate')

@section('sidebar')
<li class="active">
    <a href="/user/dashboard"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
</li>
<li>
    <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-exchange"></i> Apply <i class="fa fa-fw fa-caret-down"></i></a>
    <ul id="demo" class="collapse">
        <li>
            <a href="/user/apply/cash-advance"><i class="fa fa-fw fa-money"></i>Cash Advance</a>
        </li>
        <li>
            <a href="#">Request for Payment</a>
        </li>
        <li>
            <a href="#">Purchase Request</a>
        </li>
        <li>
            <a href="#">Liquidation</a>
        </li>
    </ul>
</li>
@stop

@section('content')
   <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Dashboard <small>Statistics Overview</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Dashboard
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    @if (isset($message))
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ $message }}
            </div>
        </div>
    </div>
    @endif
    <!-- /.row -->

    <!-- /.row -->
    <div class="row">
    	<div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Transactions Panel</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Application #</th>
                                    <th>Application Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $transaction)
								    <tr>
								    	<td><a href="/user/transactions/{{ $transaction->id }}">{{ $transaction->id }}</a></td>
								    	<td>{{ $transaction->application_date }}</td>
								    	<td>{{ $transaction->amount }}</td>
								    	<td>{{ $transaction->status }}</td>
								    </tr>
								@empty
								    <tr>
								    	<td colspan="4">There are not transactions yet!</td>
								    </tr>
								@endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="text-right">
                        <a href="#">View All Transactions <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
@stop