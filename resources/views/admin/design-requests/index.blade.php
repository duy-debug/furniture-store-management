<x-admin-layout>
    <x-slot name="header">Quản lý yêu cầu thiết kế</x-slot>

    <div class="space-y-6">
        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <p class="text-sm font-medium text-gray-500">Tổng yêu cầu</p>
                <p class="mt-2 text-3xl font-semibold text-gray-900">{{ number_format($stats['total']) }}</p>
            </div>
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <p class="text-sm font-medium text-gray-500">Mới</p>
                <p class="mt-2 text-3xl font-semibold text-sky-600">{{ number_format($stats['new']) }}</p>
            </div>
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <p class="text-sm font-medium text-gray-500">Đang xử lý</p>
                <p class="mt-2 text-3xl font-semibold text-amber-600">{{ number_format($stats['processing']) }}</p>
            </div>
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <p class="text-sm font-medium text-gray-500">Hoàn thành</p>
                <p class="mt-2 text-3xl font-semibold text-emerald-600">{{ number_format($stats['completed']) }}</p>
            </div>
        </div>

        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <form method="GET" action="{{ route('admin.design-requests.index') }}" class="grid gap-4 lg:grid-cols-4">
                <div class="lg:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-gray-700">Tìm kiếm</label>
                    <input type="text" name="search" value="{{ request('search') }}"
                           class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                           placeholder="Tên khách hàng, số điện thoại">
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">Trạng thái</label>
                    <select name="status" class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Tất cả</option>
                        @foreach($statusLabels as $key => $label)
                            <option value="{{ $key }}" @selected(request('status') === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">Loại không gian</label>
                    <select name="space_type" class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Tất cả</option>
                        @foreach($spaceTypeLabels as $key => $label)
                            <option value="{{ $key }}" @selected(request('space_type') === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">Ngày gửi từ</label>
                    <input type="date" name="date_from" value="{{ request('date_from') }}"
                           class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">Đến ngày</label>
                    <input type="date" name="date_to" value="{{ request('date_to') }}"
                           class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">Ngân sách từ</label>
                    <input type="number" min="0" step="1000" name="budget_min" value="{{ request('budget_min') }}"
                           class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                           placeholder="Tối thiểu">
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">Ngân sách đến</label>
                    <input type="number" min="0" step="1000" name="budget_max" value="{{ request('budget_max') }}"
                           class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                           placeholder="Tối đa">
                </div>

                <div class="lg:col-span-4 flex flex-wrap gap-3">
                    <button type="submit" class="primary-button">
                        Lọc dữ liệu
                    </button>
                    <a href="{{ route('admin.design-requests.index') }}" class="secondary-button">
                        Xóa bộ lọc
                    </a>
                </div>
            </form>
        </div>

        <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200">
            <div class="border-b border-gray-200 px-6 py-4">
                <h3 class="text-lg font-semibold text-gray-900">Danh sách yêu cầu thiết kế</h3>
                <p class="mt-1 text-sm text-gray-500">Mới nhất trước, có thể tìm kiếm, lọc và phân trang.</p>
            </div>

            @if($designRequests->isEmpty())
                <div class="p-8 text-center">
                    <h3 class="text-lg font-semibold text-gray-900">Chưa có yêu cầu thiết kế nào</h3>
                    <p class="mt-2 text-sm text-gray-500">Yêu cầu thiết kế mới từ khách hàng sẽ hiển thị tại đây.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full table-fixed divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="w-56 px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Khách hàng</th>
                                <th class="w-44 px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Không gian</th>
                                <th class="w-36 px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Ngân sách</th>
                                <th class="w-32 px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Ngày gửi</th>
                                <th class="w-32 px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Trạng thái</th>
                                <th class="w-36 px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">NV phụ trách</th>
                                <th class="w-28 px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($designRequests as $designRequest)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 align-top text-sm text-gray-700">
                                        <div class="truncate font-medium text-gray-900" title="{{ $designRequest->customer_name }}">{{ $designRequest->customer_name }}</div>
                                        <div class="mt-1 truncate text-gray-500" title="{{ $designRequest->customer_phone }}">{{ $designRequest->customer_phone }}</div>
                                    </td>
                                    <td class="px-6 py-4 align-top text-sm text-gray-600">
                                        <div class="truncate font-medium text-gray-900" title="{{ $designRequest->spaceTypeLabel() }}">{{ $designRequest->spaceTypeLabel() }}</div>
                                        <div class="mt-1 truncate text-xs text-gray-500">{{ number_format($designRequest->space_area, 2, ',', '.') }} m²</div>
                                    </td>
                                    <td class="px-6 py-4 align-top text-sm font-semibold whitespace-nowrap text-gray-900">{{ number_format($designRequest->budget_amount, 0, ',', '.') }} đ</td>
                                    <td class="px-6 py-4 align-top text-sm text-gray-600">{{ $designRequest->created_at?->format('d/m/Y H:i') }}</td>
                                    <td class="px-6 py-4 align-top text-sm">
                                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $designRequest->statusBadgeClasses() }}">
                                            {{ $designRequest->statusLabel() }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 align-top text-sm text-gray-700">
                                        <div class="truncate" title="{{ $designRequest->assignedStaff?->name ?? 'Chưa phân công' }}">
                                            {{ $designRequest->assignedStaff?->name ?? 'Chưa phân công' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 align-top text-right whitespace-nowrap">
                                        <a href="{{ route('admin.design-requests.show', $designRequest) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-700">
                                            Xem chi tiết
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="border-t border-gray-200 px-6 py-4">
                    {{ $designRequests->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
