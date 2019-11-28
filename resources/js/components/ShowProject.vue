<template>
    <div class="container mb-5">
        <div class="panel mx-auto my-5">
            <div class="panel__header">
                <h2 class="panel__title">Project Information</h2>
                <div class="panel__header-line"></div>
            </div>

            <div class="panel__body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="project-image-container">
                            <img :src="'/storage/images/projects/professional/cover-images/' + project.image" :alt="project.name">              
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="info-container">
                            <h3>{{ project.name }}</h3>
                            <p v-html="project.description"></p>
                            <div v-if="project.professional.id == session.user_id" class="dropdown mt-4">
                                <a class="btn -lime dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-cog"></i> Settings
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" :href="'/projects/' + project.code + '/images/add'">Add Images</a>
                                    <a v-if="project_blog != null" class="dropdown-item" :href="'/projects/' + project.code + '/blog/edit'">Update Blog</a>
                                    <a v-else class="dropdown-item" :href="'/projects/' + project.code + '/blog/create'">Create Blog</a>
                                </div>
                            </div>
                            <div v-else class="mt-4">
                                <button class="btn -lime"><i class="fas fa-flag"></i>&ensp;Save</button>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <!-- Display if the project contains image -->
                <div v-if="project.images.length != 0">
                    <div v-for="(project_images, index) in chunkedProjects" class="row cstm-mb-2">
                        <div v-for="(project_image, key) in project_images" class="col-md-3" @mouseover="projectImageHover(index, key)" @mouseout="projectImageRemoveHover(index, key)">
                            <div class="project-images-container">
                                <div class="images-container">
                                    <a href="#" data-toggle="modal" data-target="#exampleModal" @click="changeModalValues(project_image.image, project_image.id, (project_image.description) ? project_image.description : 'No description.')">
                                        <img :src="'/storage/images/projects/professional/' + project_image.image" :alt="project_image.image">
                                    </a>
                                </div>
                                <div class="project-images__options" v-bind:id="'image-options-' + index + '-' + key">
                                    <a
                                    href="#" data-toggle="modal" data-target="#exampleModal" title="Edit"
                                    @click="changeModalValues(project_image.image, project_image.id, (project_image.description) ? project_image.description : 'No description.' )"
                                    ><i class="far fa-edit"></i></a>&ensp;
                                    <a href="#" title="Delete"><i class="far fa-trash-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Display if the project does not contain any image -->
                <div v-else>
                    <div class="row cstm-mb-2">
                        <div class="col-md-3">
                            <div class="project-images-container">
                                <div class="images-container">
                                    <img src="/storage/images/noimage.png" alt="no-image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="cstm-hr mb-4">

                <a :href="'/profile/' + project.professional.username" class="btn -back">Go back</a>
            </div>
        </div>

        <!-- Blog -->
        <div v-if="project_blog != null" class="panel">
            <div class="panel__header">
                <h2 class="panel__title">Project Blog</h2>
                <div class="panel__header-line"></div>
            </div>


            <div class="panel__body">
                <!-- Blog Attributes -->
                <div class="d-flex">
                    <div>
                        <div class="container--img-border overflow-hidden rounded-circle" style="height: 50px; width: 50px">
                            <img v-if="project_blog.user.image != null" :src="'/storage/images/profile-images/' + project_blog.user.image" class="img--responsive" :alt="project_blog.user.username">
                            <img v-else src="/storage/images/profile-images/default.png" class="img--responsive" :alt="project_blog.user.username">
                        </div>
                    </div>
                    <div class="ml-3">
                        <div class="d-flex align-items-center">
                            <p>
                                <a :href="'/profile/' + project_blog.user.username ">
                                    {{ project_blog.user.first_name + ' ' + project_blog.user.last_name}}
                                </a><br>
                                <small class="text-muted">
                                    {{ moment(project_blog.created_at).tz("Asia/Manila").fromNow() }} at {{ moment(project_blog.created_at).tz("Asia/Manila").format('h:m A') }}
                                </small>
                            </p>
                        </div>
                        <div class="my-3">
                            <h4 v-text="project_blog.title"></h4>
                            <p v-html="project_blog.content"></p>
                        </div>
                    </div>
                </div>

                <hr class="cstm-hr">

                <!-- Add blog comment -->
                <div>
                    <div class="d-flex">
                        <div>
                            <div class="container--img-border overflow-hidden rounded-circle" style="height: 50px; width: 50px">
                                <img v-if="session.user_image != null" :src="'/storage/images/profile-images/' + session.user_image" class="img--responsive" :alt="session.user_username">
                                <img v-else src="/storage/images/profile-images/default.png" class="img--responsive" :alt="session.user_username">
                            </div>
                        </div>
                        <div class="ml-2 w-100">
                            <form method="post" :action="'/projects/' + project.code + '/blog/' + project_blog.id + '/comment'">
                                <input type="hidden" name="_token" :value="csrf">
                                <div>
                                    <input type="hidden" name="_token" :value="csrf">
                                    <textarea name="comment"></textarea>
                                </div>
                                <button class="btn -submit mt-2">Submit</button>
                            </form>
                        </div>
                    </div>
<!--                     <form method="post" :action="'/projects/' + project.code + '/blog/' + project_blog.id + '/comment'">
                        <input type="hidden" name="_token" :value="csrf">
                        <textarea name="comment"></textarea>
                        <button class="btn -submit mt-2">Submit</button>
                    </form> -->
                </div>

                <hr>

                <!-- Blog comments -->
                <div>
                    <ul>
                        <li v-for="comment in project_blog.comments">
                            <div class="p-3 my-3" style="border: 2px solid #eee">
                                <div class="d-flex">
                                    <div>
                                        <div class="container--img-border overflow-hidden rounded-circle" style="height: 50px; width: 50px">
                                            <img v-if="comment.user.image != null" :src="'/storage/images/profile-images/' + comment.user.image" class="img--responsive" :alt="comment.user.username">
                                            <img v-else src="/storage/images/profile-images/default.png" class="img--responsive" :alt="comment.user.username">
                                        </div>
                                    </div>
                                    <div class="ml-2">
                                        <div class="d-flex align-items-center">
                                            <p>
                                                <a :href="'/profile/' + comment.user.username">{{ comment.user.first_name + ' ' + comment.user.last_name }}</a><br>
                                                <small class="text-muted">{{ moment(comment.created_at).tz("Asia/Manila").fromNow() }} at {{ moment(comment.created_at).tz("Asia/Manila").format('h:m A') }}</small>
                                            </p>
                                        </div>
                                        <p class="mt-2" v-html="comment.comment"></p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Empty Blog -->
        <div v-else class="panel">
            <div class="panel__header">
                <h2 class="panel__title">Project Blog</h2>
                <div class="panel__header-line"></div>
            </div>

            <div class="panel__body">
                <div class="project-blog-content mb-4">
                    <p>No data to show.</p>
                </div>

                <hr class="cstm-hr">

                <div>
                    <p>Comments are not available.</p>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import _ from 'lodash'
import vue2Dropzone from 'vue2-dropzone'

export default {
    props: ['session', 'project', 'project_blog'],
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            dropzoneOptions: {
                url: '/projects/' + this.project.code + '/images',
                thumbnailWidth: 200,
                addRemoveLinks: true,
                dictDefaultMessage: "<i class='fas fa-cloud-upload-alt'></i>&ensp;Drop files here to upload",
                autoProcessQueue: false
            },
        };
    },
    methods: {
        submitDropzone(event) {
            event.preventDefault();
            myDropzone.processQueue();
        },
        projectImageHover(index, key) {
            document.getElementById('image-options-' + index + '-' + key).style.display = 'flex';
        },
        projectImageRemoveHover(index, key) {
            document.getElementById('image-options-' + index + '-' + key).style.display = 'none';
        },
        changeModalValues(img, id, description){
            $('#project-img--modal__form').attr('method', 'post');
            $('#project-img--modal__form').attr('action', '/projects/' + this.project.code + '/images/' + id);
            $('#project-img-id').attr('value', id);
            $('#project-img--modal__img').attr('src', '/storage/images/projects/professional/' + img);
            $('#project-img--modal__img').attr('alt', '/storage/images/projects/professional/' + img);
            $('#project-img--modal__description').text(description);
        },
        moment: function (date) {
            return moment(date);
        },
    },
    computed: {
        chunkedProjects() {
            return _.chunk(this.project.images, 4);
        },
    }
}
</script>