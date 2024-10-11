<template>
    <div>
        <template v-if="roleId !== null">
            <!-- Contribute Documents button is visible to all roles -->
            <v-btn v-if="roleId === 1" color="green">Contribute Documents</v-btn>

            <!-- Admin (roleId === 2) specific buttons -->
            <v-btn v-if="roleId === 2" color="blue">Moderate Documents</v-btn>
            <v-btn v-if="roleId === 2" color="red">View Analytics</v-btn>

            <!-- Moderator (roleId === 3) specific button -->
            <v-btn v-if="roleId === 3" color="blue">Moderate Documents</v-btn>
        </template>
    </div>
</template>

<script>
export default {
    props: {
        role_id: {
            type: [String, Number], // Accept both string and number
            required: true
        }
    },
    computed: {
        roleId() {
            return Number(this.role_id); // Convert role_id to a number
        }
    }
};
</script>
