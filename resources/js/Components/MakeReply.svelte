<script>
    import {useForm} from "@inertiajs/svelte";
    import EditorJS from "@editorjs/editorjs";
    import Header from "@editorjs/header";
    import SimpleImage from "@editorjs/simple-image";

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
            image: SimpleImage
        }
    })

    let confirmed;
    let post = useForm({
        isNSFW: false
    })
    function uploadPost(){

    }
</script>
<div class="card">
    <div class="card-body">
        <form on:submit|preventDefault={uploadPost}>
            <div class="form-group">
                <p>Do not use full image files/from clipboard. Only paste links! The editor will put them on automatically</p>
            </div>
            <div class="form-group s-rounded">
                <label class="form-label">Content</label>
                <div class="editorholder" id="editorjs"></div>
            </div>
            <div class="form-group">
                <label class="form-switch">
                    <input type="checkbox" bind:checked={$post.isNSFW}>
                    <i class="form-icon"></i> NSFW
                </label>
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
