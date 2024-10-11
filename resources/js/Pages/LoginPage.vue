<template>
    <div>
        <v-img
            class="mx-auto my-6"
            max-width="228"
            src="https://cdn.vuetifyjs.com/docs/images/logos/vuetify-logo-v3-slim-text-light.svg"
        ></v-img>

        <v-card
            class="mx-auto pa-12 pb-8"
            elevation="8"
            max-width="448"
            rounded="lg"
        >
            <div class="text-subtitle-1 text-medium-emphasis">Account</div>

            <!-- Email Field -->
            <v-text-field
                v-model="email"
                density="compact"
                placeholder="Email address"
                prepend-inner-icon="mdi-email-outline"
                variant="outlined"
            ></v-text-field>

            <div class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between">
                Password
                <a
                    class="text-caption text-decoration-none text-blue"
                    href="#"
                    rel="noopener noreferrer"
                    target="_blank"
                >
                    Forgot login password?
                </a>
            </div>

            <!-- Password Field -->
            <v-text-field
                v-model="password"
                :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'"
                :type="visible ? 'text' : 'password'"
                density="compact"
                placeholder="Enter your password"
                prepend-inner-icon="mdi-lock-outline"
                variant="outlined"
                @click:append-inner="visible = !visible"
            ></v-text-field>

            <!-- Log In Button -->
            <v-btn
                class="mb-8"
                color="blue"
                size="large"
                variant="tonal"
                block
                :disabled="!isValid"
                @click="checkCredentials"
            >
                Log In
            </v-btn>

            <v-card-text class="text-center">
                <a
                    class="text-blue text-decoration-none"
                    href="/register"
                    rel="noopener noreferrer"
                >
                    Sign up now <v-icon icon="mdi-chevron-right"></v-icon>
                </a>
            </v-card-text>
        </v-card>

        <!-- Error Message -->
        <v-snackbar v-model="snackbar" color="red" timeout="3000">
            {{ errorMessage }}
            <v-btn color="white" text="" @click="snackbar = false">Close</v-btn>
        </v-snackbar>

    </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia'; // Import Inertia for navigation
import axios from 'axios'; // Import axios for API requests

export default {
    name: 'LoginPage',
    data: () => ({
        email: '', // Bind the email input
        password: '', // Bind the password input
        visible: false, // Password visibility toggle
        isValid: false, // Initially, the Log In button is disabled
        snackbar: false, // Controls the visibility of the snackbar
        errorMessage: '', // To store error messages
    }),
    watch: {
        // Watch for changes in email and password and trigger validation
        email() {
            this.validateForm();
        },
        password() {
            this.validateForm();
        },
    },
    methods: {
        // Validate the form by checking if both email and password are filled
        validateForm() {
            this.isValid = this.email !== '' && this.password !== '';
        },
        // Check if the credentials are valid using an API call
        async checkCredentials() {
            try {
                const response = await axios.post('/api/login', {
                    email: this.email,
                    password: this.password,
                });

                if (response.data.user) {
                    this.navigateToExplorePage(); // Redirect to the explore page if credentials are correct
                } else {
                    this.showError('Invalid credentials, please try again.'); // Show error message
                }
            } catch (error) {
                console.error('Login error:', error);
                this.showError('An error occurred during login. Please try again.');
            }
        },
        navigateToExplorePage() {
            Inertia.visit('/explore'); // Redirect to the explore page
        },
        showError(message) {
            this.errorMessage = message; // Set the error message
            this.snackbar = true; // Show the snackbar
        },
    },
};
</script>

<style scoped>

</style>
