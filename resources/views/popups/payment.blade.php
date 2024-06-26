<div class="popup payWrapper hidden">
    <div class="payCard">
        <div class="close-payWrapper">
            <img src="{{ asset('assets/img/Close.svg') }}" alt="" />
        </div>

        <div class="left">
            <div class="top">
                <img src="{{ asset('assets/img/Logo.svg') }}" alt="" />
                <p class="title">Real Estate<span>Colleague</span></p>
            </div>
            <p class="text-top">
                {{ $content['payment_title_1'] ?? '' }}
            </p>
            <div class="user-info">
                <p class="email text" id="userMail">{{ Auth::user()->email ?? '' }}</p>
                <p class="logout">
                    <a class="text" href="{{ route('auth.logout') }}">logout</a>
                </p>
            </div>

            <div class="pay-method">
                <div class="text">Accepted cards:</div>
                <ul class="pay-list">
                    <li class="pay-item" style="padding: 1px 10px;">
                        <img src="{{ asset('assets/img/discover.png') }}" alt="" />
                    </li>
                    <li class="pay-item">
                        <img src="{{ asset('assets/img/visa.svg') }}" alt="" />
                    </li>
                    <li class="pay-item">
                        <img src="{{ asset('assets/img/mastercard.svg') }}" alt="" />
                    </li>
                    <li class="pay-item">
                        <img src="{{ asset('assets/img/american-express.svg') }}" alt="" />
                    </li>
                </ul>
            </div>
            <div class="tabs">
                <div class="tabs__item open" data-tab="coupon">
                    Coupon Code
                </div>
                <div class="tabs__item" data-tab="pay">
                    Credit Card
                </div>
            </div>

            <div class="tabs-content">
                <div class="tabs-content__item" data-tab-content="pay">
                    <div class="pay-form">
                        
                        <form action="{{ route('payment.subscribe') }}" method="POST" id="pay-form">
        
                            <div id="card-element"></div>
        
                            <input id="card-holder-name" type="text" placeholder="Card holder name">
        
                            <div class="terms">
                                <input type="checkbox" id="terms" name="terms" required />
                                <label for="terms">
                                    I accept the
                                    <span class="termsService">
                                        Terms of Service
                                    </span>
                                </label>
                            </div>
        
                            <button 
                                class="btn"
                                id="card-button" 
                                data-secret="{{ Auth::check() ? Auth::user()->createSetupIntent()->client_secret : null }}">
                                Pay
                            </button>
        
                        </form>
                        
                        <script src="https://js.stripe.com/v3/"></script>
                        
                        <script>
                            const stripe = Stripe('<?php echo env('STRIPE_KEY') ?>')

                            const elements = stripe.elements()
                            const cardElement = elements.create(
                                'card',
                                { 
                                    style: { 
                                        base: {
                                            lineHeight: '3',
                                            backgroundColor: '#eee',
                                        },
                                    },
                                }
                            )
                            cardElement.mount('#card-element')

                            const payForm = document.getElementById('pay-form')
                            let setupIntent = null, 
                                    error = null
                            payForm.addEventListener('submit', async e => {
                                e.preventDefault();

                                const tabContent = $('[data-tab-content=pay]')
                                tabContent.addClass('loading')

                                const clientSecret = $('#card-button').attr('data-secret')
                                const cardHolderName = $('#card-holder-name')
            
                                if (! setupIntent) {
                                    const res = await stripe.confirmCardSetup(
                                        clientSecret, 
                                        {
                                            payment_method: {
                                                card: cardElement,
                                                billing_details: {
                                                    name: cardHolderName.val(),
                                                },
                                            },
                                        }
                                    )
                                    setupIntent = res.setupIntent
                                    error = res.error
                                }

                                if (error) {
                                    tabContent.removeClass('loading')
                                } else {
                                    $.post('/payment/subscribe', {
                                        payment_method_id: setupIntent.payment_method,
                                        _token: '<?php echo csrf_token() ?>',
                                    }).done(res => {
                                        location.href = '/chat'
                                    }).fail(xhr => {
                                        const res = JSON.parse(xhr.responseText)
                                        if (res.error) {
                                            alert(res.error)
                                        } else {
                                            alert('Something goes wrong. Try again.')
                                        }
                                        
                                        tabContent.removeClass('loading')
                                    })
                                }
                            })
                        </script>
        
                    </div>
                </div>
                <div class="tabs-content__item open" data-tab-content="coupon">
                    <div class="coupon-form">
                        
                        <form action="{{ route('coupons.apply') }}" method="POST" id="coupon-form">
        
                            <div class="coupon">
                                <input id="coupon" type="text" placeholder="Enter coupon for trial period">
                            </div>
        
                            <div class="terms">
                                <input type="checkbox" id="terms" name="terms" required />
                                <label for="terms">
                                    I accept the
                                    <span class="termsService">
                                        Terms of Service
                                    </span>
                                </label>
                            </div>
        
                            <button 
                                class="btn"
                                id="coupon-button">
                                Apply
                            </button>
        
                        </form>
                                                
                        <script>
                            const couponForm = document.getElementById('coupon-form')
                            couponForm.addEventListener('submit', async e => {
                                e.preventDefault();

                                const tabContent = $('[data-tab-content=coupon]')

                                tabContent.addClass('loading')

                                $.post('/coupons/apply', {
                                    _token: '<?php echo csrf_token() ?>',
                                    coupon: $('#coupon').val(),
                                }).done(res => {
                                    location.href = '/chat'
                                }).fail(xhr => {
                                    const res = JSON.parse(xhr.responseText)
                                    if (res.error) {
                                        alert(res.error)
                                    } else {
                                        alert('Something goes wrong. Try again.')
                                    }
                                    
                                    tabContent.removeClass('loading')
                                })
                            })
                        </script>
        
                    </div>
                </div>
            </div>
        
        </div>

        <div class="right">
            <p class="text top">
                {{ $content['payment_title_2'] ?? '' }}
            </p>
            <ul class="info-list">
                <li class="info-item price">
                    <p class="text">Price</p>
                    <p class="sum info">{{ $content['payment_price'] ?? '' }}</p>
                </li>
                <li class="info-item period">
                    <p class="text">Billing period</p>
                    <p class="per info">{{ $content['payment_period'] ?? '' }}</p>
                </li>
                <li class="info-item date">
                    <p class="text">Starting date</p>
                    <p class="info" id="current_date">
                        <?php echo date('M d, Y') ?>
                    </p>
                </li>
            </ul>
            <ul class="includes-list">

                @foreach ($content['payment_features'] ?? [] as $paymentFeature)
                    <li class="includes-item">
                        <img src="{{ asset('assets/img/done.svg') }}" alt="" />
                        <p class="card-title">{{ $paymentFeature['title'] }}</p>
                        <p class="text">
                            {{ $paymentFeature['text'] }}
                        </p>
                    </li>
                @endforeach

            </ul>
        </div>
    </div>
</div>