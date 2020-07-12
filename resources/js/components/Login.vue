<template>
    <v-app id="inspire">
        <v-main>
            <v-container
                class="fill-height"
                fluid
            >
                <v-row
                    align="center"
                    justify="center"
                >
                    <v-col
                        cols="12"
                        sm="8"
                        md="4"
                    >
                        <v-card class="elevation-12">
                            <v-toolbar
                                color="primary"
                                dark
                                flat
                            >
                                <v-toolbar-title>Форма авторизации</v-toolbar-title>
                                <v-spacer></v-spacer>

                            </v-toolbar>
                            <v-card-text>
                                <v-form v-model="valid">
                                    <v-text-field
                                        label="Email"
                                        :rules="emailRules"
                                        v-model="email"
                                        prepend-icon="mdi-account"
                                        type="email"
                                        required
                                    ></v-text-field>

                                    <v-text-field
                                        id="password"
                                        label="Пароль"
                                        :rules="nameRules"
                                        v-model="password"
                                        prepend-icon="mdi-lock"
                                        type="password"
                                        required
                                    ></v-text-field>
                                </v-form>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn @click="login" color="primary">Войти</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
    import axios from 'axios';
    export default {
        data () {
            return {
                valid: false,
                email: '',
                password: '',
                nameRules: [
                    v => !!v || 'Введите пароль',
                    v => v.length <= 10 || 'Name must be less than 10 characters',
                ],
                emailRules: [
                    v => !!v || 'Введите Email',
                    v => /.+@.+/.test(v) || 'Введите валидный Email',
                ],
            }
        },
        props: {
            source: String,
        },
        methods: {
            login () {
                axios.post('/authenticate', {
                    'email': this.email,
                    'password': this.password,
                    '_token': $('input[name="_token"]').attr('value')
                })
                .then(res => {
                    console.log(res)
                    window.location.href = '/';
                })
                .catch(e => console.log(e))
            }
        }
    }
</script>
