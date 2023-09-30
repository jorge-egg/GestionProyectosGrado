<style>

    .swiper-slide {
      text-align: center;
      font-size: 18px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .swiper-slide img {
      display: block;
      /* width: 100%;
      height: 100%; */
      object-fit: cover;
    }

    .autoplay-progress {
      position: absolute;
      right: 16px;
      bottom: 16px;
      z-index: 10;
      width: 48px;
      height: 48px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      color: var(--black-color);
    }

    .autoplay-progress svg {
      --progress: 0;
      position: absolute;
      left: 0;
      top: 0px;
      z-index: 10;
      width: 100%;
      height: 100%;
      stroke-width: 4px;
      stroke: var(--secondary-color);
      fill: none;
      stroke-dashoffset: calc(125.6 * (1 - var(--progress)));
      stroke-dasharray: 125.6;
      transform: rotate(-90deg);
    }

    .swiper-pagination-bullet {
      width: 12px;
      height: 12px;
      background: var(--secondary-color);
    }

</style>

<div class="swiper mySwiper col-sm-12 col-md-6">
    <div class="swiper-wrapper">

        <div class="swiper-slide">
            <img src="{{ asset('imgs/logos/slider1.png') }}" alt="SliderImage" width="340" class="img-fluid">
        </div>

        <div class="swiper-slide">
            <img src="{{ asset('imgs/logos/slider2.png') }}" alt="SliderImage" width="340" class="img-fluid">
        </div>

        <div class="swiper-slide">
            <img src="{{ asset('imgs/logos/slider3.png') }}" alt="SliderImage" width="340" class="img-fluid">
        </div>

        <div class="swiper-slide">
            <img src="{{ asset('imgs/logos/slider4.png') }}" alt="SliderImage" width="340" class="img-fluid">
        </div>

        <div class="swiper-slide">
            <img src="{{ asset('imgs/logos/slider5.png') }}" alt="SliderImage" width="340" class="img-fluid">
        </div>

        <div class="swiper-slide">
            <img src="{{ asset('imgs/logos/slider6.png') }}" alt="SliderImage" width="340" class="img-fluid">
        </div>

    </div>

    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>

    <div class="autoplay-progress">
      <svg viewBox="0 0 48 48">
        <circle cx="24" cy="24" r="20"></circle>
      </svg>
      <span></span>
    </div>

</div>

<script>
    const progressCircle = document.querySelector(".autoplay-progress svg");
    const progressContent = document.querySelector(".autoplay-progress span");
    let swiper = new Swiper(".mySwiper", {
      spaceBetween: 30,
      centeredSlides: true,
      autoplay: {
        delay: 2500,
        disableOnInteraction: false
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
      },
      on: {
        autoplayTimeLeft(s, time, progress) {
          progressCircle.style.setProperty("--progress", 1 - progress);
          progressContent.textContent = `${Math.ceil(time / 1000)}s`;
        }
      }
    });
  </script>