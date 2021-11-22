<h2>新しい相談の予約が入りました。</h2>
<p>相談者 : {{ $variable->user->name }}</p>
<p>メンター : {{ $variable->mentor->name }}</p>
<p>日付 : {{ $variable->day->format('Y-m-d') }}</p>
<p>開始時間 : {{ $variable->start_time->format('H:i') }}</p>
<p>概要 : {{ $variable->description }}</p>
