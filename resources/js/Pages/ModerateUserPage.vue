<template>
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
        <v-toolbar-title class="d-flex">Moderate Users</v-toolbar-title>
    </v-toolbar>
    <v-container style="padding: 50px">
        <data-table-explorer-baseline :action-button="false" :search-enabled="false">
            <template v-slot:toolbar-title>Escalate User Privileges</template>
            <template v-slot:library-items>
                <v-table>
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Role</th>
                        <th>Educator</th>
                        <th>Moderator</th>
                        <th>Admin</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users" :key="user.id">
                            <td>{{ user.user_name }}</td>
                            <td>{{ user.user_surname }}</td>
                            <td>{{ user.role_name }}</td>

                            <td>
                                <v-btn
                                    type="icon"
                                    variant="flat"
                                    size="small"
                                    elevation="0"
                                    @click="makeEducator(user)"
                                >
                                    <v-icon>mdi-account-minus</v-icon>
                                </v-btn>
                            </td>
                            <td>
                                <v-btn
                                    type="icon"
                                    variant="flat"
                                    size="small"
                                    elevation="0"
                                    @click="makeModerator(user)"
                                >
                                    <v-icon>mdi-account-plus</v-icon>
                                </v-btn>
                            </td>
                            <td>
                                <v-btn
                                    type="icon"
                                    variant="flat"
                                    size="small"
                                    elevation="0"
                                    @click="makeAdmin(user)"
                                >
                                    <v-icon>mdi-account-multiple-plus</v-icon>
                                </v-btn>
                            </td>
                            <td>
                                <v-btn
                                    type="icon"
                                    variant="flat"
                                    size="small"
                                    elevation="0"
                                    @click="deleteUser(user)"
                                >
                                    <v-icon>mdi-account-remove</v-icon>
                                </v-btn>
                            </td>
                        </tr>
                    </tbody>
                </v-table>
            </template>
        </data-table-explorer-baseline>
    </v-container>
</template>

<script>
import axios from 'axios';
import DataTableExplorerBaseline from '../Components/BaselineDataTable.vue';

export default {
    name: 'ModerateUserPage',
    components: { DataTableExplorerBaseline },
    data() {
        return {
            users: [], // Holds the original fetched users
            filteredUsers: [], // Filtered users after search
            search: '', // Search term for filtering users
        };
    },
    created() {
        this.fetchUsersWithRoles();
    },
    methods: {
        async fetchUsersWithRoles() {
            try {
                const response = await axios.get('/api/users'); // Adjust the route as per your API
                this.users = response.data.users;
            } catch (error) {
                console.error('Error fetching users with roles:', error);
            }
        },
        goBack() {
            window.history.back();
        },
        async makeEducator(user) {
            if (!user.user_id) {
                console.error('Error: user ID is undefined or missing.');
                return;
            }

            try {
                const response = await axios.patch(`/api/users/${user.user_id}`, {
                    role_id: 1, // Setting the role to 'educator'
                    action_taken: 'approved' // Replace with the valid action, e.g., 'approved' or any valid option
                });
                console.log('User role updated to educator:', response.data);
                window.location.reload(); // Reload the page after the update
            } catch (error) {
                console.error('Error updating the user role:', error.response?.data || error.message);
            }
        },
        async makeModerator(user) {
            try {
                const response = await axios.patch(`api/users/${user.id}`, {
                    is_approved: true,
                });
                window.location.reload();
            } catch (error) {
                console.error('Error updating the user:', error.response?.data || error.message);
            }
        },
        async makeAdmin(user) {
            try {
                const response = await axios.patch(`api/users/${user.id}`, {
                    is_approved: true,
                });
                window.location.reload();
            } catch (error) {
                console.error('Error updating the user:', error.response?.data || error.message);
            }
        },
        async deleteUser(user) {
            try {
                const response = await axios.delete(`api/users/${user.id}`);
                window.location.reload();
            } catch (error) {
                console.error('Error deleting the user:', error.response?.data || error.message);
            }
        }
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
</style>
