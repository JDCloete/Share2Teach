<template>
    <v-container>
        <v-data-table
            :headers="headers"
            :items="documents"
            class="elevation-1"
            item-key="document_name"
            :search="search"
        >
            <template v-slot:top>
                <v-toolbar>
                    <v-toolbar-title>Documents</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-text-field
                        v-model="search"
                        label="Search"
                        solo
                    ></v-text-field>
                </v-toolbar>
            </template>

            <template v-slot:items="props">
                <tr>
                    <td>{{ props.item.document_name }}</td>
                    <td>{{ props.item.uploaded_by }}</td>
                    <td>{{ formatDate(props.item.upload_date) }}</td>
                    <td>{{ props.item.type }}</td>
                    <td>{{ props.item.size }} MB</td>
                    <td>
                        <v-btn icon @click="editDocument(props.item)">
                            <v-icon>mdi-pencil</v-icon>
                        </v-btn>
                        <v-btn icon @click="deleteDocument(props.item)">
                            <v-icon>mdi-delete</v-icon>
                        </v-btn>
                    </td>
                </tr>
            </template>
        </v-data-table>
    </v-container>
</template>

<script>
import axios from 'axios';

export default {
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
        this.fetchDocuments(); // Fetch documents on component creation
    },
    methods: {
        async fetchDocuments() {
            try {
                const response = await axios.get('/api/documents');
                this.documents = response.data.documents; // Populate documents
            } catch (error) {
                console.error('Error fetching documents:', error);
            }
        },
        formatDate(date) {
            return new Date(date).toLocaleDateString(); // Format date as needed
        },
        editDocument(document) {
            // Logic for editing a document
        },
        deleteDocument(document) {
            // Logic for deleting a document
        },
    },
};
</script>

<style scoped>
/* Add any custom styles if needed */
</style>
