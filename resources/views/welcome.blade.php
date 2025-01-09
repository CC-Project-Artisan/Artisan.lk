@extends('layouts.frontend')

@section('pages')
<div id="customCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000" data-bs-keyboard="false">

    <div class="carousel-indicators">
        <button type="button" data-bs-target="#customCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#customCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#customCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>


    <div class="carousel-inner">
        <!-- Slide 1 -->
        <div class="carousel-item active">
            <img src="{{ asset('images/main.jpg') }}" class="d-block w-100" alt="Slide 1">
            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                <h1>BUILDING NEW EXPERIENCES</h1>
                <br>
                <p>Krafti comes with a captivating template collection, including twelve stunning and completely flexible homepage layouts which can be on your new site this very day!</p>
                <br>
                <br>
                <a href="/products" class="btn custom-view-more-btn">VIEW MORE</a>

            </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item">
            <img src="{{ asset('images/main2.jpg') }}" class="d-block w-100" alt="Slide 2">
            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
            
                <h1>HANDCRAFTED WITH PASSION</h1>
                <br>
                <p>Explore exclusive items crafted by skilled artisans, perfect for adding beauty to your life.</p>
                <br>
                <br> 
                <a href="/products" class="btn custom-view-more-btn">VIEW MORE</a>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item">
            <img src="{{ asset('images/main3.jpg') }}" class="d-block w-100" alt="Slide 3">
            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                <h1>EMPOWER LOCAL ARTISANS</h1>
                <br>

                <p>Your support empowers Sri Lankan artists to continue creating unique masterpieces.</p>
                <br>
                <br>
                <a href="/products" class="btn custom-view-more-btn">VIEW MORE</a>
            </div>
        </div>
    </div>


    <button class="carousel-control-prev" type="button" data-bs-target="#customCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#customCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>



<section class="feature-section">
    <div class="feature-container">
        
        <div class="feature-item main-feature">
            <div class="feature-icon">
                
                <svg xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="29.325px" height="38.363px" viewBox="0 0 29.325 38.363" enable-background="new 0 0 29.325 38.363" xml:space="preserve">
                    <path fill="#2C2D7F" d="M12.946,38.154c0,0,1.169-3.487,1.503-4.275c0,0-0.158-1.611-2.012-2.792
                        c-1.855-1.18-6.858-2.864-9.227-4.577C0.84,24.797,0,21.431,0,21.431s2.684-0.108,5.282,2.128s4.764,5.83,6.667,6.361
                        c0,0,0.499-1.706,0.1-2.632c-0.399-0.925-2.628-1.944-2.74-3.705c0,0,1.793-0.151,2.635,0.906c0.842,1.057,1.133,3.399,0.647,5.85
                        c0,0,2.556,1.544,2.42,3.563c0,0-1.213,3.494-1.561,4.46L12.946,38.154z"></path>
                    <path fill="#2C2D7F" d="M15.752,33.462c0,0-0.044-1.181,1.968-2.811c0,0-0.097-1.247-0.019-1.893c0,0-0.716-1.356-0.296-3.034
                        s2.694-2.268,2.694-2.268s-0.1,2.18-0.682,3.273c-0.582,1.094-1.257,2.427-1.153,3.495c0,0,1.264-0.886,1.774-1.057
                        c0,0,2.898-7.606,9.017-9.974c0,0,1.301,3.461-1.831,6.439C24.093,28.612,20.028,28.657,15.752,33.462z"></path>
                    <path fill="#2C2D7F" d="M15.472,31.917c0,0-0.547-2.715-0.663-4.486c-0.116-1.771-1.482-3.741-2.194-4.305
                        c-0.712-0.563-6.41-3.121-8.104-5.176c-1.695-2.055-2.463-4.895-2.124-6.529c0,0,2.739-0.076,4.536,2.119
                        c1.797,2.196,2.134,5.86,3.067,6.98c0,0,0.915,0.79,1.748,1.158c0,0-2.668-4.696-2.389-6.681c0,0,1.954,1.369,2.485,2.519
                        c0.531,1.15,0.143,2.99,0.143,2.99s0.184,1.174,0.53,1.485c0.345,0.311,2.513,1.987,2.883,4.554
                        C15.759,29.111,15.472,31.917,15.472,31.917z"></path>
                    <path fill="#2C2D7F" d="M15.752,24.485c0,0-0.41-1.022,0.848-2.144c0,0-0.351-1.579-0.198-3.161c0,0-0.748-2.071-0.23-3.473
                        c0.519-1.402,2.288-2.871,2.288-2.871s0.302,2.003-0.432,4.175c-0.734,2.172-1.16,3.329-0.897,4.75l1.958-1.464
                        c0,0,0.093-3.897,1.743-6.66s4.323-4.666,4.323-4.666s1.177,2.954-0.555,6.993C22.867,20.005,17.903,20.745,15.752,24.485z"></path>
                    <path fill="#2C2D7F" d="M14.665,22.526c0,0-0.942-1.285-1.469-3.344s-2.564-7.771-2.044-12S14.425,0,14.425,0
                        s2.874,2.798,2.399,6.486c-0.475,3.688-3.833,9.204-3.833,9.204L14.665,22.526z"></path>
                </svg>
            </div>
            <h2 style="font-family: 'Alegreya', serif;">WITH HOME IN MIND</h2>
            <p style="font-family: 'Lato', sans-serif;">Lorem ipsum dolor sit amet a con sectet adipisicing elit se do eiusotemp or incidid unt en labore et dolore magna aliqua ut enim minim veniam quis nost exercitation sen sene ullamco aboris nisi ut</p>
        </div>
        
        
        <div class="feature-sub-items">
            <div class="feature-item">
                <h3 style="font-family: 'Alegreya', serif;">NEW IDEAS</h3>
                <p style="font-family: 'Lato', sans-serif; color: #58595b;">Lorem ipsum dolor sit amet a con sectet adipisicing elit se do eiusotemp or incidid unt ut labore et dolore</p>
                <a href="#" class="feature-link">
                    <span class="underline"></span> VIEW MORE
                </a>
            </div>
            <div class="feature-item">
                <h3 style="font-family: 'Alegreya', serif;">CREATIVE SPIRIT</h3>
                <p style="font-family: 'Lato', sans-serif; color: #58595b;">Lorem ipsum dolor sit amet a con sectet adipisicing elit se do eiusotemp or incidid unt ut labore et dolore</p>
                <a href="#" class="feature-link">
                    <span class="underline"></span> VIEW MORE
                </a>
            </div>
        </div>
    </div>
</section>


<section class="category-section">
    <div class="category-grid">
        
        <div class="category-item large-item">
            <img src="{{ asset('images/mask1.jpg') }}" alt="Organic Raw">
            <div class="category-overlay">
                <h3>MASK</h3>
                <p>Handmade</p>
            </div>
        </div>
        
       
        <div class="category-item">
            <img src="{{ asset('images/jewellry.jpeg') }}" alt="Category 2">
            <div class="category-overlay">
                <h3>JEWELERY</h3>
                <p>Handmade</p>
            </div>
        </div>

        
        <div class="category-item">
            <img src="{{ asset('images/bathik.jpg') }}" alt="Category 3">
            <div class="category-overlay">
                <h3>BATIL & SILK</h3>
                <p>Handmade</p>
            </div>
        </div>

        
        <div class="category-item">
            <img src="{{ asset('images/pottory.png.jpeg') }}" alt="Category 4">
            <div class="category-overlay">
                <h3>POTTERY</h3>
                <p>Handmade</p>
            </div>
        </div>

       
        <div class="category-item">
            <img src="{{ asset('images/paintings.jpg.webp') }}" alt="Category 5">
            <div class="category-overlay">
                <h3>PAINTINGS</h3>
                <p>Handmade</p>
            </div>
        </div>
    </div>
</section>





@endsection