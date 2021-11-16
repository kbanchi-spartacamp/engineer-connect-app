<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <ul class="flex">
                    <li class="ml-10">
                        @foreach ($dates as $date)
                            <a href="" class="text-3xl hover:text-blue-500">{{ $date }}</a>
                        @endforeach
                    </li>
                </ul>
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="flex bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="m-4">
                            <select name="skillCategory_id">
                                @foreach ($skillCategories as $skillCategory)
                                    <option value="{{ $skillCategory->id }}">{{ $skillCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="m-4">
                            <select name="" id="">
                                @foreach ($times as $time)
                                    <option value="{{ $time }}" @if ($loop->index == 0) selected @endif>{{ $time }}
                                    </option>
                                @endforeach
                            </select>
                            <span>〜</span>
                            <select name="" id="">
                                @foreach ($times as $time)
                                    <option value="{{ $time }}" @if ($loop->index == count($times) - 1) selected @endif>{{ $time }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="m-4">
                            <input type="submit" value="ブックマーク"
                                class="w-full sm:w-40 bg-gradient-to-r from-indigo-500 to-blue-600 hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 p-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500 w-full sm:w-32">
                        </div>
                        <div class="m-4">
                            <input type="submit" value="検索"
                                class="w-full sm:w-40 bg-gradient-to-r from-indigo-500 to-blue-600 hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 p-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500 w-full sm:w-32">
                        </div>
                    </div>
                </div>
                {{-- メンター一覧 --}}
                <div>
                    <div class="w-full">
                        <div class="bg-white w-full px-10 py-8 hover:shadow-2xl transition duration-500">
                            <div class="mt-4">
                                <div class="flex justify-between text-sm items-center mb-4">
                                    <div class="text-gray-700">
                                        <div>年齢:20代</div>
                                        <div>講師歴:3年</div>
                                    </div>
                                    <div class="border border-gray-900 px-2 h-7 leading-7 rounded-full text-right">
                                        ★★★☆☆</div>
                                </div>
                                <h2 class="text-lg text-gray-700 font-semibold">Kawata</h2>
                                <div class="flex justify-between items-center">
                                    <div class="mt-4 flex items-center space-x-4 py-6">
                                        <div>
                                            <img class="rounded-full object-cover" src="" alt="" />
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <a href=""
                                            class="flex justify-center bg-gradient-to-r from-indigo-500 to-blue-600 hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 mt-4 px-5 py-3 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500 mx-2">18:00</a>
                                        <a href=""
                                            class="flex justify-center bg-gradient-to-r from-indigo-500 to-blue-600 hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 mt-4 px-5 py-3 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500 mx-2">18:30</a>
                                        <a href=""
                                            class="flex justify-center bg-gradient-to-r from-indigo-500 to-blue-600 hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 mt-4 px-5 py-3 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500 mx-2">19:00</a>
                                        <a href=""
                                            class="flex justify-center bg-gradient-to-r from-indigo-500 to-blue-600 hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 mt-4 px-5 py-3 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500 mx-2">19:30</a>
                                        <a href=""
                                            class="flex justify-center bg-gradient-to-r from-indigo-500 to-blue-600 hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 mt-4 px-5 py-3 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500 mx-2">20:00</a>
                                        <a href=""
                                            class="flex justify-center bg-gradient-to-r from-indigo-500 to-blue-600 hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 mt-4 px-5 py-3 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500 mx-2">20:30</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
