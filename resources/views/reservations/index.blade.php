<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center mb-6 mr-4">
                <h2>予約一覧画面</h2>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    @foreach($reservations as $reservation)
                    <div class="container flex justify-center mx-auto">
                        <img src="{{ $reservation->user->profile_photo_url}}" class="rounded-full w-1/7 mr-4 ml-10">
                        <label class="flex justify-center items-center text-center w-1/4 text-3xl ">
                            {{ $reservation->day->format('n/j') }}
                        </label>
                        <label class="flex justify-center items-center text-center w-1/4 text-3xl mr-4">
                            {{ substr($reservation->start_time,0,5) }}  〜
                        </label>
                        <a href=""class="flex justify-center items-center text-center w-1/10bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" >
                            メッセージ
                        </a>
                    </div>
                    <hr class="border-2">
                    @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
