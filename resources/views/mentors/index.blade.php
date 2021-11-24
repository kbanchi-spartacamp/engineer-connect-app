<x-mentor-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center mb-6">
                <h2>メンター・一覧画面</h2>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @foreach ($mentors as $mentor)
                <div class="container flex justify-center mx-auto my-8">
                    <img src="{{ $mentor->profile_photo_url }}" class="rounded-full mr-4 ml-10 w-12 h-12">
                    <label class="flex justify-center items-center text-center w-1/4 text-2xl  ">
                        {{ $mentor->name }}
                    </label>
                </div>
                <div class="container flex justify-center mx-auto my-4">
                    <h2 class="text-2xl">対応スキル</h2>
                    @foreach ($mentor->mentor_skills as $mentor_skill)
                    <p class="text-center text-gray-1000 mx-2 mt-1">{{ $mentor_skill->skill_category->name }}</p>
                    @endforeach
                    <a href="{{ route('mentors.messages.index', [$mentor]) }}"
                        class="ml-6 justify-content-aroundflex justify-center items-center text-center bg-green-400 hover:bg-green-500 text-white font-bold py-2 px-4 rounded">
                        メッセージ
                    </a>
                </div>
                <div class="container flex justify-center mx-auto mb-4">
                    <h2 class="text-2xl">自己紹介</h2>
                </div>
                <div class="container flex justify-center mx-auto my-4">
                    <p class="text-gray-1000 text-base text-center w-2/3">{!! nl2br(e($mentor->profile)) !!}</p>
                </div>
                <hr class="boild">
                @endforeach
            </div>
        </div>
    </div>
</x-mentor-layout>
