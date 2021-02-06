@extends('layouts.app')
@section('title', '| Payment & Transaction')

@section('theme_script')
    <script type="text/javascript" src="{{ asset('assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/datatables_basic.js') }}"></script>
@endsection
@section('content')
   
    <div class="content-wrapper affirmation-quote">
        <div>
            <div class="page-header page-header-default">
                <div class="page-header-content">
                    <div class="page-title" style="padding-right:0">
                        <div style="display:inline-block">
                            <h4>Payment & Transction</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="panel panel-flat">
                    <div class="table-responsive display nowrap" style="margin: 25px 0;">
                        <table class="table datatable-basic table-style"width="100%">
                            <thead>
                                <tr>
                                    <th>Sr.no</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Transaction ID</th>
                                    <th>Service Name</th>
                                    <th>Date & Time</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $key => $data)    
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $data->users->name }}</td>
                                        <td>{{ $data->users->email }}</td>
                                        <td>{{ $data->transaction_id }}</td>
                                        <td>{{ $data->services->service_name }}</td>
                                        <td>{{ $data->created_at }}</td>
                                        <td>${{ $data->amount }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

