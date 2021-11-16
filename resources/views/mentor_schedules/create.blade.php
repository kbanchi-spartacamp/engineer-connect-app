<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center mb-6">
                <h2>スケジュール設定画面</h2>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex justify-center mt-1 mb-3">
                    <img src="{{ $user->profile_photo_url }}" class="h-10 w-10 rounded-full object-cover mr-3">
                </div>
                <form action="{{ route('mentor_schedules.store') }}" method="POST" class="rounded pt-3 pb-8 ">
                    @csrf
                    <p>本日の予定を登録</p>
                    <select name="today_start_time">
                        @foreach ($times as $time)
                        <option value="{{ $time }}" @if ($loop->index == 0) selected @endif>
                            {{ $time }}
                        </option>
                        @endforeach
                    </select>
                    <span>〜</span>
                    <select name="today_end_time">
                        @foreach ($times as $time)
                        <option value="{{ $time }}" @if ($loop->index == 0) selected @endif>
                            {{ $time }}
                        </option>
                        @endforeach
                    </select>
                    <input type="submit" value="追加">
                </form>
                <form action="{{ route('mentor_schedules.store') }}" method="POST" class="rounded pt-3 pb-8 ">
                    @csrf
                    <p>定期的な予定を登録</p>
                    <select name="day_of_week">
                        @foreach (App\Consts\DayOfWeekConst::DAY_OF_WEEK_LIST as $day_of_week)
                        <option value="{{ $day_of_week }}" @if ($loop->index == 0) selected @endif>
                            {{ array_search($day_of_week, App\Consts\DayOfWeekConst::DAY_OF_WEEK_LIST) }}
                        </option>
                        @endforeach
                    </select>
                    <select name="open_time">
                        @foreach ($open_times as $time)
                        <option value="{{ $time }}" @if ($loop->index == 0) selected @endif>
                            {{ $time }}
                        </option>
                        @endforeach
                    </select>
                    <label>〜</label>
                    <select name="end_time">
                        @foreach ($open_times as $time)
                        <option value="{{ $time }}" @if ($loop->index == 0) selected @endif>
                            {{ $time }}
                        </option>
                        @endforeach
                    </select>
                    <input type="submit" value="追加">
                </form>
                <h2>定期的なスケジュール</h2>
                <table class="table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Timing</th>
                            <th class="px-4 py-2">Start</th>
                            <th class="px-4 py-2">End</th>
                            <th class="px-4 py-2">-</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user->mentor_schedules as $mentor_schedule)
                        @if ($mentor_schedule->regular_type == 1)
                        <tr>
                            <td class="border px-4 py-2">本日</td>
                            <td class="border px-4 py-2">{{ $mentor_schedule->start_time }}</td>
                            <td class="border px-4 py-2">19:30</td>
                            <td class="border px-4 py-2">
                                <form action="" method="post" class="w-full sm:w-32">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="削除" onclick="if(!confirm('削除しますか？')){return false};">
                                </form>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
                <h2>不定期なスケジュール</h2>
                <table class="table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Timing</th>
                            <th class="px-4 py-2">Start</th>
                            <th class="px-4 py-2">End</th>
                            <th class="px-4 py-2">-</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user->mentor_schedules as $mentor_schedule)
                        @if ($mentor_schedule->regular_type == 0)
                        <tr>
                            <td class="border px-4 py-2">{{ array_search($mentor_schedule->day_of_week, App\Consts\DayOfWeekConst::DAY_OF_WEEK_LIST) }}</td>
                            <td class="border px-4 py-2">{{ $mentor_schedule->start_time }}</td>
                            <td class="border px-4 py-2">19:30</td>
                            <td class="border px-4 py-2">
                                <form action="" method="post" class="w-full sm:w-32">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="削除" onclick="if(!confirm('削除しますか？')){return false};">
                                </form>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
