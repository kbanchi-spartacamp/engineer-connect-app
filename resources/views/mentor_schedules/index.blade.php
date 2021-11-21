<x-app-layout>
    <div class="py-12">

        <x-flash-message :message="session('notice')" />
        <x-validation-errors :errors="$errors" />

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{ route('mentor_schedules.index') }}" method="get">
                    <ul class="flex">
                        <li class="ml-10">
                            @foreach ($dates as $date)
                                @if ((strpos(url()->full(), 'day=' . $date->format('Y-m-d'))) ||
                                (!strpos(url()->full(), 'day=') && ($date->format('Y-m-d') == now()->format('Y-m-d'))))
                                <a href="/mentor_schedules?{{ http_build_query(array_merge($searchParam, ['day' => $date->format('Y-m-d'), 'day_of_week' => $date->formatLocalized('%a')])) }}"
                                    class="text-3xl text-green-500 hover:text-blue-500">{{ $date->formatLocalized('%m/%d(%a)') }}</a>
                                <input type="hidden" name="day" value="{{ $date->format('Y-m-d') }}">
                                <input type="hidden" name="day_of_week" value="{{ $date->formatLocalized('%a') }}">
                            @else
                                <a href="/mentor_schedules?{{ http_build_query(array_merge($searchParam, ['day' => $date->format('Y-m-d'), 'day_of_week' => $date->formatLocalized('%a')])) }}"
                                    class="text-3xl hover:text-blue-500">{{ $date->formatLocalized('%m/%d(%a)') }}</a>
                            @endif
                            @endforeach
                        </li>
                    </ul>
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="flex bg-white overflow-hidden shadow-xl sm:rounded-lg">
                            <div class="m-4">
                                <select name="skill_category_id">
                                    @foreach ($skillCategories as $skillCategory)
                                        <option value="{{ $skillCategory->id }}" @if ($skillCategory->id == $searchParam['skill_category_id']) selected @endif>
                                            {{ $skillCategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="m-4">
                                <select name="start_time">
                                    @foreach ($times as $time)
                                        <option value="{{ $time }}" @if ($time == $searchParam['start_time']) selected @else @if (empty($searchParam['start_time']) && $loop->index == 0) selected @endif @endif>
                                            {{ $time }}
                                        </option>
                                    @endforeach
                                </select>
                                <span>〜</span>
                                <select name="end_time">
                                    @foreach ($times as $time)
                                        <option value="{{ $time }}" @if ($time == $searchParam['end_time']) selected @else @if (empty($searchParam['end_time']) && $loop->index == count($times) - 1) selected @endif @endif>
                                            {{ $time }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="m-4">
                                @if (strpos(url()->full(), 'bookmark=' . 'true'))
                                    <a href="/mentor_schedules?{{ http_build_query(array_merge($searchParam, ['bookmark' => 'false'])) }}"
                                        class="text-3xl text-green-500 hover:text-blue-500">ブックマーク</a>
                                @else
                                    <a href="/mentor_schedules?{{ http_build_query(array_merge($searchParam, ['bookmark' => 'true'])) }}"
                                        class="text-3xl hover:text-blue-500">ブックマーク</a>
                                @endif
                            </div>
                            <div class="m-4">
                                <input type="submit" value="検索"
                                    class="w-full sm:w-40 bg-gradient-to-r from-indigo-500 to-blue-600 hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 p-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500 w-full sm:w-32">
                            </div>
                        </div>
                    </div>
                </form>
                {{-- メンター一覧 --}}
                <div>
                    <div class="w-full">
                        <div class="bg-white w-full px-10 py-8 hover:shadow-2xl transition duration-500">
                            @foreach ($mentors as $mentor)
                                <div class="mt-4">
                                    <div class="flex justify-between text-sm items-center mb-4">
                                        <div class="text-gray-700">
                                        </div>
                                        <div class="border border-gray-900 px-2 h-7 leading-7 rounded-full text-right">
                                            @if ($mentor->my_review() != 0)
                                                @foreach (range(1, $mentor->my_review()) as $i)
                                                    ★
                                                @endforeach
                                            @endif
                                            @foreach (range($mentor->my_review(), 4) as $i)
                                                ☆
                                            @endforeach
                                        </div>
                                    </div>
                                    <h2 class="text-lg text-gray-700 font-semibold">
                                        {{ $mentor->name }}</h2>
                                    <div class="flex justify-between items-center">
                                        <div class="mt-4 flex items-center space-x-4 py-6">
                                            <div>
                                                <img src="{{ $mentor->profile_photo_url }}"
                                                    class="rounded-full w-20 h-20 mr-4 ml-10">
                                            </div>
                                        </div>
                                        <div class="flex">
                                            @if (empty($searchParam['day']) || empty($searchParam['day_of_week']))
                                                @foreach ($mentor->my_schedules(now(), DayOfWeekConst::DAY_OF_WEEK_LIST_EN[now()->formatLocalized('%a')]) as $mentor_schedule)
                                                    <a href="/reservations/create?mentor_schedule_id={{ $mentor_schedule->id }}&day={{ $searchParam['day'] }}"
                                                        class="flex justify-center bg-gradient-to-r from-indigo-500 to-blue-600 hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 mt-4 px-5 py-3 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500 mx-2">{{ $mentor_schedule->start_time->format('H:i') }}</a>
                                                @endforeach
                                            @else
                                                @foreach ($mentor->my_schedules($searchParam['day'], DayOfWeekConst::DAY_OF_WEEK_LIST_EN[$searchParam['day_of_week']]) as $mentor_schedule)
                                                    <a href="/reservations/create?mentor_schedule_id={{ $mentor_schedule->id }}&day={{ $searchParam['day'] }}"
                                                        class="flex justify-center bg-gradient-to-r from-indigo-500 to-blue-600 hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 mt-4 px-5 py-3 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500 mx-2">{{ $mentor_schedule->start_time->format('H:i') }}</a>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
