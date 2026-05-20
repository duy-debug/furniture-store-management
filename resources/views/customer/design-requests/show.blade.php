<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <p class="text-sm font-medium text-primary">Customer space</p>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Chi tiết yêu cầu thiết kế
                </h2>
                <p class="mt-1 text-sm text-gray-500">{{ $designRequest->request_code }}</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('design-requests.index') }}"
                   class="inline-flex items-center rounded-md bg-gray-100 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-200 transition">
                    Quay lại danh sách
                </a>
                <a href="{{ route('design-requests.create') }}"
                   class="inline-flex items-center rounded-md bg-primary px-4 py-2 text-sm font-semibold text-white hover:bg-primary/90 transition">
                    Gửi yêu cầu mới
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white shadow-sm sm:rounded-lg p-6">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Thông tin yêu cầu</h3>
                                <p class="mt-1 text-sm text-gray-500">Mã yêu cầu: {{ $designRequest->request_code }}</p>
                            </div>
                            <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $designRequest->statusBadgeClasses() }}">
                                {{ $designRequest->statusLabel() }}
                            </span>
                        </div>

                        <div class="mt-6 grid gap-4 md:grid-cols-2">
                            <div class="rounded-2xl bg-gray-50 p-4">
                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Loại không gian</p>
                                <p class="mt-2 text-sm font-medium text-gray-900">{{ $designRequest->spaceTypeLabel() }}</p>
                            </div>
                            <div class="rounded-2xl bg-gray-50 p-4">
                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Diện tích</p>
                                <p class="mt-2 text-sm font-medium text-gray-900">{{ number_format($designRequest->space_area, 2, ',', '.') }} m²</p>
                            </div>
                            <div class="rounded-2xl bg-gray-50 p-4">
                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Phong cách mong muốn</p>
                                <p class="mt-2 text-sm text-gray-900">{{ $designRequest->style_preference }}</p>
                            </div>
                            <div class="rounded-2xl bg-gray-50 p-4">
                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Chiều cao trần</p>
                                <p class="mt-2 text-sm text-gray-900">{{ number_format($designRequest->ceiling_height, 2, ',', '.') }} m</p>
                            </div>
                            <div class="rounded-2xl bg-gray-50 p-4">
                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Số phòng</p>
                                <p class="mt-2 text-sm text-gray-900">{{ $designRequest->room_count }}</p>
                            </div>
                            <div class="rounded-2xl bg-gray-50 p-4">
                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Màu sắc chủ đạo</p>
                                <p class="mt-2 text-sm text-gray-900">{{ $designRequest->main_color }}</p>
                            </div>
                        </div>

                        <div class="mt-4 grid gap-4 md:grid-cols-2">
                            <div class="rounded-2xl bg-gray-50 p-4">
                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Địa chỉ không gian</p>
                                <p class="mt-2 text-sm text-gray-900 whitespace-pre-line">{{ $designRequest->space_address }}</p>
                            </div>
                            <div class="rounded-2xl bg-gray-50 p-4">
                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Yêu cầu cụ thể</p>
                                <p class="mt-2 text-sm text-gray-900 whitespace-pre-line">{{ $designRequest->requirements }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Tiến độ yêu cầu</h3>
                        </div>
                        <div class="grid gap-4 p-6 md:grid-cols-2">
                            <div class="rounded-2xl border border-gray-200 p-4">
                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Ngày gửi</p>
                                <p class="mt-2 text-sm font-medium text-gray-900">{{ $designRequest->created_at?->format('d/m/Y H:i') }}</p>
                            </div>
                            <div class="rounded-2xl border border-gray-200 p-4">
                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Thời gian mong muốn</p>
                                <p class="mt-2 text-sm font-medium text-gray-900">{{ $designRequest->desired_completion_date?->format('d/m/Y') ?? 'Chưa cập nhật' }}</p>
                            </div>
                            <div class="rounded-2xl border border-gray-200 p-4">
                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Ngân sách dự kiến</p>
                                <p class="mt-2 text-sm font-medium text-gray-900">{{ number_format($designRequest->budget_amount, 0, ',', '.') }} đ</p>
                            </div>
                            <div class="rounded-2xl border border-gray-200 p-4">
                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Nhân viên phụ trách</p>
                                <p class="mt-2 text-sm font-medium text-gray-900">{{ $designRequest->assignedStaff?->name ?? 'Chưa phân công' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900">Thông tin khách hàng</h3>
                        <div class="mt-4 space-y-3 text-sm">
                            <div>
                                <p class="text-gray-500">Họ tên</p>
                                <p class="mt-1 font-medium text-gray-900">{{ $designRequest->customer_name }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500">Số điện thoại</p>
                                <p class="mt-1 font-medium text-gray-900">{{ $designRequest->customer_phone }}</p>
                            </div>
                            @if($designRequest->customer_email)
                                <div>
                                    <p class="text-gray-500">Email</p>
                                    <p class="mt-1 font-medium text-gray-900">{{ $designRequest->customer_email }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="rounded-2xl bg-primary p-6 text-white shadow-sm">
                        <h3 class="text-lg font-semibold">Gợi ý tiếp theo</h3>
                        <p class="mt-2 text-sm leading-6 text-white/80">
                            Khi trạng thái thay đổi, bạn có thể quay lại trang này để theo dõi tiến độ yêu cầu của mình.
                        </p>
                        <div class="mt-5 flex flex-col gap-3">
                            <a href="{{ route('design-requests.index') }}"
                               class="inline-flex items-center justify-center rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-primary hover:bg-white/90">
                                Xem toàn bộ yêu cầu
                            </a>
                            <a href="{{ route('design-requests.create') }}"
                               class="inline-flex items-center justify-center rounded-xl border border-white/20 bg-white/10 px-4 py-2.5 text-sm font-semibold text-white hover:bg-white/15">
                                Gửi yêu cầu khác
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
