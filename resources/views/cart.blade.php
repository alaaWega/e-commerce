@extends('partials.layouts')
@section('title', 'Cart')
@section('content')
<div class="breadcrumbs">
    <div class="breadcrumbs-container container">
        <div>
            <a href="{{ url('/') }}">Home</a>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <span>Shoping Cart</span>
        </div>
        <div>
            <div class="aa-input-container" id="aa-input-container">
                <input
                    type="search"
                    id="aa-search-input"
                    class="aa-input-search"
                    placeholder="Search with algolia..."
                    name="search"
                    autocomplete="off"
                />
                <svg class="aa-input-icon" viewBox="654 -372 1664 1664">
                    <path
                        d="M1806,332c0-123.3-43.8-228.8-131.5-316.5C1586.8-72.2,1481.3-116,1358-116s-228.8,43.8-316.5,131.5  C953.8,103.2,910,208.7,910,332s43.8,228.8,131.5,316.5C1129.2,736.2,1234.7,780,1358,780s228.8-43.8,316.5-131.5  C1762.2,560.8,1806,455.3,1806,332z M2318,1164c0,34.7-12.7,64.7-38,90s-55.3,38-90,38c-36,0-66-12.7-90-38l-343-342  c-119.3,82.7-252.3,124-399,124c-95.3,0-186.5-18.5-273.5-55.5s-162-87-225-150s-113-138-150-225S654,427.3,654,332  s18.5-186.5,55.5-273.5s87-162,150-225s138-113,225-150S1262.7-372,1358-372s186.5,18.5,273.5,55.5s162,87,225,150s113,138,150,225  S2062,236.7,2062,332c0,146.7-41.3,279.7-124,399l343,343C2305.7,1098.7,2318,1128.7,2318,1164z"
                    />
                </svg>
            </div>

            <form
                action="https://laravelecommerceexample.ca/search"
                method="GET"
                class="search-form"
            >
                <i class="fa fa-search search-icon"></i>
                <input
                    type="text"
                    name="query"
                    id="query"
                    value=""
                    class="search-box"
                    placeholder="Search for product"
                    required
                />
            </form>
        </div>
    </div>
</div>
<!-- end breadcrumbs -->
<div class="cart-section container">
    <div>
        @if (session()->has('success_message'))
        <div class="alert alert-success">
            {{ session()->get('success_message') }}
        </div>
        @endif @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if (Cart::instance('default')->count())
        <h2>{{ Cart::instance('default')->count() }} item(s) in Shopping Cart</h2>
        <div class="cart-table">
            @foreach (Cart::instance('default')->content() as $item)
            <div class="cart-table-row">
                <div class="cart-table-row-left">
                    <a href="{{ url('/product-details', $item->model->slug) }}"><img
                            src="{{ asset('/assets/storage/products/dummy/'.$item->model->slug.'.jpg')}}" alt="item" class="cart-table-img"/></a>
                    <div class="cart-item-details">
                        <div class="cart-table-item">
                            <a href="{{ url('/product-details', $item->model->slug) }}">{{ $item->model->name }}</a>
                        </div>
                        <div class="cart-table-description">
                            {{ $item->model->details }}
                        </div>
                    </div>
                </div>
                <div class="cart-table-row-right">
                    <div class="cart-table-actions">
                        <form action="{{ url('/removeCartItem',$item->rowId) }}" method="POST">
                            @csrf
                            {{ method_field('DELETE') }}
                            <button type="submit" class="cart-options">
                                Remove
                            </button>
                        </form>

                        <form action="{{ url('/saveForLater',$item->rowId) }}" method="POST">
                            @csrf
                            <button type="submit" class="cart-options">
                                Save for Later
                            </button>
                        </form>
                    </div>
                    <div>
                        <select class="quantity" data-id="027c91341fd5cf4d2579b49c4b6a90da" data-productquantity="10">
                            <option selected="">1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                    <div>{{ changePriceFormat($item->model->price) }}</div>
                </div>
            </div>
            <!-- end cart-table-row -->
            @endforeach
        </div>
        <a href="#" class="have-code">Have a Code?</a>

        <div class="have-code-container">
            <form action="" method="POST">
                @csrf
                <input type="text" name="coupon_code" id="coupon_code">
                <button type="submit" class="button button-plain">Apply</button>
            </form>
        </div> <!-- end have-code-container -->
            <div class="cart-totals">
                <div class="cart-totals-left">
                    Shipping is free because we’re awesome like that. Also because that’s additional stuff I don’t feel like figuring out :).
                </div>

                <div class="cart-totals-right">
                    <div>
                        Subtotal <br>
                        Tax ({{ config('cart.tax') }}%)<br>
                        <span class="cart-totals-total">Total</span>
                    </div>
                    <div class="cart-totals-subtotal">
                        {{ changePriceFormat(Cart::instance('default')->subtotal()) }} <br>
                        {{ changePriceFormat(Cart::instance('default')->tax()) }} <br>
                        <span class="cart-totals-total">{{ changePriceFormat(Cart::instance('default')->total()) }}</span>
                    </div>
                </div>
            </div>

        <div class="cart-buttons">
            <a href="{{ url('shop') }}" class="button">Continue Shopping</a>
            <a href="" class="button-primary">Proceed to Checkout</a>
        </div>
        @else
            <h3>No items in Cart!</h3>
            <div class="spacer"></div>
            <a href="{{ url('/shop') }}" class="button">Continue Shopping</a>
            <div class="spacer"></div>
        @endif

         @if(Cart::instance('saveForLater')->count())
        <h2>{{ Cart::instance('saveForLater')->count() }} item(s) Saved For Later</h2>
        <div class="saved-for-later cart-table">
            @foreach (Cart::instance('saveForLater')->content() as $item)
                <div class="cart-table-row">
                    <div class="cart-table-row-left">
                        <a href="{{ url('/product-details', $item->model->slug) }}"><img src="{{ asset('/assets/storage/products/dummy/'.$item->model->slug.'.jpg')}}" alt="item" class="cart-table-img"></a>
                        <div class="cart-item-details">
                            <div class="cart-table-item"><a href="{{ url('/product-details', $item->model->slug) }}">{{ $item->model->name }}</a></div>
                            <div class="cart-table-description">{{ $item->model->details }}</div>
                        </div>
                    </div>
                    <div class="cart-table-row-right">
                        <div class="cart-table-actions">
                            <form action="{{ url('/removeSaveForLaterItem',$item->rowId) }}" method="POST">
                                @csrf
                                {{ method_field('DELETE') }}

                                <button type="submit" class="cart-options">Remove</button>
                            </form>

                            <form action="{{ url('/moveToCart',$item->rowId) }}" method="POST">
                                @csrf
                                <button type="submit" class="cart-options">Move to Cart</button>
                            </form>
                        </div>

                        <div>{{ changePriceFormat($item->model->price) }}</div>
                    </div>
                </div> <!-- end cart-table-row -->
            @endforeach
        </div>
        @else
            <h3>You have no items Saved for Later.</h3>
        @endif
    </div>
</div>
<!-- end cart-section -->

@include('partials.might-also-like') @endsection
