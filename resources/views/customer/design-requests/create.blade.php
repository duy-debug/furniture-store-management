<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <p class="text-sm font-medium text-indigo-600">Customer space</p>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Gửi yêu cầu thiết kế nội thất
                </h2>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('design-requests.index') }}"
                   class="inline-flex items-center rounded-md border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                    Yêu cầu của tôi
                </a>
                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center rounded-md bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-800 transition">
                    Về dashboard
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid gap-8 lg:grid-cols-[1.15fr,0.85fr]">
                <div class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-gray-200 sm:p-8">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Biểu mẫu yêu cầu</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Chỉ cần điền thông tin thiết kế, hệ thống sẽ tự lấy thông tin liên hệ từ hồ sơ của bạn.
                            </p>
                        </div>
                        <span class="rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700">
                            design_request.create
                        </span>
                    </div>

                    @if($errors->any())
                        <div class="mt-6 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('design-requests.store') }}" class="mt-6 space-y-6">
                        @csrf

                        <div class="grid gap-6 md:grid-cols-2">
                            <div>
                                <label class="mb-2 block text-sm font-medium text-gray-700">Loại không gian</label>
                                <select name="space_type" class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Chọn loại không gian</option>
                                    @foreach($spaceTypeLabels as $key => $label)
                                        <option value="{{ $key }}" @selected(old('space_type') === $key)>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('space_type')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-medium text-gray-700">Diện tích (m²)</label>
                                <input type="number" name="space_area" step="0.01" min="0.01" value="{{ old('space_area') }}"
                                       class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                       placeholder="Ví dụ: 28.5">
                                @error('space_area')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid gap-6 md:grid-cols-2">
                            <div>
                                <label class="mb-2 block text-sm font-medium text-gray-700">Chiều cao trần (m)</label>
                                <input type="number" name="ceiling_height" step="0.01" min="0.01" value="{{ old('ceiling_height') }}"
                                       class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                       placeholder="Ví dụ: 3.2">
                                @error('ceiling_height')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-medium text-gray-700">Số phòng</label>
                                <input type="number" name="room_count" min="1" step="1" value="{{ old('room_count') }}"
                                       class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                       placeholder="Ví dụ: 3">
                                @error('room_count')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700">Địa chỉ không gian</label>
                            <textarea name="space_address" rows="3"
                                      class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                      placeholder="Nhập địa chỉ căn hộ, nhà ở, văn phòng...">{{ old('space_address') }}</textarea>
                            @error('space_address')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid gap-6 md:grid-cols-2">
                            <div>
                                <label class="mb-2 block text-sm font-medium text-gray-700">Phong cách mong muốn</label>
                                <input type="text" name="style_preference" value="{{ old('style_preference') }}"
                                       class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                       placeholder="Ví dụ: Hiện đại, tối giản...">
                                @error('style_preference')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-medium text-gray-700">Màu sắc chủ đạo</label>
                                <input type="text" name="main_color" value="{{ old('main_color') }}"
                                       class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                       placeholder="Ví dụ: Trắng, gỗ nâu, xanh pastel...">
                                @error('main_color')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid gap-6 md:grid-cols-2">
                            <div>
                                <label class="mb-2 block text-sm font-medium text-gray-700">Ngân sách dự kiến</label>
                                <input type="number" name="budget_amount" min="0" step="1000" value="{{ old('budget_amount') }}"
                                       class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                       placeholder="Ví dụ: 50000000">
                                @error('budget_amount')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-medium text-gray-700">Thời gian mong muốn</label>
                                <input type="date" name="desired_completion_date" value="{{ old('desired_completion_date') }}"
                                       class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                @error('desired_completion_date')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700">Yêu cầu cụ thể</label>
                            <textarea name="requirements" rows="6"
                                      class="w-full rounded-2xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                      placeholder="Mô tả chi tiết nhu cầu, diện tích sử dụng, mong muốn vật liệu, cách bố trí...">{{ old('requirements') }}</textarea>
                            @error('requirements')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-3 border-t border-gray-200 pt-6 sm:flex-row sm:items-center sm:justify-between">
                            <p class="text-sm text-gray-500">
                                Sau khi gửi, yêu cầu sẽ được tạo với trạng thái <span class="font-semibold text-gray-900">new</span>.
                            </p>
                            <div class="flex gap-3">
                                <a href="{{ route('design-requests.index') }}"
                                   class="inline-flex items-center rounded-xl border border-gray-200 px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                                    Xem yêu cầu của tôi
                                </a>
                                <button type="submit"
                                        class="inline-flex items-center rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700">
                                    Gửi yêu cầu
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="space-y-6">
                    <div class="rounded-[2rem] bg-slate-950 p-6 text-white shadow-sm">
                        <p class="text-sm font-medium text-slate-300">Thông tin khách hàng</p>
                        <div class="mt-4 space-y-3 text-sm">
                            <div class="rounded-2xl bg-white/5 p-4">
                                <p class="text-slate-400">Họ tên</p>
                                <p class="mt-1 font-semibold">{{ $customer->name }}</p>
                            </div>
                            <div class="rounded-2xl bg-white/5 p-4">
                                <p class="text-slate-400">Số điện thoại</p>
                                <p class="mt-1 font-semibold">{{ $customer->phone ?? 'Chưa cập nhật' }}</p>
                            </div>
                            <div class="rounded-2xl bg-white/5 p-4">
                                <p class="text-slate-400">Email</p>
                                <p class="mt-1 font-semibold">{{ $customer->email ?? 'Chưa cập nhật' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Mẹo gửi yêu cầu</h3>
                        <ul class="mt-4 space-y-3 text-sm text-gray-600">
                            <li class="flex gap-3">
                                <span class="mt-0.5 inline-flex h-6 w-6 flex-none items-center justify-center rounded-full bg-indigo-50 text-xs font-bold text-indigo-700">1</span>
                                Mô tả rõ không gian cần thiết kế để đội ngũ dễ hình dung.
                            </li>
                            <li class="flex gap-3">
                                <span class="mt-0.5 inline-flex h-6 w-6 flex-none items-center justify-center rounded-full bg-indigo-50 text-xs font-bold text-indigo-700">2</span>
                                Ghi ngân sách dự kiến để tư vấn phương án phù hợp.
                            </li>
                            <li class="flex gap-3">
                                <span class="mt-0.5 inline-flex h-6 w-6 flex-none items-center justify-center rounded-full bg-indigo-50 text-xs font-bold text-indigo-700">3</span>
                                Chọn thời gian mong muốn hợp lý để việc khảo sát diễn ra thuận tiện.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
