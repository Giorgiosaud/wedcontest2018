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
                    subscribed: false
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
                if(typeof newCountry!="object"){
                    return this.form.country='';
                }
                this.form.country=newCountry.code;
                this.form.phone='+'+newCountry.calling_code;}
        }
    };
</script>
