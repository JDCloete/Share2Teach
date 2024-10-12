<template>
    <v-app class="background-image">
        <v-toolbar color="primary" dark>
            <img
                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSv6vyFZbiqMYZ5njBX94kjv3u0bq_QyUvQCIB0Qj9rhlI5ExI26FAlmU4c30jUUgTgFQQ&usqp=CAU"
                alt="Logo"
                class="mr-2 rounded-image"
                width="30"
                height="30"
                style="object-fit: cover; margin-left: 15px;"
            />
            <v-toolbar-title class="d-flex">Login to Share2Teach</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn text="" @click="navigateToRegisterPage">
                <v-icon left class="mr-2">mdi-account-plus-outline</v-icon>
                Register
            </v-btn>
        </v-toolbar>

        <v-container class="main-container d-flex justify-center align-center">
            <v-card class="mx-2 custom-card" max-width="400" elevation="12">
                <v-card-title class="d-flex justify-center">Login</v-card-title>
                <v-card-text>
                    <v-form ref="form" @submit.prevent="checkCredentials">
                        <!-- Email Field -->
                        <v-text-field
                            v-model="email"
                            label="Email Address"
                            type="email"
                            :error-messages="errors.email"
                            prepend-inner-icon="mdi-email-outline"
                            :rules="[rules.required, rules.email]"
                            required
                        ></v-text-field>

                        <!-- Password Field -->
                        <v-text-field
                            v-model="password"
                            label="Password"
                            :type="visible ? 'text' : 'password'"
                            :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'"
                            @click:append-inner="visible = !visible"
                            prepend-inner-icon="mdi-lock-outline"
                            required
                        ></v-text-field>

                        <!-- Forgot Password Link -->
                        <div class="d-flex justify-end mb-4">
                            <a @click.prevent="navigateToResetPasswordPage" href="#" class="text-decoration-none text-blue">Forgot password?</a>
                        </div>

                        <!-- Submit Button -->
                        <v-btn
                            color="primary"
                            :disabled="!isValid"
                            block
                            @click="checkCredentials"
                        >
                            Log In
                        </v-btn>
                    </v-form>
                </v-card-text>
                <v-card-text class="text-center mt-4">
                    Don't have an account?
                    <a class="text-blue text-decoration-none" href="/register">
                        Sign up now
                        <v-icon icon="mdi-chevron-right"></v-icon>
                    </a>
                </v-card-text>
            </v-card>
        </v-container>

        <!-- Error Message -->
        <v-snackbar v-model="snackbar" color="red" timeout="3000">
            {{ errorMessage }}
            <v-btn color="white" text="" @click="snackbar = false">Close</v-btn>
        </v-snackbar>
    </v-app>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';
import axios from 'axios';

export default {
    name: 'LoginPage',
    data() {
        return {
            email: '',
            password: '',
            visible: false,
            isValid: false,
            snackbar: false,
            errorMessage: '',
            rules: {
                required: value => !!value || 'This field is required.',
                email: value => /.+@.+\..+/.test(value) || 'E-mail must be valid.',
            },
            errors: {},
        };
    },
    watch: {
        email() {
            this.validateForm();
        },
        password() {
            this.validateForm();
        },
    },
    methods: {
        validateForm() {
            this.isValid = this.email !== '' && this.password !== '';
        },
        async checkCredentials() {
            try {
                const response = await axios.post('/api/login', {
                    email: this.email,
                    password: this.password,
                });

                if (response.data.user) {
                    this.navigateToExplorePage();
                } else {
                    this.showError('Invalid credentials, please try again.');
                }
            } catch (error) {
                this.showError('An error occurred during login. Please try again.');
            }
        },
        navigateToExplorePage() {
            Inertia.visit('/explore');
        },
        showError(message) {
            this.errorMessage = message;
            this.snackbar = true;
        },
        navigateToRegisterPage() {
            Inertia.visit('/register');
        },
        navigateToResetPasswordPage() {
            Inertia.visit('/reset-password'); // Adjust the route if needed
        },
    },
};
</script>

<style scoped>
.background-image {
    background-image: url('https://as2.ftcdn.net/v2/jpg/03/57/05/61/1000_F_357056172_AOxoyKV4D20Bsw17SvkzcMfWSOLTIGzJ.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    min-height: 100vh;
}
.main-container {
    height: calc(100vh - 64px);
    display: flex;
    justify-content: center;
    align-items: center;
}
.custom-card {
    border: 2px solid #3F51B5; /* Set the border color to match the theme */
    border-radius: 8px;
    padding: 20px;
}
</style>
