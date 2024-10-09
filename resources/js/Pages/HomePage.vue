<template>
    <v-container class="main-container d-flex justify-center align-center">

<!--        dark style="margin-bottom: 500px"-->

<!--        <v-toolbar app color="purple" >-->
<!--            <v-toolbar-title>-->
<!--                Share2Teach-->
<!--            </v-toolbar-title>-->
<!--        </v-toolbar>-->


        <v-col class="d-flex flex-column align-items-center">

            <!-- Rounded Image -->
            <div style="width: 100px; height: 100px; overflow: hidden; border-radius: 50%;">
                <img
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSv6vyFZbiqMYZ5njBX94kjv3u0bq_QyUvQCIB0Qj9rhlI5ExI26FAlmU4c30jUUgTgFQQ&usqp=CAU"
                    style="width: 100%; height: 100%; object-fit: cover;"
                 alt=""/>
            </div>

            <h1 class="mt-4">Welcome to Share2Teach</h1>


            <v-btn @click="navigateToExplorePage">
                Explore
            </v-btn>

            <!-- Centered Card -->
<!--            <v-card width="200" class="mt-4">-->
<!--                <v-card-text class="d-flex justify-center align-center">-->

<!--                </v-card-text>-->
<!--            </v-card>-->

        </v-col>

    </v-container>
</template>


<script>
import { Inertia } from '@inertiajs/inertia';

export default {
    name: 'HomePage',
    data() {
        return {
            // Add data here if needed
        };
    },
    methods: {

        navigateToExplorePage() {
            Inertia.visit('/register');
        },
        goBack() {
            window.history.back();
        }
    }
};
</script>

<style scoped>
.main-container {
    height: 100vh; /* Full viewport height to allow vertical centering */
}
</style>
