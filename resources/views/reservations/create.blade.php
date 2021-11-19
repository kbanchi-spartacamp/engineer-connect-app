<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                mentors.show
                <article class="mb-4">
                    <div class='container mx-auto'>
                        <div class="flex item-center">
                            <div><img src="{{ $mentorSchedule->mentor->profile_photo_url }}" alt=""
                                    class="h-55 w-55 rounded-full object-cover mr-3"></div>
                        </div>
                        <div class="flex">
                            <h2 class="font-bold font-sans break-normal text-gray-900 pt-6 pb-1 text-3xl md:text-4xl">
                                {{ $mentorSchedule->mentor->name }}</h2>
                            <div>
                                <div
                                    class="flex justify-center bg-gradient-to-r from-indigo-500 to-blue-600 hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 mt-4 px-5 py-3 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500 mx-2">
                                    {{ $mentorSchedule->start_time }}
                                </div>
                            </div>
                            <div class="flex">
                                <div class="m-4">
                                    <form action="{{ route('reservations.store', $user) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="mentor_id" value="{{ $mentorSchedule->mentor_id }}">
                                        <input type="hidden" name="day" value="{{ $day }}">
                                        <input type="hidden" name="start_time" value="{{ $mentorSchedule->start_time }}">
                                        <input type="submit" value="予約"
                                            class="w-full sm:w-40 bg-gradient-to-r from-indigo-500 to-blue-600 hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 p-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500 w-full sm:w-32">
                                    </form>
                                </div>
                            </div>
                            <div class="m-4">
                                <input type="submit" value="戻る"
                                    class="w-full sm:w-40 bg-gradient-to-r from-indigo-500 to-blue-600 hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 p-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500 w-full sm:w-32">
                            </div>
                        </div>
                    </div>
                    {{-- <div class="flex mt-1 mb-3">
                        <h3 class="text-lg h-10 leading-10">対応スキル:{{ $skillCategory->name }}</h3>
                    </div> --}}

                    {{-- 空き状況 --}}
                </article>
            </div>
        </div>
    </div>
</x-app-layout>
