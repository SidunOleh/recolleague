<template>

    <div class="content-edit">

        <!-- header -->
        <div class="section mb-4">
            
            <div class="accordion-title h4" @click="open">
                Header
            </div>
            
            <div class="accordion-content">

                <div class="attachment d-flex flex-column align-items-start mb-3">
                    <div class="h6">Logo</div>
                    <img 
                        class="mb-2"
                        :src="getAttachmentURI(content.logo)"
                        v-if="content.logo">
                    <input  
                        type="file" 
                        class="form-control-file"
                        @change="e => content.logo = e.target.files[0]"/>
                </div>

            </div>

        </div>

        <!-- video section -->
        <div class="section mb-4">
            
            <div class="accordion-title h4" @click="open">
                Video section
            </div>
            
            <div class="accordion-content">

                <div class="h6">Title</div>
                <input 
                    class="form-control mb-3" 
                    type="text" 
                    placeholder="Title"
                    v-model="content.video_title"/>
                <div class="h6">Subtitle</div>
                <input 
                    class="form-control mb-3" 
                    type="text" 
                    placeholder="Subtitle"
                    v-model="content.video_subtitle"/>

                <div class="attachment d-flex flex-column align-items-start mb-3">
                    <div class="h6">Video preview</div>
                    <img 
                        class="mb-2"
                        :src="getAttachmentURI(content.videopreview_img)"
                        v-if="content.videopreview_img">
                    <input  
                        type="file" 
                        class="form-control-file"
                        @change="e => content.videopreview_img = e.target.files[0]"/>
                </div>

                <div class="attachment d-flex flex-column align-items-start">
                    <div class="h6">Video</div>
                    <video 
                        controls
                        class="mb-2"
                        v-if="content.video">
                        <source 
                            :src="getAttachmentURI(content.video)"/>
                    </video>
                    <input  
                        type="file" 
                        class="form-control-file"
                        @change="e => content.video = e.target.files[0]"/>
                </div>

            </div>

        </div>

        <!-- steps -->
        <div class="section mb-4">
            
            <div class="accordion-title h4" @click="open">
                Steps
            </div>

            <div class="accordion-content">
                
                <div class="h6">Title</div>
                <input 
                    class="form-control mb-3" 
                    type="text" 
                    placeholder="Title"
                    v-model="content.steps_title"/>
                
                <div class="items mb-3">

                    <div class="item" v-for="step, i in content.steps">

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="h6">Step</div>
                            <div 
                                class="delete text-danger" 
                                title="Delete step"
                                @click="content.steps.splice(i, 1)">
                                x
                            </div>
                        </div>

                        <input 
                            class="form-control mb-3" 
                            type="text" 
                            placeholder="Title"
                            v-model="content.steps[i]['title']"/>
                        <textarea 
                            class="form-control mb-3"
                            rows="3"
                            placeholder="Text"
                            v-model="content.steps[i]['text']"></textarea>

                            <div class="attachment d-flex flex-column align-items-start mb-3">
                                <img 
                                    class="mb-2"
                                    :src="getAttachmentURI(content.steps[i].img)"
                                    v-if="content.steps[i].img">
                                <input  
                                    type="file" 
                                    class="form-control-file"
                                    @change="e => content.steps[i].img = e.target.files[0]"/>
                            </div>

                    </div>

                    <div class="btn btn-primary" @click="addItem('steps', {title: '', text: '',})">
                        + add step
                    </div>

                </div>

            </div>

        </div>

        <!-- slider -->
        <div class="section mb-4">
            
            <div class="accordion-title h4" @click="open">
                Slider
            </div>

            <div class="accordion-content">
                
                <div class="h6">Title</div>
                <input 
                    class="form-control mb-3" 
                    type="text" 
                    placeholder="Title"
                    v-model="content.slider_title"/>
                
                <div class="items mb-3">

                    <div class="item" v-for="slide, i in content.slider">

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="h6">Slide</div>
                            <div 
                                class="delete text-danger" 
                                title="Delete slide"
                                @click="content.slider.splice(i, 1)">
                                x
                            </div>
                        </div>

                        <input 
                            class="form-control mb-3" 
                            type="text" 
                            placeholder="Name"
                            v-model="content.slider[i]['name']"/>
                        <input 
                            class="form-control mb-3" 
                            type="text" 
                            placeholder="Position"
                            v-model="content.slider[i]['position']"/>
                        <textarea 
                            class="form-control mb-3"
                            rows="3"
                            placeholder="Text"
                            v-model="content.slider[i]['text']"></textarea>

                    </div>

                    <div class="btn btn-primary" @click="addItem('slider', {name: '', position: '', text: '',})">
                        + add slide
                    </div>

                </div>
            

            </div>

        </div>

        <!-- faq -->
        <div class="section mb-4">
            
            <div class="accordion-title h4" @click="open">
                FAQ
            </div>

            <div class="accordion-content">
                
                <div class="h6">Title</div>
                <input 
                    class="form-control mb-3" 
                    type="text" 
                    placeholder="Title"
                    v-model="content.faq_title"/>

                <div class="items mb-3">

                    <div class="item" v-for="faq_item, i in content.faq">

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="h6">FAQ item</div>
                            <div 
                                class="delete text-danger" 
                                title="Delete faq"
                                @click="content.faq.splice(i, 1)">
                                x
                            </div>
                        </div>

                        <div class="attachment d-flex flex-column align-items-start mb-3">
                            <img 
                                class="mb-2"
                                :src="getAttachmentURI(content.faq[i].img)"
                                v-if="content.faq[i].img">
                            <input  
                                type="file" 
                                class="form-control-file"
                                @change="e => content.faq[i].img = e.target.files[0]"/>
                        </div>

                        <input 
                            class="form-control mb-3" 
                            type="text" 
                            placeholder="Title"
                            v-model="content.faq[i]['title']"/>
                        <textarea 
                            class="form-control mb-3"
                            rows="3"
                            placeholder="Text"
                            v-model="content.faq[i]['text']"></textarea>

                    </div>

                    <div class="btn btn-primary" @click="addItem('faq', {title: '', text: '',})">
                        + add faq
                    </div>

                </div>

            </div>

        </div>

        <!-- features -->
        <div class="section mb-4">
            
            <div class="accordion-title h4" @click="open">
                Features
            </div>

            <div class="accordion-content">
                
                <div class="h6">Title</div>
                <input 
                    class="form-control mb-3" 
                    type="text" 
                    placeholder="Title"
                    v-model="content.features_title"/>
                <div class="h6">Subtitle</div>
                <input 
                    class="form-control mb-3" 
                    type="text" 
                    placeholder="Subtitle"
                    v-model="content.features_subtitle"/>

                <div class="items mb-3">

                    <div class="item" v-for="feature, i in content.features">

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="h6">Feature</div>
                            <div 
                                class="delete text-danger"
                                title="Delete feature"
                                @click="content.features.splice(i, 1)">
                                x
                            </div>
                        </div>

                        <div class="attachment d-flex flex-column align-items-start mb-3">
                            <img 
                                class="mb-2"
                                :src="getAttachmentURI(content.features[i].img)"
                                v-if="content.features[i].img">
                            <input  
                                type="file" 
                                class="form-control-file"
                                @change="e => content.features[i].img = e.target.files[0]"/>
                        </div>
                        <input 
                            class="form-control mb-3" 
                            type="text" 
                            placeholder="Title"
                            v-model="content.features[i]['title']"/>
                        <textarea 
                            class="form-control mb-3"
                            rows="3"
                            placeholder="Text"
                            v-model="content.features[i]['text']"></textarea>

                    </div>

                    <div class="btn btn-primary" @click="addItem('features', {title: '', text: '',})">
                        + add feature
                    </div>

                </div>

                <div class="attachment d-flex flex-column align-items-start">
                    <div class="h6">Features image</div>
                    <img 
                        class="mb-2"
                        :src="getAttachmentURI(content.features_img)"
                        v-if="content.features_img">
                    <input  
                        type="file" 
                        class="form-control-file"
                        @change="e => content.features_img = e.target.files[0]"/>
                </div>
                
            </div>

        </div>

        <!-- payment -->
        <div class="section mb-4">
            
            <div class="accordion-title h4" @click="open">
                Payment
            </div>

            <div class="accordion-content">
                
                <div class="h6">Pay title №1</div>
                <input 
                    class="form-control mb-3" 
                    type="text" 
                    placeholder="Title"
                    v-model="content.payment_title_1"/>

                <div class="h6">Pay title №2</div>
                <input 
                    class="form-control mb-3" 
                    type="text" 
                    placeholder="Title"
                    v-model="content.payment_title_2"/>

                <div class="h6">Price</div>
                <input 
                    class="form-control mb-3" 
                    type="text" 
                    placeholder="Title"
                    v-model="content.payment_price"/>

                <div class="h6">Period</div>
                <input 
                    class="form-control mb-3" 
                    type="text" 
                    placeholder="Title"
                    v-model="content.payment_period"/>

                <div class="h6">Change payment title</div>
                <input 
                    class="form-control mb-3" 
                    type="text" 
                    placeholder="Title"
                    v-model="content.payment_change_title"/>

                <div class="items mb-3">

                    <div class="item" v-for="payment_feature, i in content.payment_features">

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="h6">Payment feature</div>
                            <div 
                                class="delete text-danger" 
                                title="Delete faq"
                                @click="content.payment_features.splice(i, 1)">
                                x
                            </div>
                        </div>

                        <input 
                            class="form-control mb-3" 
                            type="text" 
                            placeholder="Title"
                            v-model="content.payment_features[i]['title']"/>
                        <textarea 
                            class="form-control mb-3"
                            rows="3"
                            placeholder="Text"
                            v-model="content.payment_features[i]['text']"></textarea>

                    </div>

                    <div class="btn btn-primary" @click="addItem('payment_features', {title: '', text: '',})">
                        + add payment feature
                    </div>

                </div>

            </div>

        </div>

        <!-- chat -->
        <div class="section mb-4">
            
            <div class="accordion-title h4" @click="open">
                Chat
            </div>
            
            <div class="accordion-content">

                <div class="h6">Title</div>
                <input 
                    class="form-control mb-3" 
                    type="text" 
                    placeholder="Title"
                    v-model="content.chat_title"/>

                <div class="h6">Placeholder</div>
                <textarea 
                    class="form-control mb-3"
                    rows="3"
                    placeholder="Text"
                    v-model="content.chat_placeholder"></textarea>

                <div class="h6">Bottom text</div>
                <input 
                    class="form-control mb-3" 
                    type="text" 
                    placeholder="Title"
                    rows="15"
                    v-model="content.chat_bottom_text"/>

            </div>

        </div>

        <!-- footer -->
        <div class="section mb-4">
            
            <div class="accordion-title h4" @click="open">
                Footer
            </div>
            
            <div class="accordion-content">

                <div class="attachment d-flex flex-column align-items-start mb-3">
                    <div class="h6">Footer logo</div>
                    <img 
                        class="mb-2"
                        :src="getAttachmentURI(content.footer_logo)"
                        v-if="content.footer_logo">
                    <input  
                        type="file" 
                        class="form-control-file"
                        @change="e => content.footer_logo = e.target.files[0]"/>
                </div>

                <div class="h6">Footer text</div>
                <input 
                    class="form-control mb-3" 
                    type="text" 
                    placeholder="Title"
                    v-model="content.footer_text"/>

            </div>

        </div>

        <div class="section mb-4">
            
            <div class="accordion-title h4" @click="open">
                Additional
            </div>
            
            <div class="accordion-content">

                <div class="attachment d-flex flex-column align-items-start">
                    <div class="h6">Image in social media</div>
                    <img 
                        class="mb-2"
                        :src="getAttachmentURI(content.social_media_img)"
                        v-if="content.social_media_img">
                    <input  
                        type="file" 
                        class="form-control-file"
                        @change="e => content.social_media_img = e.target.files[0]"/>
                </div>

            </div>

        </div>

        <div class="btn btn-primary" @click="updateContent">
            Edit
        </div>

    </div>

</template>

<script>
export default {
    data() {
        return {
            content: {},
        }
    },
    methods: {
        getContent() {
            this.$emit('loading')
            axios.get('/api/admin/content')
                .then(res => {
                    if (Object.keys(res.data).length)
                        this.content = res.data 
                })
                .catch(res => {
                    alert('Something goes wrong. Try again.')
                })
                .finally(() => {
                    this.$emit('loaded')
                })
        },
        updateContent() {
            const data = this.content
            data._method = 'PUT'
            this.$emit('loading')
            axios.post(
                '/api/admin/content', 
                data, 
                {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    }
                }
            )
            .then(res => {
                alert('Content was updated.')
            })
            .catch(res => {
                alert('Something goes wrong. Try again.')
            })
            .finally(() => {
                this.$emit('loaded')
            })
        },
        addItem(items, item) {
            if (this.content[items])
                this.content[items].push(item)
            else
                this.content[items] = [item]
        }, 
        open(e) {
            const title = e.currentTarget
            const content = title.nextSibling
            content.classList.toggle('open')
        },
        getAttachmentURI(attachment) {
            if (typeof attachment == 'string')
                return `/storage/${attachment}`
            if(attachment instanceof File)
                return URL.createObjectURL(attachment)
        }
    },
    mounted() {
        this.getContent()
    },
    unmounted() {
        this.$emit('loaded')
    },
}
</script>

<style scoped>
.delete {
    cursor: pointer;
}

.accordion-title {
    background-color: rgb(247 246 251);
    padding: 20px;
    cursor: pointer;
}

.accordion-content {
    display: none;
}

.accordion-content.open {
    display: block;
}

.items {
    border: 1px solid #c5c5c5;
    border-radius: 10px;
    padding: 20px;
}

.attachment img, .attachment video {
    width: 200px;
    height: 200px;
    object-fit: cover;
}

input[type=file] {
    cursor: pointer;
}
</style>