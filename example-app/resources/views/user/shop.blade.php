@extends('layout.master')

@section('title', 'Sản Phẩm')

@section('content')
    <style>
        .product-img img {
            width: 100%;
            height: 400px;
            /* Chiều cao cố định cho hình ảnh */
            object-fit: cover;
            /* Đảm bảo hình ảnh được cắt đúng kích thước mà không bị méo */
        }

        .position-relative {
            position: relative;
        }

        .overlay-content {
            position: absolute;
            top: 80%;
            right: 10%;
            transform: translateY(-50%);
            color: white;
            text-align: center;
            background: rgba(0, 0, 0, 0.5);
            /* Màu nền mờ */
            padding: 20px;
            border-radius: 10px;
            font-style: italic;
        }
    </style>
    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="col-lg-12 col-md-12">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <form action="{{ route('tim-kiem') }}" method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search"
                                    placeholder="Nhập từ khóa tìm kiếm...">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        {{-- <div>
                            <select name="sort_by" id="sort_by" class="form-control mr-2">
                                <option value="default" {{ $sort_by === 'default' ? 'selected' : '' }}>Mặc định</option>
                                <option value="price_asc" {{ $sort_by === 'price_asc' ? 'selected' : '' }}>Giá tăng dần</option>
                                <option value="price_desc" {{ $sort_by === 'price_desc' ? 'selected' : '' }}>Giá giảm dần</option>
                                <option value="name_asc" {{ $sort_by === 'name_asc' ? 'selected' : '' }}>Tên A-Z</option>
                                <option value="name_desc" {{ $sort_by === 'name_desc' ? 'selected' : '' }}>Tên Z-A</option>
                            </select>
                        </div> --}}

                    </div>
                </div>

                @foreach ($products as $product)
                    <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                        <div class="card product-item border-0 mb-4">
                            <div
                                class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                @php
                                    $firstImage = $product->image->first();
                                @endphp
                                @if ($firstImage)
                                    <div
                                        class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                        <img class="img-fluid w-100" src="{{ asset('storage/' . $firstImage->tenimage) }}"
                                            alt="{{ $product->tensanpham }}">
                                    </div>
                                @endif
                            </div>
                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                <h6 class="text-truncate mb-3">
                                    <a href="{{ url('/detail', ['id' => $product->id]) }}">{{ $product->tensanpham }}
                                    </a>
                                </h6>
                                <div class="d-flex justify-content-center align-items-center">
                                    @if ($product->giamgia > 0)
                                        <div class="mb-2">
                                            <h5>{{ number_format($product->dongia * (1 - $product->giamgia / 100)) }}₫</h5>
                                            <div class="d-flex justify-content-center align-items-center mt-2">
                                                <h6 class="text-muted mb-0 mr-2">
                                                    <del>{{ number_format($product->dongia) }}₫</del>
                                                </h6>
                                                <span class="badge badge-danger">{{ $product->giamgia }}%</span>
                                            </div>
                                        </div>
                                    @else
                                        <h5>{{ number_format($product->dongia) }}₫</h5>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="col-12 pb-1">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center mb-3">
                            <!-- Nút Previous -->
                            @if ($products->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $products->previousPageUrl() }}" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                            @endif

                            <!-- Hiển thị các trang -->
                            @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                <li class="page-item {{ $page == $products->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach

                            <!-- Nút Next -->
                            @if ($products->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $products->nextPageUrl() }}" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
    <!-- Shop End -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function () {
        $('#sort_by').change(function () {
            var sort_by = $(this).val();
            var url = "{{ route('trang-san-pham') }}";
            if (sort_by !== 'default') {
                url += "?sort_by=" + sort_by;
            }
            window.location.href = url;
        });
    });
</script>

@endsection
