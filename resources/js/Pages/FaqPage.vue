<template>
    <div class="faq-page">
        <!-- Toolbar -->
        <v-toolbar color="primary" dark>
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
            <v-text-field
                v-model="search"
                label="Search for Questions"
                prepend-inner-icon="mdi-magnify"
                hide-details
                solo-inverted
                flat
                class="centered-search-bar"
                style="max-width: 450px;"
            ></v-text-field>
            <v-spacer></v-spacer>
            <v-btn text="" @click="navigateToRegisterPage">
                <v-icon left class="mr-2 custom-icon">mdi-account-plus-outline</v-icon>
                Register
            </v-btn>
            <v-btn text="" @click="navigateToLoginPage">
                <v-icon left class="mr-2 custom-icon">mdi-key</v-icon>
                Login
            </v-btn>
        </v-toolbar>

        <!-- About Us Header with Background Image -->
        <div class="d-flex justify-center align-center header-background" style="height: 40vh; background-size: cover; background-position: center;">
            <div class="mb-6" style="text-align: center;">
                <h1 class="text-h1 custom-font" style="color: #ffffff;">
                    Frequently Asked Questions
                </h1>
                <p class="text-h6" style="color: #ffffff;">
                    Find the answers to your questions below.
                </p>
            </div>
        </div>

        <!-- FAQs Section inside centered container -->
        <div class="faq-container">
            <div class="faq-content">
                <div v-for="(faq, index) in filteredFaqs" :key="index" class="faq-item">
                    <!-- Question and Answer -->
                    <div class="faq-question-answer-group">
                        <div class="faq-question">
                            <span>{{ faq.faq_question }}</span>
                        </div>

                        <!-- Answer -->
                        <div class="faq-answer">
                            <span>{{ faq.faq_answer }}</span>
                        </div>
                    </div>

                    <!-- Separator between FAQs -->
                    <hr class="faq-separator" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'FaqPage',
    data() {
        return {
            faqs: [],
            search: '',
        };
    },
    computed: {
        filteredFaqs() {
            return this.faqs.filter(faq => {
                const question = faq.faq_question.toLowerCase();
                const answer = faq.faq_answer.toLowerCase();
                return (
                    question.includes(this.search.toLowerCase()) ||
                    answer.includes(this.search.toLowerCase())
                );
            });
        },
    },
    created() {
        this.fetchFaqs();
    },
    methods: {
        async fetchFaqs() {
            try {
                const response = await axios.get('/api/faq');
                this.faqs = response.data.faqs;
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
.centered-search-bar {
    text-align: center;
    margin: 0 auto;
}

/* Heading styling */
.faq-heading {
    text-align: center;
    font-size: 2.5rem;
    font-family: 'Playfair Display', serif;
    font-weight: bold;
    margin-bottom: 20px;
    text-decoration: underline;
    color: #0b0b0b;
}

/* Centering the container */
.faq-container {
    display: flex;
    justify-content: center; /* Center the container */
    padding: 20px;
}

/* Centering the FAQ content */
.faq-content {
    width: 80%; /* Width of the centered content */
}

/* Grouping the Question and Answer */
.faq-question-answer-group {
    display: flex;
    flex-direction: column;
    align-items: flex-start; /* Align the text to the left */
}

/* Styling for FAQ questions and answers */
.faq-question {
    display: flex;
    font-size: 1.6rem; /* Question text size */
    color: #4b0082;
    margin-bottom: 10px;
}

.faq-answer {
    display: flex;
    font-size: 1.6rem;
    color: grey; /* Change the answer color to grey */
    margin-bottom: 10px;
}

/* Separator between FAQ items */
.faq-separator {
    border: none;
    border-bottom: 1px solid #ddd;
    margin: 20px 0;
}

/* Styling for the FAQ items */
.faq-item {
    padding: 10px 0;
    width: 100%; /* Ensure the items span the container */
}

/* Parallax header background */
.header-background {
    position: relative; /* Ensures the overlay aligns properly */
    background-image: url('https://wallpaperboat.com/wp-content/uploads/2020/10/23/57899/question-mark-23.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
}

.header-background::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Adjust the opacity for the darkening effect */
    z-index: 1;
}

.header-background > div {
    position: relative;
    z-index: 2; /* Ensure the content stays above the overlay */
}
/* Heading styling for the FAQ section */
.custom-font {
    font-family: 'Playfair Display', serif; /* Elegant serif font */
    font-size: 3rem; /* Increase font size */
    font-weight: bold;
    letter-spacing: 1.5px; /* Add spacing between letters */
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3); /* Add a subtle shadow */
    color: #f8f8f8; /* Light color for better contrast on dark background */
    margin-bottom: 15px;
}


</style>
