
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');

// *
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
 

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const app = new Vue({
//     el: '#app'
// });
// 
import Pusher from "pusher-js"
import Echo from "laravel-echo"

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '27ceda8f6b6960202ec3',
    cluster: 'eu',
    encrypted: true
});

// window.Echo = new Echo({
//     broadcaster: 'redis',
//     key: 'здесь-ваш-ключ-pusher'
// });


// window.io = require('socket.io-client');

// // Have this in case you stop running your laravel echo server
// if (typeof io !== 'undefined') {
  
//   let token = document.head.querySelector('meta[name="csrf-token"]');

//   window.Echo = new Echo({
//     broadcaster: 'socket.io',
//     host: window.location.hostname + ':6001',
//     csrfToken: token.content,
//     // auth:
//     // {
//     //     headers:
//     //     {
//     //         'Authorization': 'Bearer ' + 'Ut9mvfOo1NK7B5fQohaKMTmSIK5nCOEN'
//     //     }
//     // }

//   });
// }


        // Echo
        // .join('mess')
        // .here( (ee) => {
        //     console.log('here')
        // })
        // .joining( (e) => {
        //     console.log('joined');
        // });



