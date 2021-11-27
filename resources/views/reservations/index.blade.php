<x-mentor-layout>
    <div class="py-12">

        <x-flash-message :message="$profile" />
        <x-flash-message :message="$skill_create" />
        <x-flash-message :message="$schedule_create" />
        <x-validation-errors :errors="$errors" />

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center mb-6">
                <h2>予約一覧画面</h2>
            </div>
            @if ($reservations->count() == 0)
            <div class="flex justify-center mt-20">
                <p class="text-xl font-semibold">予約が入っていません。</p>
            </div>
            @endif
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @foreach ($reservations as $reservation)
                @if ($reservation->day >= now() || ($reservation->day->toDateString() == now()->toDateString() &&
                $reservation->start_time >= now()))
                <div class="container flex justify-center mx-auto my-1">
                    @if (Auth::guard(UserConst::GUARD)->check())
                    <a href="{{ route('mentors.show', $reservation->mentor) }}">
                        <img src="{{ $reservation->mentor->profile_photo_url }}"
                            class="rounded-full mr-4 ml-5 w-12 h-12">
                    </a>
                    @else
                    <img src="{{ $reservation->user->profile_photo_url }}" class="rounded-full mr-4 ml-5 w-12 h-12">
                    @endif
                    <label class="flex justify-center items-center text-center w-1/5 text-3xl  ">
                        {{ $reservation->day->format('n/j') }}
                    </label>
                    <label class="flex justify-center items-center text-center w-1/5 text-3xl mr-4">
                        {{ $reservation->start_time->format('G:i') }} 〜
                    </label>
                    <a href="{{ route('users.mentors.messages.index', [$reservation->user, $reservation->mentor]) }}"
                        class="flex w-32 justify-center items-center text-center bg-green-400 hover:bg-green-500 text-white font-bold py-2 px-4 rounded mr-10">
                        メッセージ
                    </a>
                    @if (Auth::guard(UserConst::GUARD)->check())
                    <form action="{{ route('reservations.destroy', $reservation) }}" method="post" class="w-32">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="削除" onclick="if(!confirm('削除しますか？')){return false};"
                            class="flex w-full h-full justify-center items-center text-center bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    </form>
                    @endif
                </div>
                <hr class="boild">
                @else
                <div class="container flex justify-center mx-auto my-2 bg-gray-500">
                    @if (Auth::guard(UserConst::GUARD)->check())
                    <img src="{{ $reservation->mentor->profile_photo_url }}" class="rounded-full w-12 h-12 mr-4 ml-5">
                    @else
                    <img src="{{ $reservation->user->profile_photo_url }}" class="rounded-full w-12 h-12 mr-4 ml-5">
                    @endif
                    <label class="flex justify-center items-center text-center w-1/5 text-3xl  ">
                        {{ $reservation->day->format('n/j') }}
                    </label>
                    <label class="flex justify-center items-center text-center w-1/5 text-3xl mr-4">
                        {{ $reservation->start_time->format('G:i') }} 〜
                    </label>
                    <a href="{{ route('users.mentors.messages.index', [$reservation->user, $reservation->mentor]) }}"
                        class="flex justify-center items-center text-center bg-green-400 hover:bg-green-500 text-white font-bold py-2 px-4 rounded w-32 mr-10">
                        メッセージ
                    </a>
                    @if (Auth::guard(UserConst::GUARD)->check())
                    <form action="{{ route('reservations.destroy', $reservation) }}" method="post" class="w-32">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="削除" onclick="if(!confirm('削除しますか？')){return false};"
                            class="hidden flex justify-center items-center text-center bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ">
                    </form>
                    @endif
                </div>
                <hr class="boild">
                @endif
                @endforeach
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
</x-mentor-layout>
