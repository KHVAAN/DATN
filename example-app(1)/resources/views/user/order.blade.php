@extends('layout.master')

@section('title', 'Đơn Hàng')

@section('content')
    <div class="about-us">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="left-content">
                        <li><a href="/thong-tin-khach-hang">Thông tin tài khoản</a></li>
                        <li><a href="{{ url('/order') }}">Đơn hàng của bạn</a></li>
                        <li><a href="/doi-mat-khau">Đổi mật khẩu</a></li>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="right-content">
                        <h4>ĐƠN HÀNG CỦA BẠN</h4>
                        <table class="table">
                            <thead class="thead-default">
                                <tr>
                                    <th>STT</th>
                                    <th>Mã đơn hàng</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                    <th>Địa chỉ</th>
                                    <th>TT thanh toán</th>
                                    <th>TT đơn hàng</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->order_detail->ma_hd }}</td>
                                        <td>{{ $item->order_detail->soluong }}</td>
                                        <td>{{ number_format($item->order_detail->thanhtien) }}đ</td>
                                        <td>{{ $item->order_detail->diachi }}</td>
                                        <td>
                                            @if ($order->ttthanhtoan == 0)
                                                Chưa thanh toán
                                            @else
                                                Đã thanh toán
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->ttvanchuyen == 0)
                                                Chờ xác nhận
                                            @elseif ($item->ttvanchuyen == 1)
                                                Chờ lấy hàng
                                            @elseif ($item->ttvanchuyen == 2)
                                                Chờ giao hàng
                                            @elseif ($item->ttvanchuyen == 3)
                                                Đã giao
                                            @elseif ($item->ttvanchuyen == 4)
                                                Đã hủy
                                            @elseif ($item->ttvanchuyen == 5)
                                                Trả hàng
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->ttvanchuyen == 0)
                                                <form
                                                    action=""
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Hủy hàng</button>
                                                </form>
                                            @elseif ($item->ttvanchuyen == 1)
                                                <button disabled class="btn btn-secondary">Chờ giao hàng</button>
                                            @elseif ($item->ttvanchuyen == 2 && $item->ttthanhtoan == 1)
                                                <button type="submit" class="btn btn-primary">Đánh giá</button>
                                                <button type="submit" class="btn btn-success">Mua lại</button>
                                                <button type="submit" class="btn btn-warning">Hoàn trả</button>
                                            @elseif ($item->ttvanchuyen == 3)
                                                <button disabled class="btn btn-secondary">Đã hủy đơn hàng</button>
                                                <button type="submit" class="btn btn-success">Mua lại</button>
                                            @endif
                                        </td>
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
