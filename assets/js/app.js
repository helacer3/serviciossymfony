import Vue from 'vue';
import App from './components/App';
import '../css/app.css';
import axios from 'axios';

new Vue({
    el: '#appServices',
    render: h => h(App)
});