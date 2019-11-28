<template>
	<!-- <div class="root"> -->
        <div style="height: 10rem; background-color: red" class="p-5">
            <h1>Sample Content</h1>
        </div>
    <!-- </div> -->
</template>

<script>
import axios from 'axios'
import _ from 'lodash'

export default {
    props: [],
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        };
    },
    mounted() {
        // 
    },
    created() {
        //
    },
    methods: {
        //
    },
}
</script>