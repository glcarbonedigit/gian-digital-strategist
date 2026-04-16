<x-guest-layout>
    <div class="auth-form-wrap">
        <h1 class="auth-title">Accedi</h1>
        <p class="auth-subtitle">Inserisci le credenziali per accedere alla dashboard.</p>

        @if (session('status'))
            <div class="auth-alert auth-alert--success">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="auth-alert auth-alert--error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="auth-form">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password">
            </div>

            <div class="auth-row">
                <label class="checkbox-inline">
                    <input type="checkbox" name="remember">
                    <span>Ricordami</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="auth-link" href="{{ route('password.request') }}">
                        Password dimenticata?
                    </a>
                @endif
            </div>

            <div class="auth-actions">
                <button type="submit" class="btn-solid">Accedi</button>
            </div>
        </form>
    </div>
</x-guest-layout>