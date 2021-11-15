<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <ul>
                    <li><a class="hover:text-blue-500 text-green-500 font-bold" href="/user/login">ユーザログイン</a></li>
                    <li><a class="hover:text-blue-500 text-green-500 font-bold" href="/user/register">ユーザサインアップ</a></li>
                    <li><a class="hover:text-blue-500 text-green-500 font-bold" href="/user/profile">ユーザプロフィール</a></li>
                    <li><a class="hover:text-blue-500 text-green-500 font-bold" href="/mentor_schedules">メンタースケジュール</a>
                    </li>
                    <li><a class="hover:text-blue-500 text-green-500 font-bold"
                            href="/mentor_schedules/1/reservations/create">メンター予約</a></li>
                    <li><a class="hover:text-blue-500 text-green-500 font-bold"
                            href="/mentor_schedules/1/reservations/1">メンター予約完了</a></li>
                    <li><a class="hover:text-blue-500 text-green-500 font-bold" href="/mentors/1">メンター詳細</a></li>
                    <li><a class="hover:text-blue-500 text-green-500 font-bold"
                            href="/users/1/mentors/1/message">メッセージ</a></li>
                </ul>
            </div>
        </div>
        <h1>メンターを条件で検索</h1>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div>
                    <select name="" id="">
                        <option value="">PHP</option>
                        <option value="">Laravel</option>
                        <option value="">Python</option>
                        <option value="">Ruby</option>
                        <option value="">Swift</option>
                        <option value="">Java</option>
                        <option value="">Spring</option>
                        <option value="">Go</option>
                        <option value="">React</option>
                        <option value="">HTML/CSS</option>
                        <option value="">AWS</option>
                        <option value="">JavaScript</option>
                        <label for="">開始時間</label>
                    </select>
                </div>
                <p>開始時間</p>
                <select name="" id="">
                    <option value="all">すべて</option>
                    <option value="30">5:30</option>
                    <option value="600">6:00</option>
                    <option value="630">5:30</option>
                    <option value="700">7:00</option>
                    <option value="730">7:30</option>
                    <option value="800">8:00</option>
                    <option value="830">8:30</option>
                    <option value="900">9:00</option>
                    <option value="930">9:30</option>
                    <option value="1000">10:00</option>
                    <option value="1030">10:30</option>
                    <option value="1100">11:00</option>
                    <option value="1130">11:30</option>
                    <option value="1200">12:00</option>
                    <option value="1230">12:30</option>
                    <option value="1300">13:00</option>
                    <option value="1330">13:30</option>
                    <option value="1400">14:00</option>
                    <option value="1430">14:30</option>
                    <option value="1500">15:00</option>
                    <option value="1530">15:30</option>
                    <option value="1600">16:00</option>
                    <option value="1630">16:30</option>
                    <option value="1700">17:00</option>
                    <option value="1730">17:30</option>
                    <option value="1800">18:00</option>
                    <option value="1830">18:30</option>
                    <option value="1900">19:00</option>
                    <option value="1930">19:30</option>
                    <option value="2000">20:00</option>
                    <option value="2030">20:30</option>
                    <option value="2100">21:00</option>
                    <option value="2130">21:30</option>
                    <option value="2200">22:00</option>
                    <option value="2230">22:30</option>
                    <option value="2300">23:00</option>
                    <option value="2330">23:30</option>
                    <option value="2400">24:00</option>
                </select>
                <span>〜</span>
                <select name="" id="">
                    <option value="all">すべて</option>
                    <option value="30">5:30</option>
                    <option value="600">6:00</option>
                    <option value="630">5:30</option>
                    <option value="700">7:00</option>
                    <option value="730">7:30</option>
                    <option value="800">8:00</option>
                    <option value="830">8:30</option>
                    <option value="900">9:00</option>
                    <option value="930">9:30</option>
                    <option value="1000">10:00</option>
                    <option value="1030">10:30</option>
                    <option value="1100">11:00</option>
                    <option value="1130">11:30</option>
                    <option value="1200">12:00</option>
                    <option value="1230">12:30</option>
                    <option value="1300">13:00</option>
                    <option value="1330">13:30</option>
                    <option value="1400">14:00</option>
                    <option value="1430">14:30</option>
                    <option value="1500">15:00</option>
                    <option value="1530">15:30</option>
                    <option value="1600">16:00</option>
                    <option value="1630">16:30</option>
                    <option value="1700">17:00</option>
                    <option value="1730">17:30</option>
                    <option value="1800">18:00</option>
                    <option value="1830">18:30</option>
                    <option value="1900">19:00</option>
                    <option value="1930">19:30</option>
                    <option value="2000">20:00</option>
                    <option value="2030">20:30</option>
                    <option value="2100">21:00</option>
                    <option value="2130">21:30</option>
                    <option value="2200">22:00</option>
                    <option value="2230">22:30</option>
                    <option value="2300">23:00</option>
                    <option value="2330">23:30</option>
                    <option value="2400">24:00</option>
                </select>
                <button type="submit">ブックマーク</button>
                <button type="submit" class="btn btn-primary ">検索</button>
            </div>
        </div>
    </div>

    {{-- @foreach ($mentors as $mentor)
        <div class="bg-white w-full px-10 py-8 hover:shadow-2xl transition duration-500">
                <div class="mt-4">
                    <div class="flex justify-between text-sm items-center mb-4">
                        <div class="border border-gray-900 px-2 h-7 leading-7 rounded-full">{{ $mentor->MentorSkill->name }}</div>
                        </div>
    @endforeach --}}


    {{-- <div class="container mx-auto w-3/5 my-8 px-4 py-4">
        @foreach ($mentors as $m)
            <div class="bg-white w-full px-10 py-8 hover:shadow-2xl transition duration-500">
                <div class="mt-4">
                    <div class="flex justify-between text-sm items-center mb-4">
                        <div class="border border-gray-900 px-2 h-7 leading-7 rounded-full">{{ $m->occupation->name }}</div>
                        </div>
                    <h2 class="text-lg text-gray-700 font-semibold">{{ $m->title }}
                    </h2>
                    <p class="mt-4 text-md text-gray-600">
                        {{ Str::limit($m->description, 50) }}
                    </p>
                    <div class="flex justify-end items-center">
                        <a href="{{ route('mentors.show', $m) }}" class="flex justify-center bg-gradient-to-r from-indigo-500 to-blue-600 hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 mt-4 px-5 py-3 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500">more</a>
                    </div>
                </div>
            </div>
            <hr>
        @endforeach --}}
    </div>
</x-app-layout>
