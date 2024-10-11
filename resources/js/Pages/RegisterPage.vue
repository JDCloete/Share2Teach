<template>
    <v-container class="d-flex justify-center align-center fill-height">
        <v-card width="400px" style="height: 600px;">
            <v-card-title class="text-h5 d-flex justify-center align-center">
                Register
            </v-card-title>

            <v-card-text>
                <!-- Form Start -->
                <v-form v-model="valid">
                    <!-- Name Field -->
                    <v-text-field
                        v-model="form.name"
                        label="Name"
                        :rules="[rules.required]"
                        required
                    ></v-text-field>

                    <!-- Surname Field -->
                    <v-text-field
                        v-model="form.surname"
                        label="Surname"
                        :rules="[rules.required]"
                        required
                    ></v-text-field>

                    <!-- Email Field -->
                    <v-text-field
                        v-model="form.email"
                        label="Email"
                        type="email"
                        :rules="[rules.required, rules.email]"
                        required
                    ></v-text-field>

                    <!-- Password Field -->
                    <v-text-field
                        v-model="form.password"
                        label="Password"
                        type="password"
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

                    <!-- Role ComboBox -->
                    <v-combobox
                        v-model="form.role_id"
                        :items="roles"
                        label="Select Role"
                        :rules="[rules.required]"
                        required
                    ></v-combobox>

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
                <!-- Form End -->
            </v-card-text>
        </v-card>
    </v-container>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            valid: false,  // Tracks form validity
            form: {
                name: '',
                surname: '',
                email: '',
                password: '',
                confirmPassword: '',
                role_id: ''  // Role selection
            },
            roles: ['Educator', 'Admin', 'Moderator'],  // Example roles
            rules: {
                required: value => !!value || 'This field is required.',
                email: value => /.+@.+\..+/.test(value) || 'E-mail must be valid.',
                minLength: v => v.length >= 8 || 'Password must be at least 8 characters long',  // Ensure password length is checked
            }
        };
    },
    methods: {
        async submit() {
            if (!this.valid) return;  // Prevent submission if form is invalid

            try {
                const response = await axios.post('/api/register', this.form);
                console.log(response.data);
                this.$router.push('/login');  // Redirect to login page on success
            } catch (error) {
                console.error('An error occurred:', error.response || error.message);
            }
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
