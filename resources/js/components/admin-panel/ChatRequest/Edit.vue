<template>

    <div class="chat-request-edit">

        <div class="form-group mb-4">
            <label for="model" class="mb-1">
                Chat model
            </label>
            <input 
                v-model="chatRequest.model" 
                type="text" 
                class="form-control" 
                v-bind:class="{'is-invalid': errors.hasOwnProperty('model'),}" 
                id="model" 
                placeholder="ID of the model to use">
        </div>

        <div class="form-group mb-4">
            <label for="text" class="mb-1">
                Request text
            </label>
            <textarea 
                v-model="chatRequest.request_text" 
                class="form-control" 
                v-bind:class="{'is-invalid': errors.hasOwnProperty('request_text'),}" 
                id="text" 
                rows="3" 
                placeholder="Contents of request message"></textarea>
        </div>

        <div class="form-group mb-4">
            <label for="style" class="mb-1">
                Styles
            </label>
            <div class="d-flex mb-1">
                <input 
                    v-model="newStyle" 
                    type="text" 
                    class="form-control me-2"
                    v-bind:class="{'is-invalid': errors.hasOwnProperty('styles'),}" 
                    id="style" 
                    placeholder="New style">
                <button 
                    @click="addStyle" 
                    type="button" 
                    class="btn btn-primary">
                    Add
                </button>
            </div>

            <ul class="list-group styles">
                <li 
                    class="list-group-item d-flex justify-content-between align-items-center" 
                    v-for="style of chatRequest.styles">
                    {{ style }}
                    <span 
                        @click="deleteStyle(style)" 
                        class="delete-style text-danger" 
                        title="Delete">
                        x
                    </span>
                </li>
            </ul>
        </div>

        <div class="form-group mb-4">
            <label for="temperature" class="mb-1">
                Temperature <br>
                <mark>min: 0.0, max: 2.0</mark>
            </label>
            <input 
                v-model="chatRequest.temperature" 
                type="number" 
                min="0" 
                max="2" 
                step="0.1" 
                class="form-control" 
                v-bind:class="{'is-invalid': errors.hasOwnProperty('temperature'),}"
                id="temperature" 
                placeholder="0">
        </div>

        <div class="form-group mb-4">
            <label for="max_tokens" class="mb-1">
                Token counts <br>
                <mark>min: 1</mark>
            </label>
            <input 
                v-model="chatRequest.max_tokens" 
                type="number" 
                min="1" 
                step="1" 
                class="form-control" 
                v-bind:class="{'is-invalid': errors.hasOwnProperty('max_tokens'),}"
                id="max_tokens" 
                placeholder="1000">
        </div>
        
        <div class="form-group mb-4">
            <label for="presence_penalty" class="mb-1">
                Presence penalty <br>
                <mark>min: -2.0, max: 2.0</mark>
            </label>
            <input 
                v-model="chatRequest.presence_penalty" 
                type="number" 
                min="-2" 
                max="2" 
                step="0.1" 
                class="form-control" 
                v-bind:class="{'is-invalid': errors.hasOwnProperty('presence_penalty'),}"
                id="presence_penalty" 
                placeholder="0">
        </div>
        
        <div class="form-group mb-4">
            <label for="frequency_penalty" class="mb-1">
                Frequency penalty <br>
                <mark>min: -2.0, max: 2.0</mark>
            </label>
            <input 
                v-model="chatRequest.frequency_penalty" 
                type="number" 
                min="-2" 
                max="2" 
                step="0.1" 
                class="form-control" 
                v-bind:class="{'is-invalid': errors.hasOwnProperty('frequency_penalty'),}"
                id="frequency_penalty" 
                placeholder="0">
        </div>

        <button @click="editRequest" type="button" class="btn btn-primary">
            Edit request
        </button>

    </div>

</template>

<script>
export default {
    data() {
        return {
            chatRequest: {
                model: null,
                request_text: null,
                styles: [],
                temperature: null,
                max_tokens: null,
                presence_penalty: null,
                frequency_penalty: null,
            },
            errors: {},
            newStyle: null,
        }
    },
    methods: {
        getChatRequest() {
            this.$emit('loading')
            axios.get('/api/admin/chat-request')
                .then(res => {
                    this.chatRequest = res.data.data
                })
                .catch(res => {
                    alert('Something goes wrong. Try again.')
                })
                .finally(() => {
                    this.$emit('loaded')
                })
        },
        addStyle() {
            if (! this.newStyle) {
                alert('Enter new style.')
                return
            }

            this.chatRequest.styles.push(this.newStyle)
            this.newStyle = null
        },
        deleteStyle(style) {
            this.chatRequest.styles = 
                this.chatRequest.styles.filter(item => item != style)
        },
        editRequest() {
            this.$emit('loading')
            axios.put('/api/admin/chat-request', this.chatRequest)
                .then(res => {
                    alert('Chat request was updated.')
                })
                .catch(res => {
                    this.errors = res.response.data.errors
                })
                .finally(() => {
                    this.$emit('loaded')
                })
        },
    },
    mounted() {
        this.getChatRequest()
    },
    unmounted() {
        this.$emit('loaded')
    },
}
</script>

<style>
.delete-style {
    cursor: pointer;
}
</style>