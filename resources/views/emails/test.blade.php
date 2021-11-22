<p>テストメールの送信です。</p>
@foreach ($variable as $var)
    <p>email: {{ $var['email'] }}</p>
    <p>name: {{ $var['name'] }}</p>
@endforeach
