@if(count($images) > 1)
<div class="relative" style="padding: 0 10px">
    <!-- Carousel wrapper -->
    <div class="relative h-56 overflow-hidden rounded-lg sm:h-64 xl:h-80 2xl:h-96 ">
        @foreach($images as $key => $value)
        <div id="carousel-item-{{$key}}" class="duration-700 ease-in-out content-slide">
            <span
                class="absolute text-2xl font-semibold text-white -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 sm:text-3xl dark:text-gray-800">First
                Slide</span>
            <img src="{{url(Storage::url($value->path))}}"
                class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
        @endforeach
    </div>
    <!-- Slider indicators -->
    <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
        @foreach($images as $key => $value)
        <button id="carousel-indicator-{{$key}}" type="button" class="w-3 h-3 rounded-full" aria-current="true"
            aria-label="Slide 1"></button>
        @endforeach
    </div>
    <!-- Slider controls -->
    <button id="data-carousel-prev" type="button"
        class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none">
        <span
            class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-orange-300 text-orange-600 dark:bg-gray-800/30 group-hover:bg-orange-600 group-hover:text-orange-300 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                </path>
            </svg>
            <span class="hidden">Previous</span>
        </span>
    </button>
    <button id="data-carousel-next" type="button"
        class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none">
        <span
            class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-orange-300 text-orange-600 dark:bg-gray-800/30 group-hover:bg-orange-600 group-hover:text-orange-300 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                </path>
            </svg>
            <span class="hidden">Next</span>
        </span>
    </button>
</div>
@else
<div class="relative" style="padding: 0 10px">
    <div class="img-product w-full min-h-[300px] mb-4  bg-cover bg-no-repeat bg-center flex items-center rounded-t-lg"
        @if(count($images) > 0)
            style="background-image:url('{{url(Storage::url($images->first()->path))}}')" 
        @else
            style="background-image:url('/img/product_photo/default/default.jpg')"
        @endif
    >
    </div>
@endif
<script scoped>
    if (document.readyState === 'complete' && document.querySelectorAll('.content-slide').length > 0) {
    const items  = [];
    const options = {
        activeItemPosition: 1,
        interval: 6000,
        indicators: {
            activeClasses: 'bg-white dark:bg-gray-800',
            inactiveClasses: 'bg-white/50 dark:bg-gray-800/50 hover:bg-white dark:hover:bg-gray-800',
            items: []
        }
    };
   
        
        document.querySelectorAll('.content-slide').forEach(function (element, index) {
            items.push({
                position: index,
                el: document.getElementById('carousel-item-' + index)
            })
            options.indicators.items.push({
                position: index,
                el: document.getElementById('carousel-indicator-' + index)
            })
        });

        const carousel = new Carousel(items, options);
        const prevButton = document.getElementById('data-carousel-prev');
        const nextButton = document.getElementById('data-carousel-next');

        prevButton.addEventListener('click', () => {
            carousel.prev();
        });

        nextButton.addEventListener('click', () => {
            carousel.next();
        });
    }
</script>