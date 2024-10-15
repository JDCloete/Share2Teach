<template>
    <v-card class="background-image">

        <v-toolbar color="primary" dark>
            <img
                @click="goBack"
                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSv6vyFZbiqMYZ5njBX94kjv3u0bq_QyUvQCIB0Qj9rhlI5ExI26FAlmU4c30jUUgTgFQQ&usqp=CAU"
                alt="Logo"
                class="mr-2 rounded-image"
                width="30"
                height="30"
                style="object-fit: cover; margin-left: 15px; cursor: pointer;"
            />
            <v-toolbar-title class="d-flex">Open Educational Resources</v-toolbar-title>
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


        <!-- Useful Links Section -->
        <v-card-text>
            <v-container class="main-container" :style="{ backgroundColor: 'transparent' }">
                <v-row>
                    <v-col cols="12">
                        <h3 style="margin-bottom: 10px"><u>Useful Resources for Students</u></h3>
                        <v-list dense :style="{ backgroundColor: 'transparent' }">
                            <v-list-item
                                v-for="(resource, index) in resources"
                                :key="index"
                                @click="goToResource(resource.link)"
                            >
                                <!-- Wrap the image and content in a flex container -->
                                <div style="display: flex; align-items: center;" >
                                    <!-- Add Image of the Website to the Left -->
                                    <v-img
                                        :src="resource.image"
                                        loading="lazy"
                                        :alt="resource.name"
                                        max-width="50"
                                        class="mr-3"
                                    ></v-img>

                                    <!-- Resource Name and Description -->
                                    <v-list-item-content :style="{ backgroundColor: 'transparent' }">
                                        <v-list-item-title>{{ resource.name }}</v-list-item-title>
                                        <v-list-item-subtitle>{{ resource.description }}</v-list-item-subtitle>
                                    </v-list-item-content>
                                </div>
                            </v-list-item>
                        </v-list>
                    </v-col>
                </v-row>

            </v-container>
        </v-card-text>

        <!-- Link to Past Papers -->
        <v-card-text>
            <v-container>
                <v-row>
                    <v-col cols="12">
                        <h3  style="margin-bottom: 20px"><u>Papers</u></h3>
                        <v-btn color="primary" @click="goToPastPapers">
                            Visit NWU's Past Papers Website
                        </v-btn>
                    </v-col>
                </v-row>
            </v-container>
        </v-card-text>

        <!-- Sponsors Section -->
        <v-card-text>
            <v-container>
                <v-row>
                    <v-col cols="12">
                        <h3 style="margin-bottom: 20px"><u>Our Sponsors</u></h3>
                        <v-row>
                            <v-col
                                v-for="(sponsor, index) in sponsors"
                                :key="index"
                                cols="12"
                                sm="6"
                                md="4"
                            >
                                <!-- Add a tooltip to the image -->
                                <v-tooltip top>
                                    <template v-slot:activator="{ props }">
                                        <a :href="sponsor.link" target="_blank" v-bind="props">
                                            <v-img :src="sponsor.image" :alt="sponsor.name"></v-img>
                                        </a>
                                    </template>
                                    <span>Go to website</span>
                                </v-tooltip>
                            </v-col>
                        </v-row>
                    </v-col>
                </v-row>
            </v-container>
        </v-card-text>

        <!-- Disclaimer Section -->
        <v-card-text>
            <v-container>
                <v-row>
                    <v-col cols="12">
                        <v-divider style="margin-bottom: 10px"></v-divider>
                        <p>
                            <strong><u>Disclaimer:</u></strong>
                        </p>

                        <p style="margin-bottom: 10px;">
                            The resources listed here are
                            provided for informational purposes only. We do not endorse or
                            take responsibility for the content on external websites.
                        </p>

                        <p style="margin-bottom: 10px;">
                            The resources available on this website are primarily the work of students.
                            While we strive to maintain a high standard of quality, we cannot guarantee
                            the accuracy, reliability, or completeness of the content provided.
                        </p>

                        <p style="margin-bottom: 20px;">
                            Users are encouraged to critically evaluate the materials and adopt them at
                            their own discretion. Neither the founders nor North-West University assume
                            responsibility for any errors, omissions, or for the results obtained from
                            the use of this information.
                        </p>


                    </v-col>
                </v-row>
            </v-container>
        </v-card-text>
    </v-card>
</template>

<script>
export default {
    name: "OERPage",
    data() {
        return {
            // List of useful resources
            resources: [
                {
                    name: "Khan Academy",
                    description: "Free educational videos and exercises.",
                    link: "https://www.khanacademy.org",
                    image: "data:image/jpeg;base64,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"
                },
                {
                    name: "Coursera",
                    description: "Online courses from top universities.",
                    link: "https://www.coursera.org",
                    image: "https://upload.wikimedia.org/wikipedia/commons/thumb/9/97/Coursera-Logo_600x600.svg/2048px-Coursera-Logo_600x600.svg.png"
                },
                {
                    name: "OpenStax",
                    description: "OpenStax is the world’s largest publisher of open education resources (OER).",
                    link: "https://openstax.org",
                    image: "https://www.pngkey.com/png/detail/201-2013208_openstax-logo-open-stax.png"
                },
                {
                    name: "Studocu",
                    description: "Free summaries, lecture notes & exam prep.",
                    link: "https://studocu.com",
                    image: "https://cdn.freelogovectors.net/wp-content/uploads/2022/12/studocu-logo-freelogovectors.net_-400x118.png"
                },
                {
                    name: "Merlot",
                    description: "The MERLOT system provides access to curated online learning and support materials and content creation tools.",
                    link: "https://www.merlot.org/merlot/materials.htm?sort.property=overallRating",
                    image: "https://www.merlot.org/merlot/getMaterialImage.htm?id=1377570"
                },
            ],
            // List of sponsors with images
            sponsors: [
                {
                    name: "Sponsor 1",
                    image: "nwu.png",
                    link: "https://www.nwu.ac.za/"
                },
                {
                    name: "Sponsor 2",
                    image: "unesco.png",
                    link: "https://www.unesco.org"
                }
            ],
        };
    },
    methods: {
        goToResource(link) {
            window.open(link, "_blank");
        },
        goToPastPapers() {
            // Add the past papers website link here
            window.open("https://collections.nwu.ac.za/dbtw-wpd/textbases/exam-papers/exams-2021-2025.html", "_blank");
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
<style>
.rounded-image {
    width: 40px; /* Ensure width is set */
    height: 40px; /* Ensure height is set */
    border-radius: 50%; /* Make the image round */
    object-fit: cover; /* Maintain aspect ratio */
    overflow: hidden; /* Hide overflow */
}
.background-image {
    background-image: url('https://as2.ftcdn.net/v2/jpg/03/57/05/61/1000_F_357056172_AOxoyKV4D20Bsw17SvkzcMfWSOLTIGzJ.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    min-height: 100vh;
}
.custom-background {
    background-color: rgba(239, 237, 112, 0.44);
}
.main-container {
    height: calc(100vh - 64px);
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
