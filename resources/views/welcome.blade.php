
@extends('layouts.app')

   @section('content')
   
    <div class="container-fluid p-0" style="height: 60vh; margin-top:100px; ">
      <div class="slider">
        <div class="slider__slide slider__slide--active" data-slide="1">
          <div class="slider__wrap">
            <div class="slider__back"></div>
          </div>
          <div class="slider__inner">
            <div class="slider__content text-center">
              <h1 class="pri-color"> Transform Your Space with Our Premium Leaves! </h1>
              <div class="row mt-5 d-flex justify-content-center">
                <div class="col-auto ">
                  <a href="" class="btn-pri fw-bold">Check Our Products!</a>
                </div>

                <div class="col-auto pt-3">
                  <a class="go-to-next arrow">next</a>
                </div>
              </div>
             
            </div>
          </div>
        </div>
        <div class="slider__slide" data-slide="2">
          <div class="slider__wrap">
            <div class="slider__back"></div>
          </div>
          <div class="slider__inner">
            <div class="slider__content">
              <h1 >Exclusive Discounts:</h1><br> <h2 class="pri-color">Save 15% on your first purchase with code <b>LEAF15.</b> </h2> 
              <div class="row mt-5 d-flex justify-content-start">
                <div class="col-auto ">
                  <a href="" class="btn-pri fw-bold">Claim Now!</a>
                </div>

                <div class="col-auto ">
                  <a class="go-to-next arrow">next</a>
                </div>
              </div>
            </div>
            
          </div>
        </div>
        <div class="slider__slide" data-slide="3">
          <div class="slider__wrap">
            <div class="slider__back"></div>
          </div>
          <div class="slider__inner">
            <div class="slider__content">
              <h1 class="pri-color">Have questions? </h1>
              <br>
                <h2> We're here to help you find the perfect leaves!</h2>
                
                <div class="row mt-5 d-flex justify-content-start">
                  <div class="col-auto ">
                    <a href="" class="btn-pri fw-bold">Contact Us</a>
                  </div>
  
                  <div class="col-auto ">
                    <a class="go-to-next arrow">next</a>
                  </div>
                </div>
            </div>
          </div>
        </div>
        <div class="slider__indicators"></div>
    </div>
    </div>
    

    <div class="container-fluid content pt-5">
      
        <h3 class="fw-bold fs-1 pri-color">Anthurium Recommendations</h3>
        <div class="row pt-3">
          <div class="col col-lg-6 col-12">
            <div class="card" style="width: auto; ">
              <img src="Aset/image/card-1.jpg" class="card-img img-fluid" style="height: 50em; object-fit: cover; ">
              <div class="card-img-overlay ovl d-flex flex-column justify-content-end  ">
                <div class="wraped  mx-2 mb-2 p-2">
                  <h5 class="card-title fw-bold text-light fs-3 mb-3">Lorem Ipsum Dolor</h5>
                  <p class="card-text-hide text-light">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                   <button class="btn py-1 px-4">beli</button>
                </div>
                
              </div>
            </div>
          </div>
          <div class="col col-lg-6 col-12">
            <div class="card mb-3">
              <img src="Aset/image/card-03.jpg" class="card-img img-fluid" style="height: 24em; object-fit: cover;">
              <div class="card-img-overlay ovl d-flex flex-column justify-content-end  ">
                <div class="wraped  mx-2 mb-2 p-2">
                  <h5 class="card-title fw-bold text-light fs-3 mb-3">Lorem Ipsum Dolor</h5>
                  <p class="card-text-hide text-light">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                   <button class="btn py-1 px-4">beli</button>
                </div>
              </div>
              
          </div>
          <div class="row">
            <div class="col-6">
              <div class="card" style="width: auto;">
                <img src="Aset/image/card-2.jpg" class="card-img img-fluid" style="height: 24.5em; object-fit: cover;">
                <div class="card-img-overlay ovl d-flex flex-column justify-content-end  ">
                  <div class="wraped  mx-2 mb-2 p-2">
                    <h5 class="card-title fw-bold text-light fs-5 mb-3">Lorem Ipsum Dolor</h5>
                    <p class="card-text-hide text-light small">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                     <button class="btn py-1 px-4">beli</button>
                  </div>
                </div>
                </div>
               </div>
            <div class="col-6">
              <div class="card" style="width: auto;">
                <img src="Aset/image/card-2.jpg" class="card-img img-fluid" style="height: 24.5em; object-fit: cover;">
                <div class="card-img-overlay ovl d-flex flex-column justify-content-end  ">
                  <div class="wraped  mx-2 mb-2 p-2">
                    <h5 class="card-title fw-bold text-light fs-5 mb-3">Lorem Ipsum Dolor</h5>
                    <p class="card-text-hide text-light small">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                     <button class="btn py-1 px-4">beli</button>
                  </div>
                </div>
                  </div>
            </div>
            </div>
          </div>
      </div>

    </div>
     </div>
     <div class="container-fluid content content-slide py-5 mt-5">
      <h1 class="my-3 text-center sec-color" style="font-size: 5vh; font-weight:700;"> <b> Products Of The Month </b>  </h1>
      <h5 class=" text-center pb-3"> Dont'miss out on this Month's Smash Hits!<br>
        Grab them now before we ran out! </h5>
      <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner mb-5">
          <div class="carousel-item active">
            <div class="row ">
              
              <div class="col d-flex justify-content-center ">
                <a  href="#"><img alt="" src="../../Aset/image/header4.jpg" width="300vw" style="object-fit: cover "></a>
              </div>
              <div class="col d-flex justify-content-center">
                <a  href="#"><img alt="" src="../../Aset/image/header4.jpg" width="300vw" style="object-fit: cover "></a>
              </div>
              <div class="col d-flex justify-content-center ">
                <a  href="#"><img alt="" src="../../Aset/image/header4.jpg" width="300vw" style="object-fit: cover "></a>
              </div>
              
   
            </div>        
          </div>
          <div class="carousel-item">
            <div class="row ">
              
              <div class="col d-flex justify-content-center ">
                <a  href="#"><img alt="" src="../../Aset/image/header4.jpg" width="300vw" style="object-fit: cover "></a>
              </div>
              <div class="col d-flex justify-content-center">
                <a  href="#"><img alt="" src="../../Aset/image/header4.jpg" width="300vw" style="object-fit: cover "></a>
              </div>
              <div class="col d-flex justify-content-center ">
                <a  href="#"><img alt="" src="../../Aset/image/header4.jpg" width="300vw" style="object-fit: cover "></a>
              </div>
              
   
            </div>          
          </div>
          <div class="carousel-item">
            <div class="row ">
              
              <div class="col d-flex justify-content-center ">
                <a  href="#"><img alt="" src="../../Aset/image/header4.jpg" width="300vw" style="object-fit: cover "></a>
              </div>
              <div class="col d-flex justify-content-center">
                <a  href="#"><img alt="" src="../../Aset/image/header4.jpg" width="300vw" style="object-fit: cover "></a>
              </div>
              <div class="col d-flex justify-content-center ">
                <a  href="#"><img alt="" src="../../Aset/image/header4.jpg" width="300vw" style="object-fit: cover "></a>
              </div>
              
   
            </div>           
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
     </div>
     
     </div>
    {{-- <div class="tes" style="height: 100vh; background-image:url('/Aset/image/cover.jpg'); object-fit:cover;">
      <h1 class="p-5 fw-bold" style="color: white"> About Us </h1>
    </div> --}}
     @endsection
