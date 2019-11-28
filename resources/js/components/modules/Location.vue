<template>
    <div>
        <div>
          <label class="typo__label">Select with search</label>
          <multiselect v-model="value" :options="options" :custom-label="nameWithLang" placeholder="Select one" label="name" track-by="name"></multiselect>
          <pre class="language-json"><code>{{ value  }}</code></pre>
      </div>
    </div>
</template>

<script>
import axios from 'axios'
import Multiselect from 'vue-multiselect'

export default {
    components: {
        Multiselect
    },
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            value: { name: 'Vue.js', language: 'JavaScript' },
            options: [
                { name: 'Vue.js', language: 'JavaScript' },
                { name: 'Rails', language: 'Ruby' },
                { name: 'Sinatra', language: 'Ruby' },
                { name: 'Laravel', language: 'PHP' },
                { name: 'Phoenix', language: 'Elixir' }
            ]
        };
    },
    created() {
        axios.get('/api/classifications')
        .then(res => {
            console.log(res.data);
            this.options = res.data;
        });
    },
};
</script>