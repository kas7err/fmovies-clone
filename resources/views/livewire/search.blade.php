<div>
    <div class="relative text-gray-600 focus-within:text-gray-400 ">
        <span class="absolute inset-y-0 left-0 flex items-center pl-2">
            <button wire:click="submitSearch" class="p-1 focus:outline-none focus:shadow-outline">
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    viewBox="0 0 24 24" class="w-6 h-6">
                    <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </button>
        </span>
        <input type="text" wire:model.live.debounce.500ms="search" wire:keydown.enter="submitSearch" placeholder="Search..."
            autocomplete="off" name="q"
            class="py-2 w-72 text-sm text-white bg-gray-900 rounded-full pl-10 focus:outline-none focus:bg-white focus:text-gray-900 hover:bg-white hover:text-gray-900">
    </div>
    <div class="absolute bg-gray-800 rounde w-72 mt-4 text-gray-300 z-10 rounded-lg text-sm" id="searchResult">
        @if ($searchResult->count() > 0 && strlen($search) > 2)
            <ul>
                @foreach ($searchResult as $tv)
                    <a href="{{ route('title', $tv) }}" class="">
                        <li
                            class="flex border-b items-center border-gray-700 px-2 py-1 hover:bg-gray-700 hover:text-teal-600">
                            <img src="{{ $tv->thumbnail_url }}" alt="" class="rounded-md">
                            <span class="block px-3 py-3 w-full">
                                <span>{{ Str::limit($tv->title, 26) }}</span>
                                <div class="flex justify-start items-center align-middle text-gray-400 text-xs">
                                    <p class="text-gray-300 flex items-center"><svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-3 w-4 " fill="currentColor" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                        </svg>{{ $tv->rating }}&nbsp;&nbsp;</p>
                                    <span class="text-white align-middle"
                                        style="font-size:25px;padding-bottom:12px;">.</span>
                                    <p>&nbsp;&nbsp;{{ $tv->year }}&nbsp;&nbsp;</p>
                                    <span class="text-white align-middle"
                                        style="font-size:25px;padding-bottom:12px;">.</span>
                                    <p>&nbsp;&nbsp;{{ $tv->length }}</p>
                                </div>
                            </span>
                        </li>
                    </a>
                @endforeach
            </ul>
            <button wire:click="submitSearch"
                class="w-full flex justify-center text-center bg-teal-700 text-gray-200
                hover:bg-teal-500 hover:text-white
                text-md py-2 rounded-b-lg items-center align-middle">
                <span class="pr-1">View all results</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                </svg>
            </button>
        @endif

    </div>
    <script>
        document.addEventListener('livewire:load', function() {

            // clear search if clicked outside Result Box
            window.addEventListener('click', function(e) {
                if (!document.getElementById('searchResult').contains(e.target)) {
                    @this.search = ''
                }
            });
        })
    </script>
</div>
