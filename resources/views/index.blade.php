{{-- Author: Melkot, Aaneesh Naagaraj
ID : 1001750503 --}}
@extends('layouts.app')

@section('title', 'Wanderlust Home')

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
                <form class="hero-form card" action="{{url('/search-page')}}" style="overflow: hidden;">
                    <div class="flex-left flex-wrap" style="justify-content: space-between;">
                        <div class="form-control">
                            <input type="text" name="search-term" id="search-term"
                                placeholder="Keywords eg: food, salons, shopping etc">
                        </div>
                        <div class="form-control"> <select name="categories" id="categories">
                                <option value="choose" disabled selected>Choose a Category</option>
                                <option value="restaurants">Restaurants</option>
                                <option value="shopping">Shopping</option>
                                <option value="education">Education</option>
                                <option value="worship">Religion & Worship</option>
                                <option value="entertainment">Entertainment</option>
                                <option value="health">Health & Medical</option>
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
                    <div class="browse-card">
                        <div class="card-header">
                            <img class="card-img"
                                src=""
                                alt="">
                        </div>
                        <div class="card-body">
                            <h1><a href="{{url('/business-detail')}}"></a></h1>
                            <p></p>
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

                <div class="" style="margin-top: 10px;">
                    <a href="{{url('/search-page')}}">See more</a>
                </div>
            </section>

            <br>

            <!-- Bulletin Board -->
            <section>
                <h2>Bulletin Board</h2>
                <!-- ! IF User.role != visitor -->
                <form>
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
                    <div class="card post">
                        <div class="flex-left">
                            <img class="postIMG" src="" alt="">
                            <div class="full-width">
                                <div class="flex-left space-between align-items-center">
                                    <a href="#">
                                        <h4 class="profileName"></h4>
                                    </a>
                                    <p class="post-date">12/12/2020</p>
                                </div>
                                <p class="post-content"></p>
                            </div>
                        </div>
                    </div>
                    <div class="card post">
                        <div class="flex-left">
                            <img class="postIMG" src="" alt="">
                            <div class="full-width">
                                <div class="flex-left space-between align-items-center">
                                    <a href="#">
                                        <h4 class="profileName"></h4>
                                    </a>
                                    <p class="post-date">12/12/2020</p>
                                </div>
                                <p class="post-content"></p>
                            </div>
                        </div>
                    </div>
                    <div class="card post">
                        <div class="flex-left">
                            <img class="postIMG" src="" alt="">
                            <div class="full-width">
                                <div class="flex-left space-between align-items-center">
                                    <a href="#">
                                        <h4 class="profileName"></h4>
                                    </a>
                                    <p class="post-date">12/12/2020</p>
                                </div>
                                <p class="post-content"></p>
                            </div>
                        </div>
                    </div>
                    <div class="card post">
                        <div class="flex-left">
                            <img class="postIMG" src="" alt="">
                            <div class="full-width">
                                <div class="flex-left space-between align-items-center">
                                    <a href="#">
                                        <h4 class="profileName"></h4>
                                    </a>
                                    <p class="post-date">12/12/2020</p>
                                </div>
                                <p class="post-content"></p>
                            </div>
                        </div>
                    </div>
                    <div class="card post">
                        <div class="flex-left">
                            <img class="postIMG" src="" alt="">
                            <div class="full-width">
                                <div class="flex-left space-between align-items-center">
                                    <a href="#">
                                        <h4 class="profileName"></h4>
                                    </a>
                                    <p class="post-date">12/12/2020</p>
                                </div>
                                <p class="post-content"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{url('/posts')}}" style="margin-left: 12px;">See all</a>
            </section>

            <br>
            <!-- Tips -->
            <section>
                <h2>Word to the Wise</h2>
                <div class="tips">
                    <div class="card border-l-yellow">
                        <div class="flex flex-column align-items-left">
                            <div>
                                <span class="quotes">"</span><strong>
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Adipisci quibusdam
                                    accusantium, fugiat debitis dolorem iure soluta cum consequuntur dignissimos animi
                                    tenetur magnam sit, perferendis illo, quidem quis. Facere, nostrum sit.
                                </strong><span class="quotes">"</span>
                            </div>
                            <div class="flex ml-auto tip-footer" style="gap: 10px; ">
                                <a class="tip-author" href="#" style="margin: 0;">Jagan Das</a>
                            </div>
                        </div>
                    </div>

                    <div class="card border-l-yellow">
                        <div class="flex flex-column align-items-left">
                            <div>
                                <span class="quotes">"</span><strong>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Facilis harum eius optio. Delectus repellat sunt eveniet neque nesciunt assumenda
                                    debitis, ullam impedit molestiae tempore deleniti corporis officiis ipsa expedita
                                    repudiandae.
                                </strong><span class="quotes">"</span>
                            </div>
                            <div class="flex ml-auto tip-footer" style="gap: 10px; ">
                                <a class="tip-author" href="#" style="margin: 0;">Mark Appleseed</a>
                            </div>
                        </div>
                    </div>

                    <div class="card border-l-yellow">
                        <div class="flex flex-column align-items-left">
                            <div>
                                <span class="quotes">"</span><strong>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis at blanditiis
                                    quasi minima eveniet maiores enim praesentium qui dolorum, est perferendis, delectus
                                    tenetur deserunt ipsam, cumque officia itaque. Temporibus, laborum.
                                </strong><span class="quotes">"</span>
                            </div>
                            <div class="flex ml-auto tip-footer" style="gap: 10px; ">
                                <a class="tip-author" href="#" style="margin: 0;">Aima Ho</a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="flex" style="justify-content: space-between; padding: 0 15px">
                    <a href="./pages/user/tips.html" class="">See more tips</a>
                    <a href="./pages/user/tips.html" class="strong">+ ADD TIP</a>
                </div>
            </section>

            <br>

            <!-- Categories -->
            <section class="">
                <h2>Browse by Category</h2>
                <div class="flex" style="gap: 12px;">
                    <div class="category-card">
                        <a href="{{url('/search-page')}}" class="card-link"></a>
                        <i class="fas fa-hamburger fa-5x"></i>
                        <div class="content">
                            <h2>Restaurant</h2>
                        </div>
                    </div>
                    <div class="category-card">
                        <a href="{{url('/search-page')}}" class="card-link"></a>
                        <i class="fas fa-shopping-cart fa-5x"></i>
                        <div class="content">
                            <h2>Shopping</h2>
                        </div>
                    </div>
                    <div class="category-card">
                        <a href="{{url('/search-page')}}" class="card-link"></a>
                        <i class="fas fa-book-open fa-5x"></i>
                        <div class="content">
                            <h2>Education</h2>
                        </div>
                    </div>
                </div>
                <div class="flex" style="gap: 12px; margin-top:12px">
                    <div class="category-card">
                        <a href="{{url('/search-page')}}" class="card-link"></a>
                        <i class="fas fa-praying-hands fa-5x"></i>
                        <div class="content">
                            <h2>Religion & Worship</h2>
                        </div>
                    </div>
                    <div class="category-card">
                        <a href="{{url('/search-page')}}" class="card-link"></a>
                        <i class="fas fa-ticket-alt fa-5x"></i>
                        <div class="content">
                            <h2>Entertainment</h2>
                        </div>
                    </div>
                    <div class="category-card">
                        <a href="{{url('/search-page')}}" class="card-link"></a>
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

    <!-- ! If user in session -->
    <div id="location-select-modal-container" class="modal-container">
        <div class="modal" id="location-select-modal">
            <div class="modal-header flex-left space-between" style="align-items: center;">
                <p style="margin-left: 12px;">Select Location</p>
                <a href="#" class="cancel" style="float: right;">x</a>
            </div>
            <div class="modal-content" style="align-items:center;">
                <form class="flex-center" style="gap: 12px;">
                    <div class="form-control"> <select id="location-select" name="location" id="location">
                            <option value="choose" disabled selected>Change your location</option>
                            <option value="arlington">Arlington</option>
                            <option value="newyork">New York</option>
                            <option value="hongkong">Hong Kong</option>
                            <option value="bangalore">Bangalore</option>
                            <option value="london">London</option>
                            <option value="dubai">Dubai</option>
                        </select></div>
                    <div>
                        <button class="cancel btn btn-outline-secondary text-secondary">Cancel</button>
                        <button class="btn" type="submit">Change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
