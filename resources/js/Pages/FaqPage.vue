<template>
    <div>
        <v-toolbar color="primary" dark style="margin-bottom: 20px">
            <img
                @click="goToHomepage"
                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSv6vyFZbiqMYZ5njBX94kjv3u0bq_QyUvQCIB0Qj9rhlI5ExI26FAlmU4c30jUUgTgFQQ&usqp=CAU"
                alt="Go to Homepage"
                class="mr-2 rounded-image"
                width="30"
                height="30"
                style="object-fit: cover; margin-left: 15px; cursor: pointer;"
            />
            <v-toolbar-title class="d-flex">FAQs</v-toolbar-title>
            <v-spacer></v-spacer>

            <!-- Search Bar -->
            <v-layout row align-center justify-center>
                <v-text-field
                    v-model="search"
                    label="Search for Questions"
                    prepend-inner-icon="mdi-magnify"
                    clearable
                    hide-details
                    solo-inverted
                    flat
                    style="max-width: 450px; height: 60px; font-size: 5px; margin-left: -300px;"
                ></v-text-field>
            </v-layout>

            <v-btn text="" @click="navigateToRegisterPage">
                <v-icon left class="mr-2 custom-icon">mdi-account-plus-outline</v-icon>
                Register
            </v-btn>
            <v-btn text="" @click="navigateToLoginPage">
                <v-icon left class="mr-2 custom-icon">mdi-key</v-icon>
                Login
            </v-btn>
        </v-toolbar>

        <!-- FAQs List -->
        <v-list row align-center justify-center>
            <v-list-item
                v-for="(faq, index) in filteredFaqs"
                :key="index"
            >
                <v-list-item-content>
                    <v-list-item-title>
                        <strong>{{ faq.faq_question }}</strong>
                    </v-list-item-title>

                    <!-- Expandable Dropdown for Answer -->
                    <v-list-item-action>
                        <v-btn icon @click="faq.showAnswer = !faq.showAnswer" style="min-width: 0; padding: 0;">
                            <v-icon class="custom-icon">{{ faq.showAnswer ? 'mdi-minus' : 'mdi-plus' }}</v-icon>
                        </v-btn>
                    </v-list-item-action>
                </v-list-item-content>

                <!-- Answer Section with Transition -->
                <v-expand-transition>
                    <v-list-item-content v-if="faq.showAnswer">
                        <v-list-item-subtitle>{{ faq.faq_answer }}</v-list-item-subtitle>
                    </v-list-item-content>
                </v-expand-transition>
            </v-list-item>
        </v-list>
    </div>
</template>

<script>
export default {
    name: 'FaqPage',
    data() {
        return {
            faqs: [], // To store FAQs
            search: '', // Search query
        };
    },
    computed: {
        // Filter FAQs based on search query
        filteredFaqs() {
            return this.faqs.filter(faq => {
                const question = faq.faq_question.toLowerCase();
                const answer = faq.faq_answer.toLowerCase();
                return question.includes(this.search.toLowerCase()) || answer.includes(this.search.toLowerCase());
            });
        },
    },
    created() {
        this.fetchFaqs(); // Fetch FAQs on component creation
    },
    methods: {
        // Fetch FAQs from the API
        async fetchFaqs() {
            try {
                const response = await axios.get('/api/faq'); // Ensure this matches your API route
                this.faqs = response.data.faqs.map(faq => ({
                    ...faq,
                    showAnswer: false // Initialize showAnswer property for toggling
                }));
            } catch (error) {
                console.error('Error fetching FAQs:', error);
            }
        },
        goToHomepage() {
            this.$inertia.visit('/');
        },
        navigateToRegisterPage() {
            this.$inertia.visit('/register');
        },
        navigateToLoginPage() {
            this.$inertia.visit('/login');
        },
    },
};
</script>

<style scoped>
.rounded-image {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    overflow: hidden;
}

.custom-icon {
    font-size: 16px; /* Adjust this value to change icon size */
    line-height: 0; /* Remove extra space around the icon */
}
</style>
