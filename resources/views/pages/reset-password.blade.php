<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Rest password | REC</title>
    <link rel="icon" type="image/png" href="/favicon.png">
    
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap"
      rel="stylesheet"/>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
    
</head>
<body>

    <div class="wrapper">

        <div class="resetPasswordWrapper">
            <div class="resetPassword-card">
                <p class="section-title">update password</p>
                <form action="{{ route('password.update') }}" method="POST" id="reset-password">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="email" name="email" placeholder="E-mail" required />
                    <label class="password">
                        <input
                        id="password-field"
                        type="password"
                        class="form-control"
                        name="password"
                        placeholder="New password"
                        required
                        />
                        <span
                        toggle="#password-field"
                        class="fa fa-fw fa-eye field-icon toggle-password"
                        >
                        </span>
                    </label>
                    <label class="password">
                        <input
                        id="password-confirmation-field"
                        type="password"
                        class="form-control"
                        name="password_confirmation"
                        placeholder="Repeat password"
                        required
                        />
                        <span
                        toggle="#password-confirmation-field"
                        class="fa fa-fw fa-eye field-icon toggle-password"
                        >
                        </span>
                    </label>
                    
                    <button class="btn" type="submit">Update</button>
                </form>
            </div>
        </div>
    
    </div>
        
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script>
    $('.toggle-password').click(function() {
        $(this).toggleClass('fa-eye fa-eye-slash')
        var input = $($(this).attr('toggle'))
        if (input.attr('type') == 'password') {
            input.attr('type', 'text')
        } else {
            input.attr('type', 'password')
        }
    })

    $('#reset-password').submit(function (e) {
        e.preventDefault()

        const form = $(this)
        const formUrl = form.attr('action')
        const formData = form.serialize()

        $.post(formUrl, formData)
            .done(res => {
                location.href = '/#sign-in'
            })
            .fail(res => {
                const errors =
                    res.responseJSON.errors
                alert(errors[Object.keys(errors)[0]][0])
            })
    })
</script>
</body>
</html>