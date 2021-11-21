<x-app-layout>
    <div class="py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center mb-6">
                <h2>スキル設定画面</h2>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg pt-3">
                <div class="flex justify-center mt-1 mb-3">
                    <img src="{{ $user->profile_photo_url }}" class="rounded-full object-cover w-1/7">
                </div>
                <div class="flex justify-center">
                    <table class="table-fixed w-5/6 mb-7">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 w-1/6 text-left">SkillName</th>
                                <th class="px-4 py-2 text-left">Year</th>
                                <th class="px-4 py-2 w-1/6"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->mentor_skills as $mentor_skill)
                            <tr class="border">
                                <td class="px-4 py-2 ">{{ $mentor_skill->skill_category->name }}</td>
                                <td class="px-4 py-2">{{ $mentor_skill->experience_year }}年</td>
                                <td class="px-4 py-2 text-center w-full">
                                    <form action="{{ route('mentors.mentor_skills.destroy', [$user, $mentor_skill]) }}"
                                        method="post" class="w-full  ">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="削除" onclick="if(!confirm('削除しますか？')){return false};"
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-center">
                    <form action="{{ route('mentors.mentor_skills.store', $user) }}" method="POST"
                        class="rounded pt-3 pb-8 ">
                        @csrf
                        <div class="mb-10">
                            <label class="mr-3 w-3/10">
                                対応スキル
                            </label>
                            <select name="skill_category_id" class="rounded ml-4 w-6/10">
                                <option disabled selected value="">選択してください</option>
                                @foreach ($unregistered_skill_categories as $skill_category)
                                <option value="{{ $skill_category->id }}" @if ($skill_category->id ==
                                    old('skill_category'))
                                    selected
                                    @endif>{{ $skill_category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="mr-3 w-3/10">
                                対応年数
                            </label>
                            <input type="text" name="experience_year" required placeholder="対応年数"
                                value="{{ old('experience_year') }}" class="rounded w-6/10 ml-3">
                        </div>
                </div>
                <div class="flex justify-center mb-5">
                    <a href=""
                        class="mr-2 bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                        戻る
                    </a>
                    <input type="submit" value="更新"
                        class="bg-green-400 hover:bg-green-500 text-white font-bold py-2 px-4 rounded ml-2">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
