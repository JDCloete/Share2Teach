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
        <data-table-explorer-baseline :action-button="false" :search-enabled="true">

            <!--Title-->
            <template v-slot:toolbar-title>Newly Uploaded Documents</template>

            <!--Data-->
            <template v-slot:library-items>
                <v-table>
                    <thead>
                    <tr>
                        <th>Document Name</th>
                        <th>Uploaded By</th>
                        <th>Uploaded Date</th>
                        <th>Type</th>
                        <th>Size (MB)</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="document in filteredDocuments" :key="document.id">
                        <td>{{ document.document_name }}</td>
                        <td>{{ document.user.name + ' ' + document.user.surname }}</td>
                        <td>{{ formatDate(document.created_at) }}</td>
                        <td>{{ document.metadata.type }}</td>
                        <td>{{ document.metadata.size/1000000 }}</td>
                        <td>
                            <v-btn type="icon" variant="flat" size="small" elevation="0" @click="editDocument(document)">
                                <v-icon>mdi-check</v-icon>
                            </v-btn>
                            <v-btn type="icon" variant="flat" size="small" elevation="0" @click="deleteDocument(document)">
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
    name: 'ModerationPage',
    components: {DataTableExplorerBaseline},
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
                { text: 'Size (MB)', value: 'size' },
                { text: 'Actions', value: 'actions', sortable: false },
            ],
        };
    },
    created() {
        // this.fetchDocuments();
    },
    methods: {
        async fetchDocuments() {
            try {
                const response = await axios.get('/api/documents');
                console.log(response.data); // Log the response data for debugging

                // Update documents array with the response data
                this.documents = response.data.documents;

                // Initialize filteredDocuments with all documents
                this.filteredDocuments = this.documents;
            } catch (error) {
                console.error('Error fetching documents:', error);
            }
        },
        formatDate(date) {
            if (!date) return 'Unknown'; // Fallback for missing dates
            return new Date(date).toISOString().split('T')[0]; // Format date as YYYY-MM-DD
        },
        filterDocuments() {
            const searchTerm = this.search.toLowerCase();
            this.filteredDocuments = this.documents.filter(document =>
                document.document_name.toLowerCase().includes(searchTerm) ||
                document.uploaded_by.toLowerCase().includes(searchTerm) ||
                document.type.toLowerCase().includes(searchTerm)
            );
        },
        async editDocument(document) {
            try {
                // Make an Axios PATCH request to update the document
                const response = await axios.patch(`api/documents/${document.id}`, {
                    is_approved: true,
                });

                // Handle the successful response (e.g., show a success message or refresh the document list)
                console.log('Document updated successfully:', response.data);
            } catch (error) {
                // Handle any errors (e.g., show an error message)
                console.error('Error updating the document:', error.response?.data || error.message);
            }
        },
        async deleteDocument(document) {
            // Logic for deleting a document
            console.log('Deleting document:', document);

            try {
                // Make an Axios PATCH request to update the document
                const response = await axios.delete(`api/documents/${document.id}`);

                // Handle the successful response (e.g., show a success message or refresh the document list)
                console.log('Document updated successfully:', response.data);
            } catch (error) {
                // Handle any errors (e.g., show an error message)
                console.error('Error updating the document:', error.response?.data || error.message);
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
</style>
