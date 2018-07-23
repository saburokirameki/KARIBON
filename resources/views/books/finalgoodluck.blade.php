@extends('layouts.app')

@section('content')

    <h1>{{ $user->name }}さんに通知が送られました。</h1>
   
    <h2>今後の流れ</h2>
    <article class="comic">
  <div class="panel">
    <p class="text top-left">Step 1</p>
    <h2>{{ $user->home }}まで歩く</h2>
  </div>
  <div class="panel">
    <p class="text bottom-right">Step 2</p>
    <h2>Say "Hello!" to {{ $user->name }}</h2>
  </div>
  <div class="panel">
    <p class="speech">Step 3</p>
    <h2>返却期限を決める(Max 2 weeks)</h2>
  </div>
  <div class="panel">
    <p class="text top-left">Step 4</p>
    <h2>本を大切に扱い、期限内に返す</h2>
  </div>
  <div class="panel">
    <p class="text bottom-right">Step 5</p>
    <h2>Say "Thank you:)" to {{ $user->name }}</h2>
  </div>
  <div class="panel">
    <p class="speech">Step 6</p>
    <h2>Karibonで本の感想を共有しよう</h2>
  </div>
  <div class="panel">
    <h2>借りに行こう！Good Luck!</h2>
    <p class="text bottom-right">THE END</p>
  </div>
</article>
                        
@endsection

