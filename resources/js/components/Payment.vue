<template>
    <v-app id="inspire">
        <v-navigation-drawer
            v-model="drawer"
            :clipped="$vuetify.breakpoint.lgAndUp"
            app
        >
            <v-list dense>
                <template v-for="item in items">
                    <v-row
                        v-if="item.heading"
                        :key="item.heading"
                        align="center"
                    >
                        <v-col cols="6">
                            <v-subheader v-if="item.heading">
                                {{ item.heading }}
                            </v-subheader>
                        </v-col>
                        <v-col
                            cols="6"
                            class="text-center"
                        >
                            <a
                                href="#!"
                                class="body-2 black--text"
                            >EDIT</a>
                        </v-col>
                    </v-row>
                    <v-list-group
                        v-else-if="item.children"
                        :key="item.text"
                        v-model="item.model"
                        :prepend-icon="item.model ? item.icon : item['icon-alt']"
                        append-icon=""
                    >
                        <template v-slot:activator>
                            <v-list-item-content>
                                <v-list-item-title>
                                    {{ item.text }}
                                </v-list-item-title>
                            </v-list-item-content>
                        </template>
                        <v-list-item
                            v-for="(child, i) in item.children"
                            :key="i"
                            link
                        >
                            <v-list-item-action v-if="child.icon">
                                <v-icon>{{ child.icon }}</v-icon>
                            </v-list-item-action>
                            <v-list-item-content>
                                <v-list-item-title>
                                    {{ child.text }}
                                </v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list-group>
                    <v-list-item
                        v-else
                        :key="item.text"
                        link
                    >
                        <v-list-item-action>
                            <v-icon>{{ item.icon }}</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>
                                <a :href="item.url">{{ item.text }}</a>
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </template>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar
            :clipped-left="$vuetify.breakpoint.lgAndUp"
            app
            color="blue darken-3"
            dark
        >
            <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
            <v-toolbar-title
                style="width: 300px"
                class="ml-0 pl-4"
            >
                <span class="hidden-sm-and-down">CRM система</span>
            </v-toolbar-title>
            <!--            <v-text-field-->
            <!--                flat-->
            <!--                solo-inverted-->
            <!--                hide-details-->
            <!--                prepend-inner-icon="mdi-magnify"-->
            <!--                label="Search"-->
            <!--                class="hidden-sm-and-down"-->
            <!--            ></v-text-field>-->
            <v-spacer></v-spacer>
            <v-btn @click="logout">
                <v-icon left>mdi-logout</v-icon>
                Выйти
            </v-btn>

        </v-app-bar>
        <v-main>
            <v-container
                fluid
            >
                <v-row
                    align="center"
                    justify="center"
                >
                    <v-card style="width: 100%;">
                        <v-card-title>
                            Оплаты
                            <v-spacer></v-spacer>
                            <v-text-field
                                v-model="search"
                                append-icon="mdi-magnify"
                                label="Поиск"
                                single-line
                                hide-details
                            ></v-text-field>
                        </v-card-title>
                        <v-data-table
                            :headers="headers"
                            :items="payments"
                            :search="search"
                        ></v-data-table>
                    </v-card>
                </v-row>
            </v-container>
        </v-main>
        <v-btn
            bottom
            color="pink"
            dark
            fab
            fixed
            right
            @click="dialog = !dialog"
        >
            <v-icon>mdi-plus</v-icon>
        </v-btn>
        <v-dialog
            v-model="dialog"
            width="800px"
        >
            <v-card>
                <v-card-title class="grey darken-2">
                    Create contact
                </v-card-title>
                <v-container>
                    <v-row class="mx-2">
                        <v-col
                            class="align-center justify-space-between"
                            cols="12"
                        >
                            <v-row
                                align="center"
                                class="mr-0"
                            >
                                <v-avatar
                                    size="40px"
                                    class="mx-3"
                                >
                                    <img
                                        src="//ssl.gstatic.com/s2/oz/images/sge/grey_silhouette.png"
                                        alt=""
                                    >
                                </v-avatar>
                                <v-text-field
                                    placeholder="Name"
                                ></v-text-field>
                            </v-row>
                        </v-col>
                        <v-col cols="6">
                            <v-text-field
                                prepend-icon="mdi-account-card-details-outline"
                                placeholder="Company"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="6">
                            <v-text-field
                                placeholder="Job title"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <v-text-field
                                prepend-icon="mdi-mail"
                                placeholder="Email"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <v-text-field
                                type="tel"
                                prepend-icon="mdi-phone"
                                placeholder="(000) 000 - 0000"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <v-text-field
                                prepend-icon="mdi-text"
                                placeholder="Notes"
                            ></v-text-field>
                        </v-col>
                    </v-row>
                </v-container>
                <v-card-actions>
                    <v-btn
                        text
                        color="primary"
                    >More</v-btn>
                    <v-spacer></v-spacer>
                    <v-btn
                        text
                        color="primary"
                        @click="dialog = false"
                    >Cancel</v-btn>
                    <v-btn
                        text
                        @click="dialog = false"
                    >Save</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-app>
</template>

<script>
    import axios from 'axios'
    export default {
        props: {
            source: String,
        },
        data: () => ({
            search: '',
            headers: [
                { text: '#', value: 'id', sortable: false },
                {
                    text: 'Имя',
                    align: 'start',
                    sortable: false,
                    value: 'user.name',
                },
                { text: 'Email', value: 'user.email', sortable: false },
                { text: 'Телефон', value: 'user.phone', sortable: false },
                { text: 'Статус', value: 'status', sortable: false },
                { text: 'Сумма', value: 'sum', sortable: true },
                { text: 'Тариф', value: 'tariff', sortable: false },
                { text: 'Дата оплаты', value: 'created_at', sortable: true },
                { text: 'Подписка до', value: 'actived_at', sortable: false },
            ],
            dialog: false,
            drawer: null,
            items: [
                { icon: 'mdi-contacts', text: 'Подписчики', url: '/' },
                { icon: 'mdi-format-align-justify', text: 'Оплаты', url: '#' },
            ],
            payments: [],
            status_arr: [

            ]
        }),
        methods: {
            logout () {
                window.location.href = '/logout';
            },
            getPayments () {
                axios.get('/get-payments')
                    .then(res => {
                        this.payments = res.data;
                    })
            }
        },
        created () {
            this.getPayments();
        }
    }
</script>
