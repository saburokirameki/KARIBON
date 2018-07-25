@extends('layouts.app')

@section('content')
<a class="toppage" href="/">Top Pageに戻る</a>
    <h1 class="kariru-search">{{ $user->name }}さんに通知が送られました。</h1>
    <br/>
    <h1 class="text-center">今後の流れ</h1>
    <article class="comic">
  <div class="panel">
    <p class="text top-left">Step 1</p>
    <h2>{{ $user->home }}まで<br/>歩く</h2>
    <div class="hero4" >
    <img src="/images/hero4.png" alt="hero">
    </div>
  </div>
  <div class="panel">
    <p class="text bottom-right">Step 2</p>
    <h2>Say "Hello!"<br/>to {{ $user->name }}</h2>
    <div class="hero1" >
    <img src="/images/hero1.png" alt="hero">
    </div>
  </div>
  <div class="panel">
    <p class="speech">Step 3</p>
    <h2>返却期限を決める<br/>(Max 2 weeks)</h2>
    <div class="hero3" >
    <img src="/images/hero3.png" alt="hero">
    </div>
  </div>
  <div class="panel">
    <p class="text top-left">Step 4</p>
    <h2>本を大切に扱い、<br/>期限内に返す</h2>
    <div class="hero2" >
    <img src="/images/hero2.png" alt="hero">
    </div>
  </div>
  <div class="panel">
    <p class="speech-right">Step 5</p>
    <h2>Say<br/>"Thank you:)"<br/>to {{ $user->name }}</h2>
    <div class="hero6" >
    <img src="/images/hero6.png" alt="hero">
    </div>
  </div>
  <div class="panel">
    <p class="text top-right">Step 6</p>
    <h2>KARIBONで<br/>しよう</h2>
    <div class="hero5" >
    <img src="/images/hero5.png" alt="hero">
    </div>
  </div>
  <div class="panel">
    <h2>借りに行こう！Good Luck!</h2>
    <p class="text top-right">THE END</p>
    <div class="hero-all" >
    <img src="/images/hero-all.png" alt="hero">
    </div>
    <div class="hero-all2" >
    <img src="/images/hero-all2.png" alt="hero">
    </div>
  </div>
</article>
                        
@endsection