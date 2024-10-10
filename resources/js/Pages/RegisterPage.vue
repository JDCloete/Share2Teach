<template>
    <div class="background">
        <v-container class="d-flex justify-center align-center fill-height"  style="background-color: #f0f0f0;">
            <v-card width="500px" style="height: 600px; border: 2px solid black;"> <!-- Added border -->
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
                            :rules="[rules.required, rules.min(8)]"
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

                        <!-- Submit Button aligned to the right -->
                        <div class="d-flex justify-end mt-4"> <!-- Added flex container for alignment -->
                            <v-btn
                                :disabled="!valid"
                                color="primary"
                                @click="submit"
                            >
                                Register
                            </v-btn>
                        </div>
                    </v-form>
                    <!-- Form End -->
                </v-card-text>
            </v-card>
        </v-container>
    </div>
</template>


<script>
import axios from 'axios';

export default {
    data() {
        return {
            valid: false,
            form: {
                name: '',
                surname: '',
                email: '',
                password: '',
                confirmPassword: '',
                role_id: ''
            },
            roles: ['Educator', 'Admin', 'Moderator'],
            rules: {
                required: value => !!value || 'This field is required.',
                email: value => /.+@.+\..+/.test(value) || 'E-mail must be valid.',
                passwordMatch: () => (this.form.password === this.form.confirmPassword) || 'Passwords must match',
                min: v => v.length >= 8 || 'Password must be at least 8 characters long',
            }
        };
    },
    methods: {
        async submit() {
            if (!this.valid) return;

            try {
                const response = await axios.post('/api/register', this.form);
                console.log(response.data);
                this.$router.push('/login');
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
    min-height: 100vh;
}
.background {
    background-color: #ffffff; /* Change to your desired color */
    min-height: 100vh; /* Ensure it takes the full viewport height */
    display: flex; /* Center the content vertically and horizontally */
    justify-content: center;
    align-items: center;
}
</style>
