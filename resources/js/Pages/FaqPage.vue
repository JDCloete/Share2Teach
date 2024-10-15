<template>
    <div>
        <v-toolbar color="primary" dark style="margin-bottom: 20px">
            <img
                @click="goBack"
                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSv6vyFZbiqMYZ5njBX94kjv3u0bq_QyUvQCIB0Qj9rhlI5ExI26FAlmU4c30jUUgTgFQQ&usqp=CAU"
                alt="Go to Homepage"
                class="mr-2 rounded-image"
                width="30"
                height="30"
                style="object-fit: cover; margin-left: 15px; cursor: pointer;"
            />
            <v-toolbar-title class="d-flex">Frequently Asked Questions</v-toolbar-title>
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
        <v-container>
            <v-row justify="center">
                <v-col cols="12" md="8">
                    <v-list>
                        <v-list-item
                            v-for="(faq, index) in filteredFaqs"
                            :key="index"
                            @click="faq.showAnswer = !faq.showAnswer"
                            class="faq-item"
                        >
                            <v-list-item-content>
                                <v-list-item-title class="faq-question">
                                    <strong>{{ faq.faq_question }}</strong>
                                </v-list-item-title>
                            </v-list-item-content>

                            <!-- Answer Section with Transition -->
                            <v-expand-transition>
                                <v-list-item-content v-if="faq.showAnswer" class="faq-answer">
                                    <v-list-item-subtitle>{{ faq.faq_answer }}</v-list-item-subtitle>
                                </v-list-item-content>
                            </v-expand-transition>

                            <!-- Separator between FAQs -->
                            <hr class="faq-separator">
                        </v-list-item>
                    </v-list>
                </v-col>
            </v-row>
        </v-container>
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
        goBack() {
            window.history.back();
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
/* Styling for the logo */
.rounded-image {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    overflow: hidden;
}

/* Custom icon styling */
.custom-icon {
    font-size: 16px;
    line-height: 0;
}

/* Center the search bar within its container */
.faq-search-bar {
    margin: 0 auto;
    max-width: 100%;
}

/* Styling for FAQ questions */
.faq-question {
    font-size: 1.1rem;
    padding: 10px 0;
    border-bottom: 1px solid #ddd;
}

/* FAQ item hover effect */
.faq-item {
    cursor: pointer;
    padding: 20px;
    transition: background-color 0.3s ease;
    border-bottom: 1px solid #eee;
}

.faq-item:hover {
    background-color: #f9f9f9;
}

/* Styling for FAQ answers */
.faq-answer {
    font-size: 1rem;
    padding: 10px 0;
    color: #666;
}

/* Separator between FAQ items */
.faq-separator {
    border: none;
    border-bottom: 1px solid #ddd;
    margin: 10px 0;
}
</style>
