<script>
    import {useForm} from "@inertiajs/svelte";
    import EditorJS from "@editorjs/editorjs";
    import Header from "@editorjs/header";
    import SimpleImage from "@editorjs/simple-image";
    import ImageTool from "@editorjs/image";
    import {uploadByFile} from "@/CustomUpload.ts";

    export let post_id;

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
                        byFile: 'http://127.0.0.1:8000/PostImageUpload', // Your backend file uploader endpoint
                        byUrl: 'http://127.0.0.1:8000/PostImageURL', // Your endpoint that provides uploading by Url
                    },
                    uploader: {
                        uploadByFile: uploadByFile,
                    }
                }
            }
        }
    })

    let confirmed;
    let post = useForm({
        post_id: post_id,
        postContent: {}
    })
    async function uploadPost(){
        if(!confirmed)
            return
        const data = await editor.save()
        $post.postContent = data
        console.log($post.postContent)
        $post.post('/reply/create');
    }
</script>
<div class="card">
    <div class="card-body">
        <form on:submit|preventDefault={uploadPost}>
            <div class="form-group s-rounded">
                <label class="form-label">Content</label>
                <div class="editorholder" id="editorjs"></div>
            </div>
            <div class="form-group">
                <label class="form-switch">
                    <input type="checkbox" bind:checked={confirmed}>
                    <i class="form-icon"></i> Confirm Posting This
                    <button type="submit" class="btn btn-primary input-group-btn">Post Comment</button>
                </label>
            </div>
        </form>
    </div>
</div>

<style>
    .editorholder {
        border: solid black 1px;
        border-radius: 5px;
    }
</style>
