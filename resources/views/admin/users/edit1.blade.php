<div class="form-group">
                <label for="name">First Name:</label>
                <input type="text" name="firstname" placeholder="firstname" id="firstname" value="{{$user->firstname}}" class="form-control">
            </div>

            <div class="form-group">
                <label for="name">Last Name:</label>
                <input type="text" name="lastname" placeholder="lastname" id="lastname" value="{{$user->lastname}}" class="form-control">
            </div>

            <div class="form-group">
                <label for="email">Login Name:</label>
                <input type="text" name="login_name" placeholder="login_name" id="login_name" value="{{$user->login_name}}" class="form-control" readonly>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" placeholder="Password" id="password" class="form-control">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" name="password_confirmation" placeholder="Confirm Password" id="password_confirmation" class="form-control">
            </div>
            <div class="form-group">
                <label for="address">Role:</label>
                Admin <input type="radio" name="role" value="1" {{$user->role ? "checked" : null}} />
                NormalUser <input type="radio" name="role" value="0" {{$user->role ? null : "checked"}}/>
                </div>