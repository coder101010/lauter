require('./bootstrap');
import linkify from 'vue-linkify'

window.Vue = require('vue').default;

Vue.use(require('vue-moment'));
Vue.directive('linkified', linkify)
Vue.component('avatar', require('vue-avatar').default);
Vue.component('chat-messages', require('./components/ChatMessages.vue').default);
Vue.component('chat-form', require('./components/ChatForm.vue').default);

const app = new Vue({
    el: '#app',

    data: {
        messages: []
    },

    created() {
        this.fetchMessages();
        window.Echo.private('chat')
        .listen('MessageSent', (e) => {
          this.messages.push({
            message: e.message.message,
            attachment: e.message.attachment,
            created_at: e.message.created_at,
            user: e.user
          });
        });        
    },
    
    methods: {
        fetchMessages() {
            axios.get('/messages').then(response => {
                this.messages = response.data;
            });
        },
        addMessage(message) {
            this.messages.push(message);
            axios.post('/messages', message).then(response => {
            });
        }
    }
});