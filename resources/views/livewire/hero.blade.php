<div>
    <!-- Hero Section Begin -->
    <section @class(['hero', 'hero-normal' => ($home==0)])>
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <div class="hero__categories">
              <div class="hero__categories__all">
                <i class="fa fa-bars"></i>
                <span>All departments</span>
              </div>
              <ul>
                  @foreach ($nhomsanpham as $nsp )
                  <li><a href="#">{{$nsp->ten}}</a></li>
                  @endforeach
              </ul>
            </div>
          </div>
          <div class="col-lg-9">
            @livewire('header-search-component')
            @if ($home==1)
            <div class="hero__item set-bg" data-setbg="{{url('site')}}/img/hero/banner.jpg">
              <div class="hero__text">
                <span>FRUIT FRESH</span>
                <h2>Vegetable <br />100% Organic</h2>
                <p>Free Pickup and Delivery Available</p>
                <a href="#" class="primary-btn">SHOP NOW</a>
              </div>
            </div>
          </div>
          @endif

        </div>
      </div>
    </section>
    <!-- Hero Section End -->

  </div>
