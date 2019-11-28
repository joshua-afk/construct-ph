<template>
 <div class="root">
  <div class="container pt-5 mb-5">
   <form action="/jobs" method="post">
    <input type="hidden" name="_token" :value="csrf">
    <!-- <div class="panel mx-auto px-5 py-4 w-75"> -->
     <div class="panel mx-auto w-75">
      <div class="panel__header">
       <h2 class="panel__title">Create a Job Post</h2>
       <div class="panel__header-line"></div>
      </div>
      <div class="panel__body w-75">

       <input v-if="user_companies.length === 0" type="hidden" name="entity_id" :value="session.user_id">
       <div v-if="user_companies.length !== 0" class="form-group">
        <label class="fw-bold">Company Name</label>
        <select name="entity_id" class="form-control select2-companies">
         <option value=""></option>
         <option v-for="company in user_companies" :value="company.id" v-text="company.company_name"></option>
        </select>
        <small class="text-muted">If you don't have company, <a class="small-like" href="/companies/create">create here.</a></small>
       </div>

       <div class="form-group">
        <label class="fw-bold">Title</label>
        <input type="text" class="form-control" name="title">
       </div>

       <div class="form-group">
        <label class="fw-bold">Description</label>
        <textarea name="description" class="form-control"></textarea>
        <!-- <textarea name="" id="" cols="30" rows="10" class="form-control"></textarea> -->
        <small class="text-muted">Information regarding the project.</small>
       </div>

       <div class="form-group">
        <label class="fw-bold">Location</label>
        <select name="region" class="form-control select2-region">
         <option value=""></option>
         <option v-for="region in regions" :value="region.id">{{ region.code + ' - ' + region.name }}</option>
        </select>
       </div>

       <div class="form-group">
        <div class="form-row">
         <div class="col">
          <select name="city" class="form-control select2-city">
           <option value=""></option>
           <option v-for="city in cities" :value="city.id">{{ city.name }}</option>
          </select>
         </div>
         <div class="col">
          <input type="text" class="form-control" name="zip" placeholder="ZIP Code">
         </div>
        </div>
       </div>

       <div class="form-group">
        <label class="fw-bold">Salary</label>
        <div class="form-row">
         <div class="col">
          <div class="input-group mb-3">
           <div class="input-group-prepend">
            <span class="input-group-text">&#8369;</span>
           </div>
           <input type="text" class="form-control" name="salary_min" placeholder="min">
          </div>
         </div>
         <div class="col">
          <div class="input-group mb-3">
           <div class="input-group-prepend">
            <span class="input-group-text">&#8369;</span>
           </div>
           <input type="text" class="form-control" name="salary_max" placeholder="max">
          </div>
         </div>
        </div>
       </div>

       <div class="form-group">
        <label class="fw-bold">Select Classifications</label>
        <multiselect
         name="classifications"
         v-model="value"
         tag-placeholder="Add this as new tag"
         label="name"
         track-by="name"
         :options="options"
         :multiple="true"
         :taggable="true"
         @tag="addTag"
        ></multiselect>
        <select name="classifications[]" style="display:none;" multiple>
         <option
         v-for="classification in value"
         :value="classification.id"
         selected="selected"
         ></option>
        </select>
        <small class="text-muted">Maximum of 10 classifications.</small>
       </div>

       <div class="form-row">
        <div class="form-group col-md-5">
         <label class="fw-bold">Deadline</label>
         <input class="form-control" type="text" name="deadline" value="">
        </div>
        <div class="form-group col-md-7">
         <label class="fw-bold">Number of positions</label>
         <input type="text" class="form-control" name="hire_count">
         <small class="text-muted">How many employees would you like to hire.</small>
        </div>
       </div>

       <hr>

       <div class="form-group">
        <label class="fw-bold mb-2">Qualifications</label>
        
        <div class="ml-3">
         <div class="form-check">
          <input name="professional" class="form-check-input" type="checkbox" value="professional">
          <label class="form-check-label">Professional</label>
         </div>

         <div class="form-check">
          <input name="contractor" class="form-check-input" type="checkbox" value="contractor">
          <label class="form-check-label">Contractor</label>
         </div>

         <div class="form-check">
          <input name="supplier" class="form-check-input" type="checkbox" value="supplier">
          <label class="form-check-label">Supplier</label>
         </div>
        </div>
       </div>

       <hr class="cstm-hr">

       <div class="form-group">
        <button class="btn -submit mr-2">Submit</button>
        <a href="/jobs" class="btn -back">Go back</a>
       </div>
      </div>
     </div>
    </form>
   </div>
  </div>
 </template>

 <script>
 import Multiselect from 'vue-multiselect';

 export default {
  components: {
   Multiselect
  },
  props: ['session', 'user_companies', 'regions', 'cities', 'classifications'],
  data() {
   return {
    csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    value: [],
    options: this.classifications,
   };
  },
  methods: {
   addTag (newTag) {
    const tag = {
     name: newTag,
     code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
    }
    this.options.push(tag)
    this.value.push(tag)
   },
  },
 };
 </script>

 <style src="vue-multiselect/dist/vue-multiselect.min.css"></style>