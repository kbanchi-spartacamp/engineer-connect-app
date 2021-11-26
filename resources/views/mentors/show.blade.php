<x-app-layout>
    <div class="py-12">

        <x-flash-message :message="session('notice')" />
        <x-validation-errors :errors="$errors" />

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <article class="mb-4">
                    <div class="container mx-auto">
                        <div class="flex justify-center">
                            <div><img src="{{ $mentor->profile_photo_url }}" alt=""
                                    class="h-24 w-24 rounded-full object-cover mr-3"></div>
                        </div>
                        <div class="flex justify-center">
                            <h2 class="font-bold font-sans break-normal text-gray-900 pt-6 pb-1 text-3xl md:text-4xl">
                                {{ $mentor->name }}</h2>
                        </div>
                        <div class="flex justify-end border-gray-900 px-2 h-7 leading-7 m-6 rounded-full text-right">
                            評価:★★★☆☆</div>
                    </div>
                    <div class="flex justify-end">
                        <div class="m-4">
                            <input type="submit" value="お気に入り"
                                class="w-full sm:w-40 bg-gradient-to-r from-yellow-300 to-yellow-500 hover:bg-gradient-to-l hover:from-yellow-500 hover:to-yellow-200 text-gray-100 p-2 rounded-full tracking-wide font-semibold  cursor-pointer transition ease-in duration-500 w-full sm:w-32">
                        </div>
                        <div class="m-4 content">
                            <form action="{{ route('payment') }}" method="post">
                                {{ csrf_field() }}
                                <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="{{ env('STRIPE_KEY') }}"
                                                                data-amount="500" data-name="Stripe Demo" data-label="決済をする"
                                                                data-description="Online course about integrating Stripe"
                                                                data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                                                data-locale="auto" data-currency="JPY">
                                </script>
                            </form>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-end">
                            <div class="m-4">
                                @if (strpos(url()->full(), 'bookmark=' . 'true'))
                                    <a href="/mentor_schedules?{{ http_build_query(array_merge($searchParam, ['bookmark' => 'false'])) }}"
                                        class="text-3xl text-yellow-500 hover:text-yellow-600">ブックマーク</a>
                                @else
                                    <a href="/mentor_schedules?{{ http_build_query(array_merge($searchParam, ['bookmark' => 'true'])) }}"
                                        class="text-2xl hover:text-yellow-500">ブックマーク</a>
                                @endif
                            </div>
                        </div>
                        <div class="m-4">
                            <div>
                                <h2 class="text-2xl">対応スキル</h2>
                                @foreach ($mentor->mentor_skills as $mentor_skill)
                                    <p class="flex text-gray-1000">・{{ $mentor_skill->skill_category->name }}</p>
                                @endforeach
                            </div>
                            <div>
                                <h2 class="text-2xl">自己紹介</h2>
                                <p class="text-gray-1000 text-base">{!! nl2br(e($mentor->profile)) !!}</p>
                            </div>
                            <div class="shadow-xl sm:rounded-lg">
                                <div>
                                    <h2 class="text-2xl">空き状況</h2>
                                    <div class="flex justify center">
                                        <a href=""
                                            class="text-2xl hover:text-blue-500">{{ $today->formatLocalized('%m/%d(%a)') }}</a>
                                        <div class="flex justify center">
                                            @foreach ($mentor->mentor_schedules as $mentor_schedule)
                                                <div>
                                                    @if(!empty($mentor_schedule->day))
                                                    @if ((DayOfWeekConst::DAY_OF_WEEK_LIST_EN[$today->formatLocalized('%a')] == $mentor_schedule->day_of_week) || (($mentor_schedule->day->format('Y-m-d') == now()->format('Y-m-d')) && ($mentor_schedule->start_time >= now())))
                                                        <a href="/reservations/create?mentor_schedule_id={{ $mentor_schedule->id }}&day={{ $searchParam['day'] }}"
                                                            class="flex bg-gradient-to-r from-indigo-500 to-blue-600 hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 ml-10 px-7 py-3 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in">{{ $mentor_schedule->start_time->format('H:i') }}</a>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="flex justify center">
                                        <a href=""
                                            class="text-2xl hover:text-blue-500">{{ $tommorrow->formatLocalized('%m/%d(%a)') }}</a>
                                        <div class="flex justify center">
                                            @foreach ($mentor->mentor_schedules as $mentor_schedule)
                                                <div>
                                                    {{-- @if ((DayOfWeekConst::DAY_OF_WEEK_LIST_EN[$tommorrow->formatLocalized('%a')] == $mentor_schedule->day_of_week) || ($mentor_schedule->day->format('Y-m-d') == $tommorrow->format('Y-m-d'))) --}}
                                                        <a href="/reservations/create?mentor_schedule_id={{ $mentor_schedule->id }}&day={{ $searchParam['day'] }}"
                                                            class="flex bg-gradient-to-r from-indigo-500 to-blue-600 hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 ml-10 px-7 py-3 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in">{{ $mentor_schedule->start_time->format('H:i') }}</a>
                                                    {{-- @endif --}}
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="flex justify center">
                                        <a href=""
                                            class="text-2xl hover:text-blue-500">{{ $dayAfterTommorrow->formatLocalized('%m/%d(%a)') }}</a>
                                        <div class="flex justify center">
                                            @foreach ($mentor->mentor_schedules as $mentor_schedule)
                                                <div>
                                                    @if ($mentor_schedule->day->format('Y-m-d') == $dayAfterTommorrow->format('Y-m-d') )
                                                        <a href="/reservations/create?mentor_schedule_id={{ $mentor_schedule->id }}&day={{ $searchParam['day'] }}"
                                                            class="flex bg-gradient-to-r from-indigo-500 to-blue-600 hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 ml-10 px-7 py-3 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in">{{ $mentor_schedule->start_time->format('H:i') }}</a>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="flex justify center">
                                        <a href=""
                                            class="text-2xl hover:text-blue-500">{{ $threeDaysLater->formatLocalized('%m/%d(%a)') }}</a>
                                        <div class="flex justify center">
                                            @foreach ($mentor->mentor_schedules as $mentor_schedule)
                                                <div>
                                                    @if ($mentor_schedule->day->format('Y-m-d') == $threeDaysLater->format('Y-m-d') )
                                                        <a href="/reservations/create?mentor_schedule_id={{ $mentor_schedule->id }}&day={{ $searchParam['day'] }}"
                                                            class="flex bg-gradient-to-r from-indigo-500 to-blue-600 hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 ml-10 px-7 py-3 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in">{{ $mentor_schedule->start_time->format('H:i') }}</a>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="flex justify center">
                                        <a href=""
                                            class="text-2xl hover:text-blue-500">{{ $fourDaysLater->formatLocalized('%m/%d(%a)') }}</a>
                                        <div class="flex justify center">
                                            @foreach ($mentor->mentor_schedules as $mentor_schedule)
                                                <div>
                                                    @if ($mentor_schedule->day->format('Y-m-d') == $fourDaysLater->format('Y-m-d') )
                                                        <a href="/reservations/create?mentor_schedule_id={{ $mentor_schedule->id }}&day={{ $searchParam['day'] }}"
                                                            class="flex bg-gradient-to-r from-indigo-500 to-blue-600 hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 ml-10 px-7 py-3 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in">{{ $mentor_schedule->start_time->format('H:i') }}</a>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="flex justify center">
                                        <a href=""
                                            class="text-2xl hover:text-blue-500">{{ $fiveDaysLater->formatLocalized('%m/%d(%a)') }}</a>
                                        <div class="flex justify center">
                                            @foreach ($mentor->mentor_schedules as $mentor_schedule)
                                                <div>
                                                    @if ($mentor_schedule->day->format('Y-m-d') == $fiveDaysLater->format('Y-m-d') )
                                                        <a href="/reservations/create?mentor_schedule_id={{ $mentor_schedule->id }}&day={{ $searchParam['day'] }}"
                                                            class="flex bg-gradient-to-r from-indigo-500 to-blue-600 hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 ml-10 px-7 py-3 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in">{{ $mentor_schedule->start_time->format('H:i') }}</a>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="flex justify center">
                                        <a href=""
                                            class="text-2xl hover:text-blue-500">{{ $sixDaysLater->formatLocalized('%m/%d(%a)') }}</a>
                                        <div class="flex justify center">
                                            @foreach ($mentor->mentor_schedules as $mentor_schedule)
                                                <div>
                                                    @if ($mentor_schedule->day->format('Y-m-d') == $sixDaysLater->format('Y-m-d') )
                                                        <a href="/reservations/create?mentor_schedule_id={{ $mentor_schedule->id }}&day={{ $searchParam['day'] }}"
                                                            class="flex bg-gradient-to-r from-indigo-500 to-blue-600 hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 ml-10 px-7 py-3 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in">{{ $mentor_schedule->start_time->format('H:i') }}</a>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                </article>
            </div>
            <div class="m-4">
                <a href="{{ route('mentor_schedules.index') }}"
                    class="bg-black text-white font-bold py-2 px-10 rounded shadow-xl hover:bg-gray-dark hover:text-white">
                    戻る
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
