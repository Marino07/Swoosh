<div class="m-auto md:p-10 w-full h-full relative">
    <div class="relative h-full md:h-[600px] w-full md:w-96 m-auto">
        <div x-data="{
            isSwiping: false,
            isSwipingLeft: false,
            isSwipingRight: false,
            isSwipingUp: false
        }"
        :class="{'transform-none cursor-grap' : isSwiping}"
        class="absolute inset-0 m-auto transform ease-out duration-300 rounded-xl bg-gray-500 cursor-pointer">
            <div class="h-full w-full">

                <div
                style="background-image: url('https://randomuser.me/api/portraits/women/18.jpg')"
                class="relative overflow-hidden w-full h-full rounded-xl bg-cover">

                {{-- Swiper indicators --}}

                <div class="pointer-events-none">
                    <!-- LIKE Indicator -->
                    <span
                    x-cloak
                    x-show="isSwipingRight"
                    class="border-2 rounded-md p-1 px-1 border-green-500 text-green-500 text-4xl capitalize font-extrabold top-10 left-5 -rotate-12 absolute z-5">
                        LIKE
                    </span>
                    <!-- NOPE Indicator -->
                    <span
                    x-cloak
                     x-show="isSwipingLeft"
                    class="border-2 rounded-md p-1 px-1 border-red-500 text-red-500 text-4xl capitalize font-extrabold top-10 right-5 rotate-12 absolute z-5">
                        NOPE
                    </span>
                    <!-- SUPER LIKE Indicator -->
                    <span
                    x-cloak
                     x-show="isSwipingUp"
                    class="border-2 rounded-md p-1 px-1 border-yellow-500 text-yellow-500 text-4xl capitalize font-extrabold mx-auto  bottom-48 max-w-fit inset-x-0 -rotate-12 absolute z-5">
                        SUPER LIKE
                    </span>
                </div>
                {{--Informations and actions --}}
                <section class="absolute inset-x-0 bottom-0 inset-y-1/2 py-2 bg-gradient-to-t from-black to-black/0 pointer-events-none">

                    <div class="flex flex-col h-full gap-2.5 mt-auto p-5 text-white">
                        <div class="grid grid-cols-12 items-center">
                            <div class="col-span-10">
                                <h4 class="font-bold text-3xl">
                                    {{fake()->name}}
                                </h4>
                                <p class="text-lg line-clamp-3">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam sint at odio officia obcaecati ad dignissimos mollitia unde. Neque, facere. Vel, consequatur deserunt. Ab autem accusantium incidunt quos esse quia?
                                </p>
                            </div>
                            <div class="col-span-2 justify-end flex pointer-events-auto">
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                      </svg>

                                </button>
                            </div>

                        </div>

                        {{--Actions --}}

                        <div class="grid grid-cols-5 gap-1 items-center mt-auto">
                            {{-- Swipe left --}}
                            <div class="group flex space-x-2">
                                <button draggable="false" class="rounded-full border-2 pointer-events-auto border-yellow-600 p-3 shrink-0 max-w-fit flex items-center text-yellow-600">
                                    <svg
                                    stroke-width="3"
                                    stroke="currentColor"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-9 h-9 shrink-0 m-auto group-hover:scale-105 transition-transform strok-2 stroke-current ">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                                    </svg>
                                </button>

                                <button draggable="false" class="rounded-full border-2 pointer-events-auto border-red-600 p-3 shrink-0 max-w-fit flex items-center text-red-600">
                                    <svg
                                    stroke-width="3"
                                    stroke="currentColor"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-9 h-9 shrink-0 m-auto group-hover:scale-110 transition-transform">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                </button>

                                <button draggable="false" class="rounded-full border-2 pointer-events-auto border-cyan-600 p-3 shrink-0 max-w-fit flex items-center text-cyan-600">
                                    <svg
                                    stroke-width="3"
                                    stroke="currentColor"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-9 h-9 shrink-0 m-auto group-hover:scale-105 transition-transform strok-2 stroke-current">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                    </svg>
                                </button>

                                <button draggable="false" class="rounded-full border-2 pointer-events-auto border-green-600 p-3 shrink-0 max-w-fit flex items-center text-green-600">
                                    <svg
                                    stroke-width="3"
                                    stroke="currentColor"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-9 h-9 shrink-0 m-auto group-hover:scale-105 transition-transform strok-2 stroke-current">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m15 15 6-6m0 0-6-6m6 6H9a6 6 0 0 0 0 12h3" />
                                    </svg>
                                </button>

                                <button draggable="false" class="rounded-full border-2 pointer-events-auto border-purple-600 p-3 shrink-0 max-w-fit flex items-center text-purple-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-9 h-9 shrink-0 m-auto group-hover:scale-105 transition-transform strok-2 ">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
                                    </svg>
                                </button>
                            </div>


                        </div>

                    </div>

                </section>

                </div>
            </div>

        </div>
    </div>
</div>
