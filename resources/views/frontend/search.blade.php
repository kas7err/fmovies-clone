@extends('layouts.index')

@section('content')
    <div class="font-sans text-gray-900 antialiased py-10 body-bg">
        <div class="max-w-screen-2xl mx-auto px-2 sm:px-6 lg:px-8 ">
            <div class="relative flex items-center justify-between text-white ">
                <h2 class="text-2xl border-b border-gray-700 font-light font-serif text-gray-300">
                    {{ $gridData['title'] }}
                </h2>
            </div>
            @livewire('filter')
            @livewire('tv-grid', $gridData)
        </div>
    </div>
@endsection
