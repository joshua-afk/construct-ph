<style scoped>
.fa-search,
.fa-list{
  font-size: 22px;
}
</style>

<template>
  <section class="all-contractors">
    <div v-if="companies != null" class="row">
      <div v-for="contractor in companies" class="col-md-4 cstm-mb-2">
        <div class="card -shadow-dynamic" style="border-radius: 15px;">
          <img v-if="contractor.image != null" :src="'/storage/images/companies/' + contractor.image" alt="contractor.image" class="card-img-top img--responsive" style="border-top-left-radius: calc(15px - 1px); border-top-right-radius: calc(15px - 1px);">
          <img v-else src="/storage/images/no-image.jpg" alt="no-image" class="card-img-top img--responsive" style="border-top-left-radius: calc(15px - 1px); border-top-right-radius: calc(15px - 1px);">
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
                <span v-if="session.user_id">
                  {{ (contractor.region != null) ? contractor.region.name : 'No data to show.' }}
                </span>
                <span v-else>No data to show.</span>
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
  </section>
</template>

<script>
import axios from 'axios'
import _ from 'lodash'
import InfiniteLoading from 'vue-infinite-loading';

export default {
  components: {
    InfiniteLoading
  },
  props: ['company_list', 'session'],
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

      axios.get('/api/sort/contractor-unli-scroll?page=' + this.page)
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