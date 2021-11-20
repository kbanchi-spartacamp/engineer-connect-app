<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center mb-4">
                <h2>スケジュール設定画面</h2>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex justify-center mt-4 mb-5 ">
                    <img src="{{ $user->profile_photo_url }}" class="rounded-full object-cover w-1/7 ">
                </div>
                <form action="{{ route('mentor_schedules.store') }}" method="POST" class="rounded pb-4 ">
                    @csrf
                    <p class="flex justify-center mb-5 ">
                        本日の予定を登録
                    </p>
                    <div class="flex justify-center">
                        <table class="table-fixed w-5/6 mb-5">
                            <tbody>
                                <tr>
                                    <td class="px-4 w-1/4">
                                        <select class="text-center rounded w-full  ">
                                            <option>
                                                本日
                                            </option>
                                        </select>
                                    </td>
                                    <td class="px-4 w-1/4">
                                        <select name="today_start_time" class="text-center rounded w-full ">
                                            @foreach ($times as $time)
                                            <option value="{{ $time }}" @if ($loop->index == 0) selected @endif>
                                                {{ $time }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="w-2 pr-4">
                                        <span class="pt-2">〜</span>
                                    </td>
                                    <td class="px-4 w-1/4">
                                        <select name="today_end_time" class="text-center rounded w-full">
                                            @foreach ($times as $time)
                                            <option value="{{ $time }}" @if ($loop->index == 0) selected @endif >
                                                {{ $time }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="px-4 w-1/4">
                                        <input type="submit" value="追加"
                                            class="bg-green-400 hover:bg-green-500 text-white font-bold py-2 px-4 rounded w-full">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
                <form action="{{ route('mentor_schedules.store') }}" method="POST" class="rounded">
                    @csrf
                    <p class="flex justify-center mb-5 ">定期的な予定を登録</p>
                    <div class="flex justify-center">
                        <table class="table-fixed w-5/6 mb-8">
                            <tbody>
                                <tr>
                                    <td class="px-4 w-1/4">
                                        <select name="day_of_week" class="text-center rounded w-full">
                                            @foreach (DayOfWeekConst::DAY_OF_WEEK_LIST as $day_of_week)
                                            <option value="{{ $day_of_week }}" @if ($loop->index == 0) selected @endif >
                                                {{ array_search($day_of_week, DayOfWeekConst::DAY_OF_WEEK_LIST) }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="px-4 w-1/4">
                                        <select name="open_time" class="text-center rounded w-full">
                                            @foreach ($open_times as $time)
                                            <option value="{{ $time }}" @if ($loop->index == 0) selected @endif>
                                                {{ $time }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="w-2 pr-4">
                                        <label class="pt-2 ">〜</label>
                                    </td>
                                    <td class="px-4 w-1/4">
                                        <select name="end_time" class="text-center rounded w-full">
                                            @foreach ($open_times as $time)
                                            <option value="{{ $time }}" @if ($loop->index == 0) selected @endif>
                                                {{ $time }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="px-4 w-1/4">
                                        <input type="submit" value="追加"
                                            class="bg-green-400 hover:bg-green-500 text-white font-bold py-2 px-4 rounded w-full">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>

                <p class="flex justify-center mb-2 ">不定期なスケジュール</p>

                <div class="flex justify-center">
                    <table class="table-fixed w-5/6 mb-7">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 w-1/4 text-left">Timing</th>
                                <th class="px-4 py-2 text-left">Start</th>
                                <th class="py-2 w-1/4"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mentorIrregularSchedules as $mentorIrregularSchedules)
                            <tr class="border">
                                <td class="px-4 py-2">
                                    {{ $mentorIrregularSchedules->day->format('n/j') }}
                                </td>
                                <td class="px-4 py-2">
                                    {{ $mentorIrregularSchedules->start_time }}</td>
                                <td class="px-4 py-2 w-full">
                                    <form action="{{ route('mentor_schedules.destroy', $mentorIrregularSchedules) }}"
                                        method="post" class="w-full ">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="削除" onclick="if(!confirm('削除しますか？')){return false};"
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded w-full">
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <p class="flex justify-center mb-2 ">定期的なスケジュール</p>
                <div class="flex justify-center">
                    <table class="table-fixed w-5/6 mb-7">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 w-1/4 text-left">Timing</th>
                                <th class="px-4 py-2 text-left">Start</th>
                                <th class="py-2 w-1/4"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mentorRegularSchedules as $mentorRegularSchedule)
                            <tr>
                                <td class="border px-4 py-2">
                                    {{ array_search($mentorRegularSchedule->day_of_week,
                                    DayOfWeekConst::DAY_OF_WEEK_LIST)
                                    }}
                                </td>
                                <td class="border px-4 py-2">
                                    {{ $mentorRegularSchedule->start_time }}</td>
                                <td class="border px-4 py-2 w-full">
                                    <form action="{{ route('mentor_schedules.destroy', $mentorRegularSchedule) }}"
                                        method="post" class="w-full ">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="削除" onclick="if(!confirm('削除しますか？')){return false};"
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded w-full">
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
