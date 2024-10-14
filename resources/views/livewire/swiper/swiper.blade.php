<div class="m-auto md:p-10 w-full h-full relative">
    <div class="relative h-full md:h-[600px] w-full md:w-96 m-auto">
        @for ($i=0; $i<4; $i++)

        <div

        @swipedright.fun="console.log('Success')"
        @swipedup.fun="console.log('nice')"
        @swipedleft.fun="console.log('ok')"
        x-data="{
            isSwiping: false,
            swipingLeft: false,
            swipingRight: false,
            swipingUp: false,
            {{--swipe right --}}
            swipeRight: function(){
                moveOutWidth = document.body.clientWidth *1.5;
                $el.style.transition = 'transform 0.3s ease-in-out';


                $el.style.transform = 'translate(' + moveOutWidth + 'px, -100px) rotate(-30deg)';


                setTimeout(()=> {
                    $el.remove();
                },300);

                {{-- dispatch --}}

                $dispatch('swipedright');
            },
            {{--swipe left --}}
             swipeLeft: function(){
                moveOutWidth = document.body.clientWidth *1.5;

                $el.style.transition = 'transform 0.3s ease-in-out';


                $el.style.transform = 'translate(' + -moveOutWidth + 'px, -100px) rotate(-30deg)';


                setTimeout(()=> {
                    $el.remove();
                },300);

                {{-- dispatch --}}

                $dispatch('swipedleft');
            },
            {{-- swipe up --}}

             swipeUp: function(){
                moveOutHeight = document.body.clientHeight *1.5;
                $el.style.transition = 'transform 0.3s ease-in-out';


                $el.style.transform = 'translate(0px, ' + -moveOutHeight + 'px) rotate(-20deg)';


                setTimeout(()=> {
                    $el.remove();
                },300);

                {{-- dispatch --}}

                $dispatch('swipedup');
            }
            }"

            x-init="
            element = $el;

            {{-- Initialize hammer js on current element --}}
            var hammertime = new Hammer(element);

            {{-- let the pan gesture support all directions. --}}
            hammertime.get('pan').set({
              direction   : Hammer.DIRECTION_ALL,
              touchAction: 'pan'
          });

            {{-- ON PAN --}}
            hammertime.on('pan', function (event) {

                    isSwiping= true;
                    if (event.deltaX === 0) return;
                    if (event.center.x === 0 && event.center.y === 0) return;

                    {{-- Swiped Right --}}
                    if ( event.deltaX > 20) {

                      swipingRight=true;//true
                      swipingLeft=false;
                      swipingUp=false;

                    }
                    {{-- Swiped Left --}}
                    else if (event.deltaX < -20) {

                      swipingLeft=true;//true
                      swipingRight=false;
                      swipingUp=false;

                    }
                    {{-- Super like feature --}}
                    else if (event.deltaY < -50 && Math.abs(event.deltaX) < 20 ) {
                      swipingUp=true;//true
                      swipingRight=false;
                      swipingLeft=false;
                    }

                    {{-- roate deg --}}
                    var rotate = event.deltaX/10;

                    {{--  Scroll effect along the Y-axis (upward scroll) --}}

                    {{-- Apply the transformation to rotate only in X direction in Clockwise and Anti-Clockwise by 10deg --}}
                    event.target.style.transform = 'translate(' + event.deltaX + 'px, ' + event.deltaY + 'px) rotate(' + rotate + 'deg)';

            });


            {{-- ON PANEND --}}
            hammertime.on('panend', function (event) {

              {{-- reset states --}}
              isSwiping =false;
              swipingLeft=false;
              swipingRight = false;
              swipingUp=false;


              {{-- Set thresholds for horizontal and vertical distances px --}}
              var horizontalThreshold = 200;
              var verticalThreshold = 200;

              {{-- Set thresholds for horizontal and vertical velocities --}}
              var velocityXThreshold = 0.5;
              var velocityYThreshold = 0.5;

              {{-- Check if the swipe distance and velocity are below the thresholds
                  for both horizontal and vertical directions --}}
              var keep = Math.abs(event.deltaX) < horizontalThreshold && Math.abs(event.velocityX) < velocityXThreshold &&
                          Math.abs(event.deltaY) < verticalThreshold && Math.abs(event.velocityY) < velocityYThreshold;

              if (keep) {

                {{-- Adjust the duration and timing function as needed --}}
                event.target.style.transition = 'transform 0.3s ease-in-out';
                event.target.style.transform = '';
                $el.style.transform = '';

                {{-- Clear the transition property after the animation completes --}}
                setTimeout(() => {
                  event.target.style.transition = '';
                  event.target.style.transform = '';
                  $el.style.transform = '';
                }, 300); // Use the same duration as the transition

              } else {

                var moveOutWidth = document.body.clientWidth;
                var moveOutHeight  = document.body.clientHeight;


                {{-- Decide to push left or right or up --}}

                {{-- SwipeRight --}}
                if (event.deltaX > 20) {
                    {{-- Adjust the transform as needed --}}
                  event.target.style.transform = 'translate(' + moveOutWidth + 'px, 10px)';
                  $dispatch('swipedright');
                }

                {{--Swipeleft  --}}
                else if (event.deltaX <-20)  {
                  $dispatch('swipedleft');
                  event.target.style.transform = 'translate(' + -moveOutWidth + 'px, 10px)';

                }

                {{-- Super like feature --}}
                else if (event.deltaY < -50 && Math.abs(event.deltaX) < 20 ) {

                $dispatch('swipedup');
                event.target.style.transform = 'translate(0px, ' + -moveOutHeight + 'px)';

                }

                {{-- remove element & draggged element from the DOM --}}
                event.target.remove();
                $el.remove();
              }

            });
        "
        :class="{'transform-none cursor-grap' : isSwiping}"
        class="absolute inset-0 m-auto transform ease-out duration-300 rounded-xl  cursor-pointer">
            <div class="h-full w-full">

                <div
                style="background-image: url('https://randomuser.me/api/portraits/women/{{$i+13}}.jpg')"
                class="relative overflow-hidden w-full h-full rounded-xl bg-cover">

                {{-- Swiper indicators --}}

                <div class="pointer-events-none">
                    <!-- LIKE Indicator -->
                    <span
                    x-cloak
                    x-show="swipingLeft"
                    class="border-2 rounded-md p-1 px-1 border-green-500 text-green-500 text-4xl capitalize font-extrabold top-10 left-5 -rotate-12 absolute z-5">
                        LIKE
                    </span>
                    <!-- NOPE Indicator -->
                    <span
                    x-cloak
                     x-show="swipingRight"
                    class="border-2 rounded-md p-1 px-1 border-red-500 text-red-500 text-4xl capitalize font-extrabold top-10 right-5 rotate-12 absolute z-5">
                        NOPE
                    </span>
                    <!-- SUPER LIKE Indicator -->
                    <span
                    x-cloak
                     x-show="swipingUp"
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
                                <button draggable="false"
                                @click="swipeLeft()"
                                class="rounded-full border-2 pointer-events-auto border-yellow-600 p-3 shrink-0 max-w-fit flex items-center text-yellow-600">
                                    <svg
                                    stroke-width="3"
                                    stroke="currentColor"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-9 h-9 shrink-0 m-auto group-hover:scale-105 transition-transform strok-2 stroke-current ">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                                    </svg>
                                </button>

                                <button draggable="false"
                                class="rounded-full border-2 pointer-events-auto border-red-600 p-3 shrink-0 max-w-fit flex items-center text-red-600">
                                    <svg
                                    stroke-width="3"
                                    stroke="currentColor"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-9 h-9 shrink-0 m-auto group-hover:scale-110 transition-transform">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                </button>

                                <button
                                @click="swipeUp()"
                                draggable="false" class="rounded-full border-2 pointer-events-auto border-cyan-600 p-3 shrink-0 max-w-fit flex items-center text-cyan-600">
                                    <svg
                                    stroke-width="3"
                                    stroke="currentColor"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-9 h-9 shrink-0 m-auto group-hover:scale-105 transition-transform strok-2 stroke-current">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                    </svg>
                                </button>

                                <button draggable="false"
                                @click="swipeRight()"
                                class="rounded-full border-2 pointer-events-auto border-green-600 p-3 shrink-0 max-w-fit flex items-center text-green-600">
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
        @endfor
    </div>
</div>
