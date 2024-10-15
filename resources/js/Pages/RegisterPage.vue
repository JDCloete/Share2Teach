<template>
    <v-app class="background-image">
        <v-toolbar color="primary" dark>
            <img
                @click="goToHomepage"
                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSv6vyFZbiqMYZ5njBX94kjv3u0bq_QyUvQCIB0Qj9rhlI5ExI26FAlmU4c30jUUgTgFQQ&usqp=CAU"
                alt="Logo"
                class="mr-2 rounded-image"
                width="30"
                height="30"
                style="object-fit: cover; margin-left: 15px;"
            />

            <v-toolbar-title class="d-flex">Register for Share2Teach</v-toolbar-title>

            <v-spacer></v-spacer>

            <v-btn text="" @click="navigateToLoginPage">
                <v-icon left class="mr-2">mdi-key</v-icon>
                Login
            </v-btn>
        </v-toolbar>

        <v-container class="fill-height">
            <v-row class="d-flex justify-center align-center">
                <v-col cols="12" md="4">
                    <v-card class="upload-section details-section" outlined>

                        <v-card-title>
                            <v-icon left large class="mr-3">mdi-account</v-icon>
                            Create Your Account
                        </v-card-title>

                        <v-divider class="mb-4"></v-divider>

                        <v-card-text>
                            <v-form ref="form" v-model="valid" @submit.prevent="submit">
                                <!-- Name Field -->
                                <v-text-field
                                    v-model="form.name"
                                    label="Name"
                                    :error-messages="errors.name"
                                    :rules="[rules.required]"
                                    prepend-inner-icon="mdi-account-circle"
                                    outlined
                                    dense
                                    required
                                    class="mb-3"
                                ></v-text-field>

                                <!-- Surname Field -->
                                <v-text-field
                                    v-model="form.surname"
                                    label="Surname"
                                    :error-messages="errors.surname"
                                    :rules="[rules.required]"
                                    prepend-inner-icon="mdi-account-outline"
                                    outlined
                                    dense
                                    required
                                    class="mb-3"
                                ></v-text-field>

                                <!-- Email Field -->
                                <v-text-field
                                    v-model="form.email"
                                    label="Email"
                                    type="email"
                                    :error-messages="errors.email"
                                    :rules="[rules.required, rules.email]"
                                    prepend-inner-icon="mdi-email-outline"
                                    outlined
                                    dense
                                    required
                                    @input="handleEmailInput"
                                    class="mb-3"
                                ></v-text-field>

                                <!-- Password Field -->
                                <v-text-field
                                    v-model="form.password"
                                    label="Password"
                                    type="password"
                                    :error-messages="errors.password"
                                    :rules="[rules.required, rules.minLength(8)]"
                                    prepend-inner-icon="mdi-lock-outline"
                                    outlined
                                    dense
                                    required
                                    class="mb-3"
                                ></v-text-field>

                                <!-- Confirm Password Field -->
                                <v-text-field
                                    v-model="form.confirmPassword"
                                    label="Confirm Password"
                                    type="password"
                                    :rules="[rules.required, passwordMatch]"
                                    prepend-inner-icon="mdi-lock-check-outline"
                                    outlined
                                    dense
                                    required
                                    class="mb-5"
                                ></v-text-field>

                                <!-- Submit Button -->
                                <v-btn
                                    :disabled="!valid || !!errors.email || !!errors.password || !!errors.name || !!errors.surname"
                                    color="primary"
                                    block
                                    large
                                    @click="submit"
                                >
                                    Register
                                </v-btn>
                            </v-form>
                        </v-card-text>
                    </v-card>
                </v-col>
            </v-row>

        </v-container>
    </v-app>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';
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
                    this.errors = errors;
                },
                onSuccess: () => {
                    window.location.href = '/login'; // Redirect to login page on success
                }
            });
        },
        handleEmailInput() {
            if (this.errors.email) {
                this.errors.email = ''; // Clear email error when the user types
            }
        },
        passwordMatch(value) {
            return value === this.form.password || 'Passwords do not match.';
        },
        navigateToLoginPage() {
            Inertia.visit('/login');
        },
        goToHomepage() {
            Inertia.visit('/');
        },
    },
    mounted() {
        this.form.name = this.$page.props.form?.name || '';
        this.form.surname = this.$page.props.form?.surname || '';
        this.form.email = this.$page.props.form?.email || '';
        this.errors = this.$page.props.errors || {};
    }
};
</script>

<style scoped>
.background-image {
    background-image: url('https://as2.ftcdn.net/v2/jpg/03/57/05/61/1000_F_357056172_AOxoyKV4D20Bsw17SvkzcMfWSOLTIGzJ.jpg'); /* Replace with your image URL */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    min-height: 100vh;
}
.fill-height {
    height: calc(100vh - 64px); /* Ensure it fills most of the screen */
}
.rounded-image {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
}
.upload-section, .details-section {
    border: 2px solid #000;
    border-radius: 8px;
    padding: 20px;
}
</style>
