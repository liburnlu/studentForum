{{-- resources/views/components/user-avatar.blade.php --}}

@props(['user', 'size' => 'md'])

@php
    $sizeClasses = match($size) {
        'sm' => 'h-10 w-10 text-sm',
        'md' => 'h-14 w-14 text-xl',
        'lg' => 'h-16 w-16 text-2xl',
        'xl' => 'h-32 w-32 text-4xl',
        default => 'h-14 w-14 text-xl',
    };
@endphp

@if($user->profile_picture)
    <div class="flex-shrink-0 mr-4">
        <img
            src="{{ asset('storage/' . $user->profile_picture) }}"
            alt="{{ $user->name }}"
            class="{{ $sizeClasses }} rounded-full object-cover shadow-lg ring-4 ring-indigo-50"
        >
    </div>
@else
    <div class="flex-shrink-0 mr-4">
        <div class="{{ $sizeClasses }} rounded-full bg-gradient-to-br from-indigo-500 via-indigo-600 to-purple-600 flex items-center justify-center text-white font-bold shadow-lg ring-4 ring-indigo-50">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
    </div>
@endif
