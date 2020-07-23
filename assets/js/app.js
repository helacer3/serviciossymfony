import Vue    from 'vue';
import Users  from './components/Users';
import Wallet from './components/Wallet';
import axios  from 'axios';
import '../css/app.css';

window.onload = function () {
	new Vue({
	    el: '#appService',
	    //render: h => h(Users)
	    components: {Users, Wallet}
	});
}