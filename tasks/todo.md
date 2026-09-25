# Kế hoạch triển khai Bổ sung Bác sĩ theo Chi nhánh & Quản lý trong Admin

## 1. Khảo sát & Chuẩn bị
- [x] Đọc cấu trúc code, models, controllers, seeders, views.
- [x] Phân tích danh sách bác sĩ & nhân sự các cơ sở: Cờ Đỏ, Phong Điền, Trà Nóc, An Lạc Thôn, 1000.
- [x] Thiết kế schema bảng `doctors` có liên kết `center_id` tới bảng `centers`.

## 2. Thiết kế Database & Model
- [x] Tạo Migration `create_doctors_table` (id, center_id, name, title, role, avatar, phone, bio, sort_order, is_active).
- [x] Tạo Model [Doctor.php](file:///c:/Users/Admin/Desktop/tiemchung/modules/VaccineRegistration/Models/Doctor.php) với relationships `belongsTo(Center::class)`, scopes.
- [x] Thêm quan hệ `doctors()` trong Model [Center.php](file:///c:/Users/Admin/Desktop/tiemchung/modules/VaccineRegistration/Models/Center.php).

## 3. Seeders dữ liệu chuẩn theo chi nhánh
- [x] Tạo [DoctorSeeder.php](file:///c:/Users/Admin/Desktop/tiemchung/modules/VaccineRegistration/Database/Seeders/DoctorSeeder.php) nạp chính xác danh sách nhân sự y tế cho 5 chi nhánh.
- [x] Cập nhật [DatabaseSeeder.php](file:///c:/Users/Admin/Desktop/tiemchung/database/seeders/DatabaseSeeder.php) gọi `DoctorSeeder`.

## 4. Quản trị Admin điều chỉnh Bác sĩ theo Chi nhánh
- [x] Tạo Controller [AdminDoctorController.php](file:///c:/Users/Admin/Desktop/tiemchung/modules/VaccineRegistration/Http/Controllers/Admin/AdminDoctorController.php) đầy đủ CRUD (thêm, sửa, xóa, lọc theo chi nhánh, tìm kiếm, kích hoạt/tạm dừng).
- [x] Đăng ký route quản trị bác sĩ trong [modules/VaccineRegistration/routes/web.php](file:///c:/Users/Admin/Desktop/tiemchung/modules/VaccineRegistration/routes/web.php).
- [x] Tạo các Blade views: `index.blade.php`, `_table.blade.php`, `_form.blade.php`, `create.blade.php`, `edit.blade.php`.
- [x] Bổ sung menu "Bác sĩ & Nhân sự" vào Sidebar / Header Navigation [layouts/admin.blade.php](file:///c:/Users/Admin/Desktop/tiemchung/modules/VaccineRegistration/resources/views/layouts/admin.blade.php).
- [x] Bổ sung nút liên kết nhanh "Bác sĩ" trong danh sách chi nhánh [admin/centers/_table.blade.php](file:///c:/Users/Admin/Desktop/tiemchung/modules/VaccineRegistration/resources/views/admin/centers/_table.blade.php).

## 5. Cập nhật Giao diện hiển thị Frontend
- [x] Cập nhật [about.blade.php](file:///c:/Users/Admin/Desktop/tiemchung/modules/VaccineRegistration/resources/views/about.blade.php) và [HomeController.php](file:///c:/Users/Admin/Desktop/tiemchung/modules/VaccineRegistration/Http/Controllers/HomeController.php): Gỡ bỏ hoàn toàn thanh nút/pill chọn chi nhánh dư thừa ở thân trang; trực tiếp ràng buộc và hiển thị đúng bác sĩ của chi nhánh được chọn từ dropdown Header trên cùng (`$currentCenter`).
- [x] Cập nhật [about.blade.php](file:///c:/Users/Admin/Desktop/tiemchung/modules/VaccineRegistration/resources/views/about.blade.php), [SiteContentRegistry.php](file:///c:/Users/Admin/Desktop/tiemchung/modules/VaccineRegistration/Support/SiteContentRegistry.php) và [live_editor.blade.php](file:///c:/Users/Admin/Desktop/tiemchung/modules/VaccineRegistration/resources/views/admin/live_editor.blade.php): Cập nhật văn bản Câu chuyện Medicare theo yêu cầu; bỏ thẻ "Năm Kinh Nghiệm"; tự động tính và hiển thị số lượng trung tâm tiêm chủng theo số chi nhánh hoạt động thay vì nhập thủ công trong admin.
- [x] Canh giữa 2 hộp thống kê trong [about.blade.php](file:///c:/Users/Admin/Desktop/tiemchung/modules/VaccineRegistration/resources/views/about.blade.php); sửa triệt để lỗi HTTP 500 trên trang Quản lý Bác sĩ (`/admin/doctors`) bằng cách bổ sung `currentCenterId()` trong [AdminContext.php](file:///c:/Users/Admin/Desktop/tiemchung/modules/VaccineRegistration/Support/AdminContext.php).
- [x] Cập nhật [contact.blade.php](file:///c:/Users/Admin/Desktop/tiemchung/modules/VaccineRegistration/resources/views/contact.blade.php) hiển thị đội ngũ chuyên môn cơ sở trên từng card chi nhánh.
- [x] Cập nhật [HomeController.php](file:///c:/Users/Admin/Desktop/tiemchung/modules/VaccineRegistration/Http/Controllers/HomeController.php) nạp bác sĩ theo từng chi nhánh.

## 6. Triển khai, Kiểm chứng & Báo cáo
- [x] Chạy migration và seed 16 bác sĩ & nhân sự thuộc 5 chi nhánh trên live database.
- [x] Kiểm chứng live site: `https://tiemchungcantho.vn/about` (HTTP 200, 16 nhân sự, tabs lọc hoạt động), `https://tiemchungcantho.vn/contact` (HTTP 200).
- [x] Cập nhật [CHANGELOG.md](file:///c:/Users/Admin/Desktop/tiemchung/CHANGELOG.md) theo chuẩn.
- [x] Báo cáo kết quả chi tiết cho người dùng.
