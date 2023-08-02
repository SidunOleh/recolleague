<div class="popup signInWrapper hidden">
    <div class="signIn-card">
        <div class="close-signInWrapper">
            <img src="{{ asset('assets/img/Close.svg') }}" alt="" />
        </div>
        <p class="section-title">sign in</p>
        <div class="sign-with-card">
            <div class="google sign-with">
                <img src="{{ asset('assets/img/Google.svg') }}" alt="" />
                <p>
                    <a class="text" href="{{ route('oauth.redirect', ['provider' => 'google']) }}">
                        Sign in with Google
                    </a>
                </p>
            </div>
            <!--<div class="facebook sign-with">-->
            <!--    <img src="{{ asset('assets/img/Facebook.svg') }}" alt="" />-->
            <!--    <p>-->
            <!--        <a class="text" href="{{ route('oauth.redirect', ['provider' => 'facebook']) }}">Sign in with Facebook</a>-->
            <!--    </p>-->
            <!--</div>-->
        </div>
        <form action="{{ route('auth.sign-in') }}" method="POST" id="signin-form">
            @csrf
            <input type="email" name="email" placeholder="E-mail" required />

            <label class="password">
            <input
              id="password-field"
              type="password"
              class="form-control"
              name="password"
              placeholder="Password"
              required
            />
            <span
              toggle="#password-field"
              class="fa fa-fw fa-eye field-icon toggle-password"
            >
            </span>
          </label>
            <p class="forgot text">
                Forgot password?
            </p>
            <button class="btn" type="submit">Sign in</button>
        </form>
        <p class="text ask-signUp">
            Don't have an account?
            <span class="sign-up" style="background-color: #fff">Sign up</span>
        </p>
    </div>
</div>