# NongNghiepSo
# 🌾 SÀN THƯƠNG MẠI NÔNG NGHIỆP SỐ – CNPM PROJECT
> Ứng dụng web giúp kết nối người bán và người mua trong lĩnh vực nông sản, hỗ trợ quản lý đơn hàng, giỏ hàng, thanh toán, và phân loại sản phẩm theo danh mục như rau, củ, quả, thịt, cá,...

🚀 Tính năng chính

- 👩‍🌾 Đăng ký / Đăng nhập người dùng và người bán
- 🛒 Thêm sản phẩm vào giỏ hàng, xem giỏ hàng
- 📦 Quản lý đơn hàng theo trạng thái
- 🧾 Giao diện quản lý riêng cho người bán:
  - Quản lý sản phẩm đã đăng
  - Xem doanh thu
  - Duyệt đơn hàng
- 📊 Hiển thị danh mục sản phẩm:
  - Rau, thịt, cá, trái cây, gạo...
- 🔍 Tìm kiếm sản phẩm theo tên, lọc theo danh mục
- 💳 Thanh toán đơn hàng, lưu thông tin giao dịch
- 📱 Giao diện thân thiện với người dùng

🧑‍💻 Công nghệ sử dụng

- 🌐 HTML, CSS, JavaScript (Front-end tĩnh)
- 🐘 PHP thuần (Xử lý backend)
- 🗃️ MySQL (Quản lý dữ liệu sản phẩm, người dùng, đơn hàng)
- 📁 Phân chia cấu trúc rõ ràng: người dùng, người bán, xử lý PHP riêng

🗂️ Cấu trúc thư mục chính
CNPM_TEST/
├── index/                   # Trang giao diện người dùng
│   ├── TrangChu.html
│   ├── DangNhap.html
│   ├── DangKy.html
│   ├── SanPham.html
│   ├── DSHang.html
│   └── TrangGioHang.html
│
├── NguoiBan/                # Giao diện & xử lý người bán
│   ├── index/
│   │   ├── DoanhThu.html
│   │   ├── QuanLyDonHang.html
│   │   └── QuanLySanPham.html
│   └── css/
│       └── (style files)
│
├── css/                     # File CSS chia theo từng trang
├── images/                 # Hình ảnh sản phẩm
├── XuLy_php/               # Các file PHP xử lý logic
│   ├── connect.php
│   ├── dangnhap.php
│   ├── dangky.php
│   ├── thanhToanLuu.php
│   └── info_thanhToan.php
│
├── test/                   # Thư mục kiểm tra chức năng
├── Web Bán Hàng.sql        # Cơ sở dữ liệu
└── README.md
🛠️ Cài đặt & chạy dự án (local)
1. Clone hoặc tải về mã nguồn
2. Copy vào thư mục www (nếu dùng Wampserver64)
3. Tạo database mới, import file Web Bán Hàng.sql
4. Mở trình duyệt và truy cập: http://localhost/CNPM_TEST/index/TrangChu.html
