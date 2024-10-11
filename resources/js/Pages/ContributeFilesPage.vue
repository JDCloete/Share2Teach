<template>
    <v-app class="background-image">
        <v-toolbar color="primary" dark>
            <img
                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSv6vyFZbiqMYZ5njBX94kjv3u0bq_QyUvQCIB0Qj9rhlI5ExI26FAlmU4c30jUUgTgFQQ&usqp=CAU"
                alt="Logo"
                class="mr-2 rounded-image"
                width="30"
                height="30"
                style="object-fit: cover; margin-left: 15px;"
            />
            <v-toolbar-title class="d-flex">Contribute Files</v-toolbar-title>
        </v-toolbar>

        <v-container class="d-flex justify-center align-center fill-height">
            <!-- Section 1: Upload -->
            <v-card class="upload-section mx-4" outlined max-width="500">
                <v-card-title>Upload</v-card-title>
                <v-card-text>
                    <v-file-input
                        label="Drag & Drop files"
                        v-model="file"
                        accept=".pdf,.doc,.docx"
                        show-size
                        @change="uploadFile"
                    ></v-file-input>
                    <v-alert v-if="errorMessage" type="error">{{ errorMessage }}</v-alert>
                </v-card-text>
            </v-card>

            <!-- Section 2: Details -->
            <v-card class="details-section mx-4" outlined max-width="500">
                <v-card-title>Details</v-card-title>
                <v-card-text>
                    <v-text-field label="Document Name" v-model="documentName" required></v-text-field>
                    <v-select
                        label="Module Code"
                        :items="['MTH101', 'CS201', 'PHY301']"
                        v-model="moduleCode"
                        required
                    ></v-select>
                    <v-select
                        label="Category"
                        :items="['Lecture Notes', 'Assignments', 'Summaries']"
                        v-model="category"
                        required
                    ></v-select>
                    <v-select
                        label="Relevant Academic Year"
                        :items="['2022', '2023', '2024']"
                        v-model="academicYear"
                        required
                    ></v-select>
                    <v-text-field label="Lecturer Name" v-model="lecturerName" required></v-text-field>
                </v-card-text>
            </v-card>

            <!-- Section 3: Processing -->
            <v-card class="processing-section mx-4" outlined max-width="500">
                <v-card-title>Processing</v-card-title>
                <v-card-text>
                    <v-progress-linear
                        v-if="uploading"
                        :value="uploadProgress"
                        height="20"
                        color="primary"
                    ></v-progress-linear>
                    <v-alert v-if="processingMessage" type="info">{{ processingMessage }}</v-alert>
                    <v-alert v-if="successMessage" type="success">{{ successMessage }}</v-alert>
                </v-card-text>
            </v-card>
        </v-container>

        <v-container class="d-flex justify-center mt-4">
            <v-btn color="primary" @click="submitForm">Submit</v-btn>
            <v-btn color="secondary" @click="resetForm">Reset</v-btn>
        </v-container>
    </v-app>
</template>



<script>
import axios from 'axios';

export default {
    data() {
        return {
            file: null,
            documentName: '',
            moduleCode: '',
            category: '',
            academicYear: '',
            lecturerName: '',
            uploading: false,
            uploadProgress: 0,
            errorMessage: '',
            processingMessage: '',
            successMessage: '',
        };
    },
    methods: {
        uploadFile(event) {
            const selectedFile = event.target.files[0]; // Get the selected file
            if (selectedFile) {
                this.file = selectedFile; // Set the file data
                this.documentName = selectedFile.name.split('.').slice(0, -1).join('.'); // Set the document name to the file name without the extension
            }
        },
        submitForm() {
            if (!this.file || !this.documentName || !this.moduleCode || !this.category || !this.academicYear || !this.lecturerName) {
                this.errorMessage = 'Please fill in all required fields';
                return;
            }

            this.uploading = true;
            this.uploadProgress = 0;
            this.processingMessage = 'Uploading file...';

            const formData = new FormData();
            formData.append('file', this.file);
            formData.append('document_name', this.documentName);
            formData.append('module_code', this.moduleCode);
            formData.append('category', this.category);
            formData.append('academic_year', this.academicYear);
            formData.append('lecturer_name', this.lecturerName);

            axios.post('/api/documents', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
                onUploadProgress: progressEvent => {
                    this.uploadProgress = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                },
            })
                .then(response => {
                    this.processingMessage = ''; // Clear processing message
                    this.successMessage = 'File uploaded successfully!'; // Set success message

                    // Clear all fields after successful upload
                    this.resetForm();
                })
                .catch(error => {
                    this.errorMessage = 'An error occurred: ' + (error.response?.data?.message || 'Server error');
                })
                .finally(() => {
                    this.uploading = false; // Stop uploading state
                });
        },

        resetForm() {
            this.file = null;
            this.documentName = '';
            this.moduleCode = '';
            this.category = '';
            this.academicYear = '';
            this.lecturerName = '';
            this.errorMessage = '';
            this.processingMessage = '';
            // Retain success message and upload progress
            this.uploadProgress = 0; // Reset upload progress
        },
    },
};
</script>





<style scoped>
.background-image {
    background-image: url('https://as2.ftcdn.net/v2/jpg/03/57/05/61/1000_F_357056172_AOxoyKV4D20Bsw17SvkzcMfWSOLTIGzJ.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    min-height: 100vh;
}

.upload-section, .details-section {
    border: 2px solid #000;
    border-radius: 8px;
    padding: 20px;
    min-height: 450px; /* Make sections taller for more readable form */
}

.fill-height {
    height: calc(100vh - 64px); /* Ensure it fills most of the screen */
}

.v-card {
    min-height: 350px; /* Adjust to balance the sections */
    width: 100%; /* Allow the card to take the full width within the column */
}

.v-btn {
    margin: 0 10px;
}

.d-flex {
    display: flex;
}
</style>
