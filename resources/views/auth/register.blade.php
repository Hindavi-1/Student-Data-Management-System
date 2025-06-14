<HTML>
    <Head>
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
        <style>
            .login-container{
                background:#055c9d;
            }
            h2{
                color:white;
            }
            label{
                color:whitesmoke;
            }
            input,select{
                background-color:white ;
            }
        </style>
    </Head>
    <div id="clgName">
        <div id="clgLogo">
            <img src="https://fcrit.ac.in/img/fcritlogo.png" alt="College Logo">
        </div>
        <div id="mainHeading">
            <h1>Fr. C. Rodrigues Institute of Technology</h1>
        </div>
    </div>

    <div class="login-container">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <h2>Register</h2>

            <!-- Name -->
 

            <!-- Username -->
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="name" name="name" placeholder="Enter your Username" value="{{ old('name') }}" required>
                @if ($errors->has('name'))
                    <div class="error-message">{{ $errors->first('name') }}</div>
                @endif
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your Email" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                    <div class="error-message">{{ $errors->first('email') }}</div>
                @endif
            </div>

            <!-- Branch -->
            <div class="form-group">
                <label for="branch">Branch</label>
                <select id="branch" name="branch" required>
                    <option value="" disabled selected>Select your Branch</option>
                    <option value="IT">Information Technology</option>
                    <option value="CO">Computer</option>
                    <option value="EXTC">EXTC</option>
                    <option value="MECH">Mechanical Engineering</option>
                    <option value="Electrical">Electrical</option>

                </select>
                @if ($errors->has('branch'))
                    <div class="error-message">{{ $errors->first('branch') }}</div>
                @endif
            </div>

            <!-- Division -->
            <div class="form-group">
                <label for="division">Division</label>
                <select id="division" name="division" required>
                    <option value="" disabled selected>Select your Division</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                </select>
                @if ($errors->has('division'))
                    <div class="error-message">{{ $errors->first('division') }}</div>
                @endif
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your Password" required autocomplete="new-password">
                @if ($errors->has('password'))
                    <div class="error-message">{{ $errors->first('password') }}</div>
                @endif
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm your Password" required autocomplete="new-password">
                @if ($errors->has('password_confirmation'))
                    <div class="error-message">{{ $errors->first('password_confirmation') }}</div>
                @endif
            </div>

            <!-- Buttons -->
            <a  href="{{ route('login') }}"  style="color:red"> Already registered?</a>
            <button type="submit" class="btn-register" >Register</button>
        </form>
    </div>

    <script src="{{ asset('js/login.js') }}"></script>
</HTML>
