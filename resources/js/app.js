import './bootstrap';

import {createApp} from 'vue'

import App from './App.vue'

import VueAxios from 'vue-axios';
import axios from 'axios';

// Vue.mixin({
//     methods: {
//         formatTime(eventTime) {
//             let [hours, minutes] = eventTime.split(":");
//             let time = new Date();
//             time.setHours(hours);
//             time.setMinutes(minutes);
//             const ampm = time.getHours() >= 12 ? "PM" : "AM";
//             let hours12 = time.getHours() % 12;
//             hours12 = hours12 ? hours12 : 12; // convert 0 to 12
//             return `${hours12}:${minutes} ${ampm}`;
//         }
//     },
// })

createApp(App).use(VueAxios, axios).mixin({
    methods: {
        formatTime(eventTime) {
            let [hours, minutes] = eventTime.split(":");
            let time = new Date();
            time.setHours(hours);
            time.setMinutes(minutes);
            const ampm = time.getHours() >= 12 ? "PM" : "AM";
            let hours12 = time.getHours() % 12;
            hours12 = hours12 ? hours12 : 12; // convert 0 to 12
            return `${hours12}:${minutes} ${ampm}`;
        }
    },
}).mount("#app")



