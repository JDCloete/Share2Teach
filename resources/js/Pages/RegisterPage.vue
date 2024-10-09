<template>
    <v-container class="d-flex justify-center">
        <v-card max-width="600">

            <v-card-title class="text-h5">
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
                        v-model="form.role"
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
export default {
    name: 'RegisterPage',
    data() {
        return {
            valid: false,
            form: {
                name: '',
                surname: '',
                email: '',
                password: '',
                confirmPassword: '',
                role: ''
            },
            roles: ['Educator', 'Admin', 'Moderator'], // Your available roles
            rules: {
                required: value => !!value || 'Required.',
                email: value => /.+@.+\..+/.test(value) || 'E-mail must be valid.',
                min: v => v.length >= 8 || 'Min 8 characters',
            }
        };
    },
    methods: {
        passwordMatch(value) {
            return value === this.form.password || 'Passwords must match';
        },
        submit() {
            if (this.$refs.form.validate()) {
                // Handle form submission here
                console.log(this.form);
            }
        }
    }
};
</script>

<style scoped>

</style>
