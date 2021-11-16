<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center mb-6">
                <h2>スキル設定画面</h2>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex justify-center mt-1 mb-3">
                    <img src="{{ $user->profile_photo_url }}" class="h-10 w-10 rounded-full object-cover mr-3">
                </div>
                <div class="flex justify-center ">
                    <table class="table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">SkillName</th>
                                <th class="px-4 py-2">Year</th>
                                <th class="px-4 py-2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->mentor_skills as $mentor_skill)
                                <tr>
                                    <td class="border px-4 py-2">{{ $mentor_skill->skill_category->name }}</td>
                                    <td class="border px-4 py-2">{{ $mentor_skill->experience_year }}</td>
                                    <td class="border px-4 py-2">
                                        <form
                                            action="{{ route('mentors.mentor_skills.destroy', [$user, $mentor_skill]) }}"
                                            method="post" class="w-full sm:w-32">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" value="削除"
                                                onclick="if(!confirm('削除しますか？')){return false};">
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
                        <div class="mb-4">
                            <label>
                                対応スキル
                            </label>
                            <select name="skill_category_id">
                                <option disabled selected value="">選択してください</option>
                                @foreach ($skill_categories as $skill_category)
                                    <option value="{{ $skill_category->id }}" @if ($skill_category->id == old('skill_category'))
                                        selected
                                @endif>{{ $skill_category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label>
                                対応年数
                            </label>
                            <input type="text" name="experience_year" required placeholder="対応年数"
                                value="{{ old('experience_year') }}">
                        </div>
                </div>

                <div class="flex justify-center">
                    <a href="" class="mr-4">戻る</a>
                    <input type="submit" value="更新">
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
