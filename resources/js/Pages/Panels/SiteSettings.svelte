<script context="module">
    import DefaultLayout from "@/Layout/DefaultLayout.svelte";
    import AdminHomePanel from "@/Layout/AdminHomePanel.svelte";

    export const layout = [DefaultLayout, AdminHomePanel]
</script>

<script>
    import EditorJS from "@editorjs/editorjs";
    import Header from "@editorjs/header";
    import SimpleImage from "@editorjs/simple-image";
    import {useForm} from "@inertiajs/svelte";

    export let frontpage;

    let editor;
    if(frontpage === 404){
        editor = new EditorJS({
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
    }else {
        editor = new EditorJS({
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
            },
            data: JSON.parse(frontpage)
        })
    }

    let saveCont = useForm({
        PostContent: ''
    })

    async function SaveContent() {
        const data = await editor.save()
        $saveCont.PostContent = data
        $saveCont.post('/updateFrontPage');
    }

</script>


<div class="card">
    <div class="card-header">
        <div class="card-title h5 text-center">Homepage Content</div>
    </div>
    <div class="card-body">
        <div class="editorholder s-rounded" id="editorjs"></div>
    </div>
    <div class="card-footer">
        <button class="btn btn-primary" on:click={SaveContent}>Save</button>
    </div>
</div>

<style>
    .editorholder{
        border: black solid 1px;
    }
</style>
