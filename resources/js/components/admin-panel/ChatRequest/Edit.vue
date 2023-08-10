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

            <div class="mb-3" v-for="request_text, i in chatRequest.request_text">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <input 
                        v-model="request_text.name" 
                        type="text" 
                        class="form-control request-name"
                        v-bind:class="{'is-invalid': errors.hasOwnProperty('request_text'),}" 
                        placeholder="Request name"
                        @focusin="focusinRequestText">
                        <span 
                            @click="deleteRequestText(i)" 
                            class="delete text-danger" 
                            title="Delete">
                            x
                        </span>
                </div>
                <textarea 
                    v-model="request_text.text" 
                    :class="'form-control request-text' + (i == 0 ? '' : ' d-none')" 
                    v-bind:class="{'is-invalid': errors.hasOwnProperty('request_text'),}"
                    rows="13" 
                    placeholder="Request text"></textarea>
            </div>

            <div class="btn btn-primary" @click="addNewRequestText">Add new request text</div>
        </div>

        <div class="form-group mb-4">
            <label for="style" class="mb-1">
                Styles
            </label>
            <div class="d-flex mb-1">
                <input 
                    v-model="newStyle.name" 
                    type="text" 
                    class="form-control me-2"
                    v-bind:class="{'is-invalid': errors.hasOwnProperty('styles'),}" 
                    id="style" 
                    placeholder="Style name">
                <input 
                    v-model="newStyle.text" 
                    type="text" 
                    class="form-control me-2"
                    v-bind:class="{'is-invalid': errors.hasOwnProperty('styles'),}" 
                    id="style" 
                    placeholder="Style text">
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
                    v-for="style, i in chatRequest.styles">
                    <input 
                        v-model="style.name"
                        type="text" 
                        class="form-control me-2"
                        id="style" 
                        placeholder="Style name">
                    <input 
                        v-model="style.text" 
                        type="text" 
                        class="form-control me-2"
                        id="style" 
                        placeholder="Style text">
                    <span 
                        @click="deleteStyle(i)" 
                        class="delete text-danger" 
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
                request_text: [],
                styles: [],
                temperature: null,
                max_tokens: null,
                presence_penalty: null,
                frequency_penalty: null,
            },
            errors: {},
            newStyle: {},
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
            if (! this.newStyle.name || !this.newStyle.text) {
                alert('Enter new style.')
                return
            }

            this.chatRequest.styles.push({
                name: this.newStyle.name,
                text: this.newStyle.text,
            })
            this.newStyle = {}
        },
        deleteStyle(i) {
            this.chatRequest.styles = 
                this.chatRequest.styles.filter((style, index) => index != i )
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
        addNewRequestText() {
            this.chatRequest.request_text.push({
                name: '',
                text: '',
            })
        },
        deleteRequestText(i) {
            this.chatRequest.request_text = 
                this.chatRequest.request_text.filter((request_text, index) => index != i )
        },
        focusinRequestText(e) {
            const texts = document.getElementsByClassName('request-text')
            for (const text of texts) {
                text.classList.add('d-none')
            }
            for (const el of e.target.parentElement.parentElement.children) {
                if (el.tagName == 'TEXTAREA') {
                    el.classList.remove('d-none')
                }
            }
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
.delete {
    cursor: pointer;
    width: 75px;
    text-align: center;
}
</style>