<template>
    <v-dialog v-model="dialog" max-width="800px">
        <v-card>
            <v-card-title>
                <span class="headline">Post</span>
            </v-card-title>
            <v-card-text>
                <v-text-field v-model="editedPost.title" label="Title"></v-text-field>
                <v-textarea v-model="editedPost.content" label="Content"></v-textarea>
                <v-file-input v-model="imageFile" label="Image" accept="image/*"></v-file-input>
                <!--                <v-img v-if="imagePreview" :src="imagePreview" height="200px"></v-img>-->
            </v-card-text>
            <v-card-actions>
                <v-btn color="primary" @click="saveChanges">Save</v-btn>
                <v-btn color="red" text @click="cancel">Cancel</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    props: {
        post: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            dialog: false,
            editedPost: {
                id:null,
                title: '',
                content: '',
                image: null
            },
            imageFile: null,
        };
    },

    methods: {

        saveChanges() {
            this.dialog = false;
        },
        cancel() {
            this.dialog = false;
        },

    }
};
</script>
