<template>
	<!--  -->
</template>

<script>
    export default {
    	props: [],
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            };
        },
        beforeMount() {
        	// Called right before the mounting begins: the render function is about to be called for the first time.
        },
        mounted() {
            this.$nextTick(function () {
            // Code that will run only after the
            // entire view has been rendered
            })
        },
        created() {
        	//
        },
        methods: {
            //
        },
        computed: {
            // like a mixin
        }
    }
</script>