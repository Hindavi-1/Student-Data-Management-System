<HTML>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Student Management System</title>
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    </head>

    <body>
        <!-- College Header -->
        <div id="clgName">
            <div id="clgLogo">
                <img src="https://fcrit.ac.in/img/fcritlogo.png" alt="College Logo">
            </div>
            <div id="mainHeading">
                <h1>Fr. C. Rodrigues Institute of Technology</h1>
            </div>
        </div>

        <!-- Login Form -->
        <div class="login-container">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h2>Login</h2>

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your Email" value="{{ old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                        <div class="error-message">{{ $errors->first('email') }}</div>
                    @endif
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-container">
                        <input type="password" id="password" name="password" placeholder="Enter your Password" required>
                        <span class="toggle-password" onclick="togglePasswordVisibility()">
                            <img src="{{ asset('images/show.png') }}" id="eyeIcon" alt="Show Password">
                        </span>
                    </div>
                    @if ($errors->has('password'))
                        <div class="error-message">{{ $errors->first('password') }}</div>
                    @endif
                </div>

                
                <!-- Session Status -->
                @if (session('status'))
                    <div class="session-status">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Buttons -->
                <button type="submit" class="btn-login">Login</button>
                <button type="button" class="btn-register" onclick="location.href='{{ route('register') }}'">Register</button>
            </form>
        </div>
        <script src="{{ asset('js/login.js') }}"></script>
    </body>
</HTML>
