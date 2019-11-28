<template>
    <div class="landing-main-container mb-5">
        <!-- Banner -->
        <section>
            <div class="banner">
                <div class="banner__carousel-container">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators -banner">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="storage/images/banner/home-banner.jpg" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="storage/images/banner/home-banner.jpg" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="storage/images/banner/home-banner.jpg" alt="Third slide">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="banner__text-container">
                    <h1 class="banner__title">Construct PH</h1>
                    <div class="banner-text__line"></div>
                    <p class="banner__sub-title">The Premiere Online Directory for the Philippine Construction Industry.</p>
                </div>
            </div>
        </section>
        <!-- Banner -->

        <!-- Title Cards -->
        <section class="index-user-section" style="margin-top: -260px">
            <div class="container">
                <div class="mx-auto mb-5 text-center">
                    <h1 class="index-ft-professionals__title" style="color: #ffffff" data-aos="fade-up">WHAT ARE YOU LOOKING FOR?</h1>
                </div>
                <div class="row">
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="card card--index-user">
                            <div class="card-body card-body--index-user">
                                <div class="index-user__logo-container">
                                    <i class="fas fa-hard-hat"></i>
                                </div>
                                <h4 class="card-title card-title--index-user">Professional</h4>
                                <p class="card-text card-text--index-user">Looking for a reliable professional for advice on your next big project? See our list of qualified engineers or trade professionals for your needs.</p>
                                <div style="margin-top: 1rem">
                                    <a class="btn -lime-outline" href="/professionals">See more...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="card card--index-user">
                            <div class="card-body card-body--index-user">
                                <div class="index-user__logo-container">
                                    <i class="fas fa-file-contract"></i>
                                </div>
                                <h4 class="card-title card-title--index-user">Contractor</h4>
                                <p class="card-text card-text--index-user">Need professional help to build your dream hourse or your next renovation project? Choose from a list of contractors near your area. Let us take the gueswork out of your selection of qualified contractors.</p>
                                <div style="margin-top: 1rem">
                                    <a class="btn -lime-outline" href="/contractors">See more...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="card card--index-user">
                            <div class="card-body card-body--index-user">
                                <div class="index-user__logo-container">
                                    <i class="fas fa-truck-loading"></i>
                                </div>
                                <h4 class="card-title card-title--index-user">Supplier</h4>
                                <p class="card-text card-text--index-user">Get the best suppliers of quality materials and supplies for your project. From rebars to cement to generator sets and solar panels, our directory has it all.</p>
                                <div style="margin-top: 1rem">
                                    <a class="btn -lime-outline" href="/suppliers">See more...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-3" data-aos="fade-up" data-aos-delay="400">
                        <div class="card card--index-user">
                            <div class="card-body card-body--index-user">
                                <div class="index-user__logo-container">
                                    <i class="fas fa-user-tie"></i>
                                </div>
                                <h4 class="card-title card-title--index-user">Client</h4>
                                <p class="card-text card-text--index-user">Ready to look for qualified construction related resources for your project? Sign up now and post your job requirements. Or search our extensive directory for your preferred contractor and/or professional.</p>
                                <div style="margin-top: 1rem">
                                    <a class="btn -lime-outline" href="/clients">See more...</a>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </section>
        <!-- Title Cards -->
        
        <!-- Professionals -->
        <section>
            <div class="index-ft-professionals">
                <div class="container">
                    <div class="index-ft-professionals__header">
                        <h1 class="index-ft-professionals__title">FEATURED PROFESSIONALS</h1>
                        <p class="index-ft-professionals__sub-title">Here is a list of professionals in your area.</p>
                    </div>
                    <div id="featureProfessionalsIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#featureProfessionalsIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#featureProfessionalsIndicators" data-slide-to="1"></li>
                            <li data-target="#featureProfessionalsIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="card" style="width: 18rem;">
                                            <img src="storage/images/no-image.jpg" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title">Card title</h5>
                                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                                <a href="#" class="btn btn-primary">Go somewhere</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="card" style="width: 18rem;">
                                            <img src="storage/images/no-image.jpg" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title">Card title</h5>
                                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                                <a href="#" class="btn btn-primary">Go somewhere</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="card" style="width: 18rem;">
                                            <img src="storage/images/no-image.jpg" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title">Card title</h5>
                                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                                <a href="#" class="btn btn-primary">Go somewhere</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="card" style="width: 18rem;">
                                            <img src="storage/images/no-image.jpg" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title">Card title</h5>
                                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                                <a href="#" class="btn btn-primary">Go somewhere</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="card" style="width: 18rem;">
                                            <img src="storage/images/no-image.jpg" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title">Card title</h5>
                                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                                <a href="#" class="btn btn-primary">Go somewhere</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="card" style="width: 18rem;">
                                            <img src="storage/images/no-image.jpg" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title">Card title</h5>
                                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                                <a href="#" class="btn btn-primary">Go somewhere</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="card" style="width: 18rem;">
                                            <img src="storage/images/no-image.jpg" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title">Card title</h5>
                                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                                <a href="#" class="btn btn-primary">Go somewhere</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="card" style="width: 18rem;">
                                            <img src="storage/images/no-image.jpg" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title">Card title</h5>
                                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                                <a href="#" class="btn btn-primary">Go somewhere</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="card" style="width: 18rem;">
                                            <img src="storage/images/no-image.jpg" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title">Card title</h5>
                                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                                <a href="#" class="btn btn-primary">Go somewhere</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#featureProfessionalsIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#featureProfessionalsIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Professionals -->

        <!-- Facts -->
        <section>
            <div class="index-facts">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-md-3--index-facts">
                            <p class="index-facts__count"><i class="fas fa-user"></i>&ensp;{{ professionalsCount }}</p>
                            <h5 class="index-facts__name">Professionals</h5>
                        </div>
                        <div class="col-md-3 col-md-3--index-facts">
                            <p class="index-facts__count"><i class="fas fa-user"></i>&ensp;{{ contractorsCount }}</p>
                            <h5 class="index-facts__name">Contractors</h5>
                        </div>
                        <div class="col-md-3 col-md-3--index-facts">
                            <p class="index-facts__count"><i class="fas fa-user"></i>&ensp;{{ suppliersCount }}</p>
                            <h5 class="index-facts__name">Suppliers</h5>
                        </div>
                        <div class="col-md-3 col-md-3--index-facts" style="border: none">
                            <p class="index-facts__count"><i class="fas fa-user"></i>&ensp;563+</p>
                            <h5 class="index-facts__name">Active Jobs</h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- / Facts -->

        <!-- Featured Projects -->
        <section>
            <div class="index-ft-projects">
                <div class="container">
                    <div class="index-ft-projects__header">
                        <h1 class="index-ft-projects__title">FEATURED PROJECTS</h1>
                        <p class="index-ft-projects__sub-title">Looking to buy instead of build? See the list of projects that are available for viewing from our various contractors.</p> 
                    </div>
                    <div v-if="featured_projects.length != 0" class="row">
                        <div v-for="featured_project in featured_projects" class="col-md-4">
                            <div class="card -boder-none">
                                <div style="height: 300px;" class="container-img-border">
                                    <img
                                        class="card-img-top img-responsive"
                                        :src="'/storage/images/projects/professional/cover-images/' + featured_project.image"
                                        :alt="featured_project.name"
                                    >
                                </div>
                                <div class="card-body mt-3 py-0 px-0">
                                    <h4 class="card-title card-title--index-ft-projects" v-text="featured_project.name"></h4>
                                    <small class="index-ft-projects__icon"><i class="fas fa-hard-hat"></i>&ensp; {{ featured_project.professional.first_name + ' ' + featured_project.professional.last_name }}</small>
                                    <p style="height: 100px;" class="card-text text-secondary mt-2 mb-3" v-html="featured_project.description"></p>
                                    <a href="#" class="btn -lime">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-else class="row">
                        <div v-for="placeHolder in placeHolders" class="col-md-4">
                            <div class="card -boder-none">
                                <div style="height: 300px;" class="container-img-border">
                                    <img class="card-img-top img-responsive" src="/storage/images/no-image.jpg" alt="no-image">
                                </div>
                                <div class="card-body mt-3 py-0 px-0">
                                    <h4 class="card-title card-title--index-ft-projects">Project Name</h4>
                                    <small class="index-ft-projects__icon"><i class="fas fa-hard-hat"></i>&ensp; John Doe</small>
                                    <p style="height: 100px;" class="card-text text-secondary mt-2 mb-3" v-html="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo veritatis voluptatibus dicta rem voluptatem, soluta debitis tempora non consequuntur doloribus, nulla maiores quaerat nemo dolore, vel alias.</p>
                                    <a href="#" class="btn -lime">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- / Featured Projects -->
        
        <!-- <section>
            <div class="container index-feedbacks">
                <div class="index-feedbacks__header">
                    <h1 class="index-feedbacks__title">WHAT USERS SAY ABOUT US</h1>
                    <p class="index-feedbacks__sub-title">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi veniam ex aliquid totam voluptatibus non velit eos repellat.</p>
                </div>
                <div class="index-feedbacks__content">
                    <div id="carouselExampleIndicators" class="carousel slide carousel--index-feedbacks" data-ride="carousel">
                        <ol class="carousel-indicators carousel-indicators--index-feedbacks">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row row--index-feedbacks">
                                    <div class="col-sm">
                                        <div class="card card--index-feedbacks">
                                            <div class="card-body card-body--index-feedbacks">
                                                <div class="index-feedbacks__img-container">
                                                    <img class="index-feedbacks__img" src="storage/images/no-image.jpg" alt="">
                                                </div>
                                                <h5 class="card-title">John Doe</h5>
                                                <p class="card-text card-text--index-feedbacks">"Some quick example text to build on the card title and make up the bulk of the card's content."</p>
                                                <div class="index-feedbacks__star-container">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fas fa-star-half-alt"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="card card--index-feedbacks">
                                            <div class="card-body card-body--index-feedbacks">
                                                <div class="index-feedbacks__img-container">
                                                    <img class="index-feedbacks__img" src="storage/images/no-image.jpg" alt="">
                                                </div>
                                                <h5 class="card-title">John Doe</h5>
                                                <p class="card-text card-text--index-feedbacks">"Some quick example text to build on the card title and make up the bulk of the card's content."</p>
                                                <div class="index-feedbacks__star-container">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fas fa-star-half-alt"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row row--index-feedbacks">
                                    <div class="col-sm">
                                        <div class="card card--index-feedbacks">
                                            <div class="card-body card-body--index-feedbacks">
                                                <div class="index-feedbacks__img-container">
                                                    <img class="index-feedbacks__img" src="storage/images/no-image.jpg" alt="">
                                                </div>
                                                <h5 class="card-title">John Doe</h5>
                                                <p class="card-text card-text--index-feedbacks">"Some quick example text to build on the card title and make up the bulk of the card's content."</p>
                                                <div class="index-feedbacks__star-container">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fas fa-star-half-alt"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="card card--index-feedbacks">
                                            <div class="card-body card-body--index-feedbacks">
                                                <div class="index-feedbacks__img-container">
                                                    <img class="index-feedbacks__img" src="storage/images/no-image.jpg" alt="">
                                                </div>
                                                <h5 class="card-title">John Doe</h5>
                                                <p class="card-text card-text--index-feedbacks">"Some quick example text to build on the card title and make up the bulk of the card's content."</p>
                                                <div class="index-feedbacks__star-container">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fas fa-star-half-alt"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row row--index-feedbacks">
                                    <div class="col-sm">
                                        <div class="card card--index-feedbacks">
                                            <div class="card-body card-body--index-feedbacks">
                                                <div class="index-feedbacks__img-container">
                                                    <img class="index-feedbacks__img" src="storage/images/no-image.jpg" alt="">
                                                </div>
                                                <h5 class="card-title">John Doe</h5>
                                                <p class="card-text card-text--index-feedbacks">"Some quick example text to build on the card title and make up the bulk of the card's content."</p>
                                                <div class="index-feedbacks__star-container">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fas fa-star-half-alt"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="card card--index-feedbacks">
                                            <div class="card-body card-body--index-feedbacks">
                                                <div class="index-feedbacks__img-container">
                                                    <img class="index-feedbacks__img" src="storage/images/no-image.jpg" alt="">
                                                </div>
                                                <h5 class="card-title">John Doe</h5>
                                                <p class="card-text card-text--index-feedbacks">"Some quick example text to build on the card title and make up the bulk of the card's content."</p>
                                                <div class="index-feedbacks__star-container">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fas fa-star-half-alt"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
    </div>
</template>

<script>
import AOS from 'aos';
import 'aos/dist/aos.css';

export default {
    props: ['professionals', 'contractors', 'suppliers', 'featured_projects'],
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            professionalsCount: this.professionals.length,
            contractorsCount: this.contractors.length,
            suppliersCount: this.suppliers.length,
            placeHolders: [1,2,3],
        };
    },
    created(){
        console.log(this.featured_projects);
        AOS.init({
            once: true,
        });
    },
    methods: {
        //
    }
}
</script>