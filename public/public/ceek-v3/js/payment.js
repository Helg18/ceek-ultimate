Stripe.setPublishableKey('pk_test_t5ifiQjAXEo3NeBRaIBP3Xqy');

$(document).ready(function(){
    
    $('#country_name').val($('.country').find('option:selected').text());

    $(document).on('blur', '#cardnumber', function() {
        if ($(this).val().length > 12)
        {
            $('#lastfour').val($(this).val().substr(-4));    
        }        
    });

    final_price();
   
    $(document).on('change', '.country', function() {
        
        $('#country_name').val($(this).find('option:selected').text());

        if ($(this).val() !== 'US')
        {
            $('.states').slideUp('slow', function() {
                $('.new_states').slideDown();
            }); 
            if ($(this).val() !== 'CA')
            {
                $('#shipping_cost').html('7.95');
                final_price();
            }
            else {
                $('#shipping_cost').html('5.95');
                final_price();
            }
        } 
        else {
            $('.new_states').slideUp('slow', function() {
                $('.states').slideDown();
            });  
            $('#shipping_cost').html('5.95');
            final_price();
        }
    });

    $('#payment-form').bootstrapValidator({
        excluded: [':disabled', ':hidden', ':not(:visible)'],
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            billing_name: {
                validators: {
                    notEmpty: {
                        message: 'Name is required and can\'t be empty'
                    },
                    regexp: {
                        message: 'Name can only contain letters',
                        regexp: /^[A-Za-z]/
                    }
                }
            },
            billing_lastname: {
                validators: {
                    notEmpty: {
                        message: 'Last name is required and can\'t be empty'
                    },
                    regexp: {
                        message: 'Last name can only contain letters',
                        regexp: /^[A-Za-z]/
                    }
                }
            },
            billing_phone: {
                validators: {
                    notEmpty: {
                        message: 'Phone is required and can\'t be empty'
                    },
                    regexp: {
                        message: 'Phone number can only contain the digits, spaces, -, (, ), + and .',
                        regexp: /^[0-9\s\-()+\.]+$/
                    },                
                    stringLength: {
                        min: 7,
                        max: 15,
                        message: 'Phone number must be have between 7 and 15 digits'
                    }
                }
            },
            billing_email: {
                selector: '.email',
                validators: {
                    notEmpty: {
                        message: 'Email address is required and can\'t be empty'
                    },
                    regexp: {
                        regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                        message: 'Value is not a valid email address'
                    }
                }
            },
            billing_address: {                
                validators: {
                    notEmpty: {
                        message: 'Street address is required and cannot be empty'
                    },
                    stringLength: {
                        min: 6,
                        max: 70,
                        message: 'Street address must be more than 6 and less than 70 characters long'
                    }
                }
            },
            billing_city: {
                validators: {
                    notEmpty: {
                        message: 'City is required and cannot be empty'
                    },
                    regexp: {
                        message: 'City can only contain letters',
                        regexp: /^[A-Za-z]/
                    }
                }
            },
            billing_state: {
                validators: {
                    notEmpty: {
                        message: 'State is required'
                    }
                }
            },
            billing_newstate: {
                excluded: false,
                validators: {
                    notEmpty: {
                        message: 'State is required and can\'t be empty'
                    },
                    regexp: {
                        message: 'State can only contain letters',
                        regexp: /^[A-Za-z]/
                    }
                }
            },
            billing_zipcode: {
                selector: '.zipcode',
                validators: {
                    notEmpty: {
                        message: 'Zip code is required and cannot be empty'
                    },
                    regexp: {
                        message: 'Zip code can only contain digits',
                        regexp: /^[a-zA-Z0-9]/
                    }
                }
            },
            cardnumber: {
                selector: '#cardnumber',
                validators: {
                    notEmpty: {
                        message: 'Credit card number is required and can\'t be empty'
                    },
                    creditCard: {
                        message: 'Credit card number is invalid'
                    }
                }
            },
            expMonth: {
                selector: '[data-stripe="exp-month"]',
                validators: {
                    notEmpty: {
                        message: 'Expiration month is required'
                    },
                    digits: {
                        message: 'Expiration month can contain digits only'
                    },
                    callback: {
                        message: 'Expired',
                        callback: function (value, validator) {
                            value = parseInt(value, 10);
                            var year = validator.getFieldElements('expYear').val(),
                                    currentMonth = new Date().getMonth() + 1,
                                    currentYear = new Date().getFullYear();
                            if (value < 0 || value > 12) {
                                return false;
                            }
                            if (year == '') {
                                return true;
                            }
                            year = parseInt(year, 10);
                            if (year > currentYear || (year == currentYear && value > currentMonth)) {
                                validator.updateStatus('expYear', 'VALID');
                                return true;
                            } else {
                                return false;
                            }
                        }
                    }
                }
            },
            expYear: {
                selector: '[data-stripe="exp-year"]',
                validators: {
                    notEmpty: {
                        message: 'Expiration year is required'
                    },
                    digits: {
                        message: 'Expiration year can contain digits only'
                    },
                    callback: {
                        message: 'Expired',
                        callback: function (value, validator) {
                            value = parseInt(value, 10);
                            var month = validator.getFieldElements('expMonth').val(),
                                    currentMonth = new Date().getMonth() + 1,
                                    currentYear = new Date().getFullYear();
                            if (value < currentYear || value > currentYear + 100) {
                                return false;
                            }
                            if (month == '') {
                                return false;
                            }
                            month = parseInt(month, 10);
                            if (value > currentYear || (value == currentYear && month > currentMonth)) {
                                validator.updateStatus('expMonth', 'VALID');
                                return true;
                            } else {
                                return false;
                            }
                        }
                    }
                }
            },
            cvv: {
                selector: '#cvv',
                validators: {
                    notEmpty: {
                        message: 'CVV is required and can\'t be empty'
                    },
                    cvv: {
                        message: 'Value is not a valid CVV',
                        creditCardField: 'cardnumber'
                    }
                }
            }
        }
    });

    $("#payment-form").submit(function(ev){
        ev.preventDefault();
    });
    
    $(".submit-button").on("click", function(){

        var bootstrapValidator = $("#payment-form").data('bootstrapValidator');
        
        bootstrapValidator.validate();

        if(bootstrapValidator.isValid()){
            var $form = $(this);

            // Before passing data to Stripe, trigger Parsley Client side validation
           
            // Disable the submit button to prevent repeated clicks
            $form.find('.submit-button').prop('disabled', true);

            Stripe.card.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val(),
                name: $('.name').val() +' '+ $('.lastname').val(),
            }, stripeResponseHandler);

            // Prevent the form from submitting with the default action
            return false;
        }         
        else return;

    });

});

function final_price() {
    var product_price = parseFloat($('#product_price span').html());
    var shipping_cost =  parseFloat($('#shipping_cost').html());
    var total_price = (product_price + shipping_cost).toFixed(2);

    $('#total_price').html(total_price);
}

function stripeResponseHandler(status, response) {

    var $form = $('#payment-form');

    if (response.error) { // Problem!
        
        // Show the errors on the form:
        $form.find('.payment-errors').text(response.error.message);
        $form.find('.submit-button').prop('disabled', false); // Re-enable submission

    } else { // Token was created!

        // Get the token ID:
        var token = response.id;

        // Insert the token ID into the form so it gets submitted to the server:
        $form.append($('<input type="hidden" name="stripeToken">').val(token));

        // Submit the form:
        $form.get(0).submit();
    }
}