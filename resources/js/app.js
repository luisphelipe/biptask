
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key)))

Vue.component('tag-form', require('./components/tagForm.vue'));
Vue.component('twitter-post', require('./components/twitterPost.vue'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        messages: [],
        tags: [],
        url: document.querySelector('meta[name="app-url"]').getAttribute('content')
    },
    methods: {
        addTag(tag) {
            this.tags.push(tag);
        },
        makeQuery() {
            axios
            .get(this.url + '/query')
            .then(response => {
                console.log(response.data);
                this.messages = response.data.concat(this.messages);
            }); 
        },
        delTag(index) {
            axios
            .delete(this.url + '/tag/' + this.tags[index].id)
            .then(response => {
                console.log(response.data);
            }); 

            this.tags.splice(index, 1);
        },
        delPost(index) {
            this.messages.splice(index, 1);
        }
    },
    mounted() {
        axios
        .get(this.url + '/message')
        .then(response => {
            this.messages = this.messages.concat(response.data);
        });

        axios
        .get(this.url + '/tag')
        .then(response => {
            this.tags= this.tags.concat(response.data);
            console.log(this.tags)
        });
    }
});
