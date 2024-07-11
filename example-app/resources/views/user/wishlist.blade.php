@extends('layout.master')

@section('title', 'Danh sách yêu thích')

@section('content')
    <div class="row">
        @foreach ($favoriteProducts as $product)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top"
                        alt="{{ $product->tensanpham }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->tensanpham }}</h5>
                        <p class="card-text">Giá: {{ number_format($product->dongia) }} VNĐ</p>
                        <a href="" class="btn btn-primary">Xem chi
                            tiết</a>
                    </div>
                </div>
            </div>
        @endforeach
    @endsection
