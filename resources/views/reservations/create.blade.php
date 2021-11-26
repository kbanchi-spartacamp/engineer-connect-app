<x-app-layout>
    <div class="py-12">

        <x-flash-message :message="session('notice')" />
        <x-validation-errors :errors="$errors" />

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center mb-6">
                <h2>予約</h2>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <article class="mb-4">
                    <div class='container mx-auto'>
                        <div class="flex justify-center">
                            <img src="{{ $mentorSchedule->mentor->profile_photo_url }}" alt=""
                                class="h-20 w-20 rounded-full object-cover mr-3">
                        </div>
                        <div class="flex justify-center">
                            <h2 class="font-bold font-sans break-normal text-gray-900 pt-6 pb-1 text-3xl md:text-4xl">
                                {{ $mentorSchedule->mentor->name }} さん</h2>
                        </div>
                        <div
                            class="flex justify-center flex-wrap content-center text-xl bg-gradient-to-r text-gray-900 mt-4 px-5 py-3 rounded tracking-wide font-semibold mx-2">
                            {{ $mentorSchedule->start_time->formatLocalized('%Y/%m/%d(%a) %H:%M') }} 〜
                        </div>
                        <div class="m-4">
                            <form action="{{ route('reservations.store', $user) }}" method="POST">
                                @csrf
                                <div class="flex justify-center">
                                    <textarea rows="10" cols="60" name="description" placeholder="ざっくりと相談内容を記載してください。
例) PHPについて教えてください"></textarea>
                                </div>
                                <div class="flex justify-center mt-4">
                                    <div class="m-4">
                                        <button type="button" onclick="location.href='/mentor_schedules'"
                                            class="w-full sm:w-40 bg-gradient-to-r from-gray-300 to-gray-500 hover:bg-gradient-to-l hover:from-gray-500 hover:to-gray-200 text-gray-100 p-2 rounded-full tracking-wide font-semibold  cursor-pointer transition ease-in duration-500">
                                            戻る
                                        </button>
                                    </div>
                                    <input type="hidden" name="mentor_id" value="{{ $mentorSchedule->mentor_id }}">
                                    <input type="hidden" name="day" value="{{ $day }}">
                                    <input type="hidden" name="start_time" value="{{ $mentorSchedule->start_time }}">
                                    <input type="submit" value="予約"
                                        class="w-full sm:w-40 bg-gradient-to-r from-yellow-300 to-yellow-500 hover:bg-gradient-to-l hover:from-yellow-500 hover:to-yellow-200 text-gray-100 p-2 rounded-full tracking-wide font-semibold  cursor-pointer transition ease-in duration-500">
                            </form>
                        </div>
                </article>
            </div>
</x-app-layout>
