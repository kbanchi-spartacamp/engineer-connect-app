<x-app-layout>
    <div class="py-12">

        <x-flash-message :message="session('notice')" />
        <x-validation-errors :errors="$errors" />

        <div class="flex justify-center text-3xl">以下のスケジュールで予約しました</div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <article class="mb-4">
                    <div class='container mx-auto'>
                        <div class="flex justify-center">
                            <div><img src="{{ $reservation->mentor->profile_photo_url }}" alt=""
                                    class="h-20 w-20 rounded-full object-cover mr-3"></div>
                        </div>
                        <div class="flex justify-center">
                            <h2 class="font-bold font-sans break-normal text-gray-900 pt-6 pb-1 text-3xl md:text-4xl">
                                {{ $reservation->mentor->name }}</h2>
                            <div
                                class="flex justify-center text-xl bg-gradient-to-r text-gray-900 mt-4 px-5 py-3 rounded tracking-wide font-semibold mx-2">
                                {{ $reservation->start_time->format('Y-m-d') }}
                            </div>
                            <div
                                class="flex justify-center text-xl bg-gradient-to-r text-gray-900 mt-4 px-5 py-3 rounded tracking-wide font-semibold mx-2">
                                {{ $reservation->start_time->format('H:i') }}
                            </div>
                        </div>
                        <div class="flex justify-center">
                            <a href="{{ route('users.mentors.messages.index', [$user, $reservation->mentor]) }}"
                                class="w-full sm:w-40 bg-gradient-to-r from-indigo-500 to-blue-600 hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 p-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500 w-full sm:w-32">
                                メッセージ
                            </a>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</x-app-layout>
