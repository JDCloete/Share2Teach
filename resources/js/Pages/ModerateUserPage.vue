<template>
    <div>
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
            <div v-if="loading">Loading...</div>
            <div v-else-if="error">Error: {{ error }}</div>
            <data-table-explorer-baseline v-else :action-button="false" :search-enabled="false">
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
                        <tr v-for="user in users" :key="user.user_id">
                            <td>{{ user.user_name }}</td>
                            <td>{{ user.user_surname }}</td>
                            <td>{{ user.role_name }}</td>
                            <td>
                                <v-btn
                                    type="button"
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
                                    type="button"
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
                                    type="button"
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
                                    type="button"
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
    </div>
</template>

<script>
import axios from 'axios';
import DataTableExplorerBaseline from '../Components/BaselineDataTable.vue';

export default {
    name: 'ModerateUserPage',
    components: { DataTableExplorerBaseline },
    data() {
        return {
            users: [],
            filteredUsers: [],
            search: '',
            loading: true,
            error: null,
        };
    },
    created() {
        this.fetchUsersWithRoles();
    },
    methods: {
        async fetchUsersWithRoles() {
            this.loading = true;
            this.error = null;
            try {
                const response = await axios.get('/api/users');
                this.users = response.data.users; // Ensure the structure matches your API
                console.log('Fetched users:', this.users);
            } catch (error) {
                console.error('Error fetching users with roles:', error);
                this.error = 'Failed to fetch users. Please try again.';
            } finally {
                this.loading = false;
            }
        },
        goBack() {
            window.history.back();
        },
        async makeEducator(user) {
            await this.updateUserRole(user.user_id, 1);
        },
        async makeModerator(user) {
            await this.updateUserRole(user.user_id, 3);
        },
        async makeAdmin(user) {
            await this.updateUserRole(user.user_id, 2);
        },
        async updateUserRole(userId, newRoleId) {
            const payload = { role_id: newRoleId };
            console.log('Updating user role for user ID:', userId, 'with payload:', payload);

            try {
                const response = await axios.patch(`/api/users/${userId}/update`, payload);
                console.log('Response after updating user role:', response.data);
                await this.fetchUsersWithRoles();


                // Check if response contains the updated user data if needed
                this.$notify({
                    title: 'Success',
                    message: 'User role updated successfully!',
                    type: 'success'
                });

                // Fetch updated user list without reloading the page
                await this.fetchUsersWithRoles(); // Fetch updated user data
            } catch (error) {
                console.error('Error updating user role:', error.response ? error.response.data : error);
                this.$notify({
                    title: 'Error',
                    message: error.response?.data.message || 'An error occurred while updating the user role.',
                    type: 'error'
                });
            }
        },
        async deleteUser(user) {
            if (!user.user_id) {
                console.error('Error: user ID is undefined or missing.');
                return;
            }

            try {
                const response = await axios.delete(`/api/users/${user.user_id}`);
                if (response.status === 200) {
                    console.log('User deleted successfully:', response.data);
                    this.users = this.users.filter(u => u.user_id !== user.user_id);
                }
            } catch (error) {
                console.error('Error deleting the user:', error.response?.data || error.message);
            }
        },
    },
};
</script>


<style>
.rounded-image {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    overflow: hidden;
}
</style>
