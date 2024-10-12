<template>
    <v-app class="background-image"> <!-- Added class for background -->
        <v-toolbar color="primary" dark>
            <img
                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSv6vyFZbiqMYZ5njBX94kjv3u0bq_QyUvQCIB0Qj9rhlI5ExI26FAlmU4c30jUUgTgFQQ&usqp=CAU"
                alt="Logo"
                class="mr-2 rounded-image"
                width="30"
                height="30"
                style="object-fit: cover; margin-left: 15px;"
            />

            <v-toolbar-title class="d-flex">Welcome To Share2Teach</v-toolbar-title>

            <v-spacer></v-spacer>

            <v-btn text="" @click="navigateToRegisterPage">
                <v-icon left class="mr-2">mdi-account-plus-outline</v-icon>
                Register
            </v-btn>
            <v-btn text="" @click="navigateToLoginPage">
                <v-icon left class="mr-2">mdi-key</v-icon>
                Login
            </v-btn>

        </v-toolbar>

        <v-container class="main-container d-flex justify-center align-center">
            <v-col class="d-flex flex-column align-items-center">
                <v-card class="mx-2 custom-card" max-width="400">
                    <v-card-title>Share2Teach</v-card-title>
                    <v-card-text>
                        Share2Teach is a platform where you can share your knowledge and learn from others.
                    </v-card-text>
                </v-card>
            </v-col>
            <v-row>
                <v-btn
                    class="animated-button"
                    outlined
                    @click="navigateToExplorePage"
                    style="padding: 0; min-width: 150px;"
                >
                    <v-icon left class="mr-2">mdi-compass</v-icon> <!-- MDI Explore Icon -->
                    Explore
                </v-btn>
            </v-row>
        </v-container>

    </v-app>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';

export default {
    name: 'HomePage',
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
        goBack() {
            window.history.back();
        },
    },
};
</script>

<style scoped>
.background-image {
    background-image: url('https://as2.ftcdn.net/v2/jpg/03/57/05/61/1000_F_357056172_AOxoyKV4D20Bsw17SvkzcMfWSOLTIGzJ.jpg'); /* Replace with your image URL */
    /*background-image: url('https://lh4.googleusercontent.com/ySrY2iqkZd_57_JpSOz84tx69Lbr4ydtwCv6CTJ_uM1vktNbJCcCPGlYKi_QHLfiTRAPonOMxXyQgRAMdkKzkUI=w16383'); /* Replace with your image URL */
    background-size: cover; /* Cover the entire page */
    background-position: center; /* Center the background image */
    background-repeat: no-repeat; /* Prevent repeating the background image */
    min-height: 100vh; /* Ensure the background covers the full viewport height */
}
.main-container {
    height: calc(100vh - 64px); /* Adjust height to fill the space below the toolbar */
    display: flex;
    justify-content: center;
    align-items: center;
}
.rounded-image {
    width: 40px; /* Ensure width is set */
    height: 40px; /* Ensure height is set */
    border-radius: 50%; /* Make the image round */
    object-fit: cover; /* Maintain aspect ratio */
    overflow: hidden; /* Hide overflow */
}
.custom-card {
    border: 2px solid #000000; /* Change this to your desired color */
    border-radius: 8px; /* Optional: Adjust border radius if needed */
}
.animated-button {
    transition: transform 0.2s ease, background-color 0.2s ease; /* Faster transition for more impact */
}
.animated-button:hover {
    transform: scale(1.12); /* Increase scale for more impact */
    background-color: rgba(218, 189, 117, 0.43); /* Change background color on hover */
}
</style>
