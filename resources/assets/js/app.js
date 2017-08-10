
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Noty = require('noty');
// window.Vue = require('vue');

// *
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
 

// Vue.component('example', require('./components/Example.vue'));

// const app = new Vue({
//     el: '#app'
// });



$(document).ready(function() {

document.addEventListener("touchmove", function(event){
    event.preventDefault();
}, false);

(function(a,b,c){if(c in b&&b[c]){var d,e=a.location,f=/^(a|html)$/i;a.addEventListener("click",function(a){d=a.target;while(!f.test(d.nodeName))d=d.parentNode;"href"in d&&(d.href.indexOf("http")||~d.href.indexOf(e.host))&&(a.preventDefault(),e.href=d.href)},!1)}})(document,window.navigator,"standalone")

paceOptions = {
  document: false, // disabled
  eventLag: false, // disabled
  elements: {
    selectors: ['#main']
  }
};







    $('#lendsend').click(function(event) {

      var phoneno = /^09\d{8}$/;
      var $phone = $('#tel').val();




        if ($phone == '' || !$phone.match(phoneno)) {
            new Noty({
                type: 'error',
                layout: 'center',
                text: '<div class="glyphicon-ring"> <span class="glyphicon glyphicon-remove glyphicon-bordered"></span></div><br>請填寫正確的手機號碼',
                timeout: 2000,
                theme: 'nest',
                animation: {
                    open: 'animated fadeInUp', // Animate.css class names
                    close: 'animated fadeOutDown' // Animate.css class names
                }
            }).show();
            return false;
            event.preventDefault();
        }
        event.preventDefault();
        

        $.ajax({
            url: 'lendPhoneCheck',
            type: 'POST',
            dataType: 'json',
            data: {
                phone: $phone
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('.num').fadeIn('2000', function() {
                    $(this).removeClass('.container-hideden');
                    $('#tel').attr('disabled', 'disabled');
                    $('#lendsend-step2').removeClass('container-hidden');
                    $('#lendsend').addClass('container-hidden');
                });
                new Noty({
                    type: 'success',
                    layout: 'center',
                    text: '<div class="glyphicon-ring"> <span class="glyphicon glyphicon-ok glyphicon-bordered"></span></div><br>'+response.success,
                    timeout: 2000,
                    theme: 'nest',
                    animation: {
                        open: 'animated fadeInUp', // Animate.css class names
                        close: 'animated fadeOutDown' // Animate.css class names
                    }
                }).show();
            },
            error: function(response) {

                var n = new Noty({
                    type: 'error',
                    layout: 'center',
                    text: response.responseJSON.error + '<br>' + $phone,
                    buttons: [
                        Noty.button('是', 'btn btn-success info-btn', function() {
                            n.close();
                            $.ajax({
                                url: 'customerCreate',
                                type: 'POST',
                                dataType: 'json',
                                data: {
                                    phone: $phone
                                },
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    $('.num').fadeIn('2000', function() {
                                        $(this).removeClass('.container-hideden');
                                        $('#tel').attr('disabled', 'disabled');
                                        $('#lendsend-step2').removeClass('container-hidden');
                                        $('#lendsend').addClass('container-hidden');
                                    });
                                    new Noty({
                                        type: 'success',
                                        layout: 'center',
                                        text: '<div class="glyphicon-ring"> <span class="glyphicon glyphicon-ok glyphicon-bordered"></span></div><br>'+response.success,
                                        timeout: 1000,
                                        theme: 'nest',
                                        animation: {
                                            open: 'animated fadeInUp', // Animate.css class names
                                            close: 'animated fadeOutDown' // Animate.css class names
                                        }
                                    }).show();
                                },
                                error: function(response) {

                                    new Noty({
                                        type: 'error',
                                        layout: 'center',
                                        text: response.responseJSON.error,
                                        timeout: 2000,
                                        theme: 'nest',
                                        animation: {
                                            open: 'animated fadeInUp', // Animate.css class names
                                            close: 'animated fadeOutDown' // Animate.css class names
                                        }
                                    }).show();
                                },
                            })




                        }, {
                            id: 'button1',
                            'data-status': 'ok'
                        }),

                        Noty.button('否', 'btn btn-danger info-btn', function() {
                            n.close();
                        })
                    ],
                    theme: 'nest',
                    animation: {
                        open: 'animated fadeInUp', // Animate.css class names
                        close: 'animated fadeOutDown' // Animate.css class names
                    }
                }).show();
            },
        })

    });



    $('#lendsend-step2').click(function(event) {

        event.preventDefault();

        var numno = /^\d{3}$/;

        var $phone = $('#tel').val();
        var $number = $('#num').val();
        if ($phone == '' || $number == '' || !$number.match(numno)) {
            new Noty({
                type: 'error',
                layout: 'center',
                text: '<div class="glyphicon-ring"> <span class="glyphicon glyphicon-remove glyphicon-bordered"></span></div><br>請填寫正確杯子編號',
                timeout: 2000,
                theme: 'nest',
                animation: {
                    open: 'animated fadeInUp', // Animate.css class names
                    close: 'animated fadeOutDown' // Animate.css class names
                }
            }).show();
            return false;
            event.preventDefault();
        }

        $.ajax({
            url: 'lendContainerCreate',
            type: 'POST',
            dataType: 'json',
            data: {
                phone: $phone,
                number: $number
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('#num').val('');
                new Noty({
                    type: 'success',
                    layout: 'center',
                    text: '<div class="glyphicon-ring"> <span class="glyphicon glyphicon-ok glyphicon-bordered"></span></div><br>'+response.success,
                    timeout: 1500,
                    theme: 'nest',
                    animation: {
                        open: 'animated fadeInUp', // Animate.css class names
                        close: 'animated fadeOutDown' // Animate.css class names
                    }
                }).show();
            },
            error: function(response) {

                new Noty({
                    type: 'error',
                    layout: 'center',
                    text: '<div class="glyphicon-ring"> <span class="glyphicon glyphicon-remove glyphicon-bordered"></span></div><br>' + response.responseJSON.error,
                    timeout: 2000,
                    theme: 'nest',
                    animation: {
                        open: 'animated fadeInUp', // Animate.css class names
                        close: 'animated fadeOutDown' // Animate.css class names
                    }
                }).show();
            },

        });
    });
$('#recoversend').click(function(event) {
      event.preventDefault();

      var numno = /^\d{3}$/;
      var $number = $('#num').val();
      if ($number == '' || !$number.match(numno)) {
            new Noty({
                type: 'error',
                layout: 'center',
                text: '<div class="glyphicon-ring"> <span class="glyphicon glyphicon-remove glyphicon-bordered"></span></div><br>請填寫正確杯子編號',
                timeout: 2000,
                theme: 'nest',
                animation: {
                    open: 'animated fadeInUp', // Animate.css class names
                    close: 'animated fadeOutDown' // Animate.css class names
                }
            }).show();
            return false;
            event.preventDefault();
        }

             $.ajax({
            url: 'recoverContainer',
            type: 'POST',
            dataType: 'json',
            data: {
                number: $number
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('#num').val('');
                new Noty({
                    type: 'success',
                    layout: 'center',
                    text: '<div class="glyphicon-ring"> <span class="glyphicon glyphicon-ok glyphicon-bordered"></span></div><br>'+response.success,
                    timeout: 1500,
                    theme: 'nest',
                    animation: {
                        open: 'animated fadeInUp', // Animate.css class names
                        close: 'animated fadeOutDown' // Animate.css class names
                    }
                }).show();
            },
            error: function(response) {

                new Noty({
                    type: 'error',
                    layout: 'center',
                    text: '<div class="glyphicon-ring"> <span class="glyphicon glyphicon-remove glyphicon-bordered"></span></div><br>'+response.responseJSON.error,
                    timeout: 2000,
                    theme: 'nest',
                    animation: {
                        open: 'animated fadeInUp', // Animate.css class names
                        close: 'animated fadeOutDown' // Animate.css class names
                    }
                }).show();
            },

        });
    });
});