<template>
    <v-container class="d-flex justify-center align-center fill-height">
        <v-card width="400px" style="height: 600px;">
            <v-card-title class="text-h5 d-flex justify-center align-center">
                Register
            </v-card-title>

            <v-card-text>
                <v-form ref="form" v-model="valid" @submit.prevent="submit">
                    <!-- Name Field -->
                    <v-text-field
                        v-model="form.name"
                        label="Name"
                        :error-messages="errors.name"
                        :rules="[rules.required]"
                        required
                    ></v-text-field>

                    <!-- Surname Field -->
                    <v-text-field
                        v-model="form.surname"
                        label="Surname"
                        :error-messages="errors.surname"
                        :rules="[rules.required]"
                        required
                    ></v-text-field>

                    <!-- Email Field -->
                    <v-text-field
                        v-model="form.email"
                        label="Email"
                        type="email"
                        :error-messages="errors.email"
                        :rules="[rules.required, rules.email]"
                        @input="handleEmailInput"
                        required
                    ></v-text-field>

                    <!-- Password Field -->
                    <v-text-field
                        v-model="form.password"
                        label="Password"
                        type="password"
                        :error-messages="errors.password"
                        :rules="[rules.required, rules.minLength(8)]"
                        required
                    ></v-text-field>

                    <!-- Confirm Password Field -->
                    <v-text-field
                        v-model="form.confirmPassword"
                        label="Confirm Password"
                        type="password"
                        :rules="[rules.required, passwordMatch]"
                        required
                    ></v-text-field>

                    <!-- Submit Button -->
                    <v-btn
                        :disabled="!valid || !!errors.email || !!errors.password || !!errors.name || !!errors.surname"
                        color="primary"
                        class="mt-4"
                        @click="submit"
                    >
                        Register
                    </v-btn>
                </v-form>
            </v-card-text>
        </v-card>
    </v-container>
</template>

<script>
import { useForm } from '@inertiajs/inertia-vue3';

export default {
    data() {
        return {
            valid: false,
            form: useForm({
                name: '',
                surname: '',
                email: '',
                password: '',
                confirmPassword: '',
            }),
            rules: {
                required: value => !!value || 'This field is required.',
                email: value => /.+@.+\..+/.test(value) || 'E-mail must be valid.',
                minLength: length => value => value.length >= length || `Password must be at least ${length} characters.`,
            },
            errors: {}, // Initialize errors object
        };
    },
    methods: {
        submit() {
            this.form.post('/register', {
                onError: (errors) => {
                    console.error('Form errors:', errors); // Debugging statement
                    this.errors = errors; // Assign backend errors to the local errors object
                },
                onSuccess: (response) => {
                    console.log('User registered successfully'); // Debugging statement for success
                    // If successful, the response should redirect to the login page
                    window.location.href = '/login'; // Redirect to login page
                }
            });
        },
        handleEmailInput() {
            // Clear the email error when the user types in the email field
            if (this.errors.email) {
                console.log('Clearing email error'); // Debugging statement
                this.errors.email = ''; // Clear email error
            }
        },
        passwordMatch(value) {
            return value === this.form.password || 'Passwords do not match.';
        }
    },
    mounted() {
        // Ensure form values persist if the page reloads with errors
        this.form.name = this.$page.props.form?.name || '';
        this.form.surname = this.$page.props.form?.surname || '';
        this.form.email = this.$page.props.form?.email || '';
        this.errors = this.$page.props.errors || {}; // Initialize errors from props

        // Debugging statement to check if mounted data is correct
        console.log('Mounted with props:', this.$page.props);
    }
};
</script>

<style scoped>
.fill-height {
    min-height: 100vh;
}
</style>
