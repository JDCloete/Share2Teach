<template>
    <v-app class="background-image">
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
                    <v-btn block v-if="roleId === 1 || roleId === 2 || roleId === 3"
                           color="blue"
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
                    v-bind="props"
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

                <!-- Tooltip for OER -->
                <v-tooltip text="Moderate Newly Uploaded Documents">
                    <template v-slot:activator="{ props }">
                        <v-list-item
                            class="centered-list-item outlined-item"
                            v-if="roleId === 2 || roleId === 3"
                            @click="goToModerateDocuments"
                            v-bind="props"
                        >
                            <v-list-item-content>
                                <v-list-item-title class="text-center">Moderate Documents</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </template>
                </v-tooltip>


                <!-- Tooltip for OER -->
                <v-tooltip text="Moderate Reported Documents">
                    <template v-slot:activator="{ props }">
                        <v-list-item
                            class="centered-list-item outlined-item"
                            v-if="roleId === 2 || roleId === 3"
                            @click="goToModerateReported"
                            v-bind="props"
                        >
                            <v-list-item-content>
                                <v-list-item-title class="text-center">Moderate Reported</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </template>
                </v-tooltip>


                <!-- Tooltip for OER -->
                <v-tooltip text="Change The Access Levels Of Users">
                    <template v-slot:activator="{ props }">
                        <v-list-item
                            class="centered-list-item outlined-item"
                            v-if="roleId === 2 || roleId === 3"
                            @click="goToModerateUsers"
                            v-bind="props"
                        >
                            <v-list-item-content>
                                <v-list-item-title class="text-center">Moderate Users</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </template>
                </v-tooltip>



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

        <v-container style="height: calc(100vh - 64px); margin-left: 220px;  margin-top: 1px;">
            <data-table-explorer-baseline :action-button="true">

<!--                <template v-slot:toolbar-title>Newly Uploaded Documents</template>-->
                <template v-slot:library-items>
                    <v-table>
                        <thead>
                        <tr>
                            <th>Document Name</th>
                            <th>Uploaded By</th>
                            <th>Uploaded Date</th>
                            <th>Type</th>
                            <th>Size (KB)</th>
                            <th>Document Rating Average</th>
                            <th>Rate</th>
                            <th>Report</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="document in filteredDocuments" :key="document.id">
                            <td>{{ document.document_name }}</td>
                            <td>{{ document.user.name + ' ' + document.user.surname }}</td>
                            <td>{{ formatDate(document.created_at) }}</td>
                            <td>{{ document.metadata.type }}</td>
                            <td>{{ (document.metadata.size / 1000).toFixed(2) }}</td>
                            <td>{{ (document.document_rating_average).toFixed(2)  }}</td>
                            <td>
                                <v-btn
                                    type="icon"
                                    variant="flat"
                                    size="small"
                                    elevation="0"
                                    @click="rateDocument(document, 1)"
                                >
                                    <v-icon>mdi-numeric-1</v-icon>
                                </v-btn>
                                <v-btn
                                    type="icon"
                                    variant="flat"
                                    size="small"
                                    elevation="0"
                                    @click="rateDocument(document, 2)"
                                >
                                    <v-icon>mdi-numeric-2</v-icon>
                                </v-btn>
                                <v-btn
                                    type="icon"
                                    variant="flat"
                                    size="small"
                                    elevation="0"
                                    @click="rateDocument(document, 3)"
                                >
                                    <v-icon>mdi-numeric-3</v-icon>
                                </v-btn>
                                <v-btn
                                    type="icon"
                                    variant="flat"
                                    size="small"
                                    elevation="0"
                                    @click="rateDocument(document, 4)"
                                >
                                    <v-icon>mdi-numeric-4</v-icon>
                                </v-btn>
                                <v-btn
                                    type="icon"
                                    variant="flat"
                                    size="small"
                                    elevation="0"
                                    @click="rateDocument(document, 5)"
                                >
                                    <v-icon>mdi-numeric-5</v-icon>
                                </v-btn>
                            </td>
                            <td>
                                <v-btn
                                    type="icon"
                                    variant="flat"
                                    size="small"
                                    elevation="0"
                                    @click="reportDocument(document)"
                                >
                                    <v-icon>mdi-exclamation</v-icon>
                                </v-btn>
                            </td>
                        </tr>
                        </tbody>
                    </v-table>
                </template>
            </data-table-explorer-baseline>
        </v-container>
    </v-app>
</template>

<script>
import axios from 'axios';
import DataTableExplorerBaseline from '../Components/BaselineDataTable.vue';

export default {
    name: 'ExplorePage',
    components: {DataTableExplorerBaseline},
    props: {
        role_id: {
            type: [String, Number], // Accept both string and number
            required: false // Make this optional
        },
        filteredDocuments: {
            required: true,
        }
    },
    data() {
        return {
            documents: [],
            search: '',
            headers: [
                { text: 'Document Name', value: 'document_name' },
                { text: 'Uploaded By', value: 'uploaded_by' },
                { text: 'Upload Date', value: 'upload_date' },
                { text: 'Type', value: 'type' },
                { text: 'Size (KB)', value: 'size' },
                { text: 'Document Rating Average', value: 'document_rating_average' },
                { text: 'Actions', value: 'actions', sortable: false },
            ],
        };
    },
    computed: {
        filterDocuments() {
            if (!this.search) {
                this.filteredDocuments = this.documents;
                return;
            }
            const searchTerm = this.search.toLowerCase();
            return this.documents.filter(document =>
                document.document_name.toLowerCase().includes(searchTerm) ||
                document.uploaded_by.toLowerCase().includes(searchTerm) ||
                document.type.toLowerCase().includes(searchTerm)
            );
        },
        roleId() {
            return this.role_id ? Number(this.role_id) : null; // Convert role_id to a number or null
        }
    },
    watch: {
        search(newSearch) {
            this.filterDocuments();
        }
    },
    methods: {
        async fetchDocuments() {
            try {
                const response = await axios.get('/api/documents/display');
                this.documents = response.data.documents;
                this.filteredDocuments = this.documents;
            } catch (error) {
                console.error('Error fetching documents:', error);
            }
        },
        formatDate(date) {
            if (!date) return 'Unknown'; // Fallback for missing dates
            return new Date(date).toISOString().split('T')[0]; // Format date as YYYY-MM-DD
        },
        async rateDocument(document, rating) {
            try {
                const response = await axios.patch(`api/documents/rate/${document.id}`, {
                    is_approved: true, // Required field
                    document_rating_average: rating, // The rating you want to patch
                });
                window.location.reload();
            } catch (error) {
                console.error('Error updating the document:', error.response?.data || error.message);
            }
        },
        async reportDocument(document) {
            try {
                const response = await axios.patch(`api/documents/report/${document.id}`, {
                    is_approved: true,
                });
                window.location.reload();
            } catch (error) {
                console.error('Error updating the document:', error.response?.data || error.message);
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
        goToModerateReported() {
            this.$inertia.visit('/moderate-reported');
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

.background-image {
    background-image: url('https://as2.ftcdn.net/v2/jpg/03/57/05/61/1000_F_357056172_AOxoyKV4D20Bsw17SvkzcMfWSOLTIGzJ.jpg'); /* Replace with your image URL */
    /*background-image: url('https://lh4.googleusercontent.com/ySrY2iqkZd_57_JpSOz84tx69Lbr4ydtwCv6CTJ_uM1vktNbJCcCPGlYKi_QHLfiTRAPonOMxXyQgRAMdkKzkUI=w16383'); /* Replace with your image URL */
    background-size: cover; /* Cover the entire page */
    background-position: center; /* Center the background image */
    background-repeat: no-repeat; /* Prevent repeating the background image */
    min-height: 100vh; /* Ensure the background covers the full viewport height */
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
