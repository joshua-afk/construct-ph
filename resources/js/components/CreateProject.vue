<template>
    <div class="container pt-5 mb-5">
        <form action="/projects" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
            <input type="hidden" name="_token" :value="csrf">
            
            <!-- Panel -->
            <div class="panel mx-auto w-75">
                <!-- Panel Header -->
                <div class="panel__header">
                    <h3>Create a Project</h3>
                    <div class="panel__header-line"></div>
                </div>
                <!-- Panel Body -->
                <div class="panel__body w-75">
                    <label for="" class="fw-bold mb-2">Project Image</label>
                    <div class="project-image w-50 mb-3">
                        <div class="project-image-container" @mouseover="imgContainerHover()" @mouseout="imgContainerRemoveHover()">
                            <img
                            v-if="imageUrl"
                            :src="imageUrl"
                            class="img--responsive"
                            >
                            <img
                            v-else
                            src="/storage/images/no-image.jpg"
                            class="img--responsive"
                            >
                            <div class="project-image__btn-container" id="project-image__btn-container">
                                <a href="#" @click="selectFile" id="project-img__btn"><i class="fas fa-plus-circle"></i></a>
                            </div>
                        </div>
                    </div>

                    <input type="file" id="fileUpload" name="cover_image" @change="inputImage" hidden="hidden">

                    <div class="form-group">
                        <label for="projectName" class="fw-bold">Project Title</label>
                        <input type="text" name="project_name" id="projectName" class="form-control" placeholder="Enter your project title">
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="date_start" class="fw-bold">Start Date</label>
                            <input class="form-control" type="text" name="date_start" value="10/24/1984">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="date_end" class="fw-bold">End Date</label>
                            <input class="form-control" type="text" name="date_end" value="10/24/1984">
                        </div>
                    </div>                    

                    <div class="form-group">
                        <label for="projectDescription" class="fw-bold">Project Description</label>
                        <textarea name="description" id="projectDescription" class="form-control" cols="30" rows="10" placeholder="Tell them about your project"></textarea>
                    </div>

                    <hr class="cstm-hr">

                    <div class="form-group">
                        <button class="btn -submit mr-2">Publish Project</button>
                        <a href="/profile" class="btn -back">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios'
import _ from 'lodash'
import Datepicker from 'vuejs-datepicker';

export default {
    components: {
        Datepicker
    },
    data() {
        return {
            imageUrl: null,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        };
    },
    methods: {
        imgContainerHover() {
            document.getElementById('project-image__btn-container').style.display = 'flex';
        },
        imgContainerRemoveHover() {
            document.getElementById('project-image__btn-container').style.display = 'none';
        },
        selectFile() {
            event.preventDefault();
            document.getElementById("fileUpload").click()
        },
        inputImage(e) {
          const file = e.target.files[0];
          this.imageUrl = URL.createObjectURL(file);
      },
      customFormatter(date) {
          return moment(date).format('YYYY/MM/DD');
      }
  },
}
</script>