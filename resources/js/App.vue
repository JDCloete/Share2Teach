<template>
    <v-card>
        <v-card-title>
            Hello Triple Vision !!!!
        </v-card-title>
        <v-card-subtitle>
            Hello
        </v-card-subtitle>
        <v-card-text>
            <v-icon>
                mdi-human-female-girl
            </v-icon>
        </v-card-text>
        <v-card-actions>
            <v-btn>
                Click Me !
            </v-btn>
            <v-combobox
                label="Combobox"
                :items="['California', 'Colorado', 'Florida', 'Georgia', 'Texas', 'Wyoming']"
            ></v-combobox>
        </v-card-actions>
    </v-card>
</template>

<script>
export default {
    name: 'App',
};
</script>
