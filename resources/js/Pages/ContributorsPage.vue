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




        <!-- Admins and Moderators side by side -->
        <v-row>
            <!-- Admins List -->
            <v-col cols="6" v-if="filteredAdmins.length">
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
            <v-col cols="6" v-if="filteredModerators.length">
                <v-list class="ml-7">
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
        </v-row>

        <v-row>
            <!-- Educators List -->
            <v-list v-if="filteredEducators.length" class="ml-10" style="margin-bottom: 20px">
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
</style>
