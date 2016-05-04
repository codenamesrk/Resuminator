@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Payments</div>

                <div class="panel-body">
{{-- 					<h3>Payment Check</h3>
                    <form action="{{ route('admin::dashboard.post.payments') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="tid" value="dummytidvalue">
                        <input type="hidden" name="order_id" value="orderId">
                        <input type="hidden" name="amount" value="1200.00">
                        <input type="submit" value="Pay">
                    </form> --}}
                   <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>           
                                    <th>Transaction Id</th>
                                    <th>User</th>                                    
                                    <th>Resume</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $index => $payment)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $payment->transaction_id }}</td>
                                    <td>{{ $payment->user->email }}</td>
                                    <td>{{ $payment->resume->name }}</td>                                    
                                    <td>{{ $payment->created_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>                        
                    </div>
                    <!-- /.table-responsive -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection