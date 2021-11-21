<x-mentor-layout>
    <div class="py-12">

        <x-flash-message :message="$profile" />
        <x-flash-message :message="$skill_create" />
        <x-flash-message :message="$schedule_create" />
        <x-validation-errors :errors="$errors" />

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center mb-6 mr-4">
                <h2 class="text-wh">予約一覧画面</h2>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @foreach ($reservations as $reservation)
                    <div class="container flex justify-center mx-auto my-2">
                        @if (Auth::guard(UserConst::GUARD)->check())
                            <img src="{{ $reservation->mentor->profile_photo_url }}"
                                class="rounded-full w-1/7 mr-4 ml-10">
                        @else
                            <img src="{{ $reservation->user->profile_photo_url }}"
                                class="rounded-full w-1/7 mr-4 ml-10">
                        @endif
                        <label class="flex justify-center items-center text-center w-1/4 text-3xl  ">
                            {{ $reservation->day->format('n/j') }}
                        </label>
                        <label class="flex justify-center items-center text-center w-1/4 text-3xl mr-4">
                            {{ $reservation->start_time->format('G:i') }} 〜
                        </label>
                        <a href="{{ route('users.mentors.messages.index', [$reservation->user, $reservation->mentor]) }}"
                            class="flex justify-center items-center text-center bg-green-400 hover:bg-green-500 text-white font-bold py-2 px-4 rounded">
                            メッセージ
                        </a>
                    </div>
                    <hr class="boild">
                @endforeach
            </div>
        </div>
    </div>
</x-mentor-layout>
