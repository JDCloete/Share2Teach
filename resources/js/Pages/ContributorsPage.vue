<template>
    <div>

        <v-toolbar color="primary" dark >
            <img
                @click="goBack"
                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSv6vyFZbiqMYZ5njBX94kjv3u0bq_QyUvQCIB0Qj9rhlI5ExI26FAlmU4c30jUUgTgFQQ&usqp=CAU"
                alt="Go to Homepage"
                class="mr-2 rounded-image"
                width="30"
                height="30"
                style="object-fit: cover; margin-left: 15px; cursor: pointer;"
            />
            <v-toolbar-title class="d-flex">Thank You to Our Contributors</v-toolbar-title>
            <v-spacer></v-spacer>

            <!-- Search Bar moved 20px to the left -->
            <v-layout row align-center justify-center>
                <v-text-field
                    v-model="search"
                    label="Search Contributors"
                    prepend-inner-icon="mdi-magnify"
                    hide-details
                    solo-inverted
                    flat
                    style="max-width: 450px; height: 60px; font-size: 5px; margin-left: -300px;"
                ></v-text-field>
            </v-layout>

            <v-btn text="" @click="navigateToRegisterPage">
                <v-icon left class="mr-2">mdi-account-plus-outline</v-icon>
                Register
            </v-btn>
            <v-btn text="" @click="navigateToLoginPage">
                <v-icon left class="mr-2">mdi-key</v-icon>
                Login
            </v-btn>
        </v-toolbar>

        <div class="d-flex justify-center align-center header-background" style="height: 40vh; background-size: cover; background-position: center;">
            <div class="mb-2" style="text-align: center;">
                <h1 class="text-h1 custom-font" style="color: #ffffff;">
                    Contributors
                </h1>
            </div>
        </div>


        <!-- Admins and Moderators side by side -->
        <v-row>
            <!-- Admins List -->
            <v-col cols="4" v-if="filteredAdmins.length">
                <v-list class="ml-8" style="margin-bottom: 20px">
                    <v-subheader class="list-title">Admins</v-subheader>
                    <v-list-item
                        v-for="user in filteredAdmins"
                        :key="user.id"
                        class="list-item"
                    >
                        <v-list-item-content>
                            <v-list-item-title class="user-item">
                                <span class="custom-bullet"></span>
                                {{ user.name }} {{ user.surname }}
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list>
            </v-col>

            <!-- Moderators List -->
            <v-col cols="4" v-if="filteredModerators.length">
                <v-list class="ml-7" style="margin-bottom: 20px">
                    <v-subheader class="list-title">Moderators</v-subheader>
                    <v-list-item
                        v-for="user in filteredModerators"
                        :key="user.id"
                    >
                        <v-list-item-content>
                            <v-list-item-title class="user-item">
                                <span class="custom-bullet"></span>
                                {{ user.name }} {{ user.surname }}
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list>
            </v-col>

            <!-- Educators List -->
            <v-col cols="4" v-if="filteredEducators.length">
                <v-list class="ml-10" style="margin-bottom: 20px">
                    <v-subheader class="list-title">Educators</v-subheader>
                    <v-list-item
                        v-for="user in filteredEducators"
                        :key="user.id"
                    >
                        <v-list-item-content>
                            <v-list-item-title class="user-item">
                                <span class="custom-bullet"></span>
                                {{ user.name }} {{ user.surname }}
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list>
            </v-col>
        </v-row>



    </div>
</template>

<script>
export default {
    name: 'ContributorsPage',
    data() {
        return {
            users: [],
            search: '', // Search query
        };
    },
    created() {
        this.fetchUsers();
        this.pollUsers(); // Continuously poll for updates
    },
    computed: {
        filteredEducators() {
            return this.filteredUsersByRole(1); // Filter by role_id for Admin
        },
        filteredAdmins() {
            return this.filteredUsersByRole(2); // Filter by role_id for Moderator
        },
        filteredModerators() {
            return this.filteredUsersByRole(3); // Filter by role_id for Educator
        },
        // Filter users based on search and role
        filteredUsersByRole() {
            return (roleId) => {
                return this.users.filter(user => {
                    const fullName = `${user.name} ${user.surname}`.toLowerCase();
                    return fullName.includes(this.search.toLowerCase()) && user.role_id === roleId;
                });
            };
        }
    },
    methods: {
        // Fetch users from the API
        async fetchUsers() {
            try {
                const response = await axios.get('/api/users');
                this.users = response.data;
            } catch (error) {
                console.error('Error fetching users:', error);
            }
        },
        // Polling function to fetch users every 20 seconds
        pollUsers() {
            setInterval(() => {
                this.fetchUsers();
            }, 20000); // Adjust interval as needed
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
.list-title {
    font-weight: bold;
    font-size: 24px;
    text-transform: uppercase;
}
/* Custom arrow style */
.custom-bullet {
    display: inline-block;
    margin-right: 8px; /* Space between arrow and text */
    width: 0;
    height: 0;
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-bottom: 10px solid #000000; /* Change color here */
}

/* Flex container for alignment */
.user-item {
    display: flex;
    align-items: center; /* Align items vertically */
}
.list-item {
    margin: 1px 0; /* Adjust the vertical margin as needed */
    padding: 0; /* Remove padding if necessary */
}
.rounded-image {
    width: 40px; /* Ensure width is set */
    height: 40px; /* Ensure height is set */
    border-radius: 50%; /* Make the image round */
    object-fit: cover; /* Maintain aspect ratio */
    overflow: hidden; /* Hide overflow */
}
.header-background {
    position: relative; /* Ensures the overlay aligns properly */
    background-image: url('https://preview.redd.it/windows-11-abstract-waves-light-1920x1080-v0-9g3ox2xn6k8b1.png?auto=webp&s=2b241ecdcb5e0bb5a363cad8f514ddef889dacb3');
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
