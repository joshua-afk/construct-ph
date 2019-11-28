<template>
    <!-- root -->
    <div class="root">
        <div class="container">
            <div class="row">
                <div class="col-md-9 profile-left">
                    <!-- Profile -->
                    <section class="profile-section">
                        <div class="row">
                            <div class="col-md-8 profile__left-left">
                                <div class="card">
                                    <div class="row no-gutters">
                                        <div class="col-auto profile__img-container" @mouseover="showProfileImageButton" @mouseout="hideProfileImageButton">
                                            <img
                                                v-if="account.image != null"
                                                :src="'/storage/images/profile-images/' + account.image"
                                                class="img--responsive"
                                                alt="account.image"
                                            >
                                            <img
                                                v-else
                                                src="/storage/images/profile-images/default.png"
                                                class="img--responsive"
                                                alt="account.image"
                                            >
                                            <div class="profile-image__btn-container" id="profile-image__btn-container">
                                                <span v-if="hasAccountID && session.user_id === account.id" class="-pointer -bold">
                                                    <a data-toggle="modal" data-target="#profileImageModal"><i class="fas fa-camera"></i></a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col profile__name-container">
                                            <div class="card-block px-2">
                                                <h3>{{ account.first_name + ' ' + account.last_name }}</h3>
                                                <p class="profile-address"><i class="fas fa-map-marker-alt"></i>&ensp;Ligao City, Philippines</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 profile__left-right">
                                <div class="profile-left-right__rating">
                                    <i class="fa fa-star profile-left-right__rating-star"></i>
                                    <i class="fa fa-star profile-left-right__rating-star"></i>
                                    <i class="fa fa-star profile-left-right__rating-star"></i>
                                    <i class="fa fa-star profile-left-right__rating-star"></i>
                                    <i class="fas fa-star-half-alt profile-left-right__rating-star"></i>
                                </div>
                                <p><b>4.5% Rating</b> | <span class="profile__left-right-reviews">21 Reviews</span></p>
                            </div>
                        </div>
                        <div class="profile-overview">
                            <div class="profile-overview__header">
                                <h5><i class="far fa-user-circle"></i>&ensp;Overview</h5>
                                <hr class="cstm-hr">
                            </div>
                            <div class="profile-overview__profession">
                                <p>
                                    <!-- <span v-if="account_overview != null && account_overview.classification != null" class="profile__overview-classification">{{ account_overview.classification.name }}</span> -->
                                    <span class="profile__overview-classification">Electrical Engineer | Civil Engineer</span>
                                    <span v-if="hasAccountID && session.user_id === account.id">
                                        <a href="#" data-toggle="modal" data-target="#professionModal"><i class="fas fa-pen"></i></a>
                                    </span>
                                </p>
                            </div>
                            <div class="profile-overview__content">
                                <div class="row">
                                    <div class="col-md-11 col-md-11--profile-overview">
                                        <p v-if="account_preference != null && account_preference.summary != null">{{ account_preference.summary }}</p>
                                        <p v-else>Tell your clients about yourself.</p>
                                    </div>
                                    <div class="col-md-1 profile__overview-edit">
                                        <span v-if="hasAccountID && session.user_id === account.id"><a href="#" data-toggle="modal" data-target="#overviewModal"><i class="fas fa-pen"></i></a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- / Profile -->
                    <!-- Specialties -->
                    <section class="profile-section">
                        <div class="section__head">
                            <div class="row">
                                <div class="col">
                                    <h5><i class="fas fa-chart-line"></i>&ensp;Specialties</h5>
                                </div>
                                <div v-if="hasAccountID && session.user_id == account.id" class="col" align="right">
                                    <a href="#" data-toggle="modal" data-target="#specialtiesModal"><i class="fas fa-pen"></i></a>
                                </div>
                            </div>
                            <hr class="cstm-hr">
                        </div>
                        <div class="section__content">
                            <div v-if="account_classifications.length">
                                <span v-for="account_classification in account_classifications" class="badge badge-pill badge-light -hvr_green">{{ account_classification.name }}</span>&ensp;
                            </div>
                            <div v-else class="mt-4">
                                <p>No data to show.</p>
                            </div>
                        </div>
                    </section>
                    <!-- / Specialties -->
                    <!-- Projects -->
                    <section class="profile-section">
                        <div class="section__head">
                            <div class="row">
                                <div class="col">
                                    <h5><i class="far fa-building"></i>&ensp;Projects</h5>
                                </div>
                            </div>
                            <hr class="cstm-hr">
                        </div>
                        <div class="section__content">
                            <div v-if="account_projects.length" class="row">
                                <div v-for="(account_project, key) in account_projects" class="col-md-4 cstm-mb-2">
                                    <div class="project-container" @mouseover="projectHover(key)" @mouseout="projectRemoveHover(key)">
                                        <div class="project-body mb-2">
                                            <div class="project-img-container">
                                                <img :src="'/storage/images/projects/professional/cover-images/' + account_project.image" :alt="account_project.name">
                                            </div>
                                            <div class="project__options" v-bind:id="'project-options' + key">
                                                <a href="#" title="Edit"><i class="far fa-edit"></i></a>&ensp;
                                                <a :href="'/projects/' + account_project.code" title="View"><i class="fas fa-eye"></i></a>&ensp;
                                                <a href="#" title="Delete"><i class="far fa-trash-alt"></i></a>
                                            </div>
                                        </div>
                                        <div class="project-footer">
                                            <small><strong>{{ account_project.name }}</strong></small>
                                        </div>
                                    </div>
                                </div>
                                <div v-if="hasAccountID && session.user_id == account.id" class="col-md-4">
                                    <div class="project-container__add" @mouseover="addProjectHover()">
                                        <a href="/projects/create" id="project-add" ><i class="fas fa-plus-circle"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div v-else class="row">
                                <div v-if="hasAccountID && session.user_id == account.id" class="col-md-4">
                                    <div class="project-container__add" @mouseover="addProjectHover()">
                                        <a href="/projects/create" id="project-add" ><i class="fas fa-plus-circle"></i></a>
                                    </div>
                                </div>
                                <div v-else class="ml-3">
                                    <p>No data to show.</p>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- / Projects -->
                    <!-- Review -->
                    <section class="profile-section">
                        <div class="section__head">
                            <div class="row">
                                <div class="col">
                                    <h5><i class="far fa-comments"></i>&ensp;Reviews</h5>
                                </div>
                            </div>
                            <hr class="cstm-hr">
                        </div>
                        <div v-if="reviews.length != 0">
                            <div v-for="review in reviews" class="clean-container px-2">
                                <p class="clean-container-title mb-2">{{ review.job.title }}</p>
                                <p class="clean-container-text">
                                    <i v-if="review.rate < 1" class="fas fa-star-half-alt review-star"></i>
                                    <i v-if="review.rate >= 1" class="fas fa-star review-star"></i>
                                    <i v-if="review.rate == 1.5" class="fas fa-star-half-alt review-star"></i>
                                    <i v-if="review.rate < 2 && review.rate != 1.5" class="far fa-star review-star"></i>
                                    <i v-if="review.rate >= 2" class="fas fa-star review-star"></i>
                                    <i v-if="review.rate == 2.5" class="fas fa-star-half-alt review-star"></i>
                                    <i v-if="review.rate < 3 && review.rate != 2.5" class="far fa-star review-star"></i>
                                    <i v-if="review.rate >= 3" class="fas fa-star review-star"></i>
                                    <i v-if="review.rate == 3.5" class="fas fa-star-half-alt review-star"></i>
                                    <i v-if="review.rate < 4 && review.rate != 3.5" class="far fa-star review-star"></i>
                                    <i v-if="review.rate >= 4" class="fas fa-star review-star"></i>
                                    <i v-if="review.rate == 4.5" class="fas fa-star-half-alt review-star"></i>
                                    <i v-if="review.rate < 5 && review.rate != 4.5" class="far fa-star review-star"></i>
                                    <i v-if="review.rate == 5" class="fas fa-star review-star"></i>
                                </p>
                                <p class="clean-container-text" v-html="review.description"></p>
                                <p class="clean-container-text"><span class="fw-500">From: </span>
                                    <a :href="'/profile/' + review.job_entry.account.username">
                                        {{ review.job_entry.account.first_name + ' ' + review.job_entry.account.last_name }}
                                    </a>
                                </p>
                                <p class="clean-container-year">{{ moment(review.job_entry.updated_at).format('YYYY MMMM') }}</p>
                            </div>
                        </div>
                        <div v-else class="mt-4">
                            <p>No data to show.</p>
                        </div>
                    </section>
                    <!-- / Review -->
                    <!-- Work -->
                    <section v-if="accountExperiencesShow != 0" class="profile-section">
                        <div class="section__head">
                            <div class="row">
                                <div class="col">
                                    <h5><i class="fas fa-briefcase"></i>&ensp;Experience</h5>
                                </div>
                            </div>
                            <hr class="cstm-hr mb-0">
                        </div>
                        <div v-if="accountExperiences.length != 0">
                            <div  class="clean-container px-2" v-for="account_experience in accountExperiences">
                                <p class="clean-container-title mb-3">{{ account_experience.job_title }} | {{ account_experience.company }}</p>
                                <p class="clean-container-text">
                                    <span class="d-block -bold">Responsibilities:</span>
                                    {{ account_experience.responsibilities }}
                                </p>
                                <p class="clean-container-text">
                                    <span class="d-block -bold">Accomplishments:</span>
                                    {{ account_experience.accomplishments }}
                                </p>
                                <p class="clean-container-text">
                                    <span class="d-block -bold">Skills:</span>
                                    {{ account_experience.skills }}
                                </p>
                                <p class="clean-container-year mt-3">{{ moment(account_experience.started_at).format('YYYY MMMM') }} - {{ moment(account_experience.ended_at).format('YYYY MMMM') }}</p>
                            </div>
                        </div>
                        <div v-else class="mt-4">
                            <p>No data to show.</p>
                        </div>
                    </section>
                    <!-- / Work -->
                    <!-- Education -->
                    <section v-if="accountEducationsShow != 0" class="profile-section">
                        <div class="section__head">
                            <div class="row">
                                <div class="col">
                                    <h5><i class="fas fa-graduation-cap"></i>&ensp;Education</h5>
                                </div>
                            </div>
                            <hr class="cstm-hr mb-0">
                        </div>
                        <div v-if="accountEducations.length != 0" class="section__content">
                            <div class="clean-container px-2" v-for="account_education in accountEducations">
                                <h5 class="clean-container-title">{{ account_education.degree }} | {{ account_education.field }}</h5>
                                <p class="clean-container-sub-title">{{ account_education.school }}</p>
                                <p class="clean-container-year">{{ moment(account_education.started_at).format('YYYY') }} - {{ moment( account_education.ended_at).format('YYYY') }}</p>
                            </div>
                        </div>
                        <div v-else class="mt-4">
                            <p>No data to show.</p>
                        </div>
                    </section>
                    <!-- / Education -->
                    <!-- Licensures -->
                    <section v-if="accountLicensuresShow != 0" class="profile-section">
                        <div class="section__head">
                            <div class="row">
                                <div class="col">
                                    <h5><i class="fas fa-graduation-cap"></i>&ensp;Licensures</h5>
                                </div>
                            </div>
                            <hr class="cstm-hr mb-0">
                        </div>
                        <div v-if="accountLicensures.length != 0" class="section__content">
                            <div class="clean-container px-2" v-for="account_licensure in accountLicensures">
                                <h5 class="clean-container-title">{{ account_licensure.name }} <small class="text-muted">{{ account_licensure.type }}</small></h5>
                                <p class="clean-container-sub-title">{{ account_licensure.number }}</p>
                            </div>
                        </div>
                        <div v-else class="mt-4">
                            <p>No data to show.</p>
                        </div>
                    </section>
                    <!-- / Licensures -->
                    <!-- Trainings -->
                    <section v-if="resumeTrainingsShow != 0" class="profile-section">
                        <div class="section__head">
                            <div class="row">
                                <div class="col">
                                    <h5><i class="fas fa-tools"></i>&ensp;Trainings</h5>
                                </div>
                            </div>
                            <hr class="cstm-hr mb-0">
                        </div>
                        <div v-if="resumeTrainings != 0">
                            <div  class="clean-container" v-for="resume_training in resumeTrainings">
                                <h5 class="clean-container-title mb-3">{{ resume_training.title }} | {{ resume_training.company }}</h5>
                                <span class="clean-container-text d-block -bold m-0">Certificate Number:</span>
                                {{ resume_training.cert_number }}
                                <p class="clean-container-year">{{ moment(resume_training.started_at).format('YYYY MMMM') }} - {{ moment(resume_training.ended_at).format('YYYY MMMM') }}</p>
                            </div>
                        </div>
                        <div v-else class="mt-4">
                            <p>No data to show.</p>
                        </div>
                    </section>
                    <!-- / Training -->
                    <!-- Affiliations -->
                    <section v-if="accountAffiliationsShow != 0" class="profile-section">
                        <div class="section__head">
                            <div class="row">
                                <div class="col">
                                    <h5><i class="fas fa-graduation-cap"></i>&ensp;Affiliations</h5>
                                </div>
                            </div>
                            <hr class="cstm-hr mb-0">
                        </div>
                        <div v-if="accountAffiliations.length != 0" class="section__content">
                            <div class="clean-container px-2" v-for="account_affiliation in accountAffiliations">
                                <h5 class="clean-container-title">{{ account_affiliation.organization_name }} | {{ (account_affiliation.position) ? account_affiliation.position : 'None' }}</h5>
                                <p class="clean-container-sub-title">{{ account_affiliation.school }}</p>
                                <p class="clean-container-year">
                                    {{ moment(account_affiliation.started_at).format('YYYY') }} - {{ moment( account_affiliation.ended_at).format('YYYY') }}
                                </p>
                            </div>
                        </div>
                        <div v-else class="mt-4">
                            <p>No data to show.</p>
                        </div>
                    </section>
                    <!-- / Affiliations -->
                    <!-- See more -->
                    <div class="profile-see-more mb-5">
                        <p
                            v-if="seemore == 0"
                            @click="seeMore()"
                            class="profile-see-more__text text-center -pointer"
                        ><i class="fas fa-chevron-down"></i>&ensp;see more...</p>
                        <p
                            v-else
                            @click="showLess()"
                            class="profile-see-more__text text-center -pointer"
                        ><i class="fas fa-chevron-up"></i>&ensp;show less...</p>
                    </div>
                    <!-- / See more -->
                </div>

                <div class="col-md-3 profile-right">
                    <div class="profile-basic-info">
                        <a href="#" class="btn -bleached btn-block text-uppercase fw-bold" data-toggle="modal" data-target="#contactModal"><i class="far fa-paper-plane"></i>&ensp;Contact me</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- root -->
</template>

<script>
import axios from 'axios'
import _ from 'lodash'

export default {
    props: {
        session: {
            type: Object,
            default: () => {}
        },
        account: {
            type: Object,
            default: () => {}
        },
        reviews: {
            type: Array,
            default: () => []
        },
        account_preference: {
            type: Object,
            default: () => {}
        },
        account_classifications: {
            type: Array,
            default: () => []
        },
        account_projects: {
            type: Array,
            default: () => []
        },
        classification_list: {
            type: Array,
            default: () => []
        },
        classification_list: {
            type: Array,
            default: () => []
        },
    },
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            search: '',
            accountClassifications: this.account_classifications,
            classificationOptions: this.classification_list,
            seemore: 0,
            accountEducationsShow: 0,
            accountExperiencesShow: 0,
            resumeTrainingsShow: 0,
            accountLicensuresShow: 0,
            accountAffiliationsShow: 0,
            accountEducations: [],
            accountExperiences: [],
            resumeTrainings: [],
            accountLicensures: [],
            accountAffiliations: [],
        };
    },
    methods: {
        seeMore(){
            axios
            .get('/api/profile/' + this.account.username)
            .then ((response) => {
                this.seemore = 1;
                this.accountEducationsShow = 1;
                this.accountExperiencesShow = 1;
                this.resumeTrainingsShow = 1;
                this.accountLicensuresShow = 1;
                this.accountAffiliationsShow = 1;
                this.accountEducations = response.data.account_educations;
                this.accountExperiences = response.data.account_experiences;
                this.resumeTrainings = response.data.resume_trainings;
                this.accountLicensures = response.data.account_licensures;
                this.accountAffiliations = response.data.account_affiliations;
            })
            .catch(function (error) {
                console.log(error.message);
            });
        },
        showLess(){
            this.seemore = 0;
            this.accountEducationsShow = 0;
            this.accountExperiencesShow = 0;
            this.resumeTrainingsShow = 0;
            this.accountLicensuresShow = 0;
            this.accountAffiliationsShow = 0;
            this.accountEducations = [];
            this.accountExperiences = [];
            this.resumeTrainings = [];
            this.accountLicensures = [];
            this.accountAffiliations = [];
        },
        projectHover(key) {
            document.getElementById('project-options' + key).style.display = 'flex';
        },
        projectRemoveHover(key) {
            document.getElementById('project-options' + key).style.display = 'none';
        },
        addProjectHover() {
            document.getElementById('project-add').style.display = 'block';
        },
        containsKey(obj, key ) {
            return Object.keys(obj).includes(key);
        },
        showProfileImageButton(){
            $('#profile-image__btn-container').css('display', 'flex');
        },
        hideProfileImageButton(){
            $('#profile-image__btn-container').css('display', 'none');
        },
        moment: function (date) {
            return moment(date);
        },
    },
    computed: {
        hasAccountID() {
            return this.containsKey(this.session, 'user_id');
        },
    }
}
</script>