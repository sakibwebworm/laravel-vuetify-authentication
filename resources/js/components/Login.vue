<template>
    <v-card class="elevation-12">
        <v-toolbar dark color="primary">
            <v-toolbar-title>Login form</v-toolbar-title>
            <v-spacer></v-spacer>
        </v-toolbar>
        <v-card-text>
            <v-form  ref="form"
                     v-model="valid"
                     lazy-validation>
                <v-text-field error-messages :rules="emailRules" v-model="form.email"  prepend-icon="person" name="login" label="Login" type="text"></v-text-field>
                <v-text-field v-model="form.password" prepend-icon="lock" name="password" label="Password" id="password" type="password"></v-text-field>
            </v-form>
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
                   :disabled="!valid"
                    @click="login" color="primary">Login</v-btn>
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
                    email: '',
                    password: '',
                    remember: false
                }),
                emailRules: [
                    v => !!v || 'E-mail is required',
                    v => /.+@.+/.test(v) || 'E-mail must be valid',
                    v => !form.errors.has('username') || form.errors.email
                ]
            }
        },
        computed:{
            emailerrors(){
                return [];
            }
        },
        methods: {
            validate () {
                if (this.$refs.form.validate()) {
                    this.snackbar = true
                }
            },
            login () {
                this.loading = true;
                // Submit the form via a POST request
                this.form.post('/login')
                    .then(({ data }) => {
                        console.log(this.form.errors.get(email)) })
            }
        }
    };
</script>
