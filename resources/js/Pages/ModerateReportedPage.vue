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
        <v-toolbar-title class="d-flex">Moderation Process</v-toolbar-title>
    </v-toolbar>
    <v-container style="padding: 50px">
        <data-table-explorer-baseline :action-button="false" :search-enabled="false">
            <template v-slot:toolbar-title>Reported Documents</template>
            <template v-slot:library-items>
                <v-table>
                    <thead>
                    <tr>
                        <th>Reported By</th>
                        <th>Document Name</th>
                        <th>Report Reason</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="document in filteredDocuments" :key="document.document_id">
                        <td>{{ document.uploaded_by }}</td>
                        <td>{{ document.document_name }}</td>
                        <td>{{ document.report_reason }}</td>
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
</template>

<script>
import axios from 'axios';
import DataTableExplorerBaseline from '../Components/BaselineDataTable.vue';

export default {
    name: 'ModerateReportedPage',
    components: { DataTableExplorerBaseline },
    data() {
        return {
            documents: [], // Holds the original fetched documents
            filteredDocuments: [], // Initialize as an empty array
            search: '', // Search term for filtering documents
        };
    },
    created() {
        this.fetchDocuments(); // Fetch documents on component creation
    },
    methods: {
        async fetchDocuments() {
            try {
                const response = await axios.get('/api/reported-documents');

                // Ensure that report_id is part of the documents fetched
                this.documents = response.data.reported_documents.map(doc => ({
                    ...doc,
                    report_id: doc.report_id || doc.id // Ensure report_id is present
                }));

                this.filteredDocuments = this.documents;
            } catch (error) {
                console.error('Error fetching reported documents:', error);
            }
        },
        goBack() {
            window.history.back();
        },
        async editDocument(document) {
            try {
                console.log('Document being edited:', document); // Log document to check if it contains the correct data

                // Step 1: Patch the document (approve it)
                const response = await axios.patch(`/api/reported-documents/${document.report_id}`, {
                    action_taken: 'approved', // Ensure you're updating the report action
                });
                console.log('Update response:', response.data); // Log the response

                // Step 2: Call deleteDocument function to delete the report after approval
                await this.deleteDocument(document);

                window.location.reload(); // Reload the page after the update
            } catch (error) {
                console.error('Error updating the report:', error.response?.data || error.message); // Improved error logging
            }
        },

        async deleteDocument(document) {
            console.log('Document being deleted:', document); // Ensure report_id exists
            if (!document.report_id) {
                console.error('Error: report_id is undefined or missing in the document');
                return;
            }

            try {
                const response = await axios.delete(`/api/reported-documents/${document.report_id}`); // Use report_id
                console.log('Delete response:', response.data); // Log the response
                window.location.reload();
            } catch (error) {
                console.error('Error deleting the report:', error.response?.data || error.message);
            }
        }



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
</style>
