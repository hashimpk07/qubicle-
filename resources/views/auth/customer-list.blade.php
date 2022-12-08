@extends('dashboard')
@section('content')
<!-- /.card-header -->

<div class="card-body">
    <h5> Students Table</h5>
    <?php
    if( 0  != $customers->total() ){?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Referral Code</th>
                <th>Level</th>
                <th>Points</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $i = ($customers->perPage() * ($customers->currentPage() - 1)) + 1; ?>
            @foreach($customers as $customer)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->referral_code }}</td>
                <td>{{ $customer->customerDetails->level }}</td>
                <td>{{ $customer->customerDetails->points }}</td>
            </tr>
            @endforeach 
        </tbody>
    </table>
</div>
<?php } else{?> 
<img src="{{url('/images/norecordfound.png')}}" class="no-data-found" style="width: 100%;" />
    <?php } ?>
</div>
<!-- /.card-body -->
<div class="card-footer clearfix">
    <ul class="pagination pagination-sm m-0 float-right">
        {!! $customers->links('pagination::bootstrap-4') !!}
    </ul>
</div>
@endsection