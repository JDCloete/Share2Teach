<template>
    <div>
        <!-- Search Bar for Filtering Documents -->
        <v-text-field
            v-model="search"
            label="Search documents"
            prepend-inner-icon="mdi-magnify"
            outlined
        ></v-text-field>

        <v-list>
            <v-list-item v-for="document in documents" :key="document.id">
                <v-list-item-content>
                    <v-list-item-title>{{ document.name }}</v-list-item-title>
                    <v-list-item-subtitle>{{ document.description }}</v-list-item-subtitle>
                </v-list-item-content>
                <v-list-item-action>
                    <v-btn @click="downloadDocument(document.id)">Download</v-btn>
                </v-list-item-action>
            </v-list-item>
        </v-list>



        <!-- Documents List or Table -->
        <v-data-table
            :items="filteredDocuments"
            :headers="headers"
            item-key="id"
            class="elevation-1"
            :search="search"
        >
            <!-- Action for Previewing or Downloading a Document -->
            <template v-slot:item.actions="{ item }">
                <v-btn icon @click="viewDocument(item)">
                    <v-icon>mdi-eye</v-icon> <!-- View Icon -->
                </v-btn>
                <v-btn icon @click="downloadDocument(item)">
                    <v-icon>mdi-download</v-icon> <!-- Download Icon -->
                </v-btn>
            </template>
        </v-data-table>

        <!-- Snackbar for Success/Failure Feedback -->
        <v-snackbar v-model="snackbar" :color="snackbarColor" timeout="3000">
            {{ snackbarMessage }}
        </v-snackbar>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'ModerationPage',
    data() {
        return {
            documents: [], // To store documents fetched from the backend
            search: '', // Search input binding
            snackbar: false, // Snackbar control
            snackbarMessage: '', // Snackbar message
            snackbarColor: 'success', // Snackbar color
            headers: [
                { text: 'Document Name', value: 'name' },
                { text: 'Category', value: 'category' },
                { text: 'Actions', value: 'actions', sortable: false },
            ],
        };
    },
    computed: {
        // Filter documents based on search input
        filteredDocuments() {
            return this.documents.filter(document => {
                return (
                    document.name.toLowerCase().includes(this.search.toLowerCase()) ||
                    document.category.toLowerCase().includes(this.search.toLowerCase())
                );
            });
        },
    },
    mounted() {
        this.fetchDocuments(); // Fetch documents on component load
    },
    methods: {
        async fetchDocuments() {
            try {
                const response = await axios.get('/api/documents'); // API call to fetch documents
                this.documents = response.data;
            } catch (error) {
                console.error('Error fetching documents:', error);
                this.showSnackbar('Failed to load documents', 'error');
            }
        },
        viewDocument(document) {
            // Logic to open a modal or new page to preview the document
            this.showSnackbar(`Previewing ${document.name}`);
        },
        downloadDocument(document) {
            // Logic to handle document download
            window.location.href = `/api/documents/download/${document.id}`;
            this.showSnackbar(`Downloading ${document.name}`);
        },
        showSnackbar(message, color = 'success') {
            this.snackbarMessage = message;
            this.snackbarColor = color;
            this.snackbar = true;
        },
    },
};
</script>

<style scoped>
/* Add any custom styling here */
</style>
