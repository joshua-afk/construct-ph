window.Vue = require('vue');
window.Vue.config.productionTip = false;
window.Vue.config.devtools = true;
// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Components
Vue.component('pagination', require('laravel-vue-pagination'));


//Layouts
Vue.component('navbar-dark',			 				require('./components/layouts/NavbarDark.vue').default);
Vue.component('navbar-transparent',			 			require('./components/layouts/NavbarTransparent.vue').default);
Vue.component('app-footer',			 					require('./components/layouts/Footer.vue').default);


// Index
Vue.component('register',			 					require('./components/Register.vue').default);
Vue.component('landing',			 					require('./components/Landing.vue').default);
Vue.component('profile',			 					require('./components/Profile.vue').default);


// All
Vue.component('all-professionals',			 			require('./components/AllProfessionals.vue').default);
Vue.component('contractors',			 				require('./components/contractors/index.vue').default);
Vue.component('all-suppliers',			 				require('./components/AllSuppliers.vue').default);


// Create
Vue.component('create-project',			 				require('./components/CreateProject.vue').default);
Vue.component('create-job-post',			 			require('./components/CreateJobPost.vue').default);

// Add
Vue.component('add-project-image',			 			require('./components/AddProjectImage.vue').default);


// Show
Vue.component('show-project',			 				require('./components/ShowProject.vue').default);


// Edit
// ...


// Sort
Vue.component('contractors-sort',			 			require('./components/contractors/sort.vue').default);


// Search
Vue.component('search-all-contractors',			 		require('./components/search/AllContractors.vue').default);
Vue.component('search-all-suppliers',			 		require('./components/search/AllSuppliers.vue').default);


// Modal
Vue.component('profile-modals',			 				require('./components/modals/ProfileModals.vue').default);


// Modules
Vue.component('show-project-modals',			 		require('./components/modules/ShowProjectModals.vue').default);
Vue.component('classifications',			 			require('./components/modules/Classifications.vue').default);

const app = new Vue({
    el: '#app',
});