<div>
    <form method="GET" action="/filter" class="flex flex-wrap">
        <div class="flex items-center rounded-sm px-4 mt-5 mx-1 bg-black hover:bg-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
            </svg>
            <div x-data="{showGenres: false}" x-on:click.away="showGenres = false">
                <a href="#" x-on:click.prevent="showGenres = !showGenres"
                    class="text-gray-400 px-1 py-2 rounded-md text-sm font-medium">
                    Genre
                    <span class="text-white text-xs" id="genre_result">All</span>
                </a>
                <div x-cloak :class="{'hidden': !showGenres}"
                    class="absolute mt-3 grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4 xl:grid-cols-4 gap-0 bg-gray-800 p-3 rounded-md z-10 genre">
                    @foreach ($genres as $genre)
                        <a href="#" x-on:click.prevent=""
                            class="relative flex text-gray-400 hover:bg-gray-900 rounded-md my-auto py-2 px-3 text-sm align-middle genre_wrapper">
                            <input name="genre[]" type="checkbox" class="bg-gray-700 border-none z-0 pointer-events-none"
                                id="{{ $genre->title }}" value="{{ $genre->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 logo-bg hidden" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="ml-2 pointer-events-none">{{ $genre->title }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="flex items-center rounded-sm px-4 mt-5 mx-1 bg-black hover:bg-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="currentColor"
                viewBox="0 0 20 20" fill="currentColor">
                <path
                    d="M9 2a2 2 0 00-2 2v8a2 2 0 002 2h6a2 2 0 002-2V6.414A2 2 0 0016.414 5L14 2.586A2 2 0 0012.586 2H9z" />
                <path d="M3 8a2 2 0 012-2v10h8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z" />
            </svg>
            <div x-data="{showType: false}" x-on:click.away="showType = false">
                <a href="#" x-on:click.prevent="showType = !showType"
                    class="text-gray-400 px-1 py-2 rounded-md text-sm font-medium">
                    Type
                    <span class="text-white text-xs" id="type_result">All</span>
                </a>
                <div x-cloak :class="{'hidden': !showType}"
                    class="absolute mt-3 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1 gap-0 bg-gray-800 p-3 rounded-md z-10 type">
                    @foreach (['Movie', 'TV-Series'] as $key => $type)
                        <a href="#" x-on:click.prevent=""
                            class="relative flex text-gray-400 hover:bg-gray-900 rounded-md my-auto py-2 px-3 text-sm align-middle type_wrapper">
                            <input name="type[]" type="checkbox" class="bg-gray-700 border-none z-0 pointer-events-none"
                                id="{{ $type }}" value="{{ $type }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 logo-bg hidden" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="ml-2 pointer-events-none">{{ $type }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="flex items-center rounded-sm px-4 mt-5 mx-1 bg-black hover:bg-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20"
                fill="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
            </svg>
            <div x-data="{showYear: false}" x-on:click.away="showYear = false">
                <a href="#" x-on:click.prevent="showYear = !showYear"
                    class="text-gray-400 px-1 py-2 rounded-md text-sm font-medium">
                    Year
                    <span class="text-white text-xs" id="year_result">All</span>
                </a>
                <div x-cloak :class="{'hidden': !showYear}"
                    class="absolute mt-3 grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 gap-0 bg-gray-800 p-3 rounded-md z-10 year">
                    @foreach ($years as $key => $year)
                        <a href="#" x-on:click.prevent=""
                            class="relative flex text-gray-400 hover:bg-gray-900 rounded-md my-auto py-2 px-3 text-sm align-middle year_wrapper">
                            <input name="year[]" type="checkbox" class="bg-gray-700 border-none z-0 pointer-events-none"
                                id="{{ $year }}" value="{{ $year }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 logo-bg hidden" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="ml-2 pointer-events-none">{{ $year }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="flex items-center rounded-sm px-4 mt-5 mx-1 bg-black hover:bg-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="currentColor"
                viewBox="0 0 20 20" fill="currentColor">
                <path
                    d="M9 2a2 2 0 00-2 2v8a2 2 0 002 2h6a2 2 0 002-2V6.414A2 2 0 0016.414 5L14 2.586A2 2 0 0012.586 2H9z" />
                <path d="M3 8a2 2 0 012-2v10h8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z" />
            </svg>
            <div x-data="{showSort: false}">
                <a href="#" x-on:click.prevent="showSort = !showSort" x-on:click.away="showSort = false"
                    class="text-gray-400 px-1 py-2 rounded-md text-sm font-medium">
                    Sort
                    <span class="text-white text-xs" id="sort_result">Default</span>
                </a>
                <div x-cloak :class="{'hidden': !showSort}"
                    class="absolute mt-3 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1 gap-0 bg-gray-800 p-3 rounded-md z-10 sort">
                    @foreach (['default' => 'Default', 'rating' => 'IMDb', 'year' => 'Release Date', 'title' => 'Name'] as $key => $sort)
                        <a href="#" x-on:click.prevent=""
                            class="relative flex text-gray-400 hover:bg-gray-900 rounded-md my-auto py-2 px-3 text-sm align-middle sort_wrapper">
                            <input name="sort" type="radio" class="bg-gray-700 border-none z-0 pointer-events-none"
                                id="{{ $sort }}" value="{{ $key }}"
                                {{ $loop->first ? 'checked' : '' }}>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 logo-bg hidden" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="ml-2 pointer-events-none">{{ $sort }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="flex items-center rounded-sm px-4 mt-5 mx-1 bg-cyan-800 hover:bg-cyan-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                    clip-rule="evenodd" />
            </svg>
            <button type="submit" class="relative flex text-black rounded-md my-auto py-2 px-3 text-sm align-middle ">
                Filter
            </button>
        </div>

    </form>


    <script>
        const inputData = function() {
            return {
                data: [],
                toggleItem(item) {
                    let index = this.data.indexOf(item);

                    if (index === -1) this.data.push(item);
                    else this.data.splice(index, 1);
                },
            }
        }
        const genres = {!! $genres !!};
        const urlParams = getParams();
        console.log(urlParams);

        function getParams() {
            let urlPath = window.location.pathname.split('/');
            urlPath.shift();

            if (urlPath[0] === 'genre') return {
                genre: [genres.filter(g => g.title.toLowerCase() === urlPath[1]).map(g => g.id).toString()]
            }
            if (urlPath[0] === 'movies') return {
                type: 'Movie'
            }
            if (urlPath[0] === 'series') return {
                type: 'TV-Series'
            }

            return {!! json_encode($_GET, JSON_HEX_TAG) !!}
        }


        function filterTitle(data) {
            if (data.length === 1)
                return data
            return data.length === 0 ? 'All' : data.length + ' Selected'
        }

        window.addEventListener('load', (event) => {
            const genres = new inputData()
            const types = new inputData()
            const years = new inputData()

            // check query and then simulate click for the selected inputs
            for (const [param, data] of Object.entries(urlParams)) {
                $(`.${param} input`).each((i, input) => {
                    let index = data.indexOf($(input).val())
                    if (index !== -1)
                        setTimeout(() => {
                            $(input).parent().click()
                        }, 50);
                })
            }

            $('a.genre_wrapper').click((e) => {
                toggleInput(e, genres, '#genre_result');
            })

            $('a.type_wrapper').click((e) => {
                toggleInput(e, types, '#type_result');
            })

            $('a.year_wrapper').click((e) => {
                toggleInput(e, years, '#year_result');
            })

            $('a.sort_wrapper').click((e) => {
                toggleSort(e, '#sort_result');
            })

            function toggleSort(wrapper, result) {
                let input = $(wrapper.target).children('input')
                input.prop("checked", !input.prop("checked"));

                const sort = {
                    default: 'Default',
                    title: 'Name',
                    rating: 'IMDb',
                    year: 'Release Date'
                }
                for (const [key, value] of Object.entries(sort)) {
                    if ($(input).val() === key) $(result).text(value)
                }
            }

            function toggleInput(wrapper, filter, result) {
                let img = $(wrapper.target).children('svg')
                let input = $(wrapper.target).children('input')

                // toggle then hide input and show image
                img.toggle()
                input.toggleClass("hidden")
                input.prop("checked", !input.prop("checked"));
                // update data
                filter.toggleItem($(input).attr('id'))
                //display data
                $(result).text(filterTitle(filter.data))
            }
        })
    </script>
</div>
