<template>
    <AppClean :app-bar-header="appBarHeader">
        <student-users-data-table
            :student-users="studentUsers"
            @add-user="openStudentDialog"
            @edit-user="openEditDialog"
            @delete-user="openDeleteDialog"
        ></student-users-data-table>

        <student-form-dialog
            v-if="showStudentDialog"
            :loading="loading"
            :student="selectedStudent"
            :isUpdate="isUpdate"
            @saveStudent="saveStudent"
            @editStudent="editStudent"
            @closeDialog="closeStudentDialog"
        ></student-form-dialog>

        <delete-student-dialog
            v-if="showDeleteDialog"
            :loading="loading"
            :student="selectedStudent"
            @deleteStudentClicked="deleteStudent"
            @dialogClosed="closeDeleteDialog"
        ></delete-student-dialog>
    </AppClean>
</template>

<script>
import axios from 'axios';
import AppClean from "@/Layouts/AppClean.vue";
import StudentUsersDataTable from "@/Components//StudentUsersDataTable.vue";
import StudentFormDialog from "@/Components/StudentFormDialog.vue";
import DeleteStudentDialog from "@/Components/DeleteStudentDialog.vue";

export default {
    name: 'ModerateUserPage',
    components: {
        AppClean,
        StudentUsersDataTable,
        StudentFormDialog,
        DeleteStudentDialog
    },
    props: {
        appBarHeader: {
            type: String,
            required: false,
            default: 'Manage Students',
        },
        studentUsers: {
            type: Array,
            required: true,
            default: () => [],
        }
    },
    data() {
        return {
            isUpdate: false,
            showStudentDialog: false,
            showDeleteDialog: false,
            loading: false,
            selectedStudent: {
                first_name: '',
                last_name: '',
                email: '',
                studentNumber: '',
            }
        };
    },
    methods: {
        async fetchStudents() {
            this.loading = true;
            try {
                const response = await axios.get('/api/users'); // Adjust endpoint as necessary
                this.studentUsers = response.data; // Assuming response is an array of student users
            } catch (error) {
                console.error(error);
            } finally {
                this.loading = false;
            }
        },
        openStudentDialog() {
            this.isUpdate = false;
            this.selectedStudent = { first_name: '', last_name: '', email: '', studentNumber: '' };
            this.showStudentDialog = true;
        },
        openEditDialog(student) {
            this.isUpdate = true;
            this.selectedStudent = { ...student }; // Clone the student object
            this.showStudentDialog = true;
        },
        openDeleteDialog(student) {
            this.selectedStudent = student;
            this.showDeleteDialog = true;
        },
        async saveStudent(student) {
            this.loading = true;
            try {
                const response = await axios.post('/api/create/user', student);
                this.studentUsers.push(response.data.student); // Assuming the response contains the new student
            } catch (error) {
                console.error(error);
            } finally {
                this.loading = false;
                this.closeStudentDialog();
            }
        },
        async editStudent(student) {
            this.loading = true;
            try {
                const response = await axios.patch(`/api/edit/user/${student.id}`, student);
                const index = this.studentUsers.findIndex(s => s.id === student.id);
                if (index !== -1) {
                    this.$set(this.studentUsers, index, response.data.student); // Update existing student
                }
            } catch (error) {
                console.error(error);
            } finally {
                this.loading = false;
                this.closeStudentDialog();
            }
        },
        async deleteStudent(student) {
            this.loading = true;
            try {
                await axios.delete(`/api/delete/user/${student.id}`);
                this.studentUsers = this.studentUsers.filter(u => u.id !== student.id);
            } catch (error) {
                console.error(error);
            } finally {
                this.loading = false;
                this.closeDeleteDialog();
            }
        },
        closeStudentDialog() {
            this.showStudentDialog = false;
        },
        closeDeleteDialog() {
            this.showDeleteDialog = false;
        }
    },
    mounted() {
        this.fetchStudents(); // Fetch the initial list of students
    }
}
</script>

<style scoped>
/* Add any specific styles you need for this page */
</style>
