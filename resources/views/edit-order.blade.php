@extends('master')
@section("content")
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <img class="trending-image" src="{{ asset('storage/images/'.$order->product->gallery) }}">
        </div>
        <div class="col-sm-6">
            <a href="/">Go Back</a>
            <h2>{{$order->product->name}}</h2>
            <h3>Price: Rp.{{$order->product->price}},-</h3>
            <h4>Details: {{$order->product->description}}</h4>
            <h4>Category: {{$order->product->category}}</h4>
            <h5>Nama Penjual: {{ $order->product->penjual->name }}</h5>
            <br><br>
            <form action="{{ route('transaction.update', $order->id) }}" method="POST">
                @method('PUT')
                @csrf
                <label class="form-label">Payment Status</label>
                <select name="payment_status" class="form-control">
                    <option value="cancel" @if($order->payment_status == "cancel") selected @endif>Cancelled</option>
                    <option value="pending" @if($order->payment_status == "pending") selected @endif>Pending</option>
                    <option value="approve" @if($order->payment_status == "approve") selected @endif>Approve</option>
                </select>
                <br>
                <label class="form-label">Delivery Status</label>
                <select name="status" class="form-control">
                    <option value="sedang dikirim" @if($order->status == "sedang dikirim") selected @endif>Sedang Dikirim</option>
                    <option value="pending" @if($order->status == "pending") selected @endif>Pending</option>
                    <option value="terkirim" @if($order->status == "terkirim") selected @endif>Terkirim</option>
                </select>
                <br>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
            {{-- <br><br>
            <button class="btn btn-success">Buy Now</button>
            <br><br> --}}
        </div>
    </div>
</div>
@endsection
