<template>
  <!-- root -->
  <div class="root">
    <!-- Profile Image -->
    <div class="modal fade" id="profileImageModal" tabindex="-1" role="dialog" aria-labelledby="profileImageModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content w-auto">
          <div class="modal-header">
            <h5 class="modal-title" id="profileImageModalLabel">Profile Image</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="/account/profile-image" method="post" id="profileImageForm" accept-charset="UTF-8" enctype="multipart/form-data">
              <input type="hidden" name="_token" :value="csrf">
              <input type="hidden" name="_method" value="put">
              <input type="hidden" name="camera_image" id="camera_image" hidden="hidden">
              <input type="file" id="fileUpload" name="profile_image" @change="inputImage" hidden="hidden">

              <div class="container-img-border" style="width:640px; height:480px">
                <img
                v-if="imageUrl"
                :src="imageUrl"
                class="img-responsive"
                >
                <img
                v-else-if="account.image != null"
                :src="'/storage/images/profile-images/' + account.image"
                class="img-responsive"
                >
                <img
                v-else
                src="/storage/images/no-image.jpg"
                class="img-responsive"
                >
              </div>
              <div class="btn-group btn-group-lg w-100 mt-3" role="group" aria-label="Basic example">
                <button class="btn btn-secondary" style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; font-size: 15px" @click="selectFile">Upload Image</button>
                <button class="btn btn-secondary" style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; font-size: 15px" type="button" @click="setupCamera()" data-toggle="modal" data-target="#exampleModal">Take a photo</button>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn -back" data-dismiss="modal">Close</button>
            <button type="button" class="btn -submit" @click="submitProfileImage()">Save</button>
          </div>
        </div>
      </div>
    </div>
    <!-- / Profile Image -->

  <!-- Contact -->
  <div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="contactModalTitle">Contact Me</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="/contact" id="contactForm">
            <input type="hidden" name="_token" :value="csrf">
            <div class="form-group">
              <label for="title">Inquiry title</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
            </div>
            <div class="form-group">
              <label for="content">Content</label>
              <textarea class="form-control" name="content" id="content" cols="30" rows="10" placeholder="Enter content"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn -back" data-dismiss="modal">Close</button>
          <button type="button" class="btn -submit" @click="submitContact()">Save</button>
        </div>
      </div>
    </div>
  </div>
  <!-- / Contact -->

  <!-- Camera -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content w-auto">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="my_camera"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn -lime" data-dismiss="modal" @click="webcamSnap(imageUrl)">Take a photo</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- / Camera -->
<!-- root -->
</template>

<script>
import axios from 'axios'
import _ from 'lodash'
import Multiselect from 'vue-multiselect'

export default {
  components: {
    Multiselect
  },
  props: [
  'account',
  'account_classifications',
  'account_overview',
  'account_preference',
  'classification_list',
  ],
  data() {
    return {
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      imageUrl: null,
      summaryText: "",
      summaryString: 355,
      professionSelectValue: "",
      specialtiesSelectValue: this.account_classifications,
      multiSelectOptions: this.classification_list,
    };
  },
  mounted() {
    if (this.account_overview != null) {
      if (this.account_overview.classification) {
        this.professionSelectValue = this.account_overview.classification;
      } else {
        this.professionSelectValue = this.account_overview;
      }
    };

    Webcam.set({
      width: 640,
      height: 480,
      image_format: 'jpeg',
      flip_horiz: true,
      jpeg_quality: 90
    });
  },
  methods: {
    /******  All  ******/
    submitSummary(){
      $('#summaryForm').submit();
    },
    submitContact(){
      $('#contactForm').submit();
    },


    /******  Profile Image  ******/
    selectFile() {
      event.preventDefault();
      document.getElementById("fileUpload").click()
    },
    inputImage(e) {
      const file = e.target.files[0];
      this.imageUrl = URL.createObjectURL(file);
      document.getElementById("camera_image").value = '';
    },
    submitProfileImage(){
      $('#profileImageForm').submit();
    },
    setupCamera(){
      Webcam.attach('#my_camera');
    },
    webcamSnap(imageUrl) {
      this.imageUrl = imageUrl
      var self = this;
      Webcam.snap( function(data_uri) {   
        self.imageUrl = data_uri;
        document.getElementById("camera_image").value = data_uri;
      });
    },


    /******  Profession  ******/
    addTag (newTag) {
      const tag = {
        name: newTag,
        code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
      }
      this.options.push(tag)
      this.value.push(tag)
    },

    /******  Overview  ******/
    countSummaryString: _.throttle(function() {

      this.summaryString = 355 - $('#summary').val().length;

      if ($('#summary').val().length <= 355) {
        $('#summarySubmit').prop('disabled', false);
      } else if ($('#summary').val().length >= 0) {
        $('#summarySubmit').prop('disabled', true);
      }
    }, 100),


    /******  Specialties  ******/
    addTag (newTag) {
      const tag = {
        name: newTag,
        code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
      }
      this.options.push(tag)
      this.value.push(tag)
    },
    specialtiesSubmit(){
      $('#specialtiesForm').submit();
    },


    /******  Contact  ******/
  },
}
</script>