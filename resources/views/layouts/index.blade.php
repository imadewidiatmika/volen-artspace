@extends('main')
@section('content')
    @include('components.carousel')
    <!-- About Start -->
    @include('components.about')
    <!-- About End -->
    <!-- Activities Start -->
    <div class="container-fluid bg-grey py-5 my-5">
        <div class="container py-5">
            <div class="section-title text-center mx-auto wow fadeInU mb-5p" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-medium fst-italic smalltitle">Our Activities</p>
                <h1 class="display-6 maintext">Variative activities to joined in Bali or online</h1>
            </div>
            <div class="owl-carousel product-carousel wow fadeInUp" data-wow-delay="0.5s">
                <a href="https://wa.me/+62895341115908" class="d-block product-item rounded">
                    <img src="img/actv2.jpg" alt="">
                    <div class="bg-white shadow-sm text-center p-4 position-relative mt-n5 mx-4">
                        <h4 class="maintext">Basic Crochet: Crafting Elegance, One Stitch at a Time
                        </h4>
                        <span class="minidesc">Discover the joy of Basic Crochet, where yarn and hook unite to create timeless pieces. From cozy scarves to intricate doilies, explore the art of crafting with a touch of tradition and modern flair.
                        </span>
                    </div>
                </a>
                <a href="https://wa.me/+62895341115908" class="d-block product-item rounded">
                    <img src="img/chunkybag.jpg" alt="">
                    <div class="bg-white shadow-sm text-center p-4 position-relative mt-n5 mx-4">
                        <h4 class="maintext"> Chunky Bag: Fashion Meets Functionality
                        </h4>
                        <span class="text-body">Elevate your style with Chunky Bag crafting. Use chunky yarn to fashion accessories that blend fashion with functionality. Your handmade chunky bag will turn heads and become a testament to your unique style.
                        </span>
                    </div>
                </a>
                <a href="https://wa.me/+62895341115908" class="d-block product-item rounded">
                    <img src="img/punch.jpg" alt="">
                    <div class="bg-white shadow-sm text-center p-4 position-relative mt-n5 mx-4">
                        <h4 class="maintext">Punch Needle: Painting with Yarn
                        </h4>
                        <span class="text-body">Explore the world of Punch Needle, transforming yarn into textured canvases. This rhythmic craft offers therapeutic creativity, resulting in vibrant designs that become cherished pieces of art.
                        </span>
                    </div>
                </a>
                <a href="https://wa.me/+62895341115908" class="d-block product-item rounded">
                    <img src="img/resin.jpg" alt="">
                    <div class="bg-white shadow-sm text-center p-4 position-relative mt-n5 mx-4">
                        <h4 class="maintext">Resin Ocean Painting: Waves of Creativity
                        </h4>
                        <span class="text-body">Immerse yourself in Resin Ocean Painting, where waves of vibrant colors blend to create stunning, soothing masterpieces. This visually captivating activity promises both an artwork and a journey into your creativity's depths.
                        </span>
                    </div>
                </a>
            </div>
        </div>
        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <a href="{{ route('activities') }}" class="btn btn-dark rounded-pill py-3 px-5 animated zoomIn">Show More</a>
        </div>
    </div>
    <!-- Activities End -->
    <!-- Article Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-5 wow fadeIn" data-wow-delay="0.1s">
                    <img class="img-fluid" src="img/article3.jpg" alt="">
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <div class="section-title">
                        <p class="fs-5 fw-medium fst-italic smalltitle">Featured Acticle</p>
                        <h1 class="display-6 maintext">Denpasar Creative Agency (BKRAF) : Resurging city's creative industry together with Volen Artspace</h1>
                    </div>
                    <p class="minidesc">Bali is an island of powerful spirits. For many decades there are many local and international artists have visited and got inspired by the beauty of the isle. Has a vision to scale up and showing supports of the art & craft industry, the city government of Denpasar has formed an creative agency since 2019 and was engaged Volen Artspace to be the part through the process of resurging the creative industry. </p>
                    <p class="minidesc">Today our teams is interviewing one of the leader of the city's creative movement, Hendar, to hear about his perspectives in this industry, breaking down the paradigm of art & craft as economic aspect, and found the reasons why the agency was engaged Volen Artspace to its missions.</p>
                    <a href="{{ route('article') }}" class="btn btn-dark rounded-pill py-3 px-5">Read More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Article End -->
    <!-- Video Start -->
    <div class="container-fluid black-bg my-5">
        <div class="container">
            <div class="row g-0">
                <div class="col-lg-6 py-5 wow fadeIn" data-wow-delay="0.1s">
                    <div class="py-5">
                        <h1 class="display-6 mb-4 text-white">Volen Artspace Empower <span class="text-white">Women</span> and Fight Against <span class="text-white">Mental Illness</span></h1>
                        <h5 class="fw-normal lh-base fst-italic minidesc mb-5">Beyond good services & goods, we want to put values in our business. As feminists & crafters, our vission is strongly directed to empowering women in this island and help many women to cope with their stress & depression in our activities, goods, & installation</h5>
                        <div class="row g-4 mb-5">
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 btn-lg-square bg-white text-dark rounded-circle me-3">
                                        <i class="fa fa-check"></i>
                                    </div>
                                    <span class="minidesc">Open Minded</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 btn-lg-square bg-white text-dark rounded-circle me-3">
                                        <i class="fa fa-check"></i>
                                    </div>
                                    <span class="minidesc">Update</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 btn-lg-square bg-white text-dark rounded-circle me-3">
                                        <i class="fa fa-check"></i>
                                    </div>
                                    <span class="minidesc">Friendly</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 btn-lg-square bg-white text-dark rounded-circle me-3">
                                        <i class="fa fa-check"></i>
                                    </div>
                                    <span class="minidesc">All Ears</span>
                                </div>
                            </div>
                        </div>
                        <a href="https://api.whatsapp.com/send?phone=+62895341115908&text=Hi!%20I am%20Really%20Excited%20With%20Volen Artspace%20.%20Do you have time to contact me please?" class="btn btn-reverse rounded-pill py-3 px-5 animated zoomIn">Join Now</a>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <div class="h-100 d-flex align-items-center justify-content-center" style="min-height: 300px;">
                        <button type="button" class="btn-play" data-bs-toggle="modal"
                            data-src="https://www.youtube.com/embed/ZThnvxAl3v8" data-bs-target="#videoModal">
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Video End -->
    <!-- Video Modal Start -->
    <div class="modal modal-video fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">VOLEN ARTSPACE</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- 16:9 aspect ratio -->
                    <div class="ratio ratio-16x9">
                        <iframe class="embed-responsive-item" src="" id="video" allowfullscreen allowscriptaccess="always"
                            allow="autoplay"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Video Modal End -->


    <!-- Store Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-medium fst-italic smalltitle">Goods</p>
                <h1 class="display-6 maintext">These are our popular made-with-love goods that you can have</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="store-item position-relative text-center">
                        <img class="img-fluid" src="img/Shoulder.jpg" alt="">
                        <div class="p-4">
                            <div class="text-center mb-3">
                                <small class="fa fa-star smalltitle"></small>
                                <small class="fa fa-star smalltitle"></small>
                                <small class="fa fa-star smalltitle"></small>
                                <small class="fa fa-star smalltitle"></small>
                                <small class="fa fa-star smalltitle"></small>
                            </div>
                            <h4 class="mb-3">Shoulder Bag</h4>
                            <p>Fancy colors & cotton materials bring you to simple yet stylish everyday</p>
                            <h4 class="smalltitle">$45</h4>
                        </div>
                        <div class="store-overlay">
                            <a href="https://api.whatsapp.com/send?phone=+62895341115908&text=Hi!%20I am%20Really%20Excited%20To%20Have%20Shoulder%20Bag.%20How%20Can%20I%20Own%20It?" target="_blank" rel="noopener noreferrer" class="btn btn-dark rounded-pill py-2 px-4 m-2">Buy Now<i class="fa fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="store-item position-relative text-center">
                        <img class="img-fluid" src="img/Granny.jpg" alt="">
                        <div class="p-4">
                            <div class="text-center mb-3">
                                <small class="fa fa-star smalltitle"></small>
                                <small class="fa fa-star smalltitle"></small>
                                <small class="fa fa-star smalltitle"></small>
                                <small class="fa fa-star smalltitle"></small>
                                <small class="fa fa-star smalltitle"></small>
                            </div>
                            <h4 class="mb-3">Granny Square Bag</h4>
                            <p>Granny's never get old, it old-fashioned lover bag!</p>
                            <h4 class="smalltitle">$55</h4>
                        </div>
                        <div class="store-overlay">
                            <a href="https://api.whatsapp.com/send?phone=+62895341115908&text=Hi!%20I am%20Really%20Excited%20To%20Have%20Granny%20Square%20Bag.%20How%20Can%20I%20Own%20It?" target="_blank" rel="noopener noreferrer" class="btn btn-dark rounded-pill py-2 px-4 m-2">Buy Now<i class="fa fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="store-item position-relative text-center">
                        <img class="img-fluid" src="img/Scrunchy.jpg" alt="">
                        <div class="p-4">
                            <div class="text-center mb-3">
                                <small class="fa fa-star smalltitle"></small>
                                <small class="fa fa-star smalltitle"></small>
                                <small class="fa fa-star smalltitle"></small>
                                <small class="fa fa-star smalltitle"></small>
                                <small class="fa fa-star smalltitle"></small>
                            </div>
                            <h4 class="mb-3">Scrunchy</h4>
                            <p>Wear it on your wrist, tied it on your hair, bring it everytime you go</p>
                            <h4 class="smalltitle">$25</h4>
                        </div>
                        <div class="store-overlay">
                            <a href="https://api.whatsapp.com/send?phone=+62895341115908&text=Hi!%20I am%20Really%20Excited%20To%20Have%20Scrunchy.%20How%20Can%20I%20Own%20It?" target="_blank" rel="noopener noreferrer" class="btn btn-dark rounded-pill py-2 px-4 m-2">Buy Now<i class="fa fa-arrow-right ms-2"></i></a>

                        </div>
                    </div>
                </div>
                {{-- <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                    <a href="" class="btn btn-primary rounded-pill py-3 px-5">View More Products</a>
                </div> --}}
            </div>
        </div>
        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <a href="{{ route('goods') }}" class="btn btn-dark rounded-pill py-3 px-5 animated zoomIn">Show More</a>
        </div>
    </div>
    <!-- Store End -->


    <!-- Testimonial Start -->
    <div class="container-fluid black-bg py-5 my-5">
        <div class="container py-5">
            <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-medium fst-italic testimoni">Testimonial</p>
                <h1 class="display-6 text-white">What our clients say about Volen</h1>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.5s">
                <div class="testimonial-item p-4 p-lg-5">
                    <p class="mb-4"><em>"I’m now addicted to crochet thanks to your class, Volen Artspace best class ever"</em></p>
                    <div class="d-flex align-items-center justify-content-center">
                        <img class="img-fluid flex-shrink-0" src="img/testimonial-1.jpg" alt="">
                        <div class="text-start ms-3">
                            <h5 class="maintext">Jen</h5>
                            <span class="minidesc">Influencer</span>
                            
                        </div>
                    </div>
                    
                </div>
                <div class="testimonial-item p-4 p-lg-5">
                    <p class="mb-4"><em>"Best experience to learn with Volen and addicted to craft with them. Love it!"</em></p>
                    <div class="d-flex align-items-center justify-content-center">
                        <img class="img-fluid flex-shrink-0" src="img/testimonial-2.jpg" alt="">
                        <div class="text-start ms-3">
                            <h5 class="maintext">Trully Wijaya</h5>
                            <span class="minidesc">Woman Enterpreneur</span>
                            
                        </div>
                        
                    </div>
                    
                </div>
                <div class="testimonial-item p-4 p-lg-5">
                 <p class="mb-4"><em>"Volen’s workshops are addicted. The team very helpful & comfortful during the activities"</em></p>   
                    <div class="d-flex align-items-center justify-content-center">
                        <img class="img-fluid flex-shrink-0" src="img/testimonial-3.jpg" alt="">
                        <div class="text-start ms-3">
                            <h5 class="maintext">Freza</h5>
                            <span class="minidesc">Woman Enterpreneur</span>
                            
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->

    <!-- CLEINT Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-medium fst-italic smalltittle">Clients & Partners</p>
                <h1 class="display-6 maintext">Corporate Clients & Partners</h1>
                <p class="minidesc">Volen Artspace gives so much loves & respects to all of our clients & corporate partners for get involved yet collaborated with us</p>
            </div>
            <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.1s">
               <div class="container margin-top">
                    <section class="customer-logos slider">
                        <div class="slide"><img src="img/clients/client1.png" alt="Client 1"></div>
                        <div class="slide"><img src="img/clients/client2.png" alt="Client 1"></div>
                        <div class="slide"><img src="img/clients/client23.png" alt="Client 2"></div>
                        <div class="slide"><img src="img/clients/client34.png" alt="Client 3"></div>
                        <div class="slide"><img src="img/clients/client15.png" alt="Client 4"></div>
                        <div class="slide"><img src="img/clients/03_wings.png" alt="Client 5"></div>
                        <div class="slide"><img src="img/clients/client49.png" alt="Client 6"></div>
                        <div class="slide"><img src="img/clients/04_mayora.png" alt="Client 7"></div>
                        <div class="slide"><img src="img/clients/client3.png" alt="Client 8"></div>
                        <div class="slide"><img src="img/clients/05_shell.png" alt="Client 1"></div>
                        <div class="slide"><img src="img/clients/01_azko.png" alt="Client 1"></div>
                    </section>
                    
                    
                </div>
                <div class="text-center mx-auto wow mt-5 fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                    <a href="{{ route('clients') }}" class="btn btn-dark rounded-pill py-3 px-5 animated zoomIn">Show More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- CLIENT End -->
    

    <!-- Contact Start -->
    <div class="container-fluid bg-grey  py-5 my-5">
        <div class="container ">
            <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-medium fst-italic smalltitle">Contact Us</p>
                <h1 class="display-6 mb-3 maintext">Contact us right now</h1>
            </div>
            
            <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-lg-8">
                    <p class="text-center mb-5">Our door is widely open for any kind of purpose and collaboration. Please contact us by click the button bellow.</p>
                    <div class="row g-5">
                        <div class="col-md-4 text-center wow fadeInUp" data-wow-delay="0.3s">
                            <div class="btn-square mx-auto mb-3">
                                <i class="text-secondary fa fa-envelope fa-2x "></i>
                            </div>
                            <p class="mb-2">volenartspace@gmail.com</p>
                        </div>
                        <div class="col-md-4 text-center wow fadeInUp" data-wow-delay="0.4s">
                            <div class="btn-square mx-auto mb-3">
                                <i class="text-secondary fa fa-phone fa-2x "></i>
                            </div>
                            <p class="mb-2">+62 895 34111 5908</p>
                        </div>
                        <div class="col-md-4 text-center wow fadeInUp" data-wow-delay="0.5s">
                            <div class="btn-square mx-auto mb-3">
                                <i class="text-secondary fa fa-map-marker-alt fa-2x "></i>
                            </div>
                            <p class="mb-2">Marlboro V, No.12 Denpasar - Bali</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <a href="https://api.whatsapp.com/send?phone=+62895341115908&text=Hi!%20I am%20Really%20Excited%20With%20Volen Artspace%20.%20Do you have time to contact me please?" class="btn btn-dark rounded-pill py-3 px-5 animated zoomIn">Contact Now</a>
            </div>
        </div>
    </div>
    <!-- Contact Start -->
   
@endsection