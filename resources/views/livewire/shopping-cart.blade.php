<div>

    <section class="shoping-cart spad">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="shoping__cart__table">
              <table>
                <thead>
                  <tr>
                    <th class="shoping__product">Products</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>

                  @foreach ($items as $item )

                  <tr>
                    <td class="shoping__cart__item">
                      <img src="{{url('thumbs')}}/{{App\Models\Sanpham::find($item->p_id)->anh}}" alt="" height="100px" width="75px">
                      <h5>{{$item->name}} {{strtolower($item->color)}} size {{$item->size}}</h5>
                    </td>
                    <td class="shoping__cart__price">
                      {{number_format($item->price,0)}}đ
                    </td>
                    <td class="shoping__cart__quantity">
                      <div class="quantity">
                        <div class="pro-qty">
                          <span class="dec qtybtn" wire:click="quantityreduce('{{$item->rowId}}')">-</span>
                          <input type="text" value="{{$item->qty}}"
                            wire:change.prevent="quantitychange('{{$item->rowId}}',$event.target.value)">
                          <span class="inc qtybtn" wire:click="quantityincrease('{{$item->rowId}}')">+</span>
                        </div>
                      </div>
                    </td>
                    <td class="shoping__cart__total">
                      {{number_format($item->subtotal(0),0)}}đ
                    </td>
                    <td class="shoping__cart__item__close">
                      <span class="icon_close" wire:click.prevent="delete('{{$item->rowId}}')"></span>
                    </td>
                  </tr>

                  @endforeach

                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="shoping__cart__btns">
              <a href="{{route('shop')}}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
              <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                Update Cart</a>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="shoping__continue">
              <div class="shoping__discount">
                <h5>Discount Codes</h5>
                <form action="#">
                  <input type="text" placeholder="Enter your coupon code">
                  <button type="submit" class="site-btn">APPLY COUPON</button>
                </form>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="shoping__checkout">
              <h5>Cart Total</h5>
              <ul>

                <li>Subtotal <span>{{number_format(Cart::subtotal(0),0)}}đ</span></li>
                <li>Tax <span>{{number_format(Cart::tax(0),0)}}đ</span></li>
                <li>Total <span>{{number_format(Cart::total(0),0)}}đ</span></li>
              </ul>
              <a href="{{route('checkout')}}" class="primary-btn">PROCEED TO CHECKOUT</a>
              {{-- chuasua --}}
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>
