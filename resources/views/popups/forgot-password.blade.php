<div class="popup forgotWrapper hidden">
    <div class="forgot-card">
        <div class="close-forgotWrapper">
            <img src="{{ asset('assets/img/Close.svg') }}" alt="" />
        </div>
        <p class="section-title">reset password</p>
        <form action="{{ route('password.reset-link') }}" method="POST" id="forgot-form">
            @csrf
            
            <input type="email" name="email" placeholder="E-mail" required />

            <button class="btn" type="submit">Reset</button>
        </form>
    </div>
</div>