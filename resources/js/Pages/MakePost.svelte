<script>
    import {inertia, page, useForm} from '@inertiajs/svelte'
    import * as feather from "feather-icons";
    import BlockHeader from "@/Components/BlockHeader.svelte";
    import EditorJS from '@editorjs/editorjs'
    import Header from '@editorjs/header'
    import SimpleImage from "@editorjs/simple-image";
    import ImageTool from "@editorjs/image";
    import {uploadByFile} from "@/CustomUpload.ts";

    const editor = new EditorJS({
        tools: {
            header: {
                class: Header,
                config: {
                    placeholder: 'header',
                    levels: [2, 3, 4],
                    defaultLevel: 2
                }
            },
            image: {
                class: ImageTool,
                config: {
                    endpoints: {
                        byFile: '/PostImageUpload/', // Your backend file uploader endpoint
                        byUrl: 'http://127.0.0.1:8000/PostImageURL', // Your endpoint that provides uploading by Url
                    },
                    uploader: {
                        uploadByFile: uploadByFile,
                    }
                }
            }
        }
    })
    export let topic_data;
    let post = useForm({
        title: '',
        topicId: topic_data.id,
        postContent: {},
        isNSFW: false,
        user_id: $page.props.auth.id,
        tags: []
    })

    let confirmed = false;

    async function uploadPost() {
        if (!confirmed)
            return;
        const data = await editor.save()
        $post.postContent = data
        console.log($post)
        $post.post('/createPost');
    }

    async function getTags(s = '') {
        const response = await fetch("/getTags/" + s);
        let data = await response.json();
        console.log(data)
        return data
    }

    let tagsPromise = getTags()
    let tagsearch = ''

    function handleTagInput() {
        console.log(tagsearch)
        tagsPromise = getTags(tagsearch)
    }

</script>
<div class="parent">
    <div class="div1 container grid-lg">
        <div class="columns">
            <div class="column col-xs-6">
                <BlockHeader title="New Post">
                    <form on:submit|preventDefault={uploadPost}>
                        <div class="form-group">
                            <label class="form-label" for="Title">Title</label>
                            <input class="form-input" required type="text" id="Title" placeholder="Seven Seas"
                                   bind:value={$post.title}>
                        </div>
                        <div class="form-group s-rounded">
                            <label class="form-label">Content</label>
                            <div class="editorholder" id="editorjs"></div>
                        </div>
                        <div class="form-group">
                            {#each $post.tags as tag, i}
                                <span class="chip c-hand" on:click={()=>{
                                    let newArr = $post.tags.splice(i,1)
                                    $post.tags = $post.tags
                                }}>{tag.name} - {i}</span>
                            {/each}
                            <form on:submit|preventDefault={handleTagInput}>
                                <div class="popover popover-right">
                                    <input class="form-input" type="text" id="input-example-1" bind:value={tagsearch} placeholder="Search Tags">
                                    <div class="popover-container">
                                        <div class="card">
                                            <div class="card-body">
                                                {#await tagsPromise}
                                                    <p>...waiting</p>
                                                {:then tags}
                                                    {#each tags as tag}
                                                        <span class="chip c-hand" on:click={()=>{$post.tags = [...$post.tags, tag]; console.log($post.tags)}}>{tag.name}</span>
                                                    {/each}
                                                {:catch error}
                                                    <p style="color: red">{error.message}</p>
                                                {/await}

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="form-group">
                            <label class="form-switch">
                                <input type="checkbox" bind:checked={$post.isNSFW}>
                                <i class="form-icon"></i> NSFW
                            </label>
                            <label class="form-switch">
                                <input type="checkbox" bind:checked={confirmed}>
                                <i class="form-icon"></i> Confirm Posting This
                                <button type="submit" class="btn btn-primary input-group-btn">Post</button>

                            </label>
                        </div>
                    </form>
                </BlockHeader>
            </div>
        </div>
    </div>
    <div class="div2 mr-2">
        <div class="card">
            <div class="card-header">
                <div class="card-title h5">
                    Post in: {topic_data.name}
                </div>
                <div class="card-subtitle text-gray">
                    You are making a post.
                </div>
            </div>
            <div class="card-body">
                Make sure to follow the topic rules
            </div>
        </div>
    </div>
</div>

<style>
    .editorholder {
        border: solid black 1px;
        border-radius: 5px;
    }

    .parent {
        height: 100%;
        width: 100%;
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        grid-template-rows: repeat(5, 1fr);
        grid-column-gap: 0px;
        grid-row-gap: 0px;
    }

    .div1 {
        grid-area: 1 / 1 / 6 / 5;
        overflow-y: auto;
    }

    .div1::-webkit-scrollbar {
        width: 8px;
    }

    .div1::-webkit-scrollbar-track {
        box-shadow: inset 0 0 6px rgba(25, 0, 0, 0.3);
    }

    .div1::-webkit-scrollbar-thumb {
        background-color: darkgray;
        border-radius: 10px;
    }

    .div2 {
        grid-area: 1 / 5 / 6 / 6;
    }
</style>
