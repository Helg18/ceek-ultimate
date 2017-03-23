@extends('layouts.package')
@section('meta-description')
CEEK is the only comprehensive and secure content platform for all devices. Live an amazing VR Experiences enjoying VR Concerts, games and sports
@stop
@section('title')
<title>Final Step | CEEK</title>
@stop
@section('content') 
    <main id="fullpage" class="privacy">
        <section class="section" id="payment">
            <div class="container">

              <div class="content text-center">
                
                <p class="lead text-muted">Please provide your payment information below. We will ship your item out to you right away.</p>
                
                <div class="well">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="panel panel-default selected">
                                <div class="panel-heading">
                                  <h3 class="panel-title">
                                    {{ $product->title }}
                                  </h3>
                                </div>
                                <div class="panel-body">
                                  <img src="{{ url('/public/ceek-v3/img/products') .'/'.$product->image }}" alt="{{ $product->title }}" class="img-responsive">
                                  <br>                                                            
                                  <h4 id="product_price">$<span><?php echo $product->price?></span></h4>
                                  
                                  <p class="text-center">
                                    + $<span id="shipping_cost">5.95</span> SHIPPING
                                  </p>
                                  <p>
                                    <strong>TOTAL: $<span id="total_price"></span></strong>
                                  </p>
                                  <p class="text-center">
                                    {{ $product->description }}
                                  </p>
                                  <br>                                  
                                  <p>
                                    <img src="/public/ceek-v3/img/card.png" class="img-responsive" alt="Card">
                                  </p>
                                  <p class="small text-muted">Your card will be billed by CEEK VR INC.<br>
                                    All payments processed through encrypted connection.
                                  </p>       
                                  <p>
                                    <span id="siteseal"><script async type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=POqYPzDmmkSa8qZjXvShMXrpLG65BFEy7NL61KfqAqQkFropnkyVO0RqQQet"></script></span>
                                  </p>      
                                </div>
                            </div>                   
                        </div>
                        <div class="col-md-7 b-l">
                          <form class="text-left" id="payment-form" action="{{ route('pages.payment') }}" method="POST">   
                            {{ csrf_field() }}  
                            <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                            <div class="panel-heading">
                              <h4 class="panel-title">BILLING INFORMATION</h4>
                            </div>                
                            
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <input type="text" name="billing_name" class="form-control name" maxlength="15" placeholder="First Name">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <input type="text" name="billing_lastname" class="form-control lastname" maxlength="25" placeholder="Last Name">
                                </div>
                              </div>                      
                            </div>                      
                                                                           
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <input type="text" name="billing_address" class="form-control address" placeholder="Street Address">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <input type="text" name="billing_address_two" class="form-control address_two" placeholder="Apt./Suite #">
                                </div>
                              </div> 
                            </div>
                              
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <input type="text" name="billing_city" class="form-control city" placeholder="City">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <select class="form-control states" name="billing_state">
                                    @include('includes.states')                              
                                  </select>                                  
                                </div>
                                <div class="form-group new_states">
                                  <input type="text" class="form-control new_state" name"billing_newstate" placeholder="State">
                                </div>
                              </div>                      
                            </div>                      
                                                      
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <input type="text" name="billing_zipcode" class="form-control zipcode" placeholder="Zip Code">
                                  <input type="hidden" id="country_name" name="country_name">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <select class="form-control country" name="billing_country">
                                    @include('includes.countries')
                                  </select>                                  
                                </div>
                              </div>                      
                            </div>                      
                                                      
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <input type="email" name="billing_email" class="form-control email" placeholder="Email Address">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <input type="text" name="billing_phone" class="form-control phone" placeholder="Phone Number">
                                </div>
                              </div>                      
                            </div> 

                            <div class="panel-heading">
                              <div class="row">
                                <div class="col-sm-6">
                                  <h4 class="panel-title">SHIPPING INFORMATION</h4>
                                </div>
                                <div class="col-sm-6">                          
                                  <div class="checkbox">
                                    <label>
                                      <input type="checkbox" class="addressbox"> SAME AS BILLING
                                    </label>
                                  </div>                          
                                </div>                        
                              </div>                      
                            </div> 

                            <div class="ship-info">
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <input type="text" name="shipping_name" class="form-control shipping_name" placeholder="First Name">
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <input type="text" name="shipping_lastname" class="form-control shipping_lastname" placeholder="Last Name">
                                  </div>
                                </div>                      
                              </div>                                                                  
                              
                              <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                      <input type="text" name="shipping_address" class="form-control shipping_address" placeholder="Street Address">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <input type="text" name="shipping_address_two" class="form-control shipping_address_two" placeholder="Apt./Suite #">
                                  </div>
                                </div> 
                              </div>
                                                    
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <input type="text" name="shipping_city" class="form-control shipping_city" placeholder="City">
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <select class="form-control shipping_state" name="shipping_state">
                                      @include('includes.states')                                                          
                                    </select>
                                  </div>
                                </div>                      
                              </div>                                                  
                              
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <input type="text" name="shipping_zipcode" class="form-control shipping_zipcode" maxlength="5" placeholder="Zip Code">
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <select class="form-control shipping_country" name="shipping_country">
                                      @include('includes.countries')
                                    </select>
                                  </div>
                                </div>                      
                              </div>     

                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <input type="email" name="shipping_email" class="form-control shipping_email" placeholder="Email Address">
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <input type="text" name="shipping_phone" class="form-control shipping_phone" placeholder="Phone Number">
                                  </div>
                                </div>                      
                              </div>      

                            </div>

                            <div class="panel-heading">
                              <h4 class="panel-title">PAYMENT INFORMATION</h4>
                            </div> 
                            
                            <div class="row">
                              <div class="col-sm-12">
                                <div class="payment-errors">

                                </div>
                              </div>
                            </div>

                            <div class="row">

                              <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                  <input type="text" id="cardnumber" name="cardnumber" class="form-control card-number" placeholder="Card Number">
                                  <input type="hidden" id="lastfour" name="lastfour">
                                </div>
                              </div>
                              <div class="col-md-12 col-lg-6">
                                <div class="form-inline">
                                  <div class="form-group">
                                    <select class="form-control card-expiry-month" name="month" data-stripe="exp-month">
                                      <option value="">Exp. Month</option>
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
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <select class="form-control card-expiry-year" name="year" data-stripe="exp-year">
                                      <option value="">Exp. Year</option>
                                      <option value="2017">2017</option>
                                      <option value="2018">2018</option>
                                      <option value="2019">2019</option>
                                      <option value="2020">2020</option>    
                                      <option value="2021">2021</option>
                                      <option value="2022">2022</option>
                                      <option value="2023">2023</option>
                                      <option value="2024">2024</option>
                                      <option value="2025">2025</option>
                                      <option value="2026">2026</option>
                                      <option value="2027">2027</option>
                                      <option value="2028">2028</option>
                                      <option value="2029">2029</option>
                                      <option value="2030">2030</option>
                                    </select>
                                  </div>                              
                                </div>                        
                              </div>                      
                            </div>                                                  

                           
                            <div class="row">
                              <div class="col-sm-4">
                                <div class="form-group">
                                  <input type="text" class="form-control card-cvc" id="cvv" placeholder="Security Code" >
                                </div>
                                
                              </div>
                            </div>                                                     
                     

                            <div class="form-group" style="margin-bottom:40px">
                                <div class="row">
                                  <div class="col-md-12">                              
                                    <button type="submit" class="btn btn-gradient btn-block submit-button">complete my order</button>
                                  </div>
                                </div>                      
                            </div>                            
                          </form>
                        </div>

                    </div>
                </div>

              </div>

        </div>
      </section>
    </main>
@stop