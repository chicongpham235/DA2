<section class="product-details spad">
    <div class="container">
        <div class="">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if (Session::has('alert-' . $msg))
                    <div class="alert alert-{{ $msg }} alert-dismissible fade show ">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ Session::get('alert-' . $msg) }}
                    </div>
                @endif
            @endforeach
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large"
                            src="{{ url('uploads') }}/{{ $product->anh }}"></img>
                        {{-- <img class="product__details__pic__item--large"
                            src="img/product/details/{{$product->anh}}" alt=""> --}}
                    </div>
                    <div class="product__details__pic__slider owl-carousel">
                        @foreach ($images as $data)
                            <img src="{{url('uploads') }}/{{$data}}" alt=""></img>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">

                <div class="product__details__text">
                    <h3>{{$product->ten}}</h3>
                    <hr>
                    @if ($product->giaban == NULL )
                        <div class="product__details__price" style="color:#646060">{{number_format($product->gia,0)}}đ</div>
                    @else
                        <div class="product__details__price" style="color:#646060">{{number_format($product->giaban,0)}}đ</div>
                        <span><del class="font-weight-light">{{number_format($product->gia,0)}}đ</del></span>
                    @endif
                    <hr>
                    <div>
                        {!!$product->mota!!}
                    </div>
                    <hr>
                    <div class="color">
                        <label><b>Màu sắc:</b></label>
                        <br>
                        <select name="color2" id="color2" class="form-control" wire:model="color2">
                        <option value="" selected disabled>Select Color</option>
                        @foreach ($color as $cl)
                            {{-- <option value={{App\Models\Color::where('id',$cl->color_id)->select('id','color')->first()->id}}>
                                {{App\Models\Color::where('id',$cl->color_id)->select('id','color')->first()->color}}
                            </option> --}}
                            <option value={{$cl->color_id}}>{{$cl->color}}</option>
                        @endforeach
                        </select>
                    </div>
                    <hr>
                    <div class="size">
                        <label><b>Kích thước:</b></label>
                        <br>
                        <select name="size2" id="size2" class="form-control" wire:model="size2">
                            <option value="" selected disabled>Select Size</option>
                            @foreach ($size as $s)"
                            {{-- <option value={{App\Models\Size::where('id',$s->size_id)->select('id','size')->first()->size}}>
                                {{App\Models\Size::where('id',$s->size_id)->select('id','size')->first()->size}}</option> --}}
                                <option value={{$s->size_id}}>{{$s->size}}</option>
                            @endforeach

                        </select>
                    </div>
                    <hr>
                    <br>
                    {{-- <div class="product__details__price">{{number_format($product->gia,0)}}</div> --}}
                    <div class="product__details__quantity">
                        <div class="quantity">
                            <label><b>Số lượng</b></label>
                            <div class="pro-qty">
                                <input type="number" value="1" id="qty" name="qty" wire:model="qty">
                            </div>
                        </div>
                    </div>
                    {{-- {{App\Models\Color::where('id',$color2)->select('id','color')->first()->color}} --}}
                    {{-- @php
                        $count=count($size)*count($color)
                    @endphp --}}
                    {{-- {{$count*$color2}} --}}
                    {{-- {{App\Models\Size::where('id',$size2)->select('id','size')->first()->size}} --}}
                    @if ($product->giaban== NULL )
                        <a href="#"
                        wire:click.prevent="store({{ $product->id * $color2 * $size2 + 999 * $color2 * $size2 }}, {{$product->id}}, '{{ $product->ten }}','{{App\Models\Size::where('id',$size2)->select('id','size')->first()->size}}', '{{App\Models\Color::where('id',$color2)->select('id','color')->first()->color}}', {{$qty}}, {{ $product->gia }})"
                        class="primary-btn">ADD TO CARD</a>
                    <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>

                    @else
                        <a href="#"
                        wire:click.prevent="store({{ $product->id * $color2 * $size2 + 999 * $color2 * $size2 }}, {{$product->id}}, '{{ $product->ten }}','{{App\Models\Size::where('id',$size2)->select('id','size')->first()->size}}', '{{App\Models\Color::where('id',$color2)->select('id','color')->first()->color}}', {{$qty}}, {{ $product->giaban }})"
                        class="primary-btn">ADD TO CARD</a>
                    <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                    @endif
                    {{-- <a href="#"
                        wire:click.prevent="store({{ $product->id }},'{{ $product->ten }}', {{ $product->gia }})"
                        class="primary-btn">ADD TO CARD</a>
                    <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a> --}}

                    <ul>
                        <li><b>Availability</b> <span>bIn Stock</span></li>
                        <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                        <li><b>Weight</b> <span>0.5 kg</span></li>
                        <li><b>Share on</b>
                            <div class="share">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-12" wire:ignore>
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                aria-selected="true">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                aria-selected="false">Information</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>Products Infomation</h6>
                                {!! $product->mota !!}
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>Products Infomation</h6>
                                <div class="container mt-5 mb-5">

                                    <div class="d-flex justify-content-center row">
                                        <div class="d-flex flex-column col-md-8">

                                            <div class="coment-bottom bg-white p-2 px-4">
                                                <div class="d-flex flex-row add-comment-section mt-4 mb-4">
                                                    <div id="rateYo"> </div>
                                                    <img class="img-fluid img-responsive rounded-circle mr-2"
                                                        src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg"
                                                        width="38">
                                                    <input type="text" class="form-control mr-3" wire:model='comment'
                                                        placeholder="Add comment">
                                                    <button class="btn btn-primary" type="button"
                                                        wire:click.prevent='danhgia()'>Comment</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>Products Infomation thông tin sản phấm </h6>
                                <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                    Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                    Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                    sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                    eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                    Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                    sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                    diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                    ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                    Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                    Proin eget tortor risus.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($related_product as $data )
                <div class="col-lg-3 col-md-4 col-sm-6">

                    <div class="product__item">

                        <div class="product__item__pic">

                            <img src="{{url('uploads')}}/{{$data->anh}}"></img>


                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>

                        <div class="product__item__text">
                            <h6><a href="#">{{$data->ten}}</a></h6>
                            @if ($data->giaban==NULL)
                                <h5>{{number_format($data->gia)}}đ</h5>
                            @else
                                <h5>{{number_format($data->giaban)}}đ</h5>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->



