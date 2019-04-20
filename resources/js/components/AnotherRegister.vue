<template>
    <v-card class="elevation-12">
        <v-stepper v-model="e1">
            <v-stepper-header>
                <v-stepper-step :complete="e1 > 1" step="1">Name of step 1</v-stepper-step>

                <v-divider></v-divider>

                <v-stepper-step :complete="e1 > 2" step="2">Name of step 2</v-stepper-step>

                <v-divider></v-divider>

                <v-stepper-step step="3">Name of step 3</v-stepper-step>
            </v-stepper-header>

            <v-stepper-items>
                <v-form  ref="form"
                         v-model="valid"
                         lazy-validation>
                    <v-form v-model="form1valid">
                        <v-stepper-content step="1">
                            <v-card
                                class="mb-5"
                                color="grey lighten-1"
                                height="200px"
                            >
                                <v-text-field error-messages :rules="nameRules" v-model="form.name"   prepend-icon="person" name="name" label="name" type="text"></v-text-field>
                                <v-text-field :messages="emailerrorstate.msg" :error="emailerrorstate.state" error-messages :rules="emailRules" v-model="form.email"   prepend-icon="email" name="email" label="email" type="text"></v-text-field>

                            </v-card>

                            <v-btn
                                color="primary"
                                @click="form1submit"
                                :disabled="!form1valid"
                            >
                                Continue
                            </v-btn>

                        </v-stepper-content>
                    </v-form>
                    <v-form v-model="form2valid">
                <v-stepper-content step="2">
                    <v-card
                        class="mb-5"
                        color="grey lighten-1"
                        height="200px"
                    >
                        <v-text-field :messages="fqdnerrorstate.msg" :error="fqdnerrorstate.state" error-messages :rules="fqdnRules" v-model="form.fqdn"  prepend-icon="domain" name="fqdn" label="fqdn" type="text"></v-text-field>

                    </v-card>

                    <v-btn
                        color="primary"
                        @click="form2submit()"
                        :disabled="!form2valid"
                    >
                        Continue
                    </v-btn>

                    <v-btn flat>Cancel</v-btn>
                </v-stepper-content>
                    </v-form>
                    <v-form v-model="form3valid">
                <v-stepper-content step="3">
                    <v-card
                        class="mb-5"
                        color="grey lighten-1"
                        height="200px"
                    >
                        <v-text-field validate-on-blur error-messages :rules="passwordRules" v-model="form.password" prepend-icon="lock" name="password" label="Password" id="password" type="password"></v-text-field>
                        <v-text-field  validate-on-blur error-messages :rules="passwordConfirmRules" v-model="form.password_confirmation" prepend-icon="lock" name="password_confirmation" label="Password confirmation" id="password_confirmation" type="password"></v-text-field>

                    </v-card>

                    <v-btn
                        color="primary"
                        @click="login()"
                        :disabled="!form3valid"
                    >
                        Continue
                    </v-btn>

                </v-stepper-content>
                    </v-form>
                </v-form>
            </v-stepper-items>
        </v-stepper>
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
                e1: 0,
                // Create a new form instance
                form: new Form({
                    name: '',
                    fqdn:'',
                    email: '',
                    password: '',
                    password_confirmation: ''

                }),
                form1: new Form({
                    name: '',
                    email: ''

                }),
                form2: new Form({
                    fqdn: ''

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
                    v => /.+@.+/.test(v) || 'E-mail must be valid'
                ],
                passwordRules: [
                    v => !!v || 'Password is required',
                    v => !!v && v.length >=6 || 'Password should contain six or more characters',
                    //v=> !this.errors.has('password') || this.form.errors.password
                ],
                passwordConfirmRules: [
                    v => !!v || 'Password is required',
                    v => !!v && v.length >=6 || 'Password should contain six or more characters',
                    v =>  v=== this.form.password || 'Password Should match!'
                ],
                valid:false,
                loading:false,
                form1valid:false,
                form2valid:false,
                form3valid:false,
                emailErrorstate:false,
                nameErrorstate:false,
                fqdnErrorstate:false
            }
        },
        computed: {
            emailerrorstate: function () {
                if(this.form1.errors.has('email') && this.form.email === this.form1.email){
                    return {
                        msg:this.form1.errors.get('email'),
                        state:true
                    };
                }
                else if(this.form1.errors.has('email')  && this.form.email !== this.form1.email ){
                    return {
                        msg:'',
                        state:false
                    };
                }
                else{
                    return {
                        msg:'',
                        state:false
                    };
                }

            },
            nameerrorstate: function () {
                return this.firstName + ' ' + this.lastName
            },
            fqdnerrorstate: function () {
                if(this.form2.errors.has('fqdn') && this.form.fqdn === this.form2.fqdn){
                    return {
                        msg:this.form2.errors.get('fqdn'),
                        state:true
                    };
                }
                else if(this.form2.errors.has('fqdn')  && this.form.fqdn !== this.form1.fqdn ){
                    return {
                        msg:'',
                        state:false
                    };
                }
                else{
                    return {
                        msg:'',
                        state:false
                    };
                }
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
            email(){
                if(this.form1.errors.has('email')){
                    return 'email has been taken';
                }
            },
            form1submit(){
                this.loading = true;
                this.form1.name=this.form.name;
                this.form1.email=this.form.email;
                // Submit the form via a POST request
                let self=this;
                this.form1.post('/Potentialcustomer')
                    .then(({ data }) => {
                        this.e1=2;
                    }).catch(({ errors }) => {
                    this.form1valid=false;
                    this.emailErrorstate=true;
                })
            },
            form2submit(){
                this.loading = true;
                this.form2.fqdn=this.form.fqdn;
                // Submit the form via a POST request
                let self=this;
                this.form2.post('/checkfqdn')
                    .then(({ data }) => {
                        this.e1=3;
                    }).catch(({ errors }) => {
                    this.form2valid=false;
                })
            }
        }
    };
</script>
