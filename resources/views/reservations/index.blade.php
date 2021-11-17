<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center mb-6">
                <h2>予約一覧画面</h2>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div>
                    @foreach($reservations as $reservation)
                    <div>
                        <img src= "{{ $reservation->user->profile_photo_url}}">
                    </div>
                    
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
