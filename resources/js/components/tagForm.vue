<template>
    <div class="d-flex justify-content-center align-items-center mb-2">
        <input class="form-control w-75 mr-1" type="text" name="query" placeholder="#fiat" v-model="query">
        <button class="btn w-25" type="submit" @click.prevent="addTag">Add Tag</button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                query: '',
                url: document.querySelector('meta[name="app-url"]').getAttribute('content')
            }
        },
        methods: {
            addTag() {
                axios
                .post(this.url + '/tag', {
                    'body': this.query
                })
                .then(response => {
                    this.$emit('add-tag', response.data);
                });

                this.query = '';
            }
        },
        mounted() {
            console.log('tag-form mounted.')
        }
    }
</script>
