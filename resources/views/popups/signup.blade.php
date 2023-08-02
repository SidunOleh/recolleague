<div class="popup signUpWrapper hidden">
    <div class="signUp-card">
        <div class="close-signUpWrapper">
            <img src="{{ asset('assets/img/Close.svg') }}" alt="" />
        </div>
        <p class="section-title">sign up</p>
        <div class="sign-with-card">
            <div class="google sign-with">
                <img src="{{ asset('assets/img/Google.svg') }}" alt="" />
                <p>
                    <a class="text" href="{{ route('oauth.redirect', ['provider' => 'google']) }}">
                        Sign up with Google
                    </a>    
                </p>
            </div>
            <!--<div class="facebook sign-with">-->
            <!--    <img src="{{ asset('assets/img/Facebook.svg') }}" alt="" />-->
            <!--    <p>-->
            <!--        <a class="text" href="{{ route('oauth.redirect', ['provider' => 'facebook']) }}">-->
            <!--            Sign up with Facebook-->
            <!--        </a> -->
            <!--    </p>-->
            <!--</div>-->
        </div>
        <form action="{{ route('auth.sign-up') }}" method="POST" id="signup-form">
            @csrf
            <input type="text" name="name" id="name" placeholder="Name" required />
            <input type="email" name="email" id="emailIN" placeholder="E-mail" required />
            <label class="password">
                <input
                id="password"
                type="password"
                name="password"
                placeholder="Password"
                required
                />
                <span
                toggle="#password"
                class="fa fa-fw fa-eye field-icon toggle-password"
                >
                </span>
           </label>
           <label class="password">
                <input
                id="password-confirm"
                type="password"
                name="password_confirmation"
                placeholder="Repeat password"
                required
                />
                <span
                toggle="#password-confirm"
                class="fa fa-fw fa-eye field-icon toggle-password"
                >
                </span>
           </label>
            <button class="btn" type="submit">Sign up</button>
        </form>
        <p class="text ask-signUp">
            Have an account?
            <span class="sign-in" style="background-color: #fff">Sign in</span>
        </p>
    </div>
</div>