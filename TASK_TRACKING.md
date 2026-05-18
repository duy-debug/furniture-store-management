# TASK TRACKING - Hệ thống quản lý cửa hàng nội thất Thông Mai

> Cập nhật lần cuối: 2026-05-18
> Trạng thái: ⬜ Chưa làm | 🔄 Đang làm | ✅ Hoàn thành | ❌ Bị chặn

---

# Task 1: Thiết lập cơ sở dữ liệu và Migrations

Tạo đầy đủ các migration cho toàn bộ bảng trong hệ thống: users, roles, permissions, role_user, permission_role, categories, products, product_images, carts, cart_items, orders, order_items, order_status_logs, design_requests. Đảm bảo đúng kiểu dữ liệu, index, foreign key, soft delete theo schema trong db.sql.

| Thông tin | Chi tiết |
|-----------|----------|
| Trạng thái | ✅ Hoàn thành |
| Người thực hiện | |
| Deadline | |
| Ghi chú | |

---

# Task 2: Tạo Models và Relationships

Tạo đầy đủ Eloquent Models cho tất cả bảng nghiệp vụ: User, Role, Permission, Category, Product, ProductImage, Cart, CartItem, Order, OrderItem, OrderStatusLog, DesignRequest. Định nghĩa fillable, casts, relationships (belongsTo, hasMany, belongsToMany), soft deletes. Thêm helper methods hasRole() và hasPermission() cho User.

| Thông tin | Chi tiết |
|-----------|----------|
| Trạng thái | ✅ Hoàn thành |
| Người thực hiện | |
| Deadline | |
| Ghi chú | Models đã được tạo sẵn trong app/Models |

---

# Task 3: Seeders - Vai trò, Quyền và Dữ liệu mẫu

Tạo seeder cho roles (admin, staff, customer), permissions (toàn bộ 30 quyền theo bảng đề xuất), gán toàn bộ quyền cho admin, tạo tài khoản admin mặc định, tạo dữ liệu mẫu cho categories và products để test.

| Thông tin | Chi tiết |
|-----------|----------|
| Trạng thái | ✅ Hoàn thành |
| Người thực hiện | |
| Deadline | |
| Ghi chú | |

---

# Task 4: Middleware phân quyền động

Tạo middleware CheckPermission kiểm tra: đã đăng nhập, tài khoản không bị khóa, người dùng có quyền cần thiết (thông qua vai trò). Trả về 403 nếu không có quyền. Không hard-code vai trò, chỉ kiểm tra bằng mã quyền.

| Thông tin | Chi tiết |
|-----------|----------|
| Trạng thái | ✅ Hoàn thành |
| Người thực hiện | |
| Deadline | |
| Ghi chú | Middleware alias 'permission' đăng ký trong bootstrap/app.php |

---

# Task 5: Đăng ký tài khoản

Khách vãng lai đăng ký tài khoản khách hàng. Validate: họ tên, email (unique), số điện thoại (unique), mật khẩu, xác nhận mật khẩu. Hash mật khẩu, tạo user, gán vai trò customer. Hiển thị form đăng ký và xử lý lỗi validation.

| Thông tin | Chi tiết |
|-----------|----------|
| Trạng thái | ⬜ Chưa làm |
| Người thực hiện | |
| Deadline | |
| Ghi chú | Laravel Breeze đã có sẵn, cần customize thêm phone |

---

# Task 6: Đăng nhập

Đăng nhập bằng email hoặc số điện thoại + mật khẩu. Kiểm tra tài khoản tồn tại, mật khẩu đúng, tài khoản không bị khóa. Sau đăng nhập: khách hàng → giao diện khách, nhân viên/admin → trang quản trị. Cập nhật last_login_at.

| Thông tin | Chi tiết |
|-----------|----------|
| Trạng thái | ⬜ Chưa làm |
| Người thực hiện | |
| Deadline | |
| Ghi chú | Cần customize Breeze để hỗ trợ login bằng phone |

---

# Task 7: Đăng xuất

Xóa session, chuyển về trang chủ hoặc trang đăng nhập.

| Thông tin | Chi tiết |
|-----------|----------|
| Trạng thái | ⬜ Chưa làm |
| Người thực hiện | |
| Deadline | |
| Ghi chú | Breeze đã có sẵn |

---

# Task 8: Cập nhật thông tin cá nhân

Người dùng đã đăng nhập cập nhật: họ tên, số điện thoại, ngày sinh, giới tính, địa chỉ (address_line_1, address_line_2, ward, district, province, postal_code), cách liên hệ ưu tiên, ghi chú. Validate dữ liệu, hiển thị form với dữ liệu hiện tại.

| Thông tin | Chi tiết |
|-----------|----------|
| Trạng thái | ⬜ Chưa làm |
| Người thực hiện | |
| Deadline | |
| Ghi chú | |

---

# Task 9: Xem danh sách sản phẩm (Public)

Hiển thị sản phẩm đang active cho khách. Hỗ trợ: phân trang, sắp xếp (giá, tên, mới nhất), lọc theo danh mục, lọc theo khoảng giá, lọc theo trạng thái còn hàng. Hiển thị: tên, ảnh đại diện, giá, danh mục, trạng thái tồn kho, nút xem chi tiết, nút thêm giỏ hàng (nếu đã đăng nhập).

| Thông tin | Chi tiết |
|-----------|----------|
| Trạng thái | ⬜ Chưa làm |
| Người thực hiện | |
| Deadline | |
| Ghi chú | |

---

# Task 10: Xem chi tiết sản phẩm (Public)

Hiển thị đầy đủ thông tin sản phẩm: mã, tên, ảnh (gallery), mô tả, giá, kích thước, chất liệu, màu sắc, danh mục, tồn kho, trạng thái. Nếu hết hàng thì disable nút thêm giỏ. Sản phẩm bị ẩn → 404 cho khách.

| Thông tin | Chi tiết |
|-----------|----------|
| Trạng thái | ⬜ Chưa làm |
| Người thực hiện | |
| Deadline | |
| Ghi chú | |

---

# Task 11: Tìm kiếm sản phẩm

Tìm kiếm theo: tên, mã sản phẩm, danh mục, chất liệu, mô tả, khoảng giá. Kết hợp bộ lọc. Nếu không có kết quả → hiển thị "Không tìm thấy sản phẩm phù hợp".

| Thông tin | Chi tiết |
|-----------|----------|
| Trạng thái | ⬜ Chưa làm |
| Người thực hiện | |
| Deadline | |
| Ghi chú | |

---

# Task 12: Thêm vào giỏ hàng

Khách hàng đã đăng nhập thêm sản phẩm vào giỏ. Kiểm tra: sản phẩm tồn tại, đang hiển thị, còn hàng, số lượng không vượt tồn kho. Nếu đã có trong giỏ → tăng số lượng. Nếu chưa có → tạo mới cart_item. Tính lại tổng tiền giỏ hàng. Chưa đăng nhập → redirect login.

| Thông tin | Chi tiết |
|-----------|----------|
| Trạng thái | ⬜ Chưa làm |
| Người thực hiện | |
| Deadline | |
| Ghi chú | |

---

# Task 13: Xem và cập nhật giỏ hàng

Hiển thị: danh sách sản phẩm, ảnh, tên, số lượng, đơn giá, thành tiền, tổng tiền. Cho phép: tăng/giảm số lượng, xóa sản phẩm, làm trống giỏ. Validate: số lượng > 0, không vượt tồn kho. Tính lại tổng tiền sau mỗi thay đổi.

| Thông tin | Chi tiết |
|-----------|----------|
| Trạng thái | ⬜ Chưa làm |
| Người thực hiện | |
| Deadline | |
| Ghi chú | |

---

# Task 14: Đặt hàng (Checkout)

Khách hàng đặt hàng từ giỏ. Nhập: họ tên người nhận, SĐT, email, địa chỉ giao, ghi chú, phương thức thanh toán. Kiểm tra: giỏ không rỗng, sản phẩm còn hàng, số lượng không vượt tồn kho. Tạo order (pending), tạo order_items (snapshot giá/tên/ảnh), xóa giỏ hàng. Dùng transaction. CHƯA trừ kho khi đặt.

| Thông tin | Chi tiết |
|-----------|----------|
| Trạng thái | ⬜ Chưa làm |
| Người thực hiện | |
| Deadline | |
| Ghi chú | |

---

# Task 15: Xem lịch sử đơn hàng (Khách hàng)

Khách hàng xem đơn hàng của chính mình. Hiển thị: mã đơn, ngày đặt, tổng tiền, trạng thái. Phân trang, sắp xếp mới nhất trước. Chỉ xem được đơn của mình.

| Thông tin | Chi tiết |
|-----------|----------|
| Trạng thái | ⬜ Chưa làm |
| Người thực hiện | |
| Deadline | |
| Ghi chú | |

---

# Task 16: Xem chi tiết đơn hàng

Khách hàng xem chi tiết đơn của mình. Nhân viên/admin xem bất kỳ đơn nào (cần quyền order.detail). Hiển thị: mã đơn, thông tin khách, thông tin giao hàng, danh sách sản phẩm, số lượng, đơn giá, thành tiền, tổng tiền, trạng thái, lịch sử trạng thái.

| Thông tin | Chi tiết |
|-----------|----------|
| Trạng thái | ⬜ Chưa làm |
| Người thực hiện | |
| Deadline | |
| Ghi chú | |

---

# Task 17: Quản lý đơn hàng - Danh sách (Admin)

Nhân viên/admin có quyền order.view xem danh sách đơn hàng. Hỗ trợ: tìm theo mã đơn, tên KH, SĐT; lọc theo trạng thái, ngày đặt; sắp xếp mới nhất; phân trang.

| Thông tin | Chi tiết |
|-----------|----------|
| Trạng thái | ⬜ Chưa làm |
| Người thực hiện | |
| Deadline | |
| Ghi chú | |

---

# Task 18: Cập nhật trạng thái đơn hàng

Quyền: order.update_status. Trạng thái: pending → processing → preparing → shipping → completed / cancelled / returned. Khi pending → processing: kiểm tra tồn kho, nếu đủ thì trừ kho (dùng transaction). Mỗi cập nhật ghi vào order_status_logs (changed_by, from_status, to_status, note).

| Thông tin | Chi tiết |
|-----------|----------|
| Trạng thái | ⬜ Chưa làm |
| Người thực hiện | |
| Deadline | |
| Ghi chú | |

---

# Task 19: Hủy đơn hàng

Khách hàng hủy đơn pending của mình. Nhân viên/admin cần quyền order.cancel. Nhập lý do hủy. Nếu đơn chưa trừ kho → chỉ cập nhật trạng thái. Nếu đã trừ kho → cộng lại tồn kho (transaction). Ghi log trạng thái. Không cho hủy đơn đã hoàn thành.

| Thông tin | Chi tiết |
|-----------|----------|
| Trạng thái | ⬜ Chưa làm |
| Người thực hiện | |
| Deadline | |
| Ghi chú | |

---

# Task 20: Quản lý sản phẩm - Thêm sản phẩm

Quyền: product.create. Nhập: tên, mã (unique), danh mục, mô tả, giá (>=0), kích thước, chất liệu, màu sắc, tồn kho (>=0), hình ảnh, trạng thái. Validate đầy đủ, kiểm tra danh mục tồn tại, upload ảnh đúng định dạng, lưu product + product_images.

| Thông tin | Chi tiết |
|-----------|----------|
| Trạng thái | ⬜ Chưa làm |
| Người thực hiện | |
| Deadline | |
| Ghi chú | |

---

# Task 21: Quản lý sản phẩm - Cập nhật sản phẩm

Quyền: product.update. Sửa: tên, giá, mô tả, kích thước, chất liệu, danh mục, tồn kho, hình ảnh, trạng thái. Validate, cập nhật ảnh nếu có thay đổi.

| Thông tin | Chi tiết |
|-----------|----------|
| Trạng thái | ⬜ Chưa làm |
| Người thực hiện | |
| Deadline | |
| Ghi chú | |

---

# Task 22: Quản lý sản phẩm - Xóa/Ẩn sản phẩm

Quyền: product.delete. Nếu sản phẩm chưa phát sinh đơn hàng → soft delete. Nếu đã phát sinh đơn hàng → chỉ chuyển trạng thái hidden. Không xóa cứng sản phẩm đã có giao dịch.

| Thông tin | Chi tiết |
|-----------|----------|
| Trạng thái | ⬜ Chưa làm |
| Người thực hiện | |
| Deadline | |
| Ghi chú | |

---

# Task 23: Quản lý hình ảnh sản phẩm

Quyền: product.manage_image. Upload nhiều ảnh, chọn ảnh đại diện (is_primary), xóa ảnh không dùng, kiểm tra định dạng (jpg, png, webp), giới hạn dung lượng. Lưu uploaded_by.

| Thông tin | Chi tiết |
|-----------|----------|
| Trạng thái | ⬜ Chưa làm |
| Người thực hiện | |
| Deadline | |
| Ghi chú | |

---

# Task 24: Quản lý danh mục - CRUD

Quyền: category.view, category.create, category.update, category.delete. Thêm: tên, slug, mô tả, ảnh, trạng thái, danh mục cha. Sửa: tương tự. Xóa: nếu còn sản phẩm → không cho xóa, nếu không còn → soft delete. Hiển thị: tên, mô tả, số sản phẩm, trạng thái, ngày tạo/cập nhật.

| Thông tin | Chi tiết |
|-----------|----------|
| Trạng thái | ⬜ Chưa làm |
| Người thực hiện | |
| Deadline | |
| Ghi chú | |

---

# Task 25: Quản lý khách hàng

Quyền: customer.view, customer.detail, customer.lock. Xem danh sách khách hàng (tìm kiếm, lọc, phân trang). Xem chi tiết (thông tin cá nhân + đơn hàng liên quan). Khóa/mở khóa tài khoản (nhập lý do khi khóa, tài khoản bị khóa không đăng nhập được).

| Thông tin | Chi tiết |
|-----------|----------|
| Trạng thái | ⬜ Chưa làm |
| Người thực hiện | |
| Deadline | |
| Ghi chú | |

---

# Task 26: Quản lý người dùng nội bộ

Quyền: user.view, user.create, user.update, user.lock. Tạo: họ tên, email (unique), SĐT, mật khẩu (hash), vai trò, trạng thái. Cập nhật: thông tin + vai trò. Khóa/mở khóa: không cho khóa admin duy nhất. Hiển thị danh sách với tìm kiếm, phân trang.

| Thông tin | Chi tiết |
|-----------|----------|
| Trạng thái | ⬜ Chưa làm |
| Người thực hiện | |
| Deadline | |
| Ghi chú | |

---

# Task 27: Quản lý vai trò

Quyền: role.view, role.create, role.update, role.delete. CRUD vai trò: tên, code (unique), mô tả, is_system, sort_order. Khi xóa: kiểm tra vai trò có đang được gán cho user không. Vai trò hệ thống (is_system) không cho xóa.

| Thông tin | Chi tiết |
|-----------|----------|
| Trạng thái | ✅ Hoàn thành |
| Người thực hiện | |
| Deadline | |
| Ghi chú | RoleController + views admin/roles (index, create, edit) |

---

# Task 28: Gán quyền cho vai trò

Quyền: permission.assign. Chọn vai trò → hiển thị danh sách quyền (nhóm theo module) → tick chọn quyền cần gán → lưu vào permission_role. Hiển thị quyền hiện tại của vai trò. Không cho nhân viên tự cấp quyền cho chính mình.

| Thông tin | Chi tiết |
|-----------|----------|
| Trạng thái | ✅ Hoàn thành |
| Người thực hiện | |
| Deadline | |
| Ghi chú | PermissionController + view admin/permissions/edit |

---

# Task 29: Gửi yêu cầu thiết kế nội thất

Khách hàng đã đăng nhập gửi yêu cầu. Nhập: loại không gian, diện tích, địa chỉ, chiều cao trần, số phòng, phong cách, màu chủ đạo, ngân sách, thời gian mong muốn, yêu cầu cụ thể. Tạo design_request với trạng thái new, tự động điền thông tin KH từ user.

| Thông tin | Chi tiết |
|-----------|----------|
| Trạng thái | ⬜ Chưa làm |
| Người thực hiện | |
| Deadline | |
| Ghi chú | |

---

# Task 30: Xem danh sách yêu cầu thiết kế (Admin)

Quyền: design_request.view. Hiển thị danh sách yêu cầu. Lọc: trạng thái, ngày gửi, loại không gian, ngân sách. Tìm kiếm: tên KH, SĐT. Phân trang.

| Thông tin | Chi tiết |
|-----------|----------|
| Trạng thái | ⬜ Chưa làm |
| Người thực hiện | |
| Deadline | |
| Ghi chú | |

---

# Task 31: Xem chi tiết yêu cầu thiết kế

Khách hàng xem yêu cầu của mình. Nhân viên/admin cần quyền design_request.detail. Hiển thị: thông tin KH, thông tin không gian, phong cách, ngân sách, yêu cầu cụ thể, trạng thái hiện tại, nhân viên phụ trách.

| Thông tin | Chi tiết |
|-----------|----------|
| Trạng thái | ⬜ Chưa làm |
| Người thực hiện | |
| Deadline | |
| Ghi chú | |

---

# Task 32: Cập nhật trạng thái yêu cầu thiết kế

Quyền: design_request.update_status. Trạng thái: new → contacting → surveyed → designing → sent_design → approved → constructing → completed / cancelled. Nếu hủy → nhập lý do. Cập nhật các timestamp tương ứng (contacted_at, surveyed_at, completed_at, cancelled_at). Có thể gán nhân viên phụ trách (assigned_staff_id).

| Thông tin | Chi tiết |
|-----------|----------|
| Trạng thái | ⬜ Chưa làm |
| Người thực hiện | |
| Deadline | |
| Ghi chú | |

---

# Task 33: Xem yêu cầu thiết kế của khách hàng

Khách hàng xem danh sách yêu cầu thiết kế của chính mình. Hiển thị: mã yêu cầu, loại không gian, trạng thái, ngày gửi. Chỉ xem được yêu cầu của mình.

| Thông tin | Chi tiết |
|-----------|----------|
| Trạng thái | ⬜ Chưa làm |
| Người thực hiện | |
| Deadline | |
| Ghi chú | |

---

# Task 34: Layout và Navigation

Tạo layout chính cho: giao diện khách hàng (public), giao diện quản trị (admin panel). Menu quản trị chỉ hiển thị theo quyền của user đang đăng nhập. Responsive, sử dụng Tailwind CSS + Alpine.js.

| Thông tin | Chi tiết |
|-----------|----------|
| Trạng thái | ✅ Hoàn thành |
| Người thực hiện | |
| Deadline | |
| Ghi chú | layouts/admin.blade.php + AdminLayout component |

---

# Task 35: Trang chủ

Thiết kế trang chủ giới thiệu cửa hàng: banner, sản phẩm nổi bật, danh mục chính, thông tin liên hệ. Responsive.

| Thông tin | Chi tiết |
|-----------|----------|
| Trạng thái | ✅ Hoàn thành |
| Người thực hiện | |
| Deadline | |
| Ghi chú | welcome.blade.php với hero, categories, products, services, contact |

---

# Task 36: Dashboard quản trị

Trang tổng quan cho admin/nhân viên: tổng đơn hàng, đơn mới, doanh thu, sản phẩm sắp hết hàng, yêu cầu thiết kế mới. Hiển thị theo quyền.

| Thông tin | Chi tiết |
|-----------|----------|
| Trạng thái | ✅ Hoàn thành |
| Người thực hiện | |
| Deadline | |
| Ghi chú | DashboardController + admin/dashboard.blade.php |

---

# Tổng kết tiến độ

| Nhóm chức năng | Số task | Hoàn thành |
|----------------|---------|------------|
| Cơ sở hạ tầng (DB, Models, Seeders, Middleware) | 4 | 4/4 |
| Xác thực & Tài khoản | 4 | 0/4 |
| Sản phẩm (Public) | 3 | 0/3 |
| Giỏ hàng | 2 | 0/2 |
| Đặt hàng (Khách hàng) | 3 | 0/3 |
| Quản lý đơn hàng (Admin) | 3 | 0/3 |
| Quản lý sản phẩm (Admin) | 4 | 0/4 |
| Quản lý danh mục (Admin) | 1 | 0/1 |
| Quản lý khách hàng (Admin) | 1 | 0/1 |
| Quản lý người dùng nội bộ (Admin) | 1 | 0/1 |
| Phân quyền (Admin) | 2 | 2/2 |
| Yêu cầu thiết kế | 4 | 0/4 |
| Giao diện & Layout | 3 | 3/3 |
| **Tổng** | **36** | **9/36** |
