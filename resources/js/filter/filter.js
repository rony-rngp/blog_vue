import Vue from 'vue';


import moment from "moment";

//------Time----
Vue.filter('time', function(a){
    return moment(a).format("MMMM D, Y");
});

//--------Length----
Vue.filter('subString', function (content, length) {
    return content.substring(0, length) + '...';
});


