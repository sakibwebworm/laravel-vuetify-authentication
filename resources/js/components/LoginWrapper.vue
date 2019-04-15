<template>
    <div id="app">
        <v-app id="inspire">

            <v-toolbar color="primary" dark fixed app>
                <v-toolbar-title text-center>Application</v-toolbar-title>
            </v-toolbar>
            <v-content>
                <v-container fluid fill-height>
                    <v-layout
                        justify-center
                        align-center
                    >
                        <v-flex text-xs-center sm8 md6 lg4>
                            <login-component></login-component>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-content>
            <v-footer color="indigo" app inset>
                <span class="white--text">&copy; 2017</span>
            </v-footer>
        </v-app>
    </div>
</template>

<script>

    export default {

        components: {
            'login-form': require('./Login')
        },

        mixins: [],

        data () {
            return {
                //
            }
        },

        props: {
            //
        },

        computed: {
            //
        },

        created () {
            //
        },

        mounted () {
            //
        },

        methods: {
            //
        }
    };
</script>
