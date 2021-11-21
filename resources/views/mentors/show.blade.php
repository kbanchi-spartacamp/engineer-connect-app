<x-app-layout>
    <div class="py-12">

        <x-flash-message :message="session('notice')" />
        <x-validation-errors :errors="$errors" />

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <article class="mb-4">
                    <div class="container mx-auto">
                        <div class="flex justify-center">
                            <div><img src="{{ $mentor->profile_photo_url }}" alt=""
                                    class="h-20 w-20 rounded-full object-cover mr-3"></div>
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
                        <div class="m-4 content">
                            <form action="{{ route('payment') }}" method="post">
                                {{ csrf_field() }}
                                <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="{{ env('STRIPE_KEY') }}"
                                                                data-amount="500" data-name="Stripe Demo" data-label="決済をする"
                                                                data-description="Online course about integrating Stripe"
                                                                data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                                                data-locale="auto" data-currency="JPY">
                                </script>
                            </form>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-end">
                            <div class="m-4">
                                @if (strpos(url()->full(), 'bookmark=' . 'true'))
                                    <a href="/mentor_schedules?{{ http_build_query(array_merge($searchParam, ['bookmark' => 'false'])) }}"
                                        class="text-3xl text-green-500 hover:text-blue-500">ブックマーク</a>
                                @else
                                    <a href="/mentor_schedules?{{ http_build_query(array_merge($searchParam, ['bookmark' => 'true'])) }}"
                                        class="text-2xl hover:text-blue-500">ブックマーク</a>
                                @endif
                            </div>
                        </div>
                        <div class="m-4">
                            <div>
                                <h2 class="text-2xl">対応スキル</h2>
                                @foreach ($mentor->mentor_skills as $mentor_skill)
                                    <p class="flex text-gray-1000">{{ $mentor_skill->skill_category->name }}</p>
                                @endforeach
                            </div>
                            <div>
                                <h2 class="text-2xl">自己紹介</h2>
                                <p class="text-gray-1000 text-base">{!! nl2br(e($mentor->profile)) !!}</p>
                            </div>
                            <div class="shadow-xl sm:rounded-lg">
                                <div>
                                    <h2 class="text-2xl">空き状況</h2>
                                </div>
                                <table>
                                    <tr>
                                        @foreach ($dates as $date)
                                            <th>
                                                <a href="" class="text-2xl hover:text-blue-500">{{ $date }}</a>
                                            </th>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>
                                            @foreach ($mentor->mentor_schedules as $mentor_schedule)
                                                <a href="/reservations/create?mentor_schedule_id={{ $mentor_schedule->id }}&day={{ $searchParam['day'] }}"
                                                    class="flex justify-center bg-gradient-to-r from-indigo-500 to-blue-600 hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 mt-2 px-4 py-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500">{{ $mentor_schedule->start_time->format('H:i') }}</a>
                                            @endforeach
                                        </td>
                                    </tr>
                                </table>
                                <div>
                                </div>
                                <div class="flex justify-between items-center">
                                    <div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </article>
            </div>
            <div class="m-4">
                <input type="submit" value="戻る"
                    class="bg-black text-white font-bold py-2 px-10 rounded shadow-xl hover:bg-gray-dark hover:text-white">
            </div>
        </div>
    </div>
</x-app-layout>
