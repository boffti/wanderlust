{{-- Author: Melkot, Aaneesh Naagaraj
ID : 1001750503 --}}
@extends('layouts.app')

@section('title', 'Wanderlust | Home')

@section('content')
    <!-- hero -->
    <section class="hero flex">
        <div class="container">
            <div class="hero-text flex-vertical">
                <div id="typed">
                    <p>Welcome to your new home</p>
                    <p>Willkommen in Ihrem neuen Zuhause</p>
                    <p>Bienvenido a tu nuevo hogar</p>
                    <p>आपके नए घर में आपका स्वागत है</p>
                    <p>欢迎来到你的新家</p>
                    <p>Bienvenue dans votre nouvelle maison</p>
                    <p>새 집에 오신 것을 환영합니다</p>
                    <p>നിങ്ങളുടെ പുതിയ വീട്ടിലേക്ക് സ്വാഗതം</p>
                    <p>ನಿಮ್ಮ ಹೊಸ ಮನೆಗೆ ಸುಸ್ವಾಗತ</p>
                    <p>உங்கள் புதிய வீட்டிற்கு வருக</p>
                    <p>Laipni lūdzam jūsu jaunajās mājās</p>
                </div>
                <h1 id="welcome-string"></h1><span style="visibility:hidden;">|</span>
            </div>
            <p class="flex-vertical">Find nearby attractions. Connect with people. Contribute to your neighborhood.</p>
            <div class="">
                <form class="hero-form card" action="/search" method="post" style="overflow: hidden;">
                    @csrf
                    <div class="flex-left flex-wrap" style="justify-content: space-between;">
                        <div class="form-control">
                            <input type="text" name="search_term" id="search_term"
                                placeholder="Keywords eg: food, salons, shopping etc">
                        </div>
                        <div class="form-control"> <select name="categories" id="categories">

                            </select></div>
                        <button id="btnSearchNow" type="submit" href="#" class="btn">SEARCH
                            NOW</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="content">

            <!-- Explore Nearby -->
            <section>
                <h2>Explore nearby</h2>
                <div class="flex" style="gap:12px">
                    @if(isset($businesses))
                        @foreach($businesses as $biz)
                            <div class="browse-card">
                                <div class="card-header">
                                    <img class="card-img"
                                        src="{{ $biz['photo_uri'] }}"
                                        alt="">
                                </div>
                                <div class="card-body">
                                    <h1><a href="business/{{ $biz['business_id'] }}">{{ $biz['business_name'] }}</a></h1>
                                    <p>{{ $biz['city']['city_name'] }}</p>
                                    <div class="rating">
                                        <ul>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                        </div>
                <div class="" style="margin-top: 10px;">
                    <a href="#">See more</a>
                </div>
            </section>

            <br>

            <!-- Bulletin Board -->
            <section>
                <h2>Bulletin Board</h2>
                <!-- ! IF User.role != visitor -->
                <form action="/post" method="post">
                    @csrf
                    <div class="flex-left">
                        <textarea placeholder="What's on your mind? Type here..." name="post" id="bulletin_post"
                            cols="30" rows="3" style="width: 100%; padding:12px; margin: 12px" class="card"></textarea>
                        <div class="card">
                            <p>See the latest buzz around you. Create your own buzz.</p>
                        </div>
                    </div>
                    <button type="submit" class="btn" style="margin:0 12px;">POST</button>
                </form>
                <!-- ! ENDIF -->
                <div class="posts">
                    @if(isset($posts))
                        @foreach($posts as $post)
                            <div class="card post">
                                <div class="flex-left">
                                    <img class="postIMG" src="{{ URL::asset("upload/user_dp/") }}/{{ $post['user']['dp'] }}" alt="">
                                    <div class="full-width">
                                        <div class="flex-left space-between align-items-center">
                                            <a href="/user/{{ $post['user']['user_id'] }}">
                                                <h4 class="">{{ $post['user']['full_name'] }}</h4>
                                            </a>
                                            <p class="post-date">{{ $post['created_at'] }}</p>
                                        </div>
                                        <p class="post-content">{{ $post['post_content'] }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <a href="/more-posts" style="margin-left: 12px;">See all</a>
            </section>

            <br>
            <!-- Tips -->
            <section>
                <h2>Word to the Wise</h2>
                <div class="tips">
                    @if(isset($tips))
                        @foreach($tips as $tip)
                            <div class="card border-l-yellow">
                                <div class="flex flex-column align-items-left">
                                    <div>
                                        <span class="quotes">"</span><strong>
                                            {{ $tip['tip_content'] }}
                                        </strong><span class="quotes">"</span>
                                    </div>
                                    <div class="flex ml-auto tip-footer" style="gap: 10px; ">
                                        <a class="tip-author" href="/user/{{ $tip['user']['user_id'] }}" style="margin: 0;">{{ $tip['user']['full_name'] }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="flex" style="justify-content: space-between; padding: 0 15px">
                    <a href="/more-tips" class="">See more tips</a>
                    @if(null !== session('user_roles'))
                    @if(in_array('1', session('user_roles')))
                    <a href="/more-tips" class="strong">+ ADD TIP</a>
                    @endif
                    @endif
                </div>
            </section>

            <br>

            <section>
                <h2>Moments around you</h2>
                <div class="gallery">
                    @if(isset($photos))
                    @foreach($photos as $photo)
                    <div class="gallery-item">
                        <img class="gallery-image" src="{{ URL::asset('upload/user_photos/') }}/{{ $photo['photo_uri'] }}">
                    </div>
                    @endforeach
                @endif

                </div>
            </section>

            <br>

            <!-- Categories -->
            <section class="">
                <h2>Browse by Category</h2>
                <div class="flex" style="gap: 12px;">
                    <div class="category-card">
                        <a href="./pages/user/search_page.html" class="card-link"></a>
                        <i class="fas fa-hamburger fa-5x"></i>
                        <div class="content">
                            <h2>Restaurant</h2>
                        </div>
                    </div>
                    <div class="category-card">
                        <a href="./pages/user/search_page.html" class="card-link"></a>
                        <i class="fas fa-shopping-cart fa-5x"></i>
                        <div class="content">
                            <h2>Shopping</h2>
                        </div>
                    </div>
                    <div class="category-card">
                        <a href="./pages/user/search_page.html" class="card-link"></a>
                        <i class="fas fa-book-open fa-5x"></i>
                        <div class="content">
                            <h2>Education</h2>
                        </div>
                    </div>
                </div>
                <div class="flex" style="gap: 12px; margin-top:12px">
                    <div class="category-card">
                        <a href="./pages/user/search_page.html" class="card-link"></a>
                        <i class="fas fa-praying-hands fa-5x"></i>
                        <div class="content">
                            <h2>Religion & Worship</h2>
                        </div>
                    </div>
                    <div class="category-card">
                        <a href="./pages/user/search_page.html" class="card-link"></a>
                        <i class="fas fa-ticket-alt fa-5x"></i>
                        <div class="content">
                            <h2>Entertainment</h2>
                        </div>
                    </div>
                    <div class="category-card">
                        <a href="./pages/user/search_page.html" class="card-link"></a>
                        <i class="fas fa-syringe fa-5x"></i>
                        <div class="content">
                            <h2>Health & Medical</h2>
                        </div>
                    </div>
                </div>
                <br>
            </section>
        </div>
    </div>

    <br>


@endsection

@section('scripts')
    <script src="{{ URL::asset('js/typed.js') }}"></script>
    <script>
        var typed = new Typed('#welcome-string', {
            stringsElement: '#typed',
            showCursor: false,
            cursorChar: '|',
            typeSpeed: 70,
            backSpeed: 70,
            backDelay: 5000,
            loop: true,
            loopCount: Infinity,
        });
    </script>
@endsection
