<div>
     {{--Tabs section --}}
     <section
     x-data="{ tab: '{{request()->routeIs('chat.index') || request()->routeIs('chat')  ? '2' : '1' }}',}"
    x-init="
   Echo.private('users.{{auth()->id()}}')
    .notification((notification) => {
        if(notification['type'] == 'App\\Notifications\\MessageNotification'){

            $wire.$refresh();
        }
    });

    "
     @match-found.window="$wire.loadData()"
     class="mb-auto overflow-y-auto h-full overflow-x-scroll relative">

     <!-- Header with buttons to switch between tabs -->
     <header class="flex items-center gap-5 mb-2 p-4 sticky top-0 bg-white z-10">

         <!-- Button for the "Matches" tab -->
         <button
             @click="tab = '1'"
             :class="{ 'border-b-2 border-red-500' : tab === '1' }"
             class="font-bold text-sm px-2 pb-1.5">
             Matches
            @if (auth()->user()->count() > 0)
            <span class="rounded-full text-xs p-1 px-2 font-bold text-white bg-tinder">
                {{auth()->user()->matches->count()}}
            </span>
            @endif
         </button>

         <!-- Button for the "Chats" tab -->
         <button
             @click="tab = '2';"
             :class="{ 'border-b-2 border-red-500' : tab === '2' }"
             class="font-bold text-sm px-2 pb-1.5">
             Chats
                @if (auth()->user()->unReadMessages() > 0)
                <span class="rounded-full text-xs p-1 px-2 font-bold text-white bg-tinder">
                    {{auth()->user()->unReadMessages()}}
                </span>
                @endif
         </button>

     </header>
     <main class="h-full">
        @php
            $path = 'https://randomuser.me/api/portraits/women/';
        @endphp
     {{--matches --}}
     <aside class="px-2" x-cloak x-show="tab=='1'">
         <div class="grid grid-cols-3 gap-2">
            @foreach ($matches as $key =>  $match)


             <div wire:click="createConversation('{{$match->id}}')" class="relative cursor-pointer">
                 <!-- SVG ikona pozicionirana na gornjoj desnoj ivici slike -->
                 <span class="absolute -top-7 -right-7 ">
                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot text-red-500 w-16 h-16" viewBox="0 0 16 16">
                         <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
                     </svg>
                 </span>
                 <img src="{{$path . $key+45 . '.jpg'}}" alt="Random face" class="h-36 rounded-lg object-cover">
                 <h5 class="absolute rounded-lg bottom-2 left-2 text-white font-bold text-xs">
                     {{ $match->swipe1->user != auth()->user() ? $match->swipe2->user->name : $match->swipe1->user->name }}
                 </h5>
             </div>

             @endforeach

         </div>
     </aside>



        {{--chats --}}
     <aside  x-cloak x-show="tab=='2'">
         <ul>
             @foreach ($conversations as $key => $con )
             @php
                 $lastMessage = $con->messages()->latest()->first();
                 $path = 'https://i.pravatar.cc/300';
             @endphp


                 <li x-data="{ con: true, isToggled: false }">
                     <a @click="if (!isToggled) { con = !con; isToggled = true; }"
                        :class="con ? 'border-r-4 border-red-500 bg-white py-3' : ''"
                        class="flex gap-4 items-center p-2" wire:navigate href="/app/chat/{{$con->id}}">
                         <div class="relative">
                             <span class="inset-y-0 my-auto absolute -right-7">
                                 <svg
                                     :class="con ? 'text-red-500' : 'hidden'"
                                     class="w-14 h-14 stroke-[0.3px] stroke-white"
                                     xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                     <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
                                 </svg>
                             </span>
                             <x-avatar class="h-14 w-14" src="{{$path . $key}}"></x-avatar>
                         </div>
                         <div class="overflow-hidden">
                            <h6 class="font-bold truncate">
                                @if(auth()->user()->is($con->match->swipe1->user))
                                    {{ $con->match->swipe2->user->name}}
                                @elseif(auth()->user()->is($con->match->swipe2->user))
                                    {{ $con->match->swipe1->user->name }}
                                @endif

                                {{-- opcionalno : {{auth()->user()->is($con->match->swipe1->user) ?
                                 $con->match->swipe2->user->name : $con->match->swipe1->user->name}} --}}

                            </h6>


                             <p @class([
                                'text-gray-600 truncate truncate gap-1 flex items-center',
                                'font-semibold text-black' => !$lastMessage?->isRead() && $lastMessage?->sender_id != auth()->id(),
                                'font-normal text-gray-600' => $lastMessage?->isRead() && $lastMessage?->sender_id != auth()->id(),
                                'font-normal text-gray-600' => !$lastMessage?->isRead() && $lastMessage?->sender_id == auth()->id(),


                             ])>

                            @if($lastMessage?->sender_id == auth()->id())
                            <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                              </svg>
                              </span>
                              @endif


                                {{$con->messages()?->latest()->first()?->body }}</p>
                         </div>
                     </a>
                 </li>
                 @endforeach
         </ul>
     </aside>
     </main>

 </section>
</div>
