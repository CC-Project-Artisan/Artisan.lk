<div id="customCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">

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
                <p>Krafti comes with a captivating template collection, including twelve stunning and completely flexible homepage layouts which can be on your new site this very day!</p>
                <a href="/products" class="btn custom-view-more-btn">View More</a>

            </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item">
            <img src="{{ asset('images/main2.jpg') }}" class="d-block w-100" alt="Slide 2">
            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                <h1>HANDCRAFTED WITH PASSION</h1>
                <p>Explore exclusive items crafted by skilled artisans, perfect for adding beauty to your life.</p>
                <a href="/products" class="btn custom-view-more-btn">View More</a>
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
                <a href="/products" class="btn custom-view-more-btn">View More</a>
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