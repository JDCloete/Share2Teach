<template>
    <v-app class="background-image">
        <v-toolbar color="primary" dark  style="margin-bottom: 30px">
            <img
                @click="goBack"
                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSv6vyFZbiqMYZ5njBX94kjv3u0bq_QyUvQCIB0Qj9rhlI5ExI26FAlmU4c30jUUgTgFQQ&usqp=CAU"
                alt="Logo"
                class="mr-2 rounded-image"
                width="30"
                height="30"
                style="object-fit: cover; margin-left: 15px;"
            />
            <v-toolbar-title class="d-flex">Contribute Files</v-toolbar-title>
        </v-toolbar>

        <v-container class="fill-height">
            <v-row class="d-flex justify-center align-center">
                <!-- Section 1: Upload -->
                <v-col cols="12" md="4">
                    <v-card class="upload-section" outlined>
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
                </v-col>

                <!-- Section 2: Details -->
                <v-col cols="12" md="4">
                    <v-card class="details-section" outlined>
                        <v-card-title>Details</v-card-title>
                        <v-card-text>
                            <v-text-field label="Document Name" v-model="documentName" required></v-text-field>
                            <v-select
                                label="Module Code"
                                :items="['Mathematics', 'Business Studies', 'History', 'Geography', 'Life Science', 'Natural Science', 'English', 'Technology', 'Afrikaans', 'Life Skills', 'Computer Science']"
                                v-model="moduleCode"
                                required
                            ></v-select>
                            <v-select
                                label="Category"
                                :items="['Lecture Notes', 'Assignments', 'Summaries', 'Memos', 'Quiz Questions']"
                                v-model="category"
                                required
                            ></v-select>
                            <v-select
                                label="Relevant Academic Year"
                                :items="['2018','2019', '2020', '2021', '2022', '2023', '2024']"
                                v-model="academicYear"
                                required
                            ></v-select>
                            <v-text-field label="Lecturer Name" v-model="lecturerName" required></v-text-field>
                        </v-card-text>
                    </v-card>
                </v-col>

                <!-- Section 3: Processing -->
                <v-col cols="12" md="4">
                    <v-card class="upload-section" outlined>
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
                </v-col>
            </v-row>


        </v-container>
        <v-container class="fill-height">
            <v-row class="d-flex justify-center align-center">
                <v-btn color="primary" @click="uploadAndSubmitFile" style="margin-right: 20px">Submit</v-btn>
                <v-btn color="secondary" @click="resetForm">Reset</v-btn>
            </v-row>
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
        uploadAndSubmitFile() {
            this.processingMessage = 'Uploading file...'; // Set the processing message
            this.uploadProgress = 0; // Reset upload progress
            this.errorMessage = ''; // Clear any previous error messages

            // Validate required fields
            if (!this.file || !this.documentName || !this.moduleCode || !this.category || !this.academicYear || !this.lecturerName) {
                this.errorMessage = 'Please fill in all required fields.';
                return;
            }

            // Create a FormData object to send the file and metadata
            const formData = new FormData();
            formData.append('file', this.file);
            formData.append('document_name', this.documentName);
            formData.append('module_code', this.moduleCode);
            formData.append('category', this.category);
            formData.append('academic_year', this.academicYear);
            formData.append('lecturer_name', this.lecturerName);

            // Make the API call to upload the file
            axios.post('/api/upload-documents', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
                onUploadProgress: progressEvent => {
                    this.uploadProgress = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                },
            })
                .then(response => {
                    this.successMessage = response.data.message; // Display success message
                    this.resetForm(); // Reset the form after success
                })
                .catch(error => {
                    this.processingMessage = ''; // Clear the processing message on error

                    if (error.response) {
                        if (error.response.status === 409) {
                            this.errorMessage = 'An error occurred: This document already exists in the database.';
                        } else {
                            this.errorMessage = error.response.data.message || 'An error occurred. Please try again.';
                        }
                    } else {
                        this.errorMessage = 'An error occurred. Please check your connection.';
                    }
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
            this.uploadProgress = 0; // Reset upload progress

            // Clear the success message after 3 seconds
            setTimeout(() => {
                this.successMessage = '';
            }, 5000); // 5000 milliseconds = 5 seconds
        },
        goBack() {
            window.history.back();
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
}

.fill-height {
    height: calc(100vh - 64px); /* Ensure it fills most of the screen */
}

.rounded-image {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
}

.d-flex {
    display: flex;
}
</style>
