<!-- Login window -->
<div class="login-window">
  <div class="container">
    <button class="close"><i class="fa fa-close"></i></button>
    <div class="login">
      <img class="logo" src="/public/ceek-v3/img/ceek-blue.svg" alt="Ceek logo">
      <form action="{{ route('auth.socialite.facebook.out') }}" method="GET">
        {!! Form::token() !!}
        <button class="btn-gradient connect-facebook">Connect with Facebook</button>
      </form>
      <p class="or">OR</p>
      <form class="form" action="{{ route('auth.login') }}" method="POST" id="login-form">
        {!! Form::token() !!}              
        <input type="email" placeholder="Email" name="email" class="form-control">
        <input type="password" placeholder="Password" name="password" class="form-control">
        <button class="btn-gradient" type="submit">Login</button>
        <p class="notice"><a href="password/reset">Forgotten password?</a></p>
      </form>
    </div>
    <div class="signup">
      <img class="logo" src="/public/ceek-v3/img/ceek-blue.svg" alt="Ceek logo">
      <form class="form" action="{{ route('auth.register') }}" method="POST" id="signup-form">
        {!! Form::token() !!}              
        <fieldset>
          <input type="text" placeholder="Username" name="signup-username" class="form-control" required>
          <input type="email" placeholder="Email" name="signup-email" class="form-control" required>
          <input type="password" placeholder="Password" name="signup-password" class="form-control half-width">
          <input type="password" placeholder="Confirm Password" name="signup-password_confirmation" class="form-control half-width-last">
          <div class="row">
            <select name="signup-bday-month" class="selectric signup-bday-month">
              <option selected disabled>Birthday Month</option>
              <option value="1">January</option>
              <option value="2">February</option>
              <option value="3">March</option>
              <option value="4">April</option>
              <option value="5">May</option>
              <option value="6">June</option>
              <option value="7">July</option>
              <option value="8">August</option>
              <option value="9">September</option>
              <option value="10">October</option>
              <option value="11">November</option>
              <option value="12">December</option>
            </select>
            <select name="signup-bday-day" class="selectric signup-bday-day">
              <option selected disabled>Day</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
              <option value="13">13</option>
              <option value="14">14</option>
              <option value="15">15</option>
              <option value="16">16</option>
              <option value="17">17</option>
              <option value="18">18</option>
              <option value="19">19</option>
              <option value="20">20</option>
              <option value="21">21</option>
              <option value="22">22</option>
              <option value="23">23</option>
              <option value="24">24</option>
              <option value="25">25</option>
              <option value="26">26</option>
              <option value="27">27</option>
              <option value="28">28</option>
              <option value="29">29</option>
              <option value="30">30</option>
              <option value="31">31</option>
            </select>
            <select name="signup-bday-year" class="selectric signup-bday-year" multiple>
              <option selected disabled>Year</option>
              <option value="2000">2000</option>
              <option value="1999">1999</option>
              <option value="1998">1998</option>
              <option value="1997">1997</option>
              <option value="1996">1996</option>
              <option value="1995">1995</option>
              <option value="1994">1994</option>
              <option value="1993">1993</option>
              <option value="1992">1992</option>
              <option value="1991">1991</option>
              <option value="1990">1990</option>
              <option value="1989">1989</option>
              <option value="1988">1988</option>
              <option value="1987">1987</option>
              <option value="1986">1986</option>
              <option value="1985">1985</option>
              <option value="1984">1984</option>
              <option value="1983">1983</option>
              <option value="1982">1982</option>
              <option value="1981">1981</option>
              <option value="1980">1980</option>
              <option value="1980">1980</option>
              <option value="1979">1979</option>
              <option value="1978">1978</option>
              <option value="1977">1977</option>
              <option value="1976">1976</option>
              <option value="1975">1975</option>
              <option value="1974">1974</option>
              <option value="1973">1973</option>
              <option value="1972">1972</option>
              <option value="1971">1971</option>
              <option value="1970">1970</option>
              <option value="1969">1969</option>
              <option value="1968">1968</option>
              <option value="1967">1967</option>
              <option value="1966">1966</option>
              <option value="1965">1965</option>
              <option value="1964">1964</option>
              <option value="1963">1963</option>
              <option value="1962">1962</option>
              <option value="1961">1961</option>
              <option value="1960">1960</option>
              <option value="1959">1959</option>
              <option value="1958">1958</option>
              <option value="1957">1957</option>
              <option value="1956">1956</option>
              <option value="1955">1955</option>
              <option value="1954">1954</option>
              <option value="1953">1953</option>
              <option value="1952">1952</option>
              <option value="1951">1951</option>
              <option value="1950">1950</option>
              <option value="1949">1949</option>
              <option value="1948">1948</option>
              <option value="1947">1947</option>
              <option value="1946">1946</option>
              <option value="1945">1945</option>
              <option value="1944">1944</option>
              <option value="1943">1943</option>
              <option value="1942">1942</option>
              <option value="1941">1941</option>
              <option value="1940">1940</option>
              <option value="1939">1939</option>
              <option value="1938">1938</option>
              <option value="1937">1937</option>
              <option value="1936">1936</option>
              <option value="1935">1935</option>
              <option value="1934">1934</option>
              <option value="1933">1933</option>
              <option value="1932">1932</option>
              <option value="1931">1931</option>
              <option value="1930">1930</option>
              <option value="1929">1929</option>
              <option value="1928">1928</option>
              <option value="1927">1927</option>
              <option value="1926">1926</option>
              <option value="1925">1925</option>
              <option value="1924">1924</option>
              <option value="1923">1923</option>
              <option value="1922">1922</option>
              <option value="1921">1921</option>
              <option value="1920">1920</option>
              <option value="1919">1919</option>
              <option value="1918">1918</option>
              <option value="1917">1917</option>
              <option value="1916">1916</option>
              <option value="1915">1915</option>
              <option value="1914">1914</option>
              <option value="1913">1913</option>
              <option value="1912">1912</option>
              <option value="1911">1911</option>
              <option value="1910">1910</option>
              <option value="1909">1909</option>
              <option value="1908">1908</option>
              <option value="1907">1907</option>
              <option value="1906">1906</option>
              <option value="1905">1905</option>
              <option value="1904">1904</option>
              <option value="1903">1903</option>
              <option value="1902">1902</option>
              <option value="1901">1901</option>
              <option value="1900">1900</option>
            </select>
          </div>
          <div class="row">
            <select name="signup-gender" class="selectric">
              <option selected disabled>Gender</option>
              <option value="1">Male</option>
              <option value="0">Female</option>
            </select>
          </div>
          {{--
          <div class="row">
            <select name="signup-country" class="selectric">
              <option selected disabled>Country</option>
                <!-- Countries are added dynamically in general.js from list-countries.html -->
            </select>
          </div>
          <div class="row">
            <select name="signup-state" class="selectric half-width">
              <option selected disabled>State</option>
                <!-- States are added dynamically in general.js from list-states.html -->
              </select>
              <input type="text" placeholder="Zip Code" name="signup-zipcode" class="form-control half-width-last">
          </div>
          --}}
        </fieldset>
        <fieldset>
          <header>
            <h2>Pick your interests</h2>
            <p>Tell us about your interests so that we can create a better experience for you. Select at least 5 categories below.</p>
          </header>
          <select class="image-picker" multiple>
            <option data-img-src="/public/ceek-v2/img/interests/interests-concerts_and_festivals.jpg" value="concerts_and_festivals">Concerts & Festivals</option>
            <option data-img-src="/public/ceek-v2/img/interests/interests-video_games.jpg" value="video_games">Video Games</option>
            <option data-img-src="/public/ceek-v2/img/interests/interests-books.jpg" value="books">Books</option>
            <option data-img-src="/public/ceek-v2/img/interests/interests-movies.jpg" value="movies">Movies</option>
            <option data-img-src="/public/ceek-v2/img/interests/interests-comedy.jpg" value="comedy">Comedy</option>
            <option data-img-src="/public/ceek-v2/img/interests/interests-amusement_parks.jpg" value="amusement_parks">Amusement Parks</option>
            <option data-img-src="/public/ceek-v2/img/interests/interests-museums.jpg" value="museums">Museums</option>
            <option data-img-src="/public/ceek-v2/img/interests/interests-dining.jpg" value="dining">Dining</option>
            <option data-img-src="/public/ceek-v2/img/interests/interests-night_clubs.jpg" value="night_clubs">Night Clubs</option>
            <option data-img-src="/public/ceek-v2/img/interests/interests-casinos.jpg" value="casinos">Casinos</option>
            <option data-img-src="/public/ceek-v2/img/interests/interests-fitness.jpg" value="fitness">Fitness</option>
            <option data-img-src="/public/ceek-v2/img/interests/interests-diy.jpg" value="diy">DIY</option>
            <option data-img-src="/public/ceek-v2/img/interests/interests-fashion.jpg" value="fashion">Fashion</option>
            <option data-img-src="/public/ceek-v2/img/interests/interests-tv_shows.jpg" value="tv_shows">TV Shows</option>
            <option data-img-src="/public/ceek-v2/img/interests/interests-travel.jpg" value="travel">Travel</option>
            <option data-img-src="/public/ceek-v2/img/interests/interests-beach.jpg" value="beach">Beach</option>
          </select>
        </fieldset>
        <fieldset class="find-connections">
          <header>
            <h2>Find connections</h2>
            <p>Choose how you want to see people within Ceek below.</p>
          </header>
          <div class="range-slider">
            <p class="mile-range-text">Within <span>100</span> Miles of me</p>
            <div id="mile-range"></div>
          </div>
          <div class="range-slider">
            <p class="age-range-text">Age Range <span></span></p>
            <div id="age-range"></div>
          </div>
        </fieldset>
        <fieldset class="upload-photo">
          <header>
            <h2>Upload your photo</h2>
            <p>Last step! Make sure you have a nice profile picture.</p>
          </header>
          <div id="upload-photo-zone">
            <div class="content">
              <img src="/public/ceek-v2/img/upload-photo-icon.png" alt="">
              <p>Drag & drop your file here or click to upload from your device.</p>
            </div>
          </div>
        </fieldset>
        <fieldset class="after-form">
          <header>
            <h2>Welcome <span>Dave</span>!</h2>
          </header>
          <div class="row">
            <a href="#">
              <img src="/public/ceek-v2/img/download-windows.jpg" alt="">
              <h4>Download</h4>
              <p>Windows App</p>
            </a>
            <a href="#">
              <img src="/public/ceek-v2/img/launch-ceek.jpg" alt="">
              <h4>Launch</h4>
              <p>Ceek Now</p>
            </a>
          </div>
          <div class="row">
            <p>Ceek is currently in <strong>beta</strong> mode. We are hard at work improving the Ceek experience. In the meantime, you can download this preview of the software. Ceek currently only supports the Oculus Rift DK1 hardware.</p>
          </div>
        </fieldset>
          <button class="btn-gradient btn-next">Signup</button>
          <p class="notice">By clicking the sign up button, you are agree with the <a href="#">Terms and Conditions</a>, and that you have read the <a href="{{ route('pages.privacy') }}">Privacy Policy</a> of Ceek</p>
        </form>
      </div>
    </div>
  </div>