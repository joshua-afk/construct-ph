<template>
	<footer class="footer">
        <div class="footer__content">
            <div class="container">
                <div class="footer__links">
                    <div class="row">
                        <div class="col-md-4">
                            <h3 class="footer__title">Links</h3>
                            <div class="footer__title-line"></div>
                        </div>
                        <div class="col-md-4">
                            <h3 class="footer__title">FAQ</h3>
                            <div class="footer__title-line"></div>
                        </div>
                        <div class="col-md-4">
                            <h3 class="footer__title">Contact</h3>
                            <div class="footer__title-line"></div>
                            <a href="/contact-us" class="footer__link">Email Us</a>
                        </div>
                    </div>
                </div>
                <div class="footer__details">
                    <div class="row">
                        <div class="col-md-6 footer__details-text">
                            Copyright &copy; {{ new Date().getFullYear() }},
                            <!-- &nbsp;<span class="footer__pages"><a href="http://infoasiaconsulting.com/" target="_blank">Infoasia Consulting</a></span>. -->
                            All Rights Reserved.
                            &nbsp;<span class="footer__pages"><a href="/">Construct PH</a></span>
                        </div>
                        <div class="col-md-6 footer__icons">
                            <ul>
                                <li><i class="fab fa-facebook"></i></li>
                                <li><i class="fab fa-twitter"></i></li>
                                <li><i class="fab fa-pinterest"></i></li>
                                <li><i class="fab fa-google-plus"></i></li>
                                <li style="margin-right: 0"><i class="fab fa-instagram"></i></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>