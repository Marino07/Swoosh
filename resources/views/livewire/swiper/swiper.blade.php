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
                style="background-image: url('https://randomuser.me/api/portraits/women/17.jpg')"
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

                </div>
            </div>

        </div>
    </div>
</div>
