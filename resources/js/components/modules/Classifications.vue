<template>
  <div>
    <multiselect
      name="classifications"
      v-model="value"
      tag-placeholder="Add this as new tag"
      deselect-label="Can't remove this value"
      label="name"
      track-by="id"
      :options="options"
      :multiple="true"
      :searchable="true"
      :allow-empty="false"
      :taggable="true"
      @tag="addTag"
      placeholder="Select classifications"
    ></multiselect>
    <select name="classifications[]" style="display:none;" multiple>
      <option v-for="classification in value" :value="classification.id" selected="selected"></option>
    </select>
  </div>
</template>

<script>
import axios from "axios";
import Multiselect from "vue-multiselect";

export default {
  components: {
    Multiselect
  },
  data() {
    return {
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      value: "",
      options: []
    };
  },
  created() {
    axios.get("/api/classifications").then(res => {
      this.options = res.data;
    });
  },
  methods: {
    addTag(newTag) {
      const tag = {
        name: newTag,
        code: newTag.substring(0, 2) + Math.floor(Math.random() * 10000000)
      };
      this.options.push(tag);
      this.value.push(tag);
    }
  }
};
</script>