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
                <form action="{{ route('mentor_schedules.store', $user) }}" method="POST" class="rounded pt-3 pb-8 " >
                    @csrf
                    <button> 本日</button>
                    <select name="start_time" id="">
                        @foreach ($times as $time)
                        <option value="{{ $time }}" @if ($loop->index == 0) selected @endif>{{ $time }}
                        </option>
                        @endforeach
                    </select>
                    <span>〜</span>
                    <select name="end_time" id="">
                        @foreach ($times as $time)
                        <option value="{{ $time }}" @if ($loop->index == count($times) - 1) selected @endif>{{ $time }}
                        </option>
                        @endforeach
                    </select>
                    <input type="submit" value="追加">
                </form>
                <form action="{{ route('mentor_schedules.store', $user) }}" method="POST" class="rounded pt-3 pb-8 ">
                    @csrf
                    <select name="day_of_week">
                        <option disabled selected value="">曜日</option>
                        @foreach(array_keys(DayOfWeekConst::DAY_OF_WEEK_LIST) as $day_of_week)
                        <option value="{{ $day_of_week }}" @if ($loop->index == 0) selected @endif>{{ $day_of_week }}</option>
                        @endforeach
                        </option>
                    </select>
                    <select name="" id="">
                        @foreach ($open_times as $time)
                        <option value="{{ $time }}" @if ($loop->index == 0) selected @endif>{{ $time }}
                        </option>
                        @endforeach
                    </select>
                    <label>〜</label>
                    <select name="" id="">
                        @foreach ($open_times as $time)
                        <option value="{{ $time }}" @if ($loop->index == count($times) - 1) selected @endif>{{ $time }}
                        </option>
                        @endforeach
                    </select>
                    <input type="submit" value="追加">
                </form>
                <div>
                    <div>曜日</div>
                    <div>時間</div>
                    <div>〜</div>
                    <div>時間</div>
                    <form action="{{ route('mentor_schedules.destroy',[$user]) }}" method="post" class="w-full sm:w-32">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="削除" onclick="if(!confirm('削除しますか？')){return false};">
                    </form>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>
