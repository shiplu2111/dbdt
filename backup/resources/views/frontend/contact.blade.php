@extends('frontend.layouts.master')
@section('content')

    <div>

        <section class="page-banner-sec-wrp">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-banner-des">
                            <h1 class="page-banner-title">Contact</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- end of page-banner -->

        <section class="contact-form-sec-wrp">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="contact-form-wrp clearfix">
                            <div class="contact-form-head">
                                <h1 class="contact-form-head-title">contact</h1>
                                <p>You may contact us for any query or want to know more about Digital Blockchain Dominance
                                    Token (DBDT)<br /></p>
                            </div>
                            <div class="contact-form-block clearfix">
                                <div class="contact-form-lft">
                                    <form id="contactForm">
                                        <div class="contact-form-field"> <input id="first_name" name="text"
                                                placeholder="Enter Your First Name" type="text" />
                                            <label for="first_name" class="input-placeholder">First Name</label>
                                        </div>
                                        <div class="contact-form-field"> <input id="last_name" name="text"
                                                placeholder="Enter Your Last Name" type="text" />
                                            <label for="last_name" class="input-placeholder">Last Name</label>
                                        </div>
                                        <div class="contact-form-field"> <input id="email" name="email"
                                                placeholder="Enter Your Email" type="email" />
                                            <label for="email" class="input-placeholder">Email</label>
                                        </div>
                                        <div class="contact-form-field"> <input id="phone" name="phone"
                                                placeholder="Enter Your Phone Number" type="text" />
                                            <label for="phone" class="input-placeholder">Phone </label>
                                        </div>
                                        <div class="contact-form-field"> <textarea id="message" placeholder="Message"
                                                class="input-placeholder" type="textarea"></textarea>
                                            <!--
                            <label for="textarea" class="input-placeholder">Message</label> -->

                                        </div>
                                        <div class="contact-form-submit"> <button name="submit" type="submit">SEND
                                                MESSAGE</button>
                                        </div>
                                    </form>

                                </div>
                                <div class="contact-form-rgt">
                                    <div class="contact-info-wrp">
                                        <h5 class="contact-info-title">Contact Info</h5>
                                        <ul class="clearfix reset-list">
                                            <li>
                                                <i class="fas fa-map-marker-alt"></i>
                                                <a href="#" target="_blank">Digital Blockchain Dominance Token (DBDT)</a>
                                            </li>
                                            <li>
                                                <i class="fas fa-envelope"></i>
                                                <a href="#" target="_blank">info@digitalbdt.org</a>
                                            </li>
                                            <li>
                                                <i class="fab fa-whatsapp"></i>
                                                <a href="#" target="_blank">+6016-9734368</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1018967.7970896364!2d113.24797728960525!3d3.9495260719103027!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x321941fc74729dcf%3A0x2e911b344f6c4816!2sMiri%2C%20Sarawak%2C%20Malaysia!5e0!3m2!1sen!2sbd!4v1640172883501!5m2!1sen!2sbd"
            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

    </div>



    <script>
        $("#contactForm").submit(function(e) {
            e.preventDefault();
            let first_name = $("#first_name").val();
            let last_name = $("#last_name").val();
            let email = $("#email").val();
            let phone = $("#phone").val();
            let message = $("#message").val();
            let _token = $("import [name=_token]").val();

            $.ajax({

                url: "{{ route('contact.add') }}",
                type: "POST",
                data: {
                    first_name: first_name,
                    last_name: last_name,
                    email: email,
                    phone: phone,
                    message: message,
                    _token: '{{ csrf_token() }}'

                },
                success: function(response) {
                    if (response) {
                        Swal.fire({
                            timer: 3000,
                            icon: 'success',
                            title: 'Thank you for your quory.',
                            text: ' Our customer support will contact you soon by email.',
                        })





                    }
                }
            });
        });
    </script>


@endsection
