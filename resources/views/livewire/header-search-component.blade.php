<div class="hero__search">
    <div class="hero__search__form">
      <form action="{{route('product_search')}}" id="form-search-top" name="form-search-top">
        {{-- <div class="hero__search__categories">
          All Categories
          <span class="arrow_carrot-down"></span>
        </div> --}}
        <input type="text" placeholder="What do you need?" name="search" value="{{$search}}">
        <button type="submit" class="site-btn">SEARCH</button>
      </form>
    </div>
    <div class="hero__search__phone">
      <div class="hero__search__phone__icon">
        <i class="fa fa-phone"></i>
      </div>
      <div class="hero__search__phone__text">
        <h5>+65 11.188.888</h5>
        <span>support 24/7 time</span>
      </div>
    </div>
  </div>
