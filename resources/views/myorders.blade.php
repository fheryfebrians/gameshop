@extends('master')
@section("content")
<div class="custom-product">
    <div class="col-sm-8">
        <div class="trending-wrapper">
            <h4>
                @if (Session::get('user')->role == 1)
                    All Transaction
                @else
                    My Orders
                @endif
            </h4>

            @foreach($orders as $item)
            <div class="row searched-item cart-list-devider">
                <div class="col-sm-3">
                    <a href="@if(Session::get('user')->role == 1) {{ route('transaction.edit', $item->id) }} @else {{ route('product.detail', $item->product->id) }} @endif">
                        <img class="trending-image" src="{{ asset('storage/images/'.$item->product->gallery) }}">
                    </a>
                </div>
                <div class="col-sm-9">
                    <div class="order-details">
                        <h2 class="myorder">{{$item->name}}</h2>
                        <div class="order-info">
                            <div class="order-info-item">
                                <span class="label" style="color: #000;">Delivery Status:</span>
                                <span class="value">{{$item->status}}</span>
                            </div>
                            <div class="order-info-item">
                                <span class="label" style="color: #000;">Address:</span>
                                <span class="value">{{$item->address}}</span>
                            </div>
                            <div class="order-info-item">
                                <span class="label" style="color: #000;">Price:</span>
                                <span class="value">Rp.{{$item->product->price}},-</span>
                            </div>
                            <div class="order-info-item">
                                <span class="label" style="color: #000;">Payment Status:</span>
                                <span class="value">{{$item->payment_status}}</span>
                            </div>
                            <div class="order-info-item">
                                <span class="label" style="color: #000;">Payment Method:</span>
                                <span class="value">{{$item->payment_method}}</span>
                            </div>
                            <div class="order-info-item">
                                <span class="label" style="color: #000;">Proof of Payment:</span>
                                <span class="value">
                                    @if($item->proof)
                                            @php
                                            $proofPath = ltrim($item->proof, '/');
                                        @endphp
                                        <a href="{{ asset($proofPath) }}" target="_blank">Open Proof</a>
                                    @else
                                        No proof of payment provided.
                                    @endif
                                </span>
                            </div>
                            <div class="order-info-item">
                                <span class="label" style="color: #000;">Nama Penjual:</span>
                                <span class="value">{{$item->product->penjual->name}}</span>
                            </div>
                            <div class="order-info-item">
                                <span class="label" style="color: #000;">Nama Pembeli:</span>
                                <span class="value">{{$item->pembeli->name}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
