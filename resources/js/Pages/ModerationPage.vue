<template>
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
        <v-toolbar-title class="d-flex">Moderation Process</v-toolbar-title>
        <v-spacer></v-spacer>

        <!-- Search Bar -->
        <v-layout row align-center justify-center>
            <v-text-field
                v-model="search"
                label="Search for Documents"
                prepend-inner-icon="mdi-magnify"
                clearable
                hide-details
                solo-inverted
                flat
                style="max-width: 450px; height: 60px; font-size: 5px; margin-left: -300px;"
                @input="filterDocuments"
            ></v-text-field>
        </v-layout>
    </v-toolbar>

    <v-container>
        <v-data-table
            :headers="headers"
            :items="filteredDocuments"
            class="elevation-1"
            item-key="document_name"
        >
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
            search: '', // Search input value
            filteredDocuments: [], // Filtered documents based on search
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
                this.filteredDocuments = this.documents; // Set initial filtered data
            } catch (error) {
                console.error('Error fetching documents:', error);
            }
        },
        formatDate(date) {
            return new Date(date).toLocaleDateString(); // Format date as needed
        },
        filterDocuments() {
            // Filter documents based on search term
            const searchTerm = this.search.toLowerCase();
            this.filteredDocuments = this.documents.filter(document =>
                document.document_name.toLowerCase().includes(searchTerm) ||
                document.uploaded_by.toLowerCase().includes(searchTerm) ||
                document.type.toLowerCase().includes(searchTerm)
            );
        },
        editDocument(document) {
            // Logic for editing a document
        },
        deleteDocument(document) {
            // Logic for deleting a document
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
