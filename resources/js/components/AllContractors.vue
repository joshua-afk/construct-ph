<style scoped>
.fa-search,
.fa-list{
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
                <div class="col-10 pr-3">
                    <multiselect
                        v-model="value"
                        :options="options"
                        placeholder="Select one"
                        label="company_name"
                        track-by="id"
                    ></multiselect>
                </div>
                <div class="col-2 p-0">
                    <div v-if="value == null" class="-xy-center h-100">
                        <a href="/contractors" class="btn -lime-outline"><i class="fas fa-search"></i>&ensp;</a>
                        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <i class="fas fa-list"></i>
                        </a>
                    </div>
                    <div v-else>
                        <a :href="'/search/contractors/' + value.code" class="btn -lime-outline"><i class="fas fa-search"></i>&ensp;</a>
                        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <i class="fas fa-list"></i>
                        </a>
                    </div>
                </div>
          </div>

          <div class="collapse" id="collapseExample">
            <div class="card" style="background-color: #F2F2F2;">
                <div class="card-body">
                    <span v-for="classification in classifications" class="badge badge-pill badge-light -hvr_green mb-2 -pointer" @click="sortClassification(classification.code)">{{ classification.name }}</span>&ensp;
                </div>
                <div class="w-25 pl-4">                    
                    <button class="btn btn-primary">Sort</button>
                </div>
            </div>
        </div>

            <hr style="margin: 2rem 0">

            <div v-if="companies != null" class="row">
                <div v-for="contractor in companies" class="col-md-4 cstm-mb-2">
                    <div class="card -shadow-dynamic">
                        <img v-if="contractor.image != null" :src="'/storage/images/companies/' + contractor.image" alt="contractor.image" class="card-img-top img--responsive">
                        <img v-else src="/storage/images/no-image.jpg" alt="no-image" class="card-img-top img--responsive">
                        <div class="card-body">
                            <div class="all-contractors__card-title">
                                <h5 class="card-title">{{ contractor.company_name }}</h5>
                            </div>
                            <hr class="cstm-hr">
                            <div class="all-contractors__card-text">
                                <p class="card-text">
                                    <strong>PCAB License:</strong>
                                    {{ (contractor.pcab_license != null) ? contractor.pcab_license : 'No data to show.' }}
                                </p>
                                <p class="card-text">
                                    <strong>Category:</strong>
                                    {{ (contractor.category != null) ? contractor.category : 'No data to show.' }}
                                </p>
                                <p class="card-text">
                                    <strong>Region:</strong>
                                    {{ (contractor.region != null) ? contractor.region : 'No data to show.' }}
                                </p>
                            </div>

                            <hr>

                            <a class="btn -lime-outline btn-block" :href="'/companies/' + contractor.code">
                                View Company
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <infinite-loading @distance="1" @infinite="infiniteHandler"></infinite-loading>

            <h1 v-if="companies == null" style="margin-top: 5rem">Ooops! There is no data to show.</h1>
        </div>
    </section>
</template>

<script>
import axios from 'axios'
import _ from 'lodash'
import Multiselect from 'vue-multiselect'
import InfiniteLoading from 'vue-infinite-loading';

export default {
    components: {
        InfiniteLoading, Multiselect
    },
    props: ['company_list', 'classifications'],
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            list: [],
            companies: [],
            page: 1,
            iterate: 0,
            value: [],
            options: this.company_list,
        };
    },
    methods: {
        infiniteHandler($state) {
            let vm = this;

            axios.get('/api/contractor-unli-scroll?page=' + this.page)
            .then(res => {
                $.each(res, function(key, value) {
                    vm.list.push(value.data);
                });
                $.each(vm.list[vm.iterate], function(key, value) {
                    vm.companies.push(value);
                });
                vm.iterate = vm.iterate + 6;
                $state.loaded();
            });
            this.page = this.page + 1;
        },
        sortClassification(code){
            window.location.href = '/sort/contractors/classification/' + code;
        }
    },
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>