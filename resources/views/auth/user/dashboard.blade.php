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
    </div>
</x-app-layout>
