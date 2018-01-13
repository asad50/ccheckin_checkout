@extends('layouts.app')

@section('content')
<script src="{{ asset('/js/home.js') }}" type="text/javascript"></script>
<div class="container">

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="alert alert-info">
                <div class="container-fluid">
                    <div class="alert-icon">
                        <i class="material-icons">info_outline</i>
                    </div>
                    <b>{{$data['greeting']}}:</b> {{$data['today']}}
                </div>
            </div>
        </div>
    </div>
    <div class="row" style='margin-bottom:20px'>
        <div class="col-md-10 col-md-offset-1" >
            @if ($data['checkin'])
                <form method="post" id="checkin_form" class="form-horizontal" action="#">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" onclick="check_in();" class="btn btn-success  btn-lg col-md-10"><i class="material-icons">favorite</i> Check Inn</button>
                </form>
            @endif
            @if ($data['checkout'])
                <form id="checkout_form" class="form-horizontal" action="#">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" onclick="check_out();" class="btn btn-danger btn-lg col-md-10"><i class="material-icons">favorite</i> Check Out</button>
                </form>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Check In Hostory
                </div>

                <div class="panel-body">
                    <table class="table table-bordered table-hover table-striped ">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Date</th>
                                <th>IP Address</th>
                                <th>Checkin</th>
                                <th>Checkout</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td>01-01-2018</td>
                                <td>192.168.1.10</td>
                                <td>01-13-2018 01:10AM</td>
                                <td>01-13-2018 01:10AM</td>
                                <td class="td-actions text-center">
                                    <button type="button" rel="tooltip" title="Claim" class="btn btn-info btn-simple btn-xs">
                                        <i class="fa fa-user"></i>
                                    </button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    <ul class="pagination pagination-primary pull-right">
                        <li><a href="#"><</a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
