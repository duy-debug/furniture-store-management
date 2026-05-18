{{-- Toast Notification - Hiển thị nổi góc trên phải --}}
<div x-data="{
        toasts: [],
        addToast(type, message) {
            const id = Date.now();
            this.toasts.push({ id, type, message });
            setTimeout(() => this.removeToast(id), 5000);
        },
        removeToast(id) {
            this.toasts = this.toasts.filter(t => t.id !== id);
        }
     }"
     x-init="
        @if(session('success'))
            addToast('success', '{{ session('success') }}');
        @endif
        @if(session('error'))
            addToast('error', '{{ session('error') }}');
        @endif
        @if(session('status') === 'profile-updated')
            addToast('success', 'Thông tin cá nhân đã được cập nhật thành công!');
        @endif
        @if(session('status') === 'password-updated')
            addToast('success', 'Đã đổi mật khẩu thành công!');
        @endif
     "
     class="fixed top-4 right-4 z-[9999] space-y-3 w-80">

    <template x-for="toast in toasts" :key="toast.id">
        <div x-show="true"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-x-8"
             x-transition:enter-end="opacity-100 translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-x-0"
             x-transition:leave-end="opacity-0 translate-x-8"
             class="rounded-lg shadow-lg border p-4 flex items-start gap-3"
             :class="{
                'bg-green-50 border-green-200': toast.type === 'success',
                'bg-red-50 border-red-200': toast.type === 'error',
                'bg-blue-50 border-blue-200': toast.type === 'info'
             }">

            {{-- Icon --}}
            <div class="flex-shrink-0 mt-0.5">
                <template x-if="toast.type === 'success'">
                    <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </template>
                <template x-if="toast.type === 'error'">
                    <svg class="h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </template>
            </div>

            {{-- Message --}}
            <p class="text-sm font-medium flex-1"
               :class="{
                  'text-green-700': toast.type === 'success',
                  'text-red-700': toast.type === 'error',
                  'text-blue-700': toast.type === 'info'
               }"
               x-text="toast.message"></p>

            {{-- Close button --}}
            <button @click="removeToast(toast.id)" class="flex-shrink-0"
                    :class="{
                       'text-green-400 hover:text-green-600': toast.type === 'success',
                       'text-red-400 hover:text-red-600': toast.type === 'error'
                    }">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </template>
</div>
