<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center mb-6">
                <h2>予約一覧画面</h2>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    @foreach($reservations as $reservation)
                    <div class="container flex justify-center mx-auto">
                        <img src="{{ $reservation->user->profile_photo_url}}" class="rounded-full w-1/7">
                        <label class="flex justify-center items-center text-center w-1/4 text-3xl">
                            {{ $reservation->day->format('n/j') }}
                        </label>
                        <label class="flex justify-center items-center text-center w-1/4 text-3xl">
                            {{ substr($reservation->start_time,0,5) }}  〜
                        </label>
                        <a href=""class="flex justify-center items-center text-center w-1/4 text-3xl" >
                            メッセージ
                        </a>
                    </div>
                    <hr class="border-2">
                    @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
