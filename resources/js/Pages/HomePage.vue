<template>
    <v-app>
        <!-- Toolbar for Register and Login -->
        <v-toolbar color="primary" dark>
            <img
                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSv6vyFZbiqMYZ5njBX94kjv3u0bq_QyUvQCIB0Qj9rhlI5ExI26FAlmU4c30jUUgTgFQQ&usqp=CAU"
                alt="Logo"
                class="mr-2 rounded-image"
                width="30"
                height="30"
                style="object-fit: cover; margin-left: 15px;"
            />
            <v-toolbar-title>Welcome!</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn text @click="navigateToRegisterPage">
                <v-icon left class="mr-2">mdi-account-plus-outline</v-icon>
                Register
            </v-btn>
            <v-btn text @click="navigateToLoginPage">
                <v-icon left class="mr-2">mdi-key</v-icon>
                Login
            </v-btn>
        </v-toolbar>

        <!-- Section with Background Image and Dark Overlay -->
        <div class="photo-section">
            <div class="overlay"></div>
            <v-container class="d-flex flex-column align-center justify-center full-height text-center">
                <v-col class="text-center d-flex flex-column justify-center" style="flex: 1;">
                    <h1 class="photo-text">Share To Teach</h1>
                    <h2 class="slogan-text">Where Knowledge Flows and Learning Grows</h2>

                    <!-- Buttons just below the subtitle -->
                    <div class="button-section mt-12">
                        <v-btn class="rounded-btn mx-3" @click="navigateToExplorePage">
                            <v-icon left class="mr-2" style="border-radius: 50%; background-color: rgba(255, 255, 255, 0.2); padding: 5px;">mdi-compass</v-icon> Explore
                        </v-btn>
                        <v-btn class="rounded-btn mx-3" @click="navigateToAboutPage">
                            <v-icon left class="mr-2" style="border-radius: 50%; background-color: rgba(255, 255, 255, 0.2); padding: 5px;">mdi-information-outline</v-icon> About Us
                        </v-btn>
                    </div>
                </v-col>
            </v-container>
        </div>
    </v-app>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';

export default {
    methods: {
        navigateToExplorePage() {
            Inertia.visit('/explore');
        },
        navigateToRegisterPage() {
            Inertia.visit('/register');
        },
        navigateToLoginPage() {
            Inertia.visit('/login');
        },
        navigateToAboutPage() {
            Inertia.visit('/about-us');
        },
    },
};
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap');

html, body {
    margin: 0;
    height: 100vh; /* Set height to full viewport */
    overflow: hidden; /* Prevent scrolling */
    width: 100vw; /* Set width to full viewport */
}

.photo-section {
    position: relative;
    background-image: url('https://as2.ftcdn.net/v2/jpg/03/57/05/61/1000_F_357056172_AOxoyKV4D20Bsw17SvkzcMfWSOLTIGzJ.jpg'); /* Your background image URL */
    background-size: cover; /* Ensures the image covers the whole area */
    background-position: center; /* Centers the image */
    height: 100vh; /* Set height to full viewport */
    width: 100vw; /* Set width to full viewport */
}

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Dark overlay */
    z-index: 1;
}

.full-height {
    height: 100%; /* Make the container full height */
}

.photo-text {
    position: relative;
    z-index: 2;
    font-family: 'Playfair Display', serif; /* Apply the new font */
    font-size: 3rem;
    font-weight: bold;
    color: white;
    text-align: center;
}

.slogan-text {
    position: relative;
    z-index: 2;
    font-size: 1.5rem; /* Adjust font size for the slogan */
    color: white;
    text-align: center;
    margin-top: 10px; /* Add margin for spacing */
}

.button-section {
    position: relative; /* Keep buttons in normal flow */
    z-index: 2; /* Ensure buttons are above overlay */
}

.rounded-image {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
}

.rounded-btn {
    min-width: 150px;
    background-color: #007bff; /* Lighter blue color */
    color: white; /* Text color */
    border-radius: 25px; /* Make the buttons round */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3); /* Shadow effect */
    transition: transform 0.3s, box-shadow 0.3s; /* Smooth transition */
}

.rounded-btn:hover {
    background-color: #0056b3; /* Darker blue on hover */
    transform: translateY(-2px); /* Slight lift effect on hover */
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.4); /* Enhanced shadow on hover */
}
.photo-text {
    position: relative;
    z-index: 2;
    font-family: 'Playfair Display', serif; /* Apply the new font */
    font-size: 5rem; /* Increase the font size */
    font-weight: bold;
    color: white;
    text-align: center;
}

</style>
