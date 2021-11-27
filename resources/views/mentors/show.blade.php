<x-app-layout>
    <div class="py-12">

        <x-flash-message :message="session('notice')" />
        <x-validation-errors :errors="$errors" />

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <article class="mb-4">
                    <div class="m-4">
                        <div class="flex justify-center">
                            <div><img src="{{ $mentor->profile_photo_url }}" alt=""
                                    class="h-24 w-24 rounded-full object-cover mr-3"></div>
                        </div>
                        <div class="flex justify-center">
                            <h2 class="font-bold font-sans break-normal text-gray-900 pt-6 pb-1 text-3xl md:text-4xl">
                                {{ $mentor->name }}</h2>
                        </div>
                        <div class="flex justify-end border-gray-900 px-2 h-7 leading-7 m-6 rounded-full text-right">
                            平均評価 :
                            @if ($mentor->my_review() != 0)
                                @foreach (range(1, $mentor->my_review()) as $i)
                                    ★
                                @endforeach
                            @endif
                            @if ($mentor->my_review() == 0)
                                @foreach (range($mentor->my_review(), 4) as $i)
                                    ☆
                                @endforeach
                            @endif
                        </div>
                        <div class="flex justify-end border-gray-900 px-2  leading-7 m-2 rounded-full text-right">
                            <div class="m-4">
                                <form action="{{ route('mentors.reviews.store', $mentor) }}" method="post">
                                    <label class="mr-3 w-3/10">
                                        あなたの評価
                                    </label>
                                    @csrf
                                    <input type="number" max="5" name="review" required placeholder="1〜5の数値を記入してください"
                                        value="{{ old('review') }}" class="rounded w-6/10 mx-3">
                                    <input type="submit" value="レビュー"
                                        class="w-full sm:w-40 bg-gradient-to-r from-yellow-300 to-yellow-500 hover:bg-gradient-to-l hover:from-yellow-500 hover:to-yellow-200 text-gray-100 p-2 rounded-full tracking-wide font-semibold  cursor-pointer transition ease-in duration-500 w-full sm:w-32">
                                </form>
                            </div>
                        </div>
                        <div class="flex justify-end m-2">
                            <div class="m-4">
                                @if (empty($bookmark))
                                    <form action="{{ route('mentors.bookmarks.store', $mentor) }}" method="post"
                                        onsubmit="checkDoubleSubmit(document.getElementById('sendBtn'))">
                                        @csrf
                                        <input type="submit" value="ブックマーク" id="sendBtn"
                                            class="text-xl hover:text-yellow-500 bg-transparent text-black font-medium">
                                    </form>
                                @else
                                    <form action="{{ route('mentors.bookmarks.destroy', [$mentor, $bookmark]) }}"
                                        method="post" onsubmit="checkDoubleSubmit(document.getElementById('sendBtn'))">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" value="ブックマーク" id="sendBtn"
                                            class="text-xl text-yellow-500 hover:text-black bg-transparent font-medium">
                                    </form>
                                @endif
                            </div>
                            <div class="m-4 content pr-4">
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
                            <div class="m-4">
                                <div class="flex justify-center">
                                    <h2 class="text-2xl my-4">対応スキル</h2>
                                </div>
                                <div class="flex justify-center">
                                    @foreach ($mentor->mentor_skills as $mentor_skill)
                                        <p class="text-gray-1000 m-4">・{{ $mentor_skill->skill_category->name }}</p>
                                    @endforeach
                                </div>
                                <div class="flex justify-center">
                                    <h2 class="text-2xl my-4">自己紹介</h2>
                                </div>
                                <div class="flex justify-center">
                                    <p class="text-gray-1000 text-base my-4">{!! nl2br(e($mentor->profile)) !!}</p>
                                </div>

                                <div class="sm:rounded-lg">
                                    <div>
                                        <div class="flex justify-center">
                                            <h2 class="text-2xl my-4">空き状況</h2>
                                        </div>
                                        <div class="flex overflow-x-auto m-5">
                                            <p class="text-2xl hover:text-blue-500">
                                                {{ $today->formatLocalized('%m/%d(%a)') }}</p>
                                            <div class="flex overflow-x-auto">
                                                @foreach ($mentor->my_schedules($today, DayOfWeekConst::DAY_OF_WEEK_LIST_EN[$today->formatLocalized('%a')]) as $mentor_schedule)
                                                    <div>
                                                        <a href="/reservations/create?mentor_schedule_id={{ $mentor_schedule->id }}&day={{ $today->format('Y-m-d') }}"
                                                            class="flex bg-gradient-to-r from-yellow-300 to-yellow-500 hover:bg-gradient-to-l hover:from-yellow-500 hover:to-yellow-300 text-gray-100 ml-10 px-7 py-3 rounded-full tracking-wide font-semibold  cursor-pointer transition ease-in">{{ $mentor_schedule->start_time->format('H:i') }}</a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="flex overflow-x-auto m-5">
                                            <p class="text-2xl hover:text-blue-500">
                                                {{ $tommorrow->formatLocalized('%m/%d(%a)') }}</p>
                                            <div class="flex overflow-x-auto">
                                                @foreach ($mentor->my_schedules($tommorrow, DayOfWeekConst::DAY_OF_WEEK_LIST_EN[$tommorrow->formatLocalized('%a')]) as $mentor_schedule)
                                                    <div>
                                                        <a href="/reservations/create?mentor_schedule_id={{ $mentor_schedule->id }}&day={{ $tommorrow->format('Y-m-d') }}"
                                                            class="flex bg-gradient-to-r from-yellow-300 to-yellow-500 hover:bg-gradient-to-l hover:from-yellow-500 hover:to-yellow-200 text-gray-100 ml-10 px-7 py-3 rounded-full tracking-wide font-semibold  cursor-pointer transition ease-in">{{ $mentor_schedule->start_time->format('H:i') }}</a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="flex overflow-x-auto m-5">
                                            <p class="text-2xl hover:text-blue-500">
                                                {{ $dayAfterTommorrow->formatLocalized('%m/%d(%a)') }}</p>
                                            <div class="flex overflow-x-auto">
                                                @foreach ($mentor->my_schedules($dayAfterTommorrow, DayOfWeekConst::DAY_OF_WEEK_LIST_EN[$dayAfterTommorrow->formatLocalized('%a')]) as $mentor_schedule)
                                                    <div>
                                                        <a href="/reservations/create?mentor_schedule_id={{ $mentor_schedule->id }}&day={{ $dayAfterTommorrow->format('Y-m-d') }}"
                                                            class="flex bg-gradient-to-r from-yellow-300 to-yellow-500 hover:bg-gradient-to-l hover:from-yellow-500 hover:to-yellow-200 text-gray-100 ml-10 px-7 py-3 rounded-full tracking-wide font-semibold  cursor-pointer transition ease-in">{{ $mentor_schedule->start_time->format('H:i') }}</a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="flex overflow-x-auto m-5">
                                            <p class="text-2xl hover:text-blue-500">
                                                {{ $threeDaysLater->formatLocalized('%m/%d(%a)') }}</p>
                                            <div class="flex overflow-x-auto">
                                                @foreach ($mentor->my_schedules($threeDaysLater, DayOfWeekConst::DAY_OF_WEEK_LIST_EN[$threeDaysLater->formatLocalized('%a')]) as $mentor_schedule)
                                                    <div>
                                                        <a href="/reservations/create?mentor_schedule_id={{ $mentor_schedule->id }}&day={{ $threeDaysLater->format('Y-m-d') }}"
                                                            class="flex bg-gradient-to-r from-yellow-300 to-yellow-500 hover:bg-gradient-to-l hover:from-yellow-500 hover:to-yellow-200 text-gray-100 ml-10 px-7 py-3 rounded-full tracking-wide font-semibold  cursor-pointer transition ease-in">{{ $mentor_schedule->start_time->format('H:i') }}</a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="flex overflow-x-auto m-5">
                                            <p class="text-2xl hover:text-blue-500">
                                                {{ $fourDaysLater->formatLocalized('%m/%d(%a)') }}</p>
                                            <div class="flex overflow-x-auto">
                                                @foreach ($mentor->my_schedules($fourDaysLater, DayOfWeekConst::DAY_OF_WEEK_LIST_EN[$fourDaysLater->formatLocalized('%a')]) as $mentor_schedule)
                                                    <div>
                                                        <a href="/reservations/create?mentor_schedule_id={{ $mentor_schedule->id }}&day={{ $fourDaysLater->format('Y-m-d') }}"
                                                            class="flex bg-gradient-to-r from-yellow-300 to-yellow-500 hover:bg-gradient-to-l hover:from-yellow-500 hover:to-yellow-200 text-gray-100 ml-10 px-7 py-3 rounded-full tracking-wide font-semibold  cursor-pointer transition ease-in">{{ $mentor_schedule->start_time->format('H:i') }}</a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="flex overflow-x-auto m-5">
                                            <p class="text-2xl hover:text-blue-500">
                                                {{ $fiveDaysLater->formatLocalized('%m/%d(%a)') }}</p>
                                            <div class="flex overflow-x-auto">
                                                @foreach ($mentor->my_schedules($fiveDaysLater, DayOfWeekConst::DAY_OF_WEEK_LIST_EN[$fiveDaysLater->formatLocalized('%a')]) as $mentor_schedule)
                                                    <div>
                                                        <a href="/reservations/create?mentor_schedule_id={{ $mentor_schedule->id }}&day={{ $fiveDaysLater->format('Y-m-d') }}"
                                                            class="flex bg-gradient-to-r from-yellow-300 to-yellow-500 hover:bg-gradient-to-l hover:from-yellow-500 hover:to-yellow-200 text-gray-100 ml-10 px-7 py-3 rounded-full tracking-wide font-semibold  cursor-pointer transition ease-in">{{ $mentor_schedule->start_time->format('H:i') }}</a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="flex overflow-x-auto m-5">
                                            <p class="text-2xl hover:text-blue-500">
                                                {{ $sixDaysLater->formatLocalized('%m/%d(%a)') }}</p>
                                            <div class="flex overflow-x-auto">
                                                @foreach ($mentor->my_schedules($sixDaysLater, DayOfWeekConst::DAY_OF_WEEK_LIST_EN[$sixDaysLater->formatLocalized('%a')]) as $mentor_schedule)
                                                    <div>
                                                        <a href="/reservations/create?mentor_schedule_id={{ $mentor_schedule->id }}&day={{ $fiveDaysLater->format('Y-m-d') }}"
                                                            class="flex bg-gradient-to-r from-yellow-300 to-yellow-500 hover:bg-gradient-to-l hover:from-yellow-500 hover:to-yellow-200 text-gray-100 ml-10 px-7 py-3 rounded-full tracking-wide font-semibold  cursor-pointer transition ease-in">{{ $mentor_schedule->start_time->format('H:i') }}</a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
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
    <script>
        function checkDoubleSubmit(obj) {
            if (obj.disabled) {
                return false;
            } else {
                obj.disabled = true;
                return true;
            }
        }
    </script>
</x-app-layout>
