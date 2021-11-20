<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                mentors.show
                <article class="mb-4">
                    <div class='container mx-auto'>
                        <div class="flex justify-center">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <div><img src="{{ $mentor->profile_photo_url }}" alt=""
                                        class="h-55 w-55 rounded-full object-cover mr-3"></div>
                            @endif
                        </div>
                        <div class="flex justify-center">
                            <h2 class="font-bold font-sans break-normal text-gray-900 pt-6 pb-1 text-3xl md:text-4xl">
                                {{ $mentor->name }}</h2>
                            </div>
                            <div class="flex justify-end border-gray-900 px-2 h-7 leading-7 m-6 rounded-full text-right">
                                評価:★★★☆☆</div>
                        </div>
                        <div class="flex justify-end">
                            <div class="m-4">
                                <input type="submit" value="お気に入り"
                                    class="w-full sm:w-40 bg-gradient-to-r from-indigo-500 to-blue-600 hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 p-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500 w-full sm:w-32">
                            </div>
                    </div>
                    <p class="text-gray-1000 text-base">自己紹介:{!! nl2br(e($mentor->plofile)) !!}</p>
                    
                    <div>
                        @foreach ($dates as $date)
                            <a href="" class="text-3xl hover:text-blue-500">{{ $date }}</a>
                        @endforeach
                        @foreach ($times as $time)
                            <option value="{{ $time }}" @if ($loop->index == 0) selected @endif>{{ $time }}
                            </option>
                        @endforeach
                    </div>
                </article>
            </div>
        </div>
    </div>
</x-app-layout>
