@extends('user.dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Dashboard <small>Transaction {{ $id }}</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/user/dashboard">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-bar-chart-o"></i> Transaction
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td colspan="2">
                            <b>Transaction Details</b>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="mark">
                            Amount
                        </td>
                        <td>
                            {{ $transaction->amount }}
                        </td>
                    </tr>
                    <tr>
                        <td class="mark">
                            Date
                        </td>
                        <td>
                            {{ $transaction->application_date }}
                        </td>
                    </tr>
                    <tr>
                        <td class="mark">
                            Status
                        </td>
                        <td>
                            {{ $transaction->status }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <style type="text/css">
        .comment .head {
            background: #f5f5f5;
            padding: 5px 15px;
        }
        .comment {
            border: 1px solid #afafaf;
            margin-top: 3px;
            padding: 0;
        }
        .comment .message {
            margin: 0;
            padding: 5px 15px;
        }
        .comment .foot {
            border-top: 1px solid #afafaf;
            text-align: right;
            font-size: 10px;
            font-style: italic;
        }
    </style>
    <div class="row">
        <div class="col-lg-5">
        @forelse ($comments as $comment)
            <div class="comment col-lg-12">
                <div class="head clearfix">
                    <span class="sender pull-left">{{ $comment->first_name }} {{ $comment->last_name }}</span>
                    <span class="date pull-right"><small><i>{{ $comment->updated_at }}</i></small></span>
                </div>
                <p class="message">
                    {{ $comment->message }}
                </p>
                <div class="foot">
                    {{ $comment->status }}
                </div>
            </div>
        @empty
            <div class="comment col-lg-12">
                <p class="message">
                    No comments yet
                </p>
            </div>
        @endforelse
        </div>
    </div>
    <div class="row">
        <form method="POST" class="clearfix col-lg-5" style="margin-top: 10px">
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Comment</label>
                <div class="col-sm-10">
                    <textarea class="form-control" required name="message" placeholder="Comment"></textarea>
                </div>
            </div>
            <button class="btn btn-primary pull-right" style="margin-right: 15px; margin-top: 5px;">
                Submit
            </button>
        </form>
    </div>
@stop