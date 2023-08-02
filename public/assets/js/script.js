$(document).ready(function() {

    // ajax setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    // menu
    $('.header-account').click(function() {
        $('.menu-list').toggleClass('open')
        $('.header-account').find('img').toggleClass('open')
    })

    // video 
    if (video = document.getElementById('video')) {
        const circlePlayButton = document.getElementById('circle-play-b')

        function togglePlay() {
            if (video.paused || video.ended) {
                video.play()
            } else {
                video.pause()
            }
        }

        circlePlayButton.addEventListener('click', togglePlay)
        video.addEventListener('playing', function() {
            circlePlayButton.style.opacity = 0
        })
        video.addEventListener('pause', function() {
            circlePlayButton.style.opacity = 1
        })
    }

    // toggle password
    $('.toggle-password').click(function() {
        $(this).toggleClass('fa-eye fa-eye-slash')
        var input = $($(this).attr('toggle'))
        if (input.attr('type') == 'password') {
            input.attr('type', 'text')
        } else {
            input.attr('type', 'password')
        }
    })

    // sliders
    $('.reviews-slider').slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        arrows: false,
        dots: true,
        responsive: [{
            breakpoint: 550,
            settings: {
                slidesToShow: 1,
            },
        }, ],
    })

    // chat preview
    $('#preview-chat-form').submit(function(e) {
        e.preventDefault()

        const form = $(this)
        const data = form.serialize()

        form.addClass('loading')

        $.get('/chat/preview-request', data)
            .done(res => {
                if (res.status == 302) {
                    location.href = '/chat'
                }
                $('.answer').html(`${res.response}`)
                $('.chat-prew').addClass('chat-open')
                $('.video-container').addClass('d-none')
                form.removeClass('loading')
            })
            .fail(res => {
                alert('Something goes wrong. Try again.')
                form.removeClass('loading')
            })
    })

    // chat
    $('#chat-form').submit(function(e) {
        e.preventDefault()

        const form = $(this)
        const data = form.serialize()

        $('.chat-main').addClass('loading')

        $.get('/chat/request', data)
            .done(res => {
                if (res.location) {
                    location.href = res.location
                    return
                }
                
                $('.generated-text .text')
                    .prepend(`<p class="answer">${res.response}</p>`)
                $('.chat-main .chat-container').addClass('open')
                $('.chat-main').removeClass('loading')
            })
            .fail(res => {
                alert('Something goes wrong. Try again.')
                $('.chat-main').removeClass('loading')
            })
    })

    // $('#NewdomainInput').on('input', function() {
    //     var text = $(this).val()
    //     $('#domain').val(text)
    //     $('#preview-domain').text(text)
    // })

    $('select#style').change(function(e) {
        const style = $(this).val()
        $('.style-name span').text(style)
    })

    $('#copyButton').click(function() {
        let text = $('#textBlock .answer').text()

        let tempInput = $('<input>')
        $('body').append(tempInput)

        tempInput.val(text).select()
        document.execCommand('copy')

        tempInput.remove()

        let blockToDisplay = $('#success')
        blockToDisplay.show()
        setTimeout(function() {
            blockToDisplay.hide()
        }, 2000)
    })

    // popups
    function openPopup(popup) {
        $('.popup').addClass('hidden')
        $(popup).removeClass('hidden')
    }

    function closePopup(popup) {
        $(popup).addClass('hidden')
    }

    $('.sign-in').click(() => openPopup('.signInWrapper'))
    $('.close-signInWrapper').click(() => closePopup('.signInWrapper'))
    $('.sign-up').click(() => openPopup('.signUpWrapper'))
    $('.close-signUpWrapper').click(() => closePopup('.signUpWrapper'))
    $('.menu-item.pay').click(() => openPopup('.payWrapper'))
    $('.pay-btn').click(() => openPopup('.payWrapper'))
    $('.close-payWrapper').click(() => closePopup('.payWrapper'))
    $('.menu-item.payment').click(() => openPopup('.changePayWrapper'))
    $('.close-changePayWrapper').click(() => closePopup('.changePayWrapper'))
    $('.forgot').click(() => openPopup('.forgotWrapper'))
    $('.close-forgotWrapper').click(() => closePopup('.forgotWrapper'))

    const anchor = $(location).attr('hash')
    if (anchor == '#sign-in') {
        openPopup('.signInWrapper')
    }
    if (anchor == '#pay') {
        openPopup('.payWrapper')
    }

    // signin
    $('#signin-form').submit(sendSignInForm)

    function sendSignInForm(e) {
        e.preventDefault()

        const form = $(this)
        const formUrl = form.attr('action')
        const formData = form.serialize()

        const card = form.closest('.signIn-card')
        card.addClass('loading')

        $.post(formUrl, formData)
            .done(res => {
                location.href = '/chat'
                card.removeClass('loading')
            })
            .fail(res => {
                alert('Wrong login or password. Try again.')
                card.removeClass('loading')
            })
    }

    // signup
    $('#signup-form').submit(sendSignUpForm)

    function sendSignUpForm(e) {
        e.preventDefault()

        const form = $(this)
        const formUrl = form.attr('action')
        const formData = form.serialize()

        const card = form.closest('.signUp-card')
        card.addClass('loading')

        $.post(formUrl, formData)
            .done(res => {
                $('#card-button')
                    .attr('data-secret', res.client_secret)
                openPopup('.payWrapper ')
                card.removeClass('loading')
            })
            .fail(res => {
                const errors =
                    res.responseJSON.errors
                alert(errors[Object.keys(errors)[0]][0])
                card.removeClass('loading')
            })
    }

    // send reset link
    $('#forgot-form').submit(function(e) {
        e.preventDefault()

        const form = $(this)
        const formUrl = form.attr('action')
        const formData = form.serialize()

        const card = form.closest('.forgot-card')
        card.addClass('loading')

        $.post(formUrl, formData)
            .done(res => {
                alert(res.status)
                card.removeClass('loading')
                closePopup('.forgotWrapper')
            })
            .fail(res => {
                const errors =
                    res.responseJSON.errors
                alert(errors[Object.keys(errors)[0]][0])
                card.removeClass('loading')
            })
    })

    // apply coupon
    $('#apply-coupon-btn').click(applyCoupon)

    function applyCoupon(e) {
        coupon = $('#coupon').val()
        if (!(coupon = $('#coupon').val())) {
            alert('Enter coupon.')
            return
        }

        $.post('/coupons/apply', { coupon })
            .then(res => {
                location.href = '/chat'
            })
            .catch(res => {
                alert('Coupon is invalid.')
            })
    }
})