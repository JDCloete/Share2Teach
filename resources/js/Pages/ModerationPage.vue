<template>
    <v-app class="background-image">
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
            <v-toolbar-title class="d-flex">Moderation Process</v-toolbar-title>
        </v-toolbar>
        <v-container style="padding: 50px">
            <data-table-explorer-baseline :action-button="false" :search-enabled="false">


                <template v-slot:toolbar-title>Newly Uploaded Documents</template>
                <template v-slot:library-items>
                    <v-table style="width: 100%; height: 300px;">
                        <thead>
                        <tr>
                            <th>Document Name</th>
                            <th>Uploaded By</th>
                            <th>Uploaded Date</th>
                            <th>Type</th>
                            <th>Size (KB)</th>
                            <th>Accept | Reject</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="document in filteredDocuments" :key="document.id">
                            <td>{{ document.document_name }}</td>
                            <td>{{ document.user.name + ' ' + document.user.surname }}</td>
                            <td>{{ formatDate(document.created_at) }}</td>
                            <td>{{ document.metadata.type }}</td>
                            <td>{{ (document.metadata.size / 1000).toFixed(2) }}</td>
                            <td>
                                <v-btn
                                    type="icon"
                                    variant="flat"
                                    size="small"
                                    elevation="0"
                                    @click="editDocument(document)"
                                >
                                    <v-icon>mdi-check</v-icon>
                                </v-btn>
                                <v-btn
                                    type="icon"
                                    variant="flat"
                                    size="small"
                                    elevation="0"
                                    @click="deleteDocument(document)"
                                >
                                    <v-icon>mdi-close</v-icon>
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
    name: 'ModerationPage',
    components: { DataTableExplorerBaseline },
    props: {
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
        }
    },
    created() {
        //this.fetchDocuments(); // Uncomment to fetch documents on component creation
    },
    watch: {
        search(newSearch) {
            this.filterDocuments();
        }
    },
    methods: {
        async fetchDocuments() {
            try {
                const response = await axios.get('/api/documents');
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
        async editDocument(document) {
            try {
                const response = await axios.patch(`api/documents/${document.id}`, {
                    is_approved: true,
                });
                window.location.reload();
            } catch (error) {
                console.error('Error updating the document:', error.response?.data || error.message);
            }
        },
        async deleteDocument(document) {
            try {
                const response = await axios.delete(`api/documents/${document.id}`);
                window.location.reload();
            } catch (error) {
                console.error('Error deleting the document:', error.response?.data || error.message);
            }
        },
        goBack() {
            window.history.back();
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
.background-image {
    background-image: url('https://as2.ftcdn.net/v2/jpg/03/57/05/61/1000_F_357056172_AOxoyKV4D20Bsw17SvkzcMfWSOLTIGzJ.jpg'); /* Replace with your image URL */
    /*background-image: url('https://lh4.googleusercontent.com/ySrY2iqkZd_57_JpSOz84tx69Lbr4ydtwCv6CTJ_uM1vktNbJCcCPGlYKi_QHLfiTRAPonOMxXyQgRAMdkKzkUI=w16383'); /* Replace with your image URL */
    background-size: cover; /* Cover the entire page */
    background-position: center; /* Center the background image */
    background-repeat: no-repeat; /* Prevent repeating the background image */
    min-height: 100vh; /* Ensure the background covers the full viewport height */
}
</style>
