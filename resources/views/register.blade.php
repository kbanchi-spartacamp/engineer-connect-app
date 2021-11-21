<x-guest-layout>
    <div class="relative min-h-screen flex ">
        <div
            class="flex flex-col sm:flex-row items-center md:items-start sm:justify-center md:justify-start flex-auto min-w-0 bg-white">
            <div class="h-full flex flex-auto bg-purple-900 text-gray bg-no-repeat bg-cover relative bg-image">
                <div
                    class="w-4/5 flex flex-auto flex-col md:flex-row items-center justify-center p-10 xl:p-32 overflow-hidden">
                    <div
                        class="md:flex md:items-center md:justify-center w-full sm:w-auto md:h-full w-2/5 xl:w-2/5 p-8 md:p-10 lg:p-14 sm:rounded-lg md:rounded-none relative z-11">
                        <div class="max-w-md w-full space-y-8">
                            <div class="text-center text-white">
                                <h3 class="mt-6 text-2xl font-bold mb-6">
                                    利用者の方はこちら
                                </h3>
                                <div>
                                    <a href="{{ route('user.register') }}"
                                        class="w-full flex justify-center bg-gradient-to-r from-yellow-400 to-yellow-600 hover:bg-gradient-to-l hover:from-yellow-600 hover:to-yellow-400 text-gray-100 p-4 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500">アカウント登録</a>
                                </div>
                            </div>
                            <div class="flex items-center justify-center space-x-2">
                                <span class="h-px w-full bg-gray-200"></span>
                            </div>
                            <div class="text-center text-white">
                                <h3 class="mt-6 text-2xl font-bold mb-6">
                                    メンター希望の方はこちら
                                </h3>
                                <div>
                                    <a href="{{ route('mentor.register') }}"
                                        class="w-full flex justify-center bg-gradient-to-r from-green-400 to-green-600 hover:bg-gradient-to-l hover:from-green-600 hover:to-green-400 text-gray-100 p-4 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500">アカウント登録</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
