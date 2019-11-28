<template>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form id="project-img--modal__form">
                
                    <input type="hidden" name="_method" value="put">
                    <input type="hidden" name="_token" :value="csrf">
                    <input type="hidden" id="project-img-id" name="project_id">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div style="width: 100%; height: auto;">
                            <img id="project-img--modal__img" style="object-fit: cover; width: 100%; height: auto;">
                        </div>
                        <hr>
                        <div>
                            <p class="cstm-sm-title">Description</p>
                            <div v-if="session.account_id != project.professional.id">
                                <p id="project-img--modal__description">No description</p>
                            </div>
                            <div v-else>
                                <p id="project-image--modal__description-container">
                                    <span id="project-img--modal__description">No description</span>&ensp;
                                    <a href="#" @click="showDesciptionInput"><i class="fas fa-pen"></i></a>
                                </p>

                                <div class="form-group">
                                    <textarea name="description" id="project-image--modal__description-input" class="form-control" style="display:none; margin-top: .5rem"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="display:none;">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['session', 'project'],
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

        };
    },
    methods: {
        showDesciptionInput(){
            var descriptionText = $('#project-img--modal__description').text();

            $('#project-image--modal__description-container').hide();

            document.getElementsByClassName("modal-footer")[0].style.display = "flex";

            $('#project-image--modal__description-input').text(descriptionText);
            $('#project-image--modal__description-input').show();
        }
    }
}
</script>