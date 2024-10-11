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
                        :disabled="!valid"
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
            }
        };
    },
    computed: {
        errors() {
            return this.form.errors; // Capture errors from the Inertia form
        }
    },
    methods: {
        submit() {
            this.form.post('/register', {
                onSuccess: () => {
                    // Reset the form on successful registration
                    this.$refs.form.reset();
                },
                onError: (errors) => {
                    // Check for validation errors
                    if (errors.email && errors.email[0]) {
                        // Display the backend error for the email field
                        this.form.errors.email = errors.email[0];
                    } else if (errors.password) {
                        this.form.errors.password = errors.password[0];
                    } else {
                        this.errorMessage = 'An unexpected error occurred.';
                    }
                }
            });
        },
        passwordMatch(value) {
            return value === this.form.password || 'Passwords do not match.';
        }
    }
};
</script>

<style scoped>
.fill-height {
    min-height: 100vh; /* Ensure the container takes full viewport height */
}
</style>
