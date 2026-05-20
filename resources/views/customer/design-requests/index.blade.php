<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-medium text-primary">Customer space</p>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Yêu cầu thiết kế của tôi
                </h2>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('design-requests.create') }}"
                   class="inline-flex items-center rounded-md bg-primary px-4 py-2 text-sm font-semibold text-white hover:bg-primary/90 transition">
                    Gửi yêu cầu mới
                </a>
                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center rounded-md border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                    Về dashboard
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                @if($designRequests->isEmpty())
                    <div class="p-8 text-center">
                        <h3 class="text-lg font-semibold text-gray-900">Bạn chưa gửi yêu cầu thiết kế nào</h3>
                        <p class="mt-2 text-sm text-gray-500">
                            Khi bạn gửi yêu cầu, danh sách ở đây sẽ hiển thị mã yêu cầu, loại không gian, ngân sách và trạng thái.
                        </p>
                        <div class="mt-6">
                            <a href="{{ route('design-requests.create') }}"
                               class="inline-flex items-center rounded-md bg-primary px-4 py-2 text-sm font-semibold text-white hover:bg-primary/90">
                                Gửi yêu cầu đầu tiên
                            </a>
                        </div>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Mã yêu cầu</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Ngày gửi</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Không gian</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Ngân sách</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Trạng thái</th>
                                    <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach($designRequests as $designRequest)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $designRequest->request_code }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">{{ $designRequest->created_at?->format('d/m/Y H:i') }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            <div class="font-medium text-gray-900">{{ $designRequest->spaceTypeLabel() }}</div>
                                            <div class="mt-1 text-xs text-gray-500">{{ number_format($designRequest->space_area, 2, ',', '.') }} m²</div>
                                        </td>
                                        <td class="px-6 py-4 text-sm font-semibold text-gray-900">
                                            {{ number_format($designRequest->budget_amount, 0, ',', '.') }} đ
                                        </td>
                                        <td class="px-6 py-4 text-sm">
                                            <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $designRequest->statusBadgeClasses() }}">
                                                {{ $designRequest->statusLabel() }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="{{ route('design-requests.show', $designRequest) }}" class="text-sm font-medium text-primary hover:text-primary/90">
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
    </div>
</x-app-layout>
