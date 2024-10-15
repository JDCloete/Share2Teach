<template>
    <v-app>
        <!-- Toolbar at the top -->
        <v-toolbar color="primary" dark>
            <img
                @click="goToHomepage"
                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSv6vyFZbiqMYZ5njBX94kjv3u0bq_QyUvQCIB0Qj9rhlI5ExI26FAlmU4c30jUUgTgFQQ&usqp=CAU"
                alt="Logo"
                class="mr-2 rounded-image"
                width="30"
                height="30"
                style="object-fit: cover; margin-left: 15px; cursor: pointer;"
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

        <v-navigation-drawer
            class="bg-deep-purple"
            theme="dark"
            permanent
            style="width: 200px; position: fixed; top: 64px; height: calc(100vh - 64px);"
        >

            <template v-slot:prepend>
                <div class="pa-3">
                    <v-btn block v-if="roleId === 1 || roleId === 2 || roleId === 3" color="blue"
                           @click="goToContributeFilesPage">Contribute
                    </v-btn>
                </div>
            </template>

            <v-list color="transparent">
                <!-- Tooltip for FAQ -->
                <v-tooltip text="Frequently Asked Questions">
                    <template v-slot:activator="{ props }">
                        <v-list-item
                            class="centered-list-item outlined-item"
                            v-if="roleId === null || roleId === 1 || roleId === 2 || roleId === 3"
                            @click="goToFAQ"
                            v-bind="props"
                        >
                            <v-list-item-content>
                                <v-list-item-title class="text-center">FAQ</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </template>
                </v-tooltip>

                <!-- Tooltip for OER -->
                <v-tooltip text="Open Educational Resources">
                    <template v-slot:activator="{ props }">
                        <v-list-item
                            class="centered-list-item outlined-item"
                            v-if="roleId === null || roleId === 1 || roleId === 2 || roleId === 3"
                            @click="goToOER"
                            v-bind="props"
                        >
                            <v-list-item-content>
                                <v-list-item-title class="text-center">Useful OER's</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </template>
                </v-tooltip>



                <v-list-item
                    class="centered-list-item outlined-item"
                    v-if="roleId === null || roleId === 1 || roleId === 2 || roleId === 3"
                    @click="goToContributors"
                >
                    <v-list-item-content>
                        <v-list-item-title class="text-center">Contributors</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>


                <v-list-item
                    class="centered-list-item outlined-item"
                    v-if="roleId === null || roleId === 1 || roleId === 2 || roleId === 3"
                    @click="goToAboutUs"
                >
                    <v-list-item-content>
                        <v-list-item-title class="text-center">About Us</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>


                <v-list-item
                    class="centered-list-item outlined-item"
                    v-if="roleId === 2 || roleId === 3"
                    @click="goToModerateDocuments"
                >
                    <v-list-item-content>
                        <v-list-item-title class="text-center">Moderate Documents</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <v-list-item
                    class="centered-list-item outlined-item"
                    v-if="roleId === 2 || roleId === 3"
                    @click="goToModerateUsers"
                >
                    <v-list-item-content>
                        <v-list-item-title class="text-center">Moderate Users</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <v-list-item
                    class="centered-list-item outlined-item"
                    v-if="roleId === 2"
                    @click="goToAnalytics"
                >
                    <v-list-item-content>
                        <v-list-item-title class="text-center">View Analytics</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>

            <template v-slot:append>
                <div class="pa-2">
                    <v-btn block @click="logout">
                        Logout
                    </v-btn>
                </div>
            </template>
        </v-navigation-drawer>

        <v-container style="height: calc(100vh - 64px); margin-left: 240px;">
            <v-main>
                <!-- Main content goes here -->
            </v-main>
        </v-container>
    </v-app>
</template>

<script>
export default {
    props: {
        role_id: {
            type: [String, Number], // Accept both string and number
            required: false // Make this optional
        }
    },
    computed: {
        roleId() {
            return this.role_id ? Number(this.role_id) : null; // Convert role_id to a number or null
        }
    },
    methods: {
        goToHomepage() {
            this.$inertia.visit('/');
        },
        navigateToRegisterPage() {
            this.$inertia.visit('/register');
        },
        navigateToLoginPage() {
            this.$inertia.visit('/login');
        },
        goToFAQ() {
            this.$inertia.visit('/faq');
        },
        goToOER() {
            this.$inertia.visit('/oer');
        },
        goToContributors() {
            this.$inertia.visit('/contributors');
        },
        goToAboutUs() {
            this.$inertia.visit('/about-us');
        },
        goToModerateDocuments() {
            this.$inertia.visit('/moderation');
        },
        goToModerateUsers() {
            this.$inertia.visit('/moderate-users');// Should not show a page but a list of users favourite documents
        },
        goToAnalytics() {
            this.$inertia.visit('/analytics');
        },
        goToContributeFilesPage() {
            this.$inertia.visit('/contribute-files');
        },
        logout() {
            this.$inertia.visit('/login'); // Redirect user to login page after logout
        }
    },
};
</script>

<style scoped>
.rounded-image {
    width: 40px; /* Ensure width is set */
    height: 40px; /* Ensure height is set */
    border-radius: 50%; /* Make the image round */
    object-fit: cover; /* Maintain aspect ratio */
    overflow: hidden; /* Hide overflow */
}

.centered-list-item{
    display: flex;
    justify-content: center; /* Center the content horizontally */
    align-items: center; /* Center the content vertically */
}

.text-center {
    text-align: center; /* Ensure text inside is centered */
}

.outlined-item {
    border: 1px solid black; /* Add a black outline */
    margin-bottom: 10px; /* Add space between items */
}
</style>
