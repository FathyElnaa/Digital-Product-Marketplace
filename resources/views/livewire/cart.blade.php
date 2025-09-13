<div class="cart-products">

    @php
        $total = 0;
    @endphp
    <ul class="nav__list list-unstyled">
        @forelse($cartItems as $item)
            @php
                $total += $item->product->price;
            @endphp
            <li class="cart-products__item d-flex justify-content-between gap-2">
                <div class="d-flex gap-2">
                    <div>

                        <button wire:click="remove({{ $item->product->id }})" class="cart-products__remove">x</button>

                    </div>
                    <div>
                        <p class="cart-products__name m-0 fw-bolder">{{ $item->product->title }}</p>
                        <p class="cart-products__price m-0">{{ $item->product->price }} جنيه</p>
                    </div>
                </div>
                <div class="cart-products__img">
                    <img class="w-100" src="{{ asset('storage/' . $item->product->thumbnail) }}" alt="">
                </div>
            </li>
        @empty
            <p>لا توجد منتجات في سلة المشتريات.</p>
        @endforelse

    </ul>
    <div class="d-flex justify-content-between">
        <p class="fw-bolder">المجموع:</p>
        <p>{{ $total }} جنيه</p>
    </div>
</div>
