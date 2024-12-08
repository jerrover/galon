@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add New Transaction</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('transactions.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Customer</label>
                            <select name="customer_id" class="form-control" required>
                                <option value="">Select Customer</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Galon Out</label>
                            <input type="number" name="galon_out" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Galon In</label>
                            <input type="number" name="galon_in" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Transaction Date</label>
                            <input type="date" name="transaction_date" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Total Price</label>
                            <input type="number" name="total_price" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Transaction</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 