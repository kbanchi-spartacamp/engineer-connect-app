<x-mentor-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center mb-6">
                <h2>メンター検索</h2>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{ route('mentors.index') }}" method="get">
                    <div class="shadow flex">
                        <input name="keyword" class="w-full rounded-full  py-2 px-4" type="text" placeholder="Search..."
                            value="{{ old('keyword', $keyword) }}">
                        <button type="submit"
                            class="bg-white w-auto flex justify-end items-center text-green-400 p-2 hover:text-green-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </form>
                @foreach ($mentors as $mentor)
                <div class="container flex justify-center mx-auto my-8">
                    <img src="{{ $mentor->profile_photo_url }}" class="rounded-full mr-4 ml-10 w-12 h-12">
                    <label class="flex justify-center items-center text-center w-1/4 text-2xl  ">
                        {{ $mentor->name }}
                    </label>
                    <a href="{{ route('mentors.messages.index', [$mentor]) }}"
                        class="justify-content-aroundflex flex justify-center items-center  text-center bg-green-400 hover:bg-green-500 text-white font-bold py-2 px-4 rounded">
                        メッセージ
                    </a>
                </div>
                <div class="flex justify-center  my-4">
                    <table class="table-auto w-5/6 mb-5">
                        <thead>
                            <tr>
                                <th class="text-2xl border">
                                    対応スキル
                                </th>
                                @foreach ($mentor->mentor_skills as $mentor_skill)
                                <th class="text-center text-gray-1000 mx-2 mt-1 border">
                                    {{ $mentor_skill->skill_category->name }}
                                </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-2xl font-semibold text-center border ">
                                    経験年数
                                </td>
                                @foreach ($mentor->mentor_skills as $mentor_skill)
                                <td class="text-center text-gray-1000 mx-2 mt-1 border">
                                    {{ $mentor_skill->experience_year}}年
                                </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="container flex justify-center mx-auto mb-4">
                    <h2 class="text-2xl">自己紹介</h2>
                </div>
                <div class="container flex justify-center mx-auto my-4">
                    <p class="text-gray-1000 text-base text-center w-2/3">{!! nl2br(e($mentor->profile)) !!}</p>
                </div>
                {{-- <div class="flex justify-center mb-5"> --}}
                    </a>
                {{-- </div> --}}
                <hr class="boild">
                @endforeach
            </div>
        </div>
    </div>
</x-mentor-layout>
