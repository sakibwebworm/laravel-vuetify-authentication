<template>
    <v-card class="elevation-12">
        <v-toolbar dark color="primary">
            <v-toolbar-title>Login form</v-toolbar-title>
            <div v-html="form.errors"></div>
            <v-spacer></v-spacer>
        </v-toolbar>
        <v-card-text>
            <v-form  ref="form"
                     v-model="valid"
                     lazy-validation>
                <v-text-field error-messages :rules="nameRules" v-model="form.name"  prepend-icon="person" name="name" label="name" type="text"></v-text-field>
                <v-text-field error-messages :rules="fqdnRules" v-model="form.fqdn"  prepend-icon="domain" name="fqdn" label="fqdn" type="text"></v-text-field>
                <v-text-field error-messages :rules="emailRules" v-model="form.email"  prepend-icon="email" name="email" label="email" type="text"></v-text-field>
                <v-text-field validate-on-blur error-messages :rules="passwordRules" v-model="form.password" prepend-icon="lock" name="password" label="Password" id="password" type="password"></v-text-field>
                <v-text-field  validate-on-blur error-messages :rules="passwordConfirmRules" v-model="form.password_confirmation" prepend-icon="lock" name="password_confirmation" label="Password confirmation" id="password_confirmation" type="password"></v-text-field>
            </v-form>
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
                :disabled="!valid"
               :loading="loading" @click="login" color="primary">Login</v-btn>
        </v-card-actions>
    </v-card>
</template>

<script>
    import Vue from 'vue'
    import { Form, HasError, AlertError } from 'vform'

    Vue.component(HasError.name, HasError)
    Vue.component(AlertError.name, AlertError)
    export default {

        data () {
            return {
                // Create a new form instance
                form: new Form({
                    name: '',
                    fqdn:'',
                    email: '',
                    password: '',
                    password_confirmation: ''

                }),

                emailError:false,
                nameRules:[
                    v=> !!v || 'Name is required',
                    //v=> !this.errors.has('name') || this.form.errors.name
                ],
                fqdnRules:[
                    v=> !!v || 'Domain is required',
                    //v=> !this.errors.has('fqdn') || this.form.errors.fqdn
                ],
                emailRules: [
                    v => !!v || 'E-mail is required',
                    v => /.+@.+/.test(v) || 'E-mail must be valid',
                    v =>  v != this.form.errors.has('email')  || 'Email is taken',
                ],
                passwordRules: [
                    v => !!v || 'Password is required',
                    v => !!v && v.length >=6 || 'Password should contain six or more characters',
                    //v=> !this.errors.has('password') || this.form.errors.password
                ],
                passwordConfirmRules: [
                    (v) => !!v || 'Confirmation Password is required',
                    //(v) => v == this.form.password || 'Password must match'
                ],
                valid:false,
                loading:false
            }
        },
        methods: {
            passwordMatchError () {
                return (this.password === this.password_confirmation) ? '' : 'Password must match'
            },
            validate () {
                if (this.$refs.form.validate()) {
                    this.snackbar = true
                }
            },
            login () {
                this.loading = true;
                // Submit the form via a POST request
                let self=this;
                this.form.post('/register')
                    .then(({ data }) => {
                       alert(data);
                        }).catch(({ errors }) => {
                    this.emailError=true;
                })
            },
            setp1(){

            }
        }
    };
</script>
