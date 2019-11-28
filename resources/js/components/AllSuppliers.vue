<template>
    <section class="all-contractors">
        <div class="container">
            <h1 class="all-contractors__title">Our Suppliers</h1>
            <div class="all-contractors__header-line"></div>
            <p class="all-contractors__sub-title">Want to <a href="/register">register</a> your company?</p>

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
                        <a v-if="value == null" href="/suppliers" class="btn -lime-outline"><i class="fas fa-search"></i>&ensp;</a>
                        <a v-else :href="'/search/suppliers/' + value.code" class="btn -lime-outline"><i class="fas fa-search"></i>&ensp;</a>
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
                                    No data to show.
                                    <!-- {{ (contractor.region != null) ? contractor.region : 'No data to show.' }} -->
                                </p>
                            </div>
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
    props: ['companies_list', 'classifications'],
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            list: [],
            companies: [],
            page: 1,
            iterate: 0,
            value: [],
            options: this.companies_list
        };
    },
    methods: {
        infiniteHandler($state) {
            let vm = this;

            axios.get('/api/supplier-unli-scroll?page=' + this.page)
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
    },
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>