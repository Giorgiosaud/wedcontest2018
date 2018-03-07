<script>
    import Hub from '../events/Hub.js';

    export default {
        data() {
            return {
                form: {
                    name: "",
                    last_name: "",
                    phone: "",
                    country: "",
                    referred: "",
                    language: "",
                    email: "",
                    password: "",
                    password_confirmation: "",
                    subscribed: ""
                },
                country:"",
                feedback: "",
                loading: false,
                errors: {}
            };
        },
        methods: {
            register() {
                this.loading = true;

                axios
                    .post("/register", this.form)
                    .then(response => {
                        location.reload();
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;

                        this.loading = false;
                    });
            },
        },
        watch:{
            country(newCountry,oldCountry){
                if(typeof newCountry==="object"){
                    return this.form.country=newCountry.code;
                }
                return this.form.country='';
            }
        }
    };
</script>
