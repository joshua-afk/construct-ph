<template>
    <section class="content-section">
        <div class="container">
            <form method="post" action="/professionals/filter" id="filter-input" class="search-form">
                <input type="hidden" name="_token" :value="csrf">
                <div class="row">
                    <div class="col-md-11">
                        <multiselect
                        name="search"
                        v-model="multiSelectValue"
                        tag-placeholder="Add this as new tag"
                        placeholder="Search or add a tag"
                        label="name"
                        track-by="name"
                        :options="multiSelectOptions"
                        :multiple="true"
                        :taggable="true"
                        @tag="addTag"
                        ></multiselect>
                        <select name="search[]" style="display:none;" multiple>
                            <option
                                v-for="specialty in multiSelectValue"
                                :value="specialty.name"
                                selected="selected"
                            ></option>
                        </select>
                    </div>
                 <div class="col-md-1">
                    <a href="/professionals/filter">
                        <div class="input-group-text" @click="filterInput">
                            <i class="fas fa-search"></i>
                        </div>
                    </a>
                </div>
            </div>
        </form>

        <h1>Our Professionals</h1>
        <div class="form__header-line"></div>
        <p style="text-align: center; color: #777777; font-size: 1.2rem">Want to <a href="/register">register</a> as a professional?</p>

        <hr style="margin: 2rem 0">

        <div v-if="professionals != false" v-for="professionals in chunkedProfessionals" class="row">
            <div class="col-md-3" v-for="account in professionals" style="padding: 0 15px 0 0">
                <div class="card professional-container">
                    <div class="card__img">
                        <img v-if="account.image != null" src="'/storage/images/companies/' + account.image" alt="Professional Image">
                        <img v-else src="/storage/images/profile-images/default.png" alt="Professional Image">
                    </div>
                    <div class="card-body">

                        <h4 class="card-title professional__name">{{ account.first_name }} {{ account.last_name }}</h4>

                        <p v-if="account.overview != null" class="professional__profession">{{ account.overview.profession }}</p>
                        <p v-else class="professional__profession">---</p>

                        <div style="height: 4px; background-color: #A7CB00; width: 2rem; margin: 0 auto; margin-bottom: 1rem; border-radius: 10px"></div>
                        <div class="professional__rating" style="margin-top: 1rem">
                            <div class="professional__star">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <p><b>4.5% Rating</b> | <span class="professional__reviews">21 Reviews</span></p>
                        </div>
                        <hr>
                        <div class="professional__overview" style="height: 86px">
                            <h6 style="font-weight: 600; color: #777777; margin-bottom: 5px;">Overview</h6>
                            <div v-if="account.overview == null">
                                <p>No overview to show.</p>
                            </div>
                            <div v-else>
                                <p v-if="account.overview.body == null">No overview to show.</p>
                                <p v-else-if="account.overview.body.length < 60">{{ account.overview.body }}</p>
                                <p v-else>{{ account.overview.body.substring(0, 60) + "..." }}</p>
                            </div>
                        </div>
                        <div class="professional__specialties" style="height: 55px; line-height: 2.2;">
                            <h6 style="font-weight: 600; color: #777777; margin-bottom: 5px;">Specialties</h6>
                            <div v-if="account.other_classifications.length > 1">
                                <span v-for="(classification, index) in account.other_classifications" v-if="index == 1" class="badge badge-pill badge-light -hvr_green">{{ classification.name }}</span>
                                <span class="badge badge-pill badge-light -hvr_green">+{{ account.other_classifications.length -1 }}</span>
                            </div>
                            <div v-else>
                                <span v-if="account.other_classifications != null" v-for="specialty in account.other_classifications" class="badge badge-pill badge-light -hvr_green">{{ classification.name }}</span>
                            </div>
                            <span v-if="account.other_classifications.length <= 0" class="badge badge-pill badge-light -hvr_green">No classifications to show</span>
                        </div>
                        <hr>
                        <div class="professional__btn" style="text-align: center; margin-top: 1rem">
                            <a :href="'/count-click/' + account.username" class="btn -lime-outline btn-block" @click="clickForm(account.id)">View Profile</a>
                        </div>
                    </div>
                </div>
                <form :id="'click-form-' + account.id" :action="'/count-click/' + account.username" method="POST" style="display: none;">
                    <input type="hidden" name="_token" :value="csrf">
                </form>
            </div>
        </div>
        <h1 v-if="professionals == false" style="margin-top: 5rem">Ooops! There is no data to show.</h1>
    </div>
</section>
</template>

<script>
import _ from 'lodash'
import Multiselect from 'vue-multiselect';

export default {
    components: {
        Multiselect
    },
    props: {
        search: {
            type: Array,
            default: () => []
        },
        classifications: {
            type: Array,
            default: () => []
        },
        professionals: {
            type: Array,
            default: () => []
        },
    },
    data() {
        return {
            multiSelectValue: this.search,
            multiSelectOptions: this.classifications,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            professionalsCount: this.professionals.length,
        };
    },
    methods: {
        addTag (newTag) {
            const tag = {
                name: newTag,
                code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
            }
            this.multiSelectOptions.push(tag)
            this.multiSelectValue.push(tag)
        },
        filterInput: function(event) {
            event.preventDefault();
            document.getElementById('filter-input').submit();
        },
        clickForm: function(id){
            event.preventDefault();
            document.getElementById('click-form-' + id).submit();
        },
        professionalCountInRow: function(index) {
         return this.professionals.slice((index - 1) * 4, index * 4)
     }
 },
 computed: {
    chunkedProfessionals() {
        return _.chunk(this.professionals, 4)
    }
}
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>