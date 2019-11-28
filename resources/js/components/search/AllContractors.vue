<style scoped>
.fa-search{
    font-size: 22px;
}
</style>

<template>
    <section class="all-contractors">
        <div class="container">
            <h1 class="all-contractors__title">Our Contractors</h1>
            <div class="all-contractors__header-line"></div>
            <p class="all-contractors__sub-title mb-3">Want to <a href="/register">register</a> your company?</p>

            <div class="row">
                <div class="col-11 pr-0">
                    <multiselect
                        v-model="value"
                        :options="options"
                        placeholder="Select one"
                        label="company_name"
                        track-by="id"
                    ></multiselect>
                </div>
                <div class="col-1 p-0">
                    <div class="-xy-center h-100">
                        <a v-if="value == null" href="/contractors" class="btn -lime-outline"><i class="fas fa-search"></i>&ensp;</a>
                        <a v-else :href="'/search/contractors/' + value.code" class="btn -lime-outline"><i class="fas fa-search"></i>&ensp;</a>
                    </div>
                </div>
            </div>

            <hr style="margin: 2rem 0">

            <div class="row">
                <div class="col-md-4 cstm-mb-2">
                    <div class="card -shadow-dynamic">
                        <img v-if="company.image != null" :src="'/storage/images/companies/' + company.image" alt="company.image" class="card-img-top img--responsive">
                        <img v-else src="/storage/images/no-image.jpg" alt="no-image" class="card-img-top img--responsive">
                        <div class="card-body">
                            <div class="all-contractors__card-title">
                                <h5 class="card-title">{{ company.company_name }}</h5>
                            </div>
                            <hr class="cstm-hr">
                            <div class="all-contractors__card-text">
                                <p class="card-text">
                                    <strong>PCAB License:</strong>
                                    {{ (company.pcab_license != null) ? company.pcab_license : 'No data to show.' }}
                                </p>
                                <p class="card-text">
                                    <strong>Category:</strong>
                                    {{ (company.category != null) ? company.category : 'No data to show.' }}
                                </p>
                                <p class="card-text">
                                    <strong>Region:</strong>
                                    {{ (company.region != null) ? company.region : 'No data to show.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <h3>Location</h3>
                    <p>
                        <strong>Region: </strong>
                        {{ (company.region != null) ? company.region : 'No data to show.' }}
                    </p>
                    <p>
                        <strong>City: </strong>
                        {{ (company.city != null) ? company.city : 'No data to show.' }}
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import axios from 'axios'
import _ from 'lodash'
import Multiselect from 'vue-multiselect'

export default {
    components: {
        Multiselect
    },
    props: ['company', 'companies_list', 'classifications'],
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            value: this.company,
            options: this.companies_list,
        };
    },
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>