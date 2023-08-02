<div class="changePayWrapper hidden">
    <div class="payCard">
        <div class="close-changePayWrapper">
            <img src="{{ asset('assets/img/Close.svg') }}" alt="" />
        </div>
        <div class="left">
            <div class="top">
                <img src="{{ asset('assets/img/Logo.svg') }}" alt="" />
                <p class="title">Real Estate<span>Colleague</span></p>
            </div>
            <p class="text-top">
                {{ $content[ 'payment_change_title' ] }}
            </p>
            <div class="user-info">
                <p class="email text" id="userMail">{{ Auth::user()->email }}</p>
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
            <div class="pay-form">

                <form action="{{ route('payment.update') }}" method="POST" id="change-payment-form">

                    <div id="change-payment-card-element"></div>

                    <input id="change-payment-card-holder-name" type="text" placeholder="Card holder name">

                    <div class="terms">
                        <input type="checkbox" id="change-payment-terms" name="terms" required />
                        <label for="terms">I accept the
                          <span class="termsService">Terms of Service</span>
                        </label>
                    </div>

                    <button 
                      class="btn"
                      id="change-payment-card-button" 
                      data-secret="{{ Auth::check() ? Auth::user()->createSetupIntent()->client_secret : null }}">
                        Change payment
                    </button>
                
                </form>

                <script src="https://js.stripe.com/v3/"></script>
                
                <script>
                    const changePaymentStripe = Stripe('<?php echo env('STRIPE_KEY') ?>')
                    
                    const changePaymentElements = changePaymentStripe.elements()
                    const changePaymentCard = changePaymentElements.create(
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
                    changePaymentCard.mount('#change-payment-card-element')

                    const changePaymentForm = document.getElementById('change-payment-form')
                    changePaymentForm.addEventListener('submit', async e => {
                        e.preventDefault();

                        const card = $('.payCard')
                        card.addClass('loading')

                        const clientSecret = $('#change-payment-card-button').attr('data-secret')
                        const cardHolderName = $('#change-payment-card-holder-name')
  
                        const {
                            setupIntent,
                            error
                        } = await changePaymentStripe.confirmCardSetup(
                            clientSecret, 
                            {
                                payment_method: {
                                    card: changePaymentCard,
                                    billing_details: {
                                        name: cardHolderName.val(),
                                    },
                                },
                            }
                        )

                        if (error) {
                            alert(error.message)
                            card.removeClass('loading')
                        } else {
                            $.post('/payment/update', {
                                payment_method_id: setupIntent.payment_method,
                                _token: '<?php echo csrf_token() ?>',
                            }).done(res => {
                                alert('Payment method was changed.')
                                
                                $('.changePayWrapper').addClass('hidden')
                                card.removeClass('loading')
                            }).fail(res => {
                                alert('Something goes wrong. Try again.')
                                
                                card.removeClass('loading')
                            })
                        }
                    })
                </script>
          </div>
        </div>
      </div>
    </div>
</div>