<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center mb-6 mr-5">
                <h2>スケジュール設定画面</h2>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex justify-center mt-1 mb-3 mr-2">
                    <img src="{{ $user->profile_photo_url }}" class="h-10 w-10 rounded-full object-cover mr-3">
                </div>
                <form action="{{ route('mentor_schedules.store') }}" method="POST" class="rounded pt-3 pb-4 ">
                    @csrf
                    <p class="flex justify-center mb-5 mr-6">
                        本日の予定を登録
                    </p>
                    <div class="flex justify-center ">
                        <button class="mr-8 pl-3 text-left w-32  px-2 py- bg-white border border-black rounded">本日</button>
                        <select name="today_start_time" class="mr-6 rounded">
                            @foreach ($times as $time)
                            <option value="{{ $time }}" @if ($loop->index == 0) selected @endif>
                                {{ $time }}
                            </option>
                            @endforeach
                        </select>
                        <span class="pt-2 mr-6 ">〜</span>
                        <select name="today_end_time" class="mr-6 rounded">
                            @foreach ($times as $time)
                            <option value="{{ $time }}" @if ($loop->index == 0) selected @endif  >
                                {{ $time }}
                            </option>
                            @endforeach
                        </select>
                        <input type="submit" value="追加"
                            class="bg-green-400 hover:bg-green-500 text-white font-bold py-2 px-4 rounded">
                    </div>
                </form>
                <form action="{{ route('mentor_schedules.store') }}" method="POST" class="rounded pt-3 pb-7 ">
                    @csrf
                    <p class="flex justify-center mb-7 mr-6" >定期的な予定を登録</p>
                    <div class="flex justify-center">
                        <select name="day_of_week" class="mr-8 w-32 ml-9" class="text-csaienter">
                            @foreach (DayOfWeekConst::DAY_OF_WEEK_LIST as $day_of_week)
                            <option value="{{ $day_of_week }}" @if ($loop->index == 0) selected @endif >
                                {{ array_search($day_of_week, DayOfWeekConst::DAY_OF_WEEK_LIST) }}
                            </option>
                            @endforeach
                        </select>
                        <select name="open_time" class="mr-6">
                            @foreach ($open_times as $time)
                            <option value="{{ $time }}" @if ($loop->index == 0) selected @endif>
                                {{ $time }}
                            </option>
                            @endforeach
                        </select>
                        <label class="pt-2 mr-6">〜</label>
                        <select name="end_time" class="mr-6">
                            @foreach ($open_times as $time)
                            <option value="{{ $time }}" @if ($loop->index == 0) selected @endif>
                                {{ $time }}
                            </option>
                            @endforeach
                        </select>
                        <input type="submit" value="追加" class="bg-green-400 hover:bg-green-500 text-white font-bold py-2 px-4 rounded mr-9">
                    </div>
                </form>
                <div class="flex justify-center mr-6">
                    <h2>不定期なスケジュール</h2>
                </div>
                <div>
                    <table class="table-auto mb-7 flex justify-center">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Timing</th>
                                <th class="px-4 py-2">Start</th>
                                <th class="px-4 py-2">-</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mentorIrregularSchedules as $mentorIrregularSchedules)
                            <tr>
                                <td class="border px-4 py-2">
                                    {{ $mentorIrregularSchedules->day }}
                                </td>
                                <td class="border px-4 py-2">
                                    {{ $mentorIrregularSchedules->start_time }}</td>
                                <td class="border px-4 py-2">
                                    <form action="{{ route('mentor_schedules.destroy', $mentorIrregularSchedules) }}"
                                        method="post" class="w-full sm:w-32">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="削除" onclick="if(!confirm('削除しますか？')){return false};">
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <h2>定期的なスケジュール</h2>
                <table class="table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Timing</th>
                            <th class="px-4 py-2">Start</th>
                            <th class="px-4 py-2">-</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mentorRegularSchedules as $mentorRegularSchedule)
                        <tr>
                            <td class="border px-4 py-2">
                                {{ array_search($mentorRegularSchedule->day_of_week, DayOfWeekConst::DAY_OF_WEEK_LIST)
                                }}
                            </td>
                            <td class="border px-4 py-2">
                                {{ $mentorRegularSchedule->start_time }}</td>
                            <td class="border px-4 py-2">
                                <form action="{{ route('mentor_schedules.destroy', $mentorRegularSchedule) }}"
                                    method="post" class="w-full sm:w-32">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="削除" onclick="if(!confirm('削除しますか？')){return false};">
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
