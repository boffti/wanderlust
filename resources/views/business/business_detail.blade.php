<!-- 
    Author: Melkot, Aaneesh Naagaraj
    ID : 1001750503
-->
@extends('layouts.app')

@section('title', "WL | ". $biz['business_name'])

@section('content')

    <div class="container">

        <!-- Search Bar -->
        <section class="flex">
            <form class="hero-form card flex" action="#">
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
                    </select>
                </div>
                <button id="btnSearchNow" type="submit" href="#" class="btn" style="margin-left: 25px;">SEARCH
                    NOW</button>
            </form>
        </section>
        <br>
        <!-- Business Header -->

        <section>
            <div class="flex-left" style="justify-content: space-between;">
                <div>
                    <h1 class="strong" style="font-size: 45px; margin-bottom:0;">
                        {{ $biz['business_name'] }}
                    </h1>
                    <div class="rating flex-left" style="font-size: 40px; align-items:center;">
                        <ul style="padding-left:0;">
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="far fa-star"></i></li>
                        </ul>
                        <span class="rating-count">24 reviews</span>
                    </div>
                    <p class="business-category"></p>
                    <div class="business-timings">
                        <span style="color: var(--other-color-1); font-weight:bold; margin-right:10px;">Open</span> Open
                        24
                        hours
                    </div>
                    <br>
                    <div>
                        <button id="btnWriteReview" class="btn" style="font-size: large;"><i class="far fa-star"
                                style="margin-right: 10px;"></i> Write a Review</button>
                        <button id="btnUploadBusinessPhoto" class="btn btn-outline-secondary text-secondary"
                            style="font-size: large;"><i class="fas fa-camera" style="margin-right: 10px;"></i> Add
                            Photo</button>
                        <input id="fileBusinessPhoto" type="file" name="" id="" style="display: none;">
                        <button class="btn btn-outline-secondary text-secondary" style="font-size: large;"><i
                                class="fas fa-share-alt" style="margin-right: 10px;"></i> Share</button>
                    </div>
                </div>

                <div style="margin-top:1.2em;">
                    <span><i class="fas fa-external-link-alt" style="margin-right:8px;"></i><a href="#"
                            class="text-accent" style="margin-bottom:12px;">{{ $biz['business_website'] }}</a></span>
                    <p><i class="fas fa-phone-alt" style="margin-right:8px;"></i> {{ $biz['business_phone'] }}</p>
                </div>
            </div>
        </section>
        <br>
        <hr>
        <br>


        <section>
            <div>
                <h2>COVID-19 Safety Measures</h2>
                <div class="flex-left" style="justify-content: space-between;">
                    <span class="strong"><i class="fas fa-check wander-green" style="margin-right:8px"></i>Staff wears
                        masks</span>
                    <span class="strong"><i class="fas fa-check wander-green" style="margin-right:8px"></i>Sanitized
                        frequently</span>
                    <span class="strong"><i class="fas fa-check wander-green" style="margin-right:8px"></i>Staff wears
                        gloves</span>
                    <span class="strong"><i class="fas fa-check wander-green" style="margin-right:8px"></i>Staff
                        temperature checks</span>
                    <span class="strong"><i class="fas fa-check wander-green" style="margin-right:8px"></i>Contactless
                        payments</span>
                </div>
            </div>
        </section>

        <br>
        <hr>
        <br>

        <!-- Business Description Section -->
        <section>
            <div>
                <h2>About the Business</h2>
                <div class="card">
                    <p>{{ $biz['business_desc'] }}</p>
                </div>
            </div>
        </section>

        <br>
        <hr>
        <br>

        <!-- Photo Gallery Section -->
        <section>
            <div>
                <div class="flex-left" style="justify-content: space-between;">
                    <h2>Photos</h2>
                    <a href="#">See more</a>
                </div>
                <div class="flex-left">
                    <!-- Define all of the tiles: -->
                    <div class="box">
                        <div class="img-box">
                            <img
                                src="https://images.unsplash.com/photo-1614038276039-667c23bc32fa?ixid=MXwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw3fHx8ZW58MHx8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" />
                        </div>
                    </div>
                    <div class="box">
                        <div class="img-box">
                            <img
                                src="https://images.unsplash.com/photo-1614059632169-522876ce04c8?ixid=MXwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw4fHx8ZW58MHx8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" />
                        </div>
                    </div>
                    <div class="box">
                        <div class="img-box">
                            <img
                                src="https://images.unsplash.com/photo-1613977257421-010b50211cd3?ixid=MXwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwxOXx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" />
                        </div>
                    </div>
                    <div class="box">
                        <div class="img-box">
                            <img
                                src="https://images.unsplash.com/photo-1614036102254-b5a105bc3537?ixid=MXwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwyNnx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" />
                        </div>
                    </div>
                    <div class="box">
                        <div class="img-box">
                            <img
                                src="https://images.unsplash.com/photo-1614022995184-0347cdc53871?ixid=MXwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwyN3x8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <br>
        <hr>
        <br>

        <!-- Tips Section -->
        <section>
            <div class="flex-left" style="justify-content: space-between;">
                <h2>Word to the Wise</h2>
                <a href="./business_tips.php">See more</a>
            </div>
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
                        <div class="flex ml-auto" style="gap: 10px; ">
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
                        <div class="flex ml-auto" style="gap: 10px; ">
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
                        <div class="flex ml-auto" style="gap: 10px; ">
                            <a class="tip-author" href="#" style="margin: 0;">Aima Ho</a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="flex" style="justify-content: space-between; padding: 0 15px">
                <a href="./business_tips.php" class="strong">Write Tip +</a>
            </div>
        </section>

        <br>
        <hr>
        <br>

        <!-- Location & Hours section -->
        <section>
            <div>
                <h2>Location & Hours</h2>
                <div class="flex-left" style="gap:20px;">
                    <div>
                        <div class="" style="height: 80%; width:500px; margin-right:20px;"><iframe frameborder="0"
                                style="border:0; width:100%; height:100%;"
                                src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0Dx_boXQiwvdz8sJHoYeZNVTdoWONYkU&amp;q=place_id:EntLYW5ha2FwdXJhIFJkLCBKUCBOYWdhciA2dGggUGhhc2UsIEtyaXNobmEgRGV2YXJheWEgTmFnYXIsIFllbGFjaGVuYWhhbGxsaSwgS3VtYXJhc3dhbXkgTGF5b3V0LCBCZW5nYWx1cnUsIEthcm5hdGFrYSwgSW5kaWEiLiosChQKEglTQD7jdxWuOxHVyhgiZUBnDxIUChIJuczhjGcVrjsR8l2WW9YHnZw&key=AIzaSyA0Dx_boXQiwvdz8sJHoYeZNVTdoWONYkU"
                                allowfullscreen=""></iframe></div>
                        <p class="strong" style="margin-bottom: 0;">{{ $biz['business_address'] }}</p>
                        <p style="margin-top: 0;">{{ $biz['city_id'] }}</p>
                    </div>
                    <div>
                        <table>
                            <tr style="padding: 6px;">
                                <td class="strong">
                                    Monday
                                </td>
                                <td>
                                    Open 24 hours
                                </td>
                            </tr>
                            <tr style="padding: 6px;">
                                <td class="strong">
                                    Tuesday
                                </td>
                                <td>
                                    Open 24 hours
                                </td>
                            </tr>
                            <tr style="padding: 6px;">
                                <td class="strong">
                                    Wednesday
                                </td>
                                <td>
                                    Open 24 hours
                                </td>
                            </tr>
                            <tr style="padding: 6px;">
                                <td class="strong">
                                    Thursday
                                </td>
                                <td>
                                    Open 24 hours
                                </td>
                            </tr>
                            <tr style="padding: 6px;">
                                <td class="strong">
                                    Friday
                                </td>
                                <td>
                                    Open 24 hours
                                </td>
                            </tr>
                            <tr style="padding: 6px;">
                                <td class="strong">
                                    Saturday
                                </td>
                                <td>
                                    4:00 PM - 11:00 PM
                                </td>
                            </tr>
                            <tr style="padding: 6px;">
                                <td class="strong">
                                    Sunday
                                </td>
                                <td>
                                    4:00 PM - 11:00 PM
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </section>

        <br>
        <hr>
        <br>

        <!-- Question & Answers section -->
        <!-- <section>
            <div>
                <div class="flex-left" style="justify-content: space-between;">
                    <h2>Ask the Community</h2>
                    <a href="#" class="strong" style="font-size: 18px;">Ask a question +</a>
                </div>
                <div>

                </div>
            </div>
        </section>

        <br>
        <hr>
        <br> -->

        <!-- Reviews Section -->
        <section id="review-section">
            <div>
                <div class="flex-left" style="justify-content: space-between;">
                    <h2>Reviews</h2>
                </div>
                <div class="card">
                    <h3>Leave a review</h3>
                    <div class="rating flex-left" style="font-size: 20px; justify-content:space-between;">
                        <ul>
                            <li><i class="fas fa-star review-form-star"></i></li>
                            <li><i class="fas fa-star review-form-star"></i></li>
                            <li><i class="fas fa-star review-form-star"></i></li>
                            <li><i class="fas fa-star review-form-star"></i></li>
                            <li><i class="fas fa-star review-form-star"></i></li>
                        </ul>
                    </div>
                    <textarea placeholder="Remember, be nice!" id="w3review" name="w3review" rows="6" cols="30"
                        style="width: 100%;"></textarea>
                    <button class="btn">SUBMIT</button>
                </div>
                <div class="card">
                    <div class="review-card-header flex-left">
                        <img id=""
                            src="https://in.bmscdn.com/iedb/artist/images/website/poster/large/danish-sait-35531-07-11-2016-01-48-14.jpg"
                            alt="profile" class="review-card-user-img">
                        <div>
                            <h3>Danish Sait</h3>
                            <p class="wander-green">Arlington, TX</p>
                        </div>
                    </div>
                    <div class="rating flex-left" style="font-size: 20px; align-items:center;">
                        <ul>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="far fa-star"></i></li>
                        </ul>
                        <p style="font-size: 14px;">02/12/2021</p>
                    </div>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corporis debitis molestias alias
                        libero
                        repellendus autem sunt! Quaerat possimus, repellendus eaque ab ducimus distinctio magni
                        inventore
                        rerum repudiandae error id eveniet. Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic
                        nulla debitis nobis quaerat minima vero id provident numquam, voluptatum voluptate ipsam
                        possimus
                        ducimus! Sit, necessitatibus accusamus labore nam voluptatem assumenda!
                    </p>
                </div>
                <div class="card">
                    <div class="review-card-header flex-left">
                        <img id=""
                            src="https://www.biography.com/.image/t_share/MTE5NDg0MDU0ODE5MzQxODM5/tina-fey-365284-1-402.jpg"
                            alt="profile" class="review-card-user-img">
                        <div>
                            <h3>Tina Fey</h3>
                            <p class="wander-green">Arlington, TX</p>
                        </div>
                    </div>
                    <div class="rating flex-left" style="font-size: 20px; align-items:center;">
                        <ul>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                        </ul>
                        <p style="font-size: 14px;">02/12/2021</p>
                    </div>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corporis debitis molestias alias
                        libero
                        repellendus autem sunt! Quaerat possimus, Lorem, ipsum dolor sit amet consectetur adipisicing
                        elit.
                        Consequuntur, doloremque fuga! Molestias soluta dolore quasi quia reprehenderit ab tempore,
                        eius,
                        architecto est officiis illo minima vel. Corrupti corporis itaque maxime.
                    </p>
                </div>
                <div class="card">
                    <div class="review-card-header flex-left">
                        <img id=""
                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQqj-OkFV55geNPyjWSwPmeSkeipmC4uOcZjg&usqp=CAU"
                            alt="profile" class="review-card-user-img">
                        <div>
                            <h3>Kenny Sebastian</h3>
                            <p class="wander-green">Arlington, TX</p>
                        </div>
                    </div>
                    <div class="rating flex-left" style="font-size: 20px; align-items:center;">
                        <ul>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="far fa-star"></i></li>
                            <li><i class="far fa-star"></i></li>
                        </ul>
                        <p style="font-size: 14px;">02/12/2021</p>
                    </div>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corporis debitis molestias alias
                        libero
                        repellendus autem sunt! Quaerat possimus, repellendus eaque ab ducimus distinctio magni
                        inventore
                        rerum repudiandae error id eveniet. Lorem ipsum dolor sit amet.
                    </p>
                </div>
            </div>
            <a href="./business_reviews.php" class="flex-center">See All</a>
        </section>
    </div>

    <br>

@endsection