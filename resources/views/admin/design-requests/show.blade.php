<x-admin-layout>
    <x-slot name="header">Chi tiết yêu cầu thiết kế</x-slot>

    <div class="space-y-6">
        <div class="flex flex-col gap-3 rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-sm font-medium text-indigo-600">Mã yêu cầu: {{ $designRequest->request_code }}</p>
                <h2 class="mt-1 text-2xl font-semibold text-gray-900">{{ $designRequest->customer_name }}</h2>
                <p class="mt-1 text-sm text-gray-500">{{ $designRequest->customer_phone }} @if($designRequest->customer_email) · {{ $designRequest->customer_email }} @endif</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('admin.design-requests.index') }}" class="inline-flex items-center rounded-xl border border-gray-200 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                    Quay lại danh sách
                </a>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-[1.2fr,0.8fr]">
            <div class="space-y-6">
                <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Thông tin yêu cầu</h3>
                            <p class="mt-1 text-sm text-gray-500">Ngày gửi: {{ $designRequest->created_at?->format('d/m/Y H:i') }}</p>
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
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Chiều cao trần</p>
                            <p class="mt-2 text-sm font-medium text-gray-900">{{ number_format($designRequest->ceiling_height, 2, ',', '.') }} m</p>
                        </div>
                        <div class="rounded-2xl bg-gray-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Số phòng</p>
                            <p class="mt-2 text-sm font-medium text-gray-900">{{ $designRequest->room_count }}</p>
                        </div>
                        <div class="rounded-2xl bg-gray-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Phong cách</p>
                            <p class="mt-2 text-sm text-gray-900">{{ $designRequest->style_preference }}</p>
                        </div>
                        <div class="rounded-2xl bg-gray-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Màu chủ đạo</p>
                            <p class="mt-2 text-sm text-gray-900">{{ $designRequest->main_color }}</p>
                        </div>
                        <div class="rounded-2xl bg-gray-50 p-4 md:col-span-2">
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Địa chỉ không gian</p>
                            <p class="mt-2 text-sm text-gray-900 whitespace-pre-line">{{ $designRequest->space_address }}</p>
                        </div>
                        <div class="rounded-2xl bg-gray-50 p-4 md:col-span-2">
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Yêu cầu cụ thể</p>
                            <p class="mt-2 text-sm text-gray-900 whitespace-pre-line">{{ $designRequest->requirements }}</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Thông tin bổ sung</h3>
                    <div class="mt-4 grid gap-4 md:grid-cols-2">
                        <div class="rounded-2xl border border-gray-200 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Ngân sách dự kiến</p>
                            <p class="mt-2 text-sm font-semibold text-gray-900">{{ number_format($designRequest->budget_amount, 0, ',', '.') }} đ</p>
                        </div>
                        <div class="rounded-2xl border border-gray-200 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Thời gian mong muốn</p>
                            <p class="mt-2 text-sm font-semibold text-gray-900">{{ $designRequest->desired_completion_date?->format('d/m/Y') ?? 'Chưa cập nhật' }}</p>
                        </div>
                        <div class="rounded-2xl border border-gray-200 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Nhân viên phụ trách</p>
                            <p class="mt-2 text-sm font-semibold text-gray-900">{{ $designRequest->assignedStaff?->name ?? 'Chưa phân công' }}</p>
                        </div>
                        <div class="rounded-2xl border border-gray-200 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Lý do hủy</p>
                            <p class="mt-2 text-sm font-semibold text-gray-900">{{ $designRequest->cancel_reason ?? 'Chưa có' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
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
                        @if($designRequest->user)
                            <div>
                                <p class="text-gray-500">Tài khoản</p>
                                <p class="mt-1 font-medium text-gray-900">{{ $designRequest->user->name }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Cập nhật trạng thái</h3>
                    <p class="mt-1 text-sm text-gray-500">Luồng trạng thái được kiểm tra theo thứ tự: new → contacting → surveyed → designing → sent_design → approved → constructing → completed/cancelled.</p>

                    @if($designRequest->isTerminalStatus())
                        <div class="mt-4 rounded-2xl bg-gray-50 p-4 text-sm text-gray-600">
                            Yêu cầu này đã ở trạng thái cuối nên không thể cập nhật thêm.
                        </div>
                    @else
                        @if($errors->any())
                            <div class="mt-4 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('admin.design-requests.status', $designRequest) }}" class="mt-4 space-y-4" x-data="{ status: '{{ old('status', $designRequest->status) }}' }">
                            @csrf
                            @method('PATCH')

                            <div>
                                <label class="mb-2 block text-sm font-medium text-gray-700">Trạng thái mới</label>
                                <select name="status" x-model="status" class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    @foreach($allowedStatuses as $status)
                                        <option value="{{ $status }}" @selected(old('status', $designRequest->status) === $status)>{{ $statusLabels[$status] ?? $status }}</option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-medium text-gray-700">Nhân viên phụ trách</label>
                                <select name="assigned_staff_id" class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Chưa phân công</option>
                                    @foreach($staffOptions as $staff)
                                        <option value="{{ $staff->id }}" @selected((string) old('assigned_staff_id', (string) $designRequest->assigned_staff_id) === (string) $staff->id)>
                                            {{ $staff->name }}{{ $staff->email ? ' · ' . $staff->email : '' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('assigned_staff_id')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div x-show="status === 'cancelled'" x-cloak>
                                <label class="mb-2 block text-sm font-medium text-gray-700">Lý do hủy</label>
                                <textarea name="cancel_reason" rows="4" class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" placeholder="Nhập lý do hủy yêu cầu...">{{ old('cancel_reason', $designRequest->cancel_reason) }}</textarea>
                                @error('cancel_reason')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="primary-button w-full justify-center">
                                Lưu cập nhật
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
