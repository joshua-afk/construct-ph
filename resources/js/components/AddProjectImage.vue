<template>
    <div class="container pt-5 mb-5">
        <div class="panel mx-auto w-75">
            <div class="panel__header">
                <h2 class="panel__title">Add Project Images</h2>
                <div class="panel__header-line"></div>
            </div>

            <div class="panel__body">

                <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions"></vue-dropzone>

                <hr>

                <div>
                    <button type="button" class="btn -submit mr-1" @click="submitDropzone()">Upload Files</button>
                    <a :href="'/projects/' + project.code" class="btn -back">Go back</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import _ from 'lodash'
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'

export default {
    components: {
        vueDropzone: vue2Dropzone
    },
    props: ['project'],
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            dropzoneOptions: {
                url: '/api/projects/' + this.project.code + '/images/add',
                thumbnailWidth: 200,
                addRemoveLinks: true,
                dictDefaultMessage: "<i class='fas fa-cloud-upload-alt'></i>&ensp;Drop files here to upload",
                autoProcessQueue: false,
                autoDiscover: false,
            },
        };
    },
    methods: {
        submitDropzone(){
            $('#dropzone').get(0).dropzone.processQueue();
        }
    },
}
</script>