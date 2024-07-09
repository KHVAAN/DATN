<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="/css_ad/css/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!-- or -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}">
</head>

<body onload="time()" class="app sidebar-mini rtl">
    @include('layout.header_ad')

    @include('layout.sidebar')

    <div class="content">
        @yield('content')
    </div>
    @include('sweetalert::alert')

    <script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <!-- Navbar-->
    <script src="/js_ad/js/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="/js_ad/js/popper.min.js"></script>
    <script src="https://unpkg.com/boxicons@latest/dist/boxicons.js"></script>
    <!--===============================================================================================-->
    <script src="/js_ad/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="/js_ad/js/main.js"></script>
    <!--===============================================================================================-->
    <script src="/js_ad/js/plugins/pace.min.js"></script>
    <!--===============================================================================================-->
    <script type="text/javascript" src="/js_ad/js/plugins/chart.js"></script>
    <!--===============================================================================================-->
    <script type="text/javascript">
        var data = {
            labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6"],
            datasets: [{
                    label: "Dữ liệu đầu tiên",
                    fillColor: "rgba(255, 213, 59, 0.767), 212, 59)",
                    strokeColor: "rgb(255, 212, 59)",
                    pointColor: "rgb(255, 212, 59)",
                    pointStrokeColor: "rgb(255, 212, 59)",
                    pointHighlightFill: "rgb(255, 212, 59)",
                    pointHighlightStroke: "rgb(255, 212, 59)",
                    data: [20, 59, 90, 51, 56, 100]
                },
                {
                    label: "Dữ liệu kế tiếp",
                    fillColor: "rgba(9, 109, 239, 0.651)  ",
                    pointColor: "rgb(9, 109, 239)",
                    strokeColor: "rgb(9, 109, 239)",
                    pointStrokeColor: "rgb(9, 109, 239)",
                    pointHighlightFill: "rgb(9, 109, 239)",
                    pointHighlightStroke: "rgb(9, 109, 239)",
                    data: [48, 48, 49, 39, 86, 10]
                }
            ]
        };
        var ctxl = $("#lineChartDemo").get(0).getContext("2d");
        var lineChart = new Chart(ctxl).Line(data);

        var ctxb = $("#barChartDemo").get(0).getContext("2d");
        var barChart = new Chart(ctxb).Bar(data);
    </script>

    <script type="text/javascript">
        //Thời Gian
        function time() {
            var today = new Date();
            var weekday = new Array(7);
            weekday[0] = "Chủ Nhật";
            weekday[1] = "Thứ Hai";
            weekday[2] = "Thứ Ba";
            weekday[3] = "Thứ Tư";
            weekday[4] = "Thứ Năm";
            weekday[5] = "Thứ Sáu";
            weekday[6] = "Thứ Bảy";
            var day = weekday[today.getDay()];
            var dd = today.getDate();
            var mm = today.getMonth() + 1;
            var yyyy = today.getFullYear();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            nowTime = h + " giờ " + m + " phút " + s + " giây";
            if (dd < 10) {
                dd = '0' + dd
            }
            if (mm < 10) {
                mm = '0' + mm
            }
            today = day + ', ' + dd + '/' + mm + '/' + yyyy;
            tmp = '<span class="date"> ' + today + ' - ' + nowTime +
                '</span>';
            document.getElementById("clock").innerHTML = tmp;
            clocktime = setTimeout("time()", "1000", "Javascript");

            function checkTime(i) {
                if (i < 10) {
                    i = "0" + i;
                }
                return i;
            }
        }
    </script>
    {{-- Chuyển page active --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Lấy URL hiện tại của trang
            var url = window.location.href;

            // Thêm class "active" cho liên kết tương ứng với URL hiện tại
            $('.app-menu a').each(function() {
                if (url.includes($(this).attr('href'))) {
                    $(this).addClass('active');
                }
            });

            // Giữ "Quản lí sản phẩm" active khi ở trang "Tạo mới sản phẩm"
            if (url.includes('them-san-pham')) {
                $('.app-menu a[href*="quan-li-san-pham"]').addClass('active');
            }

            // Giữ "Quản lí nhân viên" active khi ở trang "Tạo mới nhân viên"
            if (url.includes('them-nhan-vien')) {
                $('.app-menu a[href*="quan-li-nhan-vien"]').addClass('active');
            }

            // Giữ "Quản lí khách hàng" active khi ở trang "Tạo mới khách hàng"
            if (url.includes('them-khach-hang')) {
                $('.app-menu a[href*="quan-li-khach-hang"]').addClass('active');
            }

            // Giữ "Quản lí nhân viên" active khi ở trang "Tạo mới quản trị viên"
            if (url.includes('them-admin')) {
                $('.app-menu a[href*="quan-li-nhan-vien"]').addClass('active');
            }

            // Giữ "Quản lí nhân viên" active khi ở trang "Tạo mới quản trị viên"
            if (url.includes('chinh-sua-tai-khoan')) {
                $('.app-menu a[href*="quan-li-nhan-vien"]').addClass('active');
            }

            // Giữ "Quản lí sản phẩm" active khi ở trang "Chỉnh sửa sản phẩm"
            if (url.includes('chinh-sua-san-pham')) {
                $('.app-menu a[href*="quan-li-san-pham"]').addClass('active');
            }

            // Giữ "Quản lí sản phẩm" active khi ở trang "Chi tiết sản phẩm"
            if (url.includes('chi-tiet-san-pham')) {
                $('.app-menu a[href*="quan-li-san-pham"]').addClass('active');
            }

            // Giữ "Quản lí nhân viên" active khi ở trang "Chi tiết qtv"
            if (url.includes('chi-tiet-admin')) {
                $('.app-menu a[href*="quan-li-nhan-vien"]').addClass('active');
            }

            // Giữ "Quản lí khách hàng" active khi ở trang "Chi tiết qtv"
            if (url.includes('chi-tiet-user')) {
                $('.app-menu a[href*="quan-li-khach-hang"]').addClass('active');
            }

            // Giữ "Danh sách chung" active khi ở trang "Chỉnh sửa nhãn hiệu"
            if (url.includes('chinh-sua-nhan-hieu')) {
                $('.app-menu a[href*="danh-sach-chung"]').addClass('active');
            }
        });
    </script>

    <script>
        //In dữ liệu
        var myApp = new function() {
            this.printTable = function() {
                var tab = document.getElementById('sampleTable');
                var win = window.open('', '', 'height=700,width=700');
                win.document.write(tab.outerHTML);
                win.document.close();
                win.print();
            }
        }
        //Sao chép dữ liệu
        var copyTextareaBtn = document.querySelector('.js-textareacopybtn');

        copyTextareaBtn.addEventListener('click', function(event) {
            var copyTextarea = document.querySelector('.js-copytextarea');
            copyTextarea.focus();
            copyTextarea.select();

            try {
                var successful = document.execCommand('copy');
                var msg = successful ? 'successful' : 'unsuccessful';
                console.log('Copying text command was ' + msg);
            } catch (err) {
                console.log('Oops, unable to copy');
            }
        });
    </script>

    <script>
        function readURL(input, thumbimage) {
            if (input.files && input.files[0]) { //Sử dụng  cho Firefox - chrome
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#thumbimage").attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            } else { // Sử dụng cho IE
                $("#thumbimage").attr('src', input.value);

            }
            $("#thumbimage").show();
            $('.filename').text($("#uploadfile").val());
            $('.Choicefile').css('background', '#14142B');
            $('.Choicefile').css('cursor', 'default');
            $(".removeimg").show();
            $(".Choicefile").unbind('click');

        }
        $(document).ready(function() {
            $(".Choicefile").bind('click', function() {
                $("#uploadfile").click();

            });
            $(".removeimg").click(function() {
                $("#thumbimage").attr('src', '').hide();
                $("#myfileupload").html('<input type="file" id="uploadfile"  onchange="readURL(this);" />');
                $(".removeimg").hide();
                $(".Choicefile").bind('click', function() {
                    $("#uploadfile").click();
                });
                $('.Choicefile').css('background', '#14142B');
                $('.Choicefile').css('cursor', 'pointer');
                $(".filename").text("");
            });
        })
    </script>

</body>

</html>
