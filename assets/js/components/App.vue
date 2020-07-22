<script>
  export default {
    data() {
      return {
        usrName: '',
        usrDocument: '',
        usrEmail: '',
        usrPhone: ''
      };
    },
    mounted() {
    },
    methods: {
      // save User
      saveUser: function (e) {
        e.preventDefault();
        // ajax Request
        this.axios.post('http://localhost/serviceSymfony/public/api/registerUser', {
          usrName: this.usrName,
          usrDocument: this.usrDocument,
          usrEmail: this.usrEmail,
          usrPhone: this.usrPhone
        })
        .then(function (response) {
          alert("usuario creado");
        })
        .catch(function (error) {
          alert("ocurrió un error con el usuario");
        });
      }
    }
  };
</script>
<style>
</style>