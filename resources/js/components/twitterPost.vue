<template>
    <div class="card my-2 border">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h5 class="card-title">{{ name }} 
                    <a v-show="link" :href="link">link</a>
                </h5>

                <img src="/svg/close.svg" alt="delete" class="ml-2 p-1" @click="delPost" style="height: 21px">
            </div>
            <p class="card-text">
                {{ body }}
            </p>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['name', 'body', 'link', 'index', 'postid'],
        data() {
            return {
                url: document.querySelector('meta[name="app-url"]').getAttribute('content')
            };
        },
        methods: {
            delPost() {
                axios
                .delete(this.url + '/message/' + this.postid)
                .then(response => {
                    console.log(response.data);
                }); 
                this.$emit('del-post', this.index)
            }
        },
        mounted() {
            console.log('twitter-message mounted.')
        }
    }
</script>
