<template>
    <div>
        <v-card>
            <v-card-title>
                Hello from Home Page!
            </v-card-title>
        </v-card>
        <v-btn @click="navigateToContributors" color="primary">
            Go to Contributors
        </v-btn>
    </div>
</template>


<script>
import { useRouter } from 'vue-router'; // Import the router

export default {
    name: 'HomePage',
    props: {},
    data() {
        return {};
    },
    methods: {
        navigateToContributors() {
            const router = useRouter();
            router.push({ name: 'contributors.page' }); // Ensure this matches your route name
        },
    },
}
</script>

<style scoped>
/* Add styles here */
</style>
